@extends('layout.user_layout')
@section('layout')

<style>
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

	body {
		background-color: #0E2D32;
	}

	.menubody {
		border: 1px solid #F28439;

	}

	.menu_title {
		text-align: center;
		padding-top: 30px;
		text-decoration: underline;
		font-weight: bolder;
		text-transform: uppercase;
	}

	.menu {
		margin-top: 20px;
	}

	@media (min-width: 768px) {
		.menu {
			padding-top: 90px;
			padding-bottom: 30px;
		}
	}

	@media (min-width: 768px) {
		.compo {
			padding-top: 90px;
			padding-bottom: 30px;
		}
	}

	.small-image {
		width: 70px;
		height: 70px;
		border-radius: 50%;
	}

	.large-image {
		display: none;
		position: absolute;
		top: 60px;
		left: 50px;
		width: 300px;
		height: 300px;
	}

	.compoImage {
		padding-top: 1px;
		overflow: hidden;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center center;
		height: 300px;
		position: relative;
		display: block;
	}

	.compobody {
		background-color: #0E2D32;
		border: 1px dotted #F28439;
	}
</style>
<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
<!-- success message  -->
<div id="succesmessage" class="alert alert-success" style="display:none;"></div>
<section class="mt-5 md-10 menu">
	<div class="container">
		<h2 class="mb-4 menu_title">Our Menu</h2>

		<div class="row">
			@foreach($filteredCategories as $category)
			<div class="col-md-6 col-lg-4 menubody m-2">

				<div class="d-flex align-items-center mt-2 m-2">
					<img src="{{ asset('/category_images/'.$category->image) }}" style="height: 80px; width: 80px; border: none;" alt="image" class="me-4">
					<h3 class="mb-2 category_head m-2">{{ $category->name }}</h3>
				</div>
				<hr style="border-color: #F28439;">
				@foreach($dishes_data as $dish)
				@if($dish->category_id == $category->id)
				@php
				$encrypted_id = Crypt::encryptString($dish->id);
				@endphp
				<div class="menus d-flex ftco-animate">
					<a href="Dish/Details/{{$encrypted_id}}" style="text-decoration: none;" class="d-flex align-items-center">
						<div class="menu-img img mr-2" style="background-image: url('{{asset('/dishes_images/'.$dish->image)}}');"></div>
						<div class="menu-details-container">
							<div class="d-flex">
								<div class="one-half">
									<h3>{{$dish->name}}</h3>
								</div>
							</div>
							<p style="color:#F28439 !important;">{{$dish->component}}</p>
							<p style="color:#F28439 !important; font-size: 11px; white-space: nowrap; overflow-x: auto;width:100%">
								@foreach($pieces_data as $Pices)
								@if($Pices->dish_id == $dish->id)
								<span style="display: inline-block; margin-right: 10px;">{{$Pices->pieces_no}} Pieces {{$Pices->pieces_price}} LE</span>
								@endif
								@endforeach
							</p>
						</div>
					</a>
				</div>
				@endif
				@endforeach
			</div>
			@endforeach
		</div>

	</div>
</section>
<section class="mt-5 md-5 compo">
	<div class="container">
		<h2 class="mb-4 menu_title">Our Compo</h2>
		<div class="row">
			@foreach($compos as $compo)
			<div class="col-md-6 col-lg-4 compobody m-2">
				<a href="{{url('/compo')}}" class="block-20 compoImage mt-2" style="background-image: url('{{asset('/compo_image/'.$compo->image)}}');"></a>
				<div class="compo-content">
					<div><a href="#" style="color: #F28439;">{{$compo->name}}</a></div>
					<div><a href="#" style="color: #F28439;">{{$compo->total}} LE</a></div>
				</div>
				<div class="compo-items mt-1">
					@foreach($compo_items as $item)
					@if($compo->id == $item->compo_id)
					<div class="compo-item">
						<img src="{{asset('/compo_image/'.$item->set_image)}}" alt="" class="small-image">
						<img src="{{asset('/compo_image/'.$item->set_image)}}" alt="" class="large-image">
						<p style="color: #F28439;">{{$item->compo_set}}</p>
					</div>
					@endif
					@endforeach
				</div>
				<form id="form-{{$compo->id}}">
					<input type="hidden" name="compo_id" value="{{$compo->id}}">
					<p class="clearfix">
						<button type="submit" class="btn btn-primary">Add To Cart</button>
						<!-- <a href="#" class="float-right meta-chat"><span class="fa fa-comment"></span> 3</a> -->
					</p>
				</form>

			</div>
			@endforeach
		</div>
	</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    // Get the CSRF token value from the meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('form').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();
        var compo_id = $(this).find('input[name="compo_id"]').val();

        $.ajax({
            url: '/add/compo/to/cart/' + compo_id,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            success: function(response) {
                if (response.status == 'success') {
                    // Show success message
                    $('#succesmessage').text(response.message).addClass('success').show();
                    setTimeout(function() {
                        $('#succesmessage').fadeOut('slow').removeClass('success error');
                    }, 3000);

                    // Refresh the cart icon by updating its count
                    var cartCount = parseInt($('.badge').text());
                    $('.badge').text(cartCount + 1);

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
                $('#succesmessage').text('Something went wrong!').show();
                setTimeout(function() {
                    $('#succesmessage').fadeOut('slow');
                }, 3000);
            }
        });
    });
});
</script>
@endsection