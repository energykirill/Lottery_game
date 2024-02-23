<?php

namespace App\Listeners;

use App\Events\FinishMatchEvent;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\LotteryGameMatchUser;
use App\Models\User;

class DeterminingWinnerMatchListener
{
    public function handle(FinishMatchEvent $event)
    {
        $winner_match = LotteryGameMatchUser::where('lottery_game_match_id', $event->match_id)
            ->inRandomOrder()
            ->first();

        $lottery_game_match = LotteryGameMatch::find($event->match_id);

        $lottery_game = LotteryGame::find($lottery_game_match->game_id);

        User::find($winner_match->user_id)->update([
            'points' => $lottery_game->reward_points
        ]);

        $lottery_game_match->winner_id = $winner_match->user_id;

        $lottery_game_match->save();
    }
}
