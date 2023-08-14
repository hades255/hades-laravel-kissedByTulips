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
use App\Coupon;
use Auth;
use DB;

class CouponController extends Controller {

  public function index(){
    $account  = Auth::user()->pk_account;
    $data = DB::table('kbt_coupons')->where('pk_account',$account)->orderBy('pk_coupons','DESC')->get();
    return view('accountadmin.coupons.index',['data'=>$data]);
  }


  public function create() {
    return view('accountadmin.coupons.add');
  }


  public function edit($id){
    $data = DB::table('kbt_coupons')->where('pk_coupons',$id)->first();
    return view('accountadmin.coupons.add',['data' => $data]);
  }

  public function store(Request $request){

    if($request->isMethod('post')) {

      $validator = Coupon::validate($request->all(),$request->pk_coupons);
      if($validator->fails()) {
          session()->flash('message','Coupon could not be saved, please correct errors.');
          session()->flash('level','danger');
          if(!empty($request->pk_coupons)) {
            return redirect('/accountadmin/coupons/edit/'.$request->pk_coupons)->withErrors($validator)->withInput();
          } else {
            return redirect('/accountadmin/coupons/add')->withErrors($validator)->withInput();
          }
      } else {

          $get_data = $request->all();

          //echo '<pre>'; print_r($get_data); die;

          $pk_coupons = $request->pk_coupons;
          $data = Coupon::find($pk_coupons);
          if(empty($data)) {
            $save_data = Coupon::create($get_data);
          } else {
            $save_data = $data->update($get_data);
          }

          if($save_data) {
            session()->flash('message','Coupon has been saved successfully!');
            session()->flash('level','success');
            return redirect('/accountadmin/coupons');
          } else {
            session()->flash('message','Coupon could not be saved, please correct errors.');
            session()->flash('level','danger');
            if(!empty($request->pk_coupons)) {
              return redirect('/accountadmin/coupons/edit/'.$request->pk_coupons);
            } else {
              return redirect('/accountadmin/coupons/add');
            }
          }

      }
    }
  }

  public function delete($id){
    DB::table('kbt_coupons')->where('pk_coupons',$id)->delete();
    return redirect()->route('admin.coupons.index')->with('message','Coupon has been deleted successfully.');
  }


}
