<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Categories (tech / portfolio themed)
        $categories = [
            ['module_type' => 'post', 'name' => 'Teknologi', 'slug' => 'teknologi', 'description' => 'Artikel seputar perkembangan teknologi dan inovasi digital'],
            ['module_type' => 'post', 'name' => 'Pemrograman', 'slug' => 'pemrograman', 'description' => 'Tutorial, tips, dan best practice dalam dunia coding'],
            ['module_type' => 'post', 'name' => 'Sistem Informasi', 'slug' => 'sistem-informasi', 'description' => 'Analisis, arsitektur, dan implementasi sistem informasi'],
            ['module_type' => 'post', 'name' => 'Database', 'slug' => 'database', 'description' => 'Perancangan, optimasi, dan manajemen basis data'],
            ['module_type' => 'post', 'name' => 'Karir', 'slug' => 'karir', 'description' => 'Pengembangan karir, sertifikasi, dan tips profesional di bidang IT'],
            ['module_type' => 'post', 'name' => 'Tinjauan Proyek', 'slug' => 'tinjauan-proyek', 'description' => 'Ulasan studi kasus dan pengalaman mengerjakan proyek nyata'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Tags (tech / portfolio themed)
        $tags = [
            'Laravel',
            'PHP',
            'MySQL',
            'PostgreSQL',
            'API',
            'REST',
            'Docker',
            'System Analyst',
            'UI/UX',
            'DevOps',
            'Cloud',
            'AWS',
            'Microservices',
            'ERP',
            'Agile',
        ];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }
    }
}
