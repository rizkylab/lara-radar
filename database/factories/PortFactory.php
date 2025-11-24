<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PortFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subdomain_id' => null,
            'port' => $this->faker->numberBetween(20, 9000),
            'service' => 'tcp',
            'banner' => null,
        ];
    }
}
