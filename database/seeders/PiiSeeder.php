<?php

namespace Database\Seeders;

use App\Models\PiiExposure;
use Illuminate\Database\Seeder;
use App\Models\Company;

class PiiSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company) {
            PiiExposure::factory()->count(6)->create(['company_id' => $company->id]);
        });
    }
}
