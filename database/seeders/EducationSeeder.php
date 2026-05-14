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
                'institution_name' => 'Universitas Telkom Purwokerto',
                'degree' => 'S1',
                'major_id' => 'Sistem Informasi',
                'major_en' => 'Information Systems',
                'started_at' => 2018,
                'ended_at' => 2022,
                'sort_order' => 1,
            ],
            [
                'institution_name' => 'SMA Negeri 1 Pemalang',
                'degree' => 'SMA',
                'major_id' => 'IPA',
                'major_en' => 'Science',
                'started_at' => 2014,
                'ended_at' => 2017,
                'sort_order' => 2,
            ],
        ];

        foreach ($educations as $data) {
            Education::create($data);
        }
    }
}
