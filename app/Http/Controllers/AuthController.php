<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        if (Auth::user()) {
            if (Auth::user()->isAdmin()) {
                return redirect(route('admin.dashboard'));
            }
            if (Auth::user()->isArtist()) {
                return redirect(route('artist.dashboard'));
            }
            if (Auth::user()->isUser()) {
                return redirect(route('home'));
            }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $authUser = Auth::user();

            if ($authUser->isAdmin()) {
                return redirect(route('admin.dashboard'))->with('success', 'login successfully');
            }
            if ($authUser->isArtist()) {
                return redirect(route('artist.dashboard'))->with('success', 'login successfully');
            }
            if ($authUser->isUser()) {
                return redirect(route('home'))->with('success', 'login successfully');
            } else {
                Auth::logout();
                return back()->with('error', 'Credentials do not Match');
            }
        } else {
            Auth::logout();
            return back()->with('error', 'Record not found');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('home'));
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:artist,user',
        ]);

        $role = $request->role;

        $user = User::create([
            'role_id' => ($role === 'artist') ? User::ARTIST_ROLE_ID : User::USER_ROLE_ID,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            Auth::login($user);

            if ($user->isArtist()) {
                return redirect(route('artist.dashboard'));
            } elseif ($user->isUser()) {
                return redirect(route('home'))->with('success', 'Kindly Setup your Profile first');
            }
        }

        return view('auth.register');
    }

}
