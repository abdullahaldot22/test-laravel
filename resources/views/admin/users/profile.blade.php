@extends('layouts.dash')

@section('content')
<style>
    .fullbox{
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        /* flex-grow: 1; */
    }
    .boxi{
        text-align: center;
    }
    .boxii{
        padding-left: 30px;
        width: 100%;
        display: flex;
        flex-flow: row wrap;
        /* align-items: center; */
        /* flex-grow: 1; */
        /* justify-content: start; */
    }
    .boxii .part{
        width: 50%;
    }
    .boxii label{
        font-size: 18px;
        color: #1f5d86;
    }
    .boxii .information{
        font-size: 14px;
        line-height: 28px;
    }
    .fulldiv{
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
    }
    .fulldiv .divi{
        /* max-width: 50%;
        min-width: 20%; */
        width: 50%;
        text-align: center;
    }
    .fulldiv .divii{
        /* min-width: 50%;
        max-width: 80%; */
        width: 100%;
    }
</style>

    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card pt-4 pb-4">
                    <div class="card-body">
                        <div class="fullbox">
                            <div class="boxi" style="margin: auto 0; width: 360px;">
                                <img width="180px" height="180px" style="padding: 15px; border-radius: 50%; border: 1px solid #eee7e7;" src="{{ $info->image == null ? asset('backend/images') : asset('uploads/user') }}/{{ $info->image == null ? 'user-dummy.png' : $info->image }}" alt="">
                            </div>
                            <div class="boxii">
                                <div class="mb-3 part">
                                    <label for="">Name</label>
                                    <div class="information">{{ $info->name }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Email</label>
                                    <div class="information">{{ $info->email }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Added By</label>
                                    <div class="information">{{ $info->added_by == null ? 'Registretion' : $info->added_by }}</div>
                                </div>
                                {{-- <div class="mb-3 part">
                                    <label for="">Address</label>
                                    <div class="information">{{ $info->address == null ? '-' : $info->address }}</div>
                                </div> --}}
                                {{-- <div class="mb-3 part">
                                    <label for="">Country</label>
                                    <div class="information">{{ $info->country == null ? '-' : $info->country }}</div>
                                </div> --}}
                                {{-- <div class="mb-3 part">
                                    <label for="">Last Purches Activity</label>
                                    @php
                                        $var = '';
                                        if ($order->first() == null) {
                                            $var = '-';
                                        }else {
                                            $var = date('d, M Y', strtotime($order->take(1)->first()->created_at));
                                        }
                                    @endphp
                                    <div class="information">{{ $var }}</div>
                                </div> --}}
                                <div class="mb-3 part">
                                    <label for="">Created At</label>
                                    <div class="information">{{ $info->created_at == null ? '-' : date('d, M Y', strtotime($info->created_at)) }}</div>
                                </div>
                                <div class="mb-3 part">
                                    <label for="">Last Info Update Time</label>
                                    <div class="information">{{ $info->updated_at == null ? '-' : date('d, M Y', strtotime($info->updated_at)) }}</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="fulldiv">
                            <div class="divi">Roles</div>
                            <div class="divii">
                                @foreach($info->getRoleNames() as $val)
                                    <span class="badge" style="margin: 2px 2px; background-color: #919fa8; color: #fff; border-radius: 8px; font-weight: 300;">{{ $val }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container container-fluid" style="height: 60vh; padding-top: 0px; padding-bottom: 60px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="content" style="">

                </div>
            </div>
        </div>





    </div> --}}

    <div class="container container-fluid" style="padding-top: 0px; padding-bottom: 60px;">
        <div class="row">
            <div class="col-md-8 m-auto">
                <a href="{{route('profile.update.edit')}}" class="text-center py-2 text-white rounded-pill" style="display: inline-block; width: 100%; background: rgb(114, 114, 114);">Edit Profile</a>
            </div>
        </div>
    </div>



@endsection
