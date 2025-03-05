<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)//: Response
    { $request->validate(   // $validator= $request->validate(
       [
            'Rname' => ['required', 'string', 'max:255'],
            'Remail' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'Rpassword' => ['required', 'confirmed', Rules\Password::defaults()],
            'isworkowner' => 'nullable'
        ]);
        $role = $request->has('isworkowner') ? 'workowner' : 'user';
        $user = User::create([
            'name' => $request->Rname,
            'email' => $request->Remail,
            'password' => Hash::make($request->string('Rpassword')),
             'role'=>$role
        ]);
      /*   if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator, 'custom_errors') // Use a custom key
                             ->withInput();
        }*/
        event(new Registered($user));

        Auth::login($user);

       // return response()->noContent();
       return redirect('/');
    }
    public function index() {
        return view('auth.register');//return a registration form view
    }
}
