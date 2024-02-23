<?php

namespace App\Http\Controllers;

use App\Events\FinishMatchEvent;
use App\Models\LotteryGameMatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LotteryGameMatchController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'game_id'    => 'required|integer',
            'start_date' => 'required|date|after:yesterday',
            'start_time' => 'required|time',
        ]);

        $created_match = LotteryGameMatch::create([
            'game_id'    => $request->input('game_id'),
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time')
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => $created_match
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $this->validate($request, [
            'is_finished' => 'required|boolean'
        ]);

        LotteryGameMatch::findOrFail($id)->update([
            'is_finished' => $request->input('is_finished')
        ]);

        event(new FinishMatchEvent($id));

        return response()->json([
            'status'  => 'success',
            'message' => 'Match is finished'
        ]);
    }

    public function show(Request $request): JsonResponse
    {
        $this->validate($request, [
            'lottery_game_id' => 'required|integer'
        ]);

        $game_matches = LotteryGameMatch::where('game_id', $request->query('lottery_game_id'))
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $game_matches
        ]);
    }
}
