<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TextTemplate;
use App\TextSetting;
use Auth;
use DB;

class TextTemplateController extends Controller
{
  public function index(){
    $textTemplates = DB::table('kbt_text_template')
                      ->join('kbt_text_settings','kbt_text_template.pk_text_settings','kbt_text_settings.pk_text_settings')
                      ->get();
    return view('accountadmin.communication.text-template.index',['textTemplates'=>$textTemplates]);
  }

  public function create(){
    $textSettings = TextSetting::all();
    return view('accountadmin.communication.text-template.add',['textSettings'=>$textSettings]);
  }

  public function edit($id){
    $pk_account = Auth::user()->pk_account;
    $textTemplate = DB::table('kbt_text_template')->where('pk_account',$pk_account)->where('pk_text_template',$id)->first();
    return view('accountadmin.communication.text-template.add',['pk_account' => $pk_account,'textTemplate'=>$textTemplate]);
  }

  public function store(Request $request){
    $pk_account = Auth::user()->pk_account;
    $validated = $request->validate([
       'template_name' => 'required|max:30'
    ]);
    if(!empty($request->pk_text_template)){
      $textTemplate  = TextTemplate::find($request->pk_text_template);
      $textTemplate->pk_account       = $pk_account;
      $textTemplate->template_name     = $request->template_name;
      $textTemplate->pk_text_settings = $request->text_settings;
      $textTemplate->content          = $request->content;
      $textTemplate->active           = $request->active;
      $textTemplate->save();
    }
    else{
      $textTemplate  = new TextTemplate;
      $textTemplate->pk_account       = $pk_account;
      $textTemplate->template_name    = $request->template_name;
      $textTemplate->pk_text_settings = 1;
      $textTemplate->content          = $request->content;
      $textTemplate->active           = $request->active;
      $textTemplate->save();
    }
    return redirect('/accountadmin/text-template');
  }

  public function delete($id){
    $pk_account = Auth::user()->pk_account;
    DB::table('kbt_text_template')->where('pk_account' , $pk_account)->where('pk_text_template',$id)->delete();
    return redirect()->route('accountadmin.text-template.index')
                   ->with('message','products-categories deleted successfully');
  }

  public function back(){
    return redirect('/accountadmin/text-template');
  }

}
