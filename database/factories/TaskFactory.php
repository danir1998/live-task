<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


class TaskFactory extends Factory
{
     /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle(),
            'body' => $this->faker->text(30),
            'category_id' => Number::numberBetween(1,7)
        ];
    }
}
