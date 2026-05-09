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
                    ['name_id' => 'System Architecture Design', 'name_en' => 'System Architecture Design'],
                    ['name_id' => 'UML & BPMN Modeling', 'name_en' => 'UML & BPMN Modeling'],
                    ['name_id' => 'Requirements Engineering', 'name_en' => 'Requirements Engineering'],
                ],
            ],
            [
                'name_id' => 'Pengembangan Perangkat Lunak',
                'name_en' => 'Software Development',
                'sort_order' => 2,
                'skills' => [
                    ['name_id' => 'PHP / Laravel', 'name_en' => 'PHP / Laravel'],
                    ['name_id' => 'Python', 'name_en' => 'Python'],
                    ['name_id' => 'JavaScript / TypeScript', 'name_en' => 'JavaScript / TypeScript'],
                    ['name_id' => 'SQL & Database Design', 'name_en' => 'SQL & Database Design'],
                ],
            ],
            [
                'name_id' => 'Manajemen Proyek',
                'name_en' => 'Project Management',
                'sort_order' => 3,
                'skills' => [
                    ['name_id' => 'Agile / Scrum', 'name_en' => 'Agile / Scrum'],
                    ['name_id' => 'Project Planning & Estimation', 'name_en' => 'Project Planning & Estimation'],
                    ['name_id' => 'Stakeholder Management', 'name_en' => 'Stakeholder Management'],
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
