@extends('layouts.dash')

@section('content')

<style>
    .search:focus{
        border-color: #f0f1f5;
    }
    .search-btn:focus{
        box-shadow: none;
    }
    .div{
        display: grid;
        grid-auto-flow: column;
        grid-template-columns: 120px auto;
        grid-column-gap: 30px;
    }
    .rating i{
        font-size: 12px;
    }
    .card .card-body{
        width: 100%;
        display: flex;
        flex-flow: row nowrap;

    }
    .card .card-body .boxii{
        width: 100%;
        display: flex;
        flex-flow: column nowrap;
    }
    .card .card-body .boxii .part{
        display: grid;
        grid-auto-flow: column;
        grid-template-columns: auto auto auto;
        border-bottom: 1px solid #f0f1f5;
    }
    .card .card-body .boxii .part:last-of-type{
        border-bottom: none;
    }
</style>
<div class="row mb-5">
    <div class="col-lg-12">
        <div class="input-group mb-3 w-50 m-auto">
            <input type="text" class="form-control search" style="border-radius: 10px 0 0 10px;" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
            <button class="btn search-btn" style="border: 1px solid #f0f1f5; border-radius: 0 10px 10px 0; border-left: 0px; outline: none;" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>              
    </div>
</div>

<div class="row">
    @forelse($review->groupBy('product_id') as $opro)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-1">
                        <div class="boxi text-center" style="margin: auto 0;">
                            <img width="55px" style="border-radius: 4px; padding: 5px; border: 1px solid #dad6d6da;" src="{{ asset('uploads/product/preview') }}/{{ $opro->first()->rel_to_product->preview }}" alt="">
                            <div class="name mt-3" style="font-size: 14px;">{{ $opro->first()->rel_to_product->product_name }}</div>
                        </div>
                    </div>
                    <div class="col-lg-11">
                        <div class="boxii">
                            @forelse($opro as $rev)
                                <div class="part w-100" style="padding: 14px 0;">
                                    <div class="pi text-center" style="width: 140px;">
                                        <img width="35px" style="border-radius: 50%; padding: 5px; border: 1px solid #dad6d6da;" src="{{ $rev->rel_to_customer->profile_image == null ? asset('backend/images') : asset('uploads/customer') }}/{{ $rev->rel_to_customer->profile_image == null ? 'user-dummy.png' : $rev->rel_to_customer->profile_image }}" alt="">
                                        <div class="name mt-2" style="font-size: 13px;">{{ $rev->rel_to_customer->name }}</div>
                                        <div class="rating mt-1">
                                            @for($i = 0; $i < $rev->star; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="pii" style="padding: 0 20px; font-size: 13px; color:#6b6b6b; margin: auto 0;" >{{ $rev->review }}</div>
                                    @can('product_review_delete')
                                        
                                    <div class="piii" style="margin: auto 0;"><a href="{{ route('admin.remove.review', $rev->id) }}" class="btn-danger" style="padding: 6px 10px; border-radius: 6px; border: none;">Delete</a></div>
                                    @endcan
                                </div>
                            @empty
    
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        
    @endforelse
</div>
@endsection