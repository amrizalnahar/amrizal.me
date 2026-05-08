# 5 Kesalahan Umum System Analyst Pemula (dan Cara Menghindarinya)

*Tips & Insight · 7 menit baca*

---

Tidak ada SA yang lahir langsung mahir. Semua orang melewati fase di mana dokumennya terlalu panjang, diagramnya terlalu rumit, atau requirement-nya ternyata tidak sesuai ekspektasi stakeholder saat UAT tiba.

Artikel ini bukan untuk menghakimi — ini catatan dari kesalahan yang pernah saya lakukan sendiri, atau yang sering saya lihat pada SA junior yang saya mentori. Semoga bisa jadi shortcut buat kamu supaya tidak harus belajar dari cara yang lebih mahal: kegagalan proyek.

---

## Kesalahan #1: Langsung Nulis Dokumen Sebelum Benar-Benar Paham Masalahnya

Ini yang paling sering terjadi, terutama kalau kamu baru bergabung di sebuah tim atau proyek. Ada tekanan untuk segera terlihat produktif, dan produktif artinya menghasilkan dokumen.

Jadi kamu mulai mengetik FSD atau BRD berdasarkan asumsi awal, brief dari PM, atau dokumen proyek sebelumnya yang "mirip".

Masalahnya: **dokumen yang dibuat dari asumsi akan menghasilkan sistem yang menjawab masalah yang salah.**

**Solusinya:** Tahan keinginan untuk langsung menulis. Luangkan waktu yang cukup — minimal 20-30% dari total waktu analisis — hanya untuk mendengar dan mengamati. Interview stakeholder, ikuti proses bisnis secara langsung, tanyakan pertanyaan "bodoh" yang sebenarnya tidak bodoh sama sekali.

Dokumen yang baik hanya bisa muncul dari pemahaman yang baik.

---

## Kesalahan #2: Menulis Requirement yang Ambigu

Perhatikan kalimat-kalimat seperti ini di dokumen requirement:

- *"Sistem harus berjalan dengan cepat"*
- *"Laporan harus mudah dipahami"*
- *"Fitur pencarian harus user-friendly"*

Terdengar wajar, kan? Tapi coba tanya ke developer dan QA: seberapa cepat itu "cepat"? Siapa yang menentukan laporan itu "mudah dipahami"? Apa parameter "user-friendly"?

Requirement yang ambigu adalah bom waktu. Semua orang akan setuju di awal — karena setiap orang mengartikannya berbeda sesuai ekspektasi masing-masing. Masalah baru akan meledak saat testing atau go-live.

**Solusinya:** Jadikan requirement *measurable* dan *testable*.

- ❌ "Sistem harus berjalan dengan cepat"
- ✅ "Halaman daftar produk harus memuat dalam waktu < 2 detik dengan kondisi 1.000 record dan koneksi internet normal"

- ❌ "Fitur pencarian harus user-friendly"
- ✅ "Pengguna dapat menemukan produk yang dicari dalam maksimal 3 langkah dari halaman utama"

Kalau requirement tidak bisa ditest, berarti belum selesai ditulis.

---

## Kesalahan #3: Bekerja Sendiri, Tidak Melibatkan Developer Lebih Awal

SA sering dianggap — dan kadang menganggap dirinya — sebagai pihak yang harus menyerahkan dokumen "selesai" ke developer, lalu developer tinggal mengeksekusi.

Realitanya, pendekatan ini sangat berisiko.

Saya pernah menghabiskan seminggu merancang alur sistem yang elegan secara konseptual, hanya untuk mengetahui saat review bahwa salah satu komponen kunci yang saya asumsikan mudah dibangun ternyata butuh integrasi pihak ketiga yang tidak ada dalam budget proyek.

**Solusinya:** Libatkan lead developer sejak fase analisis. Bukan untuk meminta mereka menulis kode lebih awal — tapi untuk mendapatkan masukan teknis awal (*technical sanity check*) sebelum kamu terlanjur berkomitmen ke stakeholder.

Developer yang baik akan membantu kamu mengidentifikasi mana requirement yang mudah, mana yang mahal, dan mana yang mungkin ada solusi alternatif yang lebih efisien.

---

## Kesalahan #4: Takut Bilang "Saya Tidak Tahu"

Ini lebih ke masalah psikologis, tapi dampaknya sangat nyata di proyek.

SA sering merasa harus punya jawaban untuk semua pertanyaan — karena merekalah yang *seharusnya* paling tahu tentang sistem. Akibatnya, ketika ada pertanyaan yang belum punya jawabannya, sering kali SA memberikan jawaban yang sebenarnya masih asumsi.

Dan asumsi yang tidak pernah divalidasi adalah sumber masalah nomor satu di proyek IT.

**Solusinya:** Biasakan menggunakan tiga frasa ini:

1. *"Saya belum tahu, biarkan saya verifikasi dulu ke stakeholder."*
2. *"Ini asumsi saya saat ini — perlu dikonfirmasi."*
3. *"Ada dua kemungkinan di sini, kita perlu memutuskan yang mana."*

Frasa-frasa ini bukan tanda kelemahan. Ini tanda profesionalisme. Stakeholder dan developer akan jauh lebih respek kepada SA yang jujur tentang ketidakpastian dibanding SA yang memberikan jawaban meyakinkan yang ternyata salah.

---

## Kesalahan #5: Menganggap Dokumen Selesai = Pekerjaan Selesai

Ini kesalahpahaman yang paling fundamental soal peran SA.

Membuat BRD, FSD, dan semua diagram memang inti dari pekerjaan SA. Tapi dokumen yang diserahkan ke tim dan tidak pernah disentuh lagi adalah dokumen yang gagal menjalankan fungsinya.

**Pekerjaan SA tidak selesai saat dokumen di-sign off.** Pekerjaan SA selesai saat sistem yang dibangun benar-benar menjawab kebutuhan bisnis yang tertulis di dokumen itu.

Artinya, SA harus tetap terlibat selama fase development dan testing:
- Menjawab pertanyaan klarifikasi dari developer
- Hadir di sprint review untuk memvalidasi apakah yang dibangun sesuai spesifikasi
- Aktif di sesi UAT mendampingi pengguna bisnis
- Mendokumentasikan perubahan requirement yang terjadi selama proyek berlangsung

SA yang "menghilang" setelah dokumen selesai sering menjadi sumber konflik di akhir proyek.

---

## Penutup

Semua kesalahan di atas pernah saya lakukan — beberapa bahkan lebih dari sekali. Dan setiap kali membuat kesalahan itu, ada pelajaran yang tidak akan pernah terlupakan.

Yang membedakan SA yang berkembang dengan yang stagnan bukan ketiadaan kesalahan — tapi kemauan untuk merefleksikan setiap proyek dan mengidentifikasi: *apa yang bisa saya lakukan berbeda lain kali?*

Itulah kenapa saya suka menulis lessons learned setelah setiap proyek selesai. Bukan untuk arsip yang tidak pernah dibuka, tapi untuk jadi pengingat diri sendiri.

---

*Kamu punya pengalaman atau kesalahan spesifik yang ingin ditambahkan? Saya buka diskusi di kolom komentar — semakin banyak perspektif, semakin kaya pelajarannya.*