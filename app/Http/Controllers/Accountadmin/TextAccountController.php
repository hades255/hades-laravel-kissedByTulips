<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TextSetting;
use Auth;
use DB;

class TextAccountController extends Controller
{
  public function index(){
    $textAccounts = TextSetting::all();
    return view('accountadmin.communication.text-account.index',['textAccounts'=>$textAccounts]);
  }

  public function create(){
    return view('accountadmin.communication.text-account.add');
  }

  public function edit($id){
    $pk_account = Auth::user()->pk_account;
    $textTemplate = DB::table('kbt_text_settings')->where('pk_account',$pk_account)->where('pk_text_settings',$id)->first();
    return view('accountadmin.communication.text-account.add',['pk_account' => $pk_account,'textTemplate'=>$textTemplate]);
  }

  public function store(Request $request){
    $pk_account = Auth::user()->pk_account;
    //echo "<pre>"; print_r($request->all()); die;
    $validated = $request->validate([
       'sid' => 'required|max:30'
    ]);
    if(!empty($request->pk_text_settings)){
      $TextTemplate  = TextSetting::find($request->pk_text_settings);
      $TextTemplate->pk_account   = $pk_account;
      $TextTemplate->sid          = $request->sid;
      $TextTemplate->token        = $request->token;
      $TextTemplate->from_no      = $request->from_no;
      $TextTemplate->active       = $request->active;
      $TextTemplate->save();
    }
    else{
      $TextTemplate  = new TextSetting;
      $TextTemplate->pk_account   = $pk_account;
      $TextTemplate->sid          = $request->sid;
      $TextTemplate->token        = $request->token;
      $TextTemplate->from_no      = $request->from_no;
      $TextTemplate->save();
    }
    return redirect('/accountadmin/text-account');
  }

  public function delete($id){
    $pk_account = Auth::user()->pk_account;
    DB::table('kbt_text_settings')->where('pk_account' , $pk_account)->where('pk_text_settings',$id)->delete();
    return redirect()->route('accountadmin.text-account.index')
                   ->with('message','products-categories deleted successfully');
  }

  public function back(){
    return redirect('/accountadmin/text-account');
  }
}
