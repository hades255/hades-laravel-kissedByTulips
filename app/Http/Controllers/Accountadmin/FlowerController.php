<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Flower;
use Auth;
use DB;


class FlowerController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $flowers = Flower::where('pk_account',$account)->get();
   return view('accountadmin.flowers.index',['flowers'=>$flowers]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.flowers.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $flower = DB::table('kbt_flowers')->where('pk_account',$pk_account)->where('pk_flowers',$id)->first();
   //echo "<pre>";print_r($style); die;
   return view('accountadmin.flowers.add',['pk_account' => $pk_account,'flower'=>$flower]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'flowers' => 'required|max:30'
   ]);
   if(!empty($request->pk_flowers)){
     $flower  = Flower::find($request->pk_flowers);
     $flower->pk_account   = $request->pk_account;
     $flower->flowers      = $request->flowers;
     $flower->description  = $request->description;
     $flower->active       = $request->active;
     $flower->save();
   }
   else{
     $flower  = new Flower;
     $flower->pk_account   = $request->pk_account;
     $flower->flowers      = $request->flowers;
     $flower->description  = $request->description;
     $flower->save();
   }
   return redirect('/accountadmin/flowers');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_flowers')->where('pk_account' , $pk_account)->where('pk_flowers',$id)->delete();
   return redirect()->route('accountadmin.flowers.index')
                  ->with('message','style deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/flowers');
 }

}
