@extends('frontend.layout.master')

@section('content')
    <!-- ======================= Top Breadcrubms ======================== -->
        <div class="gray py-3">
            <div class="container">
                <div class="row">
                    <div class="colxl-12 col-lg-12 col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Login</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
	<!-- ======================= Top Breadcrubms ======================== -->

    <!-- ======================= Login Detail ======================== -->
        <section class="middle">
            <div class="container">
                <div class="row align-items-start justify-content-between">
                
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="mb-3">
                            <h3>Login</h3>
                        </div>
                        @if (session('log_error'))
                            <div class="alert alert-danger">{{ session('log_error') }}</div>
                        @endif
                        <form class="border p-3 rounded" action="{{ route('customer.login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="Email*">
                            </div>
                            
                            <div class="form-group">
                                <label>Password *</label>
                                <input type="password" name="password" class="form-control" placeholder="Password*">
                            </div>
                            
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="eltio_k2">
                                        <a href="{{ route('password.reset.page') }}">Lost Your Password?</a>
                                    </div>	
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                            </div>
                            <div class="form-group row w-100 m-auto" style="padding: 10px 12px; border: 3px solid #91bbe2;">
                                <div class="w-100 m-auto">
                                    <a href="{{ route('login.github') }}" class="btn btn-dark btn-block w-100">Login with Github</a>
                                  <a href="{{ route('login.google') }}" class="btn btn-danger btn-block w-100">Login with Google</a>
                                  <a href="" class="btn btn-primary btn-block w-100">Login with Facebook</a>
                               </div>
                            </div>  
                        </form>
                    </div>
                    
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mfliud">
                        <div class="mb-3">
                            <h3>Register</h3>
                        </div>
                        @if (session('reg_message'))
                            <div class="alert alert-success">{{ session('reg_message') }}</div>
                        @endif
                        <form action="{{ route('customer.register.store') }}" method="POST" class="border p-3 rounded">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Full Name *</label>
                                    <input name="name" type="text" class="form-control" placeholder="Full Name">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Email *</label>
                                <input name="email" type="email" class="form-control" placeholder="Email*">
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Password *</label>
                                    <input name="password" type="password" class="form-control" placeholder="Password*">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Confirm Password *</label>
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password*">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create An Account</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </section>
    <!-- ======================= Login End ======================== -->
@endsection