<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LotteryGameMatchUser extends Pivot
{
    public $incrementing =true;
    protected $table = 'lottery_game_match_users';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'lottery_game_match_id'
    ];
}
