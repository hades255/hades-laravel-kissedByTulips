<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ColorFlower;
use Auth;
use DB;

class ColorFlowerController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $ColorFlowers = ColorFlower::where('pk_account',$account)->get();
   return view('accountadmin.color-flowers.index',['ColorFlowers'=>$ColorFlowers]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.color-flowers.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $ColorFlower = DB::table('kbt_color_flower')->where('pk_account',$pk_account)->where('pk_color_flower',$id)->first();
   //echo "<pre>";print_r($style); die;
   return view('accountadmin.color-flowers.add',['pk_account' => $pk_account,'ColorFlower'=>$ColorFlower]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'color_flower' => 'required|max:30'
   ]);
   if(!empty($request->pk_color_flower)){
     $style  = ColorFlower::find($request->pk_color_flower);
     $style->pk_account   = $request->pk_account;
     $style->color_flower = $request->color_flower;
     $style->description  = $request->description;
     $style->active       = $request->active;
     $style->save();
   }
   else{
     $style  = new ColorFlower;
     $style->pk_account   = $request->pk_account;
     $style->color_flower = $request->color_flower;
     $style->description  = $request->description;
     $style->save();
   }
   return redirect('/accountadmin/color-flowers');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_color_flower')->where('pk_account' , $pk_account)->where('pk_color_flower',$id)->delete();
   return redirect()->route('accountadmin.color-flowers.index')
                  ->with('message','style deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/color-flowers');
 }

}
