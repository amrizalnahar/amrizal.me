# Product Requirement Document — amrizal.me

> **Version:** 1.0
> **Date:** 2026-05-08
> **Status:** Draft
> **Scope:** Full-stack implementation dari prototipe HTML ke aplikasi Laravel production-ready

---

## 1. Ringkasan Produk

**amrizal.me** adalah website profil pribadi bilingual (ID/EN) yang memposisikan Amrizal sebagai *System Analyst & AI-Native Developer*. Website ini terdiri dari:

- **Frontend Publik** — 6 halaman utama (Beranda, Tentang Saya, Portofolio, Blog, Kontak, 404)
- **Panel Admin** — Dashboard + CRUD untuk semua konten dan konfigurasi
- **Prototype HTML** sudah tersedia di `/prototype/` dengan 8 file HTML dan 14 komponen reusable di `/prototype/components/`

**Goal:** Implementasi ke Laravel + Blade dengan panel admin berbasis Filament, mengambil prototipe HTML sebagai referensi visual dan interaksi final.

---

## 2. User Stories

User stories lengkap tersedia di:
- **Frontend:** `docs/user-stories-fe.md` — 20 user stories untuk Visitor
- **Backend:** `docs/user-stories-be.md` — 14 user stories untuk Admin

### 2.1 Ringkasan Modul

| Modul | FE Stories | BE Stories | Priority |
|---|---|---|---|
| Beranda | US-01, US-16, US-18 | — | P0 |
| Tentang Saya | US-02 ~ US-06 | BE-03 ~ BE-06 | P0 |
| Portofolio | US-07 ~ US-09, US-08a, US-08b | BE-07 ~ BE-08 | P0 |
| Blog | US-10 ~ US-12 | BE-09 ~ BE-11 | P0 |
| Kontak | US-13, US-13a | BE-12 | P0 |
| General | US-14, US-15, US-17, US-19, US-20 | BE-13 ~ BE-14 | P0 |
| Autentikasi & Dashboard | — | BE-01 ~ BE-02 | P0 |

---

## 3. Arsitektur Teknologi

### 3.1 Stack

| Layer | Teknologi | Keterangan |
|---|---|---|
| Framework | Laravel 12.x | PHP 8.3+ |
| Frontend | Blade + Tailwind CSS v4 | Komponen dari prototipe dipindahkan ke `resources/views/components/` |
| Admin Panel | FilamentPHP 3.x | Panel admin dengan CRUD, rich text editor, file upload |
| Database | SQLite (dev) / MySQL (prod) | Bilingual fields, soft deletes, sluggable |
| CSS | Tailwind CSS CDN → build | Prototipe pakai CDN; produksi pakai build dengan custom colors |
| Icons | Heroicons (SVG inline) | Sudah digunakan di prototipe |
| Font | Plus Jakarta Sans | Google Fonts, sudah di prototipe |
| Animasi | CSS + Vanilla JS | Noise overlay, cursor, stagger, scroll progress, page transitions |
| SEO | spatie/laravel-sitemap | Sitemap XML otomatis |
| RSS | Custom | RSS feed untuk blog |

### 3.2 Struktur Direktori (Referensi Prototipe)

```
resources/views/
├── layouts/
│   └── app.blade.php          ← dari prototype/components/layout.html
├── components/
│   ├── head.blade.php         ← dari prototype/components/head.html
│   ├── navbar.blade.php       ← dari prototype/components/navbar.html
│   ├── mobile-drawer.blade.php
│   ├── footer.blade.php
│   ├── global-ui.blade.php    ← noise, cursor, scroll-progress, back-to-top
│   ├── scripts.blade.php      ← shared JS
│   ├── section-header.blade.php
│   ├── portfolio-card.blade.php
│   ├── blog-card.blade.php
│   ├── certificate-card.blade.php
│   ├── share-buttons.blade.php
│   ├── filter-bar.blade.php
│   └── tag-badge.blade.php
├── pages/                       ← atau langsung di views/
│   ├── home.blade.php
│   ├── about.blade.php
│   ├── portfolio/index.blade.php
│   ├── portfolio/show.blade.php
│   ├── blog/index.blade.php
│   ├── blog/show.blade.php
│   ├── contact.blade.php
│   └── errors/404.blade.php
```

---

## 4. Fitur Bilingual (ID/EN)

### 4.1 Konvensi Field

Setiap konten yang ditampilkan ke publik memiliki pasangan field:

| Field Indonesia | Field Inggris | Aturan |
|---|---|---|
| `*_id` (wajib) | `*_en` (opsional) | Jika `_en` kosong, frontend fallback ke `_id` |
| `title_id` | `title_en` | Judul artikel, proyek, kategori |
| `summary_id` | `summary_en` | Ringkasan eksekutif, deskripsi singkat |
| `content_id` | `content_en` | Konten lengkap (HTML dari rich text editor) |
| `description_id` | `description_en` | Deskripsi meta, pengalaman kerja |
| `name_id` | `name_en` | Nama kategori, tag, skill |

### 4.2 Implementasi

```php
// Helper global atau trait
function localized($model, string $field): string {
    $locale = app()->getLocale(); // 'id' atau 'en'
    $key = "{$field}_{$locale}";
    return $model->$key ?: $model->"{$field}_id";
}
```

### 4.3 Switcher Bahasa

- Toggle di navbar (sudah ada di prototipe)
- Disimpan di `localStorage` (frontend) + `session` atau `cookie` (backend)
- URL tidak berubah saat ganti bahasa
- Default: deteksi dari `Accept-Language` header, fallback ke `id`

---

## 5. Database Schema

### 5.1 Tabel Utama

#### `settings` — Pengaturan Umum (BE-13)
```sql
id | key (varchar, unique) | value_id (text) | value_en (text) | type (string/number/boolean/file) | created_at | updated_at
```

Key yang disimpan:
- `site_title`, `meta_description`, `contact_email`, `contact_whatsapp`
- `github_url`, `linkedin_url`, `location`
- `default_language`, `default_theme`
- `favicon`, `og_image`

#### `users` — Admin (BE-01)
```sql
id | name | email | password | remember_token | created_at | updated_at
```

#### `profiles` — Ringkasan Profil (BE-03)
```sql
id | summary_id (text) | summary_en (text, nullable)
    | cv_id (string, path) | cv_en (string, path, nullable)
    | photo (string, path)
    | created_at | updated_at
```

#### `experiences` — Pengalaman Kerja (BE-04)
```sql
id | company_name | logo (string, path, nullable)
    | position | description_id (text) | description_en (text, nullable)
    | started_at (date) | ended_at (date, nullable) | is_current (boolean)
    | sort_order (integer) | created_at | updated_at
```

#### `educations` — Riwayat Pendidikan (BE-05)
```sql
id | institution_name | logo (string, path, nullable)
    | degree (enum: SMA, D3, S1, S2, S3)
    | major_id (string) | major_en (string, nullable)
    | started_at (year) | ended_at (year, nullable)
    | sort_order (integer) | created_at | updated_at
```

#### `skill_categories` — Kategori Skill (BE-06)
```sql
id | name_id (string) | name_en (string, nullable)
    | sort_order (integer) | created_at | updated_at
```

#### `skills` — Skill Individu (BE-06)
```sql
id | skill_category_id (FK) | name_id (string) | name_en (string, nullable)
    | created_at | updated_at
```

#### `projects` — Proyek Portofolio (BE-07)
```sql
id | title_id (string) | title_en (string, nullable) | slug (string, unique)
    | type (enum: personal, office) | company_name (string, nullable)
    | short_description_id (text) | short_description_en (text, nullable)
    | full_description_id (longtext) | full_description_en (longtext, nullable)
    | role (string) | period (string)
    | demo_url (string, nullable) | repo_url (string, nullable)
    | thumbnail (string, path) | gallery (json, array of paths)
    | status (enum: publish, draft) | sort_order (integer)
    | created_at | updated_at | deleted_at (soft delete)
```

#### `project_technologies` — Pivot: Proyek ↔ Tag Teknologi
```sql
id | project_id (FK) | technology_name (string)
```

#### `certificates` — Sertifikat & Lisensi (BE-08)
```sql
id | title_id (string) | title_en (string, nullable)
    | issuer_name | issuer_logo (string, path, nullable)
    | description_id (text) | description_en (text, nullable)
    | issued_at (date) | expired_at (date, nullable)
    | verify_url (string, nullable) | certificate_image (string, path, nullable)
    | status (enum: publish, draft) | sort_order (integer)
    | created_at | updated_at
```

#### `blog_categories` — Kategori Blog (BE-09)
```sql
id | name_id (string) | name_en (string, nullable)
    | slug (string, unique) | description_id (text, nullable) | description_en (text, nullable)
    | created_at | updated_at
```

#### `blog_tags` — Tag Blog (BE-10)
```sql
id | name_id (string) | name_en (string, nullable)
    | slug (string, unique) | created_at | updated_at
```

#### `blog_posts` — Artikel Blog (BE-11)
```sql
id | title_id (string) | title_en (string, nullable) | slug (string, unique)
    | summary_id (text) | summary_en (text, nullable)
    | content_id (longtext) | content_en (longtext, nullable)
    | thumbnail (string, path, nullable)
    | blog_category_id (FK, nullable) | status (enum: publish, draft)
    | published_at (datetime, nullable) | view_count (integer, default: 0)
    | created_at | updated_at | deleted_at (soft delete)
```

#### `blog_post_tag` — Pivot: Post ↔ Tag
```sql
id | blog_post_id (FK) | blog_tag_id (FK)
```

#### `contacts` — Pesan Kontak (BE-12)
```sql
id | name | email | subject | message
    | status (enum: unread, read) | read_at (datetime, nullable)
    | ip_address (string, nullable) | user_agent (text, nullable)
    | created_at | updated_at
```

#### `visitors` — Statistik Kunjungan (BE-14)
```sql
id | ip_address | user_agent | page_url | referer | session_id
    | visited_at (datetime) | created_at
```

### 5.2 Relasi

```
Profile ── 1:1 ── (satu profil saja)
Experience ── banyak, sortable
Education ── banyak, sortable
SkillCategory ── 1:N ── Skill
Project ── 1:N ── ProjectTechnology
BlogCategory ── 1:N ── BlogPost
BlogTag ── N:M ── BlogPost (via blog_post_tag)
```

---

## 6. Halaman Frontend (dari Prototipe)

### 6.1 Beranda (`/`)

| Section | Prototipe | Data Source |
|---|---|---|
| Hero | `index.html:288-318` | `settings` (tagline) + `profiles` (photo) |
| Featured Projects | `index.html:320-?` | 3 `projects` terbaru (status=publish) |
| Featured Certificates | (opsional) | 3 `certificates` terbaru |
| Visitor Counter | Footer | `visitors` (unique count) |

### 6.2 Tentang Saya (`/about`)

| Section | Prototipe | Data Source |
|---|---|---|
| Ringkasan Profil | `about.html` | `profiles` (summary_id/en, photo, cv) |
| Pengalaman Kerja | `about.html` | `experiences` (sorted by sort_order desc) |
| Riwayat Pendidikan | `about.html` | `educations` (sorted by sort_order desc) |
| Skill per Kategori | `about.html` | `skill_categories` + `skills` |

### 6.3 Portofolio (`/portfolio`)

| Section | Prototipe | Data Source |
|---|---|---|
| Filter Bar | `portfolio.html:289-306` | Tab: Projects / Certificates, Search |
| Projects Grid | `portfolio.html:310-?` | `projects` (status=publish, filterable) |
| Certificates Grid | `portfolio.html:383-?` | `certificates` (status=publish) |

### 6.4 Detail Proyek (`/portfolio/{slug}`)

| Section | Prototipe | Data Source |
|---|---|---|
| Header + Meta | `portfolio-detail.html` | `projects` (title, type, company, role, period) |
| Thumbnail | `portfolio-detail.html:303-308` | `projects.thumbnail` |
| Deskripsi Lengkap | `portfolio-detail.html:317-350` | `projects.full_description` |
| Tantangan & Solusi | `portfolio-detail.html:326-332` | (field terpisah atau bagian dari full_description) |
| Galeri | `portfolio-detail.html:336-349` | `projects.gallery` (JSON array) |
| Sidebar Tautan | `portfolio-detail.html:353-?` | demo_url, repo_url |
| Share Buttons | `portfolio-detail.html` | `components/share-buttons.html` |
| Related Projects | (opsional) | `projects` dengan tag teknologi sama |

### 6.5 Blog (`/blog`)

| Section | Prototipe | Data Source |
|---|---|---|
| Filter Bar | `blog.html:289-316` | Kategori (tab), Tag, Search |
| Articles Grid | `blog.html:318-?` | `blog_posts` (status=publish, paginate 9) |

### 6.6 Detail Artikel (`/blog/{slug}`)

| Section | Prototipe | Data Source |
|---|---|---|
| Header (judul, meta) | `blog-detail.html` | `blog_posts` (title, published_at, category, tags) |
| Konten Artikel | `blog-detail.html` | `blog_posts.content` (HTML dari editor) |
| Share Buttons | `blog-detail.html` | `components/share-buttons.html` |
| Related Posts | `blog-detail.html` | 2-4 posts dengan kategori/tag sama |

### 6.7 Kontak (`/contact`)

| Section | Prototipe | Data Source |
|---|---|---|
| Info Kontak | `contact.html` | `settings` (email, whatsapp, github, linkedin, location) |
| Formulir Pesan | `contact.html` | POST ke `ContactController@store` |

### 6.8 Halaman 404

| Section | Prototipe | Data Source |
|---|---|---|
| Pesan ramah + navigasi | (belum ada) | Static content bilingual |

---

## 7. Panel Admin (FilamentPHP)

### 7.1 Struktur Menu

```
Dashboard (BE-02)
├── Statistik: total proyek, sertifikat, artikel, pesan unread
├── Grafik kunjungan (7/30 hari)
├── Pesan terbaru (5)
├── Artikel terbaru (5)
├── Quick Actions

Tentang Saya
├── Ringkasan Profil & CV (BE-03)
├── Pengalaman Kerja (BE-04) — sortable
├── Riwayat Pendidikan (BE-05) — sortable
└── Skill & Kategori (BE-06)

Portofolio
├── Proyek (BE-07) — searchable, filterable, sortable
└── Sertifikat (BE-08) — sortable

Blog
├── Kategori (BE-09)
├── Tag (BE-10)
└── Artikel (BE-11) — rich text editor, preview

Kontak
└── Pesan Masuk (BE-12) — mark as read/unread, delete

Pengaturan
├── Umum (BE-13) — contact, SEO, footer, favicon, OG image
└── Statistik (BE-14) — visitor data, export CSV
```

### 7.2 Fitur Khusus Admin

| Fitur | Implementasi |
|---|---|
| Bilingual Fields | Dua kolom input per field (`*_id` + `*_en`) dengan badge ID/EN |
| Rich Text Editor | Tiptap / TinyMCE untuk `content_id` dan `content_en` |
| File Upload | Spatie Media Library atau Laravel Storage dengan validasi |
| Sortable Drag-Drop | `spatie/eloquent-sortable` atau Filament Reorderable |
| Slug | Auto-generate dari `*_id`, editable manual, unique validation |
| Preview | Tombol "Preview" membuka frontend di tab baru |
| Soft Delete | Semua konten utama (projects, certificates, blog_posts) |

---

## 8. Animasi & Interaksi (dari Prototipe)

Semua animasi di prototipe **wajib** dipertahankan di implementasi Blade:

| Animasi | Lokasi Prototipe | Implementasi |
|---|---|---|
| Noise texture overlay | CSS `.noise-overlay` | Copy ke `app.css` atau inline |
| Scroll progress bar | CSS `.scroll-progress` + JS | Copy ke shared scripts |
| Page transition | CSS `.page-transition` + JS | Copy ke shared scripts |
| Custom cursor | CSS `.custom-cursor` + JS | Copy ke shared scripts |
| Hero text stagger | CSS `.hero-word` + JS `initTextStagger()` | Copy ke shared scripts |
| Back to top + progress ring | CSS `.back-to-top` + JS | Copy ke shared scripts |
| Card scroll reveal | CSS `.card-animate` + IntersectionObserver | Copy ke shared scripts |
| Text selection color | `::selection` CSS | Copy ke `app.css` |

### 8.1 Catatan Penting (Bugs yang Sudah Difix)

- **Back-to-top null check:** `getElementById('back-to-top')` harus dicek `null` karena script mungkin dieksekusi sebelum elemen diparse
- **Page transition fallback:** CSS animation `forceHideOverlay` wajib ada agar overlay tidak menghitam permanen jika JS error
- **Hero stagger idempotency:** Gunakan `dataset.staggered` agar tidak double-wrap saat navigasi Turbolinks/Livewire

---

## 9. SEO & Social Sharing (US-19)

### 9.1 Meta Tags per Halaman

| Halaman | Title | Description |
|---|---|---|
| Beranda | `site_title` | `meta_description` |
| Tentang Saya | Tentang Saya — {site_title} | Ringkasan profil (truncated) |
| Portofolio | Portofolio — {site_title} | `meta_description` |
| Detail Proyek | {project.title} — Portofolio | `project.short_description` |
| Blog | Blog — {site_title} | `meta_description` |
| Detail Artikel | {post.title} — Blog | `post.summary` |
| Kontak | Kontak — {site_title} | `meta_description` |

### 9.2 Open Graph & Twitter Cards

```html
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:type" content="website|article">
<meta name="twitter:card" content="summary_large_image">
```

### 9.3 Structured Data (JSON-LD)

- **Homepage:** `Person` schema
- **Blog Post:** `Article` schema
- **Portfolio Detail:** `CreativeWork` schema

### 9.4 Sitemap & RSS

- Sitemap XML: `spatie/laravel-sitemap`, auto-generate saat deploy atau via scheduler
- RSS Feed: `/feed.xml` — daftar `blog_posts` (status=publish, terbaru 20)

---

## 10. Dark Mode (US-14)

- Implementasi: Tailwind `darkMode: 'class'` (sudah di prototipe)
- Toggle: Tombol di navbar dengan icon sun/moon
- Storage: `localStorage` (frontend) untuk persistensi
- Default: `prefers-color-scheme` media query
- Admin panel: Filament mendukung dark mode natively

---

## 11. Mobile Responsiveness (US-17)

- Framework: Tailwind CSS (mobile-first)
- Breakpoints: `sm:640px`, `md:768px`, `lg:1024px`, `xl:1280px`
- Navbar: Hamburger menu + drawer (sudah di prototipe)
- Tap target: Minimal 44×44px untuk semua tombol interaktif
- Prototipe sudah responsive — referensi visual tetap sama

---

## 12. Security

| Aspek | Implementasi |
|---|---|
| Autentikasi | Laravel Fortify / Filament Auth (session-based) |
| Session | 2 jam idle, 24 jam total, regenerate ID |
| Remember Me | Cookie HttpOnly, Secure, SameSite=Strict |
| Password | Min 8 karakter, bcrypt hash |
| CSRF | Laravel CSRF token di semua form |
| File Upload | Validasi tipe (image: jpg/png/webp, pdf), max size 5MB |
| Contact Form | Honeypot field + rate limiting (5 per IP per jam) |
| SQL Injection | Eloquent ORM (parameterized queries) |
| XSS | Blade `{{ }}` auto-escaping, `!! !!` hanya untuk konten trusted (rich text) |

---

## 13. Performance

| Aspek | Target | Implementasi |
|---|---|---|
| First Contentful Paint | < 1.5s | Optimasi gambar (WebP, lazy loading), CDN |
| Time to Interactive | < 3.5s | Minimal JS, defer non-critical |
| Gambar | WebP dengan fallback | Spatie Image Optimization |
| CSS | Purged Tailwind | `npm run build` production |
| Cache | Query cache | Laravel cache untuk settings, navigasi |
| Database | N+1 prevention | Eager load relationships |

---

## 14. Fase Implementasi

### Fase 1 — Foundation (Week 1)
- [ ] Setup Laravel + Filament + Tailwind
- [ ] Migrasi database semua tabel
- [ ] Setup layout Blade dari prototipe (layout, head, navbar, footer, global-ui, scripts)
- [ ] Implementasi dark mode + bilingual infrastructure
- [ ] Halaman 404

### Fase 2 — Frontend Publik (Week 2)
- [ ] Halaman Beranda (US-01)
- [ ] Halaman Tentang Saya (US-02 ~ US-06)
- [ ] Halaman Portofolio + Detail (US-07 ~ US-09, US-08a, US-08b)
- [ ] Halaman Blog + Detail (US-10 ~ US-12)
- [ ] Halaman Kontak (US-13, US-13a)

### Fase 3 — Panel Admin (Week 3)
- [ ] Autentikasi + Dashboard (BE-01, BE-02)
- [ ] CRUD Tentang Saya (BE-03 ~ BE-06)
- [ ] CRUD Portofolio (BE-07, BE-08)
- [ ] CRUD Blog (BE-09 ~ BE-11)
- [ ] Manajemen Kontak (BE-12)

### Fase 4 — Polish & Deploy (Week 4)
- [ ] Pengaturan Umum (BE-13)
- [ ] Statistik + Visitor Counter (BE-14, US-16)
- [ ] SEO: meta tags, OG, sitemap, RSS (US-19)
- [ ] Testing & bugfix
- [ ] Deploy staging → production

---

## 15. Appendix

### A. Asset Prototipe

Semua file prototipe berada di `D:\laragon\www\amrizal-me\prototype\`:

| File | Halaman |
|---|---|
| `index.html` | Beranda |
| `about.html` | Tentang Saya |
| `portfolio.html` | Daftar Portofolio |
| `portfolio-detail.html` | Detail Proyek |
| `blog.html` | Daftar Blog |
| `blog-detail.html` | Detail Artikel |
| `contact.html` | Kontak |
| `kitchen-sink.html` | Showcase komponen |

Komponen reusable: `prototype/components/*.html`

### B. Konten Blog

File markdown konten blog tersedia di `docs/contents/`:
- `blog.md` — Setup Cursor IDE untuk Laravel Development
- `blog-2.md` — Bedanya System Analyst, Business Analyst, dan Product Manager
- `blog-3.md` — 5 Tools Wajib System Analyst
- `blog-4.md` — 5 Kesalahan Umum System Analyst
- `blog-5.md` — Tips Menulis FSD yang Efektif
- `portofolio.md` — Konten detail proyek (BRD → Production)

### C. Warna Brand

| Token | Hex | Usage |
|---|---|---|
| `primary-950` | `#280905` | Deepest accent |
| `primary-900` | `#740A03` | Hover states |
| `primary-600` | `#C3110C` | Primary actions, links |
| `primary-400` | `#E6501B` | Gradients, highlights |

---

*End of Document*
