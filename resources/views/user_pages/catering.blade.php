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

  .video-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
  }

  body {
    background-color: #0E2D32 !important;
  }

  .video-container video.responsive-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
</style>
<div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
<!-- success message  -->
<div id="succesmessage" class="alert alert-success" style="display:none;"></div>
@if($caterings->count() != 0)
<section class="mt-5 md-10" style="background-color: #0E2D32 !important;">
    @foreach($caterings as $catering)
      <section class="ftco-section" style="padding-top: 11%;">
        <div class="container">
          <div class="row d-flex">
            <div class="col-md-6 d-flex">
              <div class="img w-100 ml-md-2">
                <div class="video-container">
                  @php
                    $firstImage = $catering_images->where('catering_id', $catering->id)->first();
                    $posterImage = $firstImage ? asset('/catering_images/'.$firstImage->image) : '';
                  @endphp
                  <video class="responsive-video" controls poster="{{ $posterImage }}">
                    <source src="{{ asset('/catering_videos/' . $catering->video) }}" type="video/mp4">
                  </video>
                </div>
              </div>
            </div>
            <div class="col-md-6 ftco-animate makereservation p-4 p-md-2">
              <div class="heading-section ftco-animate mb-5">
                <h2 class="mb-2">Catering Event</h2>
                <p>{{$catering->description}}</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="" style="background-color: #0E2D32 !important;padding-top:0 !important;margin-bottom:5%">
        <div class="container">
          <div class="row">
            @foreach($catering_images as $catering_image)
              @if($catering_image->catering_id == $catering->id)
                <div class="col-md-4 ftco-animate">
                  <div class="blog-entry" style="height: 100%">
                    <a href="#" class="block-20" style="background-image: url('{{ asset('/catering_images/'.$catering_image->image) }}'); height: 40vh;"></a>
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </section>
    @endforeach
  </section>
  @else
<section class="ftco-section" style="padding-top: 11%;">
  <div class="container" style="align-items: center;text-align:center">
  <h2 class="mb-2">Coming Soon...</h2>
  </div>
</section>
@endif
@endsection