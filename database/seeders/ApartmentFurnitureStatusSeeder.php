<?php

namespace Database\Seeders;

use App\Models\ApartmentFurnitureStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentFurnitureStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'полностью'],
            ['title'=>'частично'],
            ['title'=>'без мебели'],
        ];

        ApartmentFurnitureStatus::insert($data);
    }
}
