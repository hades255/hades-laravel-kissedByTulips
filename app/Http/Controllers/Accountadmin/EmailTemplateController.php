<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\EmailTemplate;
use App\EmailAccount;

class EmailTemplateController extends Controller
{
  public function index(){
    $emailTemplates = DB::table('kbt_email_template')
                      ->join('kbt_email_account','kbt_email_template.pk_email_account','kbt_email_account.pk_email_account')
                      ->get();
    return view('accountadmin.communication.email-template.index',['emailTemplates'=>$emailTemplates]);
  }

  public function create(){
    $emailAccounts = EmailAccount::all();
    return view('accountadmin.communication.email-template.add',['emailAccounts' => $emailAccounts]);
  }

  public function edit($id){
    $pk_account = Auth::user()->pk_account;
    $emailTemplate = DB::table('kbt_email_template')->where('pk_account',$pk_account)->where('pk_email_template',$id)->first();
    return view('accountadmin.communication.email-template.add',['pk_account' => $pk_account,'emailTemplate'=>$emailTemplate]);
  }

  public function store(Request $request){
    //echo "<pre>"; print_r($request->all()); die;
    $pk_account = Auth::user()->pk_account;
    $validated = $request->validate([
       'template_name' => 'required'
    ]);
    if(!empty($request->pk_email_template)){
      $EmailTemplate  = EmailTemplate::find($request->pk_email_template);
      $EmailTemplate->pk_account       = $pk_account;
      $EmailTemplate->template_name    = $request->template_name;
      $EmailTemplate->pk_email_account = $request->email_account;
      $EmailTemplate->subject          = $request->subject;
      $EmailTemplate->content          = $request->content;
      $EmailTemplate->active           = $request->active;
      $EmailTemplate->save();
    }
    else{
      $EmailTemplate  = new EmailTemplate;
      $EmailTemplate->pk_account       = $pk_account;
      $EmailTemplate->template_name    = $request->template_name;
      $EmailTemplate->pk_email_account = $request->email_account ;
      $EmailTemplate->subject          = $request->subject;
      $EmailTemplate->content          = $request->content;
      $EmailTemplate->save();
    }
    return redirect('/accountadmin/email-template');
  }

  public function delete($id){
    $pk_account = Auth::user()->pk_account;
    DB::table('kbt_email_template')->where('pk_account' , $pk_account)->where('pk_email_template',$id)->delete();
    return redirect()->route('accountadmin.email-template.index')
                   ->with('message','products-categories deleted successfully');
  }

  public function back(){
    return redirect('/accountadmin/email-template');
  }

}
