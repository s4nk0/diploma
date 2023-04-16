<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $almaty_regions_id = 1;

        $data = [
            ['city_id'=>$almaty_regions_id, 'title'=>'Алатауский р-н'],
            ['city_id'=>$almaty_regions_id, 'title'=>'Алмалинский р-н'],
            ['city_id'=>$almaty_regions_id, 'title'=>'Бостандыкский р-н'],
            ['city_id'=>$almaty_regions_id, 'title'=>'Жетысуский р-н'],
            ['city_id'=>$almaty_regions_id, 'title'=>'Медеуский р-н'],
            ['city_id'=>$almaty_regions_id, 'title'=>'Наурызбайский р-н'],
            ['city_id'=>$almaty_regions_id, 'title'=>'Турксибский р-н'],
        ];

        Region::insert($data);
    }
}
