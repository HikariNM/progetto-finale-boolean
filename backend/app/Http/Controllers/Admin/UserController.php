<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Non puoi eliminare il tuo account.');
        }

        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
