<?php

namespace Database\Seeders;

use App\Models\ApartmentCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'свежий ремонт, новая мебель'],
            ['title'=>'не новый, но аккуратный и чистый ремонт'],
            ['title'=>'без ремонта'],
        ];

        ApartmentCondition::insert($data);
    }
}
