<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectTechnology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title_id' => 'Sistem ERP BUMN Energi',
                'title_en' => 'State-Owned Energy Enterprise ERP System',
                'type' => 'Sistem Informasi',
                'company_name' => 'PT Energi Nusantara',
                'short_description_id' => 'Implementasi sistem ERP terintegrasi untuk mengelola operasional, keuangan, dan sumber daya manusia perusahaan energi nasional.',
                'short_description_en' => 'Integrated ERP system implementation for managing operations, finance, and human resources of a national energy company.',
                'full_description_id' => '<div><p>Proyek ini melibatkan analisis menyeluruh terhadap 12 divisi dalam perusahaan energi BUMN. Sistem yang dibangun mencakup modul procurement, inventory management, financial reporting, dan HRIS.</p><p>Sebagai Lead System Analyst, saya bertanggung jawab atas perancangan arsitektur sistem, analisis gap antara proses existing dan best practice, serta koordinasi dengan 8 vendor teknologi.</p><p>Hasil: reduksi waktu pelaporan keuangan dari 14 hari menjadi 3 hari kerja.</p></div>',
                'full_description_en' => '<div><p>This project involved comprehensive analysis of 12 divisions within a state-owned energy company. The built system covers procurement, inventory management, financial reporting, and HRIS modules.</p><p>As Lead System Analyst, I was responsible for system architecture design, gap analysis between existing processes and best practices, and coordination with 8 technology vendors.</p><p>Result: financial reporting time reduced from 14 days to 3 business days.</p></div>',
                'role' => 'Lead System Analyst',
                'period' => '2022 - 2024',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 1,
                'technologies' => ['Laravel', 'PostgreSQL', 'Redis', 'Docker', 'Kubernetes'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'Lead System Analyst'],
                    ['name' => 'Budi Santoso', 'role' => 'Backend Developer'],
                    ['name' => 'Citra Lestari', 'role' => 'UI/UX Designer'],
                ],
            ],
            [
                'title_id' => 'Platform Digital Banking',
                'title_en' => 'Digital Banking Platform',
                'type' => 'Platform Digital',
                'company_name' => 'Bank Nasional Sejahtera',
                'short_description_id' => 'Perancangan dan pengembangan platform perbankan digital dengan fitur mobile banking, internet banking, dan API gateway untuk third-party integration.',
                'short_description_en' => 'Design and development of a digital banking platform with mobile banking, internet banking, and API gateway features for third-party integration.',
                'full_description_id' => '<div><p>Platform digital banking yang melayani 2 juta nasabah dengan transaksi harian mencapai 500 ribu. Sistem dibangun dengan arsitektur microservices untuk memastikan skalabilitas dan ketersediaan tinggi.</p><p>Bertanggung jawab atas perancangan API gateway, integrasi dengan sistem core banking, dan implementasi fitur keamanan sesuai standar perbankan Indonesia.</p></div>',
                'full_description_en' => '<div><p>A digital banking platform serving 2 million customers with daily transactions reaching 500 thousand. The system was built with microservices architecture to ensure scalability and high availability.</p><p>Responsible for API gateway design, core banking system integration, and security feature implementation according to Indonesian banking standards.</p></div>',
                'role' => 'Senior System Analyst',
                'period' => '2020 - 2022',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 2,
                'technologies' => ['Spring Boot', 'MySQL', 'RabbitMQ', 'AWS', 'OAuth2'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'Senior System Analyst'],
                    ['name' => 'Dedi Pratama', 'role' => 'DevOps Engineer'],
                    ['name' => 'Eka Wulandari', 'role' => 'Quality Assurance'],
                ],
            ],
            [
                'title_id' => 'Sistem Manajemen Rantai Pasok',
                'title_en' => 'Supply Chain Management System',
                'type' => 'Logistik & SCM',
                'company_name' => 'Distribusi Prima Logistik',
                'short_description_id' => 'Sistem SCM end-to-end untuk mengelola pengadaan, pergudangan, distribusi, dan tracking pengiriman barang di seluruh wilayah Indonesia.',
                'short_description_en' => 'End-to-end SCM system for managing procurement, warehousing, distribution, and shipment tracking across Indonesia.',
                'full_description_id' => '<div><p>Sistem ini mengelola lebih dari 500 SKU dengan 15 warehouse di pulau Jawa dan Sumatera. Fitur utama meliputi demand forecasting, route optimization, dan real-time inventory tracking.</p><p>Proyek ini memenangkan penghargaan inovasi digital dari asosiasi logistik nasional pada tahun 2021.</p></div>',
                'full_description_en' => '<div><p>This system manages over 500 SKUs with 15 warehouses across Java and Sumatra islands. Key features include demand forecasting, route optimization, and real-time inventory tracking.</p><p>This project won a digital innovation award from the national logistics association in 2021.</p></div>',
                'role' => 'System Analyst',
                'period' => '2019 - 2020',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 3,
                'technologies' => ['Laravel', 'Vue.js', 'PostgreSQL', 'Google Maps API'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'System Analyst'],
                    ['name' => 'Fajar Hidayat', 'role' => 'Frontend Developer'],
                ],
            ],
        ];

        foreach ($projects as $data) {
            $technologies = $data['technologies'] ?? [];
            $members = $data['members'] ?? [];
            unset($data['technologies'], $data['members']);

            $data['slug'] = Str::slug($data['title_id']);

            $project = Project::create($data);

            foreach ($technologies as $tech) {
                ProjectTechnology::create([
                    'project_id' => $project->id,
                    'technology_name' => $tech,
                ]);
            }

            foreach ($members as $index => $member) {
                ProjectMember::create([
                    'project_id' => $project->id,
                    'name' => $member['name'],
                    'role' => $member['role'] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
