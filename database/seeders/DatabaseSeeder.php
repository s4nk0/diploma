<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ad;
use App\Models\AdGenderType;
use App\Models\AdGet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            GenderSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ApartmentConditionSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            ApartmentFurnitureStatusSeeder::class,
            ApartmentFurnitureSeeder::class,
            ApartmentBathroomSeeder::class,
            ApartmentBathroomTypeSeeder::class,
            ApartmentFacilitiesSeeder::class,
            ApartmentForSeeder::class,
            ApartmentSecuritySeeder::class,
            WindowDirectionSeeder::class,
            AdGenderTypeSeeder::class,
            StatusModerationSeeder::class,
            AdSeeder::class,
            AdGetSeeder::class,
        ]);
    }
}
