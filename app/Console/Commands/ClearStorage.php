<?php

namespace App\Console\Commands;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearStorage extends Command
{
    protected $signature = 'app:clear-storage
                            {--all : Delete ALL files in public storage (destructive)}
                            {--force : Skip confirmation for destructive operations}
                            {--dry-run : Show what would be deleted without actually deleting}';

    protected $description = 'Clean up uploaded files: remove orphaned files or clear all storage';

    public function handle(): int
    {
        if ($this->option('all')) {
            return $this->clearAll();
        }

        return $this->cleanOrphans();
    }

    /**
     * Mode destructive: hapus semua file di storage/public.
     */
    private function clearAll(): int
    {
        $disk = Storage::disk('public');
        $allFiles = $disk->allFiles();
        $count = count($allFiles);

        if ($count === 0) {
            $this->warn('Storage is already empty.');

            return Command::SUCCESS;
        }

        if (! $this->option('force') && ! $this->confirm("This will DELETE ALL {$count} uploaded files. Continue?")) {
            $this->warn('Aborted.');

            return Command::FAILURE;
        }

        if ($this->option('dry-run')) {
            $this->info("[DRY RUN] Would delete {$count} files:");
            foreach ($allFiles as $file) {
                $this->line("  - {$file}");
            }

            return Command::SUCCESS;
        }

        $disk->deleteDirectory('.');
        $disk->makeDirectory('.');

        $this->info("Deleted {$count} files. Storage cleared.");

        return Command::SUCCESS;
    }

    /**
     * Mode default: hapus file orphan (tidak direferensi DB).
     */
    private function cleanOrphans(): int
    {
        $this->info('Scanning database for referenced files...');

        $referencedPaths = $this->collectReferencedPaths();

        $this->info('Scanning storage disk for files...');

        $disk = Storage::disk('public');
        $allFiles = $disk->allFiles();
        $orphans = [];

        foreach ($allFiles as $file) {
            // Abaikan file hidden
            if (str_starts_with(basename($file), '.')) {
                continue;
            }

            // Abaikan temporary uploads Livewire
            if (str_starts_with($file, 'livewire-tmp/')) {
                continue;
            }

            if (! in_array($file, $referencedPaths, true)) {
                $orphans[] = $file;
            }
        }

        if (empty($orphans)) {
            $this->info('No orphaned files found.');

            return Command::SUCCESS;
        }

        $totalSize = 0;
        foreach ($orphans as $orphan) {
            $totalSize += $disk->size($orphan);
        }

        $this->warn('Found '.count($orphans).' orphaned files ('.$this->formatBytes($totalSize).')');

        if ($this->option('dry-run')) {
            $this->info('[DRY RUN] Would delete:');
            foreach ($orphans as $orphan) {
                $this->line("  - {$orphan}");
            }

            return Command::SUCCESS;
        }

        foreach ($orphans as $orphan) {
            $disk->delete($orphan);
            $this->line("Deleted: {$orphan}");
        }

        $this->info('Cleanup complete. '.count($orphans).' orphaned files removed.');

        return Command::SUCCESS;
    }

    /**
     * Kumpulkan semua path file yang masih direferensi oleh database.
     */
    private function collectReferencedPaths(): array
    {
        $paths = [];

        // Posts (soft deleted masih direferensi, jangan hapus filenya)
        foreach (Post::withTrashed()->select('thumbnail')->whereNotNull('thumbnail')->cursor() as $post) {
            $paths[] = $post->thumbnail;
        }

        // Projects (soft deleted)
        foreach (Project::withTrashed()->select('thumbnail', 'gallery')->cursor() as $project) {
            if ($project->thumbnail) {
                $paths[] = $project->thumbnail;
            }
            if (is_array($project->gallery)) {
                foreach ($project->gallery as $image) {
                    if ($image) {
                        $paths[] = $image;
                    }
                }
            }
        }

        // Profile (single record)
        $profile = Profile::first();
        if ($profile) {
            foreach (['photo', 'cv_id', 'cv_en'] as $field) {
                if ($profile->$field) {
                    $paths[] = $profile->$field;
                }
            }
        }

        // Experiences
        foreach (Experience::select('logo')->whereNotNull('logo')->cursor() as $experience) {
            $paths[] = $experience->logo;
        }

        // Educations
        foreach (Education::select('logo')->whereNotNull('logo')->cursor() as $education) {
            $paths[] = $education->logo;
        }

        // Certificates
        foreach (Certificate::select('issuer_logo', 'certificate_image')->cursor() as $certificate) {
            if ($certificate->issuer_logo) {
                $paths[] = $certificate->issuer_logo;
            }
            if ($certificate->certificate_image) {
                $paths[] = $certificate->certificate_image;
            }
        }

        // Users
        foreach (User::select('avatar')->whereNotNull('avatar')->cursor() as $user) {
            $paths[] = $user->avatar;
        }

        // Site settings
        $siteLogo = SiteSetting::getValue('site_logo');
        $siteFavicon = SiteSetting::getValue('site_favicon');
        if ($siteLogo) {
            $paths[] = $siteLogo;
        }
        if ($siteFavicon) {
            $paths[] = $siteFavicon;
        }

        return array_unique($paths);
    }

    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $unitIndex = 0;
        while ($bytes >= 1024 && $unitIndex < count($units) - 1) {
            $bytes /= 1024;
            $unitIndex++;
        }

        return round($bytes, 2).' '.$units[$unitIndex];
    }
}
