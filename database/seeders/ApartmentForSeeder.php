<?php

namespace Database\Seeders;

use App\Models\ApartmentFor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'некурящим'],
            ['title'=>'можно с животными'],
            ['title'=>'девушкам'],
        ];

        ApartmentFor::insert($data);
    }
}
