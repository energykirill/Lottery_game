<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email'    => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'status' => 'fail',
                'error'  => 'Incorrect email or password'
            ], 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        $payload = [
            'email' => $user->email,
            'id'    => $user->id
        ];

        $jwt = JWT::encode($payload, env('JWT_SECRET'), env('JWT_ALG'));

        User::where('email', $request->input('email'))
            ->update([
                'token' => $jwt
            ]);

        return response()->json([
            'status' => 'success',
            'token' => $jwt
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email'      => 'required|string',
            'password'   => 'required|string',
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'is_admin'   => 'required|boolean'
        ]);

        if (User::where('email', $request->input('email'))->exists()) {
            return response()->json([
                'status' => 'fail',
                'error'  => 'This email already exists'
            ], 422);
        }

        $user = User::create([
            'email'      => $request->input('email'),
            'password'   => Hash::make($request->input('password')),
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'is_admin'   => $request->input('is_admin'),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'email'      => $user->email,
                'first_name' => $user->first_name,
                'last_name'  => $user->last_name
            ]
        ], 201);
    }
}
