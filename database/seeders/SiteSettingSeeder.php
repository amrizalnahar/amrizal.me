<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Admin Panel',
            'site_description' => 'Aplikasi manajemen konten website pribadi berbasis Laravel.',

            'contact_email' => 'zalamri26@gmail.com',
            'contact_phone' => '+6282242458078',
            'contact_address' => 'Pemalang, Jawa Tengah, Indonesia',
            'mail_from_address' => 'zalamri26@gmail.com',
            'social_facebook' => 'https://facebook.com/',
            'social_instagram' => 'https://instagram.com/',
            'social_whatsapp' => '+6282242458078',
            'social_tiktok' => null,
            'social_twitter' => null,
            'social_youtube' => null,
            'github_url' => 'amrizalnahar',
            'linkedin_url' => 'muhamad-amrizal-nahar-143374170/',
            'location' => 'Indonesia',
            'contact_whatsapp' => '+6282242458078',
            'seo_site_name' => 'Admin Panel',
            'seo_description' => 'Aplikasi manajemen konten website pribadi berbasis Laravel.',
            'seo_author' => 'Admin Panel',
            'ga4_measurement_id' => null,
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::setValue($key, $value);
        }
    }
}
