<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name_id' => 'Analisis & Perancangan',
                'name_en' => 'Analysis & Design',
                'sort_order' => 1,
                'skills' => [
                    ['name_id' => 'Business Process Analysis', 'name_en' => 'Business Process Analysis'],
                    ['name_id' => 'Design Wireframe', 'name_en' => 'Design Wireframe'],
                    ['name_id' => 'Business Process Mapping', 'name_en' => 'Business Process Mapping'],
                    ['name_id' => 'System Architecture Design', 'name_en' => 'System Architecture Design'],
                    ['name_id' => 'Requirements Engineering', 'name_en' => 'Requirements Engineering'],
                ],
            ],
            [
                'name_id' => 'Pengembangan Perangkat Lunak',
                'name_en' => 'Software Development',
                'sort_order' => 2,
                'skills' => [
                    ['name_id' => 'PHP / Laravel', 'name_en' => 'PHP / Laravel'],
                    ['name_id' => 'ReactJs', 'name_en' => 'ReactJs'],
                    ['name_id' => 'InertiaJs', 'name_en' => 'InertiaJs'],
                    ['name_id' => 'SQL & Database Design', 'name_en' => 'SQL & Database Design'],
                    ['name_id' => 'Version Control', 'name_en' => 'Version Control'],
                ],
            ],
            [
                'name_id' => 'Manajemen Proyek',
                'name_en' => 'Project Management',
                'sort_order' => 3,
                'skills' => [
                    ['name_id' => 'Waterfall', 'name_en' => 'Waterfall'],
                    ['name_id' => 'Agile / Scrum', 'name_en' => 'Agile / Scrum'],
                    ['name_id' => 'Project Planning & Estimation', 'name_en' => 'Project Planning & Estimation'],
                    ['name_id' => 'Backlog Refinement', 'name_en' => 'Backlog Refinement'],
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $skills = $catData['skills'];
            unset($catData['skills']);

            $category = SkillCategory::create($catData);

            foreach ($skills as $skillData) {
                $skillData['skill_category_id'] = $category->id;
                Skill::create($skillData);
            }
        }
    }
}
