<?php

namespace App\Http\Controllers\Accountadmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VaseColor;
use App\VaseType;
use Auth;
use DB;

class VaseColorController extends Controller
{

  public function index(){
   $account    = Auth::user()->pk_account;
  // $VaseColors = VaseColor::where('pk_account',$account)->get();
   $VaseColors = DB::table('kbt_vase_colors')
                 ->join('kbt_vase_type','kbt_vase_colors.pk_vase_type','kbt_vase_type.pk_vase_type')
                 ->join('kbt_account' , 'kbt_vase_colors.pk_account','kbt_account.pk_account')
                 ->get();
   return view('accountadmin.vase-colors.index',['VaseColors'=>$VaseColors]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   $vaseTypes  = VaseType::all();
   return view('accountadmin.vase-colors.add',['pk_account' => $pk_account,'vaseTypes' => $vaseTypes]);
 }


 public function edit($id){
   $pk_account   = Auth::user()->pk_account;
   //$VaseColor   = DB::table('kbt_vase_colors')->where('pk_account',$pk_account)->where('pk_vase_colors',$id)->first();
   $VaseColor    = DB::table('kbt_vase_colors')
                   ->join('kbt_vase_type','kbt_vase_colors.pk_vase_type','kbt_vase_type.pk_vase_type')
                   ->join('kbt_account' , 'kbt_vase_colors.pk_account','kbt_account.pk_account')
                   ->where('kbt_vase_colors.pk_vase_colors',$id)
                   ->select('kbt_vase_colors.pk_vase_colors as pk_vase_colors','kbt_vase_colors.pk_vase_type as pk_vase_type','kbt_vase_colors.vase_colors as vase_colors','kbt_vase_colors.description as description','kbt_vase_colors.active as active','kbt_vase_type.pk_vase_type as pk_vase_type','kbt_vase_type.vase_type as vase_type')
                   ->first();
   $vaseTypes   = VaseType::all();
   return view('accountadmin.vase-colors.add',['pk_account' => $pk_account,'VaseColor'=>$VaseColor,'vaseTypes'=>$vaseTypes]);
 }

 public function store(Request $request){
   //echo "<pre>"; print_r($request->all()); die;
   $validated = $request->validate([
      'vase_type' => 'required',
      'vase_colors' => 'required|max:30'
   ]);
   if(!empty($request->pk_vase_colors)){
     $VaseColor  = VaseColor::find($request->pk_vase_colors);
     $VaseColor->pk_account       = $request->pk_account;
     $VaseColor->pk_vase_type     = $request->vase_type;
     $VaseColor->vase_colors      = $request->vase_colors;
     $VaseColor->description      = $request->description;
     $VaseColor->active           = $request->active;
     $VaseColor->save();
   }
   else{
     $VaseColor  = new VaseColor;
     $VaseColor->pk_account       = $request->pk_account;
     $VaseColor->pk_vase_type     = $request->vase_type;
     $VaseColor->vase_colors      = $request->vase_colors;
     $VaseColor->description      = $request->description;
     $VaseColor->save();
   }
   return redirect('/accountadmin/vase-colors');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_vase_colors')->where('pk_account' , $pk_account)->where('pk_vase_colors',$id)->delete();
   return redirect()->route('accountadmin.vase-colors.index')
                  ->with('message','products-categories deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/vase-colors');
 }

}
