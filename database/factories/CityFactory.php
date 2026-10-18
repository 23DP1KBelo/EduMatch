<?php
namespace Database\Factories;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<City> */
class CityFactory extends Factory
{
    protected $model = City::class;
    public function definition(): array
    {
        return [
            'name' => fake()->city(),
            'average_living_cost' => fake()->randomFloat(2, 450, 1600),
            'country_id' => \App\Models\Country::factory(),
        ];
    }
}
