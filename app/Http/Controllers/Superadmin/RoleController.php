<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use DB;

class RoleController extends Controller
{
  public function index(){
    $roles = Role::all();
    return view('superadmin.role.index',['roles'=>$roles]);
  }

  public function create(){
    return view('superadmin.role.add');
  }

  public function edit($id){
    $role        = Role::where('pk_roles',$id)->first();
    return view('superadmin.role.add',['role'=>$role]);
  }

  public function store(Request $request){
    if($request->pk_roles == ""){
    $role              = new Role;
    $role->roles       = $request->roles;
    $role->description = $request->description;
    $role->save();
    }
    else{
    $role                = Role::find($request->pk_roles);
    $role->roles         = $request->roles;
    $role->description   = $request->description;
    $role->active        = $request->active;
    $role->save();
    }
    return redirect()->route('roles.index')
                   ->with('message','Role Added successfully');
  }

  public function delete(Request $request,$id){
    DB::table('kbt_roles')->where('pk_roles',$id)->delete();
    return redirect()->route('roles.index')
                   ->with('message','Role deleted successfully');
  }

  public function back(){
    return redirect('/superadmin/roles');
  }

}
