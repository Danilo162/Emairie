<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
     * @varstring
     */
//    protected $redirectTo = RouteServiceProvider::CONSOLE;

// https://mariowhowrites.com/logging-in-laravel/ Login Attempt
    protected $maxAttempts = 5;
    protected $decayMinutes = 1;


    protected function redirectTo(){

     return self::redirectUser();

    }
    public static function redirectUser(){
        self::logLogin("Success");
    /*    return route('console.home');*/

        if (!auth()->user()->isAdministred()){
            return route('console.home');
       }
       else {
            return route('profile');
       }

    }

    /**
     * Create a new controller instance.
     *
     * @returnvoid
     */


    protected function credentials(Request $request)
    {
//        dd($request);
        if(is_numeric($request->get('email'))){
            return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
        }
        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password'=>$request->get('password')];
        }
        return back();
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param $action
     * @param null $id
     * Logn de connexion
     */
    public static function logLogin($action,$username=null, $id=null){

        $ua = Request()->server('HTTP_USER_AGENT');

        Auth::attempt();
        $data = [
            "Action"=>$action,
            "username"=>$username,
            "by"=>auth()->check()?auth()->user()->id:null,
            "date"=>date("Y-m-d H:i:s"),
            "ip"=>Request()->ip(),
            "ua"=>$ua,
        ];

        Log::channel('login')->info("data:",$data);

    }
}
