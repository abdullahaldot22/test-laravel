@extends('layouts.dash')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Sub-Category</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Sub-Category List</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('scat.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Category Name</label>
                            <select name="cat_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($cat as $cat)
                                    <option {{($cat->id == $scat->category_id)?'selected':''}} value="{{$cat->id}}">{{$cat->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Sub-Category Name</label>
                            <input value="{{$scat->id}}" name="scat_id" type="hidden" class="form-control">
                            <input value="{{$scat->subcategory_name}}" name="scat_name" type="text" class="form-control">
                        </div>

                        <div class="mb-5">
                            <label>Category Image</label>
                            <input type="file" value="{{$scat->subcategory_image}}" name="scat_img" class="form-control" onchange="document.getElementById('blah').src=window.URL.createObjectURL(this.files[0])">
                        </div>

                        <div class="mb-4">
                            <div class="img m-auto" style="width: 250px; height: 250px; box-sizing: content-box; padding: 25px; border: 2px solid rgb(245, 245, 245); border-radius: 8px;">
                                <img id="blah" style="display: flex; flex-flow: row no-wrap; width: 100%; align-items:center; justify-content: center;" src="" alt="">
                            </div>
                        </div>

                        <div class="mb-3 pt-2">
                            <button type="submit" class="btn btn-primary w-100">Update Subcategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection