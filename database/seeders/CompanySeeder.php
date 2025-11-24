<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::factory()->count(3)->create()->each(function ($company) {
            // create an admin user per company
            $company->users()->create(["name" => $company->name . ' Admin', "email" => 'admin+' . $company->id . '@example.test', "password" => bcrypt('password')]);
        });
    }
}
