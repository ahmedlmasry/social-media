<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $imagePath = $request->file('image')
            ? $request->file('image')->store('profile_images', 'public')
            : null;

        $user = User::create([
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'image' => $imagePath,
            'lang' => $request->header('Accept-Language', 'en'),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ], 201);
    }
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return ['token'=>$token];
        }
        return response()->json(['error' => __('auth.failed')], 401);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => __('auth.logout')]);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
