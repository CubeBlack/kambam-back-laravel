<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Card;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{

    public function definition()
    {
        return [
            'project' => fake()->name(),
            'group'=>fake()->name(),
            'title' =>  fake()->name(),
            'status' => fake()->name(),
            'description' =>  fake()->name()

        ];
    }
}
