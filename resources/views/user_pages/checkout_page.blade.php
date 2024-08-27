@extends('layout.user_layout')
@section('layout')
<style>
    .title {
        margin-bottom: 5vh;
    }

    .card {
        margin: auto;
        margin-top: 55px;
        max-width: 950px;
        width: 90%;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 1rem;
        border: transparent;
    }

    @media(max-width:767px) {
        .card {
            margin: 3vh auto;
        }
    }

    .cart0 {
        background-color: #fff;
        padding: 4vh 5vh;
        border-bottom-left-radius: 1rem;
        border-top-left-radius: 1rem;
    }

    @media(max-width:767px) {
        .cart0 {
            padding: 4vh;
            border-bottom-left-radius: unset;
            border-top-right-radius: 1rem;
        }
    }

    .summary {
        background-color: #ddd;
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
        padding: 4vh;
        color: rgb(65, 65, 65);
    }

    @media(max-width:767px) {
        .summary {
            border-top-right-radius: unset;
            border-bottom-left-radius: 1rem;
        }
    }

    .summary .col-2 {
        padding: 0;
    }

    .summary .col-10 {
        padding: 0;
    }

    .row {
        margin: 0;
    }

    .title b {
        font-size: 1.5rem;
    }

    .main {
        margin: 0;
        padding: 2vh 0;
        width: 100%;
    }

    .col-2,
    .col {
        padding: 0 1vh;
    }

    a {
        padding: 0 1vh;
    }

    .close {
        margin-left: auto;
        font-size: 0.7rem;
    }

    img {
        width: 3.5rem;
    }

    .back-to-shop {
        margin-top: 4.5rem;
    }

    h5 {
        margin-top: 4vh;
    }

    hr {
        margin-top: 1.25rem;
    }

    form {
        padding: 2vh 0;
    }

    select {
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1.5vh 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }

    input {
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }

    input:focus::-webkit-input-placeholder {
        color: transparent;
    }

    .btn2 {
        background-color: #F28439;
        border-color: #F28439;
        color: white;
        width: 100%;
        font-size: 0.7rem;
        margin-top: 4vh;
        padding: 1vh;
        border-radius: 0;
    }

    .btn2:focus {
        box-shadow: none;
        outline: none;
        box-shadow: none;
        color: white;
        -webkit-box-shadow: none;
        -webkit-user-select: none;
        transition: none;
        font-weight: bolder;
        font-size: 16px;
    }

    .btn2:hover {
        color: white;
    }

    a {
        color: black;
    }

    a:hover {
        color: black;
        text-decoration: none;
    }

    .close {
        top: 15px !important
    }

    #code {
        background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
        background-repeat: no-repeat;
        background-position-x: 95%;
        background-position-y: center;
    }

    .quantity-box {
        width: 100px;
    }

    .product-quantity-slider {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-quantity-slider button {
        background-color: #f7f7f7;
        color: #333;
        border: 1px solid #ccc;
        padding: 5px 10px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .product-quantity-slider button:hover {
        background-color: #333;
        color: #fff;
        border-color: #333;
    }

    .product-quantity-slider input {
        width: 50px;
        text-align: center;
        font-size: 16px;
        border: 1px solid #ccc;
        padding: 5px;
        margin: 0 5px;
    }
</style>

<section class="ftco-section" style="background-color: #0E2D32 !important;">
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart0">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <div class="col align-self-center text-right text-muted">{{$cartCount}} items</div>
                    </div>
                </div>
                <!--single cart item -->

                @php
                $total = 0;
                $totalcart = 0;
                $totalcompo = 0;
                @endphp

                @foreach($cart as $item)
                @php
                $subtotal = 0;
                @endphp


                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-12 col-md-2">
                            <img class="img-fluid rounded-circle" src="{{asset('/dishes_images/'.$item->product->image)}}">
                        </div>
                        <div class="col-12 col-md">
                            <div class="row text-muted">{{$item->product->name}}</div>
                            <div class="row">{{$item->product->component}}</div>
                            <!-- <div class="row">{{$item->product_pieces}} Pieces {{$item->product_price}}</div> -->
                            <div class="row">Order Details:
                                @foreach($item_pices as $item2)
                                @if($item2->cart_id == $item->id)
                                <p>{{$item2->pieces_no}} Pieces * {{$item2->qty}} <strong style="color: red;">Total : {{$item2->qty * $item2->pieces_price}} </strong></p>
                                @php
                                $subtotal += $item2->pieces_price * $item2->qty;
                                @endphp
                                @endif
                                @endforeach
                            </div>

                        </div>
                        <!-- <div class="col-12 col-md-auto quantity-box">
                            <div class="product-quantity">
                                <div class="product-quantity-slider">
                                    <button class="decrement-btn" type="button">-</button>
                                    <input class="product-quantity" readonly type="text" value="{{$item->quantity}}" data-cart-item-id="{{$item->id}}">
                                    <button class="increment-btn" type="button">+</button>
                                </div>
                            </div>
                        </div> -->
                        @php
                        $encrypted_id = Crypt::encryptString($item->id);
                        @endphp
                        <div class="col-12 col-md-auto total-pr item-total">
                            {{$subtotal}} LE <br><span class="close"><a href="/Delete/Item/{{$encrypted_id}}"><svg xmlns="http://www.w3.org/2000/svg" fill="red" height="1.2em" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg></a></span>
                        </div>
                    </div>
                </div>
                @php
                $totalcart += $subtotal;
                @endphp
                @endforeach
                <!--compo cart item -->
                @php
                $composubtotal = 0;
                @endphp
                @foreach($compocart as $compo)
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-12 col-md-2">
                            <img class="img-fluid rounded-circle" src="{{asset('/compo_image/'.$compo->compo->image)}}">
                        </div>
                        <div class="col-12 col-md">
                            <div class="row text-muted">{{$compo->compo->name}}</div>
                            <div class="row">{{$compo->compo->total}}</div>

                            <div class="row">Order Details:
                                @foreach($compoItems as $compoItem)
                                @if($compoItem->compo_id == $compo->id)
                                <!-- @php
                                $composubtotal += $compoItem->total;
                                @endphp -->
                                @endif
                                @endforeach
                            </div>

                        </div>

                        @php
                        $encrypted_compo_id = Crypt::encryptString($compo->id);
                        @endphp
                        <div class="col-12 col-md-auto total-pr item-total ml-5">{{$compo->compo->total}} LE <br><span class="close"><a href="/Delete/compo/Item/{{$encrypted_compo_id}}"><svg xmlns="http://www.w3.org/2000/svg" fill="black" height="1.2em" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg></a></span>
                        </div>
                    </div>
                </div>
                @php
                $totalcompo += $compo->compo->total;
                @endphp
                @endforeach

                @php
                $total = $totalcompo + $totalcart;
                @endphp
                <div class="back-to-shop"><a href="{{url('/Menu')}}">&leftarrow;</a><span class="text-muted">Back to Menu</span></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS {{$cartCount}}</div>
                    <div class="col text-right" id="cart-total">{{$total}} LE</div>
                </div>
                <form method="post" action="{{url('/Order/Now')}}">
                    @csrf
                    <input type="hidden" value="{{$total}}" name="total_cart">
                    <p>Personal Infromation</p>
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                    <select class="form-control" id="citySelect" style="font-size: smaller;" onchange="updateShippingAndGrandTotal()" name="city">
                        <option class="text-muted" value="">Choose City</option>
                        @foreach($shipping_info as $item)
                        <option class="text-muted" value="{{$item->city_name}}">{{$item->city_name}} - {{$item->shipping_cost}} LE <br><span style="color: red important!;"> <br>{{$item->time_to_delivery}} hr </span>For Deliver</option>
                        @endforeach
                    </select>
                    <span style="color:red">
                        @error('city')
                        {{$message}}
                        @enderror
                    </span>
                    <select class="form-control" id="deliveryTimeSelect" onchange="updateShippingAndGrandTotal()" name="deliveryTime">
                        <option class="text-muted" value="">Choose Delivery Time</option>
                        @for ($i = 14; $i <= 24; $i++) <option value="{{ $i }}">{{ getTimeString($i) }}</option>
                            @endfor
                            <option value="1">1 AM</option>
                    </select>
                    <span style="color:red">
                        @error('deliveryTime')
                        {{$message}}
                        @enderror
                    </span>
                    <span id="deliveryTimeMessage" style="color:red">
                        Choose Delivery Time (2 PM - 1 AM)
                    </span>
                    <?php
                    function getTimeString($time)
                    {
                        if ($time === 12) {
                            return '12 PM';
                        } elseif ($time > 12) {
                            return ($time - 12) . ' PM';
                        } elseif ($time === 0) {
                            return '12 AM';
                        } else {
                            return $time . ' AM';
                        }
                    }
                    ?>
                    <script>
                        deliveryTimeSelect.addEventListener('change', function() {
                            var selectedValue = this.value;
                            var deliveryTimeMessage = document.getElementById('deliveryTimeMessage');
                            deliveryTimeMessage.textContent = "Pls note: We need at least 120 minutes to deliver for Damietta & New Damietta";
                        });
                    </script>
                   
                    <input type="text" name="address" class="form-control" placeholder="Address">
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">Shipping Cost </div>

                        <div class="col text-right" id="shippingCost"></div>
                        <input type="hidden" name="shippingCost" id="shippingCostInput" value="">
                    </div>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>
                        <div class="col text-right" id="grandtotal"></div>
                    </div>

                    <p>GIVE Coupon</p>

                    <div class="input-group">
                        <input id="code" name="coupon" class="form-control" placeholder="Enter your code">
                        <a href="#" class="btn btn-primary" id="checkBtn" style="display: flex;align-items: center;content: center;text-decoration: none;">Apply Coupon</a>
                    </div>
                    <div id="message"></div>

                    <input type="hidden" name="discountValue" id="discountValueInput">

                    <button class="btn2" type="submit">Order Now</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var incrementButtons = $('.increment-btn');
        var decrementButtons = $('.decrement-btn');
        var productQuantities = $('.product-quantity');

        incrementButtons.click(function() {
            var cartItemId = $(this).siblings('.product-quantity').data('cart-item-id');
            var productQuantity = $(this).siblings('.product-quantity');
            var itemTotal = $(this).parents('.main').find('.item-total');

            $.ajax({
                url: '/increment-cart-item',
                type: 'POST',
                data: {
                    cartItemId: cartItemId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    productQuantity.val(parseInt(productQuantity.val()) + 1);
                    itemTotal.text(data + ' LE');
                    updateCartTotal();
                    updateShippingAndGrandTotal();
                }
            });
        });

        decrementButtons.click(function() {
            var cartItemId = $(this).siblings('.product-quantity').data('cart-item-id');
            var productQuantity = $(this).siblings('.product-quantity');
            var itemTotal = $(this).parents('.main').find('.item-total');


            if (parseInt(productQuantity.val()) > 1) {
                $.ajax({
                    url: '/decrement-cart-item',
                    type: 'POST',
                    data: {
                        cartItemId: cartItemId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        productQuantity.val(parseInt(productQuantity.val()) - 1);
                        itemTotal.text(data + ' LE');
                        updateCartTotal();
                        updateShippingAndGrandTotal();
                    }
                });
            }
        });

        function updateCartTotal() {
            var cartTotal = 0;
            $('.item-total').each(function() {
                cartTotal += parseInt($(this).text());
            });
            $('#cart-total').text(cartTotal + ' LE');
        }

        // Call the updateShippingAndGrandTotal function when the page loads
        updateShippingAndGrandTotal();

        // Bind the function to the onchange event of the city select element
        $('#citySelect').change(function() {
            updateShippingAndGrandTotal();
        });
    });

    function updateShippingAndGrandTotal() {
        // Get the selected city and shipping cost
        var select = document.getElementById("citySelect");
        var selectedCity = select.options[select.selectedIndex].text;
        var shippingCost = parseFloat(selectedCity.split("-")[1].trim());

        // Update the shipping cost in the div
        var shippingCostDiv = document.getElementById("shippingCost");
        shippingCostDiv.textContent = shippingCost + " LE";
        var shippingCost = parseFloat($('#shippingCost').text());
        $('#shippingCostInput').val(shippingCost);
        // Get the current cart total
        var cartTotalDiv = document.getElementById("cart-total");
        var cartTotal = parseFloat(cartTotalDiv.textContent);

        // Calculate the new grand total
        var grandTotal = shippingCost + cartTotal;

        // Update the grand total in the div
        var grandTotalDiv = document.getElementById("grandtotal");
        grandTotalDiv.textContent = grandTotal + " LE";
    }
</script>
<script>
    $(document).ready(function() {
        // Disable the "Check Code" button initially
        $('#checkBtn').prop('disabled', true);

        // Function to check if all required fields are filled
        function checkFormValidity() {
            var name = $('input[name="name"]').val();
            var phone = $('input[name="phone"]').val();
            var city = $('#citySelect').val();
            var address = $('input[name="address"]').val();

            // Enable/disable the "Check Code" button based on form validity
            if (name && phone && city && address) {
                $('#checkBtn').prop('disabled', false);
            } else {
                $('#checkBtn').prop('disabled', true);
            }
        }

        // Bind the checkFormValidity function to the input field changes
        $('input[name="name"], input[name="phone"], #citySelect, input[name="address"]').on('input change', function() {
            checkFormValidity();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#checkBtn').click(function(e) {
            e.preventDefault(); // Prevent the default link behavior

            var code = $('#code').val();

            // Send the AJAX request
            $.ajax({
                url: '/check-coupon',
                type: 'POST',
                data: {
                    code: code
                },
                success: function(response) {
                    // Handle the server response
                    if (response.error) {
                        $('#message').text(response.error).removeClass('success').addClass('error').css({
                            'background-color': 'red',
                            'color': 'white',
                            'text-align': 'center'
                        });
                    } else {
                        var expirationDate = response.expiration_date;
                        var isActive = response.is_active;
                        var discountValue = response.discount_value;

                        // Subtract the discount value from the 'grandtotal' value
                        var grandtotal = parseFloat($('#grandtotal').text());
                        grandtotal -= discountValue;

                        // Update the 'grandtotal' element with the new value
                        $('#grandtotal').text(grandtotal.toFixed(2));
                        $('#discountValueInput').val(discountValue);
                        $('#message').text('Code is valid').removeClass('error').addClass('success').css({
                            'background-color': 'green',
                            'color': 'white',
                            'text-align': 'center'
                        });
                        $('#datesubmit').prop('disabled', true);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection