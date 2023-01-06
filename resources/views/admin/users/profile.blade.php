@extends('layouts.dash')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>

    <div class="container container-fluid" style="height: 60vh; padding-top: 0px; padding-bottom: 60px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="content" style="">

                </div>
            </div>
        </div>





    </div>

    <div class="container container-fluid" style="padding-top: 0px; padding-bottom: 60px;">
        <div class="row">
            <div class="col-md-8 m-auto">
                <a href="{{route('profile.update.edit')}}" class="text-center py-2 text-white rounded-pill" style="display: inline-block; width: 100%; background: rgb(114, 114, 114);">Edit Profile</a>
            </div>
        </div>
    </div>



@endsection
