<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns|max:100',
            'password' => 'required|string|max:100|min:4'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            // login the user and ensures that the Auth::user() method will return the authenticated user object
            Auth::login(Auth::user());
            return redirect('/posts');
        }
        return back()->withErrors([
            'email' => 'Email or password incorect'
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $validated = $request->validate([
            'username' => 'required| string|unique:users',
            'email' => 'required|email:rfc,dns|max:100|unique:users',
            'password' => 'required|string|max:100|min:4',
            'picture' => 'required|mimes:jpeg,png,jpg'
        ]);
        // hashing the password for the database from the input "password" after the validation
        $validated['password'] = Hash::make($validated['password']);

        $slug = Str::slug($request->username, '_');
        $newPicture = uniqid() . '-' . $slug . '.' . $request->picture->extension();
        $request->picture->move(public_path('images'), $newPicture);

        $validated['picture'] = $newPicture;
        // dd($validated['picture']);
        $user = User::create($validated);
        // dd($user);
        Auth::login($user);


        return redirect('/posts');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function showProfile()
    {
        return view('profile.index');
    }
}
