<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'tonjoo-logo.png' => database_path('seeders/images/experiences/tonjoo-logo.png'),
        ];

        foreach ($images as $filename => $sourcePath) {
            if (file_exists($sourcePath)) {
                Storage::disk('public')->put('experiences/' . $filename, file_get_contents($sourcePath));
            }
        }
        $experiences = [
            [
                'company_name' => 'Tonjoo Gagas Teknologi',
                'logo' => 'experiences/tonjoo-logo.png',
                'position' => 'System Analyst',
                'description_id' => 'Bertanggung jawab dalam menjembatani kebutuhan bisnis dan implementasi teknis untuk pengembangan sistem informasi, aplikasi web, dan mobile. Memiliki keahlian dalam menyusun arsitektur data, dokumentasi teknis, serta memastikan siklus pengembangan berjalan tepat waktu melalui koordinasi intensif antara stakeholder dan tim developer.',
                'description_en' => 'Responsible for bridging business requirements and technical implementation for information systems, web, and mobile applications. Expert in designing data architecture and technical documentation, while ensuring the development lifecycle remains on schedule through intensive coordination between stakeholders and development teams.',
                'started_at' => '2023-05-05',
                'ended_at' => null,
                'is_current' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($experiences as $data) {
            Experience::create($data);
        }
    }
}
