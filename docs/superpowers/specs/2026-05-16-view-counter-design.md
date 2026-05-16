# View Counter for Blog Posts and Projects

## Overview
Add view counters to blog post and project detail pages, with visibility in the admin panel tables so administrators can monitor which content is most popular.

## Scope
- Blog posts (`Post` model, `posts` table)
- Projects (`Project` model, `projects` table)
- Admin monitoring via existing Livewire tables (`BeritaTable`, `ProjectTable`)

## Out of Scope
- Analytics dashboard or charts
- Daily/weekly/monthly view breakdowns
- Geographic or demographic analytics
- Export functionality for view data

## Architecture

### Data Model

**Existing:** `posts` table already has `views` column (unsignedBigInteger, default 0).

**New migration:** Add `views` column to `projects` table:
```php
$table->unsignedBigInteger('views')->default(0)->after('sort_order');
```

**Model updates:**
- Add `'views'` to `$fillable` in both `Post` and `Project` models for consistency.

### Public Controllers — Session-Based Deduplication

Use session key per item to prevent duplicate counting during a single browser session.

**`BeritaController::show()`:**
```php
if (!session()->has("viewed_post_{$post->id}")) {
    $post->increment('views');
    session()->put("viewed_post_{$post->id}", true);
}
```

**`ProjectController::show()`:**
```php
if (!session()->has("viewed_project_{$project->id}")) {
    $project->increment('views');
    session()->put("viewed_project_{$project->id}", true);
}
```

Session expires when browser closes. Repeat visitors on a new session are counted again.

### Admin Livewire Tables

**`BeritaTable`:**
- Add `views` as a sortable column
- Include `views` in the query select (already covered by `*`)

**`ProjectTable`:**
- Add `views` as a sortable column
- Include `views` in the query select

### Admin Blade Views

Update `livewire/admin/berita-table.blade.php` and `livewire/admin/project-table.blade.php`:
- Add "Views" column header
- Display view count per row
- Make column header clickable for sorting

## Acceptance Criteria

1. Opening a blog post detail page increments its view count by 1 per browser session
2. Opening a project detail page increments its view count by 1 per browser session
3. Refreshing the same page in the same session does NOT increment the counter
4. Admin Berita table displays a "Views" column showing the current count
5. Admin Project table displays a "Views" column showing the current count
6. Both admin columns are sortable ascending/descending
7. Existing data remains intact (new column defaults to 0)

## Files to Modify

| File | Change |
|------|--------|
| `database/migrations/..._add_views_to_projects_table.php` | New migration |
| `app/Models/Post.php` | Add `views` to `$fillable` |
| `app/Models/Project.php` | Add `views` to `$fillable` |
| `app/Http/Controllers/Public/BeritaController.php` | Add session-based increment |
| `app/Http/Controllers/Public/ProjectController.php` | Add session-based increment |
| `app/Livewire/Admin/BeritaTable.php` | Add sort support for `views` |
| `app/Livewire/Admin/ProjectTable.php` | Add sort support for `views` |
| `resources/views/livewire/admin/berita-table.blade.php` | Add views column |
| `resources/views/livewire/admin/project-table.blade.php` | Add views column |
