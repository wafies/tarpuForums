<?php // Starts the PHP script so Laravel can parse this file.

namespace App\Http\Controllers; // Declares this controller belongs to the App\Http\Controllers namespace.

use App\Models\User; // Imports the User model so the controller can work with user records.
use Illuminate\Http\Request; // Imports Laravel's Request class for handling incoming HTTP form data.
use Illuminate\Support\Facades\Password; // Imports the Password facade, which provides password reset helper methods.
use Illuminate\Validation\Rules\Password as PasswordRule; // Imports Laravel's password validation rule class for enforcing strong passwords.
use Illuminate\Support\Str; // Imports the Str helper class for generating secure random strings.
use Illuminate\Auth\Events\PasswordReset; // Imports the event that fires when a password is reset.

class PasswordResetController extends Controller // Defines the controller class and extends the base Controller class provided by Laravel.
{
    // Show the forgot password form. // This comment explains the purpose of the next method.
    public function showForgotPassword() // Defines a public method named showForgotPassword that can be called by a route.
    {
        return view('/auth/forgot-password'); // Calls Laravel's view() helper to render the forgot-password Blade view.
    }

    // Send a password reset link to the provided email. // Explains that this method sends a reset email to a user.
    public function sendResetLink(Request $request) // Defines a method that accepts the incoming HTTP request object.
    {
        $validated = $request->validate([ // Calls the validate() method on the request to validate incoming data.
            'email' => 'required|email' // Requires the email field and validates that it is a properly formatted email address.
        ]);

        // The result is intentionally ignored: sent, throttled, or unknown user
        // all get the same response so we never reveal which emails are registered.
        Password::sendResetLink([ // Calls the sendResetLink() static method on the Password facade to generate and send a reset link.
            'email' => $validated['email'] // Passes the validated email to the reset link generator.
        ]);

        return back()->with( // Calls the back() helper to redirect back to the previous page, then with() to store a flash message.
            'status', // The name of the flash message key to store.
            'If an account exists for that email, a reset link has been sent. ' // The first part of the message shown to the user.
            . 'If you requested one recently, please wait a few minutes before trying again.' // Appends more detail telling the user to wait if they recently requested a link.
        );
    }

    // Show the form for entering a new password. // Explains the purpose of the method below.
    public function showResetPassword(Request $request, string $token) // Defines the method, accepting the HTTP request and the reset token from the URL.
    {
        return view('/auth/reset-password', [ // Calls the view() helper to render the reset password form.
            'token' => $token, // Passes the reset token to the Blade view so it can be submitted back later.
            'email' => $request->query('email', '') // Calls the query() method to read the email from the URL, defaulting to an empty string if missing.
        ]);
    }

    // Validate the reset token and save the new password. // Explains that this method validates the token and updates the password.
    public function resetPassword(Request $request) // Defines the method that accepts the incoming request object.
    {
        $validated = $request->validate([ // Calls validate() to enforce rules for the submitted password reset form.
            'token'    => ['required', 'string'], // Requires a token and ensures it is a string.
            'email'    => ['required', 'email'], // Requires an email and validates that it is a valid email address.
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->uncompromised()], // Requires a password, checks that it matches password_confirmation, and applies strong password rules through the PasswordRule class.
        ]);

        $status = Password::reset( // Calls the reset() static method on the Password facade to validate the token and reset the password.
            [ // Starts the array of data sent to the reset method.
                'email' => $validated['email'], // Passes the user's email to the reset method.
                'password' => $validated['password'], // Passes the new plain-text password to the reset method.
                'password_confirmation' => $request->input('password_confirmation'), // Reads the confirmation field from the request and includes it in the reset data.
                'token' => $validated['token'] // Passes the reset token to the reset method.
            ],
            function (User $user, string $password) { // Defines the closure callback that runs after the token is validated; it receives the matched user and the new password.
                // The User model's 'hashed' cast hashes the password automatically,
                // so we assign the plain value here (no Hash::make).
                $user->forceFill([ // Calls the forceFill() method to assign attributes without triggering mass assignment restrictions.
                    'password' => $password // Stores the new plain password, which will be automatically hashed because of the User model cast.
                ]);

                $user->setRememberToken(Str::random(60)); // Calls setRememberToken() to generate a new remember token and attach it to the user.

                $user->save(); // Calls save() to persist the updated user record to the database.

                event(new PasswordReset($user)); // Fires the PasswordReset event to let the application react to a successful reset.
            }
        );

        if ($status === Password::PasswordReset) { // Checks whether the reset() call returned the success status constant.
            return redirect() // Calls redirect() to create a redirect response.
                ->route('login') // Uses the route() method to redirect to the login route.
                ->with( // Calls with() to attach a success flash message.
                    'status', // The flash-message key.
                    'Your password has been reset. You can now log in.' // The message displayed after a successful reset.
                );
        }

        return back() // Calls back() to return the user to the previous page on failure.
            ->withInput($request->only('email')) // Calls withInput() and only('email') to repopulate the email field on the form.
            ->withErrors([ // Calls withErrors() to attach validation errors for display in the Blade template.
                'email' => 'The reset link is invalid or has expired.' // Adds a generic error message that does not reveal whether the email or token was wrong.
            ]);
    }

} // Ends the PasswordResetController class definition.