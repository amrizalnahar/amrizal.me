<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'company_name' => 'PT Teknologi Nusantara',
                'position' => 'Lead System Analyst',
                'description_id' => 'Memimpin tim analis sistem dalam proyek transformasi digital untuk klien BUMN. Bertanggung jawab atas analisis kebutuhan bisnis, perancangan arsitektur sistem, dan koordinasi dengan stakeholder teknis dan non-teknis. Berhasil mengurangi waktu proses bisnis hingga 40% melalui otomatisasi workflow.',
                'description_en' => 'Leading a team of system analysts in digital transformation projects for state-owned enterprise clients. Responsible for business requirements analysis, system architecture design, and coordination with technical and non-technical stakeholders. Successfully reduced business process time by up to 40% through workflow automation.',
                'started_at' => '2021-03-01',
                'ended_at' => null,
                'is_current' => true,
                'sort_order' => 1,
            ],
            [
                'company_name' => 'Solusi Digital Prima',
                'position' => 'Senior System Analyst',
                'description_id' => 'Menganalisis dan merancang sistem enterprise untuk sektor perbankan dan keuangan. Mengembangkan framework analisis yang kemudian diadopsi secara perusahaan. Berkolaborasi erat dengan tim pengembangan dalam implementasi microservices architecture.',
                'description_en' => 'Analyzed and designed enterprise systems for the banking and finance sector. Developed an analysis framework that was later adopted company-wide. Collaborated closely with the development team in implementing microservices architecture.',
                'started_at' => '2018-06-01',
                'ended_at' => '2021-02-28',
                'is_current' => false,
                'sort_order' => 2,
            ],
            [
                'company_name' => 'Kreatif Inovasi Teknologi',
                'position' => 'System Analyst',
                'description_id' => 'Melakukan analisis kebutuhan dan perancangan sistem untuk berbagai proyek aplikasi web dan mobile. Membangun dokumentasi teknis dan user manual. Terlibat dalam seluruh siklus pengembangan perangkat lunak dari requirements gathering hingga deployment.',
                'description_en' => 'Conducted requirements analysis and system design for various web and mobile application projects. Built technical documentation and user manuals. Involved in the entire software development lifecycle from requirements gathering to deployment.',
                'started_at' => '2016-08-01',
                'ended_at' => '2018-05-31',
                'is_current' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($experiences as $data) {
            Experience::create($data);
        }
    }
}
