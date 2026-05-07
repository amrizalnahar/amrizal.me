# Design: Badge Tipe Proyek pada Portofolio

## Ringkasan
Menambahkan identifikasi tipe proyek (Pribadi / Kantor) pada setiap kartu proyek di halaman Portofolio, dengan nama perusahaan yang ditampilkan untuk proyek dari kantor.

## Scope
- Mengubah user story US-08 (Melihat Daftar Proyek)
- Menentukan struktur data tambahan untuk proyek
- Tidak termasuk: fitur filter berdasarkan tipe proyek

## Acceptance Criteria (US-08)
Acceptance criteria yang sudah ada tetap dipertahankan. Ditambahkan:

- Setiap kartu proyek menampilkan **badge tipe proyek** yang menunjukkan apakah proyek bersifat **Pribadi** atau **Kantor**
- Jika tipe proyek adalah **Kantor**, badge menampilkan **nama perusahaan** setelah label tipe (contoh: "Kantor — PT ABC Technology")
- Label badge ("Pribadi" / "Personal" dan "Kantor" / "Office") menyesuaikan bahasa aktif; nama perusahaan tidak diterjemahkan

## Struktur Data
Setiap entri proyek memerlukan field tambahan:

```json
{
  "type": "personal" | "office",
  "companyName": "string (opsional, wajib jika type = office)"
}
```

- `type`: enum string, hanya menerima nilai `"personal"` atau `"office"`
- `companyName`: string bebas, disimpan sebagai plain text (tidak bilingual)

## UI/UX
- Badge ditampilkan sebagai tag/chip sederhana pada kartu proyek
- Posisi: area yang mudah terlihat (rekomendasi: di bawah judul proyek atau pojok kanan atas thumbnail)
- Tidak menggunakan ikon khusus, hanya teks label
- Style badge mengikuti tema aktif (dark/light mode)

## Dependensi
- Fitur bilingual (US-15) — label badge harus bisa diterjemahkan
- Fitur dark mode (US-14) — style badge harus adaptif
