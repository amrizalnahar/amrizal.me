# Components

Direktori ini berisi komponen UI yang diekstrak dari prototipe HTML. Setiap file adalah partial HTML dengan komentar Blade yang menunjukkan cara menggunakannya di Laravel.

## Struktur Mapping ke Laravel

| File Prototipe | Blade Equivalent | Keterangan |
|---|---|---|
| `layout.html` | `resources/views/layouts/app.blade.php` | Master layout wrapper |
| `head.html` | `resources/views/components/head.blade.php` | Head tag, meta, Tailwind config, CSS |
| `scripts.html` | `resources/views/components/scripts.blade.php` | Shared JS (theme, drawer, animations) |
| `global-ui.html` | Inline di layout | Noise, scroll progress, cursor, back-to-top |
| `navbar.html` | `resources/views/components/navbar.blade.php` | Fixed navbar |
| `mobile-drawer.html` | `resources/views/components/mobile-drawer.blade.php` | Mobile menu drawer |
| `footer.html` | `resources/views/components/footer.blade.php` | Footer |
| `section-header.html` | `resources/views/components/section-header.blade.php` | Section title + subtitle + link |
| `portfolio-card.html` | `resources/views/components/portfolio-card.blade.php` | Kartu proyek portofolio |
| `blog-card.html` | `resources/views/components/blog-card.blade.php` | Kartu artikel blog |
| `certificate-card.html` | `resources/views/components/certificate-card.blade.php` | Kartu sertifikat |
| `share-buttons.html` | `resources/views/components/share-buttons.blade.php` | Tombol share sosial media |
| `filter-bar.html` | `resources/views/components/filter-bar.blade.php` | Filter buttons + search |
| `tag-badge.html` | `resources/views/components/tag-badge.blade.php` | Badge/tag kecil |

## Konvensi

- Variabel Blade ditulis sebagai `{{ $variable }}`
- Directives Blade ditulis dalam komentar HTML: `{{-- @if(...) --}}`
- Slot/konten dinamis ditandai dengan komentar `{{-- Blade: @yield('content') --}}`
- SVG placeholder disimpan sebagai string (`$thumbnailSvg`, `$iconSvg`) agar fleksibel

## Halaman yang Sudah Dibuat Prototipe

1. `index.html` - Beranda (Home)
2. `about.html` - Tentang Saya
3. `portfolio.html` - Daftar Portofolio
4. `portfolio-detail.html` - Detail Proyek
5. `blog.html` - Daftar Blog
6. `blog-detail.html` - Detail Artikel
7. `contact.html` - Kontak
8. `kitchen-sink.html` - Showcase komponen
