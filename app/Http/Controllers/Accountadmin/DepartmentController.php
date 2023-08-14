<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use Auth;
use DB;

class DepartmentController extends Controller
{
  public function index(){
   $account =  Auth::user()->pk_account;
   $departments = Department::where('pk_account',$account)->get();
   return view('accountadmin.department.index',['departments'=>$departments]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.department.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $department = DB::table('kbt_department')->where('pk_account',$pk_account)->where('pk_department',$id)->first();
   return view('accountadmin.department.add',['pk_account' => $pk_account,'department'=>$department]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'department' => 'required|max:30'
   ]);
   if(!empty($request->pk_department)){
     $department  = Department::find($request->pk_department);
     $department->pk_account       = $request->pk_account;
     $department->department       = $request->department;
     $department->description      = $request->description;
     $department->active           = $request->active;
     $department->save();
   }
   else{
     $department  = new Department;
     $department->pk_account       = $request->pk_account;
     $department->department       = $request->department;
     $department->description      = $request->description;
     $department->save();
   }
   return redirect('/accountadmin/department');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_department')->where('pk_account' , $pk_account)->where('pk_department',$id)->delete();
   return redirect()->route('accountadmin.department.index')
                  ->with('message','products-categories deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/department');
 }

}
