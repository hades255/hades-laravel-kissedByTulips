<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use Auth;
use DB;

class CountryController extends Controller
{
  public function index(){
   $countries = Country::all();
   return view('superadmin.country.index',['countries'=>$countries]);
  }


 public function create(){
   return view('superadmin.country.add');
 }


 public function edit($id){
   $country = DB::table('kbt_country')->where('pk_country',$id)->first();
   return view('superadmin.country.add',['country' => $country]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'country_code' => 'required|max:6',
      'country_name' => 'required|max:10'
   ]);
   if(!empty($request->pk_country)){
     $country  = Country::find($request->pk_country);
     $country->country_code     = $request->country_code;
     $country->country_name     = $request->country_name;
     $country->active           = $request->active;
     $country->save();
   }
   else{
     $country  = new Country;
     $country->country_code     = $request->country_code;
     $country->country_name     = $request->country_name;
     $country->save();
   }
   return redirect('/superadmin/country');
 }

 public function delete($id){
   DB::table('kbt_country')->where('pk_country',$id)->delete();
   return redirect()->route('country.index')
                  ->with('message','states deleted successfully');
 }

 public function back(){
   return redirect('superadmin/country');
 }

}
