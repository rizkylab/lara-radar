<?php

namespace Database\Seeders;

use App\Models\DarkwebCredential;
use Illuminate\Database\Seeder;
use App\Models\Company;

class DarkWebSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company) {
            DarkwebCredential::factory()->count(6)->create(['company_id' => $company->id]);
        });
    }
}
