@extends('layouts.dash')

@section('content')

<style>
    .search:focus{
        border-color: #f0f1f5;
    }
    .search-btn:focus{
        box-shadow: none;
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
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-body">
                <table class="table primary-table-bordered">
                    <thead>
                        <tr class="thead-primary">
                            <th>Image</th>
                            <th>Name</th>
                            <th class="text-center">Order Products</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer as $val)
                        <tr>
                            <td><a href="{{ route('admin.customer.control.details', $val->id) }}"><img style="border-radius: 50%; padding: 5px;border: 1px solid #f0f1f5;" width="40px" src="{{ $val->profile_image == null ? asset('backend/images') : asset('uploads/customer') }}/{{ $val->profile_image == null ? 'user-dummy.png' : $val->profile_image }}" alt=""></a></td>
                            <td><a href="{{ route('admin.customer.control.details', $val->id) }}">{{ $val->name }}</a></td>
                            <td class="text-center">{{ $val->rel_to_opro->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection