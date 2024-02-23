<?php

namespace Database\Factories;

use App\Models\LotteryGame;
use Illuminate\Database\Eloquent\Factories\Factory;

class LotteryGameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LotteryGame::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->word,
            'gamer_count'   => $this->faker->randomDigitNotNull(),
            'reward_points' => $this->faker->randomDigitNotNull()
        ];
    }
}
