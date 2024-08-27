<!DOCTYPE html>
<html lang="en">

<head>
	<title>Mono Sushi</title>
	<link rel="icon" type="image/png" href="{{asset('user_front/images/mono_logo_icon.png')}}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">-->
	<!--<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">-->
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">-->

	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->

	<link rel="stylesheet" href="{{asset('user_front/css/animate.css')}}">

	<link rel="stylesheet" href="{{asset('user_front/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('user_front/css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('user_front/css/magnific-popup.css')}}">

	<link rel="stylesheet" href="{{asset('user_front/css/bootstrap-datepicker.css')}}">
	<link rel="stylesheet" href="{{asset('user_front/css/jquery.timepicker.css')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="{{asset('user_front/css/flaticon.css')}}">
	<link rel="stylesheet" href="{{asset('user_front/css/style.css')}}">

	<style>
		@media (min-width: 767px) {
			.cart {
				align-items: center;
			}
		}

		.float {
			position: fixed;
			width: 60px;
			height: 60px;
			bottom: 80px;
			right: 20px;
			background-color: #25d366;
			color: #FFF;
			border-radius: 50px;
			text-align: center;
			font-size: 30px;
			box-shadow: 2px 2px 3px green;
			z-index: 100;
		}

		.my-float {
			margin-top: 16px;
		}

		.alert {
			position: fixed;
			top: 20px;
			right: 20px;
			padding: 20px;
			background-color: green;
			/* Red */
			color: white;
			margin-bottom: 15px;
			z-index: 9999999;
		}

		/* The close button */
		.closebtn {
			margin-left: 15px;
			color: white;
			font-weight: bold;
			float: right;
			font-size: 22px;
			line-height: 20px;
			cursor: pointer;
			transition: 0.3s;
		}
	</style>
	<style>
		/* Add the following CSS styles */
		/* @media (max-width: 767px) {
  .sticky-navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
  }
} */
		.btn:hover {
			color: white !important;
		}

		@media (max-width: 767.98px) {
			.navbar {
				position: sticky !important;
				top: 0 !important;
				z-index: 1000 !important;
				-webkit-transform: translateZ(0) !important;
			}

			@media (prefers-reduced-motion: reduce) {
				.navbar {
					transition: none !important;
				}
			}
		}

		.button-container {
			position: fixed;
			bottom: 0px;
			left: 20px;
			z-index: 999999999999999;
		}

		.button {
			display: inline-block;
			padding: 10px 20px;
			background-color: #F28439;
			color: white;
			text-decoration: none;
			border-radius: 50%;
			text-align: center;
			font-weight: bolder;
		}

		/* Styles for mobile screens */
		@media (max-width: 767px) {
			.button-container {
				width: 100%;
				left: 0;
				text-align: center;
			}

			.button {
				border-radius: 0;
				width: 100%;
			}
		}

		.alert {
			position: fixed;
			top: 20px;
			right: 20px;
			padding: 20px;
			background-color: green;
			/* Red */
			color: white;
			margin-bottom: 15px;
			z-index: 9999999;
		}

		.alert_danger {
			position: fixed;
			top: 20px;
			right: 20px;
			padding: 20px;
			background-color: red;
			/* Red */
			color: white;
			margin-bottom: 15px;
			z-index: 9999999;
		}

		/* The close button */
		.closebtn {
			margin-left: 15px;
			color: white;
			font-weight: bold;
			float: right;
			font-size: 22px;
			line-height: 20px;
			cursor: pointer;
			transition: 0.3s;
		}

		#ftco-loader {
			position: fixed;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			z-index: 99999999999999;
			background: black;
			opacity: 1;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.loader-content {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
			position: relative;
		}

		.loader-content img {
			max-width: 200px;
		}

		.loader-content::after {
			content: "";
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 200px;
			height: 200px;
			background: radial-gradient(circle, transparent 0%, #F28439 50%, #F28439 100%);
			border-radius: 50%;
			animation: sunlight 2s linear infinite;
		}

		.modal {
			display: none;
			position: fixed;
			z-index: 9999;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.6);
		}

		.modal-content {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			background-color: #fefefe;
			width: 90%;
			height: 95%;
			padding: 20px;
		}

		.menupdf {
			cursor: pointer;
		}

		.close {
			position: absolute;
			top: 10px;
			right: 3px;
			font-size: 24px;
			font-weight: bold;
			cursor: pointer;
			margin: 10px;
			background-color: red;
			padding: 5px;
			color: white;
			z-index: 999;
		}

		#demoIframe {
			display: block;
			width: 100%;
			height: 100%;
		}

		@keyframes sunlight {
			0% {
				transform: translate(-50%, -50%) scale(0);
				opacity: 1;
			}

			50% {
				transform: translate(-50%, -50%) scale(1.3);
				opacity: 0.8;
			}

			100% {
				transform: translate(-50%, -50%) scale(2);
				opacity: 0;
			}
		}


		.lightBTn .button {
			color: black !important;
			background: #F28439;
			box-shadow: 0 0 70px rgba(242, 132, 57, 1);
			transition: box-shadow 2s;
			animation: sun-animation 2s infinite;
		}

		@keyframes sun-animation {

			0%,
			50% {
				box-shadow: 0 0 60px rgba(242, 132, 57, 0);
				background: #F28439;
			}

			25%,
			75% {
				box-shadow: 0 0 80px rgba(242, 132, 57, 1);
				background: #F28439;
			}

			100% {
				box-shadow: 0 0 150px rgba(242, 132, 57, 0);
				background: #F28439;
			}
		}

		.lightbtn:hover {
			background-color: #F28439;
			box-shadow: 0 0 10px #F28439, 0 0 40px #F28439, 0 0 60px #F28439;
			align-items: center;
			text-align: center;
			font-size: larger;

			color: black !important;

		}

		.l:hover {
			color: black !important;
			font-size: larger;
		}


		/* .lightBTn .button::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 200px;
    height: 200px;
    background-color: #F28439;
    border-radius: 50%;
    opacity: 1;
    animation: lightEffect 1s linear infinite;
}

@keyframes lightEffect {
    0% {
        transform: translate(-50%, -50%) scale(0);
        opacity: 1;
    }
    50% {
        transform: translate(-50%, -50%) scale(1.3);
        opacity: 0.8;
    }
    100% {
        transform: translate(-50%, -50%) scale(2);
        opacity: 0;
    }
} */
	</style>

</head>

<body>
	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen">
		<div class="loader-content">
			<img src="{{asset('user_front/images/mono_logo_icon.png')}}" alt="Logo">
		</div>
	</div>

	<script>
		$(document).ready(function() {
			// Show the loading icon immediately
			$('#ftco-loader').show();

			// Hide the loading icon after a delay when the page is fully loaded
			$(window).on('load', function() {
				setTimeout(function() {
					$('#ftco-loader').fadeOut('slow');
				}, 2000); // Adjust the delay time (in milliseconds) as desired
			});
		});
	</script>
	@if(session('error'))
	<div id="errorMessage2" class="alert_danger">{{ session('error') }}</div>
	<script>
		// Show the error message
		document.getElementById('errorMessage2').style.display = 'block';
		// Hide the error message after 5 seconds
		setTimeout(function() {
			document.getElementById('errorMessage2').style.display = 'none';
		}, 5000);
	</script>
	@endif
	@if(session('error_message'))
	<div id="errorMessage" class="alert_danger">{{ session('error_message') }}</div>
	<script>
		// Show the error message
		document.getElementById('errorMessage').style.display = 'block';
		// Hide the error message after 5 seconds
		setTimeout(function() {
			document.getElementById('errorMessage').style.display = 'none';
		}, 5000);
	</script>
	@endif
	@if(session('success_message'))

	<div class="alert" id="suceesMessage">
		<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
		{{session('success_message')}}
	</div>
	<script>
		// Show the error message
		document.getElementById('suceesMessage').style.display = 'block';
		// Hide the error message after 5 seconds
		setTimeout(function() {
			document.getElementById('suceesMessage').style.display = 'none';
		}, 5000);
	</script>
	@endif
	<div class="wrap">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-12 col-md d-flex align-items-center">
					<p class="mb-0 phone"><span class="mailus">Phone no:</span> <a href="#">+201553990994</a> and <span class="mailus">Phone no:</span> <a href="#">+201065005302</a></p>
				</div>
				<div class="col-12 col-md d-flex justify-content-md-end">
					<!-- <p class="mb-0">Mon - Fri / 9:00-21:00, Sat - Sun / 10:00-20:00</p> -->
					<div class="social-media">
						<p class="mb-0 d-flex">
							<a href="https://www.facebook.com/profile.php?id=100089573547708&mibextid=LQQJ4d" class="d-flex align-items-center justify-content-center">
								<span> <svg xmlns="http://www.w3.org/2000/svg" height="1.1em" fill="white" viewBox="0 0 512 512">
										<path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
									</svg></span>
							</a>
							<a href="https://www.tiktok.com/@monosushi__?_t=8fneq9oVj9R&_r=1" class="d-flex align-items-center justify-content-center">
								<span class="fab fa-tiktok"></span>
								<i class="sr-only">Tiktok</i>
							</a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="d-flex align-items-center justify-content-center"><span>
									<svg xmlns="http://www.w3.org/2000/svg" height="1.1em" fill="white" viewBox="0 0 448 512">
										<path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
									</svg>
								</span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('user_front/images/mono_logo.png')}}" alt="" style="width: 80px;height:80px;"></a>
			<button class="navbar-toggler" style="border: none;" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> <i class="fa fa-bars" style="color: #CB8C61;font-size: 30px; align-items: center;"></i>
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto cart">
					<li class="nav-item"><a href="{{url('/')}}" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="{{url('/compo')}}" class="nav-link">Compo</a></li>
					<li class="nav-item"><a href="{{url('/Offer')}}" class="nav-link">Offer</a></li>
					<li class="nav-item"><a href="{{url('/Catreing')}}" class="nav-link">Catreing</a></li>
					<style>
						/* .lightbtn {
							transition: background-color 1s, box-shadow 1s;
							background-color: #F28439;
							box-shadow: 0 0 10px #F28439, 0 0 40px #F28439, 0 0 80px #F28439;
						} */
					</style>
					<ul class="navbar-nav">
						<li class="nav-item lightbtn">
							<a href="{{url('/Menu')}}" class="nav-link l">Order Now</a>
						</li>
					</ul>
					<li class="nav-item">
						<a href="{{ asset('menuPdf/Mono.pdf') }}" class="nav-link menupdf" style="">Menu</a>
					</li>

					<div id="demoModal" class="modal">
						<div class="modal-content">
							<span class="close" onclick="closeModal()">&times;</span>
							<iframe id="demoIframe" frameborder="0"></iframe>
						</div>
					</div>

					<script>
						function showDemo(url) {
							var modal = document.getElementById('demoModal');
							var iframe = document.getElementById('demoIframe');
							iframe.src = url;
							modal.style.display = 'block';
						}

						function closeModal() {
							var modal = document.getElementById('demoModal');
							var iframe = document.getElementById('demoIframe');
							iframe.src = '';
							modal.style.display = 'none';
						}
					</script>

					@guest
					<li class="nav-item"><a href="{{url('/Register')}}" class="nav-link">Register</a></li>
					<li class="nav-item"><a href="{{url('/Login')}}" class="nav-link">Login</a></li>
					@endguest
					@auth
					<div class="dropdown" id="cart_dropdown">
						<a class="nav-link" href="#" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" fill="#F28439" height="1em" viewBox="0 0 576 512">
								<!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
								<path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
							</svg>
							<span class="badge badge-primary">{{$cartCount}}</span>
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="cart-box">
							@php $total=0; @endphp
							@foreach($cart as $item)
							<a class="dropdown-item" href="#">
								<img src="{{asset('/dishes_images/'.$item->product->image)}}" alt="Item 1" width="50" style="border-radius: 50%;">
								<span class="quantity">{{$item->product->name}} </span>
								<!-- Replace '$10.99' with the actualprice -->
							</a>
							@endforeach
							@foreach($compoCart as $compo)
							<a class="dropdown-item" href="#">
								<img src="{{asset('/compo_image/'.$compo->compo->image)}}" alt="Item 1" width="50" style="border-radius: 50%;">
								<span class="quantity">{{$compo->compo->name}} </span>
								<!-- Replace '$10.99' with the actual price -->
							</a>
							@endforeach
							<hr>

							<!-- <span style="color: #F28439; text-align: center; display: block; margin: 0;">Total:{{$total}} </span> -->
							<small style="text-align: center; display: block;"><a href="{{url('/CheckOut')}}" style="text-decoration: underline;"> CheckOut </a></small>
						</div>
					</div>
					<li class="nav-item"><a href="{{route('logout')}}" class="nav-link">Logout</a></li>
					@endauth
					<li class="nav-item"><a href="{{url('/ContactUs')}}" class="nav-link">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	@auth
	@if($cartCount == 0)
	<div class="button-container lightBTn">
		<a href="{{url('/Menu')}}" class="button">ORDER NOW</a>
	</div>
	@else
	<div class="button-container lightBTn">
		<a href="{{url('/CheckOut')}}" class="button">CheckOut</a>
	</div>
	@endif
	@endauth
	@guest
	<div class="button-container lightBTn">
		<a href="{{url('/Menu')}}" class="button">ORDER NOW</a>
	</div>
	@endguest

	@yield('layout')
	<a href="https://wa.me//201065005302" class="float" target="_blank">
		<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 448 512" style="color: white; width: 30px; height: 30px;"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
			<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
		</svg>
	</a>
	<footer class="ftco-footer ftco-no-pb ftco-section">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-6 col-lg-3">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">MONO SUSHI</h2>
						<p>At Mono Sushi, we offer a delicious selection of handcrafted sushi rolls made with fresh ingredients. Our menu includes classic favorites and unique creations, all carefully crafted by skilled chefs. Order now and enjoy the taste of Japan with us .</p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
							<li class="ftco-animate"><a href="https://www.tiktok.com/@monosushi__?_t=8fneq9oVj9R&_r=1" style="text-align: center;"><svg xmlns="http://www.w3.org/2000/svg" height="1.1em" fill="white" viewBox="0 0 448 512">
										<path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
									</svg></a></li>
							<li class="ftco-animate"><a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" style="text-align: center;"><svg xmlns="http://www.w3.org/2000/svg" height="1.1em" fill="white" viewBox="0 0 448 512">
										<path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
									</svg></a></li>
							<li class="ftco-animate"><a href="https://www.facebook.com/profile.php?id=100089573547708&mibextid=LQQJ4d" style="text-align: center;">
									<svg xmlns="http://www.w3.org/2000/svg" height="1.1em" fill="white" viewBox="0 0 512 512">
										<path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
									</svg>
								</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2"></h2>
						<ul class="list-unstyled open-hours">
							<li class="d-flex"><span>Phone</span><span>01553990994</span></li>
							<li class="d-flex"><span>WhatsApp</span><span>01065005302</span></li>
							<li class="d-flex"><span>Email</span><span><a href="mailto:info@mono-sushi.com" style="text-decoration: none;">info@mono-sushi.com</a></span></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Instagram</h2>
						<div class="thumb d-flex">
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/12.png')}});"></a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/10.png')}});"></a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/11.png')}});"></a>
						</div>
						<div class="thumb d-flex">
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/9.jpg')}});"></a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/8.jpg')}});"></a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/7.jpg')}});"></a>
						</div>
						<div class="thumb d-flex">
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/6.jpg')}});"></a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/5.jpg')}});"></a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/4.jpg')}});"></a>
						</div>
						<div class="thumb d-flex">
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/3.png')}});"></a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/2.png')}});"></a>
							<a href="https://instagram.com/monosushi__?igshid=NGVhN2U2NjQ0Yg==" class="thumb-menu img" style="background-image: url({{asset('user_front/images/1.png')}});"></a>
						</div>
					</div>
				</div>
				<!-- <div class="col-md-6 col-lg-3">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Newsletter</h2>
						<p>Far far away, behind the word mountains, far from the countries.</p>
						<form action="#" class="subscribe-form">
							<div class="form-group">
								<input type="text" class="form-control mb-2 text-center" placeholder="Enter email address">
								<input type="submit" value="Subscribe" class="form-control submit px-3">
							</div>
						</form>
					</div>
				</div> -->
			</div>
		</div>
		<div class="container-fluid px-0 bg-primary py-3">
			<div class="row no-gutters">
				<div class="col-md-12 text-center">

					<p class="mb-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;Mono Sushi <script>
							document.write(new Date().getFullYear());
						</script> All rights reserved
						<!-- <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://www.icanforsoftware.com/" target="_blank">ICANFORSOFTWARE</a> -->
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</div>
	</footer>





	<script src="{{asset('user_front/js/jquery.min.js')}}"></script>
	<script src="{{asset('user_front/js/jquery-migrate-3.0.1.min.js')}}"></script>
	<script src="{{asset('user_front/js/popper.min.js')}}"></script>
	<script src="{{asset('user_front/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('user_front/js/jquery.easing.1.3.js')}}"></script>
	<script src="{{asset('user_front/js/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('user_front/js/jquery.stellar.min.js')}}"></script>
	<script src="{{asset('user_front/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('user_front/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('user_front/js/jquery.animateNumber.min.js')}}"></script>
	<script src="{{asset('user_front/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{asset('user_front/js/jquery.timepicker.min.js')}}"></script>
	<script src="{{asset('user_front/js/scrollax.min.js')}}"></script>
	<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>-->
	<script src="{{asset('user_front/js/google-map.js')}}"></script>
	<script src="{{asset('user_front/js/main.js')}}"></script>

</body>

</html>