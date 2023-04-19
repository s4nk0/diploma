<?php

namespace Database\Seeders;

use App\Models\AdGet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdGetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdGet::factory()->count(500)->create();
    }
}
