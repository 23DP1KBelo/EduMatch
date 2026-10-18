<?php
namespace Database\Factories;
use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\Factory;
/** @extends Factory<StudyProgram> */
class StudyProgramFactory extends Factory
{
    protected $model = StudyProgram::class;
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Computer Science', 'Business Management', 'Psychology', 'Data Science', 'Medicine', 'Design', 'Engineering', 'Economics', 'Law', 'Biotechnology']),
            'language' => fake()->randomElement(['English', 'Latvian', 'German', 'French']),
            'duration' => fake()->randomElement(['2 years', '3 years', '4 years']),
            'degree_level' => fake()->randomElement(['Bachelor', 'Master', 'PhD']),
            'admission_requirements' => fake()->sentence(),
            'application_deadline' => fake()->dateTimeBetween('+1 month', '+14 months')->format('Y-m-d'),
            'tuition_fees' => fake()->randomElement([0, 1500, 3000, 5000, 8000, 12000]),
            'university_id' => \App\Models\University::factory(),
        ];
    }
}
