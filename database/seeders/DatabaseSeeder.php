<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Core seeders
        $this->call([
            \Database\Seeders\CompanySeeder::class,
            \Database\Seeders\DomainSeeder::class,
            \Database\Seeders\SubdomainSeeder::class,
            \Database\Seeders\PortSeeder::class,
            \Database\Seeders\TechStackSeeder::class,
            \Database\Seeders\VulnerabilitySeeder::class,
            \Database\Seeders\CVESeeder::class,
            \Database\Seeders\DarkWebSeeder::class,
            \Database\Seeders\BotnetSeeder::class,
            \Database\Seeders\PiiSeeder::class,
            \Database\Seeders\AlertSeeder::class,
        ]);
    }
}
