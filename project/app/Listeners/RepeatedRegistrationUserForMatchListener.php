<?php

namespace App\Listeners;

use App\Events\RegisterUserForMatchEvent;
use App\Models\LotteryGameMatchUser;

class RepeatedRegistrationUserForMatchListener
{
    /**
     * @throws \Exception
     */
    public function handle(RegisterUserForMatchEvent $event)
    {
        if (LotteryGameMatchUser::where('user_id', $event->user_id)
            ->where('lottery_game_match_id', $event->match_id)->exists()) {

            throw new \Exception('This user already registered this match');
        }
    }
}
