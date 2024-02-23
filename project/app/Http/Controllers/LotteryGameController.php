<?php

namespace App\Http\Controllers;

use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LotteryGameController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $lottery_games_with_matches = LotteryGame::with('gameMatches')
                ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $lottery_games_with_matches
        ]);
    }
}
