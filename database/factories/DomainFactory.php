<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DomainFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => null,
            'user_id' => null,
            'domain' => $this->faker->domainName(),
            'status' => 'completed',
            'subdomain_count' => 0,
            'vulnerability_count' => 0,
            'port_count' => 0,
            'last_scanned_at' => null,
            'scan_config' => null,
        ];
    }
}
