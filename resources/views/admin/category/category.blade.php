@extends('layouts.dash')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
    </ol>
</div>

<div class="row">
    @can('add_category')
        
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Add category</h4>
            </div>
            <div class="card-body">
                <form action="{{route('category.add')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="category_name">
                        @error('category_name')
                        <strong class="tt">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Image</label>
                        <input type="file" class="form-control" name="category_image">
                        @error('category_image')
                        <strong class="tt">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
    
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Catagory List</h4>
                    <h6 style="color: #c5c5c5;">Total : {{count($cat)}}</h6>
                </div>
                <div class="card_body table-responsive">            
                    <table id="myTable" class="table primary-table-bordered" style="border: none;">
                        <thead class="thead-primary">
                            <tr>
                                <th scope="col" style="padding-left: 14px;">SL</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Added by</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cat as $key=>$cat)
                            <tr>
                                <td style="padding-left: 22px;">{{$key+1}}</td>
                                <td><img width="40" src="{{asset('uploads/category')}}/{{$cat->category_image}}" alt=""></td>
                                <td>{{$cat->category_name}}</td>
                                <td>{{ $cat->rel_usr == null ? 'Deleted' : $cat->rel_usr->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('edit_category')
                                                
                                            <a class="dropdown-item" href="{{route('cat.edit', $cat->id)}}">Edit</a>
                                            @endcan
                                            @can('delete_category', $user)
                                                
                                            <a class="dropdown-item" href="{{route('cat.s.del', $cat->id)}}">Delete</a>
                                            @endcan
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
    
@can('trash_category')
    
<div class="row">
    <div class="col-lg-7 m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Trashed Catagory List</h4>
                    <h6 style="color: #c5c5c5;">Total : {{count($trash)}}</h6>
                </div>
                <div class="card_body table-responsive">            
                    <table id="myTableii" class="table primary-table-bordered" style="border: none;">
                        <thead class="thead-primary">
                            <tr>
                                <th scope="col" style="padding-left: 14px;">SL</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Added by</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trash as $key=>$cat)
                            <tr>
                                <td style="padding-left: 22px;">{{$key+1}}</td>
                                <td><img width="40" src="{{asset('uploads/category')}}/{{$cat->category_image}}" alt=""></td>
                                <td>{{$cat->category_name}}</td>
                                <td>{{$cat->rel_usr == null ? 'Deleted' : $cat->rel_usr->name}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('cat.restore', $cat->id)}}">Restore</a>
                                            <a class="dropdown-item" href="{{route('cat.f.del', $cat->id)}}">Delete</a>
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
    
    @endcan
    
    
    
    @endsection

@section('footer_script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
            $('#myTableii').DataTable();
        } );
    </script>
@endsection
