<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vendortype;
use Auth;
use DB;

class VendortypeController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $vendortypes = Vendortype::where('pk_account',$account)->get();
   return view('accountadmin.vendortype.index',['vendortypes'=>$vendortypes]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.vendortype.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $vendortype = DB::table('kbt_vendor_type')->where('pk_account',$pk_account)->where('pk_vendor_type',$id)->first();
   return view('accountadmin.vendortype.add',['pk_account' => $pk_account,'vendortype'=>$vendortype]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'vendor_type' => 'required|max:30'
   ]);
   if(!empty($request->pk_vendor_type)){
     $vendortype  = Vendortype::find($request->pk_vendor_type);
     $vendortype->pk_account       = $request->pk_account;
     $vendortype->vendor_type      = $request->vendor_type;
     $vendortype->description      = $request->description;
     $vendortype->active           = $request->active;
     $vendortype->save();
   }
   else{
     $vendortype  = new Vendortype;
     $vendortype->pk_account       = $request->pk_account;
     $vendortype->vendor_type      = $request->vendor_type;
     $vendortype->description      = $request->description;
     $vendortype->save();
   }
   return redirect('/accountadmin/vendor-type');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_vendor_type')->where('pk_account' , $pk_account)->where('pk_vendor_type',$id)->delete();
   return redirect()->route('accountadmin.vendor-type.index')
                  ->with('message','products-categories deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/vendor-type');
 }

}
