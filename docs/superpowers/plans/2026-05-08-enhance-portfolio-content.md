# Enhance Portfolio Content Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Enhance konten HTML prototype untuk merepresentasikan branding "System Analyst & AI-Native Developer" dengan pendekatan Hybrid Narrative.

**Architecture:** Konten di 5 file HTML di folder `prototype/` diupdate tanpa mengubah struktur layout atau styling. Perubahan mencakup: copy hero, bio, deskripsi proyek, artikel blog, section baru "Workflow Saya", dan kategori keahlian baru.

**Tech Stack:** HTML statis dengan Tailwind CSS (CDN)

---

## File Structure

| File | Responsibility |
|------|---------------|
| `prototype/index.html` | Hero copy, Proyek Unggulan (3 card), Artikel Terbaru (3 card), CTA copy |
| `prototype/about.html` | Bio hero, deskripsi pengalaman kerja, section "Workflow Saya" (baru), keahlian (3 kategori) |
| `prototype/portfolio.html` | Grid proyek (3 card), grid sertifikat (tambah AI-related) |
| `prototype/blog.html` | Grid artikel (6 card) dengan kategori baru |
| `prototype/contact.html` | Copy ajakan kolaborasi |

---

### Task 1: Update Hero Copy di index.html

**Files:**
- Modify: `prototype/index.html:143-145`

- [ ] **Step 1: Replace subtitle hero**

Ganti paragraf hero dari:
```html
          <p class="mt-4 text-lg md:text-xl text-neutral-600 dark:text-neutral-300 max-w-xl mx-auto md:mx-0 text-balance">
            Menganalisis kebutuhan bisnis, merancang arsitektur sistem, dan membangunnya langsung dengan kode. Dari analisis sampai production — satu visi, satu eksekusi.
          </p>
```

Menjadi:
```html
          <p class="mt-4 text-lg md:text-xl text-neutral-600 dark:text-neutral-300 max-w-xl mx-auto md:mx-0 text-balance">
            Menganalisis kebutuhan bisnis, merancang arsitektur sistem, dan membangunnya langsung dengan kode — dipercepat dengan AI tools sehingga delivery lebih cepat tanpa mengorbankan kualitas.
          </p>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/index.html` di browser. Pastikan teks hero berubah dan menyebutkan "dipercepat dengan AI tools".

- [ ] **Step 3: Commit**

```bash
git add prototype/index.html
git commit -m "feat: update hero copy with AI-accelerated workflow message"
```

---

### Task 2: Update Proyek Unggulan di index.html — Proyek 1

**Files:**
- Modify: `prototype/index.html:180-197`

- [ ] **Step 1: Replace card proyek pertama**

Ganti card proyek pertama (Sistem Manajemen Inventori lama) dari:
```html
        <a href="portfolio-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
            </div>
            <div class="absolute top-3 left-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20 backdrop-blur-sm">PT. Digital Nusantara</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">Sistem Manajemen Inventori</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Aplikasi web untuk mengelola stok barang, pembelian, dan pelaporan secara real-time dengan dashboard analitik.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Vue.js</span>
            </div>
          </div>
        </a>
```

Menjadi:
```html
        <a href="portfolio-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
            </div>
            <div class="absolute top-3 left-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20 backdrop-blur-sm">PT. Digital Nusantara</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">Sistem ERP — Manajemen Inventori & Pengadaan</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Menganalisis alur bisnis inventory yang masih manual, merancang modul ERP dengan approval workflow 3-level, dan membangunnya langsung hingga production.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Vue.js</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">MySQL</span>
            </div>
          </div>
        </a>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/index.html` di browser, scroll ke Proyek Unggulan. Card pertama harus menampilkan judul "Sistem ERP — Manajemen Inventori & Pengadaan" dengan deskripsi yang menyebutkan analisis alur bisnis dan approval workflow.

- [ ] **Step 3: Commit**

```bash
git add prototype/index.html
git commit -m "feat: update featured project 1 - ERP inventory system"
```

---

### Task 3: Update Proyek Unggulan di index.html — Proyek 2 & 3

**Files:**
- Modify: `prototype/index.html:198-233`

- [ ] **Step 1: Replace card proyek kedua**

Ganti card proyek kedua dari:
```html
        <a href="portfolio-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="absolute top-3 left-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Pribadi</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">amrizal.me Personal Site</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Website portofolio pribadi dengan fitur bilingual, dark mode, dan manajemen konten via panel admin.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Tailwind CSS</span>
            </div>
          </div>
        </a>
```

Menjadi:
```html
        <a href="portfolio-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="absolute top-3 left-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Pribadi</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">Dashboard Internal — Sentralisasi Laporan</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Mengidentifikasi pain point tim operasional yang menghabiskan 2 hari/minggu menggabungkan laporan Excel, lalu merancang dan membangun dashboard terpusat dengan automated aggregation.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Livewire</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PostgreSQL</span>
            </div>
          </div>
        </a>
```

- [ ] **Step 2: Replace card proyek ketiga**

Ganti card proyek ketiga dari:
```html
        <a href="portfolio-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            </div>
            <div class="absolute top-3 left-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Pribadi</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">Task Manager CLI</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Aplikasi manajemen tugas berbasis terminal yang ringan dengan fitur prioritas dan deadline tracking.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Node.js</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">SQLite</span>
            </div>
          </div>
        </a>
```

Menjadi:
```html
        <a href="portfolio-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            </div>
            <div class="absolute top-3 left-3">
              <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Open Source</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">API Gateway Scaffold — Microservices Starter Kit</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Merancang dan membangun starter kit API Gateway reusable dengan JWT auth, rate limiting, dan OpenAPI docs untuk mempercepat setup proyek microservices.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Node.js</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Express</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Redis</span>
            </div>
          </div>
        </a>
```

- [ ] **Step 3: Verifikasi**

Buka `prototype/index.html` di browser. Kedua card baru harus menampilkan judul dan deskripsi yang sesuai.

- [ ] **Step 4: Commit**

```bash
git add prototype/index.html
git commit -m "feat: update featured projects 2 and 3 - dashboard and api gateway"
```

---

### Task 4: Update Artikel Terbaru di index.html

**Files:**
- Modify: `prototype/index.html:252-300`

- [ ] **Step 1: Replace ketiga artikel**

Ganti ketiga card artikel dengan artikel baru. Cari section `<!-- Latest Articles -->` dan ganti seluruh grid artikel (3 `<a>` card) dari yang ada menjadi:

```html
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Workflow</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">5 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Setup Cursor IDE untuk Laravel Development</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Konfigurasi Cursor dengan rules dan custom commands untuk scaffolding Laravel lebih cepat.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">7 Mei 2026</p>
          </div>
        </a>
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Case Study</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">8 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Dari Spreadsheet ke Dashboard: Redesign Laporan Operasional</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Breakdown proses analisis, perancangan data flow, dan development dashboard internal dengan Laravel.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">1 Mei 2026</p>
          </div>
        </a>
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Insight</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">6 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Kenapa System Analyst Perlu Bisa Coding di 2026</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Refleksi tentang perubahan peran System Analyst di era AI dan mengapa kemampuan eksekusi kode jadi krusial.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">20 April 2026</p>
          </div>
        </a>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/index.html` di browser, scroll ke Artikel Terbaru. Pastikan 3 artikel baru muncul dengan kategori Workflow, Case Study, dan Insight.

- [ ] **Step 3: Commit**

```bash
git add prototype/index.html
git commit -m "feat: update latest articles with AI workflow and case study themes"
```

---

### Task 5: Update CTA Copy di index.html

**Files:**
- Modify: `prototype/index.html:305-314`

- [ ] **Step 1: Replace copy CTA section**

Ganti dari:
```html
  <section class="py-16 md:py-24 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-600">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-white">Tertarik berkolaborasi?</h2>
      <p class="mt-4 text-lg text-white/80 text-balance">Saya terbuka untuk diskusi seputar analisis sistem, arsitektur aplikasi, atau pengembangan produk digital.</p>
      <div class="mt-8 flex flex-wrap justify-center gap-3">
        <a href="contact.html" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-primary-900 bg-white hover:bg-neutral-100 shadow-sm transition-all">Hubungi Saya</a>
        <a href="about.html" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white border border-white/30 hover:bg-white/10 transition-all">Pelajari Lebih Lanjut</a>
      </div>
    </div>
  </section>
```

Menjadi:
```html
  <section class="py-16 md:py-24 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-600">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-white">Tertarik berkolaborasi?</h2>
      <p class="mt-4 text-lg text-white/80 text-balance">Saya terbuka untuk diskusi seputar analisis sistem, perancangan arsitektur, atau development produk digital — dengan atau tanpa AI tools.</p>
      <div class="mt-8 flex flex-wrap justify-center gap-3">
        <a href="contact.html" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-primary-900 bg-white hover:bg-neutral-100 shadow-sm transition-all">Hubungi Saya</a>
        <a href="about.html" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white border border-white/30 hover:bg-white/10 transition-all">Pelajari Lebih Lanjut</a>
      </div>
    </div>
  </section>
```

- [ ] **Step 2: Verifikasi**

Pastikan CTA section menyebutkan "dengan atau tanpa AI tools".

- [ ] **Step 3: Commit**

```bash
git add prototype/index.html
git commit -m "feat: update CTA copy on homepage"
```

---

### Task 6: Update Bio Hero di about.html

**Files:**
- Modify: `prototype/about.html:139-150`

- [ ] **Step 1: Replace bio hero**

Ganti dari:
```html
        <div class="flex-1 text-center md:text-left">
          <h1 class="text-3xl md:text-5xl font-bold text-neutral-900 dark:text-white text-balance">Tentang Saya</h1>
          <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 leading-relaxed text-balance">
            Saya adalah System Analyst yang senang turun langsung ke kode. Dengan latar belakang menganalisis kebutuhan bisnis dan merancang arsitektur sistem, saya memastikan setiap solusi yang dibangun tidak hanya sesuai kebutuhan, tetapi juga scalable, maintainable, dan siap untuk production.
          </p>
          <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-3">
            <a href="#" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white bg-primary-600 hover:bg-primary-900 shadow-sm hover:shadow-md transition-all">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
              Download CV
            </a>
          </div>
        </div>
```

Menjadi:
```html
        <div class="flex-1 text-center md:text-left">
          <h1 class="text-3xl md:text-5xl font-bold text-neutral-900 dark:text-white text-balance">Tentang Saya</h1>
          <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 leading-relaxed text-balance">
            Saya adalah System Analyst yang tidak berhenti di dokumen. Setelah bertahun-tahun menganalisis kebutuhan bisnis dan merancang arsitektur sistem, saya mulai "turun ke kode" — langsung mengeksekusi solusi yang saya rancang. Dengan bantuan AI tools, saya bisa bergerak lebih cepat dari analisis ke production tanpa mengorbankan kualitas.
          </p>
          <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-3">
            <a href="#" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white bg-primary-600 hover:bg-primary-900 shadow-sm hover:shadow-md transition-all">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
              Download CV
            </a>
          </div>
        </div>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/about.html` di browser. Bio harus menyebutkan "tidak berhenti di dokumen", "turun ke kode", dan "AI tools".

- [ ] **Step 3: Commit**

```bash
git add prototype/about.html
git commit -m "feat: update about page bio with hybrid narrative"
```

---

### Task 7: Update Deskripsi Pengalaman Kerja di about.html

**Files:**
- Modify: `prototype/about.html:160-177`

- [ ] **Step 1: Update deskripsi pekerjaan pertama**

Ganti deskripsi di pekerjaan pertama dari:
```html
            <p class="text-sm text-neutral-600 dark:text-neutral-300 mt-3 leading-relaxed">Memimpin analisis kebutuhan dan perancangan arsitektur aplikasi ERP. Bertanggung jawab atas sistem desain, code review, dan deployment pipeline. Berkolaborasi langsung dengan stakeholders untuk menerjemahkan kebutuhan bisnis menjadi spesifikasi teknis yang actionable.</p>
```

Menjadi:
```html
            <p class="text-sm text-neutral-600 dark:text-neutral-300 mt-3 leading-relaxed">Memimpin analisis kebutuhan dan perancangan arsitektur aplikasi ERP, lalu langsung mengimplementasikan modul critical seperti inventory dan procurement. Menggunakan AI tools untuk mempercepat scaffolding dan code review. Bertanggung jawab end-to-end dari requirement gathering sampai deployment.</p>
```

- [ ] **Step 2: Update deskripsi pekerjaan kedua**

Ganti deskripsi di pekerjaan kedua dari:
```html
            <p class="text-sm text-neutral-600 dark:text-neutral-300 mt-3 leading-relaxed">Menganalisis alur bisnis fintech dan merancang sistem autentikasi serta payment gateway. Mengembangkan REST API dengan Laravel dan menyusun dokumentasi teknis untuk tim frontend.</p>
```

Menjadi:
```html
            <p class="text-sm text-neutral-600 dark:text-neutral-300 mt-3 leading-relaxed">Menganalisis alur bisnis fintech, merancang sistem autentikasi dan payment gateway, lalu langsung mengembangkan REST API dengan Laravel. Menyusun dokumentasi teknis dan memastikan alignment antara kebutuhan bisnis dengan implementasi kode.</p>
```

- [ ] **Step 3: Verifikasi**

Pastikan kedua deskripsi pekerjaan kini menekankan eksekusi kode (bukan cuma analisis).

- [ ] **Step 4: Commit**

```bash
git add prototype/about.html
git commit -m "feat: update experience descriptions to emphasize code execution"
```

---

### Task 8: Tambah Section "Workflow Saya" di about.html

**Files:**
- Modify: `prototype/about.html:180-181` (setelah penutup `</section>` pengalaman)

- [ ] **Step 1: Insert section baru setelah Experience**

Cari baris penutup section pengalaman:
```html
  </section>

  <!-- Education -->
```

Ganti menjadi:
```html
  </section>

  <!-- Workflow Saya -->
  <section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white mb-10">Workflow Saya</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
          <div class="w-12 h-12 rounded-lg bg-primary-600/10 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          </div>
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Discover</h3>
          <p class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">Wawancara stakeholder, dokumentasi requirement, dan user story mapping.</p>
          <div class="mt-4 flex flex-wrap gap-2">
            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Claude</span>
          </div>
        </div>
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="2">
          <div class="w-12 h-12 rounded-lg bg-primary-600/10 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.447-.894L15 7m0 13V7"></path></svg>
          </div>
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Design</h3>
          <p class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">ERD, flow diagram, arsitektur sistem, dan API contract design.</p>
          <div class="mt-4 flex flex-wrap gap-2">
            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Cursor</span>
            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Claude</span>
          </div>
        </div>
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="3">
          <div class="w-12 h-12 rounded-lg bg-primary-600/10 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
          </div>
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Build</h3>
          <p class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">Development, testing, dan code review dengan bantuan AI-assisted coding.</p>
          <div class="mt-4 flex flex-wrap gap-2">
            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Cursor</span>
            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Claude Code</span>
            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Copilot</span>
          </div>
        </div>
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
          <div class="w-12 h-12 rounded-lg bg-primary-600/10 flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
          </div>
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Deploy</h3>
          <p class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">CI/CD setup, dokumentasi, dan monitoring dengan AI-assisted configuration.</p>
          <div class="mt-4 flex flex-wrap gap-2">
            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Cursor</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Education -->
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/about.html` di browser. Pastikan section "Workflow Saya" muncul setelah Pengalaman Kerja dan sebelum Riwayat Pendidikan. Harus ada 4 card: Discover, Design, Build, Deploy.

- [ ] **Step 3: Commit**

```bash
git add prototype/about.html
git commit -m "feat: add Workflow Saya section to about page"
```

---

### Task 9: Update Keahlian — Tambah Kategori AI Tools di about.html

**Files:**
- Modify: `prototype/about.html:200-238`

- [ ] **Step 1: Ganti grid keahlian**

Ganti seluruh grid keahlian (3 card) dari:
```html
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Analisis & Perancangan</h3>
          <div class="flex flex-wrap gap-2">
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">System Analysis</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">UML / ERD</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">BPMN</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">User Story</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">API Design</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Database Design</span>
          </div>
        </div>
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="2">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Programming & Framework</h3>
          <div class="flex flex-wrap gap-2">
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PHP / Laravel</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">JavaScript</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Vue.js</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Tailwind CSS</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">MySQL</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PostgreSQL</span>
          </div>
        </div>
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="3">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Tools & Platforms</h3>
          <div class="flex flex-wrap gap-2">
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Docker</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Git / GitHub</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Figma</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Postman</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">AWS</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Linux</span>
          </div>
        </div>
      </div>
```

Menjadi:
```html
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Analisis & Perancangan</h3>
          <div class="flex flex-wrap gap-2">
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">System Analysis</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">UML / ERD</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">BPMN</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">User Story</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">API Design</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Database Design</span>
          </div>
        </div>
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="2">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Development Stack</h3>
          <div class="flex flex-wrap gap-2">
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PHP / Laravel</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">JavaScript</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Vue.js</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Tailwind CSS</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">MySQL</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PostgreSQL</span>
          </div>
        </div>
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="3">
          <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">AI Tools & Productivity</h3>
          <div class="flex flex-wrap gap-2">
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Cursor</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Claude Code</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">GitHub Copilot</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">v0</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">ChatGPT</span>
            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Prompt Engineering</span>
          </div>
        </div>
      </div>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/about.html` di browser, scroll ke Keahlian. Harus ada 3 kategori: "Analisis & Perancangan", "Development Stack", dan "AI Tools & Productivity".

- [ ] **Step 3: Commit**

```bash
git add prototype/about.html
git commit -m "feat: add AI Tools & Productivity skills category"
```

---

### Task 10: Update Grid Proyek di portfolio.html

**Files:**
- Modify: `prototype/portfolio.html:160-218`

- [ ] **Step 1: Replace ketiga card proyek**

Ganti ketiga `<article>` proyek di grid. Cari section `<!-- Projects Grid -->` dan ganti seluruh isi grid (3 `<article>`) menjadi:

```html
        <article class="card-animate group bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center"><svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg></div>
            <div class="absolute top-3 left-3"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20 backdrop-blur-sm">PT. Digital Nusantara</span></div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors"><a href="portfolio-detail.html" class="hover:underline">Sistem ERP — Manajemen Inventori & Pengadaan</a></h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Menganalisis alur bisnis inventory yang masih manual, merancang modul ERP dengan approval workflow 3-level, dan membangunnya langsung hingga production menggunakan Laravel dan Vue.js.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Vue.js</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">MySQL</span>
            </div>
            <div class="mt-5 flex items-center gap-3">
              <a href="portfolio-detail.html" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Detail</a>
              <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>Live Demo</a>
              <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>Repository</a>
            </div>
          </div>
        </article>

        <article class="card-animate group bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center"><svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
            <div class="absolute top-3 left-3"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Pribadi</span></div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors"><a href="portfolio-detail.html" class="hover:underline">Dashboard Internal — Sentralisasi Laporan</a></h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Mengidentifikasi pain point tim operasional yang menghabiskan 2 hari/minggu menggabungkan laporan Excel, lalu merancang dan membangun dashboard terpusat dengan automated data aggregation.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Livewire</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PostgreSQL</span>
            </div>
            <div class="mt-5 flex items-center gap-3">
              <a href="portfolio-detail.html" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Detail</a>
              <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>Live Demo</a>
              <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>Repository</a>
            </div>
          </div>
        </article>

        <article class="card-animate group bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
          <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="absolute inset-0 flex items-center justify-center"><svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg></div>
            <div class="absolute top-3 left-3"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Open Source</span></div>
          </div>
          <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors"><a href="portfolio-detail.html" class="hover:underline">API Gateway Scaffold — Microservices Starter Kit</a></h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Merancang dan membangun starter kit API Gateway reusable dengan JWT auth, rate limiting, dan OpenAPI docs untuk mempercepat setup proyek microservices.</p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Node.js</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Express</span>
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Redis</span>
            </div>
            <div class="mt-5 flex items-center gap-3">
              <a href="portfolio-detail.html" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Detail</a>
              <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>Repository</a>
            </div>
          </div>
        </article>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/portfolio.html` di browser. Pastikan 3 proyek baru muncul dengan badge yang benar (PT. Digital Nusantara, Pribadi, Open Source).

- [ ] **Step 3: Commit**

```bash
git add prototype/portfolio.html
git commit -m "feat: update portfolio projects with AI-accelerated workflow narrative"
```

---

### Task 11: Update Sertifikat di portfolio.html

**Files:**
- Modify: `prototype/portfolio.html:228-271`

- [ ] **Step 1: Ganti sertifikat Google UX menjadi AI Engineering**

Ganti card sertifikat ketiga (Google UX Design Certificate) dari:
```html
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-sm hover:shadow-md transition-all" data-delay="3">
          <div class="flex items-start gap-4">
            <div class="shrink-0 w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
            <div class="flex-1 min-w-0">
              <h3 class="text-base font-semibold text-neutral-900 dark:text-white">Google UX Design Certificate</h3>
              <p class="text-sm text-primary-600">Coursera / Google</p>
              <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">Diterbitkan: Januari 2024</p>
              <a href="#" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>Verifikasi</a>
            </div>
          </div>
        </div>
```

Menjadi:
```html
        <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-sm hover:shadow-md transition-all" data-delay="3">
          <div class="flex items-start gap-4">
            <div class="shrink-0 w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
            <div class="flex-1 min-w-0">
              <h3 class="text-base font-semibold text-neutral-900 dark:text-white">AI Engineering Fundamentals</h3>
              <p class="text-sm text-primary-600">DeepLearning.AI</p>
              <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">Diterbitkan: Januari 2026</p>
              <a href="#" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>Verifikasi</a>
            </div>
          </div>
        </div>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/portfolio.html` di browser, scroll ke Sertifikat. Pastikan ada sertifikat "AI Engineering Fundamentals".

- [ ] **Step 3: Commit**

```bash
git add prototype/portfolio.html
git commit -m "feat: add AI Engineering certificate to portfolio"
```

---

### Task 12: Update Artikel di blog.html

**Files:**
- Modify: `prototype/blog.html` (seluruh grid artikel)

- [ ] **Step 1: Replace seluruh grid artikel**

Cari section `<!-- Articles Grid -->` atau grid artikel di `blog.html`, lalu ganti seluruh grid (6 card artikel) menjadi:

```html
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Workflow</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">5 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Setup Cursor IDE untuk Laravel Development</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Konfigurasi Cursor dengan rules dan custom commands untuk scaffolding Laravel lebih cepat.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">7 Mei 2026</p>
          </div>
        </a>
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Workflow</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">6 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Dari Analisis ke Kode dalam 1 Hari dengan AI Tools</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Cara saya memanfaatkan Claude Code dan Cursor untuk mempercepat pipeline dari requirement ke prototype.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">5 Mei 2026</p>
          </div>
        </a>
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Tutorial</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">8 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Pattern Repository vs Service Layer di Laravel</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Kapan menggunakan Repository Pattern dan kapan cukup Service Layer untuk menjaga kode tetap bersih.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">28 April 2026</p>
          </div>
        </a>
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Case Study</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">10 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Cara Saya Merancang Database untuk ERP Inventory</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Dari analisis alur bisnis sampai ERD final: bagaimana saya memastikan struktur database mendukung approval workflow dan audit trail.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">15 April 2026</p>
          </div>
        </a>
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Tutorial</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">7 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Optimasi Query Laravel Eloquent untuk Data Besar</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Teknik eager loading, select specific columns, dan query caching untuk meningkatkan performa aplikasi Laravel.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">8 April 2026</p>
          </div>
        </a>
        <a href="blog-detail.html" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
          <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
            <div class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
          </div>
          <div class="p-6">
            <div class="flex items-center gap-2 mb-3">
              <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Insight</span>
              <span class="text-xs text-neutral-500 dark:text-neutral-400">6 menit baca</span>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Kenapa System Analyst Perlu Bisa Coding di 2026</h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Refleksi tentang perubahan peran System Analyst di era AI dan mengapa kemampuan eksekusi kode jadi krusial.</p>
            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">1 April 2026</p>
          </div>
        </a>
      </div>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/blog.html` di browser. Pastikan ada 6 artikel dengan kategori: Workflow (2), Tutorial (2), Case Study (1), Insight (1).

- [ ] **Step 3: Commit**

```bash
git add prototype/blog.html
git commit -m "feat: update blog articles with 4 content pillars"
```

---

### Task 13: Update Copy Kontak di contact.html

**Files:**
- Modify: `prototype/contact.html` (section hero/header kontak)

- [ ] **Step 1: Update heading dan deskripsi kontak**

Cari section header/hero di `contact.html` yang berisi heading "Kontak" dan paragraf penjelasan. Ganti menjadi narasi yang lebih spesifik. Contoh struktur yang dicari:
```html
      <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance">Kontak</h1>
      <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance">...
```

Ganti deskripsi menjadi:
```html
      <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance">Saya terbuka untuk diskusi seputar analisis sistem, perancangan arsitektur, atau pengembangan produk digital — baik untuk kolaborasi proyek maupun sekadar bertukar pikiran.</p>
```

- [ ] **Step 2: Verifikasi**

Buka `prototype/contact.html` di browser. Pastikan deskripsi kontak menyebutkan "analisis sistem, perancangan arsitektur, atau pengembangan produk digital".

- [ ] **Step 3: Commit**

```bash
git add prototype/contact.html
git commit -m "feat: update contact page copy with specific collaboration areas"
```

---

## Self-Review Checklist

### 1. Spec Coverage

| Spec Section | Task Implementasi |
|--------------|-------------------|
| Brand Voice & Messaging | Task 1, 5, 6 (hero, bio, experience) |
| Page Structure (index) | Task 1-5 |
| Page Structure (about) | Task 6-9 |
| Page Structure (portfolio) | Task 10-11 |
| Page Structure (blog) | Task 12 |
| Page Structure (contact) | Task 13 |
| 3 Konsep Proyek | Task 2-3 (index), Task 10 (portfolio) |
| Blog Pillars (4 pilar, 6 artikel) | Task 4 (index), Task 12 (blog) |
| Workflow Saya (4 fase) | Task 8 |
| Keahlian (3 kategori) | Task 9 |

**Gap:** Tidak ada. Semua requirement spec telah masuk ke dalam task.

### 2. Placeholder Scan

- Tidak ada TBD, TODO, atau "implement later".
- Semua langkah berisi kode HTML lengkap untuk replace.
- Semua path file lengkap dan eksak.

### 3. Type Consistency

- Nama class Tailwind konsisten dengan file existing.
- Struktur HTML card mengikuti pattern yang sudah ada.
- Badge kategori (Workflow, Tutorial, Case Study, Insight) konsisten.

---

## Execution Handoff

Setelah plan ini disetujui, implementasi bisa dilakukan dengan dua pendekatan:

1. **Subagent-Driven (disarankan)** — Dispatch subagent per task, review antar task, iterasi cepat.
2. **Inline Execution** — Eksekusi task dalam session ini secara berurutan dengan checkpoint review.

Pilihan terserah engineer yang akan mengeksekusi plan ini.
