<?php

namespace Database\Seeders;

use App\Models\CVE;
use Illuminate\Database\Seeder;

class CVESeeder extends Seeder
{
    public function run(): void
    {
        CVE::factory()->count(30)->create();
    }
}
