<?php

namespace Database\Seeders;

use App\Models\AdGenderType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdGenderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'Только парни'],
            ['title'=>'Только девушки'],
            ['title'=>'Могут быть парни и девушки'],
        ];

        AdGenderType::insert($data);
    }
}
