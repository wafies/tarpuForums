<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller 
{
    public function showForgotPassword()
    {
        return view('/auth/forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        Password::sendResetLink([
            'email' => $validated['email']
        ]);

        return back()->with(
            'status',
            'If an account exists for that email, a reset link has been sent. '
            . 'If you requested one recently, please wait a few minutes before trying again.'
        );
    }

    public function showResetPassword(Request $request, string $token)
    {
        return view('/auth/reset-password', [
            'token' => $token,
            'email' => $request->query('email', '')
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token'    => ['required', 'string'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->uncompromised()],
        ]);

        $status = Password::reset(
            [
                'email' => $validated['email'],
                'password' => $validated['password'],
                'password_confirmation' => $request->input('password_confirmation'),
                'token' => $validated['token']
            ],
            function (User $user, string $password) {
                $user->forceFill([ 
                    'password' => $password 
                ]);

                $user->setRememberToken(Str::random(60)); 
                $user->save();

                event(new PasswordReset($user)); 
            }
        );

        if ($status === Password::PasswordReset) { 
            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'Your password has been reset. You can now log in.' 
                );
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The reset link is invalid or has expired.'
            ]);
    }
}