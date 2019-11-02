<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-users')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $filter = $request->get('keyword');
        if ($filter) {
            $users = User::where('role', 'LIKE', $filter)->paginate(10);
        } else {
            $users = User::paginate(10);
        }

        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view("user.create");
    }

    public function store(Request $request)
    {
        $new_user =  new User;
        $new_user->name = $request->get('name');
        $new_user->email = $request->get('email');
        $new_user->username = $request->get('username');
        $new_user->role = $request->get('role');
        $new_user->password = \Hash::make($request->get('password'));
        $new_user->save();

        return redirect()->route('user.create')->with('status', 'User successfully created');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->role = $request->get('role');

        if ($request->get('password')) {
            $user->password = \Hash::make($request->get('password'));
        }

        $user->save();

        return redirect()->route('user.edit', ['id' => $id])->with('status', 'User successfully updated');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('status', 'User successfully deleted');
    }
}
