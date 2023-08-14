<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use Auth;
use DB;


class EventController extends Controller
{
  public function index(){
   $account    = Auth::user()->pk_account;
   $events     = Event::where('pk_account',$account)->get();
   return view('accountadmin.event.index',['events'=>$events]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.event.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $event      = DB::table('kbt_event')->where('pk_account',$pk_account)->where('pk_event',$id)->first();
   //echo "<pre>";print_r($style); die;
   return view('accountadmin.event.add',['pk_account' => $pk_account,'event'=>$event]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'event' => 'required|max:30'
   ]);
   if(!empty($request->pk_event)){
     $event  = Event::find($request->pk_event);
     $event->pk_account   = $request->pk_account;
     $event->event        = $request->event;
     $event->description  = $request->description;
     $event->active       = $request->active;
     $event->save();
   }
   else{
     $event  = new Event;
     $event->pk_account   = $request->pk_account;
     $event->event        = $request->event;
     $event->description  = $request->description;
     $event->save();
   }
   return redirect('/accountadmin/event');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_event')->where('pk_account' , $pk_account)->where('pk_event',$id)->delete();
   return redirect('/accountadmin/event');
 }

 public function back(){
   return redirect('/accountadmin/event');
 }

}
