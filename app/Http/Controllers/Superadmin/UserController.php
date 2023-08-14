<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Account;
use App\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
  public function index(){
    $currentAccount = Auth::user()->pk_account;
    $users = User::where('pk_account',$currentAccount)->get();
    return view('superadmin.users.index',['users'=>$users]);
  }

  public function create(){
    $roles       = Role::all();
    $accounts    = Account::all();
    return view('superadmin.users.add',['roles'=>$roles,'accounts'=>$accounts]);
  }

  public function edit($id){
    $user        = User::find($id);
    $roles       = Role::all();
    $getUser     = User::where('pk_users',$user->pk_users)->first();
    $accounts    = Account::all();
    return view('superadmin.users.add',['user'=>$user,'roles'=>$roles,'getUser'=>$getUser,'accounts'=>$accounts]);
  }

  public function store(Request $request){
    $validated = $request->validate([
       'email' => 'required|email|max:255',
       'username' => 'required|max:12',
       'first_name' => 'required',
       'last_name' => 'required',
       'email' => 'required',
    ]);
    if($request->pk_users == ""){
            $user  = new User;
            $user->first_name  = $request->first_name;
            $user->last_name   = $request->last_name;
            $user->email       = $request->email;
            $user->pk_account  = $request->pk_account;
            $user->pk_roles     = $request->pk_roles;
            $user->username    = $request->username;
            $user->phone       = $request->phone;
            $user->password    = Hash::make($request->password);
            $user->save();
        }else{
            $user = User::find($request->pk_users);
            $user->first_name  = $request->first_name;
            $user->last_name   = $request->last_name;
            $user->email       = $request->email;
            $user->pk_account  = $request->pk_account;
            $user->pk_roles     = $request->pk_roles;
            $user->username    = $request->username;
            $user->phone       = $request->phone;
            $user->active      = $request->active;
            $user->save();
        }
         return redirect()->route('users.index')
                        ->with('message','User updated successfully');
  }

  public function delete(Request $request,$id){
    DB::table('users')->where('pk_users',$id)->delete();
    return redirect()->route('users.index')
                   ->with('message','User deleted successfully');
  }

  public function back(){
    return redirect('/superadmin/users');
  }

  public function profile(){
    $pk_account = Auth::user()->pk_account;
    $pk_users   = Auth::user()->pk_users;
    $user       = User::where('pk_users',$pk_users)->where('pk_account',$pk_account)->first();
    $roles      =  Role::all();
    return view('common.superadmin-profile',['user'=>$user,'roles'=>$roles]);
  }

  public function updateProfile(Request $request){
    $validated = $request->validate([
       'email' => 'required|email|max:255',
       'first_name' => 'required',
       'last_name' => 'required'
    ]);
    $user = User::find($request->pk_users);
    $user->first_name  = $request->first_name;
    $user->last_name   = $request->last_name;
    $user->email       = $request->email;
    $user->username    = $request->username;
    $user->phone       = $request->phone;
    $user->save();
    return redirect('/superadmin');
  }

  public function getReset(Request $request,$id){
    $user = User::find($id);
    return view('superadmin.users.reset-password',['user'=>$user]);

  }

  public function postReset(Request $request){
    $request->validate([
      'password' => 'required|string|min:6|confirmed',
    ]);
     $user            = User::find($request->pk_users);
     $user->password = Hash::make($request->password);
     $user->active   = $request->active;
     $user->save();
    // if (Hash::check($request->current_password, $user->password)) {
    // //  echo "hello"; die;
    //    $user->fill([
    //     'password' => Hash::make($request->password)
    //     ])->save();
    //   //  echo "Done"; die;
    //     $request->session()->flash('success', 'Password changed');
    //     return redirect()->back();
    //
    //   } else {
    //   $request->session()->flash('error', 'Password does not match');
    //   return redirect()->back();
    //   }
    return redirect()->back();
  }

}
