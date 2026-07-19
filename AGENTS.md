# AGENTS.md

## Project Overview
CMS portofolio personal bilingual (ID/EN) untuk amrizal.nahar. Menggunakan arsitektur monolith Laravel dengan halaman publik (SSR) dan panel admin berbasis Livewire.

## Tech Stack
- **Bahasa**: PHP 8.3+, JavaScript, HTML, CSS
- **Framework**: Laravel 13.x, Livewire 3.6, Tailwind CSS 3.1/4.x (via Vite), Alpine.js
- **Tools & Package Utama**: Laravel Breeze (Auth), Spatie Laravel Permission (RBAC), PhpSpreadsheet, Trix Editor
- **Database**: MySQL (local) / SQLite (cloud/testing)

## Setup & Commands
Command berikut merupakan script composer yang valid di project ini:
- `composer setup`: Setup pertama kali (install, copy env, generate key, migrate, npm build).
- `composer dev`: Menjalankan dev server (server Laravel, Vite, queue listener, dan pail secara paralel).
- `composer deploy`: Menjalankan command deploy (migrate force dan cache).
- `composer test` atau `php artisan test`: Menjalankan seluruh test suite.
- `php artisan migrate:fresh --seed`: Reset database dan jalankan seeder (termasuk dummy data & super-admin).
- `vendor/bin/pint`: Menjalankan PHP linter (Pint).
- `npm run build` / `npm run dev`: Build atau watch aset frontend.

## Struktur Folder
- `app/`: Logic backend. Berisi Controller (`Http/Controllers/Public`), komponen Livewire (`Livewire/Admin/`), Models, Services, Traits, Helpers.
- `resources/`: Aset dan view. Berisi Blade view publik (`views/pages/`) dan admin (`views/livewire/admin/`), serta file lokalisasi bahasa (`lang/`).
- `database/`: Skema database (migrations) dan dummy data (seeders).
- `routes/`: Routing web. Terdapat grup rute publik dan grup rute admin (`routes/web.php`).
- `docs/`: Dokumentasi project seperti PRD dan design system. Folder/file yang perlu diabaikan: `vendor/`, `node_modules/`, `storage/`.

## Konvensi Kode
- **Admin & Livewire**: Komponen Livewire khusus admin berada di `app/Livewire/Admin/`. Routing admin diberi prefix `/admin` dan diproteksi dengan middleware `auth` dan pengecekan role/permission.
- **Lokalisasi Bilingual**: Kolom dwi-bahasa dipisah menjadi suffix `_id` (Indonesia) dan `_en` (Inggris). Model menggunakan trait `HasLocalizable` untuk mengambil terjemahan.
- **Traits Model**: Model utama umumnya mengimplementasikan soft delete dan memakai trait seperti `HasAuditTrail` (pencatatan log CUD), `HasSlug` (auto slug berdasarkan judul/nama), dan `HasLocalizable`.
- **Constraint Unik**: Validasi field unik pada fitur berskala polimorfik (seperti slug atau nama pada tabel categories/tags) mencakup komposisi `module_type` dan `deleted_at`.
- **Desain & UI**: Semua kustomisasi gaya di frontend harus menggunakan utility classes Tailwind dengan berpegang pada warna & token desain yang ada di `tailwind.config.js`.

## Larangan / Batasan
- **Migrasi**: Jangan pernah memodifikasi file migration yang sudah ada (telah di-deploy). Jika perlu ada perubahan skema database, buatlah file migration baru.
- **Security**: Data HTML yang diinput via editor Trix harus selalu dibersihkan (escape/strip_tags) saat di-render pada halaman publik, kecuali memang diharuskan secara spesifik.
- **Framework**: Hindari pagination standar dari server-side jika memungkinkan di halaman publik, karena filtering halaman publik sering kali dilakukan secara client-side menggunakan Alpine.js (`x-show`).
