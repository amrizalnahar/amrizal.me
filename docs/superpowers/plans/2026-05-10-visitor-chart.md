# Visitor Chart Dashboard Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Tambah grafik line chart di dashboard admin untuk menampilkan statistik pengunjung harian (total visits + unique visitors) dengan toggle rentang waktu 7/30 hari.

**Architecture:** Extend komponen Livewire `Dashboard` yang sudah ada dengan property `$visitorRange` dan computed property `visitorStats()` untuk query daily aggregation. Chart.js di-load via CDN di admin layout. Blade render card grafik dengan Alpine `x-init` untuk inisialisasi Chart.js setiap kali Livewire re-render.

**Tech Stack:** Laravel Livewire 3.6, Alpine.js, Chart.js 4.x (CDN), Tailwind CSS

---

## File Structure

| File | Action | Responsibility |
|------|--------|--------------|
| `resources/views/layouts/admin.blade.php` | Modify | Load Chart.js CDN |
| `app/Livewire/Admin/Dashboard.php` | Modify | Property `$visitorRange`, computed `visitorStats()`, query aggregation |
| `resources/views/livewire/admin/dashboard.blade.php` | Modify | Card grafik full-width: header + toggle + canvas + footer summary |

---

### Task 1: Load Chart.js CDN di Admin Layout

**Files:**
- Modify: `resources/views/layouts/admin.blade.php`

- [ ] **Step 1: Tambah script tag Chart.js CDN sebelum `</body>`**

  Letakkan setelah SortableJS (baris ~22) dan sebelum `@livewireScripts`.

  ```blade
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
  ```

  Edit bagian bawah `admin.blade.php` (sebelum `@livewireScripts`):

  ```blade
      <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
      @livewireScripts
  </body>
  ```

- [ ] **Step 2: Commit**

  ```bash
  git add resources/views/layouts/admin.blade.php
  git commit -m "feat: add Chart.js CDN to admin layout"
  ```

---

### Task 2: Extend Dashboard Livewire Component

**Files:**
- Modify: `app/Livewire/Admin/Dashboard.php`

- [ ] **Step 1: Tambah property dan import**

  Tambahkan import `Visitor` model dan property `$visitorRange` di class `Dashboard`:

  ```php
  use App\Models\Visitor;
  ```

  Di dalam class, tambahkan property:

  ```php
  public string $visitorRange = '7';
  ```

- [ ] **Step 2: Tambah computed property `visitorStats()`**

  Tambahkan method berikut di class `Dashboard` (setelah property, sebelum `render()`):

  ```php
  use Livewire\Attributes\Computed;
  use Illuminate\Support\Facades\Schema;
  use Illuminate\Support\Facades\DB;

  #[Computed]
  public function visitorStats(): array
  {
      if (! Schema::hasTable('visitors')) {
          return [];
      }

      $days = (int) $this->visitorRange;
      $endDate = now()->endOfDay();
      $startDate = now()->subDays($days - 1)->startOfDay();

      $rawStats = Visitor::query()
          ->whereBetween('visited_at', [$startDate, $endDate])
          ->selectRaw('DATE(visited_at) as date, COUNT(*) as total, COUNT(DISTINCT ip_address) as unique_visitors')
          ->groupBy('date')
          ->orderBy('date')
          ->get()
          ->keyBy('date');

      $stats = [];
      for ($i = $days - 1; $i >= 0; $i--) {
          $date = now()->subDays($i);
          $dateKey = $date->format('Y-m-d');
          $dayStats = $rawStats->get($dateKey);

          $stats[] = [
              'date' => $dateKey,
              'date_label' => $date->translatedFormat('d M'),
              'total' => (int) ($dayStats?->total ?? 0),
              'unique' => (int) ($dayStats?->unique_visitors ?? 0),
          ];
      }

      return $stats;
  }
  ```

- [ ] **Step 3: Commit**

  ```bash
  git add app/Livewire/Admin/Dashboard.php
  git commit -m "feat: add visitorStats computed property to Dashboard"
  ```

---

### Task 3: Tambah Card Grafik ke Dashboard Blade

**Files:**
- Modify: `resources/views/livewire/admin/dashboard.blade.php`

- [ ] **Step 1: Tambah card grafik di atas grid aktivitas**

  Sisipkan card baru setelah closing `</div>` statistik cards (setelah baris 61) dan sebelum `<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">` (baris 63).

  ```blade
  <!-- Visitor Chart -->
  @if(Schema::hasTable('visitors'))
      <div class="bg-white rounded-xl shadow-sm border border-neutral-200 mb-6" x-data="{ chart: null }" x-init="
          const ctx = $refs.chartCanvas.getContext('2d');
          const stats = @js($this->visitorStats);

          if (stats.length === 0) return;

          if (chart) chart.destroy();

          chart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: stats.map(s => s.date_label),
                  datasets: [
                      {
                          label: 'Total Kunjungan',
                          data: stats.map(s => s.total),
                          borderColor: '#1A6FAA',
                          backgroundColor: 'rgba(26, 111, 170, 0.08)',
                          borderWidth: 2,
                          pointRadius: 3,
                          pointHoverRadius: 5,
                          fill: true,
                          tension: 0.4,
                      },
                      {
                          label: 'Unique Visitor',
                          data: stats.map(s => s.unique),
                          borderColor: '#2E7D52',
                          backgroundColor: 'transparent',
                          borderWidth: 2,
                          borderDash: [6, 4],
                          pointRadius: 3,
                          pointHoverRadius: 5,
                          fill: false,
                          tension: 0.4,
                      }
                  ]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  interaction: {
                      mode: 'index',
                      intersect: false,
                  },
                  plugins: {
                      legend: {
                          position: 'bottom',
                          labels: {
                              usePointStyle: true,
                              padding: 16,
                              font: { size: 12 }
                          }
                      },
                      tooltip: {
                          backgroundColor: 'rgba(40, 9, 5, 0.9)',
                          titleFont: { size: 12 },
                          bodyFont: { size: 12 },
                          padding: 10,
                          cornerRadius: 8,
                          displayColors: true,
                      }
                  },
                  scales: {
                      x: {
                          grid: { display: false },
                          ticks: { font: { size: 11 }, color: '#737373' }
                      },
                      y: {
                          beginAtZero: true,
                          ticks: { precision: 0, font: { size: 11 }, color: '#737373' },
                          grid: { color: '#f5f5f5' },
                          border: { display: false }
                      }
                  }
              }
          });
      ">
          <div class="px-5 py-4 border-b border-neutral-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
              <h3 class="font-semibold text-neutral-800">Statistik Pengunjung</h3>
              <div class="inline-flex rounded-lg border border-neutral-200 overflow-hidden">
                  <button
                      wire:click="$set('visitorRange', '7')"
                      @class([
                          'px-3 py-1.5 text-xs font-medium transition-colors',
                          $visitorRange === '7' ? 'bg-primary-600 text-white' : 'bg-white text-neutral-600 hover:bg-neutral-50'
                      ])
                  >7 Hari</button>
                  <button
                      wire:click="$set('visitorRange', '30')"
                      @class([
                          'px-3 py-1.5 text-xs font-medium transition-colors border-l border-neutral-200',
                          $visitorRange === '30' ? 'bg-primary-600 text-white' : 'bg-white text-neutral-600 hover:bg-neutral-50'
                      ])
                  >30 Hari</button>
              </div>
          </div>
          <div class="p-5">
              @php
                  $visitorStats = $this->visitorStats;
                  $hasData = count($visitorStats) > 0 && collect($visitorStats)->sum('total') > 0;
              @endphp

              @if($hasData)
                  <div style="height: 300px;">
                      <canvas x-ref="chartCanvas"></canvas>
                  </div>
                  <div class="mt-4 flex items-center gap-6 text-sm">
                      @php
                          $totalVisits = collect($visitorStats)->sum('total');
                          $avgVisits = round($totalVisits / count($visitorStats), 1);
                      @endphp
                      <div>
                          <span class="text-neutral-500">Total:</span>
                          <span class="font-semibold text-neutral-800 ml-1">{{ number_format($totalVisits) }}</span>
                      </div>
                      <div>
                          <span class="text-neutral-500">Rata-rata/hari:</span>
                          <span class="font-semibold text-neutral-800 ml-1">{{ $avgVisits }}</span>
                      </div>
                  </div>
              @else
                  <div class="py-12 text-center">
                      <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mx-auto mb-3">
                          <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                      </div>
                      <p class="text-sm text-neutral-500">Belum ada data pengunjung untuk periode ini.</p>
                  </div>
              @endif
          </div>
      </div>
  @endif
  ```

  **Penjelasan edit:**
  - Card baru disisipkan setelah section statistik cards (setelah `</div>` penutup grid 4 kolom) dan sebelum `<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">` aktivitas.
  - `@if(Schema::hasTable('visitors'))` guard sama seperti stat card lainnya.
  - Alpine `x-data` dan `x-init` handle Chart.js lifecycle: setiap Livewire re-render, Alpine re-init dan destroy chart lama.
  - Toggle 7/30 hari pakai `wire:click="$set('visitorRange', ...)"` — Livewire update property, trigger re-render, Alpine re-init chart dengan data baru.
  - Summary footer: total visits + rata-rata per hari.
  - Empty state: tampilkan pesan jika data kosong.

- [ ] **Step 2: Commit**

  ```bash
  git add resources/views/livewire/admin/dashboard.blade.php
  git commit -m "feat: add visitor chart card to dashboard"
  ```

---

### Task 4: Verifikasi Dashboard Load

**Files:**
- Test: Manual browser verification

- [ ] **Step 1: Clear compiled views**

  ```bash
  php artisan view:clear
  ```

- [ ] **Step 2: Buka /admin/dashboard di browser**

  Expected:
  - Card "Statistik Pengunjung" muncul di atas "Aktivitas Terakhir"
  - Toggle "7 Hari" aktif (primary color)
  - Chart line render dengan 2 garis (solid biru + dashed hijau)
  - Hover pada chart menampilkan tooltip dengan angka exact
  - Summary footer menampilkan total dan rata-rata

- [ ] **Step 3: Klik toggle "30 Hari"**

  Expected:
  - Chart re-render dengan 30 data point
  - Toggle "30 Hari" jadi aktif, "7 Hari" jadi inactive
  - Total dan rata-rata di footer terupdate

- [ ] **Step 4: Commit (jika ada fix)**

  Jika tidak ada perubahan kode, skip commit.

---

## Self-Review

**1. Spec coverage:**
- [x] Grafik line chart dengan 2 dataset (total + unique) → Task 3
- [x] Toggle 7/30 hari → Task 2 + Task 3
- [x] Posisi full-width di atas aktivitas → Task 3
- [x] Chart.js via CDN → Task 1
- [x] Guard `Schema::hasTable('visitors')` → Task 2 + Task 3
- [x] Empty state → Task 3
- [x] Summary footer (total + rata-rata) → Task 3
- [x] Tooltip & legenda → Task 3

**2. Placeholder scan:** Tidak ada TBD, TODO, atau placeholder.

**3. Type consistency:** Property `$visitorRange` bertipe `string` (karena Livewire form input), dikonversi ke `int` di query. Computed `visitorStats()` return `array`. Chart.js config konsisten dengan Chart.js 4.x UMD build.

**Gap fix:** Menambahkan `chart.destroy()` sebelum membuat chart baru untuk mencegah memory leak saat Livewire re-render.
