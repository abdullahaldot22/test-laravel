@extends('layouts.dash')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Users</a></li>
    </ol>
</div>

<div class="container container-fluid" style="padding-top: 0px; padding-bottom: 60px;">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="py-4">User page!</h2>

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
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>

                        

                        @foreach ($users as $sl => $user)
                        <tr>
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
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>{{$user->updated_at->diffForHumans()}}</td>
                            <td><button class="btn btn-danger del" value="{{route('user.delete', $user->id)}}">Delete</button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')

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
