<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\TechStack;
use Illuminate\Database\Seeder;

class TechStackSeeder extends Seeder
{
    public function run(): void
    {
        Domain::all()->each(function ($domain) {
            TechStack::factory()->count(3)->create(['domain_id' => $domain->id]);
        });
    }
}
