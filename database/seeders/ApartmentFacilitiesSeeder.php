<?php

namespace Database\Seeders;

use App\Models\ApartmentFacilities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'интернет'],
            ['title'=>'стиральная машина'],
            ['title'=>'микроволновая печь'],
            ['title'=>'кондиционер'],
            ['title'=>'посуда'],
            ['title'=>'кладовая'],
            ['title'=>'телевизор'],
            ['title'=>'холодильник'],
            ['title'=>'посудомоечная машина'],
            ['title'=>'пылесос'],
            ['title'=>'сушилка'],
            ['title'=>'лифт'],
        ];

        ApartmentFacilities::insert($data);
    }
}
