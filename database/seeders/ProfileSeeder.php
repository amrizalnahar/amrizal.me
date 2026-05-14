<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'summary_id' => 'System Analyst berpengalaman 3+ tahun dalam perancangan sistem, pengembangan perangkat lunak, dan penyusunan dokumentasi teknis (PRD, FSD). Berspesialisasi pada pengembangan sistem informasi berbasis Laravel dan pengembangan Headless Architecture menggunakan Next.js — mencakup analisis kebutuhan, desain arsitektur, hingga integrasi REST API.Terbiasa bekerja dalam metodologi Agile/Scrum dengan kemampuan menjembatani komunikasi antara tim teknis dan stakeholder bisnis. Memiliki rekam jejak pada proyek sistem informasi skala menengah di industri perangkat lunak.',
            'summary_en' => 'System Analyst with 3+ years of experience in system design, software development, and technical documentation (PRD, FSD). Specialized in developing Laravel-based information systems and Headless Architecture using Next.js—spanning requirements analysis, architectural design, and REST API integration. Adept at working within Agile/Scrum methodologies with a proven ability to bridge the communication gap between technical teams and business stakeholders. Strong track record of delivering mid-scale information system projects within the software industry.',
            'photo' => null,
            'cv_id' => null,
            'cv_en' => null,
        ]);
    }
}
