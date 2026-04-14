<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    // Show the password generator page
    public function index()
    {
        return view('password');
    }

    // Generate a password and save it to the database
    public function generate(Request $request)
    {
        // Validate inputs
        $request->validate([
            'length' => 'required|integer|min:6|max:64',
            'include_uppercase' => 'nullable|boolean',
            'include_numbers' => 'nullable|boolean',
            'include_symbols' => 'nullable|boolean',
        ]);

        $length = $request->input('length');
        $characters = 'abcdefghijklmnopqrstuvwxyz';

        // Add additional character sets based on user selection
        if ($request->boolean('include_uppercase')) {
            $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($request->boolean('include_numbers')) {
            $characters .= '0123456789';
        }
        if ($request->boolean('include_symbols')) {
            $characters .= '!@#$%^&*()-_=+[]{}<>?';
        }

        // Generate password
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }

        // Save the generated password to the database
        Password::create(['generated_password' => $password]);

        // Evaluate the password strength
        $passwordStrength = $this->evaluatePasswordStrength($password);

        return response()->json([
            'password' => $password,
            'strength' => $passwordStrength
        ]);
    }

    // Evaluate password strength
    private function evaluatePasswordStrength($password)
    {
        $strength = 'Weak';

        // Check password length
        if (strlen($password) >= 8) {
            // Check if any of the required sets (uppercase, number, or symbol) are missing
            $hasUppercase = preg_match('/[A-Z]/', $password);
            $hasNumber = preg_match('/\d/', $password);
            $hasSymbol = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);

            if ($hasUppercase || $hasNumber || $hasSymbol) {
                // If one of the character sets is present, but not all, set strength to 'Moderate'
                $strength = 'Moderate';
            } else {
                // If none of the sets are present, it's still considered 'Weak'
                $strength = 'Weak';
            }
        }

        // Check if the password is at least 12 characters long and contains all required sets
        $hasUppercase = preg_match('/[A-Z]/', $password);
        $hasNumber = preg_match('/\d/', $password);
        $hasSymbol = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);

        if (strlen($password) >= 12 && $hasUppercase && $hasNumber && $hasSymbol) {
            $strength = 'Strong';
        }

        return $strength;
    }

    // Show all saved passwords
    public function showAllPasswords()
    {
        $passwords = Password::all(); // Get all saved passwords
        return response()->json(['passwords' => $passwords]);
    }

    // Delete selected passwords
    public function deletePasswords(Request $request)
    {
        $ids = $request->input('ids');
        Password::whereIn('id', $ids)->delete(); // Delete passwords by IDs
        return response()->json(['message' => 'Passwords deleted successfully']);
    }
}
