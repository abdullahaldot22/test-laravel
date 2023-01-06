@extends('layouts.dash')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Sub-Category</a></li>
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
                    <form action="{{route('scat.add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Category Name</label>
                            <select name="cat_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($cat as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Sub-Category Name</label>
                            <input placeholder="SubCategory Name" type="text" class="form-control" name="scat_name">
                        </div>
                        <div class="mb-5">
                            <label>Category Image</label>
                            <input type="file" name="scat_img" class="form-control" onchange="document.getElementById('blah').src=window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-4">
                            <div class="img m-auto" style="width: 250px; height: 250px; box-sizing: content-box; padding: 25px; border: 2px solid rgb(245, 245, 245); border-radius: 8px;">
                                <img id="blah" style="display: flex; flex-flow: row no-wrap; width: 100%; align-items:center; justify-content: center;" src="" alt="">
                            </div>
                        </div>
                        <div class="mb-3 pt-2">
                            <button type="submit" class="btn btn-primary w-100">Add Subcategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-9 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>SubCategory List</h3>
                </div>
                <div class="card-body">
                    <table class="table primary-table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>SL</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>SubCategory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scat as $key=>$scat)
                                
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$scat->rel_to_cat->category_name}}</td>
                                <td><img width="25" src="{{ asset('uploads/subcategory') }}/{{$scat->subcategory_image}}" alt=""></td>
                                <td>{{$scat->subcategory_name}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('scat.edit', $scat->id)}}">Edit</a>
                                            <a class="dropdown-item" href="{{route('scat.sdel', $scat->id)}}">Delete</a>
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
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-9 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Trashed SubCategory List</h3>
                </div>
                <div class="card-body">
                    <table class="table primary-table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>SL</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>SubCategory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trash as $key=>$scat)
                                
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$scat->rel_to_cat->category_name}}</td>
                                <td>{{$scat->subcategory_image}}</td>
                                <td>{{$scat->subcategory_name}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('scat.restr', $scat->id)}}">Restore</a>
                                            <a class="dropdown-item" href="{{route('scat.fdel', $scat->id)}}">Delete</a>
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
</div>

@endsection