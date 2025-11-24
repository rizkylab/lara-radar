<?php

namespace Database\Seeders;

use App\Models\Botnet;
use Illuminate\Database\Seeder;

class BotnetSeeder extends Seeder
{
    public function run(): void
    {
        Botnet::factory()->count(10)->create();
    }
}
