<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Expeciton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Profesor;
use App\Incidencia;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
   
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
   
            $finduser = Profesor::where('google_id', $user->id)->first();
   
            if($finduser){
                Auth::login($finduser);
                if($finduser->admin==1){
                    return redirect("/homeadmin"); 
                }else{
                    return redirect("/home"); 
                }
            }else if(strpos($user->email, 'plaiaundi.net')||strpos($user->email, 'plaiaundi.com')){
                    $newUser=Profesor::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'avatar'=> $user->avatar,
                ]);
                
                    Auth::login($newUser);
                    return redirect("/home");

                    //modelo::select
            }else{
                $email=$user->email;
                return view('permiso',['email'=>$email]);
                }
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
}
