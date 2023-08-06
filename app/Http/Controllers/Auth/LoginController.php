<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auditee;
use App\Models\Auditor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
    {
        $user->assignRole($user->role);
        $userAuditor = Auditor::where('user_id', $user->id)->get();
        $userAuditee = Auditee::where('user_id', $user->id)->get();
        // dd($user);
        if ($user->hasRole('SPM')) {
            return redirect()->route('auditor-periode');
        }
        elseif ($user->hasRole('User')) {
            if (count(Auth::user()->auditor()->get('user_id')) != 0) {
                return redirect()->route('auditor-daftarauditor-periode');
            } elseif (count(Auth::user()->auditee()->get('user_id')) != 0) {
                return redirect()->route('auditee-daftarauditor-periode');
            }
        } 
    }
}
