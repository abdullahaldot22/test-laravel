@extends('layouts.dash')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Coupon</a></li>
    </ol>
</div>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>List</h3>
                </div>
                <div class="card-body">
                    <table class="table primary-table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>SL</th>
                                <th title="Event Name">Name</th>
                                <th title="Coupon Code">Code</th>
                                <th title="Discount Method">Method</th>
                                <th title="Discount Amount">Amount</th>
                                <th title="Discount Range">Range</th>
                                <th title="Discount Range">Apply Range Starts From</th>
                                <th>Validity</th>
                                <th>Added_by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $key => $coupon)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $coupon->event_name }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td><span class="badge badge-{{ $coupon->discount_method == 1 ? 'info' : ( $coupon->discount_method == 2 ? 'primary' : 'danger' ) }}">{{ $coupon->discount_method == 1 ? 'Percentage (%)' : ( $coupon->discount_method == 2 ? 'Cash (৳)' : 'Error' ) }}</span></td>
                                    <td>{{ $coupon->discount_amount }}</td>
                                    <td>{{ $coupon->discount_range == null ? '-' : $coupon->discount_range }}</td>
                                    <td>{{ $coupon->lowest_total_amount == null ? '-' : $coupon->lowest_total_amount }}</td>
                                        {{-- @php
                                            $months = Carbon\Carbon::now()->diffInMonths($coupon->validity_date);
                                            $weeks = Carbon\Carbon::now()->diffInWeeks($coupon->validity_date);
                                            $days = Carbon\Carbon::now()->diffInDays($coupon->validity_date);
                                            $hours = Carbon\Carbon::now()->diffInHours($coupon->validity_date);
                                            $minutes = Carbon\Carbon::now()->diffInMinutes($coupon->validity_date);
                                            $seconds = Carbon\Carbon::now()->diffInSeconds($coupon->validity_date);

                                            // if ($seconds < 2592000 ) {
                                            //     $result = $weeks.' '.'weeks remain';}
                                            // elseif ($seconds < 604800 ) {
                                            //     $result = $days.' '.'days remain';}
                                            // elseif ($seconds < 86400 ) {
                                            //     $result = $hours.' '.'hours remain';}
                                            // elseif ($seconds < 3600 ) {
                                            //     $result = $minutes.' '.'minutes remain';}
                                            // elseif ($seconds < 60 ) {
                                            //     $result = $seconds.' '.'seconds remain';}
                                            // elseif ($seconds == 0) {
                                            //     $result = 'This offer has ended!';}
                                            // else {
                                            //     $result = Carbon\carbon::now()->diffInMonths($coupon->validity_date).' '.'months remain';}
                                            $result = $days.' '.'days remain'

                                            // $months==0 ? $weeks.' '.'weeks remain' : ($weeks==0 ? $days.' '.'days remain' : ($days==0 ? $hours.' '.'hours remain' : ($hours==0 ? $minutes.' '.'minutes remain' : ($minutes==0 ? $seconds.' '.'seconds remain' : ($seconds<=0 ? 'This offer has ended!' : $months.' '.'months remain')))))
                                        @endphp --}}
                                    <td>{{ date('d, M Y',strtotime($coupon->validity_date)) }}</td>
                                    <td>{{ $coupon->rel_user->name }}</td>
                                    <td>
                                        <div class="dropdown show">
                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown" aria-expanded="true">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-26px, 40px, 0px);">
                                                <a class="dropdown-item" href="{{ route('coupon.edit.page', $coupon->id) }}">Edit</a>
                                                <a class="dropdown-item" href="{{ route('coupon.delete', $coupon->id) }}">Delete</a>
                                            </div>
                                        </div>
                                
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    
    <div class="row">
        
        <div class="col-lg-3 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Create Coupon</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('coupon.add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Event Name" name="event_name" id="name">
                            @error('event_name')
                                <strong class="tt">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Coupon Code" name="coupon_code" id="code">
                            @error('coupon_code')
                                <strong class="tt">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select name="discount_method" class="form-control" id="method">
                                <option value="null" selected>Select Method of Discount</option>
                                <option value="1">Percentage</option>
                                <option value="2">Solid Cash</option>
                            </select>
                            @error('discount_method')
                                <strong class="tt">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" name="discount_amount" class="form-control" placeholder="Amount of Discount" id="">
                            @error('discount_amount')
                                <strong class="tt">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Range of Discount" name="discount_range" id="range">
                            @error('discount_range')
                                <strong class="tt">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Range of Lowest Total Amount to Apply on" name="lowest_amount_range" id="range">
                            @error('lowest_amount_range')
                                <strong class="tt">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="last_date">Validity</label>
                            <input type="date" class="form-control" name="validity_date" id="last_date">
                            @error('validity_date')
                                <strong class="tt">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="w-100 d-flex" style="justify-content:center;">
                            <button type="submit" class="btn btn-primary">Create Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection