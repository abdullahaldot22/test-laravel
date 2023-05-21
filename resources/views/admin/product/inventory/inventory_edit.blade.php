@extends('layouts.dash')

@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Inventory of {{ $info_pro->product_name }}</h5>
                    @if(session('inventory'))
                        <div class="alert-success">{{ session('inventory') }}</div>
                    @else
                        
                    @endif
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('inventory.edit') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input hidden value="{{ $info->id }}" type="text" name="id" class="form-control" id="">
                        </div>
                        <div class="mb-3">
                            <select name="color_id" class="form-control" id="">
                                <option value="">Select Color</option>
                                @foreach ($color as $item)
                                    <option value="{{ $item->id }}" {{ $info->color_id == $item->id ? 'selected' : '' }}>{{ $item->color_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="size_id" class="form-control" id="">
                                <option value="">Select Size</option>
                                @foreach ($size as $size)
                                        <option value="{{ $size->id }}" {{ $info->size_id == $size->id ? 'selected' : '' }}>{{ $size->product_size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="number" name="quantity" placeholder="Quantity" class="form-control" value="{{ $info->quantity }}" id="">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit Inventory</button>
                        </div>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
@endsection