<?php

namespace App\Http\Controllers\Accountadmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Role;
use App\User;
use App\Location;
use App\UserLocation;

class UserController extends Controller
{
    public function index(){
      $getCurrentUser = Auth::user();
      $users = DB::table('users')->where('pk_account',$getCurrentUser->pk_account)->get();
      $roles =  Role::all();
      return view('accountadmin.users.index',['users'=>$users,'roles'=>$roles]);
    }

    public function edit(Request $request , $id){
      $roles = Role::all();
      $locations = Location::all();
      $getCurrentUser = User::with('locations')->where('pk_users',$id)->first();
      return view('accountadmin.users.edit',['roles' => $roles,'getCurrentUser'=>$getCurrentUser,'locations'=>$locations]);
    }

    public function create(){
      $roles = Role::all();
      $locations = Location::all();
      $getCurrentAccount = Auth::user();
      return view('accountadmin.users.add',['roles' => $roles,'getCurrentAccount'=>$getCurrentAccount,'locations'=>$locations]);
    }

    public function store(Request $request){
      $validated = $request->validate([
        'pk_roles' => 'required',
        'email' => 'required|email|max:255|unique:users',
        'username' => 'required|max:12|unique:users',
        'first_name' => 'required',
        'last_name' => 'required'
      ]);
      
      $pk_locations = isset($request->pk_locations) ? $request->input('pk_locations', []) : '';
      $user                = new User();
      $user->pk_roles      = $request->pk_roles;
      $user->pk_account    = $request->pk_account;
      $user->first_name    = $request->first_name;
      $user->last_name     = $request->last_name;
      $user->email         = $request->email;
      $user->username      = $request->username;
      $user->phone         = $request->phone;
      $user->password      = Hash::make($request->password);
      $user->save();
      
       if(!empty($pk_locations)){
        $locations = Location::whereIn('pk_locations', $pk_locations)->get();
        foreach ($locations as  $locationIds) {
          $userLocation = new UserLocation;
          $userLocation->pk_users = $user->pk_users;
          $userLocation->pk_locations = $locationIds->pk_locations;
          $userLocation->save();
        }
       }
       
        
       return redirect()->route('adminusers.index');
    }

    public function update(Request $request){
      $validated = $request->validate([
         'pk_roles' => 'required',
         'email' => 'required|email|max:255',
         'username' => 'required|max:12',
         'first_name' => 'required',
         'last_name' => 'required'
      ]);
      $user = User::find($request->pk_users);
      $user->first_name  = $request->first_name;
      $user->last_name   = $request->last_name;
      $user->email       = $request->email;
      $user->pk_account  = $request->pk_account;
      $user->pk_roles    = $request->pk_roles;
      $user->username    = $request->username;
      $user->phone       = $request->phone;
      $user->active      = $request->active;
      $user->save();
      if(!empty($request->pk_locations)){
        $oldLocations = UserLocation::where('pk_users',$user->pk_users)->get();
              foreach ($oldLocations as $oldLocation) {
                $oldLocation->delete();
               } 
        foreach ($request->pk_locations as  $locationIds) {
          $userLocation =  new UserLocation;
          $userLocation->pk_users = $user->pk_users;
          $userLocation->pk_locations = $locationIds;
          $userLocation->save();
        }
       }
      return redirect()->route('adminusers.index')
                     ->with('message','User updated successfully');
    }

    public function delete(Request $request,$id){
      DB::table('users')->where('pk_users',$id)->delete();
      return redirect()->route('adminusers.index')
                     ->with('message','User deleted successfully');
    }

    public function back(){
      return redirect('/accountadmin/users');
    }


    public function profile(){
      $pk_account = Auth::user()->pk_account;
      $pk_users   = Auth::user()->pk_users;
      $user       = User::where('pk_users',$pk_users)->where('pk_account',$pk_account)->first();
      $roles      = Role::all();
      return view('common.accountadmin-profile',['user'=>$user,'roles'=>$roles]);
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
      return redirect('/accountadmin');
    }

    public function getReset(Request $request,$id){
      $user = User::find($id);
      return view('accountadmin.users.reset',['user'=>$user]);

    }

    public function resetSubmit(Request $request){

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
      //     'password' => Hash::make($request->password),
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
