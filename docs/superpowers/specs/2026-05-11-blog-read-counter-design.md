# Blog Read Counter Display — Design

## Overview
Tampilkan counter jumlah pembaca (`views`) pada halaman detail blog (`/blog/{slug}`).

## Background
- Kolom `views` sudah ada di tabel `posts` (migration `add_views_to_posts_table`)
- Controller `BeritaController@show` sudah melakukan `$post->increment('views')`
- Belum ada tampilan UI untuk menunjukkan jumlah views

## Placement
Di baris metadata artikel, setelah tanggal publikasi dan estimasi waktu baca:
```
12 Mei 2026 · 5 min read · 128 views
```

## Translation Keys
- EN: `views` → `"views"`
- ID: `views` → `"x kali dibaca"` (atau `"dibaca"`)

## UI Detail
- Gunakan ikon mata (Heroicons `eye`) berukuran 12px
- Warna teks sama dengan metadata lainnya (`text-neutral-500 dark:text-neutral-400`)
- Pemisah menggunakan middle dot (`·`) untuk konsistensi dengan existing design
