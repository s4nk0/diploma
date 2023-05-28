<?php

namespace Database\Factories;

use App\Models\AdGenderType;
use App\Models\AdGet;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdGet>
 */
class AdGetFactory extends Factory
{

    protected $model = AdGet::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        $cities = City::all()->pluck('id')->toArray();
        $ad_gender_types = AdGenderType::all()->pluck('id')->toArray();
        $price = $this->faker->numberBetween(20000, 100000);
        $price_from = $this->faker->numberBetween(20000, $price);
        $lang = 43.23533174349779;
        $long = 76.94582796289055;
        return [
            'status_moderation_id'=>1,
            'user_id'=>$this->faker->randomElement($users),
            'city_id'=>$this->faker->randomElement($cities),
            'ad_gender_type_id'=>$this->faker->optional()->randomElement($ad_gender_types),
            'rooms_count'=>$this->faker->numberBetween(1, 5),
            'roommate_count'=>$this->faker->numberBetween(0, 6),
            'price_from'=>$price_from,
            'price'=>$price,
            'coordinates'=>$this->faker->latitude($min = ($lang - (rand(0,20) / 200)), $max = ($lang + (rand(0,20) / 200))).','.$this->faker->longitude($min = ($long - (rand(0,20) / 200)), $max = ($long + (rand(0,20) / 200))),
            'location'=> $this->faker->address(),
            'animals'=>$this->faker->randomElement([0, 1, null]),
            'contact_name'=> $this->faker->name(),
            'contact_email'=> $this->faker->email(),
            'phone_number'=> $this->faker->numerify('+7##########'),
            'views'=> $this->faker->numberBetween(0, 1000),
            'description'=>$this->faker->paragraphs(rand(3, 6), true),
        ];
    }
}
