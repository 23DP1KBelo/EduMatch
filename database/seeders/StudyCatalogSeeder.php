<?php
namespace Database\Seeders;
use App\Models\{Country, City, University, StudyField, StudyProgram, Scholarship};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyCatalogSeeder extends Seeder
{
    public function run(): void
    {
        // Piemēru dati demonstrācijai; tās NAV pārbaudītas reālas programmas vai cenas.
        $locations = [
            ['Latvia', 'LV', 'EUR', [['Riga', 850], ['Liepaja', 650], ['Daugavpils', 570]]],
            ['Estonia', 'EE', 'EUR', [['Tallinn', 1050], ['Tartu', 780]]],
            ['Lithuania', 'LT', 'EUR', [['Vilnius', 900], ['Kaunas', 710]]],
            ['Germany', 'DE', 'EUR', [['Berlin', 1250], ['Munich', 1650]]],
            ['Netherlands', 'NL', 'EUR', [['Amsterdam', 1750], ['Rotterdam', 1300]]],
            ['Finland', 'FI', 'EUR', [['Helsinki', 1450], ['Tampere', 980]]],
        ];
        $cities = collect();
        foreach ($locations as [$countryName, $code, $currency, $towns]) {
            $country = Country::firstOrCreate(['country_code' => $code], ['name' => $countryName, 'currency' => $currency]);
            foreach ($towns as [$name, $cost]) {
                $cities->push(City::firstOrCreate(['country_id' => $country->id, 'name' => $name], ['average_living_cost' => $cost]));
            }
        }
        $fields = [
            'Computer Science', 'Business', 'Engineering', 'Medicine', 'Psychology',
            'Design', 'Economics', 'Law', 'Environmental Science', 'Education',
        ];
        $fieldIds = collect($fields)->map(fn ($name) => StudyField::firstOrCreate(
            ['name' => $name], ['description' => 'Study field: ' . $name]
        )->id);
        $programNames = [
            'Computer Science' => ['Software Engineering', 'Computer Science', 'Cybersecurity', 'Data Science'],
            'Business' => ['Business Administration', 'Marketing', 'International Business'],
            'Engineering' => ['Mechanical Engineering', 'Electrical Engineering', 'Civil Engineering'],
            'Medicine' => ['Medicine', 'Public Health'],
            'Psychology' => ['Psychology', 'Cognitive Science'],
            'Design' => ['Graphic Design', 'Interaction Design'],
            'Economics' => ['Economics', 'Finance'],
            'Law' => ['Law', 'International Law'],
            'Environmental Science' => ['Sustainability', 'Environmental Science'],
            'Education' => ['Pedagogy', 'Educational Technology'],
        ];
        $universities = collect();
        foreach ($cities as $city) {
            for ($i = 1; $i <= 2; $i++) {
                $universities->push(University::firstOrCreate(
                    ['city_id' => $city->id, 'name' => $city->name . ' Demo University ' . $i],
                    ['website' => null]
                ));
            }
        }
        $scholarships = collect(['Academic Merit', 'STEM Grant', 'International Students'])->map(
            fn ($name) => Scholarship::firstOrCreate(['name' => $name], [
                'description' => 'Demo scholarship', 'amount' => 2000,
                'currency' => 'EUR', 'deadline' => now()->addMonths(8)->toDateString(),
                'requirements' => 'See official admission rules',
            ])
        );
        foreach ($universities as $university) {
            for ($i = 0; $i < 12; $i++) {
                $fieldIndex = ($university->id + $i) % count($fields);
                $fieldName = $fields[$fieldIndex];
                $names = $programNames[$fieldName];
                $program = StudyProgram::firstOrCreate(
                    ['university_id' => $university->id, 'name' => $names[$i % count($names)], 'degree_level' => ['Bachelor', 'Master', 'PhD'][$i % 3]],
                    [
                        'language' => ['English', 'English', 'Latvian', 'German'][$i % 4],
                        'duration' => ['3 years', '2 years', '4 years'][$i % 3],
                        'admission_requirements' => 'Demo: transcript and language certificate',
                        'application_deadline' => now()->addMonths(3 + $i)->toDateString(),
                        'tuition_fees' => [0, 1500, 3000, 5500, 9000, 12000][$i % 6],
                    ]
                );
                DB::table('program_fields')->updateOrInsert(
                    ['program_id' => $program->id, 'study_field_id' => $fieldIds[$fieldIndex]], []
                );
                if ($i % 3 === 0) {
                    DB::table('program_scholarships')->updateOrInsert(
                        ['program_id' => $program->id, 'scholarship_id' => $scholarships[$i % $scholarships->count()]->id], []
                    );
                }
            }
        }
    }
}
