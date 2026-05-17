<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'tup-logo.png' => database_path('seeders/images/educations/tup-logo.png'),
            'sman-1-pml-logo.png' => database_path('seeders/images/educations/sman-1-pml-logo.png'),
        ];

        foreach ($images as $filename => $sourcePath) {
            if (file_exists($sourcePath)) {
                Storage::disk('public')->put('educations/' . $filename, file_get_contents($sourcePath));
            }
        }

        $educations = [
            [
                'institution_name' => 'Universitas Telkom Purwokerto (IT Telkom Purwokerto)',
                'logo' => 'educations/tup-logo.png',
                'degree' => 'S1',
                'major_id' => 'Sistem Informasi',
                'major_en' => 'Information Systems',
                'started_at' => 2018,
                'ended_at' => 2022,
                'sort_order' => 1,
            ],
            [
                'institution_name' => 'SMA Negeri 1 Pemalang',
                'logo' => 'educations/sman-1-pml-logo.png',
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
