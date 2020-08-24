<?php

namespace App\Http\Controllers;

use App\Language;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WizardController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('startup.wizard', compact('languages'));
    }

    //new user
    public function newUser(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'language' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $user = User::create([
            'fname' => $request->get('first_name'),
            'lname' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_id' => 1,
            'language_id' => $request->get('language'),
            'active' => true
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }
}
