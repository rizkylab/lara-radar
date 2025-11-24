<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CVEFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cve_id' => 'CVE-' . $this->faker->numberBetween(2010,2025) . '-' . $this->faker->numberBetween(1000,9999),
            'description' => $this->faker->paragraph(),
            'cvss_score' => $this->faker->randomFloat(1, 0, 10),
            'published_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'last_modified_at' => null,
            'references' => null,
        ];
    }
}
