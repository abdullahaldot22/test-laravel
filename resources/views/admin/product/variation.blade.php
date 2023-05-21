@extends('layouts.dash')

@section('content')

<style>
    a.ed{
        padding: 2px 19px;
        border-radius: 4px;
        margin: 0 4px;
        box-sizing: border-box;
    }
    tr{
        line-height: 25px;
    }
    .scolor{
        display: inline-block;
        width: 112px;
        text-align: center;
        padding: 6px 0;
        border-radius: 6px;
        border: 0.5px solid #c9c9c9;
    }
</style>

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Variation</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-2"></div>
    @can('add_delete_product_variation_color')
        
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Add Color</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('color.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="cname" class="form-control" placeholder="Colour Name" id="">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="ccode" class="form-control" placeholder="Colour Hex Code" id="">
                    </div>
                    <div class="mb-3">
                        <button style="width: 100%;" type="submit" class="btn btn-primary">Add Colour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan

@can('add_delete_product_variation_size')
    
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h5>Add Size</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('size.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <select name="scat_id" class="form-control">
                        <option value="">Select Subcategory</option>
                        @foreach ($scat as $scat)
                        <option value="{{ $scat->id }}">{{ $scat->subcategory_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <input type="text" name="sname" class="form-control" placeholder="Size" id="">
                </div>
                
                <div class="mb-3">
                    <button style="width: 100%;" type="submit" class="btn btn-primary">Add Size</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-2"></div>
</div>
@endcan

<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h5>Colour</h5>
            </div>
            <div class="card-body">
                <table class="table primary-table-bordered" style="width: 100%;">
                    <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            @can('add_delete_product_variation_color')
                                
                            <th>Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($color as $itm)
                            <tr>
                                <td>{{ $itm->color_name }}</td>
                                <td><span class="scolor" style="background: {{ $itm->color_code }};">{{ $itm->color_code }}</span></td>
                                @can('add_delete_product_variation_color')
                                    
                                <td><a href="" title="Delete" class="btn btn-danger ed"><i class="fa-regular fa-trash-can"></i></a></td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Size</h5>
            </div>
            <div class="card-body">
                <table class="table primary-table-bordered" style="width: 100%;">
                    <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th>Subcategory</th>
                            @can('add_delete_product_variation_size')
                                
                            <th>Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($size as $itm)
                            <tr>
                                <td>{{ $itm->product_size }}</td>
                                <td>{{$itm->rel_to_scat->subcategory_name}}</td>
                                @can('add_delete_product_variation_size')
                                    
                                <td><a href="" title="Delete" class="btn btn-danger ed"><i class="fa-regular fa-trash-can"></i></a></td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>

@endsection