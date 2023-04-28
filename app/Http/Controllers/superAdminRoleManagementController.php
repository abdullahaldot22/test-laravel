<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class superAdminRoleManagementController extends Controller
{
    function admin_permission_add(Request $request) {
        $permission = Permission::create(['name' => $request->permission_name]);
        // return $request->all();
        return back();
    }

    function admin_role_add(Request $request) {
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permissions);
        return back();
    }

    function superadmin_role_action($role_id) {
        $permission = Permission::all();
        $role = Role::find($role_id);
        return view('admin.superadmin.role_edit_action.edit_role_permission', [
            'role_id' => $role_id,
            'permission' => $permission,
            'role' => $role,
        ]);
    }

    function superadmin_role_permission_update(Request $request) {
        // print_r($request->all());
        $request->validate([
            'role_name' => 'unique:roles,name',
        ]);
        Role::find($request->role_id)->syncPermissions($request->permissions);
        Role::find($request->role_id)->update([
            'name' => $request->role_name,
        ]);
        return back();
    }

    function superadmin_role_assign(Request $request) {
        // print_r($request->all());
        $user = User::find($request->admin_id);
        $role = $request->role_id;
        $user->assignRole($role);
        // echo 'done';
        return back();
    }

    function superadmin_admin_role_edit_page($admin_id) {
        $info = User::find($admin_id);
        $roles = Role::all();
        return view('admin.superadmin.role_edit_action.assigned_admin_role_edit', [
            'info' => $info,
            'roles' => $roles,
        ]);
    }

    function superadmin_admin_role_action_edit(Request $request) {
        $user = User::find($request->user_id);
        $user->syncRoles($request->roles);
        return redirect()->route('superadmin.role.management');
    }
}
