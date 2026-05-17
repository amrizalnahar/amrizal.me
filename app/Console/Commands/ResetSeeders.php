<?php

namespace App\Console\Commands;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Console\Command;

class ResetSeeders extends Command
{
    protected $signature = 'seeders:reset {--tables=*}';

    protected $description = 'Hapus data dari tabel educations, experiences, certificates lalu jalankan seeder';

    public function handle(): void
    {
        $tables = $this->option('tables');
        $all = empty($tables);

        if ($all || in_array('certificates', $tables)) {
            Certificate::query()->delete();
            $this->call('db:seed', ['--class' => 'CertificateSeeder']);
            $this->info('Certificates direset dan di-seed ulang.');
        }

        if ($all || in_array('educations', $tables)) {
            Education::query()->delete();
            $this->call('db:seed', ['--class' => 'EducationSeeder']);
            $this->info('Educations direset dan di-seed ulang.');
        }

        if ($all || in_array('experiences', $tables)) {
            Experience::query()->delete();
            $this->call('db:seed', ['--class' => 'ExperienceSeeder']);
            $this->info('Experiences direset dan di-seed ulang.');
        }

        $this->info('Selesai.');
    }
}
