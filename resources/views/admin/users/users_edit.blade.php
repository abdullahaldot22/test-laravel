@extends('layouts.dash')

@section('content')

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Edit Info</h3>
                <div class="message">
                    @if(session('info'))
                        <div class="alert-danger">{{ session('info') }}</div>
                    @else
                        
                    @endif
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.edit.info') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="usr_id" value="{{ $usr_id }}">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="name" placeholder="User Name" value="{{ $info->name }}">
                        @error('name')
                            <strong class="tt text-danger mt-2">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input class="form-control" type="email" name="mail" placeholder="Email" value="{{ $info->email }}">
                        @error('mail')
                            <strong class="tt text-danger mt-2">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Edit Info</button>
    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Update Password</h3>
                <div class="message">
                    @if(session('pass'))
                        <div class="alert-danger">{{ session('pass') }}</div>
                    @else
                        
                    @endif
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.edit.password') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="usr_id" value="{{ $usr_id }}">
                    <div class="mb-3">
                        <div class="password-input">
                            <input id="pass" class="form-control" style="padding-right: 58px; letter-spacing: 2px;" type="password" name="pass" placeholder="New Password">
                            <div class="phide">
                                <img class="hide" src="{{ asset('backend/images/eye-protector.png') }}" alt="">
                            </div>
                        </div>
                        @error('pass')
                            <strong class="tt text-danger mt-2">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="password-input">
                            <input id="cpass" class="form-control" style="padding-right: 58px; letter-spacing: 2px;" type="password" name="pass_confirmation" placeholder="Confirm Password">
                            <div class="cphide">
                                <img class="hide" src="{{ asset('backend/images/eye-protector.png') }}" alt="">
                            </div>
                        </div>
                        @error('pass_confirmation')
                            <strong class="tt text-danger mt-2">{{ $message }}</strong>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Update Password</button>
    
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Edit User profile Image</h3>
                <div class="message">
                    @if(session('image'))
                        <div class="alert-danger">{{ session('image') }}</div>
                    @else
                        
                    @endif
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.edit.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="usr_id" value="{{ $usr_id }}">
                    <div class="mb-4">
                        <input class="form-control" type="file" name="image" placeholder="Your Profile Picture" onchange="document.getElementById('bla').src=window.URL.createObjectURL(this.files[0])">
                        @error('image')
                            <strong class="tt text-danger mt-2">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="img m-auto" style="width: 180px; box-sizing: content-box; padding: 25px; border: 2px solid rgb(245, 245, 245); border-radius: 8px;">
                            <img id="bla" style="display: flex; flex-flow: row no-wrap; width: 100%; align-items:center; justify-content: center;" src="{{ asset('uploads/user') }}/{{ $info->image }}" alt="">
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Edit Image</button>
    
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('footer_script')
<script>
    $('.cphide').click(function () {
        var cpass = document.getElementById('cpass');
        if(cpass.type == 'password'){
            cpass.type = 'text';
        }
        else{
            cpass.type = 'password';
        }
    })
    $('.phide').click(function () {
        var pass = document.getElementById('pass');
        if(pass.type == 'password'){
            pass.type = 'text';
        }
        else{
            pass.type = 'password';
        }
    })
</script>
@endsection