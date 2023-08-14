<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\EmailAccount;
use App\EmailTemplate;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;

class EmailAccountController extends Controller
{

    public function index(){
      $emailAccounts = EmailAccount::all();
      return view('accountadmin.communication.email-account.index',['emailAccounts'=>$emailAccounts]);
    }

    public function create(){
      return view('accountadmin.communication.email-account.add');
    }

    public function edit($id){
      $pk_account = Auth::user()->pk_account;
      $emailAccount = DB::table('kbt_email_account')->where('pk_account',$pk_account)->where('pk_email_account',$id)->first();
      return view('accountadmin.communication.email-account.add',['pk_account' => $pk_account,'emailAccount'=>$emailAccount]);
    }

    public function store(Request $request){
      //echo "<pre>"; print_r($request->all()); die;
      $mail = new PHPMailer(true);
      if(empty($request->pk_email_account)){
        $email_account = new EmailAccount;
        $email_account->pk_account      = Auth::user()->pk_account;
        $email_account->host            = $request->host;
        $email_account->port            = $request->port;
        $email_account->user_name       = $request->username;
        $email_account->password        = Hash::make($request->password);
        $email_account->encryption_type = $request->encryption_type;
        $email_account->save();
      }
      else{
        $email_account = EmailAccount::where('pk_email_account',$request->pk_email_account)->first();
        $email_account->pk_account      = Auth::user()->pk_account;
        $email_account->host            = $request->host;
        $email_account->port            = $request->port;
        $email_account->user_name       = $request->username;
        $email_account->password        = Hash::make($request->password);
        $email_account->encryption_type = $request->encryption_type;
        $email_account->save();
      }
      $pk_email_account = $email_account->pk_email_account;
      $email = 'noreply@gmail.com';
      $res_broad = EmailAccount::where('pk_account',Auth::user()->pk_account)->where('pk_email_account',$pk_email_account)->first();
      //echo "<pre>"; print_r($pk_email_account); die;
      try {
    		//Server settings
    		$mail->SMTPDebug = 4;                      //Enable verbose debug output
    		$mail->isSMTP();                                            //Send using SMTP
    		$mail->Host       = $res_broad->host;                     //Set the SMTP server to send through
    		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    		$mail->Username   = $res_broad->user_name;
    		$mail->Password   = $res_broad->password;
    		$mail->SMTPSecure = $res_broad->encryption_type;
    		$mail->Port       = $res_broad->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    		$mail->setFrom($res_broad->user_name, '');
    		$mail->addReplyTo($res_broad->user_name, '');
    		$mail->AddAddress($email,'');

    	//	$result  = $db->Execute("SELECT * FROM Z_EMAIL_TEMPLATE where ID = '2' ");
        $result  = EmailTemplate::where('pk_email_template',2)->first();
    		$subject = $result->subject;
    		$msg 	   = $result->content;

    		$subject = str_replace("{Login ID}",$res_broad->user_name,$subject);
    		$msg 	 = str_replace("{Login ID}",$res_broad->user_name,$msg);

    		$mail->isHTML(true);
    		$mail->Subject = $subject;
    		$mail->Body    = $msg;

    		$mail->SMTPOptions = array(
                      'ssl' => array(
                          'verify_peer' => false,
                          'verify_peer_name' => false,
                          'allow_self_signed' => true
                      )
    	       );

    		//echo $subject.'<br />'.$msg;exit;
    		if(!$mail->Send()) {
    		 return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
    		} else {
    			$msg = 'SMTP Configured Successfully!!!';
    		 return back()->with("success", "Email has been sent.");
    		}

    	} catch (Exception $e) {
    		return back()->with('error','Message could not be sent.');
    	}
    }

    public function delete($id){
      $pk_account = Auth::user()->pk_account;
      DB::table('kbt_email_account')->where('pk_account' , $pk_account)->where('pk_email_account',$id)->delete();
      return redirect()->back() ->with('message','products-categories deleted successfully');
    }

    public function back(){
      return redirect('/accountadmin/email-account');
    }


}
