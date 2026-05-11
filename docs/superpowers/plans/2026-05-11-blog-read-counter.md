# Blog Read Counter Display — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Tampilkan counter jumlah views pada halaman detail blog di baris metadata artikel.

**Architecture:** Hanya modifikasi Blade view dan translation file. Tidak ada perubahan backend karena increment views sudah aktif di controller.

**Tech Stack:** Laravel Blade, Tailwind CSS, Heroicons SVG

---

### Task 1: Add Translation Keys

**Files:**
- Modify: `lang/en/public.php`
- Modify: `lang/id/public.php`

- [ ] **Step 1: Add `views` key to EN translations**

Tambahkan di dalam array `common`, setelah `min_read`:

```php
'views' => 'views',
```

- [ ] **Step 2: Add `views` key to ID translations**

Tambahkan di dalam array `common`, setelah `min_read`:

```php
'views' => 'kali dibaca',
```

- [ ] **Step 3: Commit**

```bash
git add lang/en/public.php lang/id/public.php
git commit -m "feat(i18n): add views translation keys for blog read counter"
```

---

### Task 2: Display Views Counter in Blog Detail View

**Files:**
- Modify: `resources/views/pages/blog/show.blade.php:29`

- [ ] **Step 1: Update metadata line to include views**

Ubah baris:
```blade
<span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $post->published_at?->format('d M Y') }} · {{ ceil(str_word_count(strip_tags($post->localize('content'))) / 200) }} <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span></span>
```

Menjadi:
```blade
<span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $post->published_at?->format('d M Y') }} · {{ ceil(str_word_count(strip_tags($post->localize('content'))) / 200) }} <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span> · <span class="inline-flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> {{ number_format($post->views) }} <span data-i18n="common.views">{{ __('public.common.views') }}</span></span></span>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/blog/show.blade.php
git commit -m "feat(blog): display read counter on article detail page"
```

---

## Self-Review Checklist

- [x] Spec coverage: Semua requirement dari design doc tercakup
- [x] Placeholder scan: Tidak ada TBD/TODO
- [x] Type consistency: Property `views` ada di migration, `$post->views` valid
- [x] Translation keys konsisten di EN dan ID
