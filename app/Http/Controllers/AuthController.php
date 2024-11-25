<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login In
     */
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function storeLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Login valid
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Provides credentials does not match with our record.'
        ]);
    }

    /**
     * Sign Up
     */
    public function signup()
    {
        return Inertia::render('Auth/Signup');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }

    /**
     * Reset Password
     */
    public function resetPassword()
    {
        return Inertia::render('Setting/ResetPassword');
    }

    public function updatePassword(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'password_previous' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user(); // Get the authenticated user

        // Check if the previous password is correct
        if (!Hash::check($validatedData['password_previous'], $user->password)) {
            return redirect()->back()->withErrors([
                'password_previous' => 'The previous password is incorrect.',
            ])->withInput();
        }

        // Update the user's password
        $user->update([
            'password' => $validatedData['password'],
        ]);

        return redirect()->route('home')->with('success', 'Password updated successfully!');
    }
}
