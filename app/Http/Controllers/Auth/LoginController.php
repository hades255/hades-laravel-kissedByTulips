<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    public function showLoginForm()
    {
        if(isset($_GET['redirect'])) {
            $url = $_GET['redirect'];
        } else {
            $url = url()->previous();
        }
        session(['login_back_link' => $url]);
        return view('auth.login');
    }

    public function redirectTo()
      {
        $rulese = Auth::user()->pk_roles;

       switch($rulese){
           case 1:
           $this->redirectTo = 'superadmin';
           return $this->redirectTo;
               break;
           case 2:
               $this->redirectTo = 'accountadmin';
               return $this->redirectTo;
               break;
           case 3:
               $this->redirectTo = 'location-manager';
               return $this->redirectTo;
               break;
           case 4:
                $this->redirectTo = session('login_back_link');
                return $this->redirectTo;
                break;

            case 5:
                 $this->redirectTo = 'vendor';
                 return $this->redirectTo;
                 break;

            case 6:
                $this->redirectTo = 'assistant';
                return $this->redirectTo;
                break;

            case 7:
                $this->redirectTo = 'accountant';
                return $this->redirectTo;
                break;

            case 8:
                $this->redirectTo = 'other-cart';
                break;

           default:
               $this->redirectTo = 'login';
               return $this->redirectTo;
       }

       // return $next($request);
     }


    protected function authenticated(Request $request, $user)
    {
        if($request->pk_roles == 8){
            return redirect('other-cart');
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //this->middleware('guest')->except('logout');
    }

    public function username()
     {
    return 'username';
     }
}
