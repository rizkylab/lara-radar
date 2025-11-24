<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubdomainFactory extends Factory
{
    public function definition(): array
    {
        return [
            'domain_id' => null,
            'subdomain' => 'www.' . $this->faker->domainName(),
            'ip_address' => $this->faker->ipv4(),
            'status_code' => null,
            'title' => null,
            'server' => null,
            'content_length' => null,
            'screenshot_path' => null,
            'is_monitored' => true,
            'last_scanned_at' => null,
        ];
    }
}
