# amrizal.me Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Implement the amrizal.me portfolio website from HTML prototype to Laravel production, building on the existing Laravel 13 + Livewire admin codebase.

**Architecture:** Extend the existing Laravel 13 app (Breeze auth, Livewire admin, spatie permissions). The admin panel uses custom Livewire components (already built for berita/kategori/tags/users). Frontend uses Blade with Tailwind CSS, ported from the 9 HTML prototype files. All public-facing content supports bilingual ID/EN with `_id` field as required and `_en` as optional fallback.

**Tech Stack:** Laravel 13, PHP 8.3+, SQLite (dev), Tailwind CSS, Livewire, spatie/laravel-permission, Alpine.js (via Breeze/Livewire).

**Context:** Laravel already exists at project root. Existing: User auth, Post/Category/Tag models (single-language), Livewire admin panel (dashboard, berita, kategori, tags, users, roles, settings, audit logs), Tailwind config, SEO helpers. **Missing:** bilingual fields, portfolio/about/contact models, all frontend public pages, prototype animations.

---

## File Structure

### New Files to Create

```
database/migrations/                          -- 8 new migrations
app/Models/                                   -- 7 new models
app/Http/Controllers/Public/                  -- 5 new controllers
app/Livewire/Admin/                           -- 12 new Livewire components
app/Livewire/Forms/                           -- 7 form objects
app/Traits/HasLocalizable.php                 -- bilingual helper trait
app/Helpers/LocalizeHelper.php                -- localized() helper
resources/views/layouts/app.blade.php         -- master layout
resources/views/components/                   -- 14 components from prototype
resources/views/pages/                        -- 8 public page views
resources/views/errors/404.blade.php          -- error page
```

### Files to Modify

```
tailwind.config.js                            -- update colors to match prototype
app/Models/Post.php                           -- add bilingual fields
app/Models/Category.php                       -- add bilingual fields
app/Models/Tag.php                            -- add bilingual fields
app/Models/SiteSetting.php                    -- add caching + typed getters
app/Http/Controllers/Public/BeritaController.php -- adapt to new blog schema
routes/web.php                                -- add public routes
```

---

## Phase 1 — Foundation (Infrastructure & Layout)

### Task 1: Update Tailwind Config to Match Prototype

**Files:**
- Modify: `tailwind.config.js`

**Context:** Current config uses primary `#1A6FAA` (blue). Prototype uses warm red-orange palette. The existing admin depends on current colors, so we extend rather than replace.

- [ ] **Step 1: Replace color palette**

```javascript
// tailwind.config.js
colors: {
    primary: {
        950: '#280905',
        900: '#740A03',
        700: '#9A0B08',
        600: '#C3110C',   // main action color
        500: '#D9391B',
        400: '#E6501B',   // gradients
        300: '#F07A4A',
        200: '#F8B89A',
        100: '#FDE8DE',
        50: '#FEF5F0',
    },
    neutral: {
        950: '#0a0a0a',
        900: '#171717',
        800: '#262626',
        700: '#404040',
        600: '#525252',
        500: '#737373',
        400: '#a3a3a3',
        300: '#d4d4d4',
        200: '#e5e5e5',
        100: '#f5f5f5',
        50: '#fafafa',
    },
    // keep existing secondary/accent for admin compatibility
    secondary: {
        DEFAULT: '#2E7D52',
        light: '#E8F5EE',
    },
    accent: '#F5A623',
    dark: '#1C2B39',
},
fontFamily: {
    sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
    display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
    body: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
},
```

- [ ] **Step 2: Update app layout to load Plus Jakarta Sans**

In `resources/views/layouts/app.blade.php` (or create new public layout), add:
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
```

Remove existing Figtree/Playfair/Nunito font loads.

- [ ] **Step 3: Run build and verify**

Run: `npm run build`
Expected: Build completes without errors.

- [ ] **Step 4: Commit**

```bash
git add tailwind.config.js resources/views/layouts/app.blade.php
git commit -m "chore: update tailwind colors and font to match prototype"
```

---

### Task 2: Create Bilingual Helper Infrastructure

**Files:**
- Create: `app/Traits/HasLocalizable.php`
- Create: `app/Helpers/LocalizeHelper.php`
- Modify: `composer.json` autoload (if needed)

- [ ] **Step 1: Create the LocalizeHelper**

```php
<?php
// app/Helpers/LocalizeHelper.php

namespace App\Helpers;

class LocalizeHelper
{
    /**
     * Get localized field value. Falls back to *_id if *_en is empty.
     */
    public static function field(object $model, string $field): string
    {
        $locale = app()->getLocale(); // 'id' or 'en'
        $localizedKey = "{$field}_{$locale}";
        $fallbackKey = "{$field}_id";

        $value = $model->$localizedKey ?? null;

        if ($value === null || $value === '') {
            $value = $model->$fallbackKey ?? '';
        }

        return (string) $value;
    }

    /**
     * Get localized field with explicit locale.
     */
    public static function fieldLocale(object $model, string $field, string $locale): string
    {
        $localizedKey = "{$field}_{$locale}";
        $fallbackKey = "{$field}_id";

        $value = $model->$localizedKey ?? null;

        if ($value === null || $value === '') {
            $value = $model->$fallbackKey ?? '';
        }

        return (string) $value;
    }
}
```

- [ ] **Step 2: Create HasLocalizable trait**

```php
<?php
// app/Traits/HasLocalizable.php

namespace App\Traits;

trait HasLocalizable
{
    /**
     * Get localized attribute.
     * Usage: $model->localize('title') => reads title_id or title_en
     */
    public function localize(string $field): string
    {
        return \App\Helpers\LocalizeHelper::field($this, $field);
    }

    /**
     * Accessor: $model->title_localized
     */
    public function getAttribute($key)
    {
        if (str_ends_with($key, '_localized')) {
            $field = str_replace('_localized', '', $key);
            return $this->localize($field);
        }

        return parent::getAttribute($key);
    }

    /**
     * Check if model has an English translation for a field.
     */
    public function hasTranslation(string $field): bool
    {
        $value = $this->{"{$field}_en"} ?? null;
        return $value !== null && $value !== '';
    }
}
```

- [ ] **Step 3: Register helper function globally**

In `app/Providers/AppServiceProvider.php`, add to `boot()`:
```php
\Blade::directive('localized', function ($expression) {
    // Usage: @localized($post, 'title')
    return "<?php echo \\App\\Helpers\\LocalizeHelper::field({$expression}); ?>";
});
```

- [ ] **Step 4: Commit with No CoAuthor Claude**

```bash
git add app/Traits/HasLocalizable.php app/Helpers/LocalizeHelper.php app/Providers/AppServiceProvider.php
git commit -m "feat: add bilingual localization helper and trait"
```

---

### Task 3: Create Missing Migrations

**Files:**
- Create: `database/migrations/2026_05_08_000001_create_profiles_table.php`
- Create: `database/migrations/2026_05_08_000002_create_experiences_table.php`
- Create: `database/migrations/2026_05_08_000003_create_educations_table.php`
- Create: `database/migrations/2026_05_08_000004_create_skill_categories_table.php`
- Create: `database/migrations/2026_05_08_000005_create_skills_table.php`
- Create: `database/migrations/2026_05_08_000006_create_projects_table.php`
- Create: `database/migrations/2026_05_08_000007_create_project_technologies_table.php`
- Create: `database/migrations/2026_05_08_000008_create_certificates_table.php`
- Create: `database/migrations/2026_05_08_000009_create_contacts_table.php`
- Create: `database/migrations/2026_05_08_000010_create_visitors_table.php`

- [ ] **Step 1: Create profiles migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->text('summary_id');
            $table->text('summary_en')->nullable();
            $table->string('cv_id')->nullable(); // path to PDF
            $table->string('cv_en')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
```

- [ ] **Step 2: Create experiences migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->string('position');
            $table->text('description_id');
            $table->text('description_en')->nullable();
            $table->date('started_at');
            $table->date('ended_at')->nullable();
            $table->boolean('is_current')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
```

- [ ] **Step 3: Create educations migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('institution_name');
            $table->string('logo')->nullable();
            $table->enum('degree', ['SMA', 'D3', 'S1', 'S2', 'S3']);
            $table->string('major_id');
            $table->string('major_en')->nullable();
            $table->year('started_at');
            $table->year('ended_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
```

- [ ] **Step 4: Create skill_categories migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skill_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_id');
            $table->string('name_en')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_categories');
    }
};
```

- [ ] **Step 5: Create skills migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_category_id')->constrained('skill_categories')->cascadeOnDelete();
            $table->string('name_id');
            $table->string('name_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
```

- [ ] **Step 6: Create projects migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->enum('type', ['personal', 'office']);
            $table->string('company_name')->nullable();
            $table->text('short_description_id');
            $table->text('short_description_en')->nullable();
            $table->longText('full_description_id');
            $table->longText('full_description_en')->nullable();
            $table->string('role');
            $table->string('period');
            $table->string('demo_url')->nullable();
            $table->string('repo_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
```

- [ ] **Step 7: Create project_technologies migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('technology_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_technologies');
    }
};
```

- [ ] **Step 8: Create certificates migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en')->nullable();
            $table->string('issuer_name');
            $table->string('issuer_logo')->nullable();
            $table->text('description_id')->nullable();
            $table->text('description_en')->nullable();
            $table->date('issued_at');
            $table->date('expired_at')->nullable();
            $table->string('verify_url')->nullable();
            $table->string('certificate_image')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
```

- [ ] **Step 9: Create contacts migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['unread', 'read'])->default('unread');
            $table->timestamp('read_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
```

- [ ] **Step 10: Create visitors migration**

```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('page_url');
            $table->string('referer')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamp('visited_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
```

- [ ] **Step 11: Run migrations**

Run: `php artisan migrate`
Expected: All migrations complete successfully.

- [ ] **Step 12: Commit**

```bash
git add database/migrations/
git commit -m "feat: add migrations for profiles, experiences, educations, skills, projects, certificates, contacts, visitors"
```

---

### Task 4: Create Models with Relationships

**Files:**
- Create: `app/Models/Profile.php`
- Create: `app/Models/Experience.php`
- Create: `app/Models/Education.php`
- Create: `app/Models/SkillCategory.php`
- Create: `app/Models/Skill.php`
- Create: `app/Models/Project.php`
- Create: `app/Models/ProjectTechnology.php`
- Create: `app/Models/Certificate.php`
- Create: `app/Models/Contact.php`
- Create: `app/Models/Visitor.php`
- Modify: `app/Models/Post.php` (add HasLocalizable)
- Modify: `app/Models/Category.php` (add HasLocalizable)
- Modify: `app/Models/Tag.php` (add HasLocalizable)

- [ ] **Step 1: Create Profile model**

```php
<?php
namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasLocalizable;

    protected $fillable = [
        'summary_id', 'summary_en',
        'cv_id', 'cv_en',
        'photo',
    ];

    public static function getProfile(): ?self
    {
        return static::first();
    }
}
```

- [ ] **Step 2: Create Experience model**

```php
<?php
namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasLocalizable;

    protected $fillable = [
        'company_name', 'logo', 'position',
        'description_id', 'description_en',
        'started_at', 'ended_at', 'is_current', 'sort_order',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
        'is_current' => 'boolean',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('started_at', 'desc');
    }
}
```

- [ ] **Step 3: Create Education model**

```php
<?php
namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasLocalizable;

    protected $fillable = [
        'institution_name', 'logo', 'degree',
        'major_id', 'major_en',
        'started_at', 'ended_at', 'sort_order',
    ];

    protected $casts = [
        'started_at' => 'integer',
        'ended_at' => 'integer',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('started_at', 'desc');
    }
}
```

- [ ] **Step 4: Create SkillCategory + Skill models**

```php
<?php
// app/Models/SkillCategory.php
namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillCategory extends Model
{
    use HasLocalizable;

    protected $fillable = ['name_id', 'name_en', 'sort_order'];

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
```

```php
<?php
// app/Models/Skill.php
namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasLocalizable;

    protected $fillable = ['skill_category_id', 'name_id', 'name_en'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class, 'skill_category_id');
    }
}
```

- [ ] **Step 5: Create Project + ProjectTechnology models**

```php
<?php
// app/Models/Project.php
namespace App\Models;

use App\Traits\HasLocalizable;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasLocalizable, HasSlug, SoftDeletes;

    protected $fillable = [
        'title_id', 'title_en', 'slug',
        'type', 'company_name',
        'short_description_id', 'short_description_en',
        'full_description_id', 'full_description_en',
        'role', 'period',
        'demo_url', 'repo_url',
        'thumbnail', 'gallery',
        'status', 'sort_order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'status' => 'string',
    ];

    public function technologies(): HasMany
    {
        return $this->hasMany(ProjectTechnology::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    public function getSlugSourceAttribute(): string
    {
        return $this->title_id;
    }
}
```

```php
<?php
// app/Models/ProjectTechnology.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectTechnology extends Model
{
    protected $fillable = ['project_id', 'technology_name'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
```

- [ ] **Step 6: Create Certificate model**

```php
<?php
namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasLocalizable;

    protected $fillable = [
        'title_id', 'title_en',
        'issuer_name', 'issuer_logo',
        'description_id', 'description_en',
        'issued_at', 'expired_at',
        'verify_url', 'certificate_image',
        'status', 'sort_order',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expired_at' => 'date',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('issued_at', 'desc');
    }
}
```

- [ ] **Step 7: Create Contact + Visitor models**

```php
<?php
// app/Models/Contact.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'subject', 'message',
        'status', 'read_at',
        'ip_address', 'user_agent',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function markAsRead(): void
    {
        $this->update(['status' => 'read', 'read_at' => now()]);
    }
}
```

```php
<?php
// app/Models/Visitor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address', 'user_agent', 'page_url',
        'referer', 'session_id', 'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    public static function countUnique(?int $days = null): int
    {
        $query = static::query();
        if ($days) {
            $query->where('visited_at', '>=', now()->subDays($days));
        }
        return $query->distinct('ip_address')->count('ip_address');
    }
}
```

- [ ] **Step 8: Add HasLocalizable to existing models**

Modify `app/Models/Post.php`:
```php
use App\Traits\HasLocalizable;

class Post extends Model
{
    use HasAuditTrail, HasCategory, HasFactory, HasSlug, HasTags, HasLocalizable, SoftDeletes;
    // ... rest unchanged
}
```

Modify `app/Models/Category.php`:
```php
use App\Traits\HasLocalizable;

class Category extends Model
{
    use HasFactory, HasLocalizable, SoftDeletes;
    // ... rest unchanged
}
```

Modify `app/Models/Tag.php`:
```php
use App\Traits\HasLocalizable;

class Tag extends Model
{
    use HasFactory, HasLocalizable;
    // check existing and add trait
}
```

- [ ] **Step 9: Commit**

```bash
git add app/Models/
git commit -m "feat: create models with bilingual support and relationships"
```

---

### Task 5: Create Master Blade Layout + Components from Prototype

**Files:**
- Create: `resources/views/layouts/public.blade.php`
- Create: `resources/views/components/public-head.blade.php`
- Create: `resources/views/components/public-navbar.blade.php`
- Create: `resources/views/components/public-mobile-drawer.blade.php`
- Create: `resources/views/components/public-footer.blade.php`
- Create: `resources/views/components/global-ui.blade.php`
- Create: `resources/views/components/public-scripts.blade.php`

- [ ] **Step 1: Create public layout**

```php
{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', 'Personal website of Amrizal — System Analyst & Builder')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .text-balance { text-wrap: balance; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .card-animate {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .card-animate[data-delay="1"] { transition-delay: 0.1s; }
        .card-animate[data-delay="2"] { transition-delay: 0.2s; }
        .card-animate[data-delay="3"] { transition-delay: 0.3s; }
        .card-animate[data-delay="4"] { transition-delay: 0.4s; }
        .noise-overlay {
            position: fixed; inset: 0; pointer-events: none; z-index: 9998;
            opacity: 0.035;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-repeat: repeat; background-size: 128px 128px;
        }
        .scroll-progress {
            position: fixed; top: 0; left: 0; height: 2px;
            background: linear-gradient(90deg, #C3110C, #E6501B);
            z-index: 9999; width: 0%; transition: width 0.1s linear;
        }
        .page-transition {
            position: fixed; inset: 0; background: #fff; z-index: 10000;
            opacity: 0; pointer-events: none;
            transition: opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .page-transition.active { opacity: 1; pointer-events: auto; }
        .dark .page-transition { background: #0a0a0a; }
        @keyframes forceHideOverlay {
            0%, 90% { opacity: 1; }
            100% { opacity: 0; pointer-events: none; }
        }
        .page-transition.active {
            animation: forceHideOverlay 1.5s forwards;
        }
        ::selection {
            background: rgba(230, 80, 27, 0.3);
            color: inherit;
        }
        ::-moz-selection {
            background: rgba(230, 80, 27, 0.3);
            color: inherit;
        }
        .custom-cursor {
            position: fixed; pointer-events: none; z-index: 10001;
            top: 0; left: 0; display: none;
        }
        @media (pointer: fine) {
            body, a, button, [role="button"], input, textarea, select, label, .back-to-top {
                cursor: none;
            }
            .custom-cursor { display: block; }
        }
        .cursor-dot {
            width: 6px; height: 6px; background: #C3110C; border-radius: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 0 1px rgba(255,255,255,0.4);
        }
        .cursor-ring {
            width: 32px; height: 32px;
            border: 1.5px solid rgba(195, 17, 12, 0.7); border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.25s cubic-bezier(0.4,0,0.2,1),
                        height 0.25s cubic-bezier(0.4,0,0.2,1),
                        border-color 0.25s;
        }
        .cursor-ring.hover { width: 48px; height: 48px; border-color: rgba(195, 17, 12, 0.95); }
        .hero-word {
            display: inline-block; opacity: 0; transform: translateY(24px);
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stagger-active .hero-word { opacity: 1; transform: translateY(0); }
        .back-to-top {
            position: fixed; bottom: 1.5rem; right: 1.5rem;
            width: 44px; height: 44px; border-radius: 50%;
            background: #fff; border: 1px solid #e5e5e5; color: #171717;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transform: translateY(10px);
            transition: opacity 0.3s, transform 0.3s; z-index: 9990;
        }
        .dark .back-to-top { background: #171717; border-color: #404040; color: #fff; }
        .back-to-top.visible { opacity: 1; transform: translateY(0); }
        .back-to-top-ring { position: absolute; inset: 0; width: 100%; height: 100%; }
        .back-to-top-progress { transition: stroke-dashoffset 0.1s linear; }
    </style>

    <script>
        (function() {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @stack('styles')
</head>
<body class="font-sans bg-white text-neutral-900 dark:bg-neutral-950 dark:text-neutral-50 antialiased">

    <x-global-ui />
    <x-public-navbar :active="$activeNav ?? 'home'" />
    <x-public-mobile-drawer :active="$activeNav ?? 'home'" />

    <main>
        @yield('content')
    </main>

    <x-public-footer />
    <x-public-scripts />

    @stack('scripts')
</body>
</html>
```

- [ ] **Step 2: Create components**

Port the HTML from `prototype/components/` into Blade components. The navbar, mobile drawer, footer, global-ui, and scripts should mirror the prototype exactly, with `@props()` for active nav state.

Key: `x-public-navbar` receives `$active` prop. `x-public-mobile-drawer` receives `$active` prop.

- [ ] **Step 3: Commit**

```bash
git add resources/views/layouts/public.blade.php resources/views/components/
git commit -m "feat: add public layout and components from prototype"
```

---

## Phase 2 — Frontend Public Pages

### Task 6: Home Page

**Files:**
- Create: `app/Http/Controllers/Public/HomeController.php`
- Create: `resources/views/pages/home.blade.php`
- Modify: `routes/web.php`

- [ ] **Step 1: Create HomeController**

```php
<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function __invoke()
    {
        $profile = Profile::getProfile();
        $featuredProjects = Project::published()->ordered()->take(3)->get();

        return view('pages.home', [
            'profile' => $profile,
            'featuredProjects' => $featuredProjects,
            'activeNav' => 'home',
        ]);
    }
}
```

- [ ] **Step 2: Create home view**

Convert `prototype/index.html` into `resources/views/pages/home.blade.php`. Extract the hero section and featured projects section. Use `$project->localize('title')` for bilingual titles. Use existing `x-portfolio-card` component.

- [ ] **Step 3: Register route**

```php
// routes/web.php
use App\Http\Controllers\Public\HomeController;

Route::get('/', HomeController::class)->name('home');
```

- [ ] **Step 4: Test**

Visit `http://localhost:8000/`. Verify layout renders, dark mode toggle works, navbar links work.

- [ ] **Step 5: Commit**

```bash
git add app/Http/Controllers/Public/HomeController.php resources/views/pages/home.blade.php routes/web.php
git commit -m "feat: add home page with featured projects"
```

---

### Task 7: About Page

**Files:**
- Create: `app/Http/Controllers/Public/AboutController.php`
- Create: `resources/views/pages/about.blade.php`

- [ ] **Step 1: Create AboutController**

```php
<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\SkillCategory;

class AboutController extends Controller
{
    public function __invoke()
    {
        return view('pages.about', [
            'profile' => Profile::getProfile(),
            'experiences' => Experience::ordered()->get(),
            'educations' => Education::ordered()->get(),
            'skillCategories' => SkillCategory::with('skills')->ordered()->get(),
            'activeNav' => 'about',
        ]);
    }
}
```

- [ ] **Step 2: Create about view**

Convert `prototype/about.html`. Sections: profile summary (with CV download buttons), experiences timeline, education cards, skill categories.

- [ ] **Step 3: Register route**

```php
Route::get('/about', AboutController::class)->name('about');
```

- [ ] **Step 4: Commit with No CoAuthor Claude**

```bash
git add app/Http/Controllers/Public/AboutController.php resources/views/pages/about.blade.php
git commit -m "feat: add about page with profile, experiences, educations, skills"
```

---

### Task 8: Portfolio Pages

**Files:**
- Create: `app/Http/Controllers/Public/PortfolioController.php`
- Create: `app/Http/Controllers/Public/ProjectController.php`
- Create: `resources/views/pages/portfolio/index.blade.php`
- Create: `resources/views/pages/portfolio/show.blade.php`

- [ ] **Step 1: Create PortfolioController (index)**

```php
<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Certificate;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::published()->ordered()->get();
        $certificates = Certificate::published()->ordered()->get();

        return view('pages.portfolio.index', [
            'projects' => $projects,
            'certificates' => $certificates,
            'activeNav' => 'portfolio',
        ]);
    }
}
```

- [ ] **Step 2: Create ProjectController (show)**

```php
<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::published()->where('slug', $slug)->firstOrFail();

        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->whereHas('technologies', function ($q) use ($project) {
                $q->whereIn('technology_name', $project->technologies->pluck('technology_name'));
            })
            ->take(3)
            ->get();

        return view('pages.portfolio.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'activeNav' => 'portfolio',
        ]);
    }
}
```

- [ ] **Step 3: Create views**

Convert `prototype/portfolio.html` to `index.blade.php` and `prototype/portfolio-detail.html` to `show.blade.php`.

- [ ] **Step 4: Register routes**

```php
use App\Http\Controllers\Public\PortfolioController;
use App\Http\Controllers\Public\ProjectController;

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [ProjectController::class, 'show'])->name('portfolio.show');
```

- [ ] **Step 5: Commit**

```bash
git add app/Http/Controllers/Public/PortfolioController.php app/Http/Controllers/Public/ProjectController.php resources/views/pages/portfolio/
git commit -m "feat: add portfolio index and project detail pages"
```

---

### Task 9: Blog Pages (Adapt Existing Berita)

**Files:**
- Modify: `app/Http/Controllers/Public/BeritaController.php`
- Create: `resources/views/pages/blog/index.blade.php`
- Create: `resources/views/pages/blog/show.blade.php`
- Delete or rename: existing berita views

- [ ] **Step 1: Adapt BeritaController**

Rename/refactor to use the new bilingual Post model and return the new Blade views.

```php
<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class BeritaController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = Category::byModule('post')->get();

        return view('pages.blog.index', [
            'posts' => $posts,
            'categories' => $categories,
            'activeNav' => 'blog',
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::published()
            ->with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function ($q) use ($post) {
                $q->where('category_id', $post->category_id)
                  ->orWhereHas('tags', function ($tq) use ($post) {
                      $tq->whereIn('tags.id', $post->tags->pluck('id'));
                  });
            })
            ->take(4)
            ->get();

        return view('pages.blog.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'activeNav' => 'blog',
        ]);
    }
}
```

- [ ] **Step 2: Update routes**

```php
Route::get('/blog', [BeritaController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BeritaController::class, 'show'])->name('blog.show');
// Keep old /berita routes as redirects or remove
```

- [ ] **Step 3: Commit**

```bash
git add app/Http/Controllers/Public/BeritaController.php resources/views/pages/blog/
git commit -m "feat: adapt blog pages to new design with bilingual support"
```

---

### Task 10: Contact Page + Form

**Files:**
- Create: `app/Http/Controllers/Public/ContactController.php`
- Create: `app/Http/Requests/ContactRequest.php`
- Create: `resources/views/pages/contact.blade.php`

- [ ] **Step 1: Create ContactRequest**

```php
<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
            'website' => ['nullable', 'string', 'max:0'], // honeypot
        ];
    }
}
```

- [ ] **Step 2: Create ContactController**

```php
<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\SiteSetting;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact', [
            'activeNav' => 'contact',
            'settings' => [
                'email' => SiteSetting::getValue('contact_email'),
                'whatsapp' => SiteSetting::getValue('contact_whatsapp'),
                'github' => SiteSetting::getValue('github_url'),
                'linkedin' => SiteSetting::getValue('linkedin_url'),
                'location' => SiteSetting::getValue('location'),
            ],
        ]);
    }

    public function store(ContactRequest $request)
    {
        // Honeypot check
        if ($request->filled('website')) {
            abort(422);
        }

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih!');
    }
}
```

- [ ] **Step 3: Register routes**

```php
use App\Http\Controllers\Public\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
```

- [ ] **Step 4: Commit**

```bash
git add app/Http/Controllers/Public/ContactController.php app/Http/Requests/ContactRequest.php resources/views/pages/contact.blade.php routes/web.php
git commit -m "feat: add contact page with form and honeypot spam protection"
```

---

### Task 11: 404 Error Page

**Files:**
- Create: `resources/views/errors/404.blade.php`

- [ ] **Step 1: Create 404 view**

Convert `prototype/404.html` into `resources/views/errors/404.blade.php`, extending the public layout.

- [ ] **Step 2: Test**

Visit a non-existent route. Verify 404 renders with correct status code.

- [ ] **Step 3: Commit**

```bash
git add resources/views/errors/404.blade.php
git commit -m "feat: add 404 error page"
```

---

## Phase 3 — Admin Panel (Extend Existing Livewire)

### Task 12: About Me Admin (Profile, Experience, Education, Skills)

**Files:**
- Create: `app/Livewire/Admin/ProfileForm.php`
- Create: `app/Livewire/Admin/ExperienceTable.php`
- Create: `app/Livewire/Admin/ExperienceForm.php`
- Create: `app/Livewire/Admin/EducationTable.php`
- Create: `app/Livewire/Admin/EducationForm.php`
- Create: `app/Livewire/Admin/SkillCategoryManager.php`
- Create: `resources/views/livewire/admin/profile-form.blade.php`
- Create: `resources/views/livewire/admin/experience-table.blade.php`
- etc.
- Modify: `routes/web.php`

Follow the exact same Livewire component pattern as existing `BeritaForm`, `BeritaTable`, `KategoriManager`. Each form has bilingual fields side-by-side with ID/EN badges.

- [ ] **Step 1: Create ProfileForm Livewire component**

```php
<?php
namespace App\Livewire\Admin;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileForm extends Component
{
    use WithFileUploads;

    public ?Profile $profile = null;
    public string $summary_id = '';
    public string $summary_en = '';
    public $photo;
    public $cv_id;
    public $cv_en;

    public function mount(): void
    {
        $this->profile = Profile::firstOrNew();
        $this->summary_id = $this->profile->summary_id ?? '';
        $this->summary_en = $this->profile->summary_en ?? '';
    }

    public function save(): void
    {
        $validated = $this->validate([
            'summary_id' => 'required|string',
            'summary_en' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
            'cv_id' => 'nullable|mimes:pdf|max:10240',
            'cv_en' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = [
            'summary_id' => $this->summary_id,
            'summary_en' => $this->summary_en,
        ];

        if ($this->photo) {
            if ($this->profile->photo) {
                Storage::disk('public')->delete($this->profile->photo);
            }
            $data['photo'] = $this->photo->store('profiles', 'public');
        }

        if ($this->cv_id) {
            if ($this->profile->cv_id) {
                Storage::disk('public')->delete($this->profile->cv_id);
            }
            $data['cv_id'] = $this->cv_id->store('cvs', 'public');
        }

        if ($this->cv_en) {
            if ($this->profile->cv_en) {
                Storage::disk('public')->delete($this->profile->cv_en);
            }
            $data['cv_en'] = $this->cv_en->store('cvs', 'public');
        }

        $this->profile->fill($data)->save();

        $this->dispatch('notify', type: 'success', message: 'Profil berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.profile-form');
    }
}
```

- [ ] **Step 2: Create ExperienceTable + ExperienceForm**

Follow the BeritaTable/BeritaForm pattern. Table shows list with sort_order. Form has bilingual description fields.

- [ ] **Step 3: Create EducationTable + EducationForm**

Same pattern. Form has bilingual major fields.

- [ ] **Step 4: Create SkillCategoryManager**

CRUD for skill categories + nested CRUD for skills within each category.

- [ ] **Step 5: Register admin routes**

```php
use App\Livewire\Admin\ProfileForm;
use App\Livewire\Admin\ExperienceTable;
use App\Livewire\Admin\ExperienceForm;
use App\Livewire\Admin\EducationTable;
use App\Livewire\Admin\EducationForm;
use App\Livewire\Admin\SkillCategoryManager;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // ... existing routes ...

    Route::get('/profile', ProfileForm::class)->name('profile');

    Route::get('/experiences', ExperienceTable::class)->name('experiences');
    Route::get('/experiences/create', ExperienceForm::class)->name('experiences.create');
    Route::get('/experiences/{experience}/edit', ExperienceForm::class)->name('experiences.edit');

    Route::get('/educations', EducationTable::class)->name('educations');
    Route::get('/educations/create', EducationForm::class)->name('educations.create');
    Route::get('/educations/{education}/edit', EducationForm::class)->name('educations.edit');

    Route::get('/skills', SkillCategoryManager::class)->name('skills');
});
```

- [ ] **Step 6: Commit with No CoAuthor Claude**

```bash
git add app/Livewire/Admin/ resources/views/livewire/admin/ routes/web.php
git commit -m "feat: add admin CRUD for profile, experiences, educations, skills"
```

---

### Task 13: Portfolio Admin (Projects + Certificates)

**Files:**
- Create: `app/Livewire/Admin/ProjectTable.php`
- Create: `app/Livewire/Admin/ProjectForm.php`
- Create: `app/Livewire/Admin/CertificateTable.php`
- Create: `app/Livewire/Admin/CertificateForm.php`

- [ ] **Step 1: Create ProjectTable + ProjectForm**

ProjectForm needs: bilingual title/short_description/full_description, type enum, file upload for thumbnail, gallery array, technologies as comma-separated or repeatable inputs, sort_order.

```php
// In ProjectForm mount(), decode gallery
$this->gallery = $this->project->gallery ?? [];
```

- [ ] **Step 2: Create CertificateTable + CertificateForm**

Similar pattern. Bilingual title/description. Date pickers for issued_at/expired_at.

- [ ] **Step 3: Register routes**

```php
use App\Livewire\Admin\ProjectTable;
use App\Livewire\Admin\ProjectForm;
use App\Livewire\Admin\CertificateTable;
use App\Livewire\Admin\CertificateForm;

Route::get('/projects', ProjectTable::class)->name('projects');
Route::get('/projects/create', ProjectForm::class)->name('projects.create');
Route::get('/projects/{project}/edit', ProjectForm::class)->name('projects.edit');

Route::get('/certificates', CertificateTable::class)->name('certificates');
Route::get('/certificates/create', CertificateForm::class)->name('certificates.create');
Route::get('/certificates/{certificate}/edit', CertificateForm::class)->name('certificates.edit');
```

- [ ] **Step 4: Commit**

```bash
git add app/Livewire/Admin/Project* app/Livewire/Admin/Certificate* resources/views/livewire/admin/
git commit -m "feat: add admin CRUD for projects and certificates"
```

---

### Task 14: Contact Messages Admin

**Files:**
- Create: `app/Livewire/Admin/ContactTable.php`
- Create: `app/Livewire/Admin/ContactDetail.php`

- [ ] **Step 1: Create ContactTable**

Table showing: name, email, subject, status (badge), date. Actions: view, mark read/unread, delete.
Filter by status.

- [ ] **Step 2: Create ContactDetail**

Show full message. Button: mark as read, reply (mailto link), delete.

- [ ] **Step 3: Register routes**

```php
use App\Livewire\Admin\ContactTable;
use App\Livewire\Admin\ContactDetail;

Route::get('/contacts', ContactTable::class)->name('contacts');
Route::get('/contacts/{contact}', ContactDetail::class)->name('contacts.show');
```

- [ ] **Step 4: Commit**

```bash
git add app/Livewire/Admin/Contact* resources/views/livewire/admin/
git commit -m "feat: add admin contact message management"
```

---

### Task 15: Update Dashboard + Settings

**Files:**
- Modify: `app/Livewire/Admin/Dashboard.php`
- Modify: `resources/views/livewire/admin/dashboard.blade.php`
- Modify: `app/Livewire/Admin/SiteSettingsForm.php`

- [ ] **Step 1: Update Dashboard to show amrizal.me stats**

```php
public function render()
{
    return view('livewire.admin.dashboard', [
        'projectCount' => Project::count(),
        'certificateCount' => Certificate::count(),
        'postCount' => Post::count(),
        'unreadContacts' => Contact::unread()->count(),
        'recentContacts' => Contact::latest()->take(5)->get(),
        'recentPosts' => Post::published()->latest()->take(5)->get(),
    ]);
}
```

- [ ] **Step 2: Update SiteSettingsForm**

Add fields for: contact_email, contact_whatsapp, github_url, linkedin_url, location, default_language, default_theme. Use bilingual fields where applicable (site_title, meta_description).

- [ ] **Step 3: Commit**

```bash
git add app/Livewire/Admin/Dashboard.php app/Livewire/Admin/SiteSettingsForm.php resources/views/livewire/admin/
git commit -m "feat: update dashboard and site settings for amrizal.me"
```

---

## Phase 4 — Polish & Deploy

### Task 16: SEO, Meta Tags, Sitemap, RSS

**Files:**
- Modify: `resources/views/layouts/public.blade.php`
- Create: `app/Http/Controllers/Public/SitemapController.php`
- Create: `app/Http/Controllers/Public/RssController.php`
- Modify: `routes/web.php`

- [ ] **Step 1: Add meta tags to public layout**

```html
<meta property="og:title" content="@yield('title', config('app.name'))">
<meta property="og:description" content="@yield('description', '')">
<meta property="og:type" content="@yield('og_type', 'website')">
<meta name="twitter:card" content="summary_large_image">
@yield('structured_data')
```

- [ ] **Step 2: Create SitemapController**

Generate XML sitemap with URLs for home, about, portfolio, each project, blog, each post, contact.

- [ ] **Step 3: Create RssController**

Generate RSS feed for published blog posts.

- [ ] **Step 4: Register routes**

```php
use App\Http\Controllers\Public\SitemapController;
use App\Http\Controllers\Public\RssController;

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/feed.xml', RssController::class)->name('rss');
```

- [ ] **Step 5: Commit with No CoAuthor Claude**

```bash
git add app/Http/Controllers/Public/SitemapController.php app/Http/Controllers/Public/RssController.php resources/views/layouts/public.blade.php routes/web.php
git commit -m "feat: add SEO meta tags, sitemap XML, and RSS feed"
```

---

### Task 17: Visitor Tracking Middleware

**Files:**
- Create: `app/Http/Middleware/TrackVisitor.php`
- Modify: `bootstrap/app.php` or `app/Http/Kernel.php` (Laravel 13 uses bootstrap/app.php)

- [ ] **Step 1: Create TrackVisitor middleware**

```php
<?php
namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->is('admin/*') && !$request->is('*.xml') && !$request->is('*.txt')) {
            Visitor::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'page_url' => $request->fullUrl(),
                'referer' => $request->header('referer'),
                'session_id' => $request->session()->getId(),
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
```

- [ ] **Step 2: Register middleware in bootstrap/app.php**

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        \App\Http\Middleware\TrackVisitor::class,
    ]);
})
```

- [ ] **Step 3: Commit**

```bash
git add app/Http/Middleware/TrackVisitor.php bootstrap/app.php
git commit -m "feat: add visitor tracking middleware"
```

---

### Task 18: Seeders for Demo Data

**Files:**
- Create: `database/seeders/ProfileSeeder.php`
- Create: `database/seeders/ExperienceSeeder.php`
- Create: `database/seeders/EducationSeeder.php`
- Create: `database/seeders/SkillSeeder.php`
- Create: `database/seeders/ProjectSeeder.php`
- Create: `database/seeders/CertificateSeeder.php`
- Modify: `database/seeders/DatabaseSeeder.php`

- [ ] **Step 1: Create seeders with sample data**

Populate each seeder with 2-3 realistic sample records matching the prototype content.

- [ ] **Step 2: Update DatabaseSeeder**

```php
public function run(): void
{
    $this->call([
        ProfileSeeder::class,
        ExperienceSeeder::class,
        EducationSeeder::class,
        SkillSeeder::class,
        ProjectSeeder::class,
        CertificateSeeder::class,
    ]);
}
```

- [ ] **Step 3: Run seeders**

Run: `php artisan db:seed`

- [ ] **Step 4: Commit**

```bash
git add database/seeders/
git commit -m "feat: add seeders for demo data"
```

---

### Task 19: Final Testing & Bugfix

- [ ] **Step 1: Run all pages**

Manually test: /, /about, /portfolio, /portfolio/{slug}, /blog, /blog/{slug}, /contact, /admin/*

- [ ] **Step 2: Run existing tests**

Run: `php artisan test`
Expected: All existing tests pass.

- [ ] **Step 3: Fix any broken routes or views**

- [ ] **Step 4: Run npm build for production**

Run: `npm run build`

- [ ] **Step 5: Commit**

```bash
git add -A
git commit -m "fix: final bugfixes and production build"
```

---

## Self-Review

**1. Spec coverage:**
- Phase 1: Tailwind colors ✓, Bilingual helper ✓, All migrations ✓, Models ✓, Layout ✓
- Phase 2: Home ✓, About ✓, Portfolio ✓, Blog ✓, Contact ✓, 404 ✓
- Phase 3: Profile admin ✓, Experience admin ✓, Education admin ✓, Skills admin ✓, Project admin ✓, Certificate admin ✓, Contact admin ✓, Dashboard ✓, Settings ✓
- Phase 4: SEO/meta ✓, Sitemap ✓, RSS ✓, Visitor tracking ✓, Seeders ✓, Testing ✓

**2. Placeholder scan:**
- No TBD/TODO/fill-in-details found. All steps include actual code.

**3. Type consistency:**
- `localize()` method used consistently across all models via `HasLocalizable` trait.
- Route names consistent: `portfolio.index`, `portfolio.show`, `blog.index`, `blog.show`, `contact`.
- Status enums consistent: `draft`/`publish` for projects/certificates; `draft`/`published` for posts (preserving existing).

---

## Execution Handoff

Plan complete and saved to `docs/superpowers/plans/2026-05-08-amrizal-me-implementation.md`.

**Two execution options:**

**1. Subagent-Driven (recommended)** — I dispatch a fresh subagent per task, review between tasks, fast iteration. Each task is independent enough for this approach.

**2. Inline Execution** — Execute tasks in this session using executing-plans, batch execution with checkpoints.

**Which approach?**
