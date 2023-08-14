<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SizeArrangement;
use Auth;
use DB;

class SizeArrangementController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $SizeArrangements = SizeArrangement::where('pk_account',$account)->get();
   return view('accountadmin.size-arrangement.index',['SizeArrangements'=>$SizeArrangements]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.size-arrangement.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $SizeArrangement = DB::table('kbt_size_arrangement')->where('pk_account',$pk_account)->where('pk_size_arrangement',$id)->first();
   return view('accountadmin.size-arrangement.add',['pk_account' => $pk_account,'SizeArrangement'=>$SizeArrangement]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'size_arrangement' => 'required|max:30'
   ]);
   if(!empty($request->pk_size_arrangement)){
     $sizeArrangement  = SizeArrangement::find($request->pk_size_arrangement);
     $sizeArrangement->pk_account       = $request->pk_account;
     $sizeArrangement->size_arrangement = $request->size_arrangement;
     $sizeArrangement->description      = $request->description;
     $sizeArrangement->active           = $request->active;
     $sizeArrangement->save();
   }
   else{
     $sizeArrangement  = new SizeArrangement;
     $sizeArrangement->pk_account       = $request->pk_account;
     $sizeArrangement->size_arrangement = $request->size_arrangement;
     $sizeArrangement->description      = $request->description;
     $sizeArrangement->save();
   }
   return redirect('/accountadmin/size-arrangement');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_size_arrangement')->where('pk_account' , $pk_account)->where('pk_size_arrangement',$id)->delete();
   return redirect()->route('accountadmin.size-arrangement.index')
                  ->with('message','products-categories deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/size-arrangement');
 }

}
