@extends('layouts.dash')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Users</a></li>
    </ol>
</div>

{{-- <div class="container" style="padding-top: 0px; padding-bottom: 60px;"> --}}
    <div class="row">
        <div class="col-lg-3 order-2">
            <div class="card">
                <div class="card-header">
                    <h3>Add User</h3>
                    <div class="message">
                        @if(session('add_err'))
                            <div class="alert alert-danger">{{ session('add_err') }}</div>
                        @else
                            
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.add.user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control" type="text" name="name" placeholder="User Name">
                            @error('name')
                                <strong class="tt text-danger mt-2">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="email" name="mail" placeholder="Your Email">
                            @error('mail')
                                <strong class="tt text-danger mt-2">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="password-input">
                                <input id="pass" class="form-control" style="padding-right: 58px; letter-spacing: 2px;" type="password" name="pass" placeholder="Your Password">
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
                        <div class="mb-4">
                            <input class="form-control" type="file" name="image" placeholder="Your Profile Picture" onchange="document.getElementById('bla').src=window.URL.createObjectURL(this.files[0])">
                            @error('image')
                                <strong class="tt text-danger mt-2">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="img m-auto" style="width: 180px; height: 180px; box-sizing: content-box; padding: 25px; border: 2px solid rgb(245, 245, 245); border-radius: 8px;">
                                <img id="bla" style="display: flex; flex-flow: row no-wrap; width: 100%; align-items:center; justify-content: center;" src="{{ asset('backend/images/user-dummy.png') }}" alt="">
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Add User</button>

                    </form>
                </div>
            </div>
        </div>
    {{-- </div>
    <div class="row"> --}}
        <div class="col-lg-9 order-1">

            <div class="box px-4 pb-1" style="background: #ffffff; border-radius: 12px;">
                <div class="box-header py-4" style="color: #383838b6;">
                    <b>Users INFO</b>
                </div>
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Added By</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>

                        

                        @foreach ($users as $sl => $user)
                        <tr style="background-color: {{ $user->id == Auth::id() ? 'turquoise' : '' }}">
                            <td>{{$sl + 1}}</td>
                            <td>
                                @if ($user->image == null)
                                    <img style="border-radius: 50%; width: 40px; height: 40px; border: 1px solid #858585; box-sizing: border-box;" src="{{ Avatar::create($user->name)->toBase64() }}" />
                                @else
                                    <img style="border-radius: 50%; width: 40px; height: 40px; border: 1px solid #858585; box-sizing: border-box;" src="{{asset('/uploads/user/')}}/{{$user->image}}" alt="">
                                @endif
                            
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->added_by == null ? 'Login' : App\Models\User::find($user->added_by)->name}}</td>
                            <td>{{date('d, M Y',strtotime($user->created_at))}}</td>
                            <td>{{date('d, M Y',strtotime($user->updated_at))}}</td>
                            <td>
                                <div class="dropdown show {{ $user->id == Auth::id() ? 'd-none' : '' }}">
                                    <button type="button" class="btn btn-success light sharp" data-toggle="dropdown" aria-expanded="true">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-26px, 40px, 0px);">
                                        <a class="dropdown-item" href="{{ route('admin.edit.users.page', $user->id) }}">Edit</a>
                                        <a class="dropdown-item" href="{{route('admin.user.delete', $user->id)}}">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

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

        <script>
            $('.del').click(function(){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var link = $(this).val();
                    window.location.href = link;
                }
                });
            });
        </script>


        @if (session('succeed'))
            <script>
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            </script>
        @endif

@endsection
