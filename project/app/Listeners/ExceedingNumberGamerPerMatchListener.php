<?php

namespace App\Listeners;

use App\Events\RegisterUserForMatchEvent;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\LotteryGameMatchUser;

class ExceedingNumberGamerPerMatchListener
{
    /**
     * @throws \Exception
     */
    public function handle(RegisterUserForMatchEvent $event)
    {
        $registered_gamer_count = LotteryGameMatchUser::where('lottery_game_match_id', $event->match_id)
            ->count();

        $lottery_match = LotteryGameMatch::find($event->match_id);

        $lottery_game = LotteryGame::find($lottery_match->game_id);

        if ($registered_gamer_count == $lottery_game->gamer_count) {
            throw new \Exception('Excess allowed number of participants per match');
        }
    }
}
