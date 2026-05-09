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
                'title_id' => 'Certified Information Systems Auditor (CISA)',
                'title_en' => 'Certified Information Systems Auditor (CISA)',
                'issuer_name' => 'ISACA',
                'issued_at' => '2022-06-15',
                'expired_at' => '2025-06-15',
                'verify_url' => 'https://www.isaca.org/credentialing/cisa',
                'description_id' => 'Sertifikasi internasional dalam audit, kontrol, dan keamanan sistem informasi.',
                'description_en' => 'International certification in information systems auditing, control, and security.',
                'certificate_image' => null,
                'status' => 'publish',
                'sort_order' => 1,
            ],
            [
                'title_id' => 'AWS Certified Solutions Architect – Professional',
                'title_en' => 'AWS Certified Solutions Architect – Professional',
                'issuer_name' => 'Amazon Web Services',
                'issued_at' => '2023-03-10',
                'expired_at' => '2026-03-10',
                'verify_url' => 'https://www.credly.com/badges/aws-sa-pro',
                'description_id' => 'Sertifikasi arsitek solusi AWS tingkat profesional untuk desain sistem terdistribusi yang skalabel dan fault-tolerant.',
                'description_en' => 'Professional-level AWS solutions architect certification for designing scalable and fault-tolerant distributed systems.',
                'certificate_image' => null,
                'status' => 'publish',
                'sort_order' => 2,
            ],
            [
                'title_id' => 'Professional Scrum Master I (PSM I)',
                'title_en' => 'Professional Scrum Master I (PSM I)',
                'issuer_name' => 'Scrum.org',
                'issued_at' => '2021-09-20',
                'expired_at' => null,
                'verify_url' => 'https://www.scrum.org/certificates/PSM-I',
                'description_id' => 'Sertifikasi fundamental dalam framework Scrum dan praktik agile project management.',
                'description_en' => 'Fundamental certification in Scrum framework and agile project management practices.',
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
