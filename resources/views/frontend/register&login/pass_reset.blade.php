@extends('frontend.layout.master')

@section('content')

    <section class="middle">
        <div class="continer">
            <div class="row align-items-center justify-content-center p-5">
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <h3>Password Reset</h3>
                            </div>
                            @if (session('log_error'))
                                <div class="alert alert-danger">{{ session('log_error') }}</div>
                            @endif
                            <form class="border p-3 rounded" action="{{ route('customer.password.reset.request') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email*">
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Send Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection