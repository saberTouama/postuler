<?php

namespace App\Http\Controllers\Auth;

use Closure  ;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Auth\LoginRequest;
use PhpParser\Builder\TraitUse;
use Symfony\Component\HttpFoundation\Response;


class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
   //return response()->noContent();
     //return redirect('/home');
    }
    public function all(){
        $users=User::all();
        return view('offre.admin.users',compact('users'));
    }
    public function accept($id){
        $user=User::find($id);
        $user->isworkowner=true;
        $user->save();
   return redirect()->back();
    }
    public function notify($id){
        $user=User::find($id);
        $user->notified=true;
        $user->save();
        return redirect()->back();
    }
    public function unnotify($id){
        $user=User::find($id);
        $user->notified=false;
        $user->save();
        return redirect()->back();
    }

}
