<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /***
     * api/login
    */
public function login(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|max:20',
    ]);

    if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return ResponseHelper::fail(['message' => 'Invalid email or password.']);
    }

    // If authentication is successful
    $user = Auth::user();
    $token = $user->createToken('Pos')->plainTextToken;

    return ResponseHelper::success([
        'token' => $token,
        'user' => $user,
    ]);
}

    /**
     * logout Api
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return ResponseHelper::success([]);
    }
}
