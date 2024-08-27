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
  .menu_title {
		text-align: center;
		/* padding-top: 30px; */
		text-decoration: underline;
		font-weight: bolder;
		text-transform: uppercase;
	}
  @media (min-width: 768px) {
  .compo {
    padding-top: 90px;
    padding-bottom: 30px;
  }
}
.compo {
    padding-bottom: 30px;
  }
.compobody {
		background-color: white;
	}
  body {
		background-color: #0E2D32;
	}
  .compo-content {
		border-bottom: 1px solid #F28439;
	}
  .view_btn:hover {
		color: #F28439 !important;
		border: 1px solid #F28439 !important;
	}
</style>
<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
<!-- success message  -->
<div id="succesmessage" class="alert alert-success" style="display:none;"></div>


<section class="mt-5 md-10 pd-5 compo">
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
		
	</div>
</section>


@endsection