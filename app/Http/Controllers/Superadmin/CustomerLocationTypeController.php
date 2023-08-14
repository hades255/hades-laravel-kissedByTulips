<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerLocationType;
use Auth;
use DB;

class CustomerLocationTypeController extends Controller {

  public function index() {
    $data = DB::table('kbt_customer_location_types')
    ->select('kbt_customer_location_types.*','kbt_location_types.location_types')
    ->leftjoin('kbt_location_types','kbt_customer_location_types.pk_location_types','kbt_location_types.pk_location_types')
    ->orderBy('pk_customer_location_types','DESC')->get();
    return view('superadmin.customer-location-types.index',compact('data'));
  }

  public function create(){
    $location_types = DB::table('kbt_location_types')->orderBy('location_types','ASC')->pluck('location_types', 'pk_location_types')->toArray();
    return view('superadmin.customer-location-types.add',compact('location_types'));
  }

  public function edit($id){
    $data = DB::table('kbt_customer_location_types')->where('pk_customer_location_types',$id)->first();
    $location_types = DB::table('kbt_location_types')->orderBy('location_types','ASC')->pluck('location_types', 'pk_location_types')->toArray();
  //  echo "<pre>"; print_r($location_types); die;
    $location_times = DB::table('kbt_location_times')->where('active',1)->where('pk_location_types',$data->pk_location_types)->orderBy('pk_location_times','ASC')->get()->toArray();
  //  echo "<pre>"; print_r($location_times); die;
    return view('superadmin.customer-location-types.add',compact('data','location_types','location_times'));
  }

  public function store(Request $request) {

    $validated = $request->validate([
        'customer_location_types' => 'required|max:50',
        'pk_location_types' => 'required'
    ]);

    $formData  = $request->except('_token');
    $formData['pk_account'] = 0;
    //echo '<pre>'; print_r($formData); die;
    if(!empty($request->pk_customer_location_types)){
      $data  = CustomerLocationType::find($request->pk_customer_location_types);
      $data->update($formData);
    } else {
      CustomerLocationType::create($formData);
    }

    return redirect()->route('customer.customer-location-types.index')->with('message','Customer location created successfully');
  }

  public function delete($id){
    DB::table('kbt_customer_location_types')->where('pk_customer_location_types',$id)->delete();
    return redirect()->route('customer.customer-location-types.index')->with('message','Customer location delete successfully');
  }


  public function times(Request $request) {

    $get_id = $request->id;
    $location_times = DB::table('kbt_location_times')->where('active',1)->where('pk_location_types',$get_id)->orderBy('pk_location_times','ASC')->get()->toArray();
    if(!empty($location_times)) {
      $html = '<option value="">Select Location Time</option>';
      foreach ($location_times as $val) {
        $html .= '<option value="'.$val->pk_location_times.'">'.$val->day.'- '.date('h:i A',strtotime($val->open_time)).' to '.date('h:i A',strtotime($val->close_time)).'</option>';
      }
    } else {
      $html = '<option value="">Select Location Time</option>';
    }

    return response()->json(['html' => $html]);

  }

}
