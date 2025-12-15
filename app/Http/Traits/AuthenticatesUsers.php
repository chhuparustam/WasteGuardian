<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

trait AuthenticatesUsers
{
    /**
     * Validate login credentials and return the user if valid
     *
     * @param Request $request
     * @param string $model The model class to authenticate against
     * @param string $emailField The email field name (default: 'email')
     * @return mixed The authenticated user or null
     */
    protected function attemptLogin(Request $request, $model, $emailField = 'email')
    {
        $request->validate([
            $emailField => 'required|email',
            'password' => 'required'
        ]);

        $user = $model::where($emailField, $request->input($emailField))->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }

        return null;
    }

    /**
     * Get common validation rules for login
     *
     * @return array
     */
    protected function loginValidationRules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Handle failed login attempt
     *
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function failedLoginResponse($message = 'Invalid credentials')
    {
        return back()->with('failed', $message);
    }
}
