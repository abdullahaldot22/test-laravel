@extends('layouts.dash')

@section('content')
    {{-- {{ $role_id }} --}}
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header"><h4>Edit Roles and Assigned Permission</h4></div>
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
                    <form action="{{ route('admin.role.permission.update') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            @foreach($permission as $key => $per)
                                <div class="form-check check-list">
                                    <input name="permissions[]" {{ $role->hasPermissionTo($per->name) ? 'checked' : '' }} style="margin-top: 8px;" class="form-check-input checkme" type="checkbox" value="{{ $per->id }}" id="flexCheckDefault{{ $key }}">
                                    <label class="form-check-label" for="flexCheckDefault{{ $key }}">{{ $per->name }}</label>
                                </div>                                  
                            @endforeach
                        </div>
                        <input type="hidden" name="role_id" value="{{ $role_id }}">
                        <div class="mb-3">
                            <label class="form-label" for="">Admin Role</label>
                            <input class="form-control" name="role_name" type="text" value="{{ $role->name }}">
                        </div>
                        <button class="btn btn-primary">Update Role</button>
                    </form>
                </div>
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