<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Vendor;
use App\Vendortype;
use App\State;
use App\Country;
use App\User;
use App\Comment;
use App\PurchaseOrder;
use App\VendorContact;
use DB;
use Auth;



class VendorController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   //$vendors = Vendor::where('pk_account',$account)->get();
   $vendors = DB::table('kbt_vendors')
             ->join('kbt_vendor_type','kbt_vendors.pk_vendor_type','kbt_vendor_type.pk_vendor_type')
             ->get();
   return view('accountadmin.vendors.index',['vendors'=>$vendors]);
  }


 public function create(){
   $pk_account   = Auth::user()->pk_account;
   $vendor_types = Vendortype::where('pk_account', $pk_account)->get();
   $states       = State::where('pk_country',1)->get();
   $countries    = Country::all();
   return view('accountadmin.vendors.add',['pk_account' => $pk_account,'vendor_types'=>$vendor_types,'states'=>$states,'countries'=>$countries]);
 }


 public function edit($id){
   //echo "<pre>"; print_r($id); die;
   $pk_account   = Auth::user()->pk_account;
   $vendor       = DB::table('kbt_vendors')->where('pk_vendors',$id)->first();
   // echo "<pre>"; print_r($vendor); die;
   $vendor_types = Vendortype::where('pk_account', $pk_account)->get();
   $states       = State::where('pk_country',1)->get();
   $countries    = Country::all();
   $comments     = Comment::where('pk_account',$pk_account)->where('pk_vendors','!=','NULL')->get();
   $vendorUser   = DB::table('users')->where('pk_vendors',$id)->first();
   $vendorContacts = DB::table('kbt_vendor_contacts')
                     ->leftjoin('kbt_department','kbt_vendor_contacts.pk_department','kbt_department.pk_department')
                     ->where('kbt_vendor_contacts.pk_vendors',$id)->get();
    //echo "<pre>"; print_r($vendorContacts); die;
   return view('accountadmin.vendors.add',['vendorContacts'=>$vendorContacts,'pk_account' => $pk_account,'comments'=>$comments,'vendor'=>$vendor,'vendor_types'=>$vendor_types,'states'=>$states,'countries'=>$countries,'vendorUser'=>$vendorUser]);
 }

 public function store(Request $request){
   $validated = $request->validate([
    'vendor_name' => 'required|max:50',
    'vendor_type' => 'required',
   ]);
   $vendor  = new Vendor;
   $vendor->pk_account       = $request->pk_account;
   $vendor->vendor_name      = $request->vendor_name;
   $vendor->website          = $request->website;
   $vendor->pk_vendor_type   = $request->vendor_type;
   $vendor->address          = $request->address;
   $vendor->address_1        = $request->address_1;
   $vendor->city             = $request->city;
   $vendor->zip              = $request->zip;
   $vendor->pk_states        = $request->pk_states;
   $vendor->pk_country       = $request->pk_country;
   $vendor->email            = $request->email;
   $vendor->office_phone     = $request->office_phone;
   $vendor->login_enable     = isset($request->login_enable) && ($request->login_enable === 'on')? 1 : 0;
   $vendor->fax              = $request->fax;
   $vendor->lat              = $request->lat;
   $vendor->lng              = $request->lng;
   $vendor->state_name       = $request->state_name;
   $vendor->country_name     = $request->country_name;
   $vendor->save();

   /*if($request->login_enable){
     $validated = $request->validate([
     'username' => 'required|max:50|unique:users',
     'password' => 'required|max:10|confirmed'
     ]);
     $vendor_user  = new User;
     $vendor_user->username = $request->username;
     $vendor_user->password = Hash::make($request->password);
     $vendor_user->pk_roles = 5;
     $vendor_user->pk_account = $request->pk_account;
     $vendor_user->pk_vendors = $vendor->pk_vendors;
     $vendor_user->save();
   }*/
   if($request->submit == "Save And Next" || $request->submit == "Update And Next")
    {
        return redirect('/accountadmin/vendors/edit/'.$vendor->pk_vendors.'/?tab=contact');
    }
   return redirect('/accountadmin/vendors');
 }


 public function update(Request $request){

     /*if(isset($request->login_enable) && ($request->login_enable=='on') && empty($request->username) && empty($request->password)){
       $validated = $request->validate([
       'username' => 'required|max:50|unique:users',
       'password' => 'required|max:10|confirmed'
       ]);
       $vendor_user  = new User;
       $vendor_user->username = $request->username;
       $vendor_user->password = $request->password;
       $vendor_user->pk_roles = 5;
       $vendor_user->pk_account = $request->pk_account;
       $vendor_user->pk_vendors = $request->pk_vendors;
       $vendor_user->save();
     }

    if(isset($request->login_enable) && ($request->login_enable=='on') && !empty($request->username) && !empty($request->pk_users)) {
      $vendor  = Vendor::find($request->pk_vendors);
       $vendor->pk_account       = $request->pk_account;
       $vendor->vendor_name      = $request->vendor_name;
       $vendor->website          = $request->website;
       $vendor->pk_vendor_type   = $request->vendor_type;
       $vendor->address          = $request->address;
       $vendor->address_1        = $request->address_1;
       $vendor->city             = $request->city;
       $vendor->zip              = $request->zip;
       $vendor->pk_states        = $request->pk_states;
       $vendor->pk_country       = $request->pk_country;
       $vendor->email            = $request->email;
       $vendor->office_phone     = $request->office_phone;
       $vendor->login_enable     = isset($request->login_enable) && ($request->login_enable == 'on')? 1 : 0;
       $vendor->fax              = $request->fax;
       $vendor->lat              = $request->lat;
       $vendor->lng              = $request->lng;
       $vendor->active           = $request->active;
       $vendor->save();
        $vendor_user  = User::find($request->pk_users);
        $vendor_user->username = $request->username;
        $vendor_user->password = $request->password;
        $vendor_user->pk_roles = 4;
        $vendor_user->pk_account = $request->pk_account;
        $vendor_user->pk_vendors = $request->pk_vendors;
        $vendor_user->save();
      }
    if(isset($request->login_enable) && !empty($request->username) && empty($request->pk_users)) {
      $validated = $request->validate([
       'username' => 'required|max:50',
       'vendor_name' => 'required|max:50',
       'vendor_type' => 'required',
      ]);
       $vendor  = Vendor::find($request->pk_vendors);
       $vendor->pk_account       = $request->pk_account;
       $vendor->vendor_name    = $request->vendor_name;
       $vendor->website          = $request->website;
       $vendor->pk_vendor_type = $request->vendor_type;
       $vendor->address          = $request->address;
       $vendor->address_1        = $request->address_1;
       $vendor->city             = $request->city;
       $vendor->zip              = $request->zip;
       $vendor->pk_states        = $request->pk_states;
       $vendor->pk_country       = $request->pk_country;
       $vendor->email            = $request->email;
       $vendor->office_phone     = $request->office_phone;
       $vendor->login_enable     = isset($request->login_enable) && ($request->login_enable == 'on')? 1 : 0;
       $vendor->fax              = $request->fax;
       $vendor->lat              = $request->lat;
       $vendor->lng              = $request->lng;
       $vendor->active           = $request->active;
       $vendor->save();
        $vendor_user  = new User;
        $vendor_user->username = $request->username;
        $vendor_user->password = $request->password;
        $vendor_user->pk_roles = 5;
        $vendor_user->pk_account = $request->pk_account;
        $vendor_user->pk_vendors = $request->pk_vendors;
        $vendor_user->save();
    }
    if(!isset($request->login_enable) && !empty($request->username)){
      $validated = $request->validate([
          'vendor_name' => 'required|max:50',
          'vendor_type' => 'required',
       ]);
        DB::table('users')->where('pk_users',$request->pk_users)->delete();
        $vendor  = Vendor::find($request->pk_vendors);
        $vendor->pk_account       = $request->pk_account;
        $vendor->vendor_name    = $request->vendor_name;
        $vendor->website          = $request->website;
        $vendor->pk_vendor_type = $request->vendor_type;
        $vendor->address          = $request->address;
        $vendor->address_1        = $request->address_1;
        $vendor->city             = $request->city;
        $vendor->zip              = $request->zip;
        $vendor->pk_states        = $request->pk_states;
        $vendor->pk_country       = $request->pk_country;
        $vendor->email            = $request->email;
        $vendor->office_phone     = $request->office_phone;
        $vendor->login_enable     = 0;
        $vendor->fax              = $request->fax;
        $vendor->lat              = $request->lat;
        $vendor->lng              = $request->lng;
        $vendor->active           = $request->active;
        $vendor->save();
    }*/

    //if(!isset($request->login_enable) && empty($request->username)){
      $validated = $request->validate([
          'vendor_name' => 'required|max:50',
          'vendor_type' => 'required',
       ]);
        $vendor  = Vendor::find($request->pk_vendors);
        $vendor->pk_account       = $request->pk_account;
        $vendor->vendor_name      = $request->vendor_name;
        $vendor->website          = $request->website;
        $vendor->pk_vendor_type   = $request->vendor_type;
        $vendor->address          = $request->address;
        $vendor->address_1        = $request->address_1;
        $vendor->city             = $request->city;
        $vendor->zip              = $request->zip;
        $vendor->pk_states        = $request->pk_states;
        $vendor->pk_country       = $request->pk_country;
        $vendor->email            = $request->email;
        $vendor->office_phone     = $request->office_phone;
        $vendor->login_enable     = 0;
        $vendor->fax              = $request->fax;
        $vendor->lat              = $request->lat;
        $vendor->lng              = $request->lng;
        $vendor->state_name       = $request->state_name;
        $vendor->country_name     = $request->country_name;
        $vendor->active           = $request->active;
        $vendor->save();
    //}
   if($request->submit == "Save And Next" || $request->submit == "Update And Next")
    {
        return redirect('/accountadmin/vendors/edit/'.$vendor->pk_vendors.'/?tab=contact');
    }
   return redirect('/accountadmin/vendors');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_vendors')->where('pk_account' , $pk_account)->where('pk_vendors',$id)->delete();
   return redirect()->route('accountadmin.vendors.index')
                  ->with('message','products-categories deleted successfully');
 }



 public function commentStore(Request $request){
   $pk_account = Auth::user()->pk_account;
   $validated = $request->validate([
       'comment' => 'required|max:200'
    ]);
  //  echo "<pre>"; print_r($request->all()); die;
    if(!empty($request->pk_comment)){
         $comment  = Comment::find($request->pk_comment);
    }
    else{
      $comment  = new Comment;
    }
    $comment->comments      = $request->comment;
    $comment->contact_name  = $request->contact_name;
    $comment->pk_account    = $pk_account;
    $comment->pk_vendors    = $request->pk_vendors;
    $comment->save();
    $comments     = Comment::where('pk_account',$pk_account)->where('pk_vendors','!=','NULL')->get();
    $tab = "comment-edit";
    $vendor_types = Vendortype::where('pk_account', $pk_account)->get();
    return view('accountadmin.vendors.add',['tab'=>$tab,'comments'=>$comments,'pk_account' => $pk_account,'vendor_types'=>$vendor_types]);
 }

 public function commentEdit(Request $request,$id){
   $pk_account   = Auth::user()->pk_account;
   $vendor       = DB::table('kbt_vendors')->where('pk_account',$pk_account)->where('pk_vendors',$id)->first();
   $vendor_types = Vendortype::where('pk_account', $pk_account)->get();
   $states       = State::where('pk_country',1)->get();
   $countries    = Country::all();
   $comments     = Comment::where('pk_account',$pk_account)->where('pk_vendors',$id)->first();
   $editComment  = Comment::where('pk_account',$pk_account)->where('pk_comment',$id)->first();
   // echo "<pre>"; print_r($editComment); die;
   $vendorUser   = DB::table('users')->where('pk_vendors',$editComment->pk_vendors)->first();
   $vendor_types = Vendortype::where('pk_account', $pk_account)->get();
   return view('accountadmin.vendors.add',['comments'=>$comments,'pk_account' => $pk_account,'vendor_types'=>$vendor_types,'states'=>$states,'countries'=>$countries,'vendorUser'=>$vendorUser,'editComment'=>$editComment]);
 }


 public function commentDelete(Request $request,$id){
    $pk_account   = Auth::user()->pk_account;
    DB::table('kbt_comment')->where('pk_account',$pk_account)->where('pk_comment',$id)->delete();
    return redirect('/accountadmin/vendors');
 }

 public function back(){
   return redirect('/accountadmin/vendors');
 }

}
