<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventType;
use Auth;
use DB;

class EventTypeController extends Controller
{
  public function index(){
   $account    = Auth::user()->pk_account;
   $eventtypes = EventType::where('pk_account',$account)->get();
   return view('accountadmin.event-type.index',['eventtypes'=>$eventtypes]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.event-type.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $eventtype = DB::table('kbt_event_type')->where('pk_account',$pk_account)->where('pk_event_type',$id)->first();
   //echo "<pre>";print_r($style); die;
   return view('accountadmin.event-type.add',['pk_account' => $pk_account,'eventtype'=>$eventtype]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'event_type' => 'required|max:30'
   ]);
   if(!empty($request->pk_event_type)){
     $eventtype  = EventType::find($request->pk_event_type);
     $eventtype->pk_account   = $request->pk_account;
     $eventtype->event_type   = $request->event_type;
     $eventtype->description  = $request->description;
     $eventtype->active       = $request->active;
     $eventtype->save();
   }
   else{
     $eventtype  = new EventType;
     $eventtype->pk_account   = $request->pk_account;
     $eventtype->event_type   = $request->event_type;
     $eventtype->description  = $request->description;
     $eventtype->save();
   }
   return redirect('/accountadmin/event-type');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_event_type')->where('pk_account' , $pk_account)->where('pk_event_type',$id)->delete();
   return redirect()->route('accountadmin.event-type.index')
                  ->with('message','style deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/event-type');
 }
}
