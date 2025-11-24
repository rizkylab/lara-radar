<?php

namespace Database\Seeders;

use App\Models\Alert;
use Illuminate\Database\Seeder;
use App\Models\Company;

class AlertSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company) {
            Alert::factory()->count(8)->create(['company_id' => $company->id]);
        });
    }
}
