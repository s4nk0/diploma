<?php

namespace Database\Seeders;

use App\Models\ApartmentBathroomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentBathroomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'разделен'],
            ['title'=>'совмещен'],
        ];

        ApartmentBathroomType::insert($data);
    }
}
