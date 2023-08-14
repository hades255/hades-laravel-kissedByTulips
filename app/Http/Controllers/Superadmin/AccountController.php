<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\Account;
use App\User;
use App\Country;
use App\State;
use DB;


class AccountController extends Controller
{
  public function index()
    {
        $accounts = DB::table('kbt_account')->get();
        return view('superadmin.account.index',['accounts'=>$accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles     = Role::all();
      $countries = Country::all();
      $states    = State::where('pk_country',1)->get();
      return view('superadmin.account.add' ,['roles' => $roles,'countries'=>$countries,'states'=>$states]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $account   = Account::find($id);
      //echo "<pre>"; print_r($account); die;
      $roles     = Role::all();
      $getUsers  = User::where('pk_account',$account->pk_account)->get();
      $countries = Country::all();
      $states    = State::where('pk_country',1)->get();
      return view('superadmin.account.edit',['account'=>$account,'roles'=>$roles ,'getUsers'=>$getUsers,'countries'=>$countries,'states'=>$states]);
    }

    public function getAccountuser(Request $request,$id){
      $getUser  = User::where('pk_users',$id)->first();
      return view('superadmin.account.account_users_edit',['getUser' => $getUser]);
    }

    public function updateAccountuser(Request $request){
      $validate = $request->validate([
        'email' => 'required',
        'username' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required|Max:10|Min:10',
      ]);
      $user = User::where('pk_users',$request->pk_users)->where('pk_account',$request->pk_account)->first();
      $user->pk_account = $request->pk_account;
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->username = $request->username;
      $user->phone = $request->phone;
      $user->active  = $request->active;
      $user->save();
      return redirect('/superadmin/account/edit/'.$request->pk_account);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request , $id)
    {
       if(!empty($id)){
        DB::table('kbt_account')->where('pk_account' , $id)->delete();
        DB::table('users')->where('pk_account',$id)->delete();
        }
      return back();
    }

    public function deleteAccountuser(Request $request , $id)
    {
       if(!empty($id)){
        DB::table('users')->where('pk_users',$id)->delete();
        }
      return redirect('/superadmin/account');
    }


    public function store(Request $request){
      $validate = $request->validate([
        'business_name' => 'required',
      ]);
      $account = Account::create([
          'business_name' =>$request->business_name,
          'address' =>$request->address,
          'address_1' =>$request->address_1,
          'city' =>$request->city,
          'pk_states' =>$request->pk_states,
          'zip'  =>$request->zip,
          'pk_country' =>$request->pk_country,
          'state_name' =>$request->state_name,
          'country_name' =>$request->country_name,
          'business_phone' =>$request->business_phone,
          'fax'   =>$request->fax,
          'business_email' =>$request->business_email,
          'website' =>$request->website,
      ]);
      $account = Account::find($account->pk_account);
      return back()->with(['account'=>$account]);
    }

    public function submitAccountuser(Request $request){
      $user = new User;
      $user->pk_account = $request->pk_account;
      $user->pk_roles = $request->roles;
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->username = $request->username;
      $user->phone = $request->phone;
      $user->save();
      return redirect('/superadmin/account');
    }

    public function varifyemail(Request $request)
    {
        $email = User::where('email', $request->email)->get();

        if (count($email) > 0) {
            echo 'false';
        }
        else{
          echo 'true';
        }
   }

   public function varifyusername(Request $request)
   {

       $username = User::where('username', $request->username)->get();
       if (count($username) > 0) {
           echo 'false';
       }
       else{
         echo 'true';
       }
  }


    public function updateAccountOnly(Request $request){
    //echo "<pre>"; print_r($request->all()); die;
      $validated = $request->validate([
        'business_name' => 'required',
      ]);
        if(!empty($request->pk_account)){
        $account = Account::find($request->pk_account);
        $account->business_name = $request->business_name;
        $account->address = $request->address;
        $account->address_1 = $request->address_1;
        $account->city = $request->city;
        $account->pk_states = $request->pk_state;
        $account->zip  = $request->zip;
        $account->pk_country = $request->pk_country;
        $account->state_name = $request->state_name;
        $account->country_name = $request->country_name;
        $account->business_phone = $request->business_phone;
        $account->fax   = $request->fax;
        $account->business_email = $request->business_email;
        $account->website = $request->website;
        $account->active  = $request->active;
        $account->save();
      }
      return redirect('/superadmin/account');
    }

    public function back(){
      return redirect('/superadmin/account');
    }

    public function getReset(Request $request,$id){
      $pk_users = $id;
      return view('superadmin.account.reset',['pk_users'=>$pk_users]);

    }

    public function postReset(Request $request){
      $user = User::find($request->pk_users);
      $this->validate($request, [
      'current_password' => 'required',
      'password' => 'confirmed|min:6',
       ]);
      if (Hash::check($request->current_password, $user->password)) {
      //  echo "hello"; die;
         $user->fill([
          'password' => Hash::make($request->password)
          ])->save();
        //  echo "Done"; die;
          $request->session()->flash('success', 'Password changed');
          return redirect()->back();

        } else {
        $request->session()->flash('error', 'Password does not match');
        return redirect()->back();
        }
    }


}
