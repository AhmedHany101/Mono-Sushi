@extends('layout.user_layout')
@section('layout')
<style>
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
@if(session('error'))
<div id="errorMessage2" class="alert_danger">{{ session('error') }}</div>
<script>
    // Show the error message
    document.getElementById('errorMessage2').style.display = 'block';
    // Hide the error message after 5 seconds
    setTimeout(function() {
        document.getElementById('errorMessage2').style.display = 'none';
    }, 5000);
    console.log('err');
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
    console.log('err');
</script>
@endif
@if(session('success_message'))

<div class="alert" id="suceesMessage">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    {{session('success_message')}}
</div>
<!-- <div class="alert alert-primary alert-dismissable fade in" id="suceesMessage"> <button type="button" data-dismiss="alert" aria-label="close" class="close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> </div> -->
<!-- <div id="suceesMessage" class="alert alert-success" style="display:none;"></div> -->
<script>
    // Show the error message
    document.getElementById('suceesMessage').style.display = 'block';
    // Hide the error message after 5 seconds
    setTimeout(function() {
        document.getElementById('suceesMessage').style.display = 'none';
    }, 5000);
</script>
@endif
<section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('user_front/images/bg_5.jpg')}});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center mb-5">
                <h1 class="mb-2 bread">Contact us</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="{{url('/')}}">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact us <i class="fa fa-chevron-right"></i></span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row d-flex contact-info">
            <div class="col-md-12">
                <h2 class="h4 font-weight-bold">Contact Information</h2>
            </div>
            <div class="w-100"></div>
            <!-- <div class="col-md-3 d-flex">
       <div class="dbox">
         <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
       </div>
     </div> -->
            <div class="col-md-3 d-flex">
                <div class="dbox">
                    <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="dbox">
                    <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                </div>
            </div>
            <!-- <div class="col-md-3 d-flex">
                <div class="dbox">
                    <p><span>Website</span> <a href="#">yoursite.com</a></p>
                </div>
            </div> -->
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pt contact-section">
    <div class="container">
        <div class="row d-flex align-items-stretch no-gutters">
            <div class="col-md-6 p-5 order-md-last">
                <h2 class="h4 mb-5 font-weight-bold">Contact Us</h2>
                <form action="{{ url('/contact/form') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Your Name">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Your Phone">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Your Email">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                        @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="7" placeholder="Message"></textarea>
                        @error('message')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary py-3 px-5">Send Message</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex align-items-stretch">
                <div style="background-image: url({{asset('user_front/images/Google-Maps.jpg')}});height:100%;width:100%;background-repeat: no-repeat;background-size:contain;">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection