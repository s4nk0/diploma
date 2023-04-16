<?php

namespace Database\Seeders;

use App\Models\ApartmentFurniture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentFurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'кровать'],
            ['title'=>'шкаф для одежды'],
            ['title'=>'рабочий стол'],
            ['title'=>'обеденный стол'],
            ['title'=>'кухонный гарнитур'],
            ['title'=>'диван'],
        ];

        ApartmentFurniture::insert($data);
    }
}
