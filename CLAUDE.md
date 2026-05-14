# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Bilingual (ID/EN) personal portfolio CMS for **amrizal.site**. Full Laravel application with a public frontend and an admin panel. Public visitors see a portfolio (home, about, blog, projects, contact); admins manage content via Livewire components.

## Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 13.x |
| CMS UI | Livewire 3.6 |
| CSS | Tailwind CSS 3.1 |
| Auth | Laravel Breeze 2.4 (Livewire stack) |
| RBAC | Spatie Laravel Permission 7.3 |
| Excel Export | PhpSpreadsheet 3.x |
| Rich Text | Trix Editor |
| Database | MySQL 8.x (local) / SQLite (cloud) |
| Mail (dev) | Mailpit (SMTP port 1025, Web UI 8025) |

## Common Commands

```bash
# Development (runs artisan serve, queue listener, pail logs, and Vite in parallel)
composer dev

# One-time setup (install, env, key, migrate, npm build)
composer setup

# Production deploy (migrate + config/route/view cache)
composer deploy

# Run all tests
php artisan test
# or
composer test

# Run a single test
php artisan test --filter=TestName

# Build assets
npm run build

# Development asset watch
npm run dev

# Fresh database with seeders
php artisan migrate:fresh --seed

# Lint PHP
vendor/bin/pint
```

## Architecture

### Public Frontend
- Blade SSR via controllers in `app/Http/Controllers/Public/`
- Views in `resources/views/pages/`
- Alpine.js for client-side interactivity (filters, search, toast notifications)
- No pagination — filtering done client-side with `x-show`

### Admin CMS
- Livewire components in `app/Livewire/Admin/`
- Views in `resources/views/livewire/admin/`
- Routes prefixed `/admin`, protected by `auth` + permission middleware
- Super-admin only routes (users, roles, settings, audit logs, system logs, email tester, queue monitor, schedule tasks) use `role:super-admin` middleware

### Auth
- Session-based via Laravel Breeze Livewire
- Three roles: `super-admin`, `editor`, `viewer`
- Viewer has read-only access; use `authorize()` in Livewire methods and `@can`/`@cannot` in Blade for gating
- Passwords are RSA-encrypted client-side before transmission; `DecryptPasswordMiddleware` decrypts them with a 60-second anti-replay window

### Localization (ID/EN)
- Bilingual content stored as dual fields: `*_id` (Indonesian) and `*_en` (English)
- `@localized($model, 'field')` Blade directive outputs the active locale, falling back: `_id` → `_en` → raw field name
- `HasLocalizable` trait adds `$model->localize('field')` and magic `_localized` accessors (e.g. `$post->title_localized`)
- `SetLocale` middleware reads `session('locale')` and applies it at the start of each request
- Locale switcher endpoint: `POST /locale` with body `locale=id|en`

### Models & Traits

All main models use `SoftDeletes` and `HasAuditTrail`. Common traits:

| Trait | Purpose |
|-------|---------|
| `HasAuditTrail` | Auto-logs every create/update/delete to `audit_trails` table with user, IP, old/new values |
| `HasSlug` | Auto-generates unique slug from `title` on create/update; respects soft deletes |
| `HasLocalizable` | Adds `localize()` and `_localized` accessors for bilingual fields |
| `HasCategory` | BelongsTo relationship to Category |
| `HasTags` | BelongsToMany relationship to Tag |

`Post` has a `published` scope: `status = 'published'` + `published_at <= now()` + not null.

### Category System
- Categories are polymorphic by `module_type`: `post`, etc.
- Unique constraints are composite: `module_type` + `slug` + `deleted_at` and `module_type` + `name` + `deleted_at`
- Validation rules scope uniqueness by `module_type`

### Site Settings
- `SiteSetting` model with key/value storage, cached for 5 minutes
- `SiteSetting::getValue('key')` reads from cache; `setValue()` writes and busts cache
- `AppServiceProvider::applySiteSettings()` dynamically overrides mail, SEO, and GA4 config from the database at boot time
- Config is refreshed before every queue job (`Queue::before`) so DB-driven changes are visible without restarting workers
- The provider wraps all `site_settings` reads in try-catch so booting is safe when the database is unavailable (build time, pre-migration)

### Design Tokens (Frontend)

Tailwind config (`tailwind.config.js`) defines:

- Primary: `#1A6FAA` / Primary Dark: `#124E7A` / Primary Light: `#E8F4FB`
- Secondary: `#2E7D52` / Secondary Light: `#E8F5EE`
- Accent: `#F5A623`
- Dark: `#1C2B39`
- Fonts: `Playfair Display` (headings, `font-display`) + `Nunito` (body, `font-body`)

### Route Organization

Routes in `routes/web.php` are grouped in three sections:
1. **Public** — no middleware, standard controllers
2. **Admin** — `auth` + `permission:*` middleware, `/admin` prefix
3. **Super Admin** — `auth` + `role:super-admin` middleware, same `/admin` prefix

### Cross-Database Compatibility

The app targets both MySQL (local) and SQLite (Laravel Cloud):
- `App\Helpers\DatabaseHelper` abstracts date functions (`YEAR`, `MONTH`, `DAY`, `DATE_FORMAT`) with driver-specific syntax (`YEAR()` vs `strftime()`)
- `composer install` auto-creates `database/database.sqlite` if missing via `post-autoload-dump`

### Visitor Tracking
- `TrackVisitor` middleware records public page visits (skips admin, XML/TXT, and known bots)
- Rate-limited to 1 record per IP + URL per 5 minutes

## Naming Conventions

| Artifact | Convention | Example |
|----------|-----------|---------|
| Model | `App\Models\*` | `Post` |
| Livewire class | `App\Livewire\Admin\*` | `BeritaTable` |
| Livewire view | `resources/views/livewire/admin/*.blade.php` | `berita-table.blade.php` |
| Policy | `App\Policies\*` | `PostPolicy` |
| Trait | `App\Traits\*` | `HasAuditTrail` |
| Public controller | `App\Http\Controllers\Public\*` | `BeritaController` |

## Database Rules

1. **Timestamps & Soft Deletes:** Every main table has `created_at`, `updated_at`, `deleted_at`.
2. **Audit Trail:** Every CUD operation is auto-logged to `audit_trails`.
3. **Unique + Soft Delete:** Unique constraints on `slug` and `name` are composite with `module_type` and `deleted_at`.
4. **Unique + Update:** Unique validation must ignore the current record ID on update.
5. **Conditional Validation:** If `status == 'draft'`, skip mandatory validation except for `title`/`name`. Full validation runs only on `published`.

## Important File References

| File | Purpose |
|------|---------|
| `docs/prd.md` | Full PRD: user stories, ERD, acceptance criteria, permission matrix |
| `docs/frontend-design-system.md` | Public page design tokens, wireframes, component specs |
| `docs/backend-design-system.md` | CMS layout, Livewire component specs, admin design tokens |
| `plans/frontend-execution-plan.md` | Completed HTML prototype instructions |
| `plans/backend-execution-plan.md` | Laravel/Livewire implementation plan |
| `html/` | Static HTML prototypes for all public pages (reference only) |

Always check these documents before implementing new features.

## Seeding

Realistic seeders exist for all models:
- `RolePermissionSeeder` — roles, permissions, and a default super-admin user
- `SiteSettingSeeder` — site configuration
- `ProfileSeeder` — profile data, vision/mission, track record
- `ContentSeeder` — posts, categories, tags
- `ExperienceSeeder` — work experience entries
- `EducationSeeder` — education entries
- `SkillSeeder` — skills and skill categories
- `ProjectSeeder` — portfolio projects with technologies and members
- `CertificateSeeder` — certificates

Run all via: `php artisan db:seed`

Default login after seeding:
- Email: `admin@mail.com`
- Password: `password`

## Notes

- No factories exist — all test data goes through seeders.
- HTML from Trix editor output must be escaped with `strip_tags()` on public pages.
- `phpunit.xml` uses SQLite in-memory for testing, but no tests have been written yet.
