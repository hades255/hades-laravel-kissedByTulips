<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;
use Auth;
use DB;

class StateController extends Controller
{
  public function index(){
   $states = State::all();
   return view('superadmin.states.index',['states'=>$states]);
  }


 public function create(){
   return view('superadmin.states.add');
 }


 public function edit($id){
   $state = DB::table('kbt_states')->where('pk_states',$id)->first();
   return view('superadmin.states.add',['state' => $state]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'pk_country' => 'required',
      'state_code' => 'required|max:6',
      'state_name' => 'required|max:40'
   ]);
   if(!empty($request->pk_states)){
     $state  = State::find($request->pk_states);
     $state->state_code     = $request->state_code;
     $state->state_name     = $request->state_name;
     $state->active           = $request->active;
     $state->save();
   }
   else{
     $state  = new State;
     $state->pk_country     = $request->pk_country;
     $state->state_code     = $request->state_code;
     $state->state_name     = $request->state_name;
     $state->save();
   }
   return redirect('/superadmin/states');
 }

 public function delete($id){
   DB::table('kbt_states')->where('pk_states',$id)->delete();
   return redirect()->route('states.index')
                  ->with('message','states deleted successfully');
 }

 public function back(){
   return redirect('/superadmin/states');
 }

}
