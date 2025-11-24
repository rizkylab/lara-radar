<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Subdomain;
use Illuminate\Database\Seeder;

class SubdomainSeeder extends Seeder
{
    public function run(): void
    {
        Domain::all()->each(function ($domain) {
            Subdomain::factory()->count(6)->create(['domain_id' => $domain->id]);
        });
    }
}
