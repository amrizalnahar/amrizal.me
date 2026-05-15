<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectTechnology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title_id' => 'Sistem Manajemen Katalog Produk (Inventory Importa)',
                'title_en' => null,
                'type' => 'office',
                'company_name' => 'Importa',
                'short_description_id' => 'Backend aplikasi untuk pengelolaan data produk sebagai single source of truth yang mendukung produk simple & variable dengan variant SKU, bulk import/export Excel, serta sinkronisasi otomatis ke website WordPress/WooCommerce.',
                'short_description_en' => null,
                'full_description_id' => '<div><h3>Deskripsi Proyek</h3><p>Inventory Importa adalah aplikasi backend berbasis web yang dibangun menggunakan Laravel untuk mengelola data produk secara terpusat dan terstruktur. Sistem ini bertindak sebagai <em>single source of truth</em> bagi data katalog produk perusahaan Importa, yang kemudian disinkronkan ke website utama berbasis WordPress (WooCommerce).</p><h3>Permasalahan</h3><ul><li>Manajemen katalog yang tersebar dan tidak terstruktur di berbagai channel.</li><li>Proses update katalog manual di WordPress lambat dan rentan error, terutama untuk produk dengan banyak varian.</li><li>Tidak ada kendali akses berbasis peran (RBAC) yang jelas.</li><li>Kurangnya <em>traceability</em> dan audit trail perubahan data produk.</li><li>Tidak ada mekanisme bulk operation untuk pemasukan atau pembaruan data dalam jumlah besar.</li><li>Sinkronisasi data ke website utama tidak terintegrasi secara otomatis.</li></ul><h3>Solusi yang Dibangun</h3><ul><li>Modul <strong>CRUD Product</strong> lengkap dengan section Product Description, Product Data, Short Description, Image, Gallery, Categories, Tags, dan Brands. Mendukung produk tipe <em>simple</em> maupun <em>variable</em> dengan variant SKU.</li><li>Sistem <strong>Sync ke WordPress</strong> melalui Public API dengan mekanisme acknowledgement per SKU (<code>is_synced</code>, <code>synced_at</code>), serta cron job untuk sinkronisasi terjadwal.</li><li>Sistem <strong>Group-Based Permission</strong> dengan konteks capability dan caching permission untuk performa.</li><li>Tabel <strong>Audit Trail</strong> dan <strong>Stock History</strong> yang mencatat setiap perubahan stok termasuk qty_before, qty_after, delta, actor_id, dan created_at.</li><li>Fitur <strong>Import &amp; Export Product</strong> berbasis template Excel/CSV dengan preview validasi, dukungan upsert (insert/update), serta filter berdasarkan taxonomy.</li><li><strong>Public Sync API</strong> yang dilindungi API key dan domain allowlist, serta endpoint detail per SKU untuk konsumsi website WordPress.</li></ul><h3>Tujuan Proyek</h3><ul><li>Membangun single source of truth untuk data produk sebelum disinkronkan ke channel publikasi.</li><li>Meningkatkan efisiensi operasional katalog melalui bulk import/export.</li><li>Menerapkan governance dan kontrol akses berbasis grup.</li><li>Menyediakan traceability penuh atas perubahan data.</li><li>Mendukung skalabilitas produk dengan varian dan SKU unik per kombinasi varian.</li></ul><h3>Tech Stack</h3><p><strong>Backend:</strong> Laravel, PHP 8.3, Livewire, Maatwebsite Excel, Intervention Image, GuzzleHTTP, Spatie Sluggable, Spatie Image Optimizer.<br><strong>Frontend:</strong> Vue.js 3 (compat mode), Bootstrap 4.6, jQuery, Sass, Vite, GLightbox.<br><strong>Database &amp; DevOps:</strong> MariaDB, Redis, Docker, Nginx, PHP-FPM, Supervisor, Ubuntu 24.04.</p><h3>Timeline</h3><p><strong>Periode:</strong> Maret 2026 – Mei 2026 (~1,5 bulan)<br><strong>Fase:</strong> Init &amp; Dokumentasi → Core Feature Development → Dockerization &amp; CI/CD → Stabilization &amp; Refinement.</p></div>',
                'full_description_en' => null,
                'role' => 'System Analyst',
                'period' => '2026',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 1,
                'technologies' => ['Laravel', 'Vue.js', 'MariaDB', 'Bootstrap', 'Sass', 'Vite', 'Docker', 'Livewire', 'Maatwebsite Excel', 'Intervention Image'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'System Analyst'],
                ],
            ],
            [
                'title_id' => 'Sistem Tata Kelola Risiko Konglomerasi Keuangan (G-Asfin)',
                'title_en' => null,
                'type' => 'office',
                'company_name' => 'Astra Financial (Sedaya Multi Investama)',
                'short_description_id' => 'Aplikasi enterprise berskala besar untuk pengelolaan risiko, compliance, dan pelaporan regulasi OJK bagi konglomerasi keuangan Astra Financial dengan arsitektur microservices modular mencakup 49 modul independen.',
                'short_description_en' => null,
                'full_description_id' => '<div><h3>Deskripsi Proyek</h3><p>G-Astrafinancial (G-Asfin) adalah aplikasi web berskala enterprise yang dikembangkan untuk Sedaya Multi Investama (SMI) / Astra Financial beserta seluruh entitas anggota (subsidiaries) di bawah grup Astra Financial. Sistem ini dibangun menggunakan Laravel 5.5 dengan arsitektur khusus bernama <strong>Aksara</strong> yang mengadopsi pola Microservices Modular.</p><p>Aplikasi ini digunakan untuk melakukan dan menyampaikan laporan terkait audit, anti-pencucian uang (APU), pencegahan pendanaan terorisme (PPT), pembaruan regulasi dan risiko, penjadwalan acara RUPST, forum diskusi, serta tata kelola risiko konglomerasi keuangan. Sistem ini melayani multi-tenant di mana setiap entitas anggota memiliki isolasi data dan alur approval yang terpisah, namun tetap dapat dikonsolidasikan di level SMI.</p><h3>Permasalahan</h3><ul><li>Fragmentasi data risiko dan compliance antar entitas anggota konglomerasi keuangan.</li><li>Kompleksitas pelaporan regulasi ke OJK dengan format dan parameter yang ketat.</li><li>Tidak ada visibilitas menyeluruh terhadap profil risiko, KPMM, stress testing, dan risk limit di seluruh entitas anggota.</li><li>Approval workflow multi-level yang kompleks tanpa otomatisasi reminder, notifikasi, dan tracking status.</li><li>Kebutuhan kepatuhan terhadap regulasi APU dan PPT melalui survei, penilaian, dan dokumentasi terstruktur.</li><li>Keterlambatan dan ketidakakuratan laporan konsolidasi akibat proses manual melalui spreadsheet.</li></ul><h3>Solusi yang Dibangun</h3><ul><li>Arsitektur <strong>Multi-Tenant</strong> dengan modul <code>astra-financial-bu</code> dan <code>organisasi-asfin</code> untuk isolasi data per entitas anggota dalam satu platform.</li><li>Modul <strong>Laporan OJK</strong> dengan form kuesioner terstruktur, parameter audit, governance, compliance, dan tata kelola sesuai standar OJK.</li><li>Modul <strong>Integrated Risk Management</strong>, <strong>Laporan Profil Risiko</strong>, <strong>Laporan Stress Testing</strong>, dan <strong>Laporan Risk Limit</strong> dengan dashboard konsolidasi di level SMI.</li><li>Modul <strong>Approval Laporan KKA</strong>, <strong>Approval Unit Bisnis</strong>, dan fitur approval di setiap modul laporan dengan notifikasi email, tracking status, dan konfigurasi PIC.</li><li>Modul <strong>Penilaian APU PPT Asfin</strong>, <strong>Survei Anti Fraud</strong>, dan <strong>Survey Kepatuhan Asfin</strong> dengan upload dokumen, scoring, dan audit trail.</li><li>Modul <strong>Laporan KPMM</strong>, <strong>KPMM Terintegrasi</strong>, dan <strong>KKA</strong> dengan engine perhitungan otomatis, export PDF/Excel/DOC, dan konsolidasi real-time.</li></ul><h3>Tujuan Proyek</h3><ul><li>Integrasi data konglomerasi dari seluruh entitas anggota Astra Financial dalam satu platform terpusat.</li><li>Kepatuhan regulasi 100% dengan format yang sesuai standar regulator.</li><li>Otomatisasi workflow approval untuk mengurangi turnaround time menjadi kurang dari 3 hari kerja.</li><li>Visibilitas risk profile real-time melalui dashboard konsolidasi.</li><li>Efisiensi proses laporan melalui engine perhitungan otomatis dan export multi-format.</li></ul><h3>Tech Stack</h3><p><strong>Backend:</strong> Laravel 5.5, PHP 7.x, Aksara Framework (custom modular microservices), Laravel Collective HTML, Elasticsearch, DOMPDF, Maatwebsite Excel, Intervention Image, Spatie PDF-to-Text, Doctrine DBAL.<br><strong>Frontend:</strong> Vue.js 2.1, jQuery 3.1, Bootstrap Sass 3.3, Axios, Laravel Mix, Chart.js / Morris.js / Flot, CKEditor, Select2, Datepicker, FullCalendar.<br><strong>Database &amp; DevOps:</strong> MySQL, Redis, GitLab CI, SonarQube, Docker, PHPUnit, Laravel Debugbar.</p><h3>Timeline</h3><p><strong>Periode:</strong> Oktober 2019 – April 2026 (~6,5 tahun)<br><strong>Fase:</strong> Setup &amp; Core Platform → Risk &amp; Compliance Foundation → KKA Ecosystem Expansion → Privacy Oversight &amp; Enhancement.</p><h3>Catatan Arsitektur</h3><p>Sistem ini menggunakan pola microservices modular dengan <strong>49 modul independen</strong> di direktori <code>aksara-modules/</code>, masing-masing memiliki domain bisnis, migrasi, model, controller, view, dan routing yang independen. Engine perhitungan konsolidasi, approval workflow, dan audit trail yang dibangun menunjukkan maturity sistem dalam menangani tata kelola risiko konglomerasi.</p></div>',
                'full_description_en' => null,
                'role' => 'System Analyst',
                'period' => '2019 – 2026',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'draft',
                'sort_order' => 2,
                'technologies' => ['Laravel', 'Vue.js', 'jQuery', 'Bootstrap', 'MySQL', 'Elasticsearch', 'Redis', 'DOMPDF', 'Maatwebsite Excel', 'Intervention Image'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'System Analyst'],
                ],
            ],
            [
                'title_id' => 'Enhancement Sistem Kepatuhan (GCL-AAB) 2025-2026',
                'title_en' => null,
                'type' => 'office',
                'company_name' => 'PT. Asuransi Astra Buana',
                'short_description_id' => 'Enhancement major sistem GCL-AAB dengan integrasi Typesense sebagai search engine, dukungan multi-tenant untuk Regulation Management, migrasi rich text editor ke TinyMCE, dan production hardening menjelang go-live stabil.',
                'short_description_en' => null,
                'full_description_id' => '<div><h3>Deskripsi Proyek</h3><p>Fase Phase 5 dan Phase 6 merupakan periode <strong>enhancement major</strong> dari sistem GCL-AAB yang sebelumnya telah berhasil dibangun dengan lima modul inti pada Phase 1–4. Pada fase ini, pengembangan berfokus pada peningkatan kapabilitas sistem secara signifikan melalui integrasi mesin pencarian canggih, dukungan multi-tenant, perbaikan UX/UI berskala besar, serta hardening produksi menjelang go-live stabil.</p><h3>Permasalahan</h3><ul><li>Pencarian dokumen dan peraturan tidak efisien dengan bertambahnya volume data.</li><li>Kebutuhan multi-tenant untuk Regulation Management agar entitas hukum berbeda dapat mengelola peraturan dalam satu instance.</li><li>Performance notifikasi menurun karena dijalankan secara synchronous.</li><li>Keterbatasan rich text editor Summernote dalam formatting dan rentan XSS injection.</li><li>Banyak catatan perbaikan hasil UAT yang harus diimplementasikan sebelum go-live.</li><li>Standar keamanan yang perlu ditingkatkan secara berkelanjutan.</li></ul><h3>Solusi yang Dibangun</h3><ul><li>Integrasi <strong>Typesense</strong> sebagai search engine dengan Laravel Scout, mencakup typo-tolerance, highlight result, filter facet, dan indeks dokumen real-time.</li><li>Pengembangan <strong>Regulation Management Multi-Tenant</strong> dengan namespace tenant pada route, controller, dan model untuk isolasi data per entitas.</li><li>Refactoring notifikasi ke <strong>queue-based</strong> (<code>ShouldQueue</code>) untuk reminder compass assessment, licensing monitoring, dan laporan regulasi.</li><li>Migrasi ke <strong>TinyMCE</strong> dengan konfigurasi toolbar kustom, plugin tambahan, dan API key terpusat yang dikelola melalui menu konfigurasi backend.</li><li>Perbaikan berskala besar pada wording, flow approval, export formatting (font Calibri, page break), dashboard filter, sticky table, hover state, dan validasi form berdasarkan feedback UAT.</li><li>Implementasi <strong>XSS validation</strong> menyeluruh pada semua input teks, sanitasi HTML sebelum indeks Typesense, prevent script tags, validasi file upload, dan audit trail per periode laporan.</li></ul><h3>Tujuan Proyek</h3><ul><li>Peningkatan discoverability data melalui pencarian yang powerful dan toleran kesalahan ketik.</li><li>Skalabilitas organisasi dengan kemampuan multi-tenant.</li><li>Stabilitas dan performance produksi melalui queue processing dan optimasi query.</li><li>Peningkatan user experience berdasarkan feedback UAT real-world.</li><li>Kepatuhan keamanan enterprise melalui hardening XSS dan validasi input komprehensif.</li></ul><h3>Tech Stack</h3><p><strong>Backend:</strong> Laravel, Typesense Scout Driver 5.2, Laravel Scout, Laravel Queue, TinyMCE API.<br><strong>Frontend:</strong> TinyMCE, Vite 3.0, Sass, patch-package.<br><strong>Database:</strong> MySQL dengan penambahan tabel/index untuk multi-tenant, Typesense Server sebagai search cluster eksternal.</p><h3>Timeline</h3><p><strong>Periode:</strong> Januari 2025 – Maret 2026 (~1 tahun)<br><strong>Fase:</strong> Search &amp; Multi-Tenant Enhancement → Production Hardening &amp; Major Enhancement.</p></div>',
                'full_description_en' => null,
                'role' => 'System Analyst',
                'period' => '2025 – 2026',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 3,
                'technologies' => ['Laravel', 'Typesense', 'Laravel Scout', 'TinyMCE', 'MySQL', 'Sass', 'Vite', 'Laravel Queue'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'System Analyst'],
                ],
            ],
            [
                'title_id' => 'Sistem Rekrutmen Terpadu (AAB Career)',
                'title_en' => null,
                'type' => 'office',
                'company_name' => 'PT. Asuransi Astra Buana',
                'short_description_id' => 'Applicant Tracking System berbasis web untuk mengelola seluruh siklus hidup perekrutan mulai dari publikasi lowongan, pelacakan lamaran, pengelolaan profil pelamar, hingga penjadwalan Medical Check Up dan konfirmasi manfaat kerja.',
                'short_description_en' => null,
                'full_description_id' => '<div><h3>Deskripsi Proyek</h3><p>AAB Career adalah sistem manajemen rekrutmen (Applicant Tracking System) berbasis web yang terdiri dari dua komponen utama: <strong>backend Laravel 11</strong> yang menyediakan API dan CMS administrasi, serta <strong>frontend dashboard Next.js 14</strong> yang menjadi antarmuka bagi calon pelamar dan tim TA (Talent Acquisition).</p><p>Domain bisnis yang dilayani mencakup manajemen lowongan pekerjaan (Job Order), pendaftaran dan pelacakan lamaran, pengelolaan profil pelamar secara komprehensif (data pribadi, pendidikan, pengalaman kerja, organisasi, keluarga), penjadwalan Medical Check Up (MCU), serta konfirmasi manfaat kerja (FKM). Sistem menggunakan autentikasi berbasis cookie Laravel Sanctum dengan tiga guard berbeda: applicant, admin-ta, dan admin.</p><h3>Permasalahan</h3><ul><li>Proses rekrutmen manual yang tidak efisien melalui email atau spreadsheet.</li><li>Tidak ada transparansi status lamaran bagi pelamar.</li><li>Data pelamar tersebar dan tidak terstandarisasi dalam berbagai format dokumen.</li><li>Manajemen jadwal MCU tidak terintegrasi dengan sistem rekrutmen.</li><li>Kesulitan dalam pelaporan dan analisis data rekrutmen real-time.</li><li>Kebutuhan validasi data yang ketat untuk memenuhi standar kepatuhan dan kualitas SDM.</li></ul><h3>Solusi yang Dibangun</h3><ul><li>Sistem <strong>Job Order</strong> dengan CRUD lowongan, publikasi, dan manajemen status lowongan.</li><li>Sistem lamaran pekerjaan (<strong>Application</strong>) dengan alur tahapan seleksi (<strong>ApplicationStageStatus</strong>).</li><li>Dashboard pelamar untuk melacak status lamaran real-time dengan notifikasi dan riwayat perubahan status.</li><li>Form Data Pribadi (FDP) terstruktur dengan 15+ tabel relasional dan validasi berbasis Zod di frontend serta Laravel di backend.</li><li>Modul <strong>MedicalSchedule</strong> dan <strong>ApplicantMedicalSchedule</strong> untuk penjadwalan MCU berbasis tanggal yang dapat dipilih pelamar.</li><li>Fitur export data pelamar ke Excel, dashboard admin TA dengan grafik dan ringkasan lowongan, serta filter dan pencarian lanjutan.</li><li>Sistem <strong>Capability-Based Authorization</strong>, validasi multi-panel pada FDP, pengecekan kelengkapan profil, dan fitur review aplikasi oleh admin TA.</li></ul><h3>Tujuan Proyek</h3><ul><li>Digitalisasi seluruh siklus rekrutmen dari publikasi lowongan hingga konfirmasi manfaat (FKM).</li><li>Peningkatan transparansi dan pengalaman pelamar melalui dashboard personal yang responsif.</li><li>Efisiensi administrasi tim TA dalam mengelola lowongan, menyaring pelamar, menjadwalkan MCU, dan menghasilkan laporan.</li><li>Integrasi data master nasional untuk wilayah Indonesia, institusi pendidikan, dan struktur organisasi perusahaan.</li><li>Keamanan dan kepatuhan data melalui autentikasi Sanctum, kontrol akses berbasis capability, dan fitur penghapusan akun.</li></ul><h3>Tech Stack</h3><p><strong>Backend:</strong> Laravel 11, PHP 8.2, Laravel Sanctum, Inertia.js, Vite, Bootstrap 4.6, Maatwebsite Excel, Intervention Image, Spatie Google Calendar, Spatie Image Optimizer, laravolt/avatar.<br><strong>Frontend:</strong> Next.js 14.1, React 18, Redux Toolkit, RTK Query, TanStack React Query, TanStack React Table, Sass, styled-components, Axios, React Hook Form, Zod, Framer Motion, Recharts, React-PDF.<br><strong>Database &amp; DevOps:</strong> MySQL, Redis, Docker, nginx, Traefik, PHPUnit, Laravel Pint, Laravel Debugbar.</p><h3>Timeline</h3><p><strong>Periode:</strong> April 2024 – Oktober 2025 (~1,5 tahun)<br><strong>Fase:</strong> Setup &amp; Foundation → Core Features Development → Recruitment System Development → Stabilization &amp; Enhancement.</p><h3>Catatan Arsitektur</h3><p>Backend menggunakan sistem <em>hook</em> custom melalui <strong>Eventy</strong> yang memungkinkan registrasi route, capability, dan menu secara dinamis melalui boot providers. Multi-interface frontend dalam satu backend: CMS Admin (Blade + AdminLTE), Dashboard Inertia (React), dan Frontend Web (React).</p></div>',
                'full_description_en' => null,
                'role' => 'System Analyst',
                'period' => '2024 – 2025',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 4,
                'technologies' => ['Laravel', 'Next.js', 'React', 'PostgreSQL', 'Redis', 'Docker', 'Kubernetes', 'Redux Toolkit', 'RTK Query', 'React Hook Form', 'Zod', 'Recharts'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'System Analyst'],
                ],
            ],
            [
                'title_id' => 'Sistem Monitoring Program Rendah Karbon (PMIS-RGB-Next)',
                'title_en' => null,
                'type' => 'office',
                'company_name' => 'Koalisi PPRK Indonesia',
                'short_description_id' => 'Sistem informasi dan monitoring program rendah karbon (PPRK) yang menyediakan platform terpusat untuk pengelolaan data program, penetapan target, pelaporan capaian, verifikasi dua tingkat, serta transparansi publik melalui website dan dashboard analitik.',
                'short_description_en' => null,
                'full_description_id' => '<div><h3>Deskripsi Proyek</h3><p>PMIS-RGB-Next adalah sistem informasi dan monitoring program berbasis web yang dibangun untuk mendukung pengelolaan <strong>Program Rendah Karbon (PPRK)</strong> dan koalisi organisasi di Indonesia. Sistem ini menyediakan platform terpusat bagi berbagai pemangku kepentingan — mulai dari organisasi pelaksana, kontributor, verifikator, hingga admin — untuk mengelola data program, menetapkan target, melaporkan capaian, serta melakukan verifikasi secara terstruktur.</p><p>Secara arsitektural, proyek ini merupakan <strong>monorepo</strong> yang terdiri dari empat layanan utama: Backend Admin berbasis Laravel 11 dengan Inertia.js dan React 18, Dashboard Aplikasi berbasis Next.js 15, Website Publik berbasis Next.js 15 untuk transparansi publik, serta infrastruktur pendukung berupa MariaDB, Redis, Nginx, dan Traefik.</p><h3>Permasalahan</h3><ul><li>Tidak adanya sistem terpusat untuk monitoring program rendah karbon.</li><li>Proses verifikasi target dan capaian tidak terstruktur tanpa workflow baku.</li><li>Kesulitan manajemen multi-organisasi dan multi-peran dalam satu koalisi.</li><li>Kurangnya transparansi dan akuntabilitas publik terhadap data program rendah karbon.</li><li>Risiko integritas data tanpa audit trail untuk perubahan target maupun capaian.</li><li>Kompleksitas pengelolaan data spasial dan sektor mitigasi yang mencakup banyak variabel.</li></ul><h3>Solusi yang Dibangun</h3><ul><li><strong>Monorepo</strong> dengan Backend Laravel (API + Admin), Next.js Dashboard, dan Next.js Website Publik yang terintegrasi melalui REST API dan Sanctum Authentication.</li><li>Modul <strong>Verifikasi Target</strong> dan <strong>Verifikasi Capaian</strong> dengan status workflow (draft, menunggu verifikasi, disetujui, perlu revisi), dilengkapi komentar verifikator dan audit trail.</li><li>Modul <strong>Manajemen Organisasi</strong> dan <strong>Manajemen Kontributor</strong> dengan fitur invitation via email, serta manajemen pengguna berbasis peran (role) dan permission granuler.</li><li><strong>Website Publik</strong> (Next.js), <strong>Dashboard Program Koalisi</strong> dengan chart Recharts, <strong>Leaderboard PPRK</strong>, dan endpoint iframe chart yang dapat di-embed publik.</li><li>Implementasi <strong>Audit Trail</strong> menggunakan <code>owen-it/laravel-auditing</code> pada model Target, Achievement, dan Organization.</li><li>Master data <strong>Provinsi</strong>, <strong>Kabupaten/Kota</strong>, <strong>Sektor Mitigasi</strong>, <strong>Program Pemerintah</strong>, dan <strong>Bidang Kerja</strong> sebagai referensi terpusat.</li></ul><h3>Tujuan Proyek</h3><ul><li>Membangun single source of truth untuk data program rendah karbon.</li><li>Menstandarisasi alur verifikasi target dan capaian.</li><li>Meningkatkan kolaborasi antar organisasi dalam koalisi.</li><li>Menyediakan transparansi publik melalui dashboard dan leaderboard.</li><li>Menjamin akuntabilitas dengan audit trail dan keamanan data.</li></ul><h3>Tech Stack</h3><p><strong>Backend:</strong> Laravel 11.31, PHP 8.2, Inertia Laravel 2.x, Laravel Sanctum 4.0, Laravel Socialite 5.16, Ziggy 2.5, Intervention Image 3.10, Spatie Image Optimizer 1.8, Maatwebsite Excel 3.1, Owen It Auditing 13.6, Doctrine DBAL 4.2.<br><strong>Frontend:</strong> Next.js 15.3, React 19, Tailwind CSS 3.4, shadcn/ui, Radix UI, Redux Toolkit 2.5, RTK Query, React Hook Form 7.62, Zod 3.25, Recharts 3.1, React Select 5.10, MDX Editor 3.21, Inertia.js, Vite.<br><strong>Database &amp; DevOps:</strong> MariaDB 11.3.2, Redis, Docker, Docker Compose, Nginx (WordOps), Traefik, GitHub Actions, Supervisor, Node.js 18/22, Bruno.</p><h3>Timeline</h3><p><strong>Periode:</strong> Juni 2025 – Oktober 2025 (~3,5 bulan)<br><strong>Fase:</strong> Setup &amp; Foundation → Core Backend APIs → Frontend Integration → QA &amp; Stabilization.</p></div>',
                'full_description_en' => null,
                'role' => 'System Analyst',
                'period' => '2025',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 5,
                'technologies' => ['Laravel', 'Next.js', 'React', 'Tailwind CSS', 'MariaDB', 'Redis', 'Docker', 'Recharts', 'Redux Toolkit', 'RTK Query', 'React Hook Form', 'Zod', 'Inertia.js'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'System Analyst'],
                ],
            ],
            [
                'title_id' => 'Sistem Informasi Sustainability (AASIS)',
                'title_en' => null,
                'type' => 'office',
                'company_name' => 'PT. Asuransi Astra Buana',
                'short_description_id' => 'Sistem pelaporan dan pengelolaan sustainability untuk keberlanjutan korporasi mencakup GHG Reduction, Renewable Energy Mix, Water Withdrawal, Waste Diverted, Lost Time Injury Rate, dan Community Development.',
                'short_description_en' => null,
                'full_description_id' => '<div><h3>Deskripsi Proyek</h3><p>AASIS (AAB Sustainability Information System) adalah sistem informasi berbasis web yang dibangun di atas framework Laravel 10 untuk mendukung pelaporan dan pengelolaan sustainability di lingkungan korporasi AAB. Sistem ini memiliki dua antarmuka utama: <strong>Frontend</strong> yang diakses oleh pengguna internal perusahaan untuk menginput data sustainability per kantor/instalasi, dan <strong>Backend/CMS</strong> yang digunakan oleh administrator untuk mengelola konfigurasi laporan, master data, pengguna, dan konten sistem.</p><p>Domain bisnis yang dilayani mencakup pengurangan emisi gas rumah kaca (GHG Reduction), pencampuran energi terbarukan (Renewable Energy Mix), penggunaan air (Water Withdrawal), pengalihan limbah (Waste Diverted), tingkat kecelakaan kerja (Lost Time Injury Rate), serta community development melalui pilar-pilar pendidikan, kewirausahaan, kesehatan, dan lingkungan. Sistem mendukung hierarki organisasi multi-level mulai dari kantor/instalasi, region, divisi, hingga tingkat korporat (konsolidasi).</p><h3>Permasalahan</h3><ul><li>Tidak terpusatnya data sustainability di berbagai kantor/instalasi AAB.</li><li>Kompleksitas alur persetujuan multi-level (Branch Manager → VP → Director → President Director).</li><li>Kebutuhan perhitungan konsolidasi yang kompleks dengan rumus spesifik per indikator.</li><li>Keterbatasan visibilitas dashboard real-time untuk manajemen.</li><li>Risiko keamanan dan integritas data yang menangani data sensitif perusahaan.</li><li>Ketergantungan pada proses manual dan email untuk reminder dan notifikasi.</li></ul><h3>Solusi yang Dibangun</h3><ul><li>Modul <strong>Laporan Sustainability Office</strong> untuk input data per kantor/instalasi, dan <strong>Laporan Sustainability Konsolidasi</strong> untuk penggabungan data korporat.</li><li>Modul <strong>Konfigurasi Approval</strong> dengan role-based approval dan <strong>Konfigurasi PIC</strong> per office/region.</li><li>Modul <strong>Konfigurasi Baseline</strong>, <strong>Konfigurasi Threshold</strong>, <strong>Konfigurasi Conversion Factor</strong>, dan <strong>Konfigurasi Index</strong> dengan perhitungan otomatis pada konsolidasi.</li><li><strong>Dashboard Sustainability</strong> dengan chart progress, quick analysis, global performance, peta sebaran community development, dan demografi company overview.</li><li>Implementasi validasi XSS/HTML tags, file type upload validation, <strong>Audit Trail</strong>, <strong>Login History</strong>, <strong>Login Suspend</strong>, dan penetration test remediation.</li><li><strong>Scheduled Task / Reminder</strong>, <strong>Job Queue</strong> untuk pengiriman email notifikasi via API/SMTP, dan <strong>Email Tester</strong>.</li></ul><h3>Tujuan Proyek</h3><ul><li>Sentralisasi pelaporan sustainability dari seluruh kantor/instalasi AAB.</li><li>Otomatisasi perhitungan dan konsolidasi untuk mengurangi kesalahan manual.</li><li>Peningkatan visibilitas manajemen melalui dashboard interaktif dengan visualisasi chart, peta, dan laporan final report.</li><li>Penguatan keamanan dan compliance melalui penetration test remediation, validasi input, kontrol akses berbasis role, dan audit trail.</li><li>Efisiensi proses approval dan notifikasi melalui sistem approval berjenjang dan notifikasi email otomatis.</li></ul><h3>Tech Stack</h3><p><strong>Backend:</strong> Laravel 10, PHP 8.1, Inertia Laravel 0.6.9, Livewire, Laravel Sanctum 3.3, Laravel UI 4.4, Maatwebsite Excel 3.1, Intervention Image 2.7, Spatie Image Optimizer 1.7, Spatie Laravel Sluggable 3.4, Mews Captcha 3.3, Rackbeat UI Avatars 1.1, Rap2hpoutre Log Viewer 2.2, Ziggy 1.6, Doctrine DBAL 3.3.<br><strong>Frontend:</strong> React 18.2, Inertia.js React 1.0.11, Bootstrap 4.6, jQuery 3.7, Sass 1.56, Swiper 10.3, date-fns 2.30.<br><strong>Database &amp; DevOps:</strong> MySQL, Laravel File Storage, Vite 4.4.9, Laravel Vite Plugin 0.7.8, Grunt 1.6.1, Grunt SVGStore 2.0.0, Patch Package 8.0.0, Laravel Pint 1.0, PHPUnit 10.1, Laravel Debugbar 3.6, Snyk.</p><h3>Timeline</h3><p><strong>Periode:</strong> Februari 2024 – Juli 2025 (~1,5 tahun)<br><strong>Fase:</strong> Setup &amp; Foundation → Core Configuration → Reporting Engine → Consolidation &amp; UAT → Security &amp; Stabilization.</p><h3>Catatan Arsitektur</h3><p>Sistem ini mengimplementasikan layer abstraksi CMS internal (<code>app/Api/</code>) yang sangat mirip dengan arsitektur WordPress, lengkap dengan sistem action/filter hook (Eventy), facades, dan service provider kustom. Pendekatan hibrida ini menggunakan Blade tradisional untuk sebagian besar backend dan beberapa frontend, serta Inertia.js + React untuk halaman-halaman tertentu.</p></div>',
                'full_description_en' => null,
                'role' => 'System Analyst',
                'period' => '2024 – 2025',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 6,
                'technologies' => ['Laravel', 'React', 'Inertia.js', 'MySQL', 'Bootstrap', 'Sass', 'Vite', 'Livewire', 'Maatwebsite Excel', 'Intervention Image'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'System Analyst'],
                ],
            ],
            [
                'title_id' => 'Sistem Manajemen Kepatuhan & Hukum (GCL-AAB)',
                'title_en' => null,
                'type' => 'office',
                'company_name' => 'PT. Asuransi Astra Buana',
                'short_description_id' => 'Sistem compliance management berbasis web yang mencakup lima modul utama: Compass Assessment, Legal Helpdesk, Licensing Monitoring, Report Monitoring, dan Regulation Management.',
                'short_description_en' => null,
                'full_description_id' => '<div><h3>Deskripsi Proyek</h3><p>GCL-AAB adalah sistem manajemen kepatuhan (compliance management) dan hukum berbasis web yang dibangun menggunakan framework Laravel 9.x. Pada Phase 1 hingga Phase 4, sistem ini dibangun dari nol mencakup fondasi CMS, infrastruktur UI, serta lima modul bisnis utama yang menjadi inti dari platform ini.</p><p>Sistem ini dirancang untuk membantu organisasi dalam mengelola seluruh aspek kepatuhan regulasi, penilaian risiko, pengelolaan dokumen hukum, pemantauan perizinan, serta pelaporan regulasi rutin. Dari struktur database yang terdiri dari lebih dari 221 migrasi, dapat disimpulkan bahwa sistem ini menangani domain bisnis yang sangat kompleks dengan banyak entitas yang saling berhubungan.</p><h3>Permasalahan</h3><ul><li>Fragmentasi pengelolaan dokumen hukum (NKB, OHK, PKS, SK, SP, SPK) tanpa platform terpusat.</li><li>Kurangnya transparansi kepatuhan departemen terhadap peraturan eksternal dan internal.</li><li>Kompleksitas proses penilaian kepatuhan (Compass Assessment) yang melibatkan asesi, asesor, dan koordinator.</li><li>Risiko kedaluwarsa dokumen perizinan tanpa sistem peringatan dini.</li><li>Keterlambatan pelaporan regulasi rutin karena tidak ada sistem reminder terintegrasi.</li><li>Kebutuhan audit trail dan keamanan terutama setelah temuan pentest.</li></ul><h3>Solusi yang Dibangun</h3><ul><li>Modul <strong>Legal Helpdesk</strong> dengan kontroler untuk NKB, OHK, PKS, SK, SP, SPK, fitur upload lampiran, pihak terkait, paraf checker, dan approval admin.</li><li>Modul <strong>Regulation Management</strong> dengan katalog peraturan eksternal/internal, penjabaran pasal ayat, implikasi peraturan, dan modul <strong>Compass Assessment</strong> untuk tracking pemenuhan.</li><li>Modul <strong>Compass Assessment</strong> dengan workflow: asesi mengisi → asesor review → koordinator approve, dilengkapi monitoring improvement, corrective action, dan threshold assessment.</li><li>Modul <strong>Licensing Monitoring</strong> dengan tracking dokumen perijinan, reminder expired via scheduled jobs, dan dashboard visualisasi.</li><li>Modul <strong>Report Monitoring</strong> dengan konfigurasi PIC per departemen, reminder laporan rutin, dan tracking status pemenuhan per periode.</li><li>Fitur <strong>AuditTrail</strong> pada model, middleware XSS validation, captcha, login history, user stamps (created_by/updated_by), dan remediasi hasil pentest.</li></ul><h3>Tujuan Proyek</h3><ul><li>Sentralisasi manajemen kepatuhan regulasi, dokumen hukum, dan perizinan dalam satu platform terintegrasi.</li><li>Otomatisasi workflow multi-level untuk penilaian, review, dan approval dengan notifikasi real-time.</li><li>Peningkatan visibilitas dan akuntabilitas melalui dashboard dan laporan transparan.</li><li>Pencegahan risiko regulasi melalui sistem reminder otomatis dan monitoring berkala.</li><li>Keamanan dan keterlacakan data melalui audit trail dan validasi input yang ketat.</li></ul><h3>Tech Stack</h3><p><strong>Backend:</strong> Laravel 9.19, PHP 8.0.2, Laravel UI 3.4, Laravel Sanctum 2.14.1, Livewire 2.10, Maatwebsite Excel 3.1, PhpWord 1.1, Intervention Image 2.7, Spatie Laravel Sluggable 3.4, Spatie Image Optimizer 1.7, Mews Captcha 3.3, Number to Words 2.7, Laravel Debugbar 3.6.<br><strong>Frontend:</strong> Vite 3.0.0, laravel-vite-plugin 0.7.1, Bootstrap 4.6.2, jQuery 3.7.0, Sass 1.94.2, Livewire 2.10, Simplebar 5.3.9, vite-plugin-static-copy 0.13.0.<br><strong>Database &amp; DevOps:</strong> MySQL, Redis, PHPUnit 9.5.10, StyleCI, patch-package 8.0.0, EditorConfig, Git.</p><h3>Timeline</h3><p><strong>Periode:</strong> Juni 2022 – Desember 2024 (~2,5 tahun)<br><strong>Fase:</strong> Foundation &amp; CMS Core → UI Framework &amp; API Infra → Major Module Development → Security Hardening.</p><h3>Catatan Arsitektur</h3><p>Aplikasi ini menggunakan arsitektur modular monolitik, di mana setiap modul bisnis utama diwakili oleh service provider tersendiri yang mendaftarkan repository pattern (interface + Eloquent implementation) dan capability authorization secara terpusat. Pola arsitektur ini memudahkan pemeliharaan dan penambahan modul baru.</p></div>',
                'full_description_en' => null,
                'role' => 'System Analyst',
                'period' => '2022 – 2024',
                'demo_url' => null,
                'repo_url' => null,
                'thumbnail' => null,
                'gallery' => null,
                'status' => 'publish',
                'sort_order' => 7,
                'technologies' => ['Laravel', 'Bootstrap', 'jQuery', 'Sass', 'Livewire', 'MySQL', 'Vite', 'PhpWord', 'Maatwebsite Excel', 'Intervention Image'],
                'members' => [
                    ['name' => 'Amrizal', 'role' => 'System Analyst'],
                ],
            ],
        ];

        foreach ($projects as $data) {
            $technologies = $data['technologies'] ?? [];
            $members = $data['members'] ?? [];
            unset($data['technologies'], $data['members']);

            $data['slug'] = Str::slug($data['title_id']);

            $project = Project::create($data);

            foreach ($technologies as $tech) {
                ProjectTechnology::create([
                    'project_id' => $project->id,
                    'technology_name' => $tech,
                ]);
            }

            foreach ($members as $index => $member) {
                ProjectMember::create([
                    'project_id' => $project->id,
                    'name' => $member['name'],
                    'role' => $member['role'] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
