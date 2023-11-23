<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'datePublic' => $this->faker->date(),
            'title' => $this->faker->word(),
            'shortDesc' => $this->faker->sentence(),
            'desc' => $this->faker->text(),
            'user_id' => $this->faker->numberBetween(3, 13),
        ];
    }
}