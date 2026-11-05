<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    // Display the registration form.
    public function showRegister()
    {
        return view('auth.register');
    }

    // Create a new user account.
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8)->mixedCase()->numbers(),
            ],
        ]);

        $user = User::create($validated);

        // Log the user in immediately after registering.
        Auth::login($user);

        // Regenerate the session to help prevent session fixation.
        $request->session()->regenerate();

        return redirect()->route('posts.index');
    }

    // Display the login form.
    public function showLogin()
    {
        return view('auth.login');
    }

    // Check the login details.
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            // Create a new session after successful login.
            $request->session()->regenerate();

            return redirect()->route('posts.index');
        }

        // Login failed, so return to the form with an error.
        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->withInput();
    }

    // Log the user out.
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the old session.
        $request->session()->invalidate();

        // Create a new CSRF token.
        $request->session()->regenerateToken();

        return redirect()->route('posts.index');
    }
}
