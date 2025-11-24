<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BotnetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'botnet_name' => $this->faker->word() . ' Botnet',
            'last_seen_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'status' => 'active',
            'country' => $this->faker->countryCode(),
            'asn' => 'AS' . $this->faker->numberBetween(1000, 65000),
        ];
    }
}
