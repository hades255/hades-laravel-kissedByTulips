<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Department;
use App\State;
use App\Country;
use App\VendorContact;
use App\Vendor;
use App\User;
use Auth;
use DB;

class VendorContactController extends Controller
{
    public function index($id){
      $pk_vendors   = $id;
      $pk_account   = Auth::user()->pk_account;
      $departments  = Department::where('pk_account',$pk_account)->get();
      $states       = State::where('pk_country',1)->get();
      $countries    = Country::all();
      return view('accountadmin.vendors.contacts.add',['pk_vendors'=>$pk_vendors,'departments'=>$departments,'states'=>$states,'countries'=>$countries,'pk_account'=>$pk_account]);
    }

    public function delete($id){
      $pk_account = Auth::user()->pk_account;
      DB::table('kbt_vendor_contacts')->where('pk_account' , $pk_account)->where('pk_vendor_contacts',$id)->delete();
      return redirect()->route('accountadmin.vendors.index')
                     ->with('message','products-categories deleted successfully');
    }

    public function store(Request $request){
        $validated = $request->validate([
         'contact_name' => 'required|max:50',
        ]);
        // echo "<pre>"; print_r($request->all()); die;
        $pk_account = Auth::user()->pk_account;
        $vendor  = new VendorContact;
        $vendor->pk_account       = $pk_account;
        $vendor->pk_vendors       = $request->pk_vendors;
        $vendor->contact_name     = $request->contact_name;
        $vendor->title            = $request->title;
        $vendor->pk_department    = $request->pk_department;
        $vendor->address          = $request->address;
        $vendor->address_1        = $request->address_1;
        $vendor->city             = $request->city;
        $vendor->zip              = $request->zip;
        $vendor->pk_states        = $request->pk_states;
        $vendor->pk_country       = $request->pk_country;
        $vendor->state_name       = $request->state_name;
   		  $vendor->country_name     = $request->country_name;
        $vendor->email            = $request->email;
        $vendor->office_phone     = $request->office_phone;
        $vendor->login_enable     = isset($request->login_enable) && ($request->login_enable === 'on')? 1 : 0;
        $vendor->save();
        
        if($request->login_enable){
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
            $vendor_user->pk_vendor_contacts = $vendor->pk_vendor_contacts;
            $vendor_user->save();
        }
       if($request->submit == "Save And Next" || $request->submit == "Update And Next")
        {
            return redirect('/accountadmin/vendors/edit/'.$vendor->pk_vendors.'/?tab=comment');
        }
        
      return redirect('/accountadmin/vendors');
    }

    public function edit($id){
      // echo $id; die;
      $pk_account     = Auth::user()->pk_account;
      $vendor_contact = DB::table('kbt_vendor_contacts')->where('pk_vendor_contacts',$id)->first();
      //echo "<pre>"; print_r($vendor_contact); die;
      $vendor         = DB::table('kbt_vendors')->where('pk_account',$pk_account)->where('pk_vendors',$vendor_contact->pk_vendors)->first();
      $states         = State::where('pk_country',1)->get();
      $countries      = Country::all();
      $vendorContactUser     = DB::table('users')->where('pk_vendor_contacts',$vendor_contact->pk_vendor_contacts)->first();
      $vendorUser     = DB::table('users')->where('pk_vendors',$vendor_contact->pk_vendors)->first();
      //echo "<pre>"; print_r($vendor_contact); die;
      $departments    = Department::where('pk_account',$pk_account)->get();
      // $customers      = Customer::where('pk_account',$pk_account)->get();
      $vendors        = DB::table('kbt_vendors')
                        ->join('kbt_department','kbt_vendors.pk_vendors','kbt_department.pk_department')
                        ->get();
                    // echo "<pre>"; print_r($customers); die;
      return view('accountadmin.vendors.contacts.add',['vendor_contact'=>$vendor_contact,'departments'=>$departments,'pk_account' => $pk_account,'vendor'=>$vendor,'states'=>$states,'countries'=>$countries,'vendorUser'=> $vendorUser,'vendorContactUser'=>$vendorContactUser]);
    }

    public function update(Request $request){
    	$existin_vendor_contact_user = User::where('pk_vendor_contacts', $request->pk_vendor_contacts)->first();

    	if(isset($request->login_enable) && ($request->login_enable=='on') && !empty($request->username) && $existin_vendor_contact_user){
	        $validated = $request->validate([
	          'username' => 'required|max:50|unique:users,username,'.$existin_vendor_contact_user->pk_users.',pk_users',
	          'contact_name' => 'required|max:50',
	        ]);

	        $customer_user  = User::find($existin_vendor_contact_user->pk_users);
	        $customer_user->username             = $request->username;
	        $customer_user->password             = Hash::make($request->password);
	        $customer_user->pk_roles             = 5;
	        $customer_user->pk_account           = $request->pk_account;
	        $customer_user->pk_vendor_contacts   = $request->pk_vendor_contacts;
	        $customer_user->save();
       }
       elseif(isset($request->login_enable) && ($request->login_enable=='on') && !empty($request->username) && !$existin_vendor_contact_user)
        {
	        $validated = $request->validate([
	        'username' => 'required|max:50|unique:users',
	        'password' => 'required|min:6|confirmed',
	        'contact_name' => 'required|max:50',
	        ]);

	        $customer_user  = new User;
	        $customer_user->username             = $request->username;
	        $customer_user->password             = Hash::make($request->password);
	        $customer_user->pk_roles             = 5;
	        $customer_user->pk_account           = $request->pk_account;
	        $customer_user->pk_vendor_contacts   = $request->pk_vendor_contacts;
	        $customer_user->save();
        }
      	elseif(!isset($request->login_enable) && $existin_vendor_contact_user)
      	{
	        $validated = $request->validate([
	          'contact_name' => 'required|max:50',
	        ]);
        	DB::table('users')->where('pk_users',$request->pk_users)->delete();
      	}

      	$vendor  = VendorContact::find($request->pk_vendor_contacts);
        $vendor->pk_account       = $request->pk_account;
        $vendor->contact_name     = $request->contact_name;
        $vendor->title            = $request->title;
        $vendor->pk_department    = $request->pk_department;
        $vendor->address          = $request->address;
        $vendor->address_1        = $request->address_1;
        $vendor->city             = $request->city;
        $vendor->zip              = $request->zip;
        $vendor->pk_states        = $request->pk_states;
        $vendor->pk_country       = $request->pk_country;
        $vendor->state_name       = $request->state_name;
   		  $vendor->country_name      = $request->country_name;
        $vendor->email            = $request->email;
        $vendor->office_phone     = $request->office_phone;
        $vendor->login_enable     = isset($request->login_enable) && ($request->login_enable == 'on')? 1 : 0;
        $vendor->active           = $request->active;
        $vendor->pk_vendors       = $request->pk_vendors;
        $vendor->save();

    	/*if(isset($request->login_enable) && ($request->login_enable=='on') && !empty($request->username)){
	        $validated = $request->validate([
	        'username' => 'required|max:50|unique:users',
	        'password' => 'required|min:6|confirmed'
	        ]);
	        //echo "<pre>"; print_r($request->all()); die;
	        $customer_user  = new User;
	        $customer_user->username             = $request->username;
	        $customer_user->password             = Hash::make($request->password);
	        $customer_user->pk_roles             = 4;
	        $customer_user->pk_account           = $request->pk_account;
	        $customer_user->pk_vendor_contacts   = $request->pk_vendor_contacts;
	        $customer_user->save();
        }*/
       /*if(isset($request->login_enable) && empty($request->username)) {
	        $validated = $request->validate([
	         	'username' => 'required|max:50|unique:users',
	         	'password' => 'required|min:6|confirmed'
	        ]);

	        $vendor  = VendorContact::find($request->pk_vendor_contacts);
	        $vendor->pk_account       = $request->pk_account;
	        $vendor->contact_name     = $request->contact_name;
	        $vendor->title            = $request->title;
	        $vendor->pk_department    = $request->pk_department;
	        $vendor->address          = $request->address;
	        $vendor->address_1        = $request->address_1;
	        $vendor->city             = $request->city;
	        $vendor->zip              = $request->zip;
	        $vendor->pk_states        = $request->pk_states;
	        $vendor->pk_country       = $request->pk_country;
	        $vendor->email            = $request->email;
	        $vendor->office_phone     = $request->office_phone;
	        $vendor->login_enable     = isset($request->login_enable) && ($request->login_enable == 'on')? 1 : 0;
	        $vendor->active           = $request->active;
	        $vendor->pk_vendors       = $request->pk_vendors;
	        $vendor->save();
	        	$vendor_user  = new User;
	            $vendor_user->username             = $request->username;
	            $vendor_user->password             = Hash::make($request->password);
	            $vendor_user->pk_roles             = 5;
	            $vendor_user->pk_account           = $request->pk_account;
	            $vendor_user->pk_vendor_contacts   = $request->pk_vendor_contacts;
	            $customer_user->save();

         
        }*/
        /*if(!isset($request->login_enable) && !empty($request->username)){
	        $validated = $request->validate([
	            'contact_name' => 'required|max:50',
	         ]);
	        DB::table('users')->where('pk_users',$request->pk_users)->delete();

	        $vendor  = VendorContact::find($request->pk_vendor_contacts);
	        $vendor->pk_account       = $request->pk_account;
	        $vendor->pk_vendors       = $request->pk_vendors;
	        $vendor->contact_name     = $request->contact_name;
	        $vendor->title            = $request->title;
	        $vendor->pk_department    = $request->pk_department;
	        $vendor->address          = $request->address;
	        $vendor->address_1        = $request->address_1;
	        $vendor->city             = $request->city;
	        $vendor->zip              = $request->zip;
	        $vendor->pk_states        = $request->pk_states;
	        $vendor->pk_country       = $request->pk_country;
	        $vendor->email            = $request->email;
	        $vendor->office_phone     = $request->office_phone;
	        $vendor->login_enable     = 0;
	        $vendor->active           = $request->active;
	        $vendor->save();
       }*/
       /*if(!isset($request->login_enable) && empty($request->username)){
	        $validated = $request->validate([
	            'contact_name' => 'required|max:50',
	         ]);

	        $vendor  = VendorContact::find($request->pk_vendor_contacts);
	        $vendor->pk_account       = $request->pk_account;
	        $vendor->contact_name     = $request->contact_name;
	        $vendor->title            = $request->title;
	        $vendor->pk_department    = $request->pk_department;
	        $vendor->address          = $request->address;
	        $vendor->address_1        = $request->address_1;
	        $vendor->city             = $request->city;
	        $vendor->zip              = $request->zip;
	        $vendor->pk_states        = $request->pk_states;
	        $vendor->pk_country       = $request->pk_country;
	        $vendor->email            = $request->email;
	        $vendor->office_phone     = $request->office_phone;
	        $vendor->login_enable     = isset($request->login_enable) && ($request->login_enable == 'on')? 1 : 0;
	        $vendor->active           = $request->active;
	        $vendor->pk_vendors       = $request->pk_vendors;
	        $vendor->save();

       }*/

      	if($request->submit == "Save And Next" || $request->submit == "Update And Next")
	    {
	        return redirect('/accountadmin/vendors/edit/'.$vendor->pk_vendors.'/?tab=comment');
	    }      
      	return redirect('/accountadmin/vendors');
    }
}
