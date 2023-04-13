@extends('layouts.dash')
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
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Product</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Edit Product</h4>
                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @else
                    
                @endif
            </div>
            <div class="card-body">
                <form action="{{route('product.edit.apply')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row part">
                        

                            <div class="pi">
                                <div class="mb-3">
                                    <label for="">Category</label>
                                    <select name="cat_id" class="form-control" id="cat">
                                        <option value="">Select Category</option>
                                        @foreach ($cat as $cat)
                                            <option value="{{$cat->id}}"{{ $cat->id == $pro_info->category_id ? 'selected' : '' }}>{{$cat->category_name}}</option>
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
                        
                            <input class="" type="hidden" name="pro_id" value="{{ $pro_id }}">
                            <input class="cat" type="hidden" name="cat_id" value="{{ $pro_info->category_id }}">
                            <input class="scat" type="hidden" name="scat_id" value="{{ $pro_info->subcategory_id }}">
                        
                    </div>

                    <div class="row part">
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="name" id="" placeholder="Model name" value="{{ $pro_info->product_name }}" class="form-control">
                            </div>
                        </div>
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Price</label>
                                <input type="number" name="price" id="" value="{{ $pro_info->price }}" placeholder="Price" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row part">
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Discount <small>(in percentage, %)</small></label>
                                <input type="number" name="discount" id="" value="{{ $pro_info->discount }}" placeholder="Discount in percentage (%)" class="form-control">
                            </div>
                        </div>
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Brand</label>
                                <input type="text" name="brand" id="" value="{{ $pro_info->brand }}" placeholder="Brand Name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row part">
                        <div class="col-lg-12 p-0">
                            <div class="mb-3">
                                <label for="" class="form-label">Coupon Discount Applicability</label>
                                <div class="row mt-1">
    
                                    <div class="col-lg-6 col-12 pl-4">
                                        <div class="space">
                                            <input type="radio" name="cp_discount_applicability" {{ $pro_info->coupon_applicability == 1 ? 'checked' : '' }} id="coupon1" value="1">
                                            <label class="radio_label" for="coupon1">No Coupon Discount Applicable</label>
                                        </div>
                                        <div class="space">
                                            <input type="radio" name="cp_discount_applicability" {{ $pro_info->coupon_applicability == 2 ? 'checked' : '' }} id="coupon2" value="2">
                                            <label class="radio_label" for="coupon2">Only Percentage Type Coupon Discount Applicable</label>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-6 col-12 pi">
                                        <div class="space">
                                            <input type="radio" name="cp_discount_applicability" {{ $pro_info->coupon_applicability == 3 ? 'checked' : '' }} id="coupon3" value="3">
                                            <label class="radio_label" for="coupon3">Only Solid Amount Type Coupon Discount Applicable</label>
                                        </div>
                                        <div class="space">
                                            <input type="radio" name="cp_discount_applicability" {{ $pro_info->coupon_applicability == 4 ? 'checked' : '' }} id="coupon4" value="4">
                                            <label class="radio_label" for="coupon4">Both Type Coupon Discount Applicable</label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>  
                        </div>  
                    </div>

                    <div class="row part">
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Delivary Charge inside City</label>
                                <input type="text" name="charge_ic" id="" value="{{ $pro_info->charge_ic }}" placeholder="Charge in TK" class="form-control">
                            </div>
                        </div>
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Delivary Charge outside City</label>
                                <input type="text" name="charge_oc" id="" value="{{ $pro_info->charge_oc }}" placeholder="Charge in TK" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row part">
                        <div class="pi">
                            <div class="mb-3">
                                <label for="" class="form-label">Short Description</label>
                                <textarea name="short_des" id="" cols="30" rows="7" placeholder="Write a Simple Discrpition about this Product .." class="form-control">{{ $pro_info->short_description }}</textarea>
                            </div>
                        </div>
    
                        {{-- <div class="pi mt-2">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Preview</label>
                                    <input type="file" name="preview" class="form-control" id="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Thumbnails</label>
                                    <input multiple type="file" name="thumbnail[]" class="form-control" id="">
                                </div>
                        </div> --}}
                    </div>

                    <div class="row part">
                        <div class="mb-3" style="width: 100%;">
                            <label for="" class="form-label">Long Description</label>
                            <textarea name="long_des" id="product_ldesp" class="form-control">{{ $pro_info->long_description }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4 mb-3" style="width: 100%;">
                        <button style="width: 60%; display: block;" type="submit" class="btn btn-primary m-auto">Submit</button>
                    </div>

                </form>

                <div class="mb-5 mt-5">
                    <a class="btn btn-primary w-100" href="{{ route('product.edit.images.page', $pro_id) }}">Change product preview & thumbnails</a>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('footer_script')
    <script>
        window.onload = function () {
            var cat_id = $('.cat').val();
            var scat_id = $('.scat').val();
            // console.log(cat);
            // console.log(scat);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/getscat',
                type:'POST',
                data:{
                    'cid': cat_id,
                    'scid' : scat_id,
                },
                success:function (data) {
                    $('#scat').html(data);
                },
            });
        };
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