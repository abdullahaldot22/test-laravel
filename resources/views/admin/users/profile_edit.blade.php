@extends('layouts.dash')

@section('content')


    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Edit Profile Image
                </div>
                <div class="card-body">
                    <form action="{{route('image.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-lebel">Image</label>
                            <input type="file" name="image" class="form-control" onchange="document.getElementById('bla').src=window.URL.createObjectURL(this.files[0])">
                            @error('image')
                                <strong class="tt text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-4 mt-4">
                            <div class="img m-auto" style="width: 180px; box-sizing: content-box; padding: 25px; border: 2px solid rgb(245, 245, 245); border-radius: 8px;">
                                <img id="bla" style="display: flex; flex-flow: row no-wrap; width: 100%; align-items:center; justify-content: center;" src="{{ asset('uploads/user') }}/{{ Auth::user()->image }}" alt="">
                            </div>
                        </div>

                        <div class="mb-3 pt-2">
                            <button type="submit" class="btn btn-primary">Update Image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Edit Profile INFO
                </div>
                <div class="card-body">
                    <form action="{{route('profile.update')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-lebel">Name</label>
                            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-lebel">Email</label>
                            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                        </div>

                        <div class="mb-3 pt-2">
                            <button type="submit" class="btn btn-primary">Update INFO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Update Password
                </div>
                <div class="card-body">
                    <form action="{{route('password.update')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-lebel">Old Password</label>
                            <input type="password" name="old_password" class="form-control">
                            @error('old_password')
                                <strong class="tt pt-2">{{$message}}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-lebel">New Password</label>
                            <div class="box">
                                <input id="pass" placeholder="********" type="password" name="password" class="form-control">
                                <i id="pass_ic" class="fa fa-eye"></i>
                            </div>
                            @error('password')
                                <strong class="tt pt-2">{{$message}}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-lebel">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                            @error('password_confirmation')
                                <strong class="tt pt-2">{{$message}}</strong>
                            @enderror
                        </div>

                        <div class="mb-3 pt-2">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





@endsection


@section('footer_script')

<script>
    $('#pass_ic').click(function () {
        var pass = document.getElementById('pass');
        var icon = document.getElementById('pass_ic');
        if (pass.type == 'password') {
            pass.type = 'text';
        }
        else{
            pass.type = 'password';
        }
    })
</script>

    @if (session('pass_success'))
        <script>
            Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: '{{session('pass_success')}}',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    @endif

    @if (session('ne_success'))
        <script>
            Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: '{{session('ne_success')}}',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    @endif

    @if (session('image'))
        <script>
            Swal.fire({
            position: 'bottom-right',
            icon: 'success',
            title: '{{session('image')}}',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    @endif


@endsection
