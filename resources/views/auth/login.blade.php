

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Gymove - Fitness Bootstrap Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{asset('dash/css/style.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<style>

body{
    background: #2b8a82;
}

input{
    outline: none;
    border-radius: 3px !important;
    color: #464646 !important;
    letter-spacing: 1.5px;
}

input[type="checkbox"]::after{
    background: transparent !important;
    /* border: 2px solid #317973ab; */
    outline: none !important;
}

button[type="submit"]{
    border-radius: 3px !important;
    margin: 0 auto;
    width: 50% !important;
    letter-spacing: 2px;
    background: #ffffffbb !important;
    color: #2b2b2b !important;
}

.container{
    background: #2b8a82;
}

.authincation-content{
    background: #2b8a82;
    box-shadow: none;
    /* border: 2px solid #37a79dc2; */
}

a.text-white{
    color: #8ccce6 !important;
}

</style>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="{{asset('dash/images/logo-full.png')}}" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="me@mail.org" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check custom-control custom-checkbox ml-1 text-white">
                                                    <input class="custom-control-input" type="checkbox" name="remember" id="basic_checkbox_1" {{ old('remember') ? 'checked' : '' }}>
                
                                                    <label class="custom-control-label" for="basic_checkbox_1">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a class="text-white" href="{{ route('password.request') }}">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-white text-primary btn-block">Sign In</button>
                                        </div>
                                    </form>

                                    <div class="new-account mt-3">
                                        <p class="text-white">Don't have an account? <a class="text-white" href="{{ route('register') }}">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('dash/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('dash/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('dash/js/custom.min.js')}}"></script>
    <script src="{{asset('dash/js/deznav-init.js')}}"></script>

</body>

</html>