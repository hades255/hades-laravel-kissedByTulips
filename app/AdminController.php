<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\ProfileRequest;
use App\Http\Requests\admin\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){  //show dashboard page for admin
      return view('admin.index');
    }

    public function myProfile(){  //show my profile page for admin
      $profile = Auth::user();
      return view('admin.my-profile',compact('profile'));
    }

    public function adminProfileUpdate(ProfileRequest $request){ //update profile for admin
      $user_id = Auth::user()->id;
      $user = User::find($user_id);
      $user->update([
          'first_name' => $request->first_name,
          'last_name'  => $request->last_name,
          'email'      => $request->email,
          'phone'      => $request->phone,
      ]);
      session()->flash('success', 'Hi Admin , Your Account Info Updated Sucessfully!');
      return redirect()->route('admin.my-profile');
    }

    public function adminResetPassword(){ //show reset password form for admin
      return view('admin.reset-password');
    }

    public function adminPasswordUpdate(PasswordRequest $request){ //update password for admin
      $user_id = Auth::user()->id;
      $user = User::find($user_id);
      $user->update([
          'password' => Hash::make($request->password),
      ]);
      session()->flash('success', 'Hi Admin , Your Account Password Changed Sucessfully!');
      return redirect()->route('admin.my-profile');
    }

}
