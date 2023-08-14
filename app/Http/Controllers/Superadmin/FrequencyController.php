<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Frequency;

class FrequencyController extends Controller
{
  public function index(){
   $frequencies = Frequency::all();
   return view('superadmin.frequency.index',['frequencies'=>$frequencies]);
  }


 public function create(){
   return view('superadmin.frequency.add');
 }


 public function edit($id){
   $frequency = DB::table('kbt_frequency')->where('pk_frequency',$id)->first();
   return view('superadmin.frequency.add',['frequency' => $frequency]);
 }

 public function store(Request $request){
   $account = Auth::user()->pk_account;
   $validated = $request->validate([
      'frequency' => 'required',
   ]);
   if(!empty($request->pk_frequency)){
     $frequency  = Frequency::find($request->pk_frequency);
     $frequency->pk_account    = $account;
     $frequency->frequency     = $request->frequency;
     $frequency->description   = $request->description;
     $frequency->active        = $request->active;
     $frequency->save();
   }
   else{
     $frequency  = new Frequency;
     $frequency->pk_account    = $account;
     $frequency->frequency     = $request->frequency;
     $frequency->description   = $request->description;
     $frequency->save();
   }
   return redirect('/superadmin/frequency');
 }

 public function delete($id){
   DB::table('kbt_frequency')->where('pk_frequency',$id)->delete();
   return redirect()->route('frequency.index')
                  ->with('message','frequency deleted successfully');
 }

 public function back(){
   return redirect('superadmin/frequency');
 }

}
