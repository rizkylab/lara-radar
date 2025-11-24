<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlertFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => null,
            'title' => $this->faker->sentence(4),
            'message' => $this->faker->paragraph(),
            'severity' => $this->faker->randomElement(['info','warning','critical']),
            'status' => 'unread',
            'read_at' => null,
        ];
    }
}
