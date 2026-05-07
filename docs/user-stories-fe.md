# User Story — Website Profil Pribadi amrizal.me

---

## Aktor

| ID | Aktor | Deskripsi |
|----|-------|-----------|
| A1 | **Visitor** | Pengunjung umum yang mengakses website secara publik |
| A2 | **Admin (Amrizal)** | Pemilik website yang mengelola konten |

---

## Modul 1 — Beranda

### US-01 · Melihat Halaman Beranda
**Sebagai** Visitor,  
**Saya ingin** melihat halaman beranda yang informatif dan menarik,  
**Sehingga** saya mendapatkan gambaran singkat tentang siapa Amrizal sebelum menjelajahi lebih lanjut.

**Acceptance Criteria:**
- [ ] Halaman beranda memuat hero section dengan nama, tagline/profesi, dan foto profil
- [ ] Terdapat navigasi ke semua halaman utama (Beranda, Tentang Saya, Portofolio, Blog, Kontak)
- [ ] Terdapat CTA (Call to Action) yang mengarahkan ke halaman Tentang Saya atau Portofolio
- [ ] Halaman dapat diakses di semua ukuran layar (mobile, tablet, desktop)

---

## Modul 2 — Tentang Saya

### US-02 · Membaca Ringkasan Eksekutif
**Sebagai** Visitor,  
**Saya ingin** membaca ringkasan eksekutif profil Amrizal,  
**Sehingga** saya dapat memahami latar belakang dan keahlian utamanya dalam waktu singkat.

**Acceptance Criteria:**
- [ ] Ringkasan eksekutif tampil di bagian atas halaman Tentang Saya
- [ ] Teks ringkasan menyesuaikan bahasa aktif (Indonesia / Inggris)
- [ ] Konten dapat dibaca dengan nyaman di semua perangkat

---

### US-03 · Mengunduh CV
**Sebagai** Visitor,  
**Saya ingin** mengunduh CV Amrizal sesuai bahasa yang saya pilih,  
**Sehingga** saya bisa menyimpan informasi lengkap tentang profilnya secara offline.

**Acceptance Criteria:**
- [ ] Tersedia tombol "Download CV" di halaman Tentang Saya
- [ ] Jika bahasa aktif adalah Indonesia → file CV Bahasa Indonesia yang terunduh
- [ ] Jika bahasa aktif adalah Inggris → file CV Bahasa Inggris yang terunduh
- [ ] File CV berformat PDF
- [ ] Proses unduh berjalan langsung tanpa perlu login atau isi form

---

### US-04 · Melihat Pengalaman Kerja
**Sebagai** Visitor,  
**Saya ingin** melihat daftar pengalaman kerja Amrizal dalam format kartu seperti LinkedIn,  
**Sehingga** saya dapat memahami rekam jejak profesionalnya secara kronologis.

**Acceptance Criteria:**
- [ ] Setiap kartu pengalaman menampilkan: nama perusahaan, logo perusahaan (opsional), jabatan, periode (bulan & tahun mulai–selesai), dan deskripsi singkat pekerjaan
- [ ] Kartu ditampilkan secara berurutan dari yang terbaru ke terlama
- [ ] Deskripsi pekerjaan menyesuaikan bahasa aktif
- [ ] Tampilan kartu responsif di semua ukuran layar

---

### US-05 · Melihat Riwayat Pendidikan
**Sebagai** Visitor,  
**Saya ingin** melihat riwayat pendidikan Amrizal dalam format kartu,  
**Sehingga** saya dapat mengetahui latar belakang akademisnya.

**Acceptance Criteria:**
- [ ] Setiap kartu pendidikan menampilkan: nama institusi, logo institusi (opsional), jurusan/program studi, jenjang pendidikan, dan tahun masuk–lulus
- [ ] Kartu diurutkan dari pendidikan terbaru
- [ ] Label pendidikan menyesuaikan bahasa aktif
- [ ] Tampilan kartu responsif di semua ukuran layar

---

### US-06 · Melihat Skill per Kategori
**Sebagai** Visitor,  
**Saya ingin** melihat daftar skill Amrizal yang dikelompokkan per kategori,  
**Sehingga** saya dapat menilai keahliannya secara menyeluruh berdasarkan bidang tertentu.

**Acceptance Criteria:**
- [ ] Skill ditampilkan per kartu kategori (contoh: "Programming Languages", "Tools & Platforms", "Soft Skills")
- [ ] Di dalam setiap kartu kategori terdapat daftar skill individu (dapat berupa badge/chip/ikon)
- [ ] Nama kategori dan skill menyesuaikan bahasa aktif
- [ ] Kartu kategori responsif dan tersusun rapi di semua ukuran layar

---

## Modul 3 — Portofolio

### US-07 · Menjelajahi Portofolio
**Sebagai** Visitor,  
**Saya ingin** melihat portofolio Amrizal dan dapat beralih antara kategori Proyek dan Sertifikat/Lisensi,  
**Sehingga** saya dapat menilai pencapaian dan karya nyatanya.

**Acceptance Criteria:**
- [ ] Halaman Portofolio memiliki dua tab/filter: **Proyek** dan **Sertifikat/Lisensi**
- [ ] Tab aktif secara default adalah Proyek
- [ ] Berpindah tab tidak memuat ulang halaman (perubahan dinamis)

---

### US-08 · Melihat Daftar Proyek
**Sebagai** Visitor,  
**Saya ingin** melihat daftar proyek yang pernah dikerjakan Amrizal,  
**Sehingga** saya dapat mengetahui pengalaman praktisnya dalam membangun sesuatu.

**Acceptance Criteria:**
- [ ] Setiap kartu proyek menampilkan: nama proyek, thumbnail/gambar, deskripsi singkat, teknologi yang digunakan (tag), dan tautan ke live demo atau repository (jika ada)
- [ ] Terdapat badge identifikasi tipe proyek: **Pribadi** atau **Kantor**; jika dari kantor, badge menampilkan nama perusahaan
- [ ] Warna atau ikon badge membedakan secara visual antara proyek pribadi dan proyek kantor
- [ ] Kartu proyek responsif (grid di desktop, stack di mobile)
- [ ] Deskripsi proyek menyesuaikan bahasa aktif

---

### US-08a · Melihat Detail Proyek
**Sebagai** Visitor,
**Saya ingin** mengklik sebuah proyek dan melihat halaman detail lengkapnya,
**Sehingga** saya dapat memahami konteks, teknologi, dan proses pengembangan proyek tersebut secara menyeluruh.

**Acceptance Criteria:**
- [ ] Halaman detail menampilkan: nama proyek, badge tipe (Pribadi/Kantor), nama perusahaan (jika Kantor), deskripsi lengkap, gallery/screenshot, daftar teknologi, periode/tahun pengerjaan, peran/jabatan dalam proyek, dan tautan ke live demo atau repository
- [ ] Terdapat navigasi kembali ke daftar proyek atau tab Portofolio
- [ ] Konten deskripsi lengkap menyesuaikan bahasa aktif
- [ ] Gallery/screenshot mendukung lightbox atau carousel jika lebih dari satu gambar
- [ ] URL halaman detail menggunakan slug yang readable (contoh: `/portfolio/nama-proyek`)
- [ ] Halaman responsif di semua ukuran layar

---

### US-08b · Memfilter dan Mensortir Proyek
**Sebagai** Visitor,
**Saya ingin** menyaring dan mengurutkan daftar proyek berdasarkan tipe atau teknologi,
**Sehingga** saya dapat dengan cepat menemukan proyek yang paling relevan dengan minat saya.

**Acceptance Criteria:**
- [ ] Tersedia filter berdasarkan tipe proyek: **Semua**, **Pribadi**, atau **Kantor**
- [ ] Tersedia filter berdasarkan teknologi (multi-select tag atau dropdown)
- [ ] Tersedia sortir berdasarkan tahun pengerjaan: terbaru ke terlama atau sebaliknya
- [ ] Hasil filter dan sortir diperbarui secara dinamis tanpa memuat ulang halaman
- [ ] State filter tersimpan di URL query parameter agar bisa dibagikan
- [ ] Jika tidak ada hasil, ditampilkan pesan kosong yang informatif dalam bahasa aktif

---

### US-09 · Melihat Sertifikat dan Lisensi
**Sebagai** Visitor,  
**Saya ingin** melihat daftar sertifikat dan lisensi yang dimiliki Amrizal,  
**Sehingga** saya dapat memverifikasi kompetensi formalnya.

**Acceptance Criteria:**
- [ ] Setiap kartu sertifikat menampilkan: nama sertifikat, nama penerbit/institusi, logo institusi (opsional), tanggal terbit, dan tautan verifikasi (jika ada)
- [ ] Kartu responsif di semua ukuran layar
- [ ] Label sertifikat menyesuaikan bahasa aktif

---

## Modul 4 — Blog

### US-10 · Melihat Daftar Blog
**Sebagai** Visitor,  
**Saya ingin** melihat daftar artikel blog Amrizal yang bisa disaring berdasarkan kategori dan tag,  
**Sehingga** saya dapat menemukan tulisan yang relevan dengan minat saya.

**Acceptance Criteria:**
- [ ] Halaman Blog menampilkan daftar artikel dengan informasi: judul, thumbnail, kategori, tag, tanggal publish, dan ringkasan singkat
- [ ] Tersedia filter berdasarkan **kategori** (radio/tab) dan **tag** (multi-select)
- [ ] Filter dapat dikombinasikan (kategori + tag aktif bersamaan)
- [ ] Artikel diurutkan dari yang terbaru
- [ ] Judul dan ringkasan menyesuaikan bahasa aktif

---

### US-11 · Membaca Detail Artikel Blog
**Sebagai** Visitor,  
**Saya ingin** membaca isi lengkap sebuah artikel blog,  
**Sehingga** saya mendapatkan informasi atau wawasan yang ditulis oleh Amrizal.

**Acceptance Criteria:**
- [ ] Halaman detail menampilkan: judul, tanggal publish, kategori, tag, dan konten lengkap artikel
- [ ] Konten artikel mendukung format teks kaya (heading, list, code block, gambar)
- [ ] Konten menyesuaikan bahasa aktif
- [ ] URL halaman detail menggunakan slug yang readable (contoh: `/blog/judul-artikel`)

---

### US-12 · Melihat Artikel Terkait
**Sebagai** Visitor,  
**Saya ingin** melihat rekomendasi artikel terkait di bawah artikel yang sedang saya baca,  
**Sehingga** saya dapat melanjutkan membaca konten yang relevan dengan mudah.

**Acceptance Criteria:**
- [ ] Di bawah konten artikel terdapat section "Artikel Terkait" / "Related Posts"
- [ ] Menampilkan minimal 2 dan maksimal 4 artikel terkait berdasarkan kategori atau tag yang sama
- [ ] Setiap artikel terkait menampilkan: thumbnail, judul, dan tanggal publish
- [ ] Mengklik artikel terkait membuka halaman detail artikel tersebut

---

## Modul 5 — Kontak

### US-13 · Melihat Informasi Kontak
**Sebagai** Visitor,  
**Saya ingin** melihat informasi kontak Amrizal,  
**Sehingga** saya dapat menghubunginya melalui saluran yang paling nyaman bagi saya.

**Acceptance Criteria:**
- [ ] Halaman Kontak menampilkan: alamat email (dengan tombol salin atau mailto link), tautan GitHub, nomor/tautan WhatsApp, dan domisili (kota/provinsi)
- [ ] Setiap kontak memiliki ikon yang sesuai agar mudah dikenali
- [ ] Klik email → membuka email client
- [ ] Klik GitHub → membuka profil GitHub di tab baru
- [ ] Klik WhatsApp → membuka WhatsApp (web atau aplikasi)
- [ ] Label menyesuaikan bahasa aktif

### US-13a · Mengirim Pesan Kontak
**Sebagai** Visitor,
**Saya ingin** mengirim pesan langsung ke Amrizal melalui formulir di website,
**Sehingga** saya dapat menghubunginya tanpa perlu membuka aplikasi email atau chat terpisah.

**Acceptance Criteria:**
- [ ] Formulir menampilkan field: Nama, Email, Subjek, dan Pesan (semua wajib diisi)
- [ ] Validasi real-time: email harus format valid, pesan memiliki batas minimal karakter
- [ ] Tombol kirim disabled saat sedang memproses (loading state)
- [ ] Setelah berhasil terkirim, tampilkan notifikasi sukses dalam bahasa aktif
- [ ] Jika gagal, tampilkan pesan error yang jelas dan pertahankan isi form
- [ ] Pesan tersimpan di database dan/atau dikirim ke email admin
- [ ] Terdapat proteksi spam dasar (CAPTCHA atau honeypot)

---

## Modul 6 — Fitur General

### US-14 · Mengaktifkan Dark Mode / Light Mode
**Sebagai** Visitor,  
**Saya ingin** tampilan website mengikuti preferensi tema perangkat saya secara otomatis, dan saya dapat menggantinya secara manual,  
**Sehingga** saya nyaman membaca dalam kondisi pencahayaan apapun.

**Acceptance Criteria:**
- [ ] Secara default, tema mengikuti pengaturan sistem/browser (`prefers-color-scheme`)
- [ ] Tersedia tombol toggle Dark/Light Mode yang dapat diakses di semua halaman (umumnya di navbar)
- [ ] Pilihan tema yang dipilih manual tersimpan di `localStorage` dan bertahan saat halaman di-refresh
- [ ] Semua komponen UI (teks, background, kartu, ikon) menyesuaikan tema aktif dengan baik

---

### US-15 · Mengganti Bahasa (Bilingual)
**Sebagai** Visitor,  
**Saya ingin** mengganti bahasa tampilan antara Bahasa Indonesia dan Bahasa Inggris,  
**Sehingga** saya dapat membaca konten dalam bahasa yang lebih saya kuasai.

**Acceptance Criteria:**
- [ ] Tersedia tombol atau switcher bahasa yang dapat diakses di semua halaman (umumnya di navbar)
- [ ] Secara default, bahasa mengikuti pengaturan browser; fallback ke Bahasa Indonesia jika tidak dikenali
- [ ] Semua teks statis UI (label, CTA, placeholder) berubah mengikuti bahasa aktif
- [ ] Pilihan bahasa tersimpan di `localStorage` dan bertahan saat halaman di-refresh
- [ ] URL tidak berubah saat bahasa diganti (implementasi i18n sisi klien)

---

### US-16 · Melihat Visitor Counter
**Sebagai** Visitor,  
**Saya ingin** melihat jumlah total pengunjung website,  
**Sehingga** saya mengetahui seberapa banyak orang yang pernah mengunjungi website ini.

**Acceptance Criteria:**
- [ ] Visitor counter tampil di halaman Beranda atau footer (konsisten di semua halaman)
- [ ] Jumlah counter bertambah setiap kali ada pengunjung unik (berdasarkan sesi atau IP)
- [ ] Angka ditampilkan dengan format yang mudah dibaca (contoh: `1,234 Visitors`)
- [ ] Counter tidak dapat dimanipulasi dari sisi klien

---

### US-17 · Mengakses Website di Perangkat Mobile
**Sebagai** Visitor yang menggunakan smartphone,  
**Saya ingin** mengakses semua halaman dan fitur website dengan nyaman di layar kecil,  
**Sehingga** pengalaman saya tidak berbeda jauh dengan pengguna desktop.

**Acceptance Criteria:**
- [ ] Semua halaman menggunakan layout responsif (mobile-first atau adaptive)
- [ ] Navigasi berubah menjadi hamburger menu atau bottom navigation di mobile
- [ ] Semua kartu, gambar, dan teks terskala proporsional di layar mobile
- [ ] Tombol dan elemen interaktif memiliki ukuran tap target minimal 44×44px
- [ ] Tidak ada konten yang terpotong atau overflow horizontal di layar mobile

---

### US-18 · Melihat Footer
**Sebagai** Visitor,
**Saya ingin** melihat footer yang konsisten di bagian bawah setiap halaman,
**Sehingga** saya dapat mengakses informasi tambahan dan navigasi cepat kapan saja.

**Acceptance Criteria:**
- [ ] Footer tampil di bagian bawah setiap halaman website
- [ ] Menampilkan copyright dengan tahun dinamis
- [ ] Menyediakan quick links navigasi ke halaman utama
- [ ] Menampilkan ikon tautan media sosial (LinkedIn, GitHub, dll.)
- [ ] Desain footer menyesuaikan tema aktif (Dark/Light Mode)
- [ ] Tampilan responsif di semua ukuran layar

---

### US-19 · Mengoptimalkan SEO dan Social Sharing
**Sebagai** Visitor,
**Saya ingin** membagikan halaman website ini ke media sosial dan mesin pencari menampilkannya dengan baik,
**Sehingga** saya dan orang lain dapat menemukan serta membagikan konten Amrizal dengan mudah.

**Acceptance Criteria:**
- [ ] Setiap halaman memiliki meta title dan meta description yang unik
- [ ] Terdapat Open Graph tags (OG title, description, image, type) untuk setiap halaman
- [ ] Terdapat Twitter Card tags untuk preview di Twitter/X
- [ ] Terdapat Structured Data / JSON-LD (Person, Article, CreativeWork) untuk rich snippets
- [ ] Tersedia canonical URL di setiap halaman
- [ ] Tersedia sitemap XML yang otomatis terupdate
- [ ] Tersedia RSS Feed untuk daftar artikel blog
- [ ] Gambar OG memiliki dimensi yang sesuai standar (1200×630)

---

### US-20 · Mengakses Halaman 404
**Sebagai** Visitor,
**Saya ingin** melihat halaman yang ramah ketika mengakses URL yang tidak ditemukan,
**Sehingga** saya tidak bingung dan dapat dengan mudah kembali ke konten yang tersedia.

**Acceptance Criteria:**
- [ ] Halaman 404 menampilkan pesan ramah dalam bahasa aktif
- [ ] Terdapat ilustrasi atau ikon yang relevan (opsional)
- [ ] Terdapat tombol atau tautan kembali ke halaman Beranda
- [ ] Terdapat tautan ke halaman populer (Beranda, Portofolio, Blog, Kontak)
- [ ] Navbar dan footer tetap tampil di halaman 404
- [ ] Status HTTP response adalah 404 Not Found

---

## Ringkasan User Story

| ID | Modul | Judul | Aktor |
|----|-------|-------|-------|
| US-01 | Beranda | Melihat Halaman Beranda | Visitor |
| US-02 | Tentang Saya | Membaca Ringkasan Eksekutif | Visitor |
| US-03 | Tentang Saya | Mengunduh CV (bilingual) | Visitor |
| US-04 | Tentang Saya | Melihat Pengalaman Kerja | Visitor |
| US-05 | Tentang Saya | Melihat Riwayat Pendidikan | Visitor |
| US-06 | Tentang Saya | Melihat Skill per Kategori | Visitor |
| US-07 | Portofolio | Menjelajahi Portofolio | Visitor |
| US-08 | Portofolio | Melihat Daftar Proyek | Visitor |
| US-08a | Portofolio | Melihat Detail Proyek | Visitor |
| US-08b | Portofolio | Memfilter dan Mensortir Proyek | Visitor |
| US-09 | Portofolio | Melihat Sertifikat dan Lisensi | Visitor |
| US-10 | Blog | Melihat Daftar Blog (filter kategori & tag) | Visitor |
| US-11 | Blog | Membaca Detail Artikel Blog | Visitor |
| US-12 | Blog | Melihat Artikel Terkait | Visitor |
| US-13 | Kontak | Melihat Informasi Kontak | Visitor |
| US-13a | Kontak | Mengirim Pesan Kontak | Visitor |
| US-14 | General | Dark Mode / Light Mode | Visitor |
| US-15 | General | Ganti Bahasa Bilingual | Visitor |
| US-16 | General | Visitor Counter | Visitor |
| US-17 | General | Mobile Responsive | Visitor |
| US-18 | General | Melihat Footer | Visitor |
| US-19 | General | Mengoptimalkan SEO dan Social Sharing | Visitor |
| US-20 | General | Mengakses Halaman 404 | Visitor |