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

	.compoImage {
		padding-top: 1px;
		overflow: hidden;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center center;
		height: 350px;
		width: 350px;
		position: relative;
		display: block;
	}

	/*@media (max-width: 768px) {*/
	/*    .compoImage {*/
	/*        height: 320px;*/
	/*        width: 320px;*/
	/*    }*/
	/*}*/
	.compoImage {
		padding-top: 1px;
		overflow: hidden;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		height: 350px;
		width: 350px;
		position: relative;
		display: flex;
		align-items: center !important;
		justify-content: center !important;
		text-align: center !important;
		margin: 0 auto !important;
		/* Added this line to center the anchor element horizontally */
	}

	@media (max-width: 768px) {
		.compoImage {
			height: 330px;
			width: 330px;
			align-items: center !important;
		}
	}

	/*.compobody {*/
	/*	background-color: #0E2D32;*/
	/*	border: 1px dotted #F28439;*/
	/*			align-items: center !important;*/

	/*}*/
	.compo-content {
		border-bottom: 1px solid #F28439;
	}

	.menu-details-container {
		margin-left: 10px;
		/* Adjust the value as per your preference */
	}

	.view_btn:hover {
		color: #F28439 !important;
		border: 1px solid #F28439 !important;
	}

	.compobody {
		background-color: #0E2D32;
		border: 1px dotted #F28439;
	}

	.menubody {
		border: 1px dotted #F28439;

	}

	.category_head {
		text-align: center;
		padding-top: 30px;

		font-weight: bolder;
		text-transform: uppercase;
	}

	.menu_title {
		text-align: center;
		padding-top: 30px;
		text-decoration: underline;
		font-weight: bolder;
		text-transform: uppercase;
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

	@media (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) {
		.carousel {
			display: none;
		}
	}

	.carousel-item {
		height: 90vh;
		background-size: cover;
		align-items: center;
	}

	@media (max-width: 768px) {
		.carousel-item {
			height: 60vh;

		}

	}
	.carousel-item  

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

	body {
		background-color: #0E2D32;
	}

	/* Default font size */
	.heading-section h2 {
		font-size: 20px;
	}

	/* Media query for iPhone 7 Plus screen */
	@media only screen and (max-width: 414px) {
		.heading-section h2 {
			font-size: 18px;
			padding-bottom: 0;
		}
	}

	/* Hide section on iPhone 6 Plus */
	@media (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) {
		.ftco-section {
			height: auto !important;
			padding: 0 !important;

		}

		.ftco-section .title {
			padding: 0 !important;
		}

		.ftco-section .viewMore {
			padding: 0 !important;
			margin: 0 !important;
			width: 100%;

		}
	}
</style>
<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
<!-- success message  -->
<div id="succesmessage" class="alert alert-success" style="display:none;"></div>
<!-- Carousel wrapper -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <picture>
        <source media="(min-width: 576px)" srcset="{{asset('user_front/images/7.jpg')}}">
        <img class="d-block w-100 h-100" src="{{asset('user_front/images/test2.jpg')}}" alt="First slide">
      </picture>
    </div>
    <div class="carousel-item">
      <picture>
        <source media="(min-width: 576px)" srcset="{{asset('user_front/images/7.jpeg')}}">
        <img class="d-block w-100 h-100" src="{{asset('user_front/images/7-mobile.jpeg')}}" alt="Second slide">
      </picture>
    </div>
    <div class="carousel-item">
      <picture>
        <source media="(min-width: 576px)" srcset="{{asset('user_front/images/9.jpeg')}}">
        <img class="d-block w-100 h-100" src="{{asset('user_front/images/9-mobile.jpeg')}}" alt="Second slide">
      </picture>
    </div>
    <div class="carousel-item">
      <picture>
        <source media="(min-width: 576px)" srcset="{{asset('user_front/images/4a.jpeg')}}">
        <img class="d-block w-100 h-100" src="{{asset('user_front/images/4a-mobile.jpeg')}}" alt="Second slide">
      </picture>
    </div>
    <div class="carousel-item">
      <picture>
        <source media="(min-width: 576px)" srcset="{{asset('user_front/images/1a.jpeg')}}">
        <img class="d-block w-100 h-100" src="{{asset('user_front/images/1a-mobile.jpeg')}}" alt="Second slide">
      </picture>
    </div>
    <div class="carousel-item">
      <picture>
        <source media="(min-width: 576px)" srcset="{{asset('user_front/images/2a.jpeg')}}">
        <img class="d-block w-100 h-100" src="{{asset('user_front/images/2a-mobile.jpeg')}}" alt="Second slide">
      </picture>
    </div>
    <div class="carousel-item">
      <picture>
        <source media="(min-width: 576px)" srcset="{{asset('user_front/images/3a.jpeg')}}">
        <img class="d-block w-100 h-100" src="{{asset('user_front/images/3a-mobile.jpeg')}}" alt="Second slide">
      </picture>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!-- Carousel wrapper -->
<!-- compo section -->
@if($compos->count() != 0)
<section class="mt-5 md-10 ">
	<div class="container">
		<h2 class="mb-4 menu_title">Our Compo</h2>
		<div class="row">
			@foreach($compos as $compo)
			<div class="col-md-8 col-lg-4 compobody p-0.5">
				<a href="{{url('/compo')}}" class="block-20 compoImage mt-2" style="background-image: url('{{asset('/compo_image/'.$compo->image)}}');"></a>
				<div class="compo-content">
					<div><a href="#" style="color: #F28439;">{{$compo->name}}</a></div>
					<div><a href="#" style="color: #F28439;">{{$compo->total}} LE</a></div>
				</div>
				<!--<div class="compo-items mt-1">-->
				<!--	@foreach($compo_items as $item)-->
				<!--	@if($compo->id == $item->compo_id)-->
				<!--	<div class="compo-item">-->
				<!--		<img src="{{asset('/compo_image/'.$item->set_image)}}" alt="" class="small-image">-->
				<!--		<img src="{{asset('/compo_image/'.$item->set_image)}}" alt="" class="large-image">-->
				<!--		<p style="color: #F28439;">{{$item->compo_set}}</p>-->
				<!--	</div>-->
				<!--	@endif-->
				<!--	@endforeach-->
				<!--</div>-->
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
		<div class="row justify-content-center" style="margin-top: 20px; margin-bottom: 10px;">
			<div class="col-md-4 text-center">
				<a href="{{url('/compo')}}" class="btn btn-primary view_btn">View More</a>
			</div>
		</div>
	</div>
</section>
@endif

<section class="mt-5 md-10">
	<div class="container">
		<h2 class="mb-4 menu_title">Our Menu</h2>
		<div class="row">
			@foreach($filteredCategories as $category)
			<div class="col-md-6 col-lg-4 menubody">

				<div class="d-flex align-items-center mt-2 m-2">
					<!--<img src="{{ asset('/category_images/'.$category->image) }}" style="height: 80px; width: 80px; border: none;" alt="image" class="me-4">-->
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
		<div class="row justify-content-center" style="margin-top: 20px; margin-bottom: 10px;">
			<div class="col-md-4 text-center">
				<a href="{{url('/Menu')}}" class="btn btn-primary view_btn">View More</a>
			</div>
		</div>
	</div>
</section>


<!-- offer -->
@if($offers->count() != 0)

<section class="mt-5 md-10 pd-5">
	<div class="container">
		<h2 class="mb-4 menu_title">Our Offer</h2>

		<div class="row">
			@foreach($offers as $offer)
			<div class="col-md-6 col-lg-4">
				<a href="{{url('/Menu')}}" class="block-20 compoImage" style="background-image: url('{{asset('/offers_images/'.$offer->image)}}');"></a>
				<div class="compo-content" style="border-top: 1px solid #000;">
					<div><a href="#" style="color: #F28439;">{{$offer->description}}</a></div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row justify-content-center" style="margin-top: 20px;margin-bottom: 10px;">
			<div class="col-md-4 text-center md-10">
				<a href="{{url('/Offer')}}" class="btn btn-primary view_btn">View More</a>
			</div>
		</div>
	</div>
</section>

@endif
<!-- <section class="ftco-section bg-light" style="background-color: #0E2D32 !important;">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-2">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<h2 class="mb-4">Mono Offers</h2>
			</div>
		</div>
		<div class="row">
			@foreach($offers as $offer)
			<div class="col-md-4 ftco-animate">
				<div class="blog-entry">
					<a href="{{url('/Menu')}}" class="block-20" style="background-image: url('{{asset('/offers_images/'.$offer->image)}}');">
					</a>
					<div class="text px-4 pt-3 pb-4">
						<div class="meta">
							<div><a href="#">{{$offer->description}}</a></div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4 text-center">
				<a href="{{url('/Offer')}}" class="btn btn-primary view_btn">View More</a>
			</div>
		</div>
	</div>
</section> -->
<!-- <section class="ftco-section ftco-no-pt ftco-no-pb ftco-intro bg-primary">
	<div class="container py-5">
		<div class="row py-2">
			<div class="col-md-12 text-center">
				<h2>We Make Delicious &amp; Nutritious Food</h2>
				<a href="#" class="btn btn-white btn-outline-white">Book A Table Now</a>
			</div>
		</div>
	</div>
</section> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var smallImages = document.querySelectorAll('.small-image');

		smallImages.forEach(function(image) {
			image.addEventListener('mouseover', function() {
				var largeImage = this.nextElementSibling;
				largeImage.style.display = 'block';
			});

			image.addEventListener('mouseout', function() {
				var largeImage = this.nextElementSibling;
				largeImage.style.display = 'none';
			});
		});
	});
</script>
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
						$('#cart_dropdown').load(location.href + ' #cart_dropdown');


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