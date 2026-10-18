<?php
namespace Database\Factories;
use App\Models\StudyField;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<StudyField> */
class StudyFieldFactory extends Factory
{
    protected $model = StudyField::class;
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'description' => fake()->sentence(),
        ];
    }
}
