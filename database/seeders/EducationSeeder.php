<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $educations = [
            [
                'institution_name' => 'Universitas Indonesia',
                'degree' => 'S2',
                'major_id' => 'Teknik Informatika',
                'major_en' => 'Computer Science',
                'started_at' => 2014,
                'ended_at' => 2016,
                'sort_order' => 1,
            ],
            [
                'institution_name' => 'Institut Teknologi Bandung',
                'degree' => 'S1',
                'major_id' => 'Teknik Informatika',
                'major_en' => 'Computer Science',
                'started_at' => 2010,
                'ended_at' => 2014,
                'sort_order' => 2,
            ],
        ];

        foreach ($educations as $data) {
            Education::create($data);
        }
    }
}
