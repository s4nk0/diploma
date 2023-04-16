<?php

namespace Database\Seeders;

use App\Models\ApartmentBathroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentBathroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'душевая кабина'],
            ['title'=>'ванна'],
        ];

        ApartmentBathroom::insert($data);
    }
}
