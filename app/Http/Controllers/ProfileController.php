<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function edit()
     {
         return view('profile.edit');
     }

     public function update(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
         ]);

         $user = Auth::user();
         $user->name=$request->name;
         $user->email=$request->email;
         if($request->employer){$user->role='workowner';}
         $user->save();
         return redirect()->route('profile.edit')->with('status', 'profile-updated');
     }

     public function updatePassword(Request $request)
     {
         $request->validate([
             'current_password' => 'required',
             'password' => 'required|string|min:8|confirmed',
         ]);

         $user = Auth::user();

         if (!Hash::check($request->current_password, $user->password)) {
             return back()->withErrors(['current_password' => 'Current password does not match.']);
         }

        $user->password=['password' => Hash::make($request->password)];

         return redirect()->route('profile.edit')->with('status', 'password-updated');
     }
     public function destroy(Request $request): RedirectResponse
     {
         $request->validateWithBag('userDeletion', [
             'password' => ['required', 'current_password'],
         ]);

         $user = $request->user();

         Auth::logout();

         $user->delete();

         $request->session()->invalidate();
         $request->session()->regenerateToken();

         return Redirect::to('/');
     }
     public function delete_user(Request $request): RedirectResponse
     {

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Find the user
        $user = User::findOrFail($request->user_id);
        $user->delete();

         return redirect()->back();
     }

 }
