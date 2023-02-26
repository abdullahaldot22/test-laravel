@extends('frontend.layout.master')

@section('content')

    <section class="middle">
        <div class="continer">
            <div class="row align-items-center justify-content-center p-5">
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <h3>Set New Password</h3>
                            </div>
                            @if (session('log_error'))
                                <div class="alert alert-danger">{{ session('log_error') }}</div>
                            @endif
                            <form class="border p-3 rounded" action="{{ route('customer.password.set') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>New Password *</label>
                                    <input type="password" name="npass" class="form-control" placeholder="New Password*">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password *</label>
                                    <input type="password" name="cpass" class="form-control" placeholder="Confirm Password*">
                                </div>

                                <input type="hidden" name="token" value="{{ $token }}">
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Set Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection