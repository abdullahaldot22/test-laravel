@extends('layouts.dash')

@section('content')
<div class="row">
        
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Edit Coupon</h3>
                @if(session('cpn_edit'))
                    <div class="alert-success">{{ session('cpn_edit') }}</div>
                @else
                    
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('coupon.edit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="">Event Name</label>
                        <input type="text" class="form-control" placeholder="Event Name" name="event_name" id="name" value="{{ $info->event_name }}">
                        @error('event_name')
                            <strong class="tt">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Coupon Code</label>
                        <input type="text" class="form-control" placeholder="Coupon Code" name="coupon_code" id="code" value="{{ $info->coupon_code }}">
                        @error('coupon_code')
                            <strong class="tt">{{ $message }}</strong>
                        @enderror
                    </div>

                    <input type="hidden" name="cpn_id" value="{{ $cpn_id }}">

                    <div class="mb-3">
                        <label for="">Discount Method</label>
                        <select name="discount_method" class="form-control" id="method">
                            <option value="null" selected>Select Method of Discount</option>
                            <option value="1" {{ $info->discount_method == 1 ? 'selected' : '' }}>Percentage</option>
                            <option value="2" {{ $info->discount_method == 2 ? 'selected' : '' }}>Solid Cash</option>
                        </select>
                        @error('discount_method')
                            <strong class="tt">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Discount Amount</label>
                        <input type="number" name="discount_amount" class="form-control" placeholder="Amount of Discount" id="" value="{{ $info->discount_amount }}">
                        @error('discount_amount')
                            <strong class="tt">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Peak Discount Amount</label>
                        <input type="number" class="form-control" placeholder="Range of Discount" name="discount_range" id="range" value="{{ $info->discount_range }}">
                        @error('discount_range')
                            <strong class="tt">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Least Applicable Selling Amount</label>
                        <input type="number" class="form-control" placeholder="Amount" name="lowest_amount_range" id="range" value="{{ $info->lowest_total_amount }}">
                        @error('lowest_amount_range')
                            <strong class="tt">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="last_date">Validity</label>
                        <input type="date" class="form-control" name="validity_date" id="last_date" value="{{ date('Y-m-d', strtotime($info->validity_date)) }}"/>
                        @error('validity_date')
                            <strong class="tt">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="w-100 d-flex" style="justify-content:center;">
                        <button type="submit" class="btn btn-primary">Edit Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection