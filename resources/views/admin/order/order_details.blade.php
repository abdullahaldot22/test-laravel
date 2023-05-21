@extends('layouts.dash')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Order</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Order Details</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-5 m-auto">
        <div class="card">
            <div class="card-header">
                <h5>{{ $order->order_id }}</h5>
                <div class="customer-info d-flex align-items-center">
                    <div class=""><img width="35px" src="{{ $order->rel_to_customer->profile_image == null ? asset('backend/images') : asset('uploads/customer') }}/{{ $order->rel_to_customer->profile_image == null ? 'user-dummy.png' : $order->rel_to_customer->profile_image }}" alt=""></div>
                    <div class="pl-3" style="font-size: 13px">
                        <div title="" class="">{{ $order->rel_to_customer->name }}</div>
                        <div class="">{{ $order->rel_to_customer->email }}</div>
                        <div title="" class="mt-1">{{ $order->phone }}</div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="">
                    @foreach($order_pro as $itm)
                    <div class="row" style="padding-bottom: 12px; padding-top: 10px;">
                        <div class="col-lg-9">
                            <div class="one" style="margin: auto 0;">
                                <p style="margin-bottom: 0" class="text-muted small">{{ $itm->rel_to_product->rel_scat->subcategory_name }}</p>
                                <h6>{{ $itm->rel_to_product->product_name }}</h6>
                                <p style="margin-bottom: 0; font-size: 14px;"><span class="text-dark">Size : {{ $itm->rel_to_size->product_size }}</span>, <span class="text-dark">Colour : {{ $itm->rel_to_color->color_name }}</span></p>
                                <p style="margin-bottom: 0; font-size: 14px;"><span class="text-dark">Quantity : {{ $itm->quantity }}</span></p>
                                <p class="small">&#2547; {{ $itm->rel_to_product->after_discount }}</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <img width="100%" src="{{ asset('uploads/product/preview') }}/{{ $itm->rel_to_product->preview }}" alt="">
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div class="">Purches : </div>
                    <div class="">&#2547; {{ number_format($order->sub_total) }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="">Discount : </div>
                    <div class="">&#2547; {{ number_format($order->discount_amount) }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="">Charge : </div>
                    <div class="">&#2547; {{ number_format($order->charge) }}</div>
                </div>
                @php
                $method = '';
                $status = '';
                if ($order->payment_method == 1) {
                    $method = 'Cash on Delivary';
                }
                elseif ($order->payment_method == 2) {
                    $method = 'Stripe';
                }
                elseif ($order->payment_method == 3) {
                    $method = 'SSL Commarce';
                }
                else{
                    $method = 'Null';
                }
                if ($order->status == 1) {
                    $status = 'Placed';
                }
                elseif ($order->status == 2) {
                    $status = 'Confirmed';
                }
                elseif ($order->status == 3) {
                    $status = 'Processing';
                }
                elseif ($order->status == 4) {
                    $status = 'Ready to Delivery';
                }
                elseif ($order->status == 5) {
                    $status = 'Delivered';
                }
                elseif ($order->status == 6) {
                    $status = 'Canceled';
                }
                else{
                    $status = 'Null';
                }
                @endphp
                <div class="d-flex justify-content-between">
                    <div class="">Payment Method : </div>
                    <div class="">{{ $method }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="">Total : </div>
                    <div class="">&#2547; {{ number_format($order->total) }}</div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="">Order Placed at : </div>
                    <div class="">{{ date('d, M Y', strtotime($order->created_at)) }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="">Current Status : </div>
                    <div class="">{{ $status }}</div>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <div class="">Product Delivered at : </div>
                    <div class="">{{ $order->delivery == null ? 'Processing' : date('d, M Y', strtotime($order->delivery)) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection