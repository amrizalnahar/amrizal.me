# Design Spec: Enhance Konten Prototipe HTML Branding Portfolio

**Tanggal:** 2026-05-08
**Topik:** Branding Portfolio — System Analyst & AI-Native Developer
**Pendekatan:** Hybrid Narrative (Story-driven + Workflow-transparent)

---

## 1. Tujuan

Mengubah konten prototipe HTML yang masih generik menjadi konten yang merepresentasikan personal branding:

> **System Analyst yang menggunakan AI tools untuk mempercepat development, mampu menangani seluruh pipeline dari perencanaan bisnis, perancangan arsitektur, sampai eksekusi kode.**

AI di sini adalah **accelerator di workflow**, bukan fitur produk.

---

## 2. Brand Voice & Messaging

### Core Narrative
> "System Analyst yang tidak berhenti di dokumen. Saya menganalisis kebutuhan bisnis, merancang arsitektur, lalu langsung mengeksekusi ke kode — semuanya dipercepat dengan AI tools sehingga delivery lebih cepat tanpa mengorbankan kualitas."

### Tagline Hero
**"Analisis sistem. Rancang arsitektur. Bangun dengan kode."**

Dengan sub-narasi baru tentang AI-accelerated workflow di beberapa section.

### Key Messages
1. **Hybrid Identity** — Analyst yang bisa coding (bukan programmer yang belajar analisis, tapi sebaliknya).
2. **AI as Multiplier** — AI tools bukan pengganti skill, tapi *force multiplier* untuk analisis dan development.
3. **End-to-End Ownership** — Dari requirement gathering sampai deployment, satu orang satu visi.

### Tone
Profesional tapi conversational. Tidak jargon-berlebihan. Transparan soal penggunaan AI (bukan ditutup-tutupi).

---

## 3. Page-by-Page Content Structure

### 3.1 Beranda (index.html)

| Section | Perubahan |
|---------|-----------|
| Hero | Copy diperbarui: tagline + one-liner yang menyebutkan AI-accelerated workflow. CTA tetap: "Lihat Portofolio" dan "Tentang Saya". |
| Proyek Unggulan | 3 proyek baru yang lebih relevan (lihat Bagian 4). Masing-masing punya badge klien/pribadi + tag tech stack. |
| Artikel Terbaru | 3 artikel dengan tema AI-assisted development & system analysis. |
| CTA | Sama, ajakan kolaborasi yang lebih spesifik. |

### 3.2 Tentang Saya (about.html)

| Section | Perubahan |
|---------|-----------|
| Hero | Bio diperpanjang. Ceritakan journey dari System Analyst yang mulai "turun ke kode" dan bagaimana AI tools mempercepat transisi tersebut. |
| Pengalaman Kerja | Dipertahankan, tapi deskripsi pekerjaan disesuaikan untuk menonjolkan *execution* bukan cuma *analysis*. |
| **Workflow Saya** | **Section baru** setelah pengalaman. Menampilkan 4-step pipeline dengan icon dan keterangan AI tools yang dipakai di masing-masing fase. |
| Keahlian | 3 kategori diperbarui: (1) Analisis & Perancangan, (2) Development Stack, (3) **AI Tools & Productivity** — baru. |
| Riwayat Pendidikan | Tetap. |

### 3.3 Portofolio (portfolio.html)

| Section | Perubahan |
|---------|-----------|
| Filter | Tetap (Semua / Proyek / Sertifikat). |
| Proyek | 3 proyek baru dengan narasi masalah→solusi yang lebih kuat. Masing-masing punya link Detail, Live Demo, dan Repository. |
| Sertifikat | Ditambahkan sertifikat AI/workflow-related. |

### 3.4 Blog (blog.html)

| Section | Perubahan |
|---------|-----------|
| Kategori | Tutorial, Insight, Case Study, Workflow. |
| Artikel | 6 artikel placeholder dengan tema seputar AI-assisted development, Laravel tips, system design. |

### 3.5 Kontak (contact.html)

| Section | Perubahan |
|---------|-----------|
| Copy | Ajakan kolaborasi yang lebih spesifik: analisis sistem, arsitektur, atau development. |

---

## 4. Konsep Proyek Portofolio

### Proyek 1: Sistem ERP — Manajemen Inventori & Pengadaan
- **Klien:** PT. Digital Nusantara (company project)
- **Masalah:** Perusahaan masih mengelola stok dan pengadaan barang via spreadsheet, menyebabkan *stockout* berulang dan sulitnya tracking approval multi-departemen.
- **Solusi:** Modul ERP web-based dengan fitur real-time stock tracking, approval workflow 3-level, dan dashboard analitik pengadaan.
- **Peran:** Analisis alur bisnis, perancangan database & API, development full-stack.
- **Tech Stack:** Laravel, Vue.js, MySQL, Tailwind CSS.
- **AI Tools:** Cursor untuk scaffolding modul CRUD dan API endpoints; Claude untuk merapikan business logic approval workflow.
- **Link:** Detail, Live Demo, Repository.

### Proyek 2: Dashboard Internal — Sentralisasi Laporan Operasional
- **Klien:** Pribadi / Freelance
- **Masalah:** Tim operasional menghabiskan 2 hari/minggu untuk menggabungkan laporan dari 4 sumber data berbeda ke Excel, rentan human error.
- **Solusi:** Dashboard terpusat dengan automated data aggregation, visualisasi chart interaktif, dan export laporan terjadwal.
- **Peran:** Identifikasi pain point, perancangan data flow, development & deployment.
- **Tech Stack:** Laravel, Livewire, PostgreSQL, Chart.js, Tailwind CSS.
- **AI Tools:** Claude Code untuk rapid prototyping dashboard; Cursor untuk generate query kompleks dan scheduled jobs.
- **Link:** Detail, Live Demo, Repository.

### Proyek 3: API Gateway Scaffold — Microservices Starter Kit
- **Klien:** Pribadi (open source)
- **Masalah:** Setiap kali memulai proyek microservices, tim menghabiskan waktu 1-2 minggu hanya untuk setup autentikasi, logging, rate limiting, dan API documentation yang konsisten.
- **Solusi:** Starter kit / template API Gateway yang reusable dengan JWT auth, centralized logging, rate limiter, dan auto-generated OpenAPI docs.
- **Peran:** Perancangan arsitektur gateway, development core modules, dokumentasi.
- **Tech Stack:** Node.js, Express, Redis, Docker, Swagger.
- **AI Tools:** Cursor untuk generate boilerplate middleware dan Docker config; Claude untuk merancang struktur folder dan pola arsitektur yang scalable.
- **Link:** Detail, Repository.

---

## 5. Blog Content Pillars

### 5.1 4 Pilar Konten

| Pilar | Fokus | Contoh Topik |
|-------|-------|--------------|
| **Workflow** | Sharing cara pakai AI tools di development | "Setup Cursor + Laravel untuk Development Cepat" |
| **Tutorial** | Teknis seputar stack utama | "Pattern Repository di Laravel" |
| **Case Study** | Breakdown proyek dari analisis sampai solusi | "Dari Spreadsheet ke Dashboard: Redesign Laporan Operasional" |
| **Insight** | Opini/refleksi peran System Analyst di era AI | "Apakah AI Tools Menggantikan System Analyst?" |

### 5.2 Artikel Placeholder (6 artikel)

1. "Setup Cursor IDE untuk Laravel Development" — Workflow
2. "Dari Analisis ke Kode dalam 1 Hari dengan AI Tools" — Workflow
3. "Pattern Repository vs Service Layer di Laravel" — Tutorial
4. "Cara Saya Merancang Database untuk ERP Inventory" — Case Study
5. "Optimasi Query Laravel Eloquent untuk Data Besar" — Tutorial
6. "Kenapa System Analyst Perlu Bisa Coding di 2026" — Insight

---

## 6. Section Baru: Workflow Saya (di About)

Section baru yang menampilkan 4 fase pipeline development:

| Fase | Kegiatan | AI Tools |
|------|----------|----------|
| **Discover** | Wawancara stakeholder, dokumentasi requirement, user story mapping | Claude untuk merapikan dan strukturkan catatan |
| **Design** | ERD, flow diagram, arsitektur sistem, API contract | Cursor + Claude untuk generate diagram dan spec |
| **Build** | Development, testing, code review | Cursor, Claude Code, GitHub Copilot |
| **Deploy** | CI/CD, dokumentasi, monitoring | AI-assisted Docker config & pipeline setup |

Tampilan: card horizontal dengan icon, deskripsi singkat, dan badge AI tools.

---

## 7. Keahlian — Struktur Baru

### Kategori 1: Analisis & Perancangan
System Analysis, UML / ERD, BPMN, User Story, API Design, Database Design

### Kategori 2: Development Stack
PHP / Laravel, JavaScript, Vue.js, Tailwind CSS, MySQL, PostgreSQL

### Kategori 3: AI Tools & Productivity *(Baru)*
Cursor, Claude Code, GitHub Copilot, v0, ChatGPT, Prompt Engineering

---

## 8. Deliverable

Enhance konten pada file-file berikut di folder `prototype/`:
- `index.html` — Hero copy, Proyek Unggulan, Artikel Terbaru
- `about.html` — Bio, Workflow Saya, Keahlian (tambah kategori AI Tools)
- `portfolio.html` — 3 Proyek baru, Sertifikat baru
- `portfolio-detail.html` — Detail konten proyek baru (out of scope untuk iterasi pertama, bisa ditambahkan setelahnya)
- `blog.html` — Artikel placeholder baru dengan kategori
- `blog-detail.html` — Detail konten artikel baru (out of scope untuk iterasi pertama)
- `contact.html` — Copy ajakan kolaborasi

Tidak ada perubahan struktur layout atau styling — hanya **konten dan copy** yang diupdate.
