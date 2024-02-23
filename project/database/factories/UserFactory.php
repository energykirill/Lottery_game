<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'email'      => $this->faker->unique()->safeEmail,
            'password'   => '$2y$12$eRhhhJDqfxl2wqSnpXsaTuIum4vAlx7aEzUq5X8LyDilX/zVkvZcW',
            'last_name'  => $this->faker->lastName
        ];
    }
}
