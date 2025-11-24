<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TechStackFactory extends Factory
{
    public function definition(): array
    {
        return [
            'domain_id' => null,
            'name' => $this->faker->word(),
            'version' => $this->faker->randomElement(['1.0','2.0','3.0']),
        ];
    }
}
