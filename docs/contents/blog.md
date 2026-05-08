# Cara Bikin BRD yang Stakeholder Mau Baca Sampai Habis

*Tips & Insight · 6 menit baca*

---

Jujur saja: sebagian besar BRD (*Business Requirements Document*) tidak pernah benar-benar dibaca.

Stakeholder akan bilang "sudah saya baca" saat meeting, tapi ketika kamu tanya detail spesifik, jawabannya sering kali menunjukkan mereka hanya scan sekilas — atau mungkin hanya membaca halaman pertama.

Ini bukan sepenuhnya salah mereka. Sering kali, kita sebagai System Analyst yang membuat BRD terlalu panjang, terlalu teknis, dan terlalu penuh dengan template standar yang copy-paste dari proyek sebelumnya.

Di artikel ini, saya mau berbagi pendekatan yang saya gunakan supaya BRD benar-benar dibaca, dipahami, dan — yang paling penting — disetujui tanpa drama di akhir proyek.

---

## Masalah dengan BRD "Standar"

BRD tradisional biasanya punya struktur seperti ini:
1. Pendahuluan
2. Tujuan dan Ruang Lingkup
3. Deskripsi Kebutuhan Bisnis
4. Asumsi dan Ketergantungan
5. Daftar Requirement (panjaaang sekali)
6. Lampiran

Struktur ini tidak salah secara teknis. Tapi ada beberapa masalah yang sering muncul:

- Bagian "Daftar Requirement" sering jadi dump semua hal tanpa prioritas yang jelas
- Bahasa yang digunakan campuran: kadang terlalu bisnis, kadang tiba-tiba sangat teknis
- Tidak ada konteks visual — semua teks, tidak ada diagram atau ilustrasi alur
- Tidak terlihat jelas mana yang harus disetujui dan mana yang sekadar informasi

Akibatnya? Stakeholder bisnis merasa dokumen ini "urusan IT", dan developer merasa ini terlalu abstrak. Semua orang menunggu orang lain yang bertanggung jawab memahaminya.

---

## Prinsip 1: Mulai dengan "Problem Statement" yang Kuat

Halaman pertama BRD harus menjawab satu pertanyaan: **mengapa proyek ini ada?**

Bukan dalam bahasa korporat — tapi dalam bahasa yang membuat siapapun yang membaca langsung mengangguk.

Contoh yang biasa:
> *"Sistem ini dikembangkan untuk mendukung proses bisnis perusahaan dalam mengelola operasional gudang secara lebih efisien."*

Contoh yang lebih efektif:
> *"Saat ini, tim gudang menghabiskan 3 hari kerja setiap kuartal untuk stock opname manual — dan hasilnya masih memiliki selisih data 12-15%. Proyek ini bertujuan memotong waktu itu menjadi 4 jam dan meningkatkan akurasi stok ke >99%."*

Angka konkret dan gambaran masalah yang nyata jauh lebih menggerakkan stakeholder dibanding bahasa visi yang generik.

---

## Prinsip 2: Pisahkan "Kebutuhan" dari "Solusi"

Ini kesalahan yang sangat umum, bahkan di kalangan SA berpengalaman: **mencampur adukan kebutuhan bisnis dengan solusi teknis dalam dokumen yang sama.**

BRD harusnya menjawab: *"Apa yang bisnis butuhkan?"*
FSD yang menjawab: *"Bagaimana sistem akan memenuhi kebutuhan itu?"*

Kalau kamu menulis "sistem harus menggunakan database PostgreSQL dan REST API" di BRD — itu sudah masuk wilayah FSD. Stakeholder bisnis tidak perlu tahu (dan biasanya tidak peduli) dengan detail itu di tahap ini.

Manfaatnya sangat nyata: ketika solusi teknis berubah di tengah proyek, BRD kamu tidak perlu direvisi. Requirement bisnisnya tetap sama — hanya cara implementasinya yang berubah.

---

## Prinsip 3: Beri Setiap Requirement Nomor dan Prioritas

Jangan pernah membuat daftar requirement tanpa penomoran dan tanpa prioritas. Ini bukan cuma soal kerapian — ini tentang kontrol perubahan.

Format sederhana yang saya pakai:

| ID | Requirement | Prioritas | Sumber |
|---|---|---|---|
| REQ-001 | Sistem harus dapat mencatat penerimaan barang dari supplier dengan verifikasi kuantitas | Must Have | Pak Hendra (Supervisor Gudang) |
| REQ-002 | Sistem harus mengirim notifikasi email ke tim procurement saat barang diterima | Should Have | Bu Sari (Procurement) |
| REQ-003 | Laporan penerimaan barang dapat diekspor ke format PDF | Nice to Have | Pak Budi (Manager) |

Kolom **Prioritas** dengan klasifikasi MoSCoW (Must Have / Should Have / Could Have / Won't Have) sangat membantu saat ada tekanan untuk memotong scope. Kamu punya dasar objektif untuk diskusi — bukan hanya "kata PM"-nya begitu.

Kolom **Sumber** juga krusial: ketika ada konflik requirement antar departemen, kamu tahu harus kembali ke siapa untuk klarifikasi.

---

## Prinsip 4: Sertakan Visual untuk Proses Kritis

Untuk setiap proses bisnis yang penting, tambahkan satu diagram alur sederhana. Tidak harus formal — flowchart dua baris pun sudah jauh lebih efektif daripada tiga paragraf deskripsi teks.

Otak manusia memproses visual 60.000x lebih cepat dari teks. Stakeholder yang tidak membaca tiga halaman deskripsi proses sering kali langsung paham ketika melihat flowchart satu halaman.

---

## Prinsip 5: Buat "Glossary" di Awal, Bukan di Lampiran

Setiap industri punya jargon sendiri. Setiap perusahaan bahkan punya nama sendiri untuk hal yang sama: "pesanan" di satu departemen bisa disebut "order", "SO", atau "permintaan" di departemen lain.

Letakkan daftar definisi istilah di halaman ketiga atau keempat dokumen — bukan di lampiran paling belakang. Ini memastikan semua pihak membaca dokumen dengan pemahaman istilah yang sama.

---

## Penutup: BRD yang Baik adalah Kontrak, Bukan Laporan

Cara saya melihat BRD: ini adalah **kontrak antara bisnis dan tim pengembang** tentang apa yang akan dibangun. Seperti kontrak yang baik, ia harus jelas, tidak ambigu, dan dimengerti oleh kedua belah pihak.

Kalau ada stakeholder yang menandatangani BRD kamu tanpa benar-benar memahaminya, masalah itu akan muncul kembali di UAT — dalam bentuk yang jauh lebih mahal untuk diselesaikan.

Investasikan waktu ekstra di awal untuk membuat BRD yang benar-benar komunikatif. Bayarannya akan terasa saat proyek berjalan lebih mulus dari yang biasanya.

---

*Punya template BRD yang sudah kamu sempurnakan dari banyak proyek? Saya selalu penasaran dengan pendekatan orang lain. Cerita di komentar ya!*