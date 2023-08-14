<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Frequency;
use App\Uom;

class UomController extends Controller
{
  public function index(){
   $uoms = DB::table('kbt_uom')
            ->join('kbt_frequency','kbt_uom.pk_frequency','kbt_frequency.pk_frequency')
            ->get();
   return view('superadmin.uom.index',['uoms'=>$uoms]);
  }


 public function create(){
   $frequencies = Frequency::all();
   return view('superadmin.uom.add',['frequencies' => $frequencies]);
 }


 public function edit($id){
   $uom = DB::table('kbt_uom')
                ->join('kbt_frequency','kbt_uom.pk_frequency','kbt_frequency.pk_frequency')
                ->where('kbt_uom.pk_uom',$id)->first();
   $frequencies = Frequency::all();
   return view('superadmin.uom.add',['uom' => $uom,'frequencies'=>$frequencies]);
 }

 public function store(Request $request){
   $account = Auth::user()->pk_account;
   $validated = $request->validate([
      'frequency' => 'required',
      'uom' => 'required|integer'
   ]);
   if(!empty($request->pk_uom)){
     $uom  = Uom::find($request->pk_uom);
     $uom->uom           = $request->uom;
     $uom->pk_frequency  = $request->frequency;
     $uom->active        = $request->active;
     $uom->save();
   }
   else{
     $uom  = new Uom;
     $uom->uom           = $request->uom;
     $uom->pk_frequency  = $request->frequency;
     $uom->active        = $request->active;
     $uom->save();
   }
   return redirect('/superadmin/uom');
 }

 public function delete($id){
   DB::table('kbt_uom')->where('pk_uom',$id)->delete();
   return redirect()->route('uom.index')
                  ->with('message','uom deleted successfully');
 }

 public function back(){
   return redirect('superadmin/uom');
 }
}
