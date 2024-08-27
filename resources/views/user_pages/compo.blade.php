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
  background-position: center;
  height: 350px;
  width: 350px;
  position: relative;
  display: flex;
  align-items: center !important;
  justify-content: center !important;
  text-align: center !important;
  margin: 0 auto !important; /* Added this line to center the anchor element horizontally */
}
@media (max-width: 768px) {
    .compoImage {
        height: 330px;
        width: 330px;
        	align-items: center !important;
    }
}

	.compobody {
		background-color: #0E2D32;
		border: 1px dotted #F28439;
				align-items: center !important;

	}
  body {
		background-color: #0E2D32;
	}
  .menu_title {
		text-align: center;
		/* padding-top: 30px; */
		text-decoration: underline;
		font-weight: bolder;
		text-transform: uppercase;
		color: white !important;
	}
  @media (min-width: 768px) {
  .compo {
    padding-top: 90px;
    padding-bottom: 30px;
  }
}

</style>


<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
<!-- success message  -->
<div id="succesmessage" class="alert alert-success" style="display:none;"></div>

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

<section class="mt-5 md-5 compo" >
	<div class="container">
  <h2 class="mb-4 menu_title">Our Compo</h2>
		<div class="row">
			@foreach($compos as $compo)
			<div class="col-md-6 col-lg-4 compobody">
				<a href="{{url('/compo')}}" class="block-20 compoImage mt-2" style="background-image: url('{{asset('/compo_image/'.$compo->image)}}');"></a>
				<div class="compo-content">
					<div><a href="#" style="color: #F28439;">{{$compo->name}}</a></div>
					<div><a href="#" style="color: #F28439;">{{$compo->total}} LE</a></div>
				</div>
				<form id="form-{{$compo->id}}">
					<input type="hidden" name="compo_id" value="{{$compo->id}}">
					<p class="clearfix">
						<button type="submit" class="btn btn-primary lightbtn">Add To Cart</button>
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