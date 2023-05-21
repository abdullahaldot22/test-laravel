@extends('layouts.dash')

@section('content')

<style>
    .content-list .cover{
        padding-bottom: 18px;
        padding-top: 16px;
    }
    .content-list .card{
        /* height: 100%; */
        box-sizing: border-box;
    }
    .card-header.back, .card-body.back{
        background: #fbffff;
    }
    .content-list .card-body{
        background: #ffffff;
        border-radius: 0 0 calc(0.75rem - 1px) calc(0.75rem - 1px);
    }
    .content-list .card-header{
        padding: 0px;
        border: none;
    }
    .card-title{
        font-size: 16px;
    }
    .card-text{
        font-size: 13px
    }
    .card-header .card-img-top.pro-img{
        width: 100%;
    }
    .card-header{
        z-index: 1;
        position: relative;
    }
    .card-header .temp{
        display: hidden;
        opacity: 0;
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        flex-flow: column wrap;
        background: #ffffffcc;
        padding: 4px 5px;
        border-radius: 3px 3px;
        transition: all ease-out 0.4s;
        z-index: -1;
    }
    .card-header .temp .prev{
        box-sizing: border-box;
        width: 40px;
        display: inline-block;
        margin: 4px;
    }
    .card-header .temp .prev img{
        width: 100%;
    }
    a.content:hover .card-header .temp{
        display: block;
        opacity: 1;
        bottom: 8px;
        z-index: 2;
    }
    .content .card-body{
        z-index: 5;
    }
    a.ed{
        padding: 4px 19px;
        border-radius: 4px;
        margin: 0 4px;
    }
    .content-list .card-footer{
        /* border: none; */
    }
</style>

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">List</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header back">
                <div class="card-title">Our Products</div>
            </div>
            <div class="card-body back">
                <div class="content-list">

                    <div class="row">
                        @foreach ($products as $pro)   
                        <div class="col-lg-3 cover">
                            <a href="#0" class="content">
                                <div class="card">
                                    <div class="card-header">
                                        <img class="card-img-top pro-img" src="{{ asset('uploads/product/preview/') }}/{{ $pro->preview }}" alt="">
                                        <ul class="temp">
                                            @foreach (App\Models\thumbnail::where('product_id', $pro->id)->get() as $temp)
                                                <li class="prev">
                                                    {{-- <a href="{{ asset('uploads/product/thumbnail/') }}/{{ $temp->thumbnail }}" class="picture"> --}}
                                                        <img src="{{ asset('uploads/product/thumbnail/') }}/{{ $temp->thumbnail }}" alt="">
                                                    {{-- </a> --}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $pro->product_name }}</h5>
                                        @if($pro->discount>0)
                                            <h5 class="card-text"><span style="text-decoration: line-through;">&#2547; {{ $pro->price }}</span></h5>
                                        @endif    
                                        <h5 class="card-text">
                                            @if ($pro->discount>0)
                                                {{ $pro->discount }}% <i class="fa-solid fa-angles-right"></i> 
                                            @endif
                                            <strong style="font-size: 14px; font-weigth: 700;">&#2547; {{ $pro->after_discount }}</strong></h5>
                                        <h5 class="card-text" style="font-size: 12px; color:#cccccc;">{{ $pro->short_description }}</h5>
                                    </div>
                                    <div class="card-footer m-auto">
                                        @can('product_inventory')
                                            
                                        <a href="{{ route('product.inventory', $pro->id) }}" class="btn btn-primary ed" title="Inventory"><i class="fa-solid fa-pencil"></i></a>
                                        @endcan
                                        @can('edit_product_details')
                                            
                                        <a href="{{ route('product.edit.page', $pro->id) }}" class="btn btn-primary ed" title="Edit Product"><i class="fa-solid fa-file-pen"></i></a>
                                        @endcan
                                        <a href="{{ route('product.delete', $pro->id) }}" title="Delete" class="btn btn-primary ed"><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- @section('footer_script')
    <script>
        new VenoBox({
            selector: ".picture",
        });
    </script>
@endsection --}}