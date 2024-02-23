<?php

namespace App\Events;

class FinishMatchEvent extends Event
{
    public int $match_id;

    public function __construct(int $match_id)
    {
        $this->match_id = $match_id;
    }
}
