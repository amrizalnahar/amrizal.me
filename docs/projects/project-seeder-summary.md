# Summary Mapping: 7 Proyek → ProjectSeeder

> Tanggal: 15 Mei 2026
> Tujuan: Mengkonversi 7 dokumen reverse engineering menjadi entri seeder `database/seeders/ProjectSeeder.php`
> Keterbatasan: Versi Indonesia (`*_id`) saja; field `_en` di-set `null`.

---

## Struktur Umum per Entri

| Field | Sumber Data | Catatan |
|---|---|---|
| `title_id` | Judul proyek yang dideskripsikan | Disesuaikan agar deskriptif |
| `title_en` | `null` | Hanya versi Indonesia |
| `slug` | Auto-generate dari `title_id` via `Str::slug()` | — |
| `type` | Hard-coded `'office'` | Semua proyek adalah proyek kantor |
| `company_name` | Nama klien/perusahaan | AAB = PT. Asuransi Astra Buana |
| `short_description_id` | Ringkasan 1–2 kalimat dari deskripsi proyek | Dibuat ringkas |
| `short_description_en` | `null` | — |
| `full_description_id` | HTML rangkuman lengkap | Merangkum deskripsi, masalah, solusi, tujuan, tech stack, timeline |
| `full_description_en` | `null` | — |
| `role` | Peran Amrizal di proyek | Ditarik dari konteks dokumen |
| `period` | Rentang waktu pengembangan | Dari Gantt chart / ringkasan fase |
| `demo_url` | `null` | Internal/private |
| `repo_url` | `null` | Internal/private |
| `thumbnail` | `null` | Tidak ada asset seed |
| `gallery` | `null` | Tidak ada asset seed |
| `status` | `'publish'` | Ditampilkan di portfolio |
| `sort_order` | 1 s/d 7 | Urutan kronologis terbalik (terbaru di atas) |
| `technologies` | Tech stack utama (backend + frontend + DB) | Diambil dari tabel tech stack per dokumen |
| `members` | Hanya Amrizal | Pola: `[['name' => 'Amrizal', 'role' => ...]]` |

---

## 1. AAB Career (Recruitment Management System)

| Field | Nilai |
|---|---|
| `title_id` | Sistem Rekrutmen Terpadu (AAB Career) |
| `company_name` | PT. Asuransi Astra Buana |
| `short_description_id` | Applicant Tracking System berbasis web untuk mengelola seluruh siklus hidup perekrutan mulai dari publikasi lowongan, pelacakan lamaran, pengelolaan profil pelamar, hingga penjadwalan Medical Check Up dan konfirmasi manfaat kerja. |
| `role` | Lead System Analyst |
| `period` | Apr 2024 – Okt 2025 |
| `sort_order` | 4 |
| `technologies` | Laravel, Next.js, React, PostgreSQL, Redis, Docker, Kubernetes, Redux Toolkit, RTK Query, React Hook Form, Zod, Recharts |
| `members` | Amrizal (Lead System Analyst) |

**Sumber konten:**
- Problem: Proses rekrutmen manual, tidak ada transparansi status, data pelamar tersebar, MCU tidak terintegrasi, kesulitan pelaporan, validasi data ketat.
- Solusi: Job Order & Application system, Applicant Tracking Status Pipeline, Form Data Pribadi (FDP) terstruktur 15+ tabel, MCU Scheduling, Export Excel, Capability-Based Authorization.
- Timeline: 18 Apr 2024 – 10 Okt 2025 (~1,5 tahun)

---

## 2. AASIS (AAB Sustainability Information System)

| Field | Nilai |
|---|---|
| `title_id` | Sistem Informasi Sustainability (AASIS) |
| `company_name` | PT. Asuransi Astra Buana |
| `short_description_id` | Sistem pelaporan dan pengelolaan sustainability untuk keberlanjutan korporasi mencakup GHG Reduction, Renewable Energy Mix, Water Withdrawal, Waste Diverted, Lost Time Injury Rate, dan Community Development. |
| `role` | System Analyst |
| `period` | Feb 2024 – Jul 2025 |
| `sort_order` | 6 |
| `technologies` | Laravel, React, Inertia.js, MySQL, Bootstrap, Sass, Vite, Livewire, Maatwebsite Excel, Intervention Image |
| `members` | Amrizal (System Analyst) |

**Sumber konten:**
- Problem: Data sustainability tersebar, approval multi-level kompleks, perhitungan konsolidasi rumit, tidak ada dashboard real-time, risiko keamanan, proses manual dan email.
- Solusi: Laporan Sustainability Office & Konsolidasi, Konfigurasi PIC & Approval Multi-Level, Konfigurasi Baseline & Threshold, Dashboard dengan Map & Chart, Audit Trail, Scheduled Task/Reminder, Active Directory Integration.
- Timeline: 01 Feb 2024 – 14 Jul 2025 (~1,5 tahun)

---

## 3. GCL-AAB Phase 1–4 (Compliance & Legal Management)

| Field | Nilai |
|---|---|
| `title_id` | Sistem Manajemen Kepatuhan & Hukum (GCL-AAB) Phase 1–4 |
| `company_name` | PT. Asuransi Astra Buana |
| `short_description_id` | Sistem compliance management berbasis web yang mencakup lima modul utama: Compass Assessment, Legal Helpdesk, Licensing Monitoring, Report Monitoring, dan Regulation Management. |
| `role` | System Analyst |
| `period` | Jun 2022 – Des 2024 |
| `sort_order` | 7 |
| `technologies` | Laravel, Bootstrap, jQuery, Sass, Livewire, MySQL, Vite, PhpWord, Maatwebsite Excel, Intervention Image |
| `members` | Amrizal (System Analyst) |

**Sumber konten:**
- Problem: Fragmentasi dokumen hukum, kurangnya transparansi kepatuhan regulasi, kompleksitas penilaian dan review, risiko kedaluwarsa perizinan, keterlambatan pelaporan regulasi, kebutuhan audit trail.
- Solusi: Legal Helpdesk (NKB, OHK, PKS, SK, SP, SPK), Compass Assessment workflow, Licensing Monitoring dengan reminder expired, Report Monitoring dengan PIC per departemen, Regulation Management, AuditTrail, XSS hardening.
- Timeline: 17 Jun 2022 – 31 Des 2024 (~2,5 tahun)

---

## 4. GCL-AAB Phase 5–6 (Enhancement Major)

| Field | Nilai |
|---|---|
| `title_id` | Enhancement Sistem Kepatuhan (GCL-AAB) Phase 5–6 |
| `company_name` | PT. Asuransi Astra Buana |
| `short_description_id` | Enhancement major sistem GCL-AAB dengan integrasi Typesense sebagai search engine, dukungan multi-tenant untuk Regulation Management, migrasi rich text editor ke TinyMCE, dan production hardening menjelang go-live stabil. |
| `role` | System Analyst |
| `period` | Jan 2025 – Mar 2026 |
| `sort_order` | 3 |
| `technologies` | Laravel, Typesense, Laravel Scout, TinyMCE, MySQL, Sass, Vite, Laravel Queue |
| `members` | Amrizal (System Analyst) |

**Sumber konten:**
- Problem: Pencarian dokumen tidak efisien, kebutuhan multi-tenant, performance notifikasi menurun, keterbatasan Summernote, banyak catatan UAT, standar keamanan perlu ditingkatkan.
- Solusi: Typesense full-text search dengan typo-tolerance & highlight, Regulation Management Multi-Tenant, queue-based notification, TinyMCE migration, UAT fixes massal, XSS final hardening.
- Timeline: 01 Jan 2025 – 05 Mar 2026 (~1 tahun)

---

## 5. PMIS-RGB-Next (Program Rendah Karbon)

| Field | Nilai |
|---|---|
| `title_id` | Sistem Monitoring Program Rendah Karbon (PMIS-RGB-Next) |
| `company_name` | Koalisi PPRK Indonesia |
| `short_description_id` | Sistem informasi dan monitoring program rendah karbon (PPRK) yang menyediakan platform terpusat untuk pengelolaan data program, penetapan target, pelaporan capaian, verifikasi dua tingkat, serta transparansi publik melalui website dan dashboard analitik. |
| `role` | System Analyst |
| `period` | Jun 2025 – Okt 2025 |
| `sort_order` | 5 |
| `technologies` | Laravel, Next.js, React, Tailwind CSS, MariaDB, Redis, Docker, Recharts, Redux Toolkit, RTK Query, React Hook Form, Zod, Inertia.js |
| `members` | Amrizal (System Analyst) |

**Sumber konten:**
- Problem: Tidak ada sistem terpusat PPRK, verifikasi tidak terstruktur, kesulitan manajemen multi-organisasi & multi-peran, kurangnya transparansi publik, risiko integritas data tanpa audit trail, kompleksitas data spasial & sektor mitigasi.
- Solusi: Monorepo (Backend Laravel + Next.js Dashboard + Next.js Public Website), Verifikasi Target & Capaian workflow, Manajemen Organisasi & Kontributor dengan invitation, Website Publik dengan Leaderboard & Chart, Audit Trail, master data spasial & sektor mitigasi.
- Timeline: 26 Jun 2025 – 02 Okt 2025 (~3 bulan)

---

## 7. G-Astrafinancial / G-Asfin (Risk & Compliance Konglomerasi)

| Field | Nilai |
|---|---|
| `title_id` | Sistem Tata Kelola Risiko Konglomerasi Keuangan (G-Asfin) |
| `company_name` | Astra Financial (Sedaya Multi Investama) |
| `short_description_id` | Aplikasi enterprise berskala besar untuk pengelolaan risiko, compliance, dan pelaporan regulasi OJK bagi konglomerasi keuangan Astra Financial dengan arsitektur microservices modular mencakup 49 modul independen. |
| `role` | System Analyst |
| `period` | Okt 2019 – Apr 2026 |
| `sort_order` | 2 |
| `technologies` | Laravel, Vue.js, jQuery, Bootstrap, MySQL, Elasticsearch, Redis, DOMPDF, Maatwebsite Excel, Intervention Image, Laravel Mix |
| `members` | Amrizal (System Analyst) |

**Sumber konten:**
- Problem: Fragmentasi data antar entitas anggota, kompleksitas pelaporan regulasi OJK, koordinasi risk management tidak terintegrasi, approval workflow multi-level kompleks, kepatuhan APU dan PPT, keterlambatan laporan konsolidasi.
- Solusi: Arsitektur Multi-Tenant 49 modul, Laporan OJK terstruktur, Integrated Risk Management, KPMM & Stress Testing, Approval Workflow KKA dengan notifikasi, Penilaian APU/PPT & Anti Fraud, engine konsolidasi real-time dengan export PDF/Excel/DOC.
- Timeline: 24 Okt 2019 – 27 Apr 2026 (~6,5 tahun)

---

## 6. Inventory Importa (Product Catalog Management)

| Field | Nilai |
|---|---|
| `title_id` | Sistem Manajemen Katalog Produk (Inventory Importa) |
| `company_name` | Importa |
| `short_description_id` | Backend aplikasi untuk pengelolaan data produk sebagai single source of truth yang mendukung produk simple & variable dengan variant SKU, bulk import/export Excel, serta sinkronisasi otomatis ke website WordPress/WooCommerce. |
| `role` | System Analyst |
| `period` | Mar 2026 – Mei 2026 |
| `sort_order` | 1 |
| `technologies` | Laravel, Vue.js, MariaDB, Bootstrap, Sass, Vite, Docker, Livewire, Maatwebsite Excel, Intervention Image |
| `members` | Amrizal (System Analyst) |

**Sumber konten:**
- Problem: Manajemen katalog tersebar dan tidak terstruktur, update katalog manual di WordPress lambat & berisiko error, tidak ada RBAC, kurangnya audit trail, tidak ada bulk operation, sinkronisasi tidak terintegrasi.
- Solusi: CRUD Product dengan variant system, Import/Export Excel/CSV, Sync ke WordPress via Public API dengan acknowledgement per SKU, Group-Based Permission RBAC, Audit Trail & Stock History, Public Sync API dengan API key & domain allowlist.
- Timeline: 30 Mar 2026 – 08 Mei 2026 (~1,5 bulan)

---

## Catatan Implementasi Seeder

1. **`full_description_id`** diformat sebagai HTML `<div>` dengan heading `<h3>` dan paragraf/list, kompatibel dengan Trix Editor.
2. **Tech Stack** disaring hanya teknologi utama (framework, bahasa, DB, tools penting) untuk menjaga keterbacaan.
3. **Semua `*_en`** dan **URL demo/repo** di-set `null` karena bersifat internal/private dan user meminta versi Indonesia saja.
4. **Thumbnail & gallery** di-set `null` karena tidak ada asset seed yang disediakan.
5. **Sort order** diurutkan dari proyek terbaru (1) ke terlama (7), sehingga di portfolio yang terbaru muncul di atas.
6. **G-Asfin** adalah proyek dengan durasi terpanjang (~6,5 tahun) dan menggunakan Laravel 5.5 + PHP 7.x (legacy stack) dengan arsitektur custom Aksara microservices modular.
