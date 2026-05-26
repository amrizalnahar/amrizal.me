<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Dashboard
            'dashboard-access',
            // Posts
            'posts-list', 'posts-create', 'posts-edit', 'posts-delete',
            // Projects
            'projects-list', 'projects-create', 'projects-edit', 'projects-delete', 'projects-view',
            // Master
            'categories-list', 'categories-create', 'categories-edit', 'categories-delete',
            'tags-list', 'tags-create', 'tags-edit', 'tags-delete',
            // System
            'users-list', 'users-create', 'users-edit', 'users-delete',
            'roles-list', 'roles-create', 'roles-edit', 'roles-delete',
            'settings-list', 'settings-edit',
            'audit-logs-list',
            'system-logs-list',
            'system-email-tester',
            'system-queue-monitor',
            'schedule-tasks-list',
            'schedule-tasks-execute',
            // New Modules
            // Profil
            'profile-list', 'profile-create', 'profile-edit', 'profile-delete', 'profile-view',
            // Pengalaman
            'experience-list', 'experience-create', 'experience-edit', 'experience-delete', 'experience-view',
            // Pendidikan
            'education-list', 'education-create', 'education-edit', 'education-delete', 'education-view',
            // Keahlian
            'skill-list', 'skill-create', 'skill-edit', 'skill-delete', 'skill-view',
            // Sertifikat
            'certificate-list', 'certificate-create', 'certificate-edit', 'certificate-delete', 'certificate-view',
            // Pesan Kontak
            'contact-list', 'contact-create', 'contact-edit', 'contact-delete', 'contact-view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $viewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);

        $superAdmin->givePermissionTo(Permission::all());

        $editor->givePermissionTo([
    'dashboard-access',
    // Posts
    'posts-list', 'posts-create', 'posts-edit', 'posts-delete',
    // Projects
    'projects-list', 'projects-create', 'projects-edit', 'projects-delete', 'projects-view',
    // Master
    'categories-list', 'categories-create', 'categories-edit', 'categories-delete',
    'tags-list', 'tags-create', 'tags-edit', 'tags-delete',
    // New modules
    // Profil
    'profile-list', 'profile-create', 'profile-edit', 'profile-delete', 'profile-view',
    // Pengalaman
    'experience-list', 'experience-create', 'experience-edit', 'experience-delete', 'experience-view',
    // Pendidikan
    'education-list', 'education-create', 'education-edit', 'education-delete', 'education-view',
    // Keahlian
    'skill-list', 'skill-create', 'skill-edit', 'skill-delete', 'skill-view',
    // Sertifikat
    'certificate-list', 'certificate-create', 'certificate-edit', 'certificate-delete', 'certificate-view',
    // Pesan Kontak
    'contact-list', 'contact-create', 'contact-edit', 'contact-delete', 'contact-view',
]);

        $viewer->givePermissionTo([
            'dashboard-access',
            'posts-list',
        ]);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('secret'),
                'email_verified_at' => now(),
            ]
        );
        $adminUser->assignRole('super-admin');

        $editorUser = User::firstOrCreate(
            ['email' => 'editor@mail.com'],
            [
                'name' => 'Editor',
                'password' => bcrypt('secret'),
                'email_verified_at' => now(),
            ]
        );
        $editorUser->assignRole('editor');

        $viewerUser = User::firstOrCreate(
            ['email' => 'viewer@mail.com'],
            [
                'name' => 'Viewer',
                'password' => bcrypt('secret'),
                'email_verified_at' => now(),
            ]
        );
        $viewerUser->assignRole('viewer');
    }
}
