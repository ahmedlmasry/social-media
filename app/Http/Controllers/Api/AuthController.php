<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
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
        $validated['image'] = $imagePath;
        $validated['lang'] = $request->header('Accept-Language','en');

        $user = User::create($validated);

        return response()->json([
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'user' => new UserResource($user),
        ], 201);
    }
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            return [
                'token'=> $user->createToken('auth_token')->plainTextToken
            ];
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
        return response()->json(new UserResource($request->user()));
    }
}
