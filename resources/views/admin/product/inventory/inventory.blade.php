@extends('layouts.dash')

@section('content')

<style>
    a.ed{
        padding: 4px 19px;
        border-radius: 4px;
        margin: 0 4px;
    }
</style>

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Inventory</a></li>
    </ol>
</div>

<div class="row">
    @can('product_inventory_add')
        
    <div class="col-lg-5 m-auto">
        <div class="card">
            <div class="card-header">
                <h5>Add Inventory</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('inventory.add') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input hidden value="{{ $info->id }}" type="text" name="product_id" class="form-control" id="">
                        <input readonly value="{{ $info->product_name }}" type="text" name="pname" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <select name="color_id" class="form-control" id="">
                            <option value="">Select Color</option>
                            @foreach ($color as $item)
                            <option value="{{ $item->id }}">{{ $item->color_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="size_id" class="form-control" id="">
                            <option value="">Select Size</option>
                            @foreach ($size as $item)
                            @if($info->subcategory_id == $item->subcategory_id)
                            <option value="{{ $item->id }}">{{ $item->product_size }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="quantity" placeholder="Quantity" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan

    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h5>Inventory of {{ $info->product_name }}</h5>
                @if(session('inventory'))
                    <div class="alert-success">{{ session('inventory') }}</div>
                @else
                    
                @endif
            </div>
            <div class="card-body">
                <table class="table primary-table-bordered" style="width: 100%;">
                    <thead class="thead-primary">
                        <tr style="background: #1a5199; color: #fff;">
                            <td>Colour</td>
                            <td>Size</td>
                            <td>Quantity</td>
                            @can('product_inventory_action')
                                
                            <td>Action</td>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ivpro as $ivpro)
                        <tr>
                            <td>{{ $ivpro->rel_color->color_name }}</td>
                            <td>{{ $ivpro->rel_size->product_size }}</td>
                            <td>{{ $ivpro->quantity }}</td>
                            @can('product_inventory_action')
                            <td>
                                    
                                <a href="{{ route('inventory.edit.page', $ivpro->id) }}" title="edit" class="btn btn-primary ed"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="{{ route('inventory.delete', $ivpro->id) }}" title="Delete" class="btn btn-danger ed"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                            @endcan
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    'It hasnt been added yet!'
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection