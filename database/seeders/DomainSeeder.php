<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Company;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company) {
            $user = $company->users()->inRandomOrder()->first();
            $userId = $user ? $user->id : null;
            Domain::factory()->count(8)->create([
                'company_id' => $company->id,
                'user_id' => $userId,
            ]);
        });
    }
}
