<?php
namespace Database\Factories;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<University> */
class UniversityFactory extends Factory
{
    protected $model = University::class;
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' University',
            'website' => fake()->url(),
            'city_id' => \App\Models\City::factory(),
        ];
    }
}
