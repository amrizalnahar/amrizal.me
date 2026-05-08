# FSD Bukan Sekadar Dokumen Tebal: Tips Bikin Functional Spec yang Benar-Benar Berguna

*Tips & Insight · 8 menit baca*

---

Kalau BRD adalah "kontrak antara bisnis dan tim IT", maka FSD — *Functional Specification Document* — adalah "manual kerja" bagi semua orang yang terlibat dalam pembangunan sistem: developer, QA, dan kamu sendiri sebagai SA.

Tapi jujur, FSD punya reputasi yang kurang baik di banyak tim. Developer sering bilang dokumennya "terlalu abstrak untuk diimplementasikan". QA bilang "kurang detail untuk dijadikan dasar test case". Bahkan PM kadang bilang "terlalu panjang, saya nggak punya waktu baca semuanya".

Kalau kamu pernah mendengar keluhan-keluhan itu, kemungkinan besar FSD-nya memang ada yang perlu diperbaiki — bukan niat penulisnya, tapi *cara* menulisnya.

Di artikel ini saya mau breakdown pendekatan saya dalam menulis FSD yang benar-benar dipakai, bukan cuma diarsipkan.

---

## Apa Sebenarnya Tujuan FSD?

Sebelum bicara soal tips, penting untuk menyepakati dulu: **FSD ada untuk menghilangkan ambiguitas.**

Setiap kali developer harus berhenti dan bertanya "ini maksudnya gimana?" — itu adalah sinyal bahwa FSD belum menjalankan fungsinya. Setiap kali QA nggak bisa menulis test case dari dokumen yang ada — itu tanda yang sama.

FSD yang baik membuat developer bisa langsung duduk dan mulai coding tanpa harus menerka-nerka. QA bisa langsung menyusun skenario pengujian. Dan SA sendiri punya referensi yang bisa dijadikan acuan ketika ada perdebatan soal scope di tengah proyek.

---

## Tips 1: Struktur Dokumen Mengikuti Alur Pengguna, Bukan Struktur Teknis

Banyak FSD disusun berdasarkan modul teknis: Modul A, Modul B, Modul C. Masalahnya, developer dan QA harus bolak-balik antar bagian untuk memahami satu alur yang seharusnya terhubung.

Coba balik pendekatannya: **susun FSD berdasarkan user flow atau use case**, bukan modul.

Contoh untuk sistem e-commerce:

❌ Struktur berbasis modul teknis:
```
3. Modul Produk
4. Modul Keranjang
5. Modul Pembayaran
6. Modul Notifikasi
```

✅ Struktur berbasis alur pengguna:
```
3. Alur Pembelian Produk (Browse → Keranjang → Checkout → Pembayaran → Konfirmasi)
4. Alur Pengembalian Barang (Request Retur → Verifikasi → Refund)
5. Alur Manajemen Produk oleh Merchant
```

Dengan pendekatan kedua, siapapun yang membaca langsung bisa membayangkan pengalaman nyata pengguna — dan jauh lebih mudah mengidentifikasi kalau ada bagian alur yang belum terdokumentasi.

---

## Tips 2: Setiap Fitur Harus Punya "Happy Path" dan "Sad Path"

Ini yang paling sering terlewat di FSD pemula: **hanya mendokumentasikan skenario sukses.**

Happy path adalah alur ketika semua berjalan normal — pengguna input data, klik submit, sistem memproses, selesai. Tapi sistem nyata tidak selalu berjalan mulus.

Untuk setiap fitur, tanyakan pada diri sendiri:

- Apa yang terjadi kalau input pengguna tidak valid?
- Apa yang terjadi kalau koneksi ke sistem eksternal gagal?
- Apa yang terjadi kalau pengguna tidak punya akses ke fitur ini?
- Apa yang terjadi kalau data yang dibutuhkan tidak tersedia?

Contoh sederhana untuk fitur "Proses Pembayaran":

| Skenario | Kondisi | Perilaku Sistem |
|---|---|---|
| **Happy Path** | Pembayaran berhasil diverifikasi gateway | Tampilkan halaman sukses, kirim email konfirmasi, update status order jadi "Paid" |
| **Sad Path 1** | Saldo/limit kartu tidak mencukupi | Tampilkan pesan error spesifik, order tetap di status "Pending Payment", berikan opsi ganti metode bayar |
| **Sad Path 2** | Timeout koneksi ke payment gateway (>30 detik) | Tampilkan halaman "sedang diproses", cek status otomatis tiap 5 menit, notifikasi email jika status tidak berubah dalam 1 jam |
| **Sad Path 3** | Pengguna menutup browser di tengah proses | Order tersimpan di status "Pending Payment" selama 24 jam sebelum otomatis dibatalkan |

Developer yang membaca ini tahu persis apa yang harus dikerjakan. QA langsung bisa membuat test case dari setiap baris tabel.

---

## Tips 3: Gunakan Wireframe atau Mockup, Walau Kasar Sekalipun

FSD yang hanya teks sangat bergantung pada kemampuan pembacanya untuk membayangkan tampilan sistem. Dan setiap orang akan membayangkan hal yang berbeda.

Kamu tidak perlu menjadi desainer UI untuk menyertakan visual di FSD. Sketsa kasar di draw.io atau bahkan foto whiteboard yang digambar tangan sudah sangat membantu — asalkan cukup jelas untuk menunjukkan elemen apa saja yang ada di halaman dan di mana posisinya.

Untuk bagian yang kamu rasa paling berisiko salah interpretasi — halaman checkout, form kompleks, atau dashboard dengan banyak komponen — **sertakan mockup low-fidelity** dan berikan anotasi untuk setiap elemen.

Ini menghemat waktu revisi desain di fase development, dan mengurangi pertanyaan klarifikasi yang masuk ke kamu.

---

## Tips 4: Definisikan Aturan Bisnis Secara Eksplisit

*Business rules* adalah logika yang menentukan bagaimana sistem berperilaku dalam situasi tertentu. Ini sering tersebar di kepala stakeholder, tidak pernah dituliskan di mana pun, dan baru muncul saat UAT ketika pengguna bilang "lho, harusnya tidak begini."

Buat satu bagian khusus untuk business rules di setiap fitur, atau kumpulkan dalam satu bagian tersendiri di FSD. Format yang saya suka:

```
BR-001: Diskon tidak dapat digabungkan dengan voucher promo
BR-002: Pengguna hanya dapat mengajukan retur dalam 7 hari setelah barang diterima
BR-003: Jika stok < 5 unit, tampilkan label "Stok Terbatas" di halaman produk
BR-004: Pengiriman gratis otomatis berlaku untuk order di atas Rp 200.000
```

Dengan penomoran seperti ini, ketika developer atau QA menemukan kasus edge yang tidak tercakup, mereka bisa merujuk: "BR-002 sudah di-handle, tapi bagaimana kalau barang tidak pernah sampai ke pembeli?"

---

## Tips 5: Bedakan Requirement Fungsional dan Non-Fungsional

Ini sering dicampur aduk dalam satu dokumen, yang membuat FSD jadi lebih susah dibaca.

**Requirement fungsional** menjawab: *"Apa yang sistem harus lakukan?"*
Contoh: "Sistem harus memungkinkan pengguna mengubah alamat pengiriman sebelum order diproses."

**Requirement non-fungsional** menjawab: *"Seberapa baik sistem harus melakukannya?"*
Contoh: "Halaman konfirmasi order harus termuat dalam < 3 detik pada koneksi 4G."

Pisahkan keduanya — bisa di bagian berbeda dalam satu dokumen, atau buat dokumen NFR (*Non-Functional Requirements*) tersendiri untuk proyek yang lebih besar. Developer yang mengerjakan fitur tidak harus selalu membaca semua requirement performa, sementara tim DevOps yang menyiapkan infrastruktur sangat membutuhkan detail itu.

---

## Tips 6: Beri Nomor Versi dan Changelog yang Rapi

FSD nyaris selalu berubah selama proyek berlangsung. Requirement direvisi, ada fitur yang ditambah, ada yang dipotong karena keterbatasan waktu.

Kalau kamu tidak mengelola perubahan dengan rapi, tim akan bingung: *dokumen mana yang paling baru? perubahan apa yang sudah disetujui?*

Format changelog sederhana di halaman pertama dokumen sudah cukup:

| Versi | Tanggal | Deskripsi Perubahan | Diubah oleh |
|---|---|---|---|
| 1.0 | 10 Jan 2025 | Dokumen awal — modul checkout dan pembayaran | Amrizal |
| 1.1 | 22 Jan 2025 | Penambahan fitur split payment, revisi business rule BR-004 | Amrizal |
| 1.2 | 5 Feb 2025 | Fitur loyalty point dipindahkan ke fase 2 (scope reduction) | Amrizal |

Changelog ini juga sangat berguna ketika ada dispute di akhir proyek: "bukannya fitur ini sudah disepakati ada?" — kamu tinggal tunjuk versi dan tanggalnya.

---

## Tips 7: Review Bareng Developer dan QA Sebelum Di-sign Off

FSD yang belum divalidasi oleh orang yang akan menggunakannya adalah FSD yang belum selesai.

Jadwalkan sesi review singkat — bisa 1–2 jam — khusus dengan lead developer dan lead QA sebelum dokumen difinalisasi. Bukan untuk presentasi, tapi untuk **walkthrough** dan **pertanyaan terbuka**:

- *"Ada bagian yang kurang jelas untuk diimplementasikan?"*
- *"Ada skenario yang menurutmu belum tercakup?"*
- *"Apakah business rule ini sudah cukup untuk menulis test case?"*

Feedback dari sesi ini hampir selalu menghasilkan setidaknya satu atau dua perbaikan signifikan yang tidak akan kamu temukan kalau hanya review sendiri.

---

## Penutup: FSD yang Baik Adalah yang Terus Dipakai

Ukuran keberhasilan FSD bukan tebalnya, bukan juga keindahan formatnya. Ukurannya sederhana: **apakah dokumen ini benar-benar dirujuk oleh tim selama proyek berlangsung?**

Kalau developer buka FSD saat ada pertanyaan implementasi — berhasil. Kalau QA tulis test case langsung dari FSD — berhasil. Kalau PM pakai FSD untuk menjelaskan scope ke klien — berhasil.

Kalau dokumennya hanya dibuka saat ditanya "mana FSD-nya?" untuk keperluan audit — ada yang perlu diperbaiki di proyek berikutnya.

Mulai dari satu tips di atas, terapkan di proyek kamu yang sedang berjalan, dan lihat perbedaannya.

---

*Kamu punya kebiasaan atau template FSD yang sudah terbukti di proyek nyata? Saya selalu senang belajar dari pendekatan orang lain — share di komentar!*