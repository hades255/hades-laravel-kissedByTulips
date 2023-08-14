<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Product;
use App\Flower;
use App\ColorFlower;
use App\ProductImage;
use App\DeliveryCharge;
use Auth;
use DB;

class DeliveryController extends Controller {

  public function index(){
    $account  = Auth::user()->pk_account;
    $data = DB::table('kbt_delivery_charges')->where('pk_account',$account)->orderBy('pk_delivery_charges','DESC')->get();
    return view('accountadmin.delivery-charges.index',['data'=>$data]);
  }


  public function create() {
    return view('accountadmin.delivery-charges.add');
  }


  public function edit($id){
    $data = DB::table('kbt_delivery_charges')->where('pk_delivery_charges',$id)->first();
    return view('accountadmin.delivery-charges.add',['data' => $data]);
  }

  public function store(Request $request){
    if($request->isMethod('post')) {
      $validator = DeliveryCharge::validate($request->all());
      if($validator->fails()) {
          session()->flash('message','Delivery charge could not be saved, please correct errors.');
          session()->flash('level','danger');
          return redirect('/accountadmin/delivery-charges/add')->withErrors($validator)->withInput();
      } else {
          $get_data = $request->all();
          $pk_delivery_charge_id = $request->pk_delivery_charges;
          $delivery_charge = DeliveryCharge::find($pk_delivery_charge_id);
          if(empty($delivery_charge)) {
              $save_data = DeliveryCharge::create($get_data);
          } else {
            $save_data = $delivery_charge->update($get_data);
          }
          if($save_data) {
            session()->flash('message','Delivery charge has been saved successfully!');
            session()->flash('level','success');
            return redirect('/accountadmin/delivery-charges');
          } else {
            session()->flash('message','Delivery charge could not be saved, please correct errors.');
            session()->flash('level','danger');
            return redirect('/accountadmin/delivery-charges/add');
          }
      }
    }
  }

  public function delete($id){
    DB::table('kbt_delivery_charges')->where('pk_delivery_charges',$id)->delete();
    return redirect()->route('admin.deliverycharges.index')->with('message','Delivery charges deleted successfully');
 }


}
