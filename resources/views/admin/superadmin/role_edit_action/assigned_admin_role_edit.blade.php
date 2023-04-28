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
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Roles of </h4>
                    <div class="box">
                        <img width="40px" height="40px" src="{{ asset('uploads/user') }}/{{ $info->image }}" alt="">
                        <span style="margin-left: 12px;">{{ $info->name }}</span>
                    </div>
                </div>
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
                    <form action="{{ route('admin.role.action.edit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $info->id }}">
                        <div class="mb-4">
                            @foreach($roles as $key => $role)
                                <div class="form-check check-list">
                                    <input name="roles[]" {{ $info->hasRole($role->name) ? 'checked' : '' }} style="margin-top: 8px;" class="form-check-input checkme" type="checkbox" value="{{ $role->id }}" id="flexCheckDefault{{ $key }}">
                                    <label class="form-check-label" for="flexCheckDefault{{ $key }}">{{ $role->name }}</label>
                                </div>                                  
                            @endforeach
                        </div>
                        <button class="btn btn-primary">Update Role</button>
                    </form>
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