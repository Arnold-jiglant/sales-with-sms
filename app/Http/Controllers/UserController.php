<?php

namespace App\Http\Controllers;

use App\Language;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('view-users');
        $roles = Role::all();
        $languages = Language::all();
        $users = User::paginate(10);
        return view('users', compact('users', 'roles','languages'));
    }

    //add user
    public function add(Request $request)
    {
        Gate::authorize('add-user');
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'role' => 'required|integer',
            'language' => 'required|integer',
        ]);
        User::create([
            'fname' => $request->get('first_name'),
            'lname' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make('12345'),
            'role_id' => $request->get('role'),
            'language_id' => $request->get('language'),
            'active' => $request->has('active')
        ]);
        return redirect()->back()->with('success', 'New user added');
    }

    //update user
    public function update(Request $request, $id)
    {
        Gate::authorize('edit-user');
        $user = User::find($id);
        if ($user == null) {
            return redirect(back('users'))->with('error', 'User Not Found');
        }
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'role' => 'required|integer',
            'language' => 'required|integer',
        ]);
        $user->fname = $request->get('first_name');
        $user->lname = $request->get('last_name');
        $user->email = $request->get('email');
        $user->role_id = $request->get('role');
        $user->language_id = $request->get('language');
        $user->active = $request->has('active');
        $user->save();

        //check language
        if (auth()->id()==$user->id) Lang::setLocale($user->locale);
        return redirect()->back()->with('success', 'User Updated!');
    }

    //reset user password
    public function reset(Request $request, $id)
    {
        Gate::authorize('edit-user');
        $user = User::find($id);
        if ($user == null) {
            return redirect(back('users'))->with('error', 'User Not Found');
        }
        $user->password = Hash::make('12345');
        $user->save();
        return redirect()->back()->with('success', 'User password reset!');
    }

    //change user password
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);
        auth()->user()->password = Hash::make($request->get('password'));
        auth()->user()->save();
        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    //delete user
    public function delete($id)
    {
        Gate::authorize('delete-user');
        $user = User::find($id);
        if ($user == null) {
            return redirect(back('users'))->with('error', 'User Not Found');
        }
        abort(404);
        //TODO delete user
    }
}
