<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerLocationType;
use Auth;
use DB;

class CustomerLocationTypeController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $customerlocationtypes = CustomerLocationType::where('pk_account',$account)->get();
   return view('accountadmin.customer-location-types.index',['customerlocationtypes'=>$customerlocationtypes]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.customer-location-types.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $customerlocationtype = DB::table('kbt_customer_location_types')->where('pk_account',$pk_account)->where('pk_customer_location_types',$id)->first();
   //echo "<pre>";print_r($style); die;
   return view('accountadmin.customer-location-types.add',['pk_account' => $pk_account,'customerlocationtype'=>$customerlocationtype]);
 }

 public function store(Request $request){
   //echo "<pre>"; print_r($request->all()); die;
   $validated = $request->validate([
      'customer_location_types' => 'required|max:30'
   ]);
   if(!empty($request->pk_customer_location_types)){
     $customer_location_types  = CustomerLocationType::find($request->pk_customer_location_types);
     $customer_location_types->pk_account     = $request->pk_account;
     $customer_location_types->customer_location_types = $request->customer_location_types;
     $customer_location_types->description    = $request->description;
     $customer_location_types->active         = $request->active;
     $customer_location_types->save();
   }
   else{
     $customer_location_types  = new CustomerLocationType;
     $customer_location_types->pk_account     = $request->pk_account;
     $customer_location_types->customer_location_types = $request->customer_location_types;
     $customer_location_types->description    = $request->description;
     $customer_location_types->save();
   }
   return redirect('/accountadmin/customer-location-types');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_customer_location_types')->where('pk_account' , $pk_account)->where('pk_customer_location_types',$id)->delete();
   return redirect()->route('accountadmin.customer-location-types.index')
                  ->with('message','style deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/customer-location-types');
 }
}
