<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);
        $check = $request->only('username','password');

        $che = DB::table('users')->where('username',$check['username'])->get();

        if(Auth::guard('web')->attempt($check))
        {
            switch(Auth::user()->pk_roles){
                case 1:
                // $this->redirectTo = 'superadmin';
                // return $this->redirectTo;
                //     break;
                return redirect('other-checkout');

                case 2:
                    // $this->redirectTo = 'accountadmin';
                    // return $this->redirectTo;
                    // break;
                    return redirect('other-checkout');

                case 3:
                    // $this->redirectTo = 'location-manager';
                    // return $this->redirectTo;
                    // break;
                    return redirect('other-checkout');

                case 4:
                    return redirect('other-checkout');


                default:
                    $this->redirectTo = 'login';
                    return $this->redirectTo;
            }
        }
        else
        {
            return redirect()->back()->with('error','Password or Username is Invalid.');
        }
    }
    public function guestRegister(Request $request)
    {
        $validated = $request->validate([
            'pk_roles' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:12|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'password'  =>  'required|min:8|confirmed',

          ]);
           $q = User::create([
              'pk_roles' => $request->pk_roles,
              'first_name' => $request->first_name,
              'last_name' => $request->last_name,
              'email' => $request->email,
              'username' => $request->username,
              'phone' => $request->phone,
              'password' => Hash::make($request->password),
          ]);

          if($q)
          {
            $check = $request->only('username','password');

            $che = DB::table('users')->where('username',$check['username'])->get();

            if(Auth::guard('web')->attempt($check))
            {
                switch(Auth::user()->pk_roles){
                    case 1:
                    // $this->redirectTo = 'superadmin';
                    // return $this->redirectTo;
                    //     break;
                    return redirect('other-checkout');

                    case 2:
                        // $this->redirectTo = 'accountadmin';
                        // return $this->redirectTo;
                        // break;
                        return redirect('other-checkout');

                    case 3:
                        // $this->redirectTo = 'location-manager';
                        // return $this->redirectTo;
                        // break;
                        return redirect('other-checkout');

                    case 4:
                        return redirect('other-checkout');


                    default:
                        $this->redirectTo = 'login';
                        return $this->redirectTo;
                }
            }
            else
            {
                return redirect()->back()->with('error','Password or Username is Invalid.');
            }
          }
          else
          {
            return redirect()->back()->with('error','Password or Username is Invalid.');

          }



    }
}
