# Public Background Transparent Enhancement Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add Hero Aurora + Glassmorphism visual treatment to all public pages, with solid backgrounds below the hero section.

**Architecture:** Two reusable Blade components (`x-aurora-background` and `x-glass-container`) plus CSS utilities. Each public page hero section wraps its inner content with the glass container and adds aurora blobs behind it. Navbar gets glassmorphism styling on all public pages.

**Tech Stack:** Laravel Blade, Tailwind CSS 3.1, plain CSS with `@supports` fallback

---

## File Structure

| File | Action | Responsibility |
|------|--------|---------------|
| `resources/css/app.css` | Modify | Aurora blob utilities, glassmorphism utilities, `@supports` fallback, mobile optimization |
| `resources/views/components/aurora-background.blade.php` | Create | Reusable 3-blob aurora background component |
| `resources/views/components/glass-container.blade.php` | Create | Reusable glassmorphism wrapper with slot |
| `resources/views/layouts/public.blade.php` | Modify | Navbar glassmorphism styling |
| `resources/views/pages/home.blade.php` | Modify | Hero aurora + glassmorphism |
| `resources/views/pages/about.blade.php` | Modify | Hero aurora + glassmorphism |
| `resources/views/pages/blog/index.blade.php` | Modify | Hero aurora + glassmorphism |
| `resources/views/pages/blog/show.blade.php` | Modify | Hero aurora + glassmorphism |
| `resources/views/pages/portfolio/index.blade.php` | Modify | Hero aurora + glassmorphism |
| `resources/views/pages/portfolio/show.blade.php` | Modify | Hero aurora + glassmorphism |
| `resources/views/pages/contact.blade.php` | Modify | Hero aurora + glassmorphism |

---

### Task 1: Add CSS Utilities and Fallbacks

**Files:**
- Modify: `resources/css/app.css`

- [ ] **Step 1: Append aurora blob and glassmorphism CSS to app.css**

Add the following at the end of `resources/css/app.css`:

```css
/* Aurora Background Blobs */
.aurora-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(50px);
    pointer-events: none;
    z-index: 0;
}

.aurora-blob--primary {
    width: 300px;
    height: 300px;
    background: rgba(195, 17, 12, 0.10);
    top: -60px;
    left: -60px;
}

.aurora-blob--secondary {
    width: 250px;
    height: 250px;
    background: rgba(46, 125, 82, 0.08);
    top: 40px;
    right: -40px;
}

.aurora-blob--accent {
    width: 200px;
    height: 200px;
    background: rgba(245, 166, 35, 0.06);
    bottom: -40px;
    left: 40%;
}

.dark .aurora-blob--primary {
    background: rgba(195, 17, 12, 0.06);
    filter: blur(55px);
}

.dark .aurora-blob--secondary {
    background: rgba(46, 125, 82, 0.05);
    filter: blur(50px);
}

.dark .aurora-blob--accent {
    background: rgba(245, 166, 35, 0.04);
    filter: blur(45px);
}

/* Glassmorphism Container */
.glass {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.60);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.40);
    border-radius: 20px;
}

.dark .glass {
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.12);
}

/* Mobile: reduce blur for performance */
@media (max-width: 768px) {
    .glass {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    .aurora-blob {
        filter: blur(35px);
    }
    .dark .aurora-blob--primary,
    .dark .aurora-blob--secondary,
    .dark .aurora-blob--accent {
        filter: blur(40px);
    }
}

/* Fallback for browsers without backdrop-filter support */
@supports not (backdrop-filter: blur(12px)) {
    .glass {
        background: rgba(250, 250, 250, 0.95);
    }
    .dark .glass {
        background: rgba(10, 10, 10, 0.95);
    }
}

/* Navbar glassmorphism */
.navbar-glass {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}

.dark .navbar-glass {
    background: rgba(255, 255, 255, 0.08);
    border-bottom: 1px solid rgba(255, 255, 255, 0.10);
}

@supports not (backdrop-filter: blur(12px)) {
    .navbar-glass {
        background: rgba(255, 255, 255, 0.98);
    }
    .dark .navbar-glass {
        background: rgba(10, 10, 10, 0.98);
    }
}

/* Hero section positioning context for aurora blobs */
.hero-aurora {
    position: relative;
    overflow: hidden;
}
```

- [ ] **Step 2: Commit**

```bash
git add resources/css/app.css
git commit -m "$(cat <<'EOF'
feat(css): add aurora blobs and glassmorphism utilities

- Aurora blob utilities with brand colors for light/dark mode
- Glassmorphism container with backdrop-filter
- Mobile blur reduction for performance
- @supports fallback for legacy browsers
- Navbar glassmorphism utility

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 2: Create Aurora Background Component

**Files:**
- Create: `resources/views/components/aurora-background.blade.php`

- [ ] **Step 1: Write the component file**

```blade
{{-- resources/views/components/aurora-background.blade.php --}}
<div class="aurora-blob aurora-blob--primary" aria-hidden="true"></div>
<div class="aurora-blob aurora-blob--secondary" aria-hidden="true"></div>
<div class="aurora-blob aurora-blob--accent" aria-hidden="true"></div>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/components/aurora-background.blade.php
git commit -m "$(cat <<'EOF'
feat(components): create aurora background component

Reusable 3-blob aurora background for hero sections.

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 3: Create Glass Container Component

**Files:**
- Create: `resources/views/components/glass-container.blade.php`

- [ ] **Step 1: Write the component file**

```blade
{{-- resources/views/components/glass-container.blade.php --}}
<div {{ $attributes->merge(['class' => 'glass']) }}>
    {{ $slot }}
</div>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/components/glass-container.blade.php
git commit -m "$(cat <<'EOF'
feat(components): create glassmorphism container component

Reusable glassmorphism wrapper with configurable attributes.

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 4: Update Navbar for Glassmorphism

**Files:**
- Modify: `resources/views/components/public-navbar.blade.php`

The navbar already has basic glassmorphism (`bg-white/80 dark:bg-neutral-950/80 backdrop-blur-md`). Update it to match the spec exactly.

- [ ] **Step 1: Update navbar background and border classes**

In `resources/views/components/public-navbar.blade.php`, line 3, replace:
```blade
<nav class="fixed top-0 left-0 right-0 z-40 bg-white/80 dark:bg-neutral-950/80 backdrop-blur-md border-b border-neutral-200 dark:border-neutral-800">
```

With:
```blade
<nav class="fixed top-0 left-0 right-0 z-40 bg-white/75 dark:bg-white/[0.08] backdrop-blur-xl border-b border-white/20 dark:border-white/10">
```

This changes:
- Light mode background from `bg-white/80` to `bg-white/75`
- Dark mode background from `dark:bg-neutral-950/80` to `dark:bg-white/[0.08]` (tinted glass instead of dark solid)
- Backdrop blur from `backdrop-blur-md` to `backdrop-blur-xl`
- Border from `border-neutral-200 dark:border-neutral-800` to `border-white/20 dark:border-white/10`

- [ ] **Step 2: Commit**

```bash
git add resources/views/components/public-navbar.blade.php
git commit -m "$(cat <<'EOF'
feat(navbar): refine glassmorphism to match spec

- Light mode: bg-white/75 with backdrop-blur-xl
- Dark mode: white-tinted glass bg-white/[0.08]
- Subtle border-white/20 dark:border-white/10

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 5: Update Home Page Hero

**Files:**
- Modify: `resources/views/pages/home.blade.php`

- [ ] **Step 1: Wrap hero section with aurora and glassmorphism**

The hero section currently starts at line 9:
```blade
<!-- Hero -->
<section class="pt-32 pb-16 md:pt-40 md:pb-24">
```

Replace the hero section (lines 9-42) with:

```blade
<!-- Hero -->
<section class="hero-aurora pt-32 pb-16 md:pt-40 md:pb-24 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
            <div class="flex-1 text-center md:text-left">
                <x-glass-container class="p-6 md:p-8">
                    <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase" data-i18n="home.hero_subtitle">{{ __('public.home.hero_subtitle') }}</p>
                    <h1 class="text-4xl md:text-6xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance" data-i18n-html="home.hero_title">
                        {!! __('public.home.hero_title') !!}
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-neutral-600 dark:text-neutral-300 max-w-xl mx-auto md:mx-0 text-balance" data-i18n="home.hero_description">
                        {{ __('public.home.hero_description') }}
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-3">
                        <a href="/portfolio" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white bg-primary-600 hover:bg-primary-900 shadow-sm hover:shadow-md transition-all" data-i18n="home.cta_portfolio">
                            {{ __('public.home.cta_portfolio') }}
                        </a>
                        <a href="/about" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-neutral-700 dark:text-neutral-200 bg-neutral-100 dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 hover:border-primary-600/30 hover:bg-primary-600/5 transition-all" data-i18n="home.cta_about">
                            {{ __('public.home.cta_about') }}
                        </a>
                    </div>
                </x-glass-container>
            </div>
            <div class="shrink-0 relative z-10">
                <div class="w-48 h-48 md:w-64 md:h-64 rounded-2xl bg-gradient-to-br from-primary-600 to-primary-400 p-1 shadow-lg">
                    <div class="w-full h-full rounded-xl bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center overflow-hidden">
                        @if ($profile && $profile->photo)
                            <img src="{{ Storage::url($profile->photo) }}" alt="Profile photo" class="w-full h-full object-cover">
                        @else
                            <svg class="w-20 h-20 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/home.blade.php
git commit -m "$(cat <<'EOF'
feat(home): add aurora + glassmorphism to hero section

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 6: Update About Page Hero

**Files:**
- Modify: `resources/views/pages/about.blade.php`

- [ ] **Step 1: Wrap hero section with aurora and glassmorphism**

Replace the hero section (lines 8-46):
```blade
<!-- Hero About -->
<section class="hero-aurora pt-32 pb-16 md:pt-40 md:pb-24 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
            <div class="shrink-0 relative z-10">
                <div class="w-48 h-48 md:w-64 md:h-64 rounded-2xl bg-gradient-to-br from-primary-600 to-primary-400 p-1 shadow-lg">
                    <div class="w-full h-full rounded-xl bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center overflow-hidden">
                        @if ($profile && $profile->photo)
                            <img src="{{ Storage::url($profile->photo) }}" alt="Profile photo" class="w-full h-full object-cover">
                        @else
                            <svg class="w-20 h-20 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex-1 text-center md:text-left">
                <x-glass-container class="p-6 md:p-8">
                    <h1 class="text-3xl md:text-5xl font-bold text-neutral-900 dark:text-white text-balance" data-i18n="about.page_title">{{ __('public.about.page_title') }}</h1>
                    <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 leading-relaxed text-balance">
                        @if ($profile)
                            {{ $profile->localize('summary') }}
                        @else
                            <span data-i18n="about.default_summary">{{ __('public.about.default_summary') }}</span>
                        @endif
                    </p>
                    @php
                        $cvFile = $profile ? $profile->localize('cv') : '';
                    @endphp
                    @if ($cvFile)
                        <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-3">
                            <a href="{{ Storage::url($cvFile) }}" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white bg-primary-600 hover:bg-primary-900 shadow-sm hover:shadow-md transition-all" data-i18n="about.download_cv">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                {{ __('public.about.download_cv') }}
                            </a>
                        </div>
                    @endif
                </x-glass-container>
            </div>
        </div>
    </div>
</section>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/about.blade.php
git commit -m "$(cat <<'EOF'
feat(about): add aurora + glassmorphism to hero section

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 7: Update Blog Index Hero

**Files:**
- Modify: `resources/views/pages/blog/index.blade.php`

- [ ] **Step 1: Wrap hero section with aurora and glassmorphism**

Replace the hero section (lines 8-21):
```blade
<!-- Hero -->
<section class="hero-aurora pt-32 pb-12 md:pt-40 md:pb-16 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-2xl">
            <x-glass-container class="p-6 md:p-8">
                <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase" data-i18n="blog.page_title">{{ __('public.blog.page_title') }}</p>
                <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance" data-i18n="blog.hero_title">
                    {{ __('public.blog.hero_title') }}
                </h1>
                <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance" data-i18n="blog.hero_desc">
                    {{ __('public.blog.hero_desc') }}
                </p>
            </x-glass-container>
        </div>
    </div>
</section>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/blog/index.blade.php
git commit -m "$(cat <<'EOF'
feat(blog): add aurora + glassmorphism to blog index hero

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 8: Update Blog Detail Hero

**Files:**
- Modify: `resources/views/pages/blog/show.blade.php`

- [ ] **Step 1: Wrap article header with aurora and glassmorphism**

The blog detail has a breadcrumb section (lines 12-20) and article header (lines 22-36). Wrap both in a single hero aurora section.

Replace lines 12-36 with:
```blade
<section class="hero-aurora pt-24 pb-8 md:pt-28 md:pb-12 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <x-glass-container class="p-6 md:p-8">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-1 text-sm text-neutral-500 dark:text-neutral-400 hover:text-primary-600 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span data-i18n="blog.back_to_blog">{{ __('public.blog.back_to_blog') }}</span>
            </a>
            <div class="flex flex-wrap items-center gap-2 mb-4">
                @if ($post->category)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">{{ $post->category->name }}</span>
                @endif
                <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $post->published_at?->format('d M Y') }} · {{ ceil(str_word_count(strip_tags($post->localize('content'))) / 200) }} <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span> · <span class="inline-flex items-center gap-0.5">{{ number_format($post->views) }} <span data-i18n="common.views">{{ __('public.common.views') }}</span></span></span>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance">{{ $post->localize('title') }}</h1>
            @if ($post->author?->name)
                <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance"><span data-i18n="blog.written_by">{{ __('public.blog.written_by') }}</span> {{ $post->author->name }}</p>
            @endif
        </x-glass-container>
    </div>
</section>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/blog/show.blade.php
git commit -m "$(cat <<'EOF'
feat(blog): add aurora + glassmorphism to blog detail hero

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 9: Update Portfolio Index Hero

**Files:**
- Modify: `resources/views/pages/portfolio/index.blade.php`

- [ ] **Step 1: Wrap header section with aurora and glassmorphism**

Replace lines 8-17 with:
```blade
<!-- Header -->
<section class="hero-aurora pt-32 pb-12 md:pt-40 md:pb-16 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-2xl">
            <x-glass-container class="p-6 md:p-8">
                <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase" data-i18n="portfolio.page_title">{{ __('public.portfolio.page_title') }}</p>
                <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance" data-i18n="portfolio.hero_title">{{ __('public.portfolio.hero_title') }}</h1>
                <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance" data-i18n="portfolio.hero_desc">{{ __('public.portfolio.hero_desc') }}</p>
            </x-glass-container>
        </div>
    </div>
</section>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/portfolio/index.blade.php
git commit -m "$(cat <<'EOF'
feat(portfolio): add aurora + glassmorphism to portfolio index hero

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 10: Update Portfolio Detail Hero

**Files:**
- Modify: `resources/views/pages/portfolio/show.blade.php`

- [ ] **Step 1: Wrap hero detail with aurora and glassmorphism**

Replace lines 8-41 with:
```blade
<section class="hero-aurora pt-24 pb-8 md:pt-28 md:pb-12 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <x-glass-container class="p-6 md:p-8">
            <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-1 text-sm text-neutral-500 dark:text-neutral-400 hover:text-primary-600 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span data-i18n="portfolio.back_to_portfolio">{{ __('public.portfolio.back_to_portfolio') }}</span>
            </a>
            <div class="flex flex-wrap items-center gap-2 mb-4">
                @if ($project->company_name)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20">
                        {{ $project->company_name }}
                    </span>
                @endif
                <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $project->type }}</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance">{{ $project->localize('title') }}</h1>
            <div class="mt-4 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-neutral-600 dark:text-neutral-300">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    {{ $project->period }}
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ $project->role }}
                </div>
            </div>
        </x-glass-container>
    </div>
</section>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/portfolio/show.blade.php
git commit -m "$(cat <<'EOF'
feat(portfolio): add aurora + glassmorphism to portfolio detail hero

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 11: Update Contact Page Hero

**Files:**
- Modify: `resources/views/pages/contact.blade.php`

- [ ] **Step 1: Wrap hero section with aurora and glassmorphism**

Replace lines 8-21 with:
```blade
<!-- Hero -->
<section class="hero-aurora pt-32 pb-12 md:pt-40 md:pb-16 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-2xl">
            <x-glass-container class="p-6 md:p-8">
                <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase" data-i18n="contact.page_title">{{ __('public.contact.page_title') }}</p>
                <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance" data-i18n="contact.hero_title">
                    {{ __('public.contact.hero_title') }}
                </h1>
                <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance" data-i18n="contact.hero_desc">
                    {{ __('public.contact.hero_desc') }}
                </p>
            </x-glass-container>
        </div>
    </div>
</section>
```

- [ ] **Step 2: Commit**

```bash
git add resources/views/pages/contact.blade.php
git commit -m "$(cat <<'EOF'
feat(contact): add aurora + glassmorphism to contact hero

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

### Task 12: Build Assets and Visual Verification

**Files:**
- None (build step)

- [ ] **Step 1: Build production assets**

```bash
cd D:/laragon/www/amrizal-me && npm run build
```

Expected: Vite builds successfully with no errors.

- [ ] **Step 2: Start dev server and verify in browser**

```bash
cd D:/laragon/www/amrizal-me && composer dev
```

Open `http://localhost:8000` and verify:
- [ ] Home page hero shows aurora blobs behind glassmorphism container
- [ ] About page hero shows aurora blobs
- [ ] Blog index hero shows aurora blobs
- [ ] Blog detail hero shows aurora blobs
- [ ] Portfolio index hero shows aurora blobs
- [ ] Portfolio detail hero shows aurora blobs
- [ ] Contact page hero shows aurora blobs
- [ ] Navbar has glassmorphism effect on all public pages
- [ ] Dark mode renders subtle aurora blobs (toggle with dark mode switch or system preference)
- [ ] Sections below hero remain solid (no glassmorphism on cards)
- [ ] Mobile view is performant (no scroll jank)

- [ ] **Step 3: Run linter**

```bash
cd D:/laragon/www/amrizal-me && vendor/bin/pint
```

Expected: No errors, or auto-fixes applied.

- [ ] **Step 4: Final commit**

```bash
git add -A
git commit -m "$(cat <<'EOF'
feat(public): implement hero aurora + glassmorphism across all pages

- Aurora background blobs with brand colors (primary, secondary, accent)
- Glassmorphism containers for hero content on all 7 public pages
- Glassmorphism navbar on all public pages
- Dark mode support with reduced opacity
- Mobile performance optimization (reduced blur)
- @supports fallback for legacy browsers

Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>
EOF
)"
```

---

## Self-Review

### Spec Coverage Check

| Spec Requirement | Task |
|-----------------|------|
| Aurora blobs in hero (light mode) | Task 1 (CSS), Tasks 5-11 (pages) |
| Aurora blobs in hero (dark mode, reduced opacity) | Task 1 (CSS dark variants) |
| Glassmorphism container | Task 1 (CSS), Task 3 (component), Tasks 5-11 |
| Dark mode glassmorphism | Task 1 (CSS dark variants) |
| Navbar glassmorphism | Task 1 (CSS), Task 4 |
| Sections below hero remain solid | Out of scope in tasks (no changes to non-hero sections) |
| `@supports` fallback | Task 1 |
| Mobile optimization | Task 1 (`@media (max-width: 768px)`) |
| All 7 public pages | Tasks 5-11 |

### Placeholder Scan

- No TBD, TODO, or "implement later" found.
- All code blocks contain complete, copy-pasteable code.
- All commands include expected outputs.
- No "Similar to Task N" references.

### Type Consistency

- Component names: `x-aurora-background`, `x-glass-container` — consistent across all tasks.
- CSS classes: `hero-aurora`, `glass`, `navbar-glass`, `aurora-blob` — consistent across all tasks.
- Tailwind classes use existing design tokens (`bg-neutral-50`, `dark:bg-neutral-950`, etc.) — consistent with codebase.
