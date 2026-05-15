# User Story — Admin Backend amrizal.nahar

---

## Aktor

| ID | Aktor | Deskripsi |
|----|-------|-----------|
| A2 | **Admin (Amrizal)** | Pemilik website yang mengelola konten dan konfigurasi melalui panel admin |

---

## Modul 1 — Autentikasi & Dashboard

### BE-01 · Login ke Panel Admin
**Sebagai** Admin,
**Saya ingin** masuk ke panel admin dengan aman,
**Sehingga** saya dapat mengelola konten website tanpa akses publik.

**Acceptance Criteria:**
- [ ] Terdapat halaman login dengan field email dan password
- [ ] Validasi: email harus format valid, password minimal 8 karakter
- [ ] Menampilkan pesan error jika kredensial salah tanpa membeberkan field mana yang salah
- [ ] Setelah login sukses, redirect ke halaman Dashboard admin
- [ ] Session login memiliki expiry time (misal: 2 jam idle / 24 jam total)
- [ ] Terdapat fitur "Remember Me" dengan cookie aman (HttpOnly, Secure)
- [ ] Tombol logout tersedia di semua halaman admin

---

### BE-02 · Melihat Dashboard
**Sebagai** Admin,
**Saya ingin** melihat ringkasan data dan aktivitas website di satu halaman,
**Sehingga** saya dapat memantau kondisi website secara cepat.

**Acceptance Criteria:**
- [ ] Dashboard menampilkan jumlah total: proyek, sertifikat, artikel blog, dan pesan kontak yang belum dibaca
- [ ] Menampilkan grafik atau angka kunjungan (visitor counter) periode terakhir (7 hari / 30 hari)
- [ ] Menampilkan daftar pesan kontak terbaru (5 teratas)
- [ ] Menampilkan daftar artikel blog terbaru yang dipublish
- [ ] Terdapat quick action button ke halaman CRUD utama (Tambah Proyek, Tulis Artikel, dll.)

---

## Modul 2 — Manajemen Tentang Saya

### BE-03 · Mengelola Ringkasan Profil & CV
**Sebagai** Admin,
**Saya ingin** mengupdate ringkasan profil dan file CV,
**Sehingga** informasi di halaman Tentang Saya selalu up-to-date.

**Acceptance Criteria:**
- [ ] Terdapat form editor dengan **dua kolom terpisah**: ringkasan eksekutif `_id` (wajib) dan `_en` (opsional)
- [ ] Field `_id` wajib diisi; field `_en` boleh kosong dengan penanda "Fallback ke Indonesia"
- [ ] Jika field `_en` kosong, frontend otomatis menampilkan nilai `_id` sebagai fallback
- [ ] Terdapat penanda visual (badge ID / EN atau tab) pada setiap pasangan field bilingual
- [ ] Dapat mengunggah dan mengganti file CV PDF untuk masing-masing bahasa (`cv_id`, `cv_en`)
- [ ] Dapat mengunggah dan mengganti foto profil dengan preview
- [ ] Validasi tipe file: PDF untuk CV, gambar (JPG/PNG/WebP) untuk foto
- [ ] Terdapat tombol simpan dengan notifikasi sukses/error
- [ ] Perubahan langsung terlihat di frontend setelah disimpan

---

### BE-04 · Mengelola Pengalaman Kerja
**Sebagai** Admin,
**Saya ingin** menambah, mengubah, menghapus, dan mengurutkan daftar pengalaman kerja,
**Sehingga** riwayat profesional di frontend selalu akurat.

**Acceptance Criteria:**
- [ ] Tersedia daftar pengalaman kerja dengan urutan yang dapat diubah (drag-drop atau tombol urut)
- [ ] Form CRUD: nama perusahaan, logo (opsional), jabatan, periode mulai-selesai
- [ ] **Field deskripsi bilingual dengan dua kolom terpisah**: `description_id` (wajib) dan `description_en` (opsional); jika `_en` kosong, frontend fallback ke `_id`
- [ ] Terdapat penanda visual (badge ID / EN) pada setiap pasangan field bilingual
- [ ] Checkbox "Masih Bekerja" untuk periode yang belum berakhir
- [ ] Konfirmasi sebelum menghapus data
- [ ] Data tersimpan dan tampil sesuai urutan yang ditentukan di frontend

---

### BE-05 · Mengelola Riwayat Pendidikan
**Sebagai** Admin,
**Saya ingin** menambah, mengubah, menghapus, dan mengurutkan daftar pendidikan,
**Sehingga** riwayat akademis di frontend selalu akurat.

**Acceptance Criteria:**
- [ ] Tersedia daftar pendidikan dengan urutan yang dapat diubah
- [ ] Form CRUD: nama institusi, logo (opsional), jenjang (S1/S2/S3/D3/SMA), tahun masuk-lulus
- [ ] **Field jurusan bilingual dengan dua kolom terpisah**: `major_id` (wajib) dan `major_en` (opsional); jika `_en` kosong, frontend fallback ke `_id`
- [ ] Terdapat penanda visual (badge ID / EN) pada setiap pasangan field bilingual
- [ ] Konfirmasi sebelum menghapus data
- [ ] Data tersimpan dan tampil sesuai urutan yang ditentukan di frontend

---

### BE-06 · Mengelola Skill & Kategori
**Sebagai** Admin,
**Saya ingin** mengelola kategori skill dan skill di dalamnya,
**Sehingga** daftar keahlian di frontend dapat dikelola dengan fleksibel.

**Acceptance Criteria:**
- [ ] Tersedia CRUD kategori skill dengan **dua kolom terpisah per nama**: `name_id` (wajib) dan `name_en` (opsional); jika `_en` kosong, frontend fallback ke `_id`
- [ ] Di dalam setiap kategori, tersedia CRUD skill individu dengan **dua kolom terpisah per nama**: `name_id` (wajib) dan `name_en` (opsional); fallback ke `_id` jika `_en` kosong
- [ ] Terdapat penanda visual (badge ID / EN) pada setiap pasangan field bilingual
- [ ] Dapat memindahkan skill antar kategori (opsional)
- [ ] Konfirmasi sebelum menghapus kategori atau skill
- [ ] Perubahan langsung terefleksi di frontend

---

## Modul 3 — Manajemen Portofolio

### BE-07 · Mengelola Proyek
**Sebagai** Admin,
**Saya ingin** menambah, mengubah, menghapus, dan mengurutkan daftar proyek,
**Sehingga** portfolio selalu menampilkan karya terbaru saya.

**Acceptance Criteria:**
- [ ] Tersedia daftar proyek dengan fitur pencarian dan filter (tipe: Pribadi/Kantor)
- [ ] Form CRUD lengkap: nama proyek, slug, tipe (Pribadi/Kantor), nama perusahaan (jika Kantor), periode, peran, tautan demo, tautan repo
- [ ] **Field bilingual dengan dua kolom terpisah**: `short_description_id` (wajib) + `short_description_en` (opsional), `full_description_id` (wajib) + `full_description_en` (opsional); fallback ke `_id` jika `_en` kosong
- [ ] Terdapat penanda visual (badge ID / EN atau tab) pada setiap pasangan field bilingual
- [ ] Upload gambar dengan validasi ukuran dan format, serta preview sebelum simpan
- [ ] Dapat mengubah status: Publish / Draft
- [ ] Konfirmasi sebelum menghapus proyek
- [ ] Urutan proyek dapat diatur (drag-drop atau input urutan)

---

### BE-08 · Mengelola Sertifikat & Lisensi
**Sebagai** Admin,
**Saya ingin** menambah, mengubah, menghapus, dan mengurutkan daftar sertifikat,
**Sehingga** kompetensi formal yang ditampilkan di frontend selalu up-to-date.

**Acceptance Criteria:**
- [ ] Tersedia daftar sertifikat dengan urutan yang dapat diubah
- [ ] Form CRUD: nama sertifikat, nama penerbit/institusi, logo institusi (opsional), tanggal terbit, tanggal kedaluwarsa (opsional), tautan verifikasi, gambar sertifikat (opsional)
- [ ] **Field deskripsi bilingual dengan dua kolom terpisah**: `description_id` (wajib) dan `description_en` (opsional); jika `_en` kosong, frontend fallback ke `_id`
- [ ] Terdapat penanda visual (badge ID / EN) pada setiap pasangan field bilingual
- [ ] Dapat mengubah status: Publish / Draft
- [ ] Konfirmasi sebelum menghapus data

---

## Modul 4 — Manajemen Blog

### BE-09 · Mengelola Kategori Blog
**Sebagai** Admin,
**Saya ingin** mengelola kategori artikel blog,
**Sehingga** artikel dapat dikelompokkan dengan rapi.

**Acceptance Criteria:**
- [ ] Tersedia CRUD kategori dengan **dua kolom terpisah per nama**: `name_id` (wajib) dan `name_en` (opsional); fallback ke `_id` jika `_en` kosong
- [ ] Field deskripsi kategori bilingual (opsional): `description_id` dan `description_en`; fallback ke `_id` jika `_en` kosong
- [ ] Terdapat penanda visual (badge ID / EN) pada setiap pasangan field bilingual
- [ ] Validasi slug unik dan URL-friendly (slug dibuat dari `name_id` tapi dapat diedit manual)
- [ ] Menampilkan jumlah artikel per kategori
- [ ] Tidak dapat menghapus kategori yang masih memiliki artikel (atau konfirmasi dengan opsi pindahkan artikel)

---

### BE-10 · Mengelola Tag Blog
**Sebagai** Admin,
**Saya ingin** mengelola tag artikel blog,
**Sehingga** artikel dapat diberi label yang fleksibel.

**Acceptance Criteria:**
- [ ] Tersedia CRUD tag dengan **dua kolom terpisah per nama**: `name_id` (wajib) dan `name_en` (opsional); fallback ke `_id` jika `_en` kosong
- [ ] Terdapat penanda visual (badge ID / EN) pada setiap pasangan field bilingual
- [ ] Validasi slug unik (slug dibuat dari `name_id` tapi dapat diedit manual)
- [ ] Menampilkan jumlah artikel per tag
- [ ] Tidak dapat menghapus tag yang masih memiliki artikel (atau konfirmasi dengan opsi hapus tag dari artikel)

---

### BE-11 · Mengelola Artikel Blog
**Sebagai** Admin,
**Saya ingin** menulis, mengedit, menghapus, dan mempublikasikan artikel blog,
**Sehingga** konten blog selalu fresh dan terstruktur.

**Acceptance Criteria:**
- [ ] Tersedia daftar artikel dengan fitur pencarian, filter kategori, filter status (Publish/Draft), dan sortir
- [ ] Editor konten mendukung format teks kaya: heading, bold, italic, list, code block, blockquote, gambar, dan tautan
- [ ] **Form bilingual dengan dua kolom terpisah**: `title_id` (wajib) + `title_en` (opsional), `summary_id` (wajib) + `summary_en` (opsional), `content_id` (wajib) + `content_en` (opsional); fallback ke `_id` jika `_en` kosong
- [ ] Terdapat penanda visual (badge ID / EN atau tab) pada setiap pasangan field bilingual
- [ ] Slug otomatis dibuat dari `title_id` tapi dapat diedit manual; validasi unik
- [ ] Preview artikel sebelum publish (dapat memilih preview versi ID atau EN)
- [ ] Dapat menyimpan sebagai Draft tanpa tampil di frontend
- [ ] Konfirmasi sebelum menghapus artikel

---

## Modul 5 — Manajemen Kontak

### BE-12 · Melihat & Mengelola Pesan Kontak
**Sebagai** Admin,
**Saya ingin** melihat pesan yang masuk dari pengunjung website,
**Sehingga** saya dapat merespons mereka tepat waktu.

**Acceptance Criteria:**
- [ ] Tersedia daftar pesan dengan informasi: nama pengirim, email, subjek, isi pesan, tanggal kirim, dan status (Belum Dibaca / Sudah Dibaca)
- [ ] Dapat menyaring pesan berdasarkan status (Belum Dibaca / Semua)
- [ ] Dapat menandai pesan sebagai Sudah Dibaca atau Belum Dibaca
- [ ] Dapat menghapus pesan dengan konfirmasi
- [ ] Terdapat notifikasi/badge jumlah pesan belum dibaca di menu/dashboard
- [ ] Dapat membalas langsung via email client (mailto link) dari detail pesan

---

## Modul 6 — Pengaturan Website

### BE-13 · Mengelola Pengaturan Umum
**Sebagai** Admin,
**Saya ingin** mengkonfigurasi pengaturan global website,
**Sehingga** informasi dasar dan SEO website dapat diupdate tanpa mengubah kode.

**Acceptance Criteria:**
- [ ] Form pengaturan kontak: email, nomor WhatsApp, tautan GitHub, tautan LinkedIn, domisili/kota
- [ ] Form pengaturan SEO default dengan **dua kolom terpisah**: `site_title_id` (wajib) + `site_title_en` (opsional), `meta_description_id` (wajib) + `meta_description_en` (opsional); fallback ke `_id` jika `_en` kosong
- [ ] Terdapat penanda visual (badge ID / EN) pada setiap pasangan field bilingual
- [ ] Form pengaturan footer: teks copyright, tautan media sosial (ikon + URL)
- [ ] Form pengaturan umum: bahasa default, mode tema default (Dark/Light/System)
- [ ] Upload favicon dan default OG image
- [ ] Perubahan langsung terefleksi di frontend setelah disimpan

---

### BE-14 · Melihat Statistik Pengunjung
**Sebagai** Admin,
**Saya ingin** melihat data detail kunjungan website,
**Sehingga** saya dapat memahami perilaku dan asal pengunjung.

**Acceptance Criteria:**
- [ ] Menampilkan total kunjungan unik dan total page views (periode dapat dipilih: 7 hari, 30 hari, 12 bulan)
- [ ] Menampilkan halaman paling banyak dikunjungi (Top Pages)
- [ ] Menampilkan sumber lalu lintas utama (Direct, Search, Social, Referral) jika data tersedia
- [ ] Data tidak dapat dimanipulasi dari sisi klien (server-side tracking)
- [ ] Dapat mengekspor data ke format CSV (opsional)

---

## Ringkasan User Story

| ID | Modul | Judul | Aktor |
|----|-------|-------|-------|
| BE-01 | Autentikasi & Dashboard | Login ke Panel Admin | Admin |
| BE-02 | Autentikasi & Dashboard | Melihat Dashboard | Admin |
| BE-03 | Manajemen Tentang Saya | Mengelola Ringkasan Profil & CV | Admin |
| BE-04 | Manajemen Tentang Saya | Mengelola Pengalaman Kerja | Admin |
| BE-05 | Manajemen Tentang Saya | Mengelola Riwayat Pendidikan | Admin |
| BE-06 | Manajemen Tentang Saya | Mengelola Skill & Kategori | Admin |
| BE-07 | Manajemen Portofolio | Mengelola Proyek | Admin |
| BE-08 | Manajemen Portofolio | Mengelola Sertifikat & Lisensi | Admin |
| BE-09 | Manajemen Blog | Mengelola Kategori Blog | Admin |
| BE-10 | Manajemen Blog | Mengelola Tag Blog | Admin |
| BE-11 | Manajemen Blog | Mengelola Artikel Blog | Admin |
| BE-12 | Manajemen Kontak | Melihat & Mengelola Pesan Kontak | Admin |
| BE-13 | Pengaturan Website | Mengelola Pengaturan Umum | Admin |
| BE-14 | Pengaturan Website | Melihat Statistik Pengunjung | Admin |
