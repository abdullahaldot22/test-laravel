@extends('layouts.dash')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Product</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Product Images</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-5 m-auto">
        <div class="card">
            <div class="card-header">
                <h5>Edit Product preview Image</h5>
                @if(session('preview'))
                    <div class="alert">{{ session('preview') }}</div>
                @else
                    
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('product.update.preview') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="file" name="preview" value="" onchange="document.getElementById('bla').src=window.URL.createObjectURL(this.files[0])">
                    </div>

                    <input type="hidden" name="pro_id" value="{{ $pro_id }}">
                    
                    <div class="mb-4 mt-4">
                        <div class="img m-auto" style="width: 300px; box-sizing: content-box; padding: 25px; border: 2px solid rgb(245, 245, 245); border-radius: 8px;">
                            <img id="bla" style="display: flex; flex-flow: row no-wrap; width: 100%; align-items:center; justify-content: center;" src="{{ asset('uploads/product/preview') }}/{{ App\Models\product::find($pro_id)->preview }}" alt="">
                        </div>
                    </div>
                    <button class="btn btn-primary m-auto w-100">Update Product Preview</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7 m-auto">
        <div class="card">
            <div class="card-header">
                <h5>Remove Thumbnail Images</h5>
                @if(session('thumb'))
                    <div class="alert">{{ session('thumb') }}</div>
                @else
                    
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('product.remove.thumbnail') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="mb-3">
                        <input class="form-control" type="file" name="preview" onchange="document.getElementById('bla').src=window.URL.createObjectURL(this.files[0])">
                    </div> --}}

                    {{-- {{ $thumbnails }} --}}

                    <div class="mb-4">
                        @forelse($thumbnails as $key => $thumbnail)
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $key }}" name="thumb_id[]" value="{{ $thumbnail->id }}">
                                <label class="form-check-label" for="inlineCheckbox{{ $key }}">
                                    <div class="img" style="width: 100px; box-sizing: content-box; padding: 25px; border: 2px solid rgb(245, 245, 245); border-radius: 8px;">
                                        <img style="width: 100%;" src="{{ asset('uploads/product/thumbnail') }}/{{ $thumbnail->thumbnail }}" alt="">
                                    </div>
                                </label>
                            </div>
                        @empty
                            <div class="empty w-100 text-center">No thumbnail found ..</div>
                        @endforelse
                    </div>

                    <button class="btn btn-primary m-auto w-100">Remove Thumbnail Image</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Add Product Thumbnail Images</h5>
                @if(session('thumb_add'))
                    <div class="alert">{{ session('thumb_add') }}</div>
                @else
                    
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('product.add.thumbnail') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control input-thumb" type="file" multiple name="thumbnail[]">
                    </div>
                    <input type="hidden" name="pro_id" value="{{ $pro_id }}">
                    <button class="btn btn-primary m-auto w-100">Add thumbnails</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection