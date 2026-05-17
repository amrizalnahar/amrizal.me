<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $sourceFavicon = database_path('seeders/images/settings/favicon.png');
        $faviconPath = 'settings/favicon.png';

        if (file_exists($sourceFavicon)) {
            Storage::disk('public')->put($faviconPath, file_get_contents($sourceFavicon));
        }

        $settings = [
            'site_name' => 'Amrizal Nahar',
            'site_description' => 'Portfolio dan blog profesional Amrizal Nahar, System Analyst & Builder. Berbagi pengalaman dan wawasan seputar perancangan sistem informasi, pengembangan aplikasi web, dan manajemen proyek teknologi.',

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
            'seo_site_name' => 'Amrizal Nahar — System Analyst & Builder',
            'seo_description' => 'Portfolio dan blog Amrizal Nahar, System Analyst & Builder. Temukan artikel, studi kasus, dan proyek seputar analisis sistem, pengembangan aplikasi, serta teknologi informasi.',
            'seo_author' => 'Amrizal Nahar',
            'ga4_measurement_id' => null,
            'site_favicon' => file_exists($sourceFavicon) ? $faviconPath : null,
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::setValue($key, $value);
        }
    }
}
