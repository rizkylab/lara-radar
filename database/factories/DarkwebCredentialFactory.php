<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DarkwebCredentialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => null,
            'email' => $this->faker->safeEmail(),
            'password_hash' => null,
            'source' => $this->faker->word(),
            'leaked_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
