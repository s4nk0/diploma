<?php

namespace Database\Seeders;

use App\Models\WindowDirection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WindowDirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'во двор'],
            ['title'=>'на улицу'],
        ];

        WindowDirection::insert($data);
    }
}
