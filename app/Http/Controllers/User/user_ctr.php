<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\coupon;
use App\Models\dishes_data;
use App\Models\main_category;
use App\Models\order_item;
use App\Models\orders;
use App\Models\pieces_data;
use App\Models\shipping_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Models\catering_image;
use App\Models\caterings;
use App\Models\compo;
use App\Models\compo_item;
use App\Models\compo_order;
use App\Models\compo_orders;
use App\Models\compoCart;
use App\Models\offers;
use App\Models\order_item_pices;
use App\Models\OrderItemPices_no;

class user_ctr extends Controller
{
    //index page 
    public function index()
    {
        $pieces_data = pieces_data::all();
        $dishes_data = dishes_data::all();
        $categories = main_category::take(3)->get();
        $compos = compo::take(3)->get();
        $compo_items = compo_item::all();
        $offers = offers::take(3)->get();
        $images = dishes_data::all();
        $filteredCategories = [];
        foreach ($categories as $category) {
            $dishCount = 0;
            foreach ($dishes_data as $dish) {
                if ($dish->category_id == $category->id) {
                    $dishCount++;
                }
            }
            if ($dishCount != 0) {
                $category->dishCount = $dishCount;
                $filteredCategories[] = $category;
            }
        }

        return view('user_pages.index', compact('dishes_data', 'filteredCategories', 'pieces_data', 'compos', 'compo_items', 'offers', 'images'));
    }
    //menu page
    public function menu_page()
    {
        $pieces_data = pieces_data::all();
        $dishes_data = dishes_data::all();
        $categories = main_category::get();
        $compos = compo::all();
        $compo_items = compo_item::all();

        $filteredCategories = [];
        foreach ($categories as $category) {
            $dishCount = 0;
            foreach ($dishes_data as $dish) {
                if ($dish->category_id == $category->id) {
                    $dishCount++;
                }
            }
            if ($dishCount != 0) {
                $category->dishCount = $dishCount;
                $filteredCategories[] = $category;
            }
        }
        return view('user_pages.menu', compact('dishes_data', 'filteredCategories', 'pieces_data', 'compos', 'compo_items'));
    }
    //dish details 
    public function dish_details($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $dish_data = dishes_data::findOrFail($id);
        $pieces_data = pieces_data::where('dish_id', $dish_data->id)->get();
        return view('user_pages.dish_details', compact('dish_data', 'pieces_data'));
    }
    //addcart
    public function addcart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = auth()->user();
            $product = dishes_data::find($id);
            $pieces_no = $request->input('pieces_no');
            $qty = $request->input('qty');

            if ($pieces_no === null || count($pieces_no) === 0) {
                return response()->json(['status' => 'error', 'message2' => 'Please select at least one option']);
            }

            $productExit = cart::where('product_id', $product->id)->where('user_id', $user->id)->count();
            if ($productExit > 0) {
                return response()->json(['status' => 'error', 'message2' => __('Product already added in cart')]);
            }

            $cart = new cart;
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->save();

            for ($i = 0; $i < count($pieces_no); $i++) {
                $pieces_data = new OrderItemPices_no();
                $pieces_data->product_id = $product->id;
                $pieces_data->cart_id = $cart->id;
                $pieces_data->pieces_price = $request->input('pieces_price')[$i];
                $pieces_data->pieces_no = $pieces_no[$i];
                // Retrieve the quantity value for the corresponding offer
                $pieces_data->qty = $qty[$i];
                $pieces_data->pieces_id = 1;
                $pieces_data->save();
            }
            return response()->json(['status' => 'success', 'message' => 'Product Added to cart']);
        } else {
            return response()->json(['status' => 'error', 'message2' => 'Please Login']);
        }
    }
    //checkout page 
    public function checkout_page()
    {
        if (Auth::id()) {

            $shipping_info = shipping_data::all();
            $user = auth()->user();
            $cart = cart::where('user_id', $user->id)->get(); // Retrieve a single cart instance
            $compocart = compoCart::where('user_id', $user->id)->get();
            $compoItems = compo_item::all();
            $item_pices = OrderItemPices_no::all();
            if ($cart->count() > 0 || $compocart->count() > 0) {
                return view('user_pages.checkout_page', compact('shipping_info', 'item_pices', 'cart', 'compocart', 'compoItems'));
            } else {
                return redirect('/');
            }
            return redirect('/');
        }

        return redirect('Login');
    }
    public function increment(Request $request)
    {
        $cartItemId = $request->input('cartItemId');

        $cartItem = cart::find($cartItemId);
        $cartItem->quantity += 1;
        $cartItem->total = $cartItem->product_price * $cartItem->quantity;
        $cartItem->save();

        $itemTotal = $cartItem->product_price * $cartItem->quantity;
    }

    public function decrement(Request $request)
    {
        $cartItemId = $request->input('cartItemId');

        $cartItem = cart::find($cartItemId);
        $cartItem->total = $cartItem->product_price * $cartItem->quantity;
        $cartItem->quantity -= 1;
        $cartItem->save();

        $itemTotal = $cartItem->product_price * $cartItem->quantity;

        return $itemTotal;
    }

    public function updateQuantity(Request $request)
    {
        $cartItemId = $request->input('cartItemId');
        $quantity = $request->input('quantity');

        $cartItem = cart::find($cartItemId);
        $cartItem->quantity = $quantity;

        $cartItem->save();

        $itemTotal = $cartItem->product_price * $cartItem->quantity;

        $cartTotal = 0;
        foreach ($cartItem as $item) {
            $cartTotal += $item->product_price * $item->cartItem->quantity;
        }

        return response()->json([
            'itemTotal' => $itemTotal,
            'cartTotal' => $cartTotal
        ]);
    }
    //checkout function 
    /**
     * The `checkout_function` is a PHP function that handles the checkout process for an order,
     * including validating the request data, calculating the total cost, creating the order and related
     * items, and deleting the cart items.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request made to the server. It contains data sent by the client, such as form
     * inputs, query parameters, and headers.
     * 
     * @return a redirect response to the homepage with a success message if the order is successfully
     * placed. If there is an error, it will return back to the previous page with an error message.
     */
    public function checkout_function(Request $request)
    {
        try {
            $request->validate([
                'city' => 'required',
                'phone' => 'required',
                'name' => 'required',
                'deliveryTime' => 'required',
            ]);
            $user = auth()->user();
            $cart_total = cart::where('user_id', $user->id)->get();
            $total_cart = 0;
            $total = 0;
            $compo_total = 0;
            $cart = cart::where('user_id', $user->id)->get();
            $item_pices = OrderItemPices_no::all();
            //compo item 
            $compocart = compoCart::where('user_id', $user->id)->get();
            if ($compocart->count() > 0) {
                foreach ($compocart as $item) {
                    $compo_total += $item->compo->total;
                }
            }
            if ($cart->count() > 0) {
                //summtion the cart item
                foreach ($cart as $item) {
                    foreach ($item_pices as $item2) {
                        if ($item2->cart_id == $item->id) {
                            $total_cart += $item2->qty * $item2->pieces_price;
                        }
                    }
                }
            }
            $total = $total_cart + $compo_total;
            $order = new orders();
            $order->name = $request->input('name');
            $order->user_id = $user->id;
            $order->coupon_value = $request->input('discountValue') ?? 0;
            $order->shipping_cost = $request->input('shippingCost') ?? 0;
            $order->grand_total = $total  + $order->shipping_cost - $order->coupon_value;
            $order->phone = $request->input('phone');
            $order->address = $request->input('address');
            $order->city = $request->input('city');
            $order->arrivalTime = Carbon::createFromFormat('H', $request->input('deliveryTime'))->format('g A');
            $order->total = $total;

            if ($request->input('discountValue') != 0) {
                $order->coupon_status = 1;
                $order->coupon_no = $request->input('coupon');
            }

            $order->save();

            if ($compocart->count() > 0) {
                foreach ($compocart as $item) {

                    $cmpodata = new compo_orders();
                    $cmpodata->order_id = $order->id;
                    $cmpodata->compo_id = $item->compo_id;
                    $cmpodata->save();
                }
            }
            if ($cart->count() > 0) {
                foreach ($cart as $item) {
                    $orderItem = order_item::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                    ]);
                    foreach ($item_pices as $item2) {
                        if ($item2->cart_id == $item->id) {
                            order_item_pices::create([
                                'order_id' => $order->id,
                                'product_id' => $item2->product_id,
                                'order_item_id' => $orderItem->id,
                                'product_pieces' => $item2->pieces_no,
                                'product_price' => $item2->pieces_price,
                                'qty' => $item2->qty,
                                'total' => $item2->qty * $item2->prices_price,
                            ]);
                        }
                    }
                }
            }
            if ($cart->count() > 0) {

                // Delete cart items and related order item pieces
                foreach ($cart as $item) {
                    OrderItemPices_no::where('cart_id', $item->id)->delete();
                }
                cart::where('user_id', $user->id)->delete();
            }
            if ($compocart->count() > 0) {
                compoCart::where('user_id', $user->id)->delete();
            }

            return redirect('/')->with('success_message', 'Your Order Has Been Placed,Someone Will Contact You To Confirm');
        } catch (\Exception $e) {
            return back()->with('error_message', 'An error occurred : ' . $e->getMessage());
        }
    }

    public function sendsms()
    {
        // try {
        //     // Send SMS message
        //     $basic = new \Vonage\Client\Credentials\Basic("64eb176e", "GSkXO9gYehIrZ24f");
        //     $client = new \Vonage\Client($basic);

        //     // Generate the URL to the home page
        //     $homeUrl = url('/');

        //     // Create the SMS message with the home page URL
        //     $message = new \Vonage\SMS\Message\SMS("201554444758", 'MONO SUSHI', 'You have a new order. Visit ' . $homeUrl . ' for more details.');

        //     $response = $client->sms()->send($message);

        //     return response()->json('SMS sent', 200);
        // } catch (\Exception $e) {
        //     // Handle any exceptions that occur during sending
        //     return response()->json('Failed to send SMS', 500);
        // }
        $basic  = new \Vonage\Client\Credentials\Basic("64eb176e", "GSkXO9gYehIrZ24f");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("201554444758", 'BRAND_NAME', 'A text message sent using the Nexmo SMS API')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
    public function check(Request $request)
    {
        $code = $request->input('code');

        // Perform the necessary checks on the coupon code
        $coupon = coupon::where('code', $code)->first();

        if (!$coupon) {
            $response = [
                'error' => 'Invalid coupon code'
            ];
        } else {
            $expirationDate = $coupon->expiration_date;
            $isActive = $coupon->is_active;
            $discountValue = $coupon->discount;

            // Check if the coupon is expired and inactive
            $currentDate = date('Y-m-d');
            if ($expirationDate < $currentDate || $isActive === 0) {
                $response = [
                    'error' => 'Coupon is expired or inactive'
                ];
            } else {
                $response = [
                    'discount_value' => $discountValue
                ];
            }
        }

        return response()->json($response);
    }
    //delete item from cart 
    public function delete_item_from_cart($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $cart_item = cart::find($id);
        $items = OrderItemPices_no::where('cart_id', $id)->get();

        foreach ($items as $item) {
            $item->delete();
        }

        $cart_item->delete();

        return redirect()->back()->with('success', 'Item Deleted');
    }
    //contact_us_form
    public function contact_us_form()
    {
        return view('user_pages/contact');
    }
    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required|string',
        ]);

        $details = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
        ];

        try {

            Mail::to('monosushi2023@gmail.com')->send(new Contact($details));


            return back()->with('success_message', 'Message Sent');
        } catch (\Exception $e) {
            return back()->with('error_message', 'An error occurred while sending the email: ' . $e->getMessage());
        }
    }
    //compo_page
    public function compo_page()
    {
        $compos = compo::all();
        $compo_items = compo_item::all();
        return view('user_pages/compo', compact('compos', 'compo_items'));
    }
    //addCompoToCart
    public function addCompoToCart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = auth()->user();
            $compo = compo::find($id);



            // $productexit = compoCart::where('compo_id', $compo->id)->where('user_id', $user->id)->count();
            // if ($productexit > 0) {
            //     return response()->json(['status' => 'error', 'message2' => __('Product already added in cart')]);
            // }

            $compocart = new compoCart();
            $compocart->user_id = $user->id;
            $compocart->compo_id = $compo->id;
            $compocart->save();

            return response()->json([
                'status' => 'success',
                'message' => __('Product Added to cart'),
                'data' => $compocart,
            ]);
        } else {
            return response()->json(['status' => 'error', 'message2' => __('Please login')]);
        }
    }
    //delete compo from cart 
    public function delete_compo_from_cart($encrypted_compo_id)
    {
        $id = Crypt::decryptString($encrypted_compo_id);
        $cart_item = compoCart::find($id);

        $cart_item->delete();

        return redirect()->back()->with('success', 'Item Deleted');
    }
    //offer page
    public function offer()
    {
        $offers = offers::all();
        return view('user_pages/offer', compact('offers'));
    }
    //catering page 
    public function catreing()
    {
        $caterings = caterings::all();
        $catering_images = catering_image::all();
        return view('user_pages/catering', compact('caterings', 'catering_images'));
    }
}
