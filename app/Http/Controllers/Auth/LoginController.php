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
        $user->assignRole($user->role_id);
        $userAuditor = Auditor::where('user_id', $user->id)->get();
        $userAuditee = Auditee::where('user_id', $user->id)->get();
        // dd($user);
        if ($user->hasRole(1)) {
            $user->update([
                'peran' => 'spm',
            ]);
            $user->save();
            return redirect()->route('home.spm');
        }
        elseif ($user->hasRole(2)) {
            $user->update([
                'peran' => 'user',
            ]);
            $user->save();
            return redirect()->route('home.auditee');
        } elseif ($user->hasRole(3)) {
            $user->update([
                'peran' => 'superadmin',
            ]);
            $user->save();
            return redirect()->route('home.spm');
        }
    }
}
