<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RequestQuoteController extends Controller
{
    public function index(){
      $events = DB::table('kbt_event_type')->get();
      return view('request',['events'=>$events]);
    }
}
