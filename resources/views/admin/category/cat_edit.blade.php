@extends('layouts.dash')

@section('content')

<style>
    input:button{
        background: transparent;
        border: none;
    }
</style>

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="content">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('cat.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (session('found'))
                                <div class="mb-3">
                                    <div class="alert alert-warning">{{session('found')}}</div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <input type="hidden" value="{{$cat_all->id}}" name="cat_id">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" value="{{$cat_all->category_name}}" class="form-control">
                            </div>
                            <div class="mb-5">
                                <label>Category Image</label>
                                <input type="file" name="cat_img" class="form-control" onchange="document.getElementById('blah').src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-4">
                                <div class="img m-auto" style="width: 250px; height: 250px; box-sizing: content-box; padding: 25px; border: 2px solid rgb(245, 245, 245); border-radius: 8px;">
                                    <img id="blah" style="display: flex; flex-flow: row no-wrap; width: 100%; align-items:center; justify-content: center;" src="{{asset('uploads/category')}}/{{$cat_all->category_image}}" alt="">
                                </div>
                            </div>
                            <div class="mb-3 pt-2">
                                <button type="submit" class="btn btn-primary w-100">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection