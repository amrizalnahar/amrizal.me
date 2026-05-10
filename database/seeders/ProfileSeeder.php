<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'summary_id' => 'System Analyst & Builder dengan pengalaman lebih dari 3 tahun dalam merancang, mengembangkan, dan mengimplementasikan solusi teknologi informasi yang berdampak. Spesialisasi pada analisis sistem kompleks, arsitektur perangkat lunak, dan transformasi digital untuk organisasi skala menengah hingga besar. Berbasis di Sleman, Yogyakarta, Indonesia.',
            'summary_en' => 'System Analyst & Builder with over 3 years of experience designing, developing, and implementing impactful information technology solutions. Specializing in complex system analysis, software architecture, and digital transformation for medium to large-scale organizations. Based in Sleman, Yogyakarta, Indonesia.',
            'photo' => null,
            'cv_id' => null,
            'cv_en' => null,
        ]);
    }
}
