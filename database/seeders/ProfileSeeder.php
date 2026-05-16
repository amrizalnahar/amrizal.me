<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'summary_id' => 'System Analyst dengan 3 tahun pengalaman mengelola pengembangan sistem enterprise berskala besar — dari proyek baru hingga sistem legacy yang diwarisi. Mengubah kebutuhan bisnis kompleks menjadi spesifikasi teknis yang dapat dieksekusi melalui functional prototyping dan living documentation (User Story, PRD, FSD). Spesialisasi dalam perancangan dan validasi REST API (Postman/Bruno), integrasi sistem, serta dokumentasi dengan Acceptance Criteria format. Terbiasa berkolaborasi lintas departemen dalam Agile/Waterfall environment — mulai dari requirement gathering bersama stakeholder hingga validasi sistem sebelum go-live.',
            'summary_en' => 'System Analyst with 3 years of experience managing the development of large-scale enterprise systems — from new projects to inherited legacy systems. Translates complex business needs into technical specifications that can be executed through functional prototyping and living documentation (User Story, PRD, FSD). Specializes in designing and validating REST APIs (Postman/Bruno), system integration, and documentation with Acceptance Criteria format. Accustomed to collaborating across departments in an Agile/Waterfall environment — from requirement gathering with stakeholders to system validation before go-live.',
            'photo' => null,
            'cv_id' => null,
            'cv_en' => null,
        ]);
    }
}
