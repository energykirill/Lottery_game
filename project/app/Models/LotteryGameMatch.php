<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LotteryGameMatch extends Model
{
    protected $table = 'lottery_game_matches';
    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'start_date',
        'start_time',
        'winner_id',
        'is_finished'
    ];

    public function gamers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(LotteryGameMatchUser::class);
    }
}
