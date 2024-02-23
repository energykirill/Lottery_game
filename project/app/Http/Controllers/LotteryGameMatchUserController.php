<?php

namespace App\Http\Controllers;

use App\Events\RegisterUserForMatchEvent;
use App\Models\LotteryGameMatchUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LotteryGameMatchUserController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'match_id' => 'required|integer',
            'user_id'  => 'required|integer'
        ]);

        event(new RegisterUserForMatchEvent($request->input('user_id'),
            $request->input('match_id')));

        LotteryGameMatchUser::create([
            'user_id'               => $request->input('user_id'),
            'lottery_game_match_id' => $request->input('match_id')
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'This user is registered for the match'
        ], 201);
    }
}
