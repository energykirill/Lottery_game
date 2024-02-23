<?php

namespace App\Events;

use App\Models\LotteryGameMatchUser;

class RegisterUserForMatchEvent extends Event
{
    public int $user_id;

    public int $match_id;

    public function __construct(int $user_id, int $match_id)
    {
        $this->user_id = $user_id;

        $this->match_id = $match_id;
    }
}
