<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        // Attempt to log in the user
        if (Auth::attempt($request->validated())) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // Return success response
            return response()->json([
                'message' => 'Login successful',
                'user' => Auth::user(),
            ]);
        }

        // Authentication failed
        return response()->json([
            'errors' => ['email' => ['The provided credentials are incorrect.']],
        ], 401);
    }

    public function authenticated(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'authenticated' => true,
        ]);
    }
}
