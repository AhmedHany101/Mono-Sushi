<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\catering;
use App\Models\catering_image;
use App\Models\caterings;
use App\Models\compo;
use App\Models\compo_item;
use App\Models\compo_orders;
use App\Models\coupon;
use App\Models\dishes_data;
use App\Models\main_category;
use App\Models\offers;
use App\Models\order_item;
use App\Models\order_item_pices;
use App\Models\orders;
use App\Models\pieces_data;
use App\Models\shipping_data;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class admin_ctrl extends Controller
{
    //main page
    public function index()
    {
        $currentMonth = Carbon::now()->month; // Get the current month number
        $totalordersThisMonth = orders::whereMonth('created_at', $currentMonth)
            ->where('order_status', 2)
            ->sum('grand_total');
        $currentMonth = Carbon::now()->year(); // Get the current month number
        $totalordersThisYear = orders::whereMonth('created_at', $currentMonth)
            ->where('order_status', 2)
            ->sum('grand_total');
        $no_ordersThisMonth = orders::whereMonth('created_at', $currentMonth)
            ->count();
        $usersThisMonth = User::whereMonth('created_at', $currentMonth)
            ->where('role_as', 0)
            ->count();
        $ordersThisMonth = orders::whereMonth('created_at', $currentMonth)->where('order_status', 0)->get();
        $currentYear = Carbon::now()->year; // Get the current year
        $monthlySums = orders::selectRaw('MONTH(created_at) as month, SUM(grand_total) as sum')->where('order_status', 2)
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('sum', 'month')
            ->toArray();

        // Prepare the data for the chart
        $months = [];
        $sums = [];
        for ($month = 1; $month <= 12; $month++) {
            $months[] = Carbon::createFromDate($currentYear, $month)->format('F');
            $sums[] = isset($monthlySums[$month]) ? $monthlySums[$month] : 0;
        }
        //return number of pepol that open the site 
        $currentMonthReport = Carbon::now()->startOfMonth();
        $no_visitors = Visit::where('created_at', '>=', $currentMonthReport)->count();
        return view('admin_pages/index', compact('no_visitors', 'months', 'sums', 'totalordersThisMonth', 'no_ordersThisMonth', 'usersThisMonth', 'totalordersThisYear', 'ordersThisMonth'));
    }
    //main_categories
    public function main_categories()
    {
        $data = main_category::all();
        return view('admin_pages/main_categories', compact('data'));
    }
    //add new item page 
    public function add_new_item()
    {
        $category = main_category::all();
        return view('admin_pages/add_new_item_from', compact('category'));
    }
    //dishes_data
    public function dishes_data()
    {
        $data = dishes_data::all();
        $pieces_data = pieces_data::all();
        $categories = main_category::all();
        return view('admin_pages/dishes_data', compact('data', 'pieces_data', 'categories'));
    }
    //add_new_category function
    public function add_new_category(Request $request)
    {
        $data = new main_category();
        $data->name = $request->name;

        $imagefile = $request->file('image');
        $ext = $imagefile->getClientOriginalExtension();
        $uploadpath = 'category_images';
        $filename = time() . '.' . $ext;
        $imagefile->move($uploadpath, $filename);
        $data->image = $filename;

        $data->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
    //add new dish function
    public function add_new_dish(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'component' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pieces' => 'required|array',
            'pieces.*.pieces_no' => 'required|numeric',
            'pieces.*.pieces_price' => 'required|numeric',
        ]);

        // Create a new dishes_data instance and assign the validated data
        $dishes_data = new dishes_data();
        $dishes_data->name = $validatedData['name'];
        $dishes_data->category_id = $request['category'];
        $dishes_data->component = $validatedData['component'];

        // Process the image file
        $imagefile = $validatedData['image'];
        $ext = $imagefile->getClientOriginalExtension();
        $uploadpath = 'dishes_images';
        $filename = time() . '.' . $ext;
        $imagefile->move($uploadpath, $filename);
        $dishes_data->image = $filename;
        $dishes_data->save();

        // Save the pieces data
        $pieces = $validatedData['pieces'];

        foreach ($pieces as $piece) {
            $pieces_data = new pieces_data();
            $pieces_data->pieces_no = $piece['pieces_no'];
            $pieces_data->pieces_price = $piece['pieces_price'];
            $pieces_data->dish_id = $dishes_data->id;
            $pieces_data->save();
        }

        return redirect()->back()->with('success_message', 'Data added successfully');
    }
    //shipping_data page
    public function shipping_page()
    {
        $data = shipping_data::all();
        return view('admin_pages/shipping_data', compact('data'));
    }
    //addnewshippingdata function
    public function addnewshippingdata(Request $request)
    {
        $request->validate([
            'city_name' => 'required',
            'shipping_cost' => 'required',
            'time_to_delivery' => 'required',
        ]);
        $data = new shipping_data();
        $data->city_name = $request->city_name;
        $data->shipping_cost = $request->shipping_cost;
        $data->time_to_delivery = $request->time_to_delivery;
        $data->save();
        return response()->json([
            'status' => 'success',
        ]);
    }
    //delete_city
    public function delete_city($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $city = shipping_data::find($id);
        $city->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
    //delete_dish
    public function delete_dish($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $dish = dishes_data::find($id);

        if (!$dish) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Perform the deletion
        $dish->delete();
        $image1 = 'dishes_images/' . $dish->image;
        if (File::exists($image1)) {
            File::delete($image1);
        }

        return response()->json(['success_message' => 'User deleted successfully']);
    }
    //edite_dish
    public function edite_dish($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $dish = dishes_data::find($id);
        $category = main_category::all();
        $dish_picies = pieces_data::where('dish_id', $id)->get();
        return view('admin_pages/edite_dish_form', compact('dish', 'dish_picies', 'category'));
    }
    //delete__pices_item
    public function delete__pices_item($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $pices_item = pieces_data::find($id);
        if ($pices_item) {
            $pices_item->delete();
            return redirect()->back()->with('success_message', 'Deleted Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Deleted Faild');
        }
    }
    //edite_dish_fun
    public function edite_dish_fun(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|numeric',

            'component' => 'required|string|max:255',
            'pieces' => 'required|array',
            'pieces.*.pieces_no' => 'required|numeric',
            'pieces.*.pieces_price' => 'required|numeric',
        ]);

        // Retrieve the dishes_data instance
        $dishes_data = dishes_data::find($request->id);

        // Update the dishes_data attributes
        $dishes_data->name = $validatedData['name'];
        $dishes_data->category_id = $validatedData['category'];
        $dishes_data->component = $validatedData['component'];

        // Process the image file

        if (!empty($request->file('image'))) {
            // Delete the old image file
            $oldImage = $dishes_data->image;
            if (!empty($oldImage)) {
                $oldImagePath = public_path('dishes_images/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Process the new image file
            $imagefile = $request->file('image');
            $ext = $imagefile->getClientOriginalExtension();
            $uploadpath = 'dishes_images';
            $filename = time() . '.' . $ext;
            $imagefile->move($uploadpath, $filename);
            $dishes_data->image = $filename;
        }
        // Save the updated dishes_data
        $dishes_data->save();

        // Update the pieces data
        return redirect()->back()->with('success_message', 'Data Edite successfully');
    }
    public function coupon_data()
    {
        $data = coupon::all();
        return view('admin_pages/coupon_data', compact('data'));
    }

    // ...

    public function generateCoupon(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'discount' => 'required|numeric|min:0',
            'description' => 'required|string',
            'expiration_date' => 'required|date',
        ]);

        $quantity = $request->input('quantity');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $expirationDate = Carbon::parse($request->input('expiration_date'));

        for ($i = 0; $i < $quantity; $i++) {
            $code = Str::random(8); // Generate a random code
            $coupon = new coupon();
            $coupon->code = $code;
            $coupon->description = $description;
            $coupon->discount = $discount;
            $coupon->expiration_date = $expirationDate;
            $coupon->save();
        }

        return redirect()->back()->with('success_message', 'Coupons generated successfully.');
    }
    public function multiDelete(Request $request)
    {
        $selectedRows = $request->input('selectedRows');

        if (!is_null($selectedRows) && is_array($selectedRows)) {
            // Delete the selected coupons
            coupon::whereIn('id', $selectedRows)->delete();

            return redirect()->back()->with('success_message', 'Selected coupons have been deleted.');
        }

        return redirect()->back()->with('error_message', 'No coupons selected for deletion.');
    }
    //Orders_data
    public function Orders_data()
    {
        $data = orders::all();
        return view('admin_pages/orders_data', compact('data'));
    }
    //order_details
    public function order_details($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $order = orders::find($id);
        $order_items = order_item::where('order_id', $id)->get();
        $order_compo = compo_orders::where('order_id', $id)->get();
        $order_item_pices = order_item_pices::where('order_id', $id)->get();
        $comp_item = compo_item::all();
        return view('admin_pages/order_details', compact('order', 'order_items', 'comp_item', 'order_compo', 'order_item_pices'));
    }
    //change_order_staus
    public function change_order_staus(Request $request)
    {
        $order = orders::find($request->id);
        $order->order_status = $request->status;
        $order->save();
        return redirect()->back()->with('success_message', 'Status Chnage successfully');
    }
    //delete_order
    public function delete_order($encrypted_id)
    {
        // Find the order by ID
        $id = Crypt::decryptString($encrypted_id);
        $order = orders::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Perform the deletion
        $order->delete();

        return response()->json(['success_message' => 'Order deleted successfully']);
    }
    //UsersList
    public function UsersList()
    {
        $Orders = orders::all();
        $data = User::where('role_as', 0)->get();
        return view('admin_pages/UsersList', compact('data', 'Orders'));
    }
    //delete 
    public function delete_user($encrypted_id)
    {
        // Find the user by ID
        $id = Crypt::decryptString($encrypted_id);
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Perform the deletion
        $user->delete();

        return response()->json(['success_message' => 'User deleted successfully']);
    }


    //delete_category
    public function delete_category($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $category = main_category::find($id);
        $related_dish = dishes_data::where('category_id', $id)->get();
        $pieces_data = pieces_data::whereIn('dish_id', $related_dish->pluck('id'))->get();

        // Delete related pieces_data
        foreach ($pieces_data as $item) {
            $item->delete();
        }

        // Delete related dishes_data
        foreach ($related_dish as $item) {
            $item->delete();
            $imagePath = public_path('dishes_images/' . $item->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Delete the category
        $category->delete();

        // Delete the category image file
        $imagePath = public_path('category_images/' . $category->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        return response()->json(['success_message' => 'Category deleted successfully']);
    }
    //editeCategory
    public function editeCategory(Request $request)
    {
        $data = main_category::find($request->id);
        $data->name = $request->name;

        if (!empty($request->file('image'))) {
            // Delete the old image file
            $oldImage = $data->image;
            if (!empty($oldImage)) {
                $oldImagePath = public_path('category_images/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Process the new image file
            $imagefile = $request->file('image');
            $ext = $imagefile->getClientOriginalExtension();
            $uploadpath = 'category_images';
            $filename = time() . '.' . $ext;
            $imagefile->move($uploadpath, $filename);
            $data->image = $filename;
        }

        $data->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
    //compo data
    public function compo_page()
    {
        $compo_data = compo::all();
        $compo_item = compo_item::all();

        return view('admin_pages/compo_data', compact('compo_data', 'compo_item'));
    }
    //addNewCompoForm
    public function addNewCompoForm()
    {
        $dishs = dishes_data::all();

        return view('admin_pages/addNewCompoform', compact('dishs'));
    }
    //get the pices information for the selcted item
    public function getPiecesData(Request $request)
    {
        $itemId = $request->input('item_id');
        // Retrieve the related pieces data from the database based on the $itemId

        // Return the data as a JSON response
        $piecesData = pieces_data::where('dish_id', $itemId)->get();
        return response()->json($piecesData);
    }
    //save compo data 
    public function saveCompo(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required',
            'image' => 'required',
            'pieces' => 'required|array',
            'pieces.*.compo_set' => 'required',
            'pieces.*.set_image' => 'required',
        ]);

        $compo_data = new compo();
        $compo_data->name = $validatedData['name'];
        $imagefile = $validatedData['image'];
        $ext = $imagefile->getClientOriginalExtension();
        $uploadpath = 'compo_image';
        $filename = time() . '.' . $ext;
        $imagefile->move($uploadpath, $filename);
        $compo_data->image = $filename;
        $compo_data->total = $validatedData['cost'];
        $compo_data->save();

        $compo_items = $validatedData['pieces'];

        foreach ($compo_items as $compo_item) {
            $compo_item_data = new compo_item();
            $compo_item_data->compo_id  = $compo_data->id;
            $compo_item_data->compo_set = $compo_item['compo_set'];
            $imagefile2 = $compo_item['set_image'];
            $ext2 = $imagefile2->getClientOriginalExtension();
            $filename2 = time() . '_' . uniqid() . '.' . $ext2;
            $uploadpath2 = 'compo_image';
            $imagefile2->move($uploadpath2, $filename2);
            $compo_item_data->set_image = $filename2;
            $compo_item_data->save();
        }

        return redirect()->back()->with('success_message', 'Compo added successfully');
    }
    //delete compo
    public function deleteCompo($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $compo = compo::find($id);
        $compoItems = compo_item::where('compo_id', $id)->get();

        if (!$compo) {
            return response()->json(['error' => 'compo not found'], 404);
        }

        $compo->delete();

        // Delete the category image file
        $imagePath = public_path('compo_image/' . $compo->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        foreach ($compoItems as $compoItem) {
            $compoItem->delete();
            $imagePath2 = public_path('compo_image/' . $compoItem->set_image);
            if (File::exists($imagePath2)) {
                File::delete($imagePath2);
            }
        }

        return response()->json(['success_message' => 'Category deleted successfully']);
    }

    //offers page
    public function offer()
    {
        $data = offers::all();
        return view('/admin_pages/offers', compact('data'));
    }
    //add_new_offer function
    public function add_new_offers(Request $request)
    {
        $data = new offers();

        $imagefile = $request->file('image');
        $ext = $imagefile->getClientOriginalExtension();
        $uploadpath = 'offers_images';
        $filename = time() . '.' . $ext;
        $imagefile->move($uploadpath, $filename);
        $data->image = $filename;
        $data->description = $request->description;
        $data->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
    //edite_offers
    public function edite_offers(Request $request)
    {
        $data = offers::find($request->id);
        $data->description = $request->description;
        if (!empty($request->file('image'))) {
            // Delete the old image file
            $oldImage = $data->image;
            if (!empty($oldImage)) {
                $oldImagePath = public_path('offers_images/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Process the new image file
            $imagefile = $request->file('image');
            $ext = $imagefile->getClientOriginalExtension();
            $uploadpath = 'offers_images';
            $filename = time() . '.' . $ext;
            $imagefile->move($uploadpath, $filename);
            $data->image = $filename;
        }

        $data->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
    //delete_offers
    public function delete_offers($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $offer = offers::find($id);

        if (!$offer) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Delete the category
        $offer->delete();

        // Delete the category image file
        $imagePath = public_path('offers_images/' . $offer->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        return response()->json(['success_message' => 'Category deleted successfully']);
    }
    //catring page 
    public function catering_data()
    {
        $data = caterings::all();
        return view('admin_pages/catering_data');
    }
    //addNewCatering
    public function addNewCatering()
    {
        return view('admin_pages/addNewCatering');
    }
    //addcatering
    public function addCatering(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-m4v,video/mpeg|max:100000',
            'images' => 'nullable|array|max:6',
            'images.*' => 'required|image|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $catering = new caterings();
        $catering->description = $request->description;

        // Save the video file
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoFileName = time() . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move('catering_videos', $videoFileName);
            $catering->video = $videoFileName;
        }

        $catering->save();
        $cateringimg = new catering_image();
        if ($request->hasFile('images')) {
            $i = 1;
            foreach ($request->file('images') as $item) {
                $uploadpath = 'catering_images';
                $ext = $item->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $ext;
                $item->move($uploadpath, $filename);

                // Use the existing instance to create the record
                $cateringimg->create([
                    'catering_id' => $catering->id,
                    'image' => $filename,
                ]);
            }
        }



        return redirect()->back()->with('success_message', 'Catering added successfully.');
    }
    //catering page 
    public function catering_page()
    {
        $data = caterings::all();
        return view('/admin_pages/catering_data', compact('data'));
    }
    //delete_catering
    public function delete_catering($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);

        // Retrieve the catering record
        $catering = caterings::find($id);
        if (!$catering) {
            return redirect()->back()->with('error_message', 'Catering not found.');
        }

        // Delete the video file
        $videoPath = public_path('catering_videos/' . $catering->video);
        if (file_exists($videoPath)) {
            unlink($videoPath);
        }

        // Delete the catering images and their corresponding files
        $cateringImages = catering_image::where('catering_id', $id)->get();
        foreach ($cateringImages as $cateringImage) {
            $imagePath = public_path('catering_images/' . $cateringImage->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $cateringImage->delete();
        }

        // Delete the catering record
        $catering->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
    //edite_catering
    public function edite_catering($encrypted_id)
    {
        $id = Crypt::decryptString($encrypted_id);
        $catering = caterings::find($id);
        $cateringImages = catering_image::where('catering_id', $id)->get();
        return view('admin_pages/edite_catring', compact('catering', 'cateringImages'));
    }
    //delete catering image
    public function delet_image($id)
    {
        $catering_image = catering_image::findOrFail($id);
        $image = 'catering_images/' . $catering_image->image;
        if (File::exists($image)) {
            File::delete($image);
        }
        $catering_image->delete();
        return redirect()->back()->with('success_message', 'Deleted Succes');
    }
    //editcatering
    public function editCatering(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/x-m4v,video/mpeg|max:100000',
            'images' => 'nullable|array|max:6',
            'images.*' => 'required|image|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $catering = caterings::find($request->id);
        $catering->description = $request->description;

        // Delete the old video file
        if ($request->hasFile('video')) {
            $oldVideoPath = public_path('catering_videos/' . $catering->video);
            if (file_exists($oldVideoPath)) {
                unlink($oldVideoPath);
            }

            // Save the new video file
            $videoFile = $request->file('video');
            $videoFileName = time() . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move('catering_videos', $videoFileName);
            $catering->video = $videoFileName;
        }

        $catering->save();

        $imageFiles = $request->file('images');
        if ($imageFiles) {
            foreach ($imageFiles as $imageFile) {
                $ext = $imageFile->getClientOriginalExtension();
                $uploadpath = 'catering_images';
                $filename = time() . '_' . $imageFile->getClientOriginalName(); // Use a unique identifier for the filename
                $imageFile->move($uploadpath, $filename);

                // Create a new catering_image instance for each image
                $cateringImage = new catering_image();
                $cateringImage->image = $filename;
                $cateringImage->catering_id = $catering->id;
                $cateringImage->save();
            }
        }

        return redirect()->back()->with('success_message', 'Catering edite successfully.');
    }
}
