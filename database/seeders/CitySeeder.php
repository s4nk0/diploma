<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'Алматы','country_id'=>1],
            ['title'=>'Астана','country_id'=>1],
            ['title'=>'Шымкент','country_id'=>1],
            ['title'=>'Абайская обл.','country_id'=>1],
            ['title'=>'Акмолинская обл.','country_id'=>1],
            ['title'=>'Актюбинская обл.','country_id'=>1],
            ['title'=>'Алматинская обл.','country_id'=>1],
            ['title'=>'Атырауская обл.','country_id'=>1],
            ['title'=>'Восточно-Казахстанская обл.','country_id'=>1],
            ['title'=>'Жамбылская обл.','country_id'=>1],
            ['title'=>'Жетысуская обл.','country_id'=>1],
            ['title'=>'Западно-Казахстанская обл.','country_id'=>1],
            ['title'=>'Карагандинская обл.','country_id'=>1],
            ['title'=>'Костанайская обл.','country_id'=>1],
            ['title'=>'Кызылординская обл.','country_id'=>1],
            ['title'=>'Мангистауская обл.','country_id'=>1],
            ['title'=>'Павлодарская обл.','country_id'=>1],
            ['title'=>'Северо-Казахстанская обл.','country_id'=>1],
            ['title'=>'Туркестанская обл.','country_id'=>1],
            ['title'=>'Улытауская обл.','country_id'=>1],
        ];

        City::insert($data);
    }
}
