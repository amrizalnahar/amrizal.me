# Desain Grafik Visitor Dashboard

## Ringkasan
Tambah card grafik line chart di dashboard admin untuk menampilkan statistik pengunjung harian (total visits + unique visitors) dengan rentang waktu toggle 7/30 hari.

## Metrik
- **Total visits**: jumlah semua record `Visitor` per hari
- **Unique visitors**: distinct `ip_address` per hari

## Rentang Waktu
Toggle pill button: 7 Hari / 30 Hari. Default: 7 hari.

## Posisi
Card full-width di atas section "Aktivitas Terakhir" pada dashboard.

## Teknologi
- **Chart.js** via CDN (konsisten dengan Trix & SortableJS yang sudah ada di admin layout)
- **Alpine.js** untuk init chart dan re-init saat Livewire re-render
- **Livewire** untuk state toggle dan query data

## Perubahan File

### Backend
- `app/Livewire/Admin/Dashboard.php`
  - Tambah property `$visitorRange = '7'`
  - Tambah computed property `visitorStats()`
  - Query daily aggregation dari tabel `visitors`
  - Guard dengan `Schema::hasTable('visitors')`

### Frontend
- `resources/views/livewire/admin/dashboard.blade.php`
  - Card grafik full-width baru di atas grid aktivitas
  - Header: judul + toggle 7/30 hari
  - Body: `<canvas>` dengan `x-data` Alpine
  - Footer: summary total & rata-rata
  - Empty state jika tabel/data tidak ada

- `resources/views/layouts/admin.blade.php`
  - Load Chart.js CDN sebelum `</body>`

## Chart.js Config
- Type: `line`
- Dataset 1 (total visits): garis solid, warna primary (`#1A6FAA`)
- Dataset 2 (unique visitors): garis dashed, warna emerald (`#2E7D52`)
- X-axis: tanggal format "10 Mei"
- Y-axis: jumlah kunjungan
- Tooltip: exact count per tanggal
- Legenda: di bawah canvas

## Data Flow
1. Dashboard load → `render()` panggil `visitorStats()`
2. Query group by date untuk N hari terakhir
3. Blade inject JSON ke `x-data` Alpine
4. Alpine `x-init` inisialisasi Chart.js
5. Toggle range → Livewire update `$visitorRange` → re-render → Alpine re-init chart

## Error Handling
- Tabel `visitors` belum ada: tampilkan pesan "Data pengunjung belum tersedia"
- Data kosong: chart tetap render di 0
- CDN Chart.js gagal: fallback ke tabel statistik sederhana

## Testing
- Verifikasi query `visitorStats()` return array dengan key `date`, `total`, `unique`
- Verifikasi toggle 7/30 hari mengubah jumlah data point
