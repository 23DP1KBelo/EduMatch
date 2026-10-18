<?php
namespace Database\Factories;
use App\Models\Scholarship;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<Scholarship> */
class ScholarshipFactory extends Factory
{
    protected $model = Scholarship::class;
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Excellence Grant', 'International Student Grant', 'STEM Scholarship', 'Merit Award']),
            'description' => fake()->sentence(),
            'amount' => fake()->randomElement([500, 1000, 2500, 5000]),
            'currency' => 'EUR',
            'deadline' => fake()->dateTimeBetween('+1 month', '+12 months')->format('Y-m-d'),
            'requirements' => fake()->sentence(),
        ];
    }
}
