<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LocationType;
use App\LocationTime;
use Auth;
use DB;


class LocationTypeController extends Controller {

  public function index(){ 
    $locationtypes = LocationType::orderBy('pk_location_types','DESC')->get();
    return view('superadmin.location-types.index',['locationtypes'=>$locationtypes]);
  }


  public function create(){ 
    return view('superadmin.location-types.add');
  }
 

  public function edit($id){ 
    $locationtype = DB::table('kbt_location_types')->where('pk_location_types',$id)->first(); 
    return view('superadmin.location-types.add',['locationtype'=>$locationtype]);
  }

  public function store(Request $request){

    $validated = $request->validate([
        'location_types' => 'required|max:30'
    ]); 
    if(!empty($request->pk_location_types)) {
      $style  = LocationType::find($request->pk_location_types);
      $style->pk_account     = 0;
      $style->location_types = $request->location_types;
      $style->description    = $request->description;
      $style->active         = $request->active;
      $style->save();
    } else {
      $style  = new LocationType;
      $style->pk_account     = 0;
      $style->location_types = $request->location_types;
      $style->description    = $request->description;
      $style->save();
    }   
    return redirect('/superadmin/location-types');
  }

  public function delete($id){ 
    DB::table('kbt_location_types')->where('pk_location_types',$id)->delete(); 
    return redirect()->route('superadmin.location-types.index')
                  ->with('message','style deleted successfully');
  }

  public function back(){
    return redirect('/superadmin/location-types');
  }
 

}