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
            ['module_type' => 'post', 'name' => 'Teknologi', 'name_id' => 'Teknologi', 'name_en' => 'Technology', 'slug' => 'teknologi', 'description' => 'Artikel seputar perkembangan teknologi dan inovasi digital'],
            ['module_type' => 'post', 'name' => 'Pemrograman', 'name_id' => 'Pemrograman', 'name_en' => 'Programming', 'slug' => 'pemrograman', 'description' => 'Tutorial, tips, dan best practice dalam dunia coding'],
            ['module_type' => 'post', 'name' => 'Sistem Informasi', 'name_id' => 'Sistem Informasi', 'name_en' => 'Information Systems', 'slug' => 'sistem-informasi', 'description' => 'Analisis, arsitektur, dan implementasi sistem informasi'],
            ['module_type' => 'post', 'name' => 'Database', 'name_id' => 'Database', 'name_en' => 'Database', 'slug' => 'database', 'description' => 'Perancangan, optimasi, dan manajemen basis data'],
            ['module_type' => 'post', 'name' => 'Karir', 'name_id' => 'Karir', 'name_en' => 'Career', 'slug' => 'karir', 'description' => 'Pengembangan karir, sertifikasi, dan tips profesional di bidang IT'],
            ['module_type' => 'post', 'name' => 'Tinjauan Proyek', 'name_id' => 'Tinjauan Proyek', 'name_en' => 'Project Reviews', 'slug' => 'tinjauan-proyek', 'description' => 'Ulasan studi kasus dan pengalaman mengerjakan proyek nyata'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Tags (tech / portfolio themed)
        $tags = [
            ['name' => 'Laravel', 'name_id' => 'Laravel', 'name_en' => 'Laravel'],
            ['name' => 'PHP', 'name_id' => 'PHP', 'name_en' => 'PHP'],
            ['name' => 'MySQL', 'name_id' => 'MySQL', 'name_en' => 'MySQL'],
            ['name' => 'PostgreSQL', 'name_id' => 'PostgreSQL', 'name_en' => 'PostgreSQL'],
            ['name' => 'API', 'name_id' => 'API', 'name_en' => 'API'],
            ['name' => 'REST', 'name_id' => 'REST', 'name_en' => 'REST'],
            ['name' => 'Docker', 'name_id' => 'Docker', 'name_en' => 'Docker'],
            ['name' => 'System Analyst', 'name_id' => 'System Analyst', 'name_en' => 'System Analyst'],
            ['name' => 'UI/UX', 'name_id' => 'UI/UX', 'name_en' => 'UI/UX'],
            ['name' => 'DevOps', 'name_id' => 'DevOps', 'name_en' => 'DevOps'],
            ['name' => 'Cloud', 'name_id' => 'Cloud', 'name_en' => 'Cloud'],
            ['name' => 'AWS', 'name_id' => 'AWS', 'name_en' => 'AWS'],
            ['name' => 'Microservices', 'name_id' => 'Microservices', 'name_en' => 'Microservices'],
            ['name' => 'ERP', 'name_id' => 'ERP', 'name_en' => 'ERP'],
            ['name' => 'Agile', 'name_id' => 'Agile', 'name_en' => 'Agile'],
            ['name' => 'Artificial Intelligence', 'name_id' => 'Artificial Intelligence', 'name_en' => 'Artificial Intelligence'],
            ['name' => 'Machine Learning', 'name_id' => 'Machine Learning', 'name_en' => 'Machine Learning'],
            ['name' => 'Data Science', 'name_id' => 'Data Science', 'name_en' => 'Data Science'],
            ['name' => 'User Story', 'name_id' => 'User Story', 'name_en' => 'User Story'],
            ['name' => 'PRD', 'name_id' => 'PRD', 'name_en' => 'PRD'],
            ['name' => 'Testing', 'name_id' => 'Testing', 'name_en' => 'Testing'],
            ['name' => 'Headless', 'name_id' => 'Headless', 'name_en' => 'Headless'],
            ['name' => 'Project Management', 'name_id' => 'Project Management', 'name_en' => 'Project Management'],
            ['name' => 'Software Architecture', 'name_id' => 'Software Architecture', 'name_en' => 'Software Architecture'],
            ['name' => 'Career Development', 'name_id' => 'Career Development', 'name_en' => 'Career Development'],
            ['name' => 'Personal Growth', 'name_id' => 'Personal Growth', 'name_en' => 'Personal Growth'],
            ['name' => 'Professionalism', 'name_id' => 'Professionalism', 'name_en' => 'Professionalism'],
            ['name' => 'Product Management', 'name_id' => 'Product Management', 'name_en' => 'Product Management'],
        ];

        foreach ($tags as $tagData) {
            Tag::create([
                'name' => $tagData['name'],
                'name_id' => $tagData['name_id'],
                'name_en' => $tagData['name_en'],
                'slug' => Str::slug($tagData['name_id']),
            ]);
        }
    }
}
