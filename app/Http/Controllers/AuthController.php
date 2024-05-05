<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['msg' => 'User Not Found']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['msg' => 'Password not same']);
        }

        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        // dd(Auth::user());
        if (Auth::check() && $user->role == 'admin') {
            return redirect()->route('admin.index');
        } else if (Auth::check() && $user->role == 'user') {
            return redirect()->route('user.index');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
