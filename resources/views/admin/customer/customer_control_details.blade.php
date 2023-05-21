@extends('layouts.dash')

@section('content')
<style>
    .fullbox{
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        /* flex-grow: 1; */
    }
    .boxi{
        text-align: center;
    }
    .boxii{
        padding-left: 30px;
        width: 100%;
        display: flex;
        flex-flow: row wrap;
        /* align-items: center; */
        /* flex-grow: 1; */
        /* justify-content: start; */
    }
    .boxii .part{
        width: 50%;
    }
    .boxii label{
        font-size: 18px;
        color: #1f5d86;
    }
    .boxii .information{
        font-size: 14px;
        line-height: 28px;
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card pt-4">
                    <div class="card-body">
                        <div class="fullbox">
                            <div class="boxi" style="margin: auto 0; width: 360px;">
                                <img width="180px" style="padding: 15px; border-radius: 50%; border: 1px solid #eee7e7;" src="{{ $info->profile_image == null ? asset('backend/images') : asset('uploads/customer') }}/{{ $info->profile_image == null ? 'user-dummy.png' : $info->profile_image }}" alt="">
                            </div>
                            <div class="boxii">
                                <div class="mb-3 part">
                                    <label for="">Name</label>
                                    <div class="information">{{ $info->name }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Email</label>
                                    <div class="information">{{ $info->email }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Phone</label>
                                    <div class="information">{{ $info->phone == null ? '-' : $info->phone }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Address</label>
                                    <div class="information">{{ $info->address == null ? '-' : $info->address }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Country</label>
                                    <div class="information">{{ $info->country == null ? '-' : $info->country }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Last Purches Activity</label>
                                    @php
                                        $var = '';
                                        if ($order->first() == null) {
                                            $var = '-';
                                        }else {
                                            $var = date('d, M Y', strtotime($order->take(1)->first()->created_at));
                                        }
                                    @endphp
                                    <div class="information">{{ $var }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Verified Time</label>
                                    <div class="information">{{ $info->email_verify_at == null ? '-' : date('d, M Y', strtotime($info->email_verify_at)) }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Created At</label>
                                    <div class="information">{{ $info->created_at == null ? '-' : date('d, M Y', strtotime($info->created_at)) }}</div>
                                </div>
                            </div>
                        </div>
                        @can('customer_details_action')
                            
                        <div class="onbox text-center w-100 mt-4">
                            <button class="btn btn-primary">Block</button>
                            <button class="btn btn-primary">Wanrning</button>
                            <button class="btn btn-primary">Delete</button>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table primary-table-bordered" style="font-size: 13px;">
                            <thead>
                                <tr class="thead-primary">
                                    <th>Order ID</th>
                                    <th>Order Time</th>
                                    <th>Phone</th>
                                    <th>Payment Method</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Delivary Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order as $order)
                                <tr>
                                    <td><a href="{{ route('order.details', $order->id) }}">{{ $order->order_id }}</a></td>
                                    <td>{{ $order->created_at == null ? '-' : date('d, M Y', strtotime($order->created_at)) }}</td>
                                    <td>{{ $order->phone }}</td>
                                    @php
                                        $pstatus = '';
                                        $status = '';
                                        if ($order->payment_method == 1) {
                                            $pstatus = 'Cash on Delivary';
                                        }elseif ($order->payment_method == 2) {
                                            $pstatus = 'Stripe';
                                        }elseif ($order->payment_method == 3) {
                                            $pstatus = 'SSlCommarze';
                                        }else {
                                            $pstatus = 'Something Went Wrong!';
                                        }
                                        if($order->status == 1){
                                            $status = 'Placed';
                                        }elseif($order->status == 2){
                                            $status = 'Confirmed';
                                        }elseif($order->status == 3){
                                            $status = 'Processing';
                                        }elseif($order->status == 4){
                                            $status = 'Ready to Delivery';
                                        }elseif($order->status == 5){
                                            $status = 'Delivered';
                                        }elseif($order->status == 6){
                                            $status = 'Canceled';
                                        }else{
                                            $status = 'Something went wrong!';
                                        }
                                    @endphp
                                    <td>{{ $pstatus }}</td>
                                    <td>&#2547; {{ number_format($order->total) }}</td>
                                    <td>{{ $status }}</td>
                                    <td>{{ $order->delivery == null ? '-' : date('d, M Y', strtotime($order->delivery)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection