<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PiiExposureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => null,
            'data_type' => $this->faker->randomElement(['email','phone','ssn']),
            'exposed_data' => $this->faker->safeEmail(),
            'source' => $this->faker->domainName(),
            'leaked_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
