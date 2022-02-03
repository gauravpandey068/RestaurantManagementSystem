<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminRole');
    }

    public function index()
    {
        //get all users
        $users = User::orderBy('created_at', 'asc')->get();
        return view('dashboard.user', [
            'users' => $users
        ]);

    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required',
        ]);
        //create new user
        $user = new User();
        $user->create([
            'name' => request('name'),
            'email' => request('email'),
            'role' => request('role'),
            'password' => bcrypt(request('password')),
        ]);
        return redirect()->route('users');
    }
    //delete user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users');
    }
    public function update($id)
    {
        $user = User::find($id);
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required',
        ]);

        $user->name = request('name');
        $user->email = request('email');
        $user->role = request('role');
        $user->save();

        return redirect()->back();
    }
    public function changePassword($id)
    {
        $user = User::find($id);
        request()->validate([
            'password' => 'required|min:6',
        ]);
        $user->password = bcrypt(request('password'));
        $user->save();

        return redirect()->back();
    }
}
