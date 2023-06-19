@extends('frontend.layout.master')

@section('content')

<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ redirect('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Order</li>
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
                            @if(Auth::guard('customerlogin')->user()->profile_image == null)
                                <img src="{{ Avatar::create(Auth::guard('customerlogin')->user()->name)->toBase64() }}" class="img-fluid circle" width="100" height="100" alt="" />
                            @else
                                <img src="{{ asset('uploads/customer') }}/{{ Auth::guard('customerlogin')->user()->profile_image }}" class="img-fluid circle" width="100" height="100" alt="" />
                            @endif
                        </div>
                        <div class="dash_caption">
                            <h4 class="fs-md ft-medium mb-0 lh-1">{{ Auth::guard('customerlogin')->user()->name }}</h4>
                            <span class="text-muted smalls">{{ Auth::guard('customerlogin')->user()->country }}</span>
                        </div>
                    </div>
                    
                    <div class="dashboard_author">
                        <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
                        <ul class="dahs_navbar">
                            <li><a href="#0" class="active"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                            <li><a href="{{ route('customer.wishlist') }}"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                            <li><a href="{{ route('customer.profile') }}"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                            <li><a href="{{ route('customer.logout') }}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            

            
            <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                @forelse($orders as $order)
                    <!-- Single Order List -->
                    <div class="ord_list_wrap border mb-4">
                        <div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
                            <div class="olh_flex">
                                <p class="m-0 p-0 text-left"><span class="text-muted">Order Number</span></p>
                                <h6 class="mb-0 ft-medium" style="font-size: 10px; text-align: left; color: rgb(111, 111, 111);">{{ $order->order_id }}</h6>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-12 ml-auto" style="max-width: 30%;">
                                <p class="mb-1 p-0"><span class="text-muted">Status</span></p>
                                <div class="delv_status">
                                    <span class="ft-medium small text-success bg-light-warning rounded px-3 py-1" style="white-space:nowrap;">
                                    @if($order->status == 1)
                                        {{ 'Placed' }}
                                    @elseif($order->status == 2)
                                        {{ 'Confirmed' }}
                                    @elseif($order->status == 3)
                                        {{ 'Processing' }}
                                    @elseif($order->status == 4)
                                        {{ 'Ready to Delivery' }}
                                    @elseif($order->status == 5)
                                        {{ 'Delivered' }}
                                    @elseif($order->status == 6)
                                        {{ 'Canceled' }}
                                    @else
                                        {{ 'Something went wrong' }}
                                    @endif    
                                    </span>
                                </div>
                                
                            </div>	
                        </div>
                        <div class="ord_list_body text-left">
                            @foreach(App\Models\orderProduct::where('order_id', $order->order_id)->get() as $oproduct)
                                <!-- First Product -->
                                <div class="row align-items-center justify-content-left m-0 py-4 br-bottom">
                                    <div class="col-xl-7 col-lg-7 col-md-7 col-12">
                                        <div class="cart_single d-flex align-items-start mfliud-bot">
                                            <div class="cart_selected_single_thumb">
                                                <a href="#"><img src="{{ asset("uploads/product/preview") }}/{{ $oproduct->rel_to_product->preview }}" width="75" class="img-fluid rounded" alt=""></a>
                                            </div>
                                            <div class="cart_single_caption pl-3">
                                                <p class="mb-0"><span class="text-muted small">{{ $oproduct->rel_to_product->rel_scat->subcategory_name }}</span></p>
                                                <h4 class="product_title fs-sm ft-medium mb-1 lh-1">{{ $oproduct->rel_to_product->product_name }}</h4>
                                                <p style="margin: 0px"><span class="text-dark medium">Size: {{ $oproduct->rel_to_size->product_size }}</span>, <span class="text-dark medium">Color: {{ $oproduct->rel_to_color->color_name }}</span></p>
                                                <p class="mb-2"><span class="text-dark medium">Quantity: {{ $oproduct->quantity }} piece.</span></p>
                                                <h4 class="fs-sm ft-bold mb-0 lh-1">&#2547; {{ $oproduct->rel_to_product->price }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            
                        </div>
                        <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 pl-0 py-2 olf_flex d-flex align-items-center justify-content-between">
                                <div class="olf_flex_inner"><p class="m-0 p-0"><span class="text-muted medium text-left">{{ $order->created_at->format('d M, Y') }}</span></p></div>
                                <div class="olf_inner_right"><h5 class="mb-0 fs-sm ft-bold">Total: &#2547; {{ number_format($order->total) }}</h5></div>
                            </div>
                        </div>
                        <div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 pl-0 py-2 olf_flex d-flex align-items-center justify-content-center">
                                <div class="olf_inner_right"><a href="{{ route('order.invoice.download', substr($order->order_id, 1)) }}" class="btn btn-dark">Download Invoice</a></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Order List -->
                @empty
                    <div style="width: 100%; height:100%; display:flex; align-items:center; justify-content:center;">
                        <h3 style="font-size: 18px; color: rgb(168, 168, 168);">
                            You havent anything ordered yet
                        </h3>
                    </div>
                @endforelse
                
            </div>
            
        </div>
    </div>
</section>
<!-- ======================= Dashboard Detail End ======================== -->

@endsection