<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'is_admin',
        'points'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'token'
    ];

    public function winMatches(): HasMany
    {
        return $this->hasMany(LotteryGameMatch::class, 'winner_id', 'id');
    }

    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(LotteryGameMatch::class)->using(LotteryGameMatchUser::class);
    }
}
