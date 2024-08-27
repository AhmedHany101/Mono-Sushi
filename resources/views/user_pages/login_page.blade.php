<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mono Sushi</title>
    <link rel="icon" type="image/png" href="{{asset('user_front/images/mono_logo_icon.png')}}">

    <!-- Custom fonts for this template-->
    <link href="{{asset('admin_front/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('admin_front/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        .alert {
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

        .closebtn:hover {
            color: black;
        }
    </style>
</head>

<body class="bg-gradient-primary" style="  background-color: #0C2F35;
  background-image: linear-gradient(180deg,#0C2F35 10%,#F28439 100%);">

    <div class="container">
        @if(session('message2'))
        <div class="alert" id="suceesMessage">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{session('message2')}}
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
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{url('/signin')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" required>
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block" style="background-color:#F28439 ;">
                                            Login

                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <!-- <a class="small" href="forgot-password.html">Forgot Password?</a> -->
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{url('/Register')}}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin_front/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin_front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin_front/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin_front/js/sb-admin-2.min.js')}}"></script>

</body>

</html>