<?php

namespace Database\Seeders;

use App\Models\ApartmentSecurity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSecuritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title'=>'решетки на окнах'],
            ['title'=>'домофон'],
            ['title'=>'сигнализация'],
            ['title'=>'видеодомофон'],
            ['title'=>'охрана'],
            ['title'=>'кодовый замок'],
            ['title'=>'видеонаблюдение'],
            ['title'=>'консьерж'],
        ];

        ApartmentSecurity::insert($data);
    }
}
