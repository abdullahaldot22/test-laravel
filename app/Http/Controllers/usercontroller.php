<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
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

    function users_add(Request $request) {
        $request->validate([
            'name' => 'required|min:5|regex:/^[A-za-z]+\s[A-za-z]+$/|max:40',
            'mail' => 'required|email|unique:users,email',
            'pass' => 'required|min:8|regex:/^[a-zA-Z\d_!\-@#\$%&*?]{8,}$/|confirmed',
            'pass_confirmation' => 'required|min:8|required_with:pass|same:pass',
            'image'=>'required|file|max:4096|mimes:jpg,png,jpeg',
        ],[
            'name.required' => 'Name cannot be empty',
            'name.regex' => 'Name cannot contain any character without alphabet & should contain atleast 2 words',
            'name.min' => 'Name must contain atleast 5 character',
            'mail.required' => 'Mail is required',
            'mail.email' => 'It should be a valid mail id',
            'mail.unique' => 'This mail id is already used try with another mail id',
            'pass.required' => 'Password cannot be empty',
            'pass.min' => 'Password must contain 8 or more character long',
            'pass.regex' => 'Password must contain alphanumeric character and some limited symbol',
            'pass.confirmed' => 'Enter your password properly',
            'pass_confirmation.required' => 'This field cannot be empty',
            'pass_confirmation.min' => 'This field must contain atleast 8 or more character',
            'pass_confirmation.same' => 'This field must contain as same character as Password contain',
            'pass_confirmation.required_with' => 'This field must be filled with characters as same as password contain',
            'image.required' => 'This field is required',
            'image.max' => 'The image size limitation is upto 4 MB',
            'image.mimes' => 'The image extention must contain jpg or png format',
        ]);

        $added_user = User::create([
            'name' => $request->name,
            'email' => $request->mail,
            'password' => bcrypt($request->pass),
            'added_by' => Auth::id(),
            'remember_token' => $request->token,
            'created_at' => Carbon::now(),
        ]);

        $id = $added_user->id;
        $file = $request->image;
        $ext = $file->getClientOriginalExtension();
        $file_name = $id.'.'.$ext;
        $img = Image::make($file)->resize(600,600)->save(public_path('uploads/user/'.$file_name));

        user::find($id)->update([
            'image' => $file_name,
        ]);
        return back()->with('log', 'User was added successfully !');
    }
}
