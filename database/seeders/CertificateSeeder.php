<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $certificates = [
            [
                'title_id' => 'Database MySQL: Pemula sampai Mahir',
                'title_en' => 'Database MySQL: Pemula sampai Mahir',
                'issuer_name' => 'Udemy',
                'issued_at' => '2023-03-28',
                'expired_at' => null,
                'verify_url' => 'https://www.udemy.com/certificate/UC-756b6ecf-b09e-4bab-abf9-de46a2f254d5/',
                'description_id' => 'Sertifikat penyelesaian ini menunjukkan pemahaman mendalam saya tentang ekosistem MySQL. Melalui kursus ini, saya telah menguasai pembuatan kueri kompleks (Advanced Querying), implementasi join, indexing untuk meningkatkan performa database, penanganan transaksi (ACID), hingga manajemen user dan hak akses keamanan database.',
                'description_en' => 'This certificate of completion demonstrates my in-depth understanding of the MySQL ecosystem. Through this comprehensive training, I mastered advanced SQL querying, multi-table joins, indexing for performance tuning, transaction management (ACID properties), and database security/user access control.',
                'certificate_image' => null,
                'status' => 'publish',
                'sort_order' => 1,
            ],
            [
                'title_id' => 'Cloud Computing Learning Path',
                'title_en' => 'Cloud Computing Learning Path',
                'issuer_name' => 'Bangkit Academy',
                'issued_at' => '2022-07-28',
                'expired_at' => null,
                'verify_url' => 'https://drive.google.com/file/d/1qmXqZgAydVZ9cHQFKmCknbEUXk1iYVby/view?usp=sharing',
                'description_id' => 'Sertifikasi arsitek solusi AWS tingkat profesional untuk desain sistem terdistribusi yang skalabel dan fault-tolerant.',
                'description_en' => 'Professional-level AWS solutions architect certification for designing scalable and fault-tolerant distributed systems.',
                'certificate_image' => null,
                'status' => 'publish',
                'sort_order' => 2,
            ],
            [
                'title_id' => 'Pengembang Web Pertama',
                'title_en' => 'Junior Web Developer',
                'issuer_name' => 'Badan Nasional Sertifikasi Profesi (BNSP)',
                'issued_at' => '2021-11-15',
                'expired_at' => '2024-11-15',
                'verify_url' => 'https://drive.google.com/file/d/1nxzJFGRzYe7DouEeVvJNiOLiQCRh83E9/view?usp=sharing',
                'description_id' => 'Tersertifikasi secara nasional oleh BNSP sebagai Junior Web Developer. Melalui uji kompetensi ini, saya dinyatakan kompeten dalam unit-unit kunci seperti implementasi algoritma pemrograman, penggunaan struktur data, pembuatan kueri SQL, serta pengembangan komponen frontend dan backend untuk aplikasi web.',
                'description_en' => 'Professionally certified as a Junior Web Developer by BNSP (2023). This credential confirms my proficiency in building functional web applications, managing relational databases, and implementing efficient algorithms. It serves as formal recognition of my technical readiness to meet rigorous national industry standards.',
                'certificate_image' => null,
                'status' => 'publish',
                'sort_order' => 3,
            ],
        ];

        foreach ($certificates as $data) {
            Certificate::create($data);
        }
    }
}
