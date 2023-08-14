<?php
namespace App\Http\Controllers\Accountadmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AccountAdminPaymentGateway;
use Auth;
use DB;

class AccountAdminPaymentGatewayController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $payments = AccountAdminPaymentGateway::where('pk_account',$account)->where('pk_users', Auth::user()->pk_users)->get();
   return view('accountadmin.account-admin-payment-gateway.index',['payments'=>$payments]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.account-admin-payment-gateway.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $payment = DB::table('kbt_account_admin_payment_gateways')->where('pk_account',$pk_account)->where('pk_account_admin_payment_gateways',$id)->first();
   //echo "<pre>";print_r($style); die;
   return view('accountadmin.account-admin-payment-gateway.add',['pk_account' => $pk_account,'payment'=>$payment]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'merchant_login_id' => 'required',
      'merchant_transaction_key' => 'required'
   ]);
   if(!empty($request->pk_account_admin_payment_gateways)){
     $payment  = AccountAdminPaymentGateway::find($request->pk_account_admin_payment_gateways);
     $payment->pk_account               = $request->pk_account;
     $payment->pk_users                 = Auth::user()->pk_users;

     $payment->merchant_login_id        = $request->merchant_login_id;
     $payment->merchant_transaction_key = $request->merchant_transaction_key;
     $payment->other_key                = $request->other_key;
     $payment->created_by               = Auth::user()->pk_users;
     $payment->active                   = $request->active;
     $payment->save();
   }
   else{
     $payment  = new AccountAdminPaymentGateway;
     $payment->pk_account               = $request->pk_account;
     $payment->pk_users                 = Auth::user()->pk_users;

     $payment->merchant_login_id        = $request->merchant_login_id;
     $payment->merchant_transaction_key = $request->merchant_transaction_key;
     $payment->other_key                = $request->other_key;
     $payment->created_by               = Auth::user()->pk_users;
     $payment->active                   = $request->active;
     $payment->save();
   }
   return redirect('/accountadmin/payment-gateway');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_account_admin_payment_gateways')->where('pk_account' , $pk_account)->where('pk_account_admin_payment_gateways',$id)->delete();
   return redirect()->route('accountadmin.payment.index')
                  ->with('message','Payment gateway deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/payment-gateway');
 }

}
