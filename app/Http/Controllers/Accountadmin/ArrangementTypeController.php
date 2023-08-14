<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArrangementType;
use Auth;
use DB;

class ArrangementTypeController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $ArrangementTypes = ArrangementType::where('pk_account',$account)->get();
   return view('accountadmin.arrangement-type.index',['ArrangementTypes'=>$ArrangementTypes]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.arrangement-type.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $ArrangementType = DB::table('kbt_arrangement_type')->where('pk_account',$pk_account)->where('pk_arrangement_type',$id)->first();
   //echo "<pre>";print_r($style); die;
   return view('accountadmin.arrangement-type.add',['pk_account' => $pk_account,'ArrangementType'=>$ArrangementType]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'arrangement_type' => 'required|max:30',
   ]);
   if(!empty($request->pk_arrangement_type)){
     $ArrangementType  = ArrangementType::find($request->pk_arrangement_type);
     $ArrangementType->pk_account       = $request->pk_account;
     $ArrangementType->arrangement_type = $request->arrangement_type;
     $ArrangementType->minimum_amount   = $request->minimum_amount;
     $ArrangementType->maximum_amount   = $request->maximum_amount;
     $ArrangementType->description      = $request->description;
     $ArrangementType->price            = $request->price;
     $ArrangementType->active           = $request->active;
     $ArrangementType->save();
   }
   else{
     $ArrangementType                   = new ArrangementType;
     $ArrangementType->pk_account       = $request->pk_account;
     $ArrangementType->arrangement_type = $request->arrangement_type;
     $ArrangementType->minimum_amount   = $request->minimum_amount;
     $ArrangementType->maximum_amount   = $request->maximum_amount;
     $ArrangementType->description      = $request->description;
     $ArrangementType->price            = $request->price;
     $ArrangementType->save();
   }
   return redirect('/accountadmin/arrangement-type');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_arrangement_type')->where('pk_account' , $pk_account)->where('pk_arrangement_type',$id)->delete();
   return redirect()->route('accountadmin.arrangement-type.index')
                  ->with('message','style deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/arrangement-type');
 }
}
