<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'phone_number'=>'+77072196303',
            'gender_id'=>'1',
            'password'=>Hash::make('password'),
        ]);

        $admin->roles()->attach(1);

        User::factory()->hasAttached(Role::find(2))->count(100)->create();
    }
}
