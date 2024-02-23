<?php

namespace App\Http\Controllers;

use App\Models\LotteryGameMatch;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request, int $id): JsonResponse
    {
        $this->validate($request, [
            'email'      => 'required|string',
            'password'   => 'required|string',
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'is_admin'   => 'required|boolean'
        ]);

        User::findorFail($id)->update([
            'email'      => $request->input('email'),
            'password'   => Hash::make($request->input('password')),
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'is_admin'   => $request->input('is_admin'),
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        User::findorFail($id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function show(Request $request): JsonResponse
    {
        $users_win_matches = User::with('winMatches')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $users_win_matches
        ]);
    }
}
