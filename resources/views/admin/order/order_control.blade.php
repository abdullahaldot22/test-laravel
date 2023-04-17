@extends('layouts.dash')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Order</a></li>
    </ol>
</div>

<div class="card" style="margin-bottom: 250px">
    <div class="card-header">
        <h3>Order Status</h3>
    </div>
    <div class="card-body">
        <table class="table primary-table-bordered">
            <thead>
                <tr class="thead-primary">
                    <th>Order</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Order Time</th>
                    <th>Edit Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($running_orders as $order)
                    <tr>
                        <td><a href="{{ route('order.details', $order->id) }}">{{ $order->order_id }}</a></td>
                        <td>{{ $order->rel_to_customer->name }}</td>
                        <td>{{ $order->rel_to_customer->email }}</td>
                        <td>{{ $order->rel_to_customer->phone }}</td>
                        <td>{{ number_format($order->total) }}</td>
                        <td>
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
                        </td>
                        <td>
                            @if($order->payment_method == 1)
                                {{ 'Cash On Delivery' }}
                            @elseif($order->payment_method == 2)
                                {{ 'Paid With SSLCommerz' }}
                            @elseif($order->payment_method == 3)
                                {{ 'Paid With Stripe' }}
                            @else
                                {{ 'Something went wrong' }}
                            @endif
                        </td>
                        <td>
                            {{ date('d,M Y', strtotime($order->created_at)) }}
                        </td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                            </button>
                            <div class="dropdown-menu" style="font-size: 12px">
                                <form action="{{ route('order.status.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <button name="status" value="1" class="dropdown-item">Placed</button>
                                    <button name="status" value="2" class="dropdown-item">Confirmed</button>
                                    <button name="status" value="3" class="dropdown-item">Processing</button>
                                    <button name="status" value="4" class="dropdown-item">Ready to Delivery</button>
                                    <button name="status" value="5" class="dropdown-item">Delivered</button>
                                    <button name="status" value="6" class="dropdown-item">Cancel</button>
                                </form>
                            </div>
                        </td>
                        {{-- <td>
                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="">Edit</a>
                                <a class="dropdown-item" href="">Delete</a>
                            </div>
                        </td> --}}
                    </tr>
                    
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection