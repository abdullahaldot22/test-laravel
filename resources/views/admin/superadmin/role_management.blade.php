@extends('layouts.dash')

@section('content')
<style>
.check-list label{
    transition: all ease-out 0.2s;
}
.check-list label:hover{
    color: #4021ca;
}
</style>
   
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h4>Add Permission</h4></div>
            <div class="card-body">
                <form action="{{ route('admin.permission.add') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="">Permission Name</label>
                        <input class="form-control" name="permission_name" type="text">
                    </div>
                    <button class="btn btn-primary">Add Permission</button>
                </form>
            </div>
        </div>
    </div>
<div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header"><h4>Roles & their Permissions</h4></div>
                <div class="card-body">
                    <table class="table primary-table-bordered table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->getAllPermissions() as $per)
                                            <span class="badge" style="margin: 2px 2px; background-color: #919fa8; color: #fff; border-radius: 8px; font-weight: 300;">{{ $per->name }}</span>
                                        @endforeach
                                    </td>
                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </button>
                                        <div class="dropdown-menu" style="font-size: 12px">
                                            <a href="{{ route('superadmin.role.action', $role->id) }}" class="dropdown-item">Edit</a>
                                            <a href="" class="dropdown-item">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h4>Add Admin Role</h4></div>
                <div class="card-body">
                    <div class="box" style="text-align:end;">
                        <div class="full">
                            <div class="">
                                <input type="checkbox" id="uncheckall" class="uncheckall">
                                <label style="margin-bottom: 0px; margin-left: 6px;" for="uncheckall">Deselect All</label>
                            </div>
                            <div class="">
                                <input type="checkbox" id="checkall" class="checkall">
                                <label style="margin-bottom: 0px; margin-left: 6px;" for="checkall">Select All</label>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('admin.role.add') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            @foreach($permission as $key => $perm)
                                <div class="form-check check-list">
                                    <input name="permissions[]" style="margin-top: 8px;" class="form-check-input checkme" type="checkbox" value="{{ $perm->id }}" id="flexCheckDefault{{ $key }}">
                                    <label class="form-check-label" for="flexCheckDefault{{ $key }}">{{ $perm->name }}</label>
                                </div>                                  
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Admin Role</label>
                            <input class="form-control" name="role_name" type="text">
                        </div>
                        <button class="btn btn-primary">Add Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h4>Assign Role to Admin</h4></div>
                <div class="card-body">
                    <form action="{{ route('superadmin.role.assign') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="">Role</label>
                            <div class="mb-4">
                                @foreach($roles as $key => $role)
                                    <div class="form-check check-list">
                                        <input name="role_id[]" style="margin-top: 8px;" class="form-check-input checkme" type="checkbox" value="{{ $role->id }}" id="roleid{{ $key }}">
                                        <label class="form-check-label" for="roleid{{ $key }}">{{ $role->name }}</label>
                                    </div>                                  
                                @endforeach
                            </div>

                            {{-- <select name="role_id" class="form-control">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>                                   --}}
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Admin</label>
                            <select class="form-control" name="admin_id">
                                <option value="">Select Admin</option>
                                @foreach($admins as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Assign Role</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header"><h4>Assigned Role to Admin</h4></div>
                <div class="card-body">
                    <table class="table primary-table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>Admin</th>
                                <th>Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <div class="tbody">
                            @foreach($admins as $admin)
                                
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>
                                    @foreach($admin->getRoleNames() as $rolename)
                                        <span class="badge" style="margin: 2px 2px; background-color: #919fa8; color: #fff; border-radius: 8px; font-weight: 300;">{{ $rolename }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                    </button>
                                    <div class="dropdown-menu" style="font-size: 12px">
                                        <a href="{{ route('superadmin.admin.role.edit', $admin->id) }}" class="dropdown-item">Edit</a>
                                        {{-- <a href="" class="dropdown-item">Delete</a> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $('.checkall').click(function(){
            var checked = $(this).prop('checked');
            $('.checkme').prop('checked', checked);
        });
        $('.uncheckall').click(function(){
            var unchecked = $(this).prop('checked');
            $('.checkme').prop('checked', '');
        });
    </script>
@endsection