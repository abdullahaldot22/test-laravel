@extends('frontend.layout.master')

@section('content')

<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile Info</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Dashboard Detail ======================== -->
<section class="middle">
    <div class="container">
        <div class="row align-items-start justify-content-between">
        
            <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                <div class="d-block border rounded mfliud-bot">
                    <div class="dashboard_author px-2 py-5">
                        <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                            <img src="assets/img/team-1.jpg" class="img-fluid circle" width="100" alt="" />
                        </div>
                        <div class="dash_caption">
                            <h4 class="fs-md ft-medium mb-0 lh-1">{{ Auth::guard('customerlogin')->user()->name }}</h4>
                            <span class="text-muted smalls">Australia</span>
                        </div>
                    </div>
                    
                    <div class="dashboard_author">
                        <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
                        <ul class="dahs_navbar">
                            <li><a href="my-orders.html"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                            <li><a href="wishlist.html"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                            <li><a href="#0" class="active"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                            <li><a href="{{ route('customer.logout') }}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                <!-- row -->
                <div class="row align-items-center">
                    <form class="row m-0" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Name *</label>
                                <input type="text" class="form-control" name="name" placeholder="{{ Auth::guard('customerlogin')->user()->name }}" value="{{ Auth::guard('customerlogin')->user()->name }}">
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Email ID *</label>
                                <input type="text" class="form-control" name="email" placeholder="{{ Auth::guard('customerlogin')->user()->email }}" value="{{ Auth::guard('customerlogin')->user()->email }}">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Current Password *</label>
                                <input type="password" class="form-control" name="cpass" placeholder="Current Password" />
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">New Password *</label>
                                <input type="password" class="form-control" name="newpass" placeholder="New Password" />
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Country</label>
                                <input type="text" class="form-control" name="country" placeholder="Country" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Phone</label>
                                <input type="number" class="form-control" name="phone" placeholder="Phone" />
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Address" />
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="small text-dark ft-medium">Profile Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">Save Changes</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <!-- row -->
            </div>
            
        </div>
    </div>
</section>
<!-- ======================= Dashboard Detail End ======================== -->

@endsection