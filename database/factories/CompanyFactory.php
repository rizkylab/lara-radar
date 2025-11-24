<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->catchPhrase(),
            'website' => 'https://' . $this->faker->domainName(),
            'industry' => $this->faker->word(),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
