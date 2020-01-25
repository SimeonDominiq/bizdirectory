<?php

namespace App\Http\Controllers\Auth;

use Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use App\Repositories\User\UserRepository;
use App\Events\User\LoggedIn;
use App\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('guest')->except('logout');
    }

    public function index() {
        return view('auth.login');
    }
    
    /**
     * Handle user's login request
     *
     * @param LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request) {
        $userData = [
            'email'         =>  $request->email,
            'password'      =>  $request->password
        ];

        if (Auth::attempt($userData)) {
            $user = Auth::user();

            event(new LoggedIn($user));

            return redirect()->route('dashboard');
        }
        
        return redirect('login')->withErrors('Invalid Email / Password. Please try again');
    }

    public function logout(Request $request) {
        Auth::logout();
        \Session::flush();
        return redirect()->route('login');     
    }

}
