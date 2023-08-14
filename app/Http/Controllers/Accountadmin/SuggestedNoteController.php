<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\SuggestedNote;
use Auth;
use DB;

class SuggestedNoteController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $SuggestedNotes = DB::table('kbt_suggested_note')
                     ->join('kbt_event','kbt_suggested_note.pk_event','kbt_event.pk_event')
                     ->get();
   return view('accountadmin.suggested-note.index',['SuggestedNotes'=>$SuggestedNotes]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   $events     = Event::all();
   return view('accountadmin.suggested-note.add',['pk_account' => $pk_account,'events'=>$events]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $events     = Event::all();
   $SuggestedNote  = DB::table('kbt_suggested_note')
                     ->join('kbt_event','kbt_suggested_note.pk_event','kbt_event.pk_event')
                     ->where('kbt_suggested_note.pk_suggested_note',$id)
                     ->where('kbt_suggested_note.pk_account',$pk_account)
                     ->first();
   return view('accountadmin.suggested-note.add',['pk_account' => $pk_account,'SuggestedNote'=>$SuggestedNote,'events'=>$events]);
 }

 public function store(Request $request){
   $validated = $request->validate([
       'event' => 'required',
      'suggested_note' => 'required|max:30'
   ]);
   if(!empty($request->pk_suggested_note)){
     $suggestedNote  = SuggestedNote::find($request->pk_suggested_note);
     $suggestedNote->pk_account       = $request->pk_account;
     $suggestedNote->pk_event         = $request->event;
     $suggestedNote->suggested_note   = $request->suggested_note;
     $suggestedNote->description      = $request->description;
     $suggestedNote->active           = $request->active;
     $suggestedNote->save();
   }
   else{
     $suggestedNote  = new SuggestedNote;
     $suggestedNote->pk_account       = $request->pk_account;
     $suggestedNote->pk_event         = $request->event;
     $suggestedNote->suggested_note   = $request->suggested_note;
     $suggestedNote->description      = $request->description;
     $suggestedNote->save();
   }
   return redirect('/accountadmin/suggested-note');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_suggested_note')->where('pk_account' , $pk_account)->where('pk_suggested_note',$id)->delete();
   return redirect()->route('accountadmin.suggested-note.index')
                  ->with('message','style deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/suggested-note');
 }
}
