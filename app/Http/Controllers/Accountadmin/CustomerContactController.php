<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use App\CustomerContact;
use App\Customertype;
use App\CustomerAddres;
use App\State;
use App\Country;
use App\User;
use App\Department;
use DB;
use Auth;

class CustomerContactController extends Controller
{
    public function index(Request $request, $id)
    {

        $customer_id    = $id;
        $pk_account     = Auth::user()->pk_account;
        $customer_types = Customertype::all();
        $states         = State::where('pk_country', 1)->get();
        $countries      = Country::all();
        $departments    = Department::where('pk_account', $pk_account)->get();

        return view('accountadmin.customers.contacts.add', ['customer_id' => $customer_id, 'departments' => $departments, 'pk_account' => $pk_account, 'customer_types' => $customer_types, 'states' => $states, 'countries' => $countries]);
    }

    public function delete($id)
    {
        $pk_account = Auth::user()->pk_account;
        DB::table('kbt_customers')->where('pk_account', $pk_account)->where('pk_customers', $id)->delete();
        return redirect()->route('accountadmin.vendors')
            ->with('message', 'products-categories deleted successfully');
    }

    public function store(Request $request)
    {
        //echo "<pre>"; print_R($request->all()); die;
        $validated = $request->validate([
            'contact_name' => 'required|max:50',
        ]);
        //echo "<pre>"; print_r($request->all()); die;
        $customer                = new CustomerContact;
        $customer->pk_account    = $request->pk_account;
        $customer->pk_customers  = $request->pk_customers;
        $customer->contact_name  = $request->contact_name;
        $customer->title         = $request->title;
        $customer->pk_department = $request->pk_department;
        $customer->email         = $request->email;
        $customer->office_phone  = $request->office_phone;
        $customer->login_enable  = isset($request->login_enable) && ($request->login_enable === 'on') ? 1 : 0;
        $customer->save();
        //print_r($customer->pk_customers); die;
        $state                            = State::where('state_code', $request->state_name)->first();
        $customerAddress                  = new CustomerAddres();
        $customerAddress->pk_customers    = $request->pk_customers;
        $customerAddress->pk_address_type = 1;
        $customerAddress->address         = $request->address;
        $customerAddress->address_1       = $request->address_1;
        $customerAddress->city            = $request->city;
        $customerAddress->zip             = $request->zip;
        $customerAddress->pk_states       = $state->pk_states ?? 1;
        $customerAddress->pk_country      = $state->pk_country ?? 1;
        $customerAddress->lat             = isset($request->lat) ? $request->lat : '';
        $customerAddress->lng             = isset($request->lng) ? $request->lng : '';
        $customerAddress->save();

        if ($request->login_enable) {
            $validated = $request->validate([
                'username' => 'required|max:50|unique:users',
                'password' => 'required|max:10|confirmed'
            ]);
            // print_r($customer->pk_customers); die;
            $customer_user                       = new User;
            $customer_user->username             = $request->username;
            $customer_user->password             = Hash::make($request->password);
            $customer_user->pk_roles             = 4;
            $customer_user->pk_account           = $request->pk_account;
            $customer_user->pk_customer_contacts = $customer->pk_customer_contacts;
            $customer_user->save();
            //print_r($customer_user->pk_users); die;
        }

        if ($request->submit == "Save And Next" || $request->submit == "Update And Next") {
            return redirect('/accountadmin/customers/edit/' . $customer->pk_customers . '/?tab=comment');
        }
        return redirect('/accountadmin/customers');
    }

    public function edit($id)
    {
        //echo "<pre>"; print_r($id); die;
        $pk_account       = Auth::user()->pk_account;
        $customer_contact = DB::table('kbt_customer_contacts')
            ->leftjoin('users', 'users.pk_customer_contacts', '=', 'kbt_customer_contacts.pk_customer_contacts')
            ->select('kbt_customer_contacts.*', 'users.pk_users', 'users.username')
            ->where('kbt_customer_contacts.pk_customer_contacts', '=', $id)
            ->first();

        $customer       = DB::table('kbt_customers')->where('pk_account', $pk_account)->where('pk_customers', $customer_contact->pk_customers)->first();
        $customer_types = Customertype::all();
        $states         = State::where('pk_country', 1)->get();
        $countries      = Country::all();
        $customerUser   = DB::table('users')->where('pk_customers', $customer_contact->pk_customers)->first();
        $departments    = Department::where('pk_account', $pk_account)->get();
        $customers      = DB::table('kbt_customer_contacts')
            ->join('kbt_department', 'kbt_customer_contacts.pk_department', 'kbt_department.pk_department')
            ->get();
        $customerAddr   = CustomerAddres::where('pk_customers', $customer_contact->pk_customers)
            ->where('pk_address_type', 1)->first();

        //echo "<pre>"; print_r($customer_contact); die;
        return view('accountadmin.customers.contacts.add', compact(
            'customer_contact',
            'departments',
            'customers',
            'pk_account',
            'customer',
            'customer_types',
            'states',
            'countries',
            'customerUser',
            'customerAddr'
        ));
    }

    public function update(Request $request)
    {
        $existin_customer_contact_user = User::where('pk_customer_contacts', $request->pk_customer_contacts)->first();

        if (isset($request->login_enable) && ($request->login_enable == 'on') && !empty($request->username) && $existin_customer_contact_user) {
            $validated = $request->validate([
                'username'     => 'required|max:50|unique:users,username,' . $existin_customer_contact_user->pk_users . ',pk_users',
                'contact_name' => 'required|max:50',
            ]);

            $customer_user                       = User::find($existin_customer_contact_user->pk_users);
            $customer_user->username             = $request->username;
            $customer_user->password             = Hash::make($request->password);
            $customer_user->pk_roles             = 4;
            $customer_user->pk_account           = $request->pk_account;
            $customer_user->pk_customer_contacts = $request->pk_customer_contacts;
            $customer_user->save();
        } elseif (isset($request->login_enable) && ($request->login_enable == 'on') && !empty($request->username) && !$existin_customer_contact_user) {
            $validated = $request->validate([
                'username'     => 'required|max:50|unique:users',
                'password'     => 'required|min:6|confirmed',
                'contact_name' => 'required|max:50',
            ]);

            $customer_user                       = new User;
            $customer_user->username             = $request->username;
            $customer_user->password             = Hash::make($request->password);
            $customer_user->pk_roles             = 4;
            $customer_user->pk_account           = $request->pk_account;
            $customer_user->pk_customer_contacts = $request->pk_customer_contacts;
            $customer_user->save();
        } elseif (!isset($request->login_enable) && $existin_customer_contact_user) {
            $validated = $request->validate([
                //'username' => 'required|max:50|unique:users',
                //'password' => 'required|min:6|confirmed',
                'contact_name' => 'required|max:50',
            ]);

            DB::table('users')->where('pk_users', $request->pk_users)->delete();
        }

        $customer                = CustomerContact::find($request->pk_customer_contacts);
        $customer->pk_account    = $request->pk_account;
        $customer->contact_name  = $request->contact_name;
        $customer->title         = $request->title;
        $customer->pk_department = $request->pk_department;
        $customer->email         = $request->email;
        $customer->office_phone  = $request->office_phone;
        $customer->login_enable  = isset($request->login_enable) && ($request->login_enable == 'on') ? 1 : 0;
        $customer->active        = $request->active;
        $customer->pk_customers  = $request->pk_customers;
        $customer->save();

        $customerAddress                  = new CustomerAddres();
        $customerAddress->pk_customers    = $request->pk_customers;
        $customerAddress->pk_address_type = 1;
        $customerAddress->address         = $request->address;
        $customerAddress->address_1       = $request->address_1;
        $customerAddress->city            = $request->city;
        $customerAddress->zip             = $request->zip;
        $customerAddress->pk_states       = $request->pk_states ?? 1;
        $customerAddress->pk_country      = $request->pk_country ?? 1;
        $customerAddress->save();
        if ($request->submit == "Save And Next" || $request->submit == "Update And Next") {
            return redirect('/accountadmin/customers/edit/' . $customer->pk_customers . '/?tab=comment');
        }
        return redirect('/accountadmin/customers');
    }


    public function back()
    {
        return redirect('/accountadmin/customers');
    }

}
