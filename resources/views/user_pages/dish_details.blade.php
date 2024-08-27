@extends('layout.user_layout')
@section('layout')
<style>
    .container2 {
        display: flex;
        flex-wrap: wrap;
    }

    .product {
        flex: 1;
        padding: 20px;
        border: 1px solid #ccc;
        min-width: 300px;
        box-sizing: border-box;
        text-align: center;
    }

    .product img {

        margin-bottom: 10px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
    }

    .form {
        flex: 1;
        padding: 20px;
        border: 1px solid #ccc;
        min-width: 300px;
        box-sizing: border-box;
    }

    .form input {
        margin-bottom: 10px;
    }

    .product,
    .form {
        min-width: 300px;
        box-sizing: border-box;
    }

    .rotate-img {
        animation: rotate 3s linear infinite;
    }

    #errorMessage {
        position: fixed;
        top: 10%;
        background-color: red;
        color: white;
        width: 100%;
        text-align: center;
        z-index: 9999;
    }

    #succesmessage {
        position: fixed;
        top: 10%;
        width: 100%;
        text-align: center;
        z-index: 9999;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* .quantity-container .input-group-prepend {
    margin-right: 10px;
}

.quantity-container .input-group-append {
    margin-left: 10px;
} */
</style>
<style>
    .inc_dec {
        display: flex;
        align-items: center;
    }

    .inc_dec label {
        margin-right: 5px;
    }

    .inc_dec input {
        width: 56px;
        height: 40px;
        text-align: center;
    }

    .inc_dec .button-container {
        display: flex;
    }

    .inc_dec .button-container button {
        width: 30px;
        height: 47px;
        margin: 0 5px;
    }

    .inc_dec .button-container #incrementBtn {
        order: -1;
    }
</style>
<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
<!-- success message  -->
<div id="succesmessage" class="alert alert-success" style="display:none;"></div>


<style>
	.carousel-item {
		height: 90vh;
		background-size: cover;
	}

	@media (max-width: 768px) {
		.carousel-item {
			height: 60vh;

		}

	}
</style>
<section class="ftco-section"  style="background-color: #0E2D32 !important;">
    <div class="container container2" style="margin-top:90px">
        <div class="product">
            <img src="{{ asset('dishes_images/' . $dish_data->image) }}" alt="Product Image" class="rotate-img ">
            <h2>{{$dish_data->name}}</h2>
            <h3>{{$dish_data->component}}</h3>
        </div>

        <div class="form">
            <h3>Choose Quantity</h3>
            <form id="form">

                <input type="hidden" name="product_id" value="{{$dish_data->id}}">
                @foreach($pieces_data as $index => $item)
                <div class="form-group row">
                    <div class="col-md-5">
                        <strong style="color: #fff;">Offer</strong>
                        <br>
                        <input type="checkbox" id="checkboxOption{{$index}}" name="pieces_no[]" value="{{$item['pieces_no']}}" {{$loop->first ? 'checked' : ''}}>
                        <input type="hidden" name="pieces_price[]" value="{{$item['pieces_price']}}">
                        <label for="checkboxOption{{$index}}" style="color: #fff;">{{$item['pieces_no']}} Pieces &nbsp; &nbsp; &nbsp; {{$item['pieces_price']}} LE</label>
                    </div>
                    <div class="col-md-5 quantity-container">
                        <label for="" style="color: #fff;">Quantity:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button id="incrementBtn{{$index}}" type="button" class="btn btn-primary incrementBtn">+</button>
                            </div>
                            <input readonly id="quantity{{$index}}" class="form-control quantity-input" name="qty[]" min="1" max="10" value="1">
                            <div class="input-group-append">
                                <button id="decrementBtn{{$index}}" type="button" class="btn btn-primary decrementBtn">-</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <button id="add-input-btn" type="submit" class="btn btn-primary">Add To Cart</button>
            </form>

        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    document.querySelectorAll(".incrementBtn").forEach(function(incrementBtn) {
        incrementBtn.addEventListener("click", function(event) {
            event.preventDefault();
            var quantityInput = this.parentNode.nextElementSibling;
            var currentValue = parseInt(quantityInput.value);
            if (currentValue < 10) {
                quantityInput.value = currentValue + 1;
            }
        });
    });

    document.querySelectorAll(".decrementBtn").forEach(function(decrementBtn) {
        decrementBtn.addEventListener("click", function(event) {
            event.preventDefault();
            var quantityInput = this.parentNode.previousElementSibling;
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    });
</script>
<script>
    // jQuery code to handle the form submission
    $(document).ready(function() {
        // Get the CSRF token value from the meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#form').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this); // Create a new FormData object with the form data

            $.ajax({
                url: '/add/product/to/cart/' + $('input[name="product_id"]').val(), // Replace with your desired URL
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Set the CSRF token header
                },
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 'success') {
                        // Show success message
                        $('#succesmessage').text(response.message).addClass('success').show();
                        setTimeout(function() {
                            $('#succesmessage').fadeOut('slow').removeClass('success error');
                        }, 3000);

                        // Update the cart count element with the new count value
                        // $('#cart-count').text(response.cartCount);

                        // Update the cart items element with the new items data
                        // $('#cart-items').html(response.cartItemsHtml);

                        // Update the cart total element with the new total value
                        // $('#cart-total').text(response.cartTotal.toFixed(2));

                        // Fetch and update the cart dropdown HTML
                        $.get(location.href + ' #cart_dropdown', function(data) {
                            $('#cart_dropdown').replaceWith($(data).find('#cart_dropdown'));
                        });

                        // Fetch and update the badge HTML
                        $.get(location.href + ' .badge', function(data) {
                            $('.badge').replaceWith($(data).find('.badge'));
                        });
                      
                    } else {
                        // Show error message
                        $('#errorMessage').text(response.message2).show();
                        setTimeout(function() {
                            $('#errorMessage').fadeOut('slow');
                        }, 3000);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Show error message
                    $('#errorMessage').text('some thing rong !').show();
                    setTimeout(function() {
                        $('#errorMessage').fadeOut('slow');
                    }, 3000);
                    $.get(location.href + ' #cart_dropdown', function(data) {
                        $('#cart_dropdown').replaceWith($(data).find('#cart_dropdown'));
                    });

                }

            });
        });
    });
</script>
@endsection