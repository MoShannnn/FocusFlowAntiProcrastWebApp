<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * User Profile
     */
    public function settings()
    {
        return Inertia::render('Setting/Profile');
    }

    public function updateProfile(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id() . ',id,deleted_at,NULL'],
        ]);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Update user data
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
    
        // Return response
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
        }
    
        return redirect()->back();
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

        return redirect()->back();
    }
}
