# View Counter Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add session-deduplicated view counters to blog posts and projects, with sortable views column in admin Livewire tables.

**Architecture:** Session-based deduplication prevents double-counting from the same browser. `increment()` is used for atomic DB updates. Admin tables expose `views` as a sortable column between Status and Date/Order.

**Tech Stack:** Laravel 13.x, Livewire 3.6, MySQL/SQLite

---

## File Map

| File | Responsibility |
|------|---------------|
| New migration | Adds `views` column to `projects` table |
| `app/Models/Post.php` | Adds `views` to `$fillable` |
| `app/Models/Project.php` | Adds `views` to `$fillable` |
| `app/Http/Controllers/Public/BeritaController.php` | Wraps `$post->increment('views')` with session deduplication |
| `app/Http/Controllers/Public/ProjectController.php` | Adds session-deduplicated view increment to `show()` |
| `app/Livewire/Admin/BeritaTable.php` | Allows `views` as sortable field |
| `app/Livewire/Admin/ProjectTable.php` | Allows `views` as sortable field |
| `resources/views/livewire/admin/berita-table.blade.php` | Adds "Views" column between Status and Tanggal |
| `resources/views/livewire/admin/project-table.blade.php` | Adds "Views" column between Status and Urutan |

---

### Task 1: Add `views` column to projects table

**Files:**
- Create: `database/migrations/2026_05_16_000001_add_views_to_projects_table.php`

- [ ] **Step 1: Create migration**

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0)->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
};
```

- [ ] **Step 2: Run migration**

Run: `php artisan migrate`
Expected: Migration completes successfully.

- [ ] **Step 3: Commit**

```bash
git add database/migrations/2026_05_16_000001_add_views_to_projects_table.php
git commit -m "feat: add views column to projects table"
```

---

### Task 2: Add `views` to model fillable

**Files:**
- Modify: `app/Models/Post.php`
- Modify: `app/Models/Project.php`

- [ ] **Step 1: Update Post `$fillable`**

In `app/Models/Post.php`, add `'views'` to the `$fillable` array after `author_id`:

```php
    protected $fillable = [
        'title_id',
        'title_en',
        'slug',
        'content_id',
        'content_en',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'category_id',
        'thumbnail',
        'status',
        'published_at',
        'author_id',
        'views',
    ];
```

- [ ] **Step 2: Update Project `$fillable`**

In `app/Models/Project.php`, add `'views'` after `sort_order`:

```php
    protected $fillable = [
        'title_id', 'title_en', 'slug',
        'type', 'company_name',
        'short_description_id', 'short_description_en',
        'full_description_id', 'full_description_en',
        'role', 'period',
        'demo_url', 'repo_url',
        'thumbnail', 'gallery',
        'status', 'sort_order',
        'views',
    ];
```

- [ ] **Step 3: Commit**

```bash
git add app/Models/Post.php app/Models/Project.php
git commit -m "feat: add views to Post and Project fillable"
```

---

### Task 3: Add session-deduplicated view counting in controllers

**Files:**
- Modify: `app/Http/Controllers/Public/BeritaController.php`
- Modify: `app/Http/Controllers/Public/ProjectController.php`

- [ ] **Step 1: Wrap Post increment with session check**

In `app/Http/Controllers/Public/BeritaController.php`, replace line 44:

```php
        if (! session()->has("viewed_post_{$post->id}")) {
            $post->increment('views');
            session()->put("viewed_post_{$post->id}", true);
        }
```

- [ ] **Step 2: Add Project increment with session check**

In `app/Http/Controllers/Public/ProjectController.php`, after line 12 (`$project = ...`), add before the `$relatedProjects` query:

```php
        if (! session()->has("viewed_project_{$project->id}")) {
            $project->increment('views');
            session()->put("viewed_project_{$project->id}", true);
        }
```

- [ ] **Step 3: Commit**

```bash
git add app/Http/Controllers/Public/BeritaController.php app/Http/Controllers/Public/ProjectController.php
git commit -m "feat: add session-deduplicated view counting for posts and projects"
```

---

### Task 4: Allow `views` sorting in Livewire tables

**Files:**
- Modify: `app/Livewire/Admin/BeritaTable.php`
- Modify: `app/Livewire/Admin/ProjectTable.php`

- [ ] **Step 1: Update BeritaTable `sortBy` method**

In `app/Livewire/Admin/BeritaTable.php`, replace the `sortBy` method with a whitelist:

```php
    public function sortBy(string $field): void
    {
        if (! in_array($field, ['title', 'published_at', 'views', 'created_at'])) {
            return;
        }

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
```

- [ ] **Step 2: Update ProjectTable `sortBy` method**

In `app/Livewire/Admin/ProjectTable.php`, replace the `sortBy` method with a whitelist:

```php
    public function sortBy(string $field): void
    {
        if (! in_array($field, ['title_id', 'status', 'sort_order', 'views', 'created_at'])) {
            return;
        }

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
```

- [ ] **Step 3: Commit**

```bash
git add app/Livewire/Admin/BeritaTable.php app/Livewire/Admin/ProjectTable.php
git commit -m "feat: allow sorting by views in admin tables"
```

---

### Task 5: Add Views column to admin table views

**Files:**
- Modify: `resources/views/livewire/admin/berita-table.blade.php`
- Modify: `resources/views/livewire/admin/project-table.blade.php`

- [ ] **Step 1: Add Views column to berita-table**

In `resources/views/livewire/admin/berita-table.blade.php`:

1. In the `<thead>` row, after the Status header (line 96) and before the Tanggal header (line 97), insert:

```blade
                        <th class="px-4 py-3 cursor-pointer hover:text-neutral-800" wire:click="sortBy('views')">
                            Views {!! $sortField === 'views' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
```

2. In the `<tbody>` row, after the Status cell (line 143-144) and before the Tanggal cell (line 145), insert:

```blade
                            <td class="px-4 py-3 text-neutral-600">{{ number_format($post->views) }}</td>
```

3. Update empty state colspan from `9` to `10`:

```blade
                            <td colspan="10" class="px-5 py-8 text-center text-neutral-500">Tidak ada data berita.</td>
```

- [ ] **Step 2: Add Views column to project-table**

In `resources/views/livewire/admin/project-table.blade.php`:

1. In the `<thead>` row, after the Status header (line 51-53) and before the Urutan header (line 54), insert:

```blade
                        <th class="px-4 py-3 cursor-pointer hover:text-neutral-800" wire:click="sortBy('views')">
                            Views {!! $sortField === 'views' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
```

2. In the `<tbody>` row, after the Status cell (line 79-82) and before the Urutan cell (line 83), insert:

```blade
                            <td class="px-4 py-3 text-neutral-600">{{ number_format($project->views) }}</td>
```

3. Update empty state colspan from `6` to `7`:

```blade
                            <td colspan="7" class="px-5 py-8 text-center text-neutral-500">Tidak ada data proyek.</td>
```

- [ ] **Step 3: Commit**

```bash
git add resources/views/livewire/admin/berita-table.blade.php resources/views/livewire/admin/project-table.blade.php
git commit -m "feat: add sortable views column to admin project and article tables"
```

---

## Spec Coverage

| Spec Requirement | Task |
|-----------------|------|
| `views` column on projects | Task 1 |
| `views` in `$fillable` for both models | Task 2 |
| Session-deduplicated increment for posts | Task 3, Step 1 |
| Session-deduplicated increment for projects | Task 3, Step 2 |
| Sortable views column in BeritaTable | Tasks 4, 5 |
| Sortable views column in ProjectTable | Tasks 4, 5 |

## Placeholder Scan

- No TBD/TODO/fill-in-details found.
- Every step includes exact code.
- All file paths are exact.
