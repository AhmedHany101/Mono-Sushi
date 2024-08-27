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
    <style>
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .input-error {
            border-color: red;
        }
    </style>
    <!-- Custom fonts for this template-->
    <link href="{{asset('admin_front/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('admin_front/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary" style="  background-color: #0C2F35;
  background-image: linear-gradient(180deg,#0C2F35 10%,#F28439 100%);">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="{{url('/signup')}}" method="post" onsubmit="return validateForm()">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control form-control-user" id="exampleInputEmail" placeholder="Name" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" required>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">

                                        <span id="error-message" class="error-message"></span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" style="background-color:#F28439;border: 1px solid #F28439;">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{url('/Login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("exampleInputPassword").value;
            var repeatPassword = document.getElementById("exampleRepeatPassword");
            var errorMessage = document.getElementById("error-message");

            if (password !== repeatPassword.value) {
                repeatPassword.classList.add("input-error");
                errorMessage.textContent = "Passwords do not match!";
                return false; // Prevent form submission
            } else {
                repeatPassword.classList.remove("input-error");
                errorMessage.textContent = "";
            }

            return true; // Allow form submission
        }
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin_front/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin_front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin_front/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin_front/js/sb-admin-2.min.js')}}"></script>

</body>

</html>