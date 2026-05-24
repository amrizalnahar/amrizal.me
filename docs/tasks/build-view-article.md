# Task: View Detail Article (Admin)

> Fitur halaman detail artikel di Admin CMS pada route `/admin/blog/{post}`.
> Pengguna dapat melihat semua informasi artikel secara lengkap tanpa masuk ke mode edit.

---

## Referensi Pattern

| Referensi | File |
|-----------|------|
| Livewire detail component | `app/Livewire/Admin/ContactDetail.php` |
| Detail view template | `resources/views/livewire/admin/contact-detail.blade.php` |
| Route pattern (show) | `Route::get('/contacts/{contact}', ContactDetail::class)` |
| Blog table (entry point) | `app/Livewire/Admin/BeritaTable.php` |
| Blog table view | `resources/views/livewire/admin/berita-table.blade.php` |
| Post model | `app/Models/Post.php` |

---

## Scope

### Data yang Ditampilkan (Full Detail)

| Section | Fields |
|---------|--------|
| **Header** | Thumbnail (full-width banner), Status badge (Draft/Published) |
| **Judul** | `title_id`, `title_en` (label per bahasa) |
| **Metadata** | Slug, Kategori, Tags, Author, Views count |
| **Tanggal** | `published_at`, `created_at`, `updated_at` |
| **Konten** | `content_id`, `content_en` — dengan toggle rendered HTML ↔ raw source |
| **SEO** | `meta_title`, `meta_description`, `meta_keywords` |
| **Preview Link** | Link ke halaman publik `/blog/{slug}` |

### Aksi di Halaman Detail

| Aksi | Kondisi |
|------|---------|
| ← Kembali ke Daftar Artikel | Selalu |
| Edit | `@can('posts-edit')` |
| Hapus (dengan konfirmasi modal) | `@can('posts-delete')` |
| Preview di Situs Publik | Selalu (link baru di tab baru, hanya jika status = published) |

### Akses dari Blog Table

- **Judul artikel di tabel** → klikable, navigasi ke detail
- **Icon mata (eye)** → tombol aksi baru di kolom Aksi, di samping Edit & Delete

### Permission

- Menggunakan permission yang sudah ada: `posts-list`

---

## Checklist Implementasi

### 1. Buat Livewire Component

- [x] Buat file `app/Livewire/Admin/BeritaDetail.php`
- [x] Class extends `Livewire\Component` dengan `#[Layout('layouts.admin')]`
- [x] Property: `public Post $post`
- [x] Method `mount(Post $post)`: load post dengan eager load `category`, `tags`, `author`
- [x] Method `delete()`: hapus thumbnail dari storage + soft delete post → redirect ke `admin.blog` dengan toast
- [x] Method `render()`: return view `livewire.admin.berita-detail`

### 2. Buat Blade View

- [x] Buat file `resources/views/livewire/admin/berita-detail.blade.php`
- [x] Layout mengikuti pattern `contact-detail.blade.php`:
  - Toast notification component
  - Back link ke `route('admin.blog')`
  - Heading `Detail Artikel`

#### Struktur Layout View:

```
┌────────────────────────────────────────────┐
│ ← Kembali ke Daftar Artikel                │
│                                            │
│ Detail Artikel                             │
├────────────────────────────────────────────┤
│ ┌────────────────────────────────────────┐ │
│ │  Thumbnail (full-width, rounded)       │ │
│ │  atau placeholder jika tidak ada       │ │
│ └────────────────────────────────────────┘ │
│                                            │
│  STATUS BADGE          VIEWS: 1,234        │
│                                            │
│  JUDUL (ID)                                │
│  <title_id>                                │
│                                            │
│  JUDUL (EN)                                │
│  <title_en> atau "-"                       │
│                                            │
│  SLUG             KATEGORI                 │
│  <slug>           <badge kategori>         │
│                                            │
│  TAGS                                      │
│  <badge> <badge> <badge>                   │
│                                            │
│  AUTHOR           TANGGAL PUBLISH          │
│  <name>           <dd MMM YYYY HH:mm>     │
│                                            │
│  DIBUAT            DIPERBARUI              │
│  <dd MMM YYYY>     <dd MMM YYYY>           │
│                                            │
│ ──────────── KONTEN (ID) ──────────────── │
│  [Rendered] [Raw]  ← toggle button        │
│  ┌──────────────────────────────────────┐ │
│  │  Rendered HTML / Raw source          │ │
│  └──────────────────────────────────────┘ │
│                                            │
│ ──────────── KONTEN (EN) ──────────────── │
│  [Rendered] [Raw]  ← toggle button        │
│  ┌──────────────────────────────────────┐ │
│  │  Rendered HTML / Raw source          │ │
│  │  atau teks "-" jika kosong           │ │
│  └──────────────────────────────────────┘ │
│                                            │
│ ──────────── SEO ──────────────────────── │
│  META TITLE                                │
│  <meta_title> atau "-"                     │
│                                            │
│  META DESCRIPTION                          │
│  <meta_description> atau "-"               │
│                                            │
│  META KEYWORDS                             │
│  <meta_keywords> atau "-"                  │
│                                            │
├────────────────────────────────────────────┤
│ [Edit] [Preview ↗] [Hapus]    ← actions   │
└────────────────────────────────────────────┘
```

#### Detail Teknis View:

- [x] **Thumbnail**: `<img>` full-width dengan `rounded-xl object-cover max-h-64`, atau placeholder SVG jika `null`
- [x] **Status badge**: `bg-green-100 text-green-700` untuk Published, `bg-neutral-100 text-neutral-600` untuk Draft
- [x] **Label field**: `text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1` (ikuti pattern contact-detail)
- [x] **Tags**: render sebagai `<span>` badges (`bg-neutral-100 text-neutral-600 rounded px-1.5 py-0.5 text-xs`)
- [x] **Konten toggle** (Alpine.js):
  - `x-data="{ showRaw: false }"` per section konten (ID & EN)
  - Tab buttons: "Rendered" (default) dan "Raw"
  - Rendered mode: `{!! $post->content_id !!}` di dalam `prose` container
  - Raw mode: `<pre><code>{{ $post->content_id }}</code></pre>` di dalam `bg-neutral-50 rounded-lg p-4 overflow-x-auto`
- [x] **Preview button**: `<a href="{{ route('blog.show', $post->slug) }}" target="_blank">` — hanya tampilkan jika status = `published`
- [x] **Delete**: gunakan modal konfirmasi dengan Alpine.js (ikuti pattern contact-detail yang menggunakan `confirm()`, atau bisa pakai modal seperti berita-table)
- [x] **`max-w-4xl mx-auto`** sebagai container utama (lebih lebar dari contact-detail karena ada konten artikel)

### 3. Daftarkan Route

- [x] Tambahkan route di `routes/web.php` di section Admin Routes, setelah route `blog/{post}/edit`:
  ```php
  Route::get('/blog/{post}', BeritaDetail::class)
      ->middleware('permission:posts-list')
      ->name('blog.show');
  ```
- [x] Import `use App\Livewire\Admin\BeritaDetail;` di bagian atas file
- [x] **PENTING**: Letakkan route `/blog/{post}` SETELAH `/blog/create` agar tidak conflict (route `create` bisa salah ditangkap sebagai `{post}`)

### 4. Update Blog Table — Tambah Akses ke Detail

- [x] **Judul klikable**: Wrap judul di `berita-table.blade.php` dengan `<a href="{{ route('admin.blog.show', $post) }}">`
  - Tambahkan `hover:text-primary-600 hover:underline transition-colors` pada link
- [x] **Icon mata (eye)**: Tambahkan tombol eye di kolom Aksi, sebelum tombol Edit:
  ```html
  <a href="{{ route('admin.blog.show', $post) }}" 
     class="p-1.5 text-neutral-500 hover:text-primary-600 hover:bg-primary-50 rounded-md transition-colors" 
     title="Lihat Detail">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
      </svg>
  </a>
  ```

### 5. Styling & UX

- [x] Pastikan konten HTML dari Trix di-render dengan style yang proper — gunakan Tailwind `prose` class pada container rendered content
- [x] Responsive: layout harus proper di mobile (single column) dan desktop
- [x] Animasi transisi halus pada toggle konten (gunakan `x-transition` Alpine.js)
- [x] Loading state pada tombol hapus (`wire:loading.attr="disabled"`)

---

## Urutan Pengerjaan

1. `BeritaDetail.php` (Livewire component)
2. `berita-detail.blade.php` (View)
3. Route registration di `web.php`
4. Update `berita-table.blade.php` (tambah link + eye icon)
5. Testing manual di browser

---

## Acceptance Criteria

- [x] Route `/admin/blog/{post}` menampilkan halaman detail artikel
- [x] Semua field Post ditampilkan dengan format yang rapi
- [x] Toggle rendered/raw bekerja untuk konten ID dan EN
- [x] Tombol Edit mengarah ke halaman edit (`/admin/blog/{post}/edit`)
- [x] Tombol Preview membuka tab baru ke halaman publik (`/blog/{slug}`) — hanya muncul jika published
- [x] Tombol Hapus menampilkan konfirmasi → hapus → redirect ke daftar dengan toast
- [x] Judul di tabel blog klikable ke halaman detail
- [x] Icon eye muncul di kolom Aksi tabel blog
- [x] Permission `posts-list` menggate akses ke halaman detail
- [x] Halaman responsive (mobile & desktop)
- [x] Role `viewer` bisa mengakses detail tapi tidak bisa Edit/Hapus (gated oleh `@can`)
