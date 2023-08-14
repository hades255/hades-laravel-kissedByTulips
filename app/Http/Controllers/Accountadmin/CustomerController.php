<?php

namespace App\Http\Controllers\Accountadmin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use App\Customertype;
use App\State;
use App\Country;
use App\User;
use App\Comment;
use DB;
use App\Department;
use App\CustomerAddres;
use Auth;
use Excel;

class CustomerController extends Controller
{
    public function index()
    {
        $account   = Auth::user()->pk_account;
        $customers = Customer::latest()->with(['address', 'customertype'])->get();

        return view('accountadmin.customers.index', compact('customers'));
    }

    public function create(Request $request, $id = null)
    {

        $pk_account     = Auth::user()->pk_account;
        $customer_types = Customertype::all();
        $states         = State::where('pk_country', 1)->get();
        $countries      = Country::all();
        $departments    = Department::where('pk_account', $pk_account)->get();


        $customer = DB::table('kbt_customers')->where('pk_customers', $id)->first();

        return view('accountadmin.customers.add', ['departments' => $departments, 'customer' => $customer, 'pk_account' => $pk_account, 'customer_types' => $customer_types, 'states' => $states, 'countries' => $countries]);
    }


    public function edit($id)
    {
        $customer_id    = $id;
        $pk_account     = Auth::user()->pk_account;
        $customer       = Customer::find($id);
        $customer_types = Customertype::all();
        $departments    = Department::all();
        $states         = State::where('pk_country', 1)->get();
        $countries      = Country::all();
        $customerUser   = DB::table('users')->where('pk_customers', $id)->first();


        $comments         = Comment::where('pk_account', $pk_account)
            ->where('pk_customers', '!=', 'NULL')
            ->where('pk_customers', $id)
            ->get();
        $customercontacts = DB::table('kbt_customer_contacts')
            ->leftjoin('kbt_department', 'kbt_customer_contacts.pk_department', 'kbt_department.pk_department')
            ->where('kbt_customer_contacts.pk_customers', $id)
            ->get();
        $orders = Order::where('pk_customers', $id)->latest()->get();


        $customer_address = $customer->address()->with(['state', 'country'])->get();
        if ($customer->pk_customer_type == 1) {
            return view('accountadmin.customers.add', compact(
                'comments',
                'customer_address',
                'departments',
                'customer_id',
                'pk_account',
                'customer',
                'customer_types',
                'states',
                'countries',
                'customerUser',
                'orders'
            ));
        } else {
            $customerPrimaryAddr = CustomerAddres::where('pk_customers', $id)
                ->where('pk_address_type', 1)->first();
            return view('accountadmin.customers.business.add', compact(
                'customercontacts',
                'comments',
                'customer_types',
                'states',
                'countries',
                'pk_account',
                'customer',
                'customerPrimaryAddr'
            ));
        }

    }

    public function store(Request $request)
    {
        //echo "<pre>"; print_r($request->all()); die;
        if ($request->login_enable) {
            $validated                  = $request->validate([
                'customer_name' => 'required|max:50',
                'username'      => 'required|max:50|unique:users',
                'password'      => 'required|max:10|confirmed'
            ]);
            $customer                   = new Customer;
            $customer->pk_account       = $request->pk_account;
            $customer->customer_name    = $request->customer_name;
            $customer->website          = $request->website;
            $customer->pk_customer_type = $request->pk_customer_type;
            $customer->email            = $request->email;
            $customer->office_phone     = $request->office_phone;
            $customer->login_enable     = isset($request->login_enable) && ($request->login_enable === 'on') ? 1 : 0;
            $customer->save();


            $customer_user               = new User;
            $customer_user->username     = $request->username;
            $customer_user->password     = Hash::make($request->password);
            $customer_user->pk_roles     = 4;
            $customer_user->pk_account   = $request->pk_account;
            $customer_user->pk_customers = $customer->pk_customers;
            $customer_user->save();

        } else {
            $validated                  = $request->validate([
                'customer_name' => 'required|max:50',
            ]);
            $customer                   = new Customer;
            $customer->pk_account       = $request->pk_account;
            $customer->customer_name    = $request->customer_name;
            $customer->website          = $request->website;
            $customer->pk_customer_type = $request->pk_customer_type;
            $customer->email            = $request->email;
            $customer->office_phone     = $request->office_phone;
            $customer->login_enable     = isset($request->login_enable) && ($request->login_enable === 'on') ? 1 : 0;
            $customer->save();
        }
        return redirect('/accountadmin/customers/edit/' . $customer->pk_customers);
    }


    public function update(Request $request)
    {

        if (isset($request->login_enable) && ($request->login_enable == 'on') && empty($request->username) && empty($request->password)) {

            $validated                   = $request->validate([
                'username' => 'required|max:50|unique:users',
                'password' => 'required|max:10|confirmed'
            ]);
            $customer_user               = new User;
            $customer_user->username     = $request->username;
            $customer_user->password     = $request->password;
            $customer_user->pk_roles     = 5;
            $customer_user->pk_account   = $request->pk_account;
            $customer_user->pk_customers = $request->pk_customers;
            $customer_user->save();
        }
        if (isset($request->login_enable) && !empty($request->username) && !empty($request->pk_users)) {
            $customer                   = Customer::find($request->pk_customers);
            $customer->pk_account       = $request->pk_account;
            $customer->customer_name    = $request->customer_name;
            $customer->website          = $request->website;
            $customer->pk_customer_type = $request->pk_customer_type;
            $customer->email            = $request->email;
            $customer->office_phone     = $request->office_phone;
            $customer->login_enable     = isset($request->login_enable) && ($request->login_enable == 'on') ? 1 : 0;
            $customer->active           = $request->active;
            $customer->save();
            $customer_user               = User::find($request->pk_users);
            $customer_user->username     = $request->username;
            $customer_user->password     = $request->password;
            $customer_user->pk_roles     = 4;
            $customer_user->pk_account   = $request->pk_account;
            $customer_user->pk_customers = $request->pk_customers;
            $customer_user->save();
        }
        if (isset($request->login_enable) && !empty($request->username) && empty($request->pk_users)) {
            $validated                  = $request->validate([
                'username'         => 'required|max:50||unique:users',
                'customer_name'    => 'required|max:50',
                'pk_customer_type' => 'required',
            ]);
            $customer                   = Customer::find($request->pk_customers);
            $customer->pk_account       = $request->pk_account;
            $customer->customer_name    = $request->customer_name;
            $customer->website          = $request->website;
            $customer->pk_customer_type = $request->pk_customer_type;
            $customer->email            = $request->email;
            $customer->office_phone     = $request->office_phone;
            $customer->login_enable     = isset($request->login_enable) && ($request->login_enable == 'on') ? 1 : 0;
            $customer->active           = $request->active;
            $customer->save();
            $customer_user               = new User;
            $customer_user->username     = $request->username;
            $customer_user->password     = $request->password;
            $customer_user->pk_roles     = 4;
            $customer_user->pk_account   = $request->pk_account;
            $customer_user->pk_customers = $request->pk_customers;
            $customer_user->save();
        }
        if (!isset($request->login_enable) && !empty($request->username)) {
            $validated = $request->validate([
                'customer_name'    => 'required|max:50',
                'pk_customer_type' => 'required',
            ]);
            DB::table('users')->where('pk_users', $request->pk_users)->delete();
            $customer                   = Customer::find($request->pk_customers);
            $customer->pk_account       = $request->pk_account;
            $customer->customer_name    = $request->customer_name;
            $customer->website          = $request->website;
            $customer->pk_customer_type = $request->pk_customer_type;
            $customer->email            = $request->email;
            $customer->office_phone     = $request->office_phone;
            $customer->login_enable     = 0;
            $customer->active           = $request->active;
            $customer->save();
        }
        if (!isset($request->login_enable) && empty($request->username)) {
            $validated                  = $request->validate([
                'customer_name' => 'required|max:50',
            ]);
            $customer                   = Customer::find($request->pk_customers);
            $customer->pk_account       = $request->pk_account;
            $customer->customer_name    = $request->customer_name;
            $customer->website          = $request->website;
            $customer->pk_customer_type = $request->pk_customer_type;
            $customer->email            = $request->email;
            $customer->office_phone     = $request->office_phone;
            $customer->login_enable     = 0;
            $customer->active           = $request->active;
            $customer->save();
        }

        return redirect('/accountadmin/customers');
    }

    public function delete($id)
    {
        $pk_account = Auth::user()->pk_account;
        DB::table('kbt_customers')->where('pk_customers', $id)->delete();
        return redirect()->route('accountadmin.customers.index')
            ->with('message', 'products-categories deleted successfully');
    }

    public function businessIndex(Request $request)
    {
        $pk_account     = Auth::user()->pk_account;
        $customer_types = Customertype::all();
        $states         = State::where('pk_country', 1)->get();
        $countries      = Country::all();
        return view('accountadmin.customers.business.add', compact('pk_account', 'customer_types', 'states', 'countries'));
    }

    public function businessStore(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:50',
            'customer_type' => 'required',
        ]);

        $customer                   = new Customer;
        $customer->pk_account       = $request->pk_account;
        $customer->customer_name    = $request->customer_name;
        $customer->website          = $request->website;
        $customer->pk_customer_type = $request->customer_type;
        $customer->email            = $request->email;
        $customer->office_phone     = $request->office_phone;
        $customer->save();


        $state                            = State::where('state_code', $request->state_name)->first();
        $customerAddress                  = new CustomerAddres();
        $customerAddress->pk_customers    = $customer->pk_customers;
        $customerAddress->pk_address_type = 1;
        $customerAddress->address         = $request->address;
        $customerAddress->address_1       = $request->address_1;
        $customerAddress->city            = $request->city;
        $customerAddress->zip             = $request->zip;
        $customerAddress->pk_states       = $state->pk_states ?? 1;
        $customerAddress->pk_country      = $state->pk_country ?? 1;
        $customerAddress->lat             = $request->lat;
        $customerAddress->lng             = $request->lng;
        $customerAddress->save();

        if ($request->submit == "Save And Next" || $request->submit == "Update And Next") {
            return redirect('/accountadmin/customers/edit/' . $customer->pk_customers . '/?tab=contact');
        }
        return redirect('/accountadmin/customers');
    }

    public function businessUpdate(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); die;
        $request->validate([
            'customer_name' => 'required|max:50',
            'customer_type' => 'required',
        ]);
        $customer                   = Customer::find($request->pk_customers);
        $customer->pk_account       = $request->pk_account;
        $customer->customer_name    = $request->customer_name;
        $customer->website          = $request->website;
        $customer->pk_customer_type = $request->customer_type;
        $customer->address          = $request->address;
        $customer->address_1        = $request->address_1;
        $customer->city             = $request->city;
        $customer->zip              = $request->zip;
        $customer->pk_states        = $request->pk_states;
        $customer->pk_country       = $request->pk_country;
        $customer->email            = $request->email;
        $customer->office_phone     = $request->office_phone;
        $customer->lat              = $request->lat;
        $customer->lng              = $request->lng;
        $customer->state_name       = $request->state_name;
        $customer->country_name     = $request->country_name;
        $customer->save();
        if ($request->submit == "Save And Next" || $request->submit == "Update And Next") {
            return redirect('/accountadmin/customers/edit/' . $customer->pk_customers . '/?tab=contact');
        }
        return redirect('/accountadmin/customers');
    }


    public function commentStore(Request $request)
    {
        $request->validate([
            'comments' => 'required|max:200'
        ]);

        $pk_account = Auth::user()->pk_account;

        if (!empty($request->pk_comments)) {
            $comment = Comment::find($request->pk_comments);
            $comment->update([
                'pk_account'   => $pk_account,
                'comments'     => $request->comments,
                'contact_name' => $request->contact_name,
                'pk_customers' => $request->pk_customers,
            ]);
        } else {
            Comment::create([
                'pk_account'   => $pk_account,
                'comments'     => $request->comments,
                'contact_name' => $request->contact_name,
                'pk_customers' => $request->pk_customers,
            ]);
        }

        $comments = Comment::where('pk_account', $pk_account)
            ->where('pk_customers', '!=', 'NULL')
            ->where('pk_customers', $request->pk_customers)
            ->get();

        $tab      = "comment-edit";

        return view('accountadmin.customers.add', compact(
            'tab',
            'comments',
            'pk_account'
        ));
    }

    public function commentEdit(Request $request, $customer_id, $id)
    {
        $pk_account = Auth::user()->pk_account;
        $customer   = DB::table('kbt_customers')->where('pk_account', $pk_account)->where('pk_customers', $customer_id)->first();
        //echo "<pre>"; print_r($customer); die;
        $customer_types = Customertype::where('pk_account', $pk_account)->get();
        $states         = State::where('pk_country', 1)->get();
        $countries      = Country::all();
        $comments       = Comment::where('pk_account', $pk_account)->where('pk_customers', $id)->get();
        $editComment    = Comment::where('pk_account', $pk_account)->where('pk_comment', $id)->first();

        $customerUser   = DB::table('users')->where('pk_customers', $editComment->pk_customers)->first();
        $customer_types = Customertype::where('pk_account', $pk_account)->get();
        $tab            = "comment-edit";

        return view('accountadmin.customers.add', ['tab' => $tab, 'comments' => $comments, 'pk_account' => $pk_account, 'customer_types' => $customer_types, 'states' => $states, 'countries' => $countries, 'customerUser' => $customerUser, 'editComment' => $editComment, 'customer' => $customer]);
    }


    public function commentDelete(Request $request, $id)
    {
        $pk_account = Auth::user()->pk_account;
        DB::table('kbt_comment')->where('pk_account', $pk_account)->where('pk_comment', $id)->delete();
        return redirect()->back();
    }


    public function export()
    {
        $data = Customer::get()->toArray();
        Excel::store($data, 'test.xls')->download();
    }


    public function location(Request $request)
    {
        $address = "USA+" . $request->states . $request->city . $request->address_1 . $request->address;
        $url     = "https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A";
        $ch      = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $res          = json_decode($response);
        $data         = [];
        $data['lat']  = $res->results[0]->geometry->location->lat;
        $data['long'] = $res->results[0]->geometry->location->lng;
        if ($data) {
            return response()->json(['msg' => 'Updated Successfully', 'success' => true, 'data' => $data]);
        }
    }

    public function back()
    {
        return redirect("/accountadmin/customers");
    }


    public function address_add(Request $request, $id = null)
    {
        $data = Customer::find($id);

        if ($request->isMethod('post')) {

            $validator = CustomerAddres::validate($request->all());
            if ($validator->fails()) {
                session()->flash('message', 'Addres could not be create, please correct errors.');
                session()->flash('level', 'danger');
                return redirect('/accountadmin/customers/address/add/' . $id)->withErrors($validator)->withInput();
            }

            $state = State::where('state_code', $request->state_name)->first();
            CustomerAddres::create([
                'pk_customers'    => $id,
                'pk_address_type' => $data->address->count() ? 2 : 1,
                'address'         => $request->address,
                'address_1'       => $request->address_1,
                'city'            => $request->city,
                'pk_states'       => $state->pk_states ?? 1,
                'pk_country'      => $state->pk_country ?? 1,
                'zip'             => $request->zip,
                'lat'             => $request->lat,
                'lng'             => $request->lng,
            ]);

            return redirect()->route('accountadmin.customers.edit', $id)->with('message', 'Address has been save successfully');

        }


        return view('accountadmin.customers.addres_add', compact('data'));
    }


    public function address_edit(Request $request, $id = null)
    {

        $customer_address = CustomerAddres::with('state', 'country')->find($id);

        if ($request->isMethod('post')) {
            $validator = CustomerAddres::validate($request->all());
            if ($validator->fails()) {
                session()->flash('message', 'Addres could not be updated, please correct errors.');
                session()->flash('level', 'danger');
                return redirect('/accountadmin/customers/address/add/' . $customer_address->pk_customers)->withErrors($validator)->withInput();
            }

            $customer_address->update([
                'address'    => $request->address,
                'address_1'  => $request->address_1,
                'city'       => $request->city,
                'pk_states'  => $request->pk_states ?? 1,
                'pk_country' => $request->pk_country ?? 1,
                'zip'        => $request->zip,
                'lat'        => $request->lat,
                'lng'        => $request->lng,
            ]);

            return redirect()->route('accountadmin.customers.edit', $customer_address->pk_customers)->with('message', 'Address has been updated successfully');

        }

        $data = $customer_address->customer;

        return view('accountadmin.customers.addres_add', compact('data', 'customer_address'));
    }


    public function address_delete(Request $request, $id = null)
    {
        $data             = DB::table('kbt_customer_address')->where('pk_customer_address', $id)->first();
        $customer_address = DB::table('kbt_customer_address')->where('pk_customer_address', $id)->delete();
        return redirect()->route('accountadmin.customers.edit', $data->pk_customers)->with('message', 'Address has been delete successfully');
    }


}
