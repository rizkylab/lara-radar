<?php

namespace Database\Seeders;

use App\Models\Subdomain;
use App\Models\Port;
use Illuminate\Database\Seeder;

class PortSeeder extends Seeder
{
    public function run(): void
    {
        Subdomain::all()->each(function ($sub) {
            Port::factory()->count(4)->create([
                'subdomain_id' => $sub->id,
                'domain_id' => $sub->domain_id,
            ]);
        });
    }
}
