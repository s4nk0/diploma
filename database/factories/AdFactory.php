<?php

namespace Database\Factories;

use App\Models\AdGenderType;
use App\Models\ApartmentCondition;
use App\Models\ApartmentFurnitureStatus;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        $cities = City::all()->pluck('id')->toArray();
        $apartmentConditions = ApartmentCondition::all()->pluck('id')->toArray();
        $apartment_furniture_statuses = ApartmentFurnitureStatus::all()->pluck('id')->toArray();
        $ad_gender_types = AdGenderType::all()->pluck('id')->toArray();
        $floor = $this->faker->numberBetween(1, 20);
        $floor_from = $this->faker->numberBetween(1, 20);
        $lang = 43.23533174349779;
        $long = 76.94582796289055;


        if ($floor > $floor_from) {
            $temp = $floor;
            $floor = $floor_from;
            $floor_from = $temp;
        }

        return [
            'user_id'=>$this->faker->randomElement($users),
            'city_id'=>$this->faker->randomElement($cities),
            'apartment_condition_id'=>$this->faker->optional()->randomElement($apartmentConditions),
            'apartment_furniture_status_id'=>$this->faker->optional()->randomElement($apartment_furniture_statuses),
            'ad_gender_type_id'=>$this->faker->optional()->randomElement($ad_gender_types),
            'description'=>$this->faker->paragraphs(rand(3, 6), true),
            'price'=>$this->getPrice($this->faker->numberBetween(30000, 100000)),
            'price_com'=>$this->getPrice($this->faker->optional()->numberBetween(5000, 30000)),
            'price_pledge'=>$this->getPrice($this->faker->optional()->numberBetween(0, 100)),
            'roommate_count'=>$this->faker->numberBetween(0, 6),
            'rooms_count'=>$this->faker->numberBetween(1, 5),
            'bathrooms_count'=>$this->faker->numberBetween(0, 3),
            'balconies_count'=>$this->faker->numberBetween(0, 3),
            'loggias_count'=>$this->faker->numberBetween(0, 3),
            'floor_from'=>$floor_from,
            'floor'=>$floor,
            'square_general'=>$this->faker->numberBetween(30, 150),
            'square_living'=>$this->faker->optional()->numberBetween(10, 40),
            'square_kitchen'=>$this->faker->optional()->numberBetween(3, 30),
            'kitchen_studio'=>$this->faker->numberBetween(0, 1),
            'coordinates'=>$this->faker->latitude($min = ($lang - (rand(0,20) / 200)), $max = ($lang + (rand(0,20) / 200))).','.$this->faker->longitude($min = ($long - (rand(0,20) / 200)), $max = ($long + (rand(0,20) / 200))),
            'contact_name'=> $this->faker->name(),
            'contact_email'=> $this->faker->email(),
            'phone_number'=> $this->faker->numerify('+7##########'),
            'location'=> $this->faker->address(),
            'views'=> $this->faker->numberBetween(0, 1000),
        ];
    }

    protected function getPrice($price){
        if ($price===null){
            return null;
        }
        $price = floor($price / 5) * 5; // round down to nearest 5
        if ($price % 10 !== 0) {
            $price += 5; // add 5 to make it end in 5
        }

        return $price;
    }
}
