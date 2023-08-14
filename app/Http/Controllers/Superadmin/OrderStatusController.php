<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderStatus;
use Auth;
use DB;

class OrderStatusController extends Controller
{
  public function index(){
   $orderstatus = OrderStatus::all();
   return view('superadmin.orderstatus.index',['orderstatus'=>$orderstatus]);
  }


 public function create(){
   return view('superadmin.orderstatus.add');
 }


 public function edit($id){
   $order_status = DB::table('kbt_order_status')->where('pk_order_status',$id)->first();
   return view('superadmin.orderstatus.add',['order_status' => $order_status]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'order_status' => 'required|max:50'
   ]);
   if(!empty($request->pk_order_status)){
     $orderstatus  = OrderStatus::find($request->pk_order_status);
     $orderstatus->order_status     = $request->order_status;
     $orderstatus->description     = $request->description;
     $orderstatus->active           = $request->active;
     $orderstatus->save();
   }
   else{
     $orderstatus  = new OrderStatus;
     $orderstatus->order_status     = $request->order_status;
     $orderstatus->description     = $request->description;
     $orderstatus->save();
   }
   return redirect('/superadmin/order-status');
 }

 public function delete($id){
   DB::table('kbt_order_status')->where('pk_order_status',$id)->delete();
   return redirect()->route('order-status.index')
                  ->with('message','states deleted successfully');
 }

 public function back(){
   return redirect('/superadmin/order-status');
 }

}
