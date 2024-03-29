<?php

namespace Database\Seeders;

use App\Models\LotteryGame;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create();

        LotteryGame::factory()->count(5)->create();
    }
}
