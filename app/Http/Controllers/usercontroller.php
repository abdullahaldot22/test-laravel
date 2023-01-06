<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    function users() {
        $users=  User::all();
        return view('admin.users.user', compact('users'));
    }

    function user_delete($user_id) {
        User::find($user_id)->delete();
        return back()->with('succeed', 'The deletion operation succeed properly!');
    }

    function profile(){
        return view('admin.users.profile');
    }

    function profile_update_edit(){
        return view('admin.users.profile_edit');
    }

    function profile_update(Request $request){
        // print_r($request->all());
        User::find(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return back()->with('ne_success', 'Profile INFO updated successfully.');
    }

    function password_update(Request $request){
        // print_r($request->all());
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
            'password_confirmation' => 'required'
        ],[
            'old_password.required' => 'Your old password cannot be empty!',
            'password.required' => 'To update your password please input the new password!',
            'password_confirmation.required' => 'Please re enter your password to update!',
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('pass_success', 'Password Changed successfully.');
        }
        else {
            return back()->with('error', 'Invalid old password.');
        }
    }

    function image_update(Request $request){
        $request->validate([
            'image'=>'file|max:4096',
            'image'=>'mimes:jpg,png,gif',
            'image'=>'required',
        ]);

            $uploaded_file = $request->image;
            $extention = $uploaded_file->getClientOriginalExtension();
            $file_name=Auth::id().'.'.$extention;

            $img = Image::make($uploaded_file)->resize(600, 400)->save(public_path('uploads/user/'.$file_name));
            User::find(Auth::id())->update([
                'image'=>$file_name,
            ]);
            return back()->with('image', 'Image updated successfully.');
    }
}
