@extends('layouts.dash');

@section('content')

<style>
    form{
        box-sizing: border-box;
    }
    .part{
        display: flex;
        flex-flow: row nowrap;
        width: 100%;
        margin: auto 0 !important;
    }
    .pi{
        width: 100%;
    }
    .pi:first-of-type{
        padding: 0 10px 0 0;
    }
    .pi:last-of-type{
        padding: 0 0px 0 10px;
    }
</style>

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Add Product</h4>
            </div>
            <div class="card-body">
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row part">
                        

                            <div class="pi">
                                <div class="mb-3">
                                    <label for="">Category</label>
                                    <select name="cat_id" class="form-control" id="cat">
                                        <option value="">Select Category</option>
                                        @foreach ($cat as $cat)
                                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="pi">
                                <div class="mb-3">
                                    <label for="">Subcategory</label>
                                    <select name="scat_id" class="form-control" id="scat">
                                        <option value="">Select Subcategory</option>
                                    </select>
                                </div>
                            </div>

                        
                    </div>

                    <div class="row part">
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="name" id="" placeholder="Model name" class="form-control">
                            </div>
                        </div>
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Price</label>
                                <input type="number" name="price" id="" placeholder="Price" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row part">
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Discount</label>
                                <input type="number" name="discount" id="" placeholder="Discount in percentage (%)" class="form-control">
                            </div>
                        </div>
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Brand</label>
                                <input type="text" name="brand" id="" placeholder="Brand Name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row part">
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Short Description</label>
                                <textarea name="short_des" id="" cols="30" rows="7" placeholder="Write a Simple Discrpition about this Product .." class="form-control"></textarea>
                            </div>
                        </div>
    
                        <div class="pi mt-2">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Preview</label>
                                    <input type="file" name="preview" class="form-control" id="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Thumbnails</label>
                                    <input multiple type="file" name="thumbnail[]" class="form-control" id="">
                                </div>
                        </div>
                    </div>

                    <div class="row part">
                        <div class="mb-3" style="width: 100%;">
                            <label for="" class="form-label">Long Description</label>
                            <textarea name="long_des" id="product_ldesp" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="mt-4 mb-3" style="width: 100%;">
                        <button style="width: 60%; display: block;" type="submit" class="btn btn-primary m-auto">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
    <script>
        $('#cat').change(function () {
            var cat_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/getscat',
                type:'POST',
                data:{'cid': cat_id},
                success:function (data) {
                    $('#scat').html(data);
                },
            });
        });        
    </script>

    <script>
        $(document).ready(function() {
            $('#product_ldesp').summernote({
                height: 280,
            });
        });
    </script>
@endsection