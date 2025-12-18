<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function signup(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'id' => $user->id,
            'fio' => $user->fio,
        ], 201);
    }

 public function signin(Request $request)
{
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if (!auth()->attempt($data)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Неверные учетные данные',
        ], 401);
    }

    $user = auth()->user();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => 'success',
        'token' => $token,
        'id' => $user->id,
        'fio' => $user->fio,
    ], 200);
}


    public function signout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
