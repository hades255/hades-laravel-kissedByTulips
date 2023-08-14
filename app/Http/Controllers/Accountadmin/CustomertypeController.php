<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customertype;
use Auth;
use DB;

class CustomertypeController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $customertypes = Customertype::where('pk_account',$account)->get();
   return view('accountadmin.customertype.index',['customertypes'=>$customertypes]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.customertype.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $customertype = DB::table('kbt_customer_type')->where('pk_account',$pk_account)->where('pk_customer_type',$id)->first();
   return view('accountadmin.customertype.add',['pk_account' => $pk_account,'customertype'=>$customertype]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'customer_type' =>  'required|max:30',
      'customer_type_code' => 'required|max:30'
   ]);
   if(!empty($request->pk_customer_type)){
     $customertype  = Customertype::find($request->pk_customer_type);
     $customertype->pk_account         = $request->pk_account;
     $customertype->customer_type      = $request->customer_type;
     $customertype->customer_type_code = $request->customer_type_code;
     $customertype->active             = $request->active;
     $customertype->save();
   }
   else{
     $customertype  = new Customertype;
     $customertype->pk_account         = $request->pk_account;
     $customertype->customer_type      = $request->customer_type;
     $customertype->customer_type_code = $request->customer_type_code;
     $customertype->save();
   }
   return redirect('/accountadmin/customer-type');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_customer_type')->where('pk_account' , $pk_account)->where('pk_customer_type',$id)->delete();
   return redirect()->route('accountadmin.customer-type.index')
                  ->with('message','customer-type deleted successfully');
 }
}
