# Design Spec — Public Background Transparent Enhancement

**Date:** 2026-05-14
**Scope:** Public frontend (all public pages)
**Status:** Approved for implementation

---

## 1. Overview

Add a **Hero Aurora + Glassmorphism** visual treatment to the header section of every public page. Below the hero section, pages revert to the existing solid background and solid card design. This creates a modern, premium first impression without overwhelming the entire page with transparency effects or hurting performance.

---

## 2. Visual Direction

### 2.1 Light Mode

- **Hero background base:** `bg-neutral-50` (#fafafa)
- **Aurora blobs:** Three soft gradient orbs floating behind hero content
  - Blob A (primary red `#c3110c`): opacity 10%, blur 50px, top-left
  - Blob B (secondary green `#2e7d52`): opacity 8%, blur 45px, right-center
  - Blob C (accent orange `#f5a623`): opacity 6%, blur 40px, bottom-center
- **Glassmorphism container:**
  - `background: rgba(255, 255, 255, 0.6)`
  - `backdrop-filter: blur(16px)`
  - `border: 1px solid rgba(255, 255, 255, 0.4)`
  - `border-radius: 20px`
- **CTA buttons:** remain solid (no transparency) for high contrast and accessibility

### 2.2 Dark Mode

- **Hero background base:** `bg-neutral-950` (#0a0a0a) — existing
- **Aurora blobs:** Same brand colors but lower opacity and higher blur for subtlety
  - Blob A (primary red): opacity 6%, blur 55px
  - Blob B (secondary green): opacity 5%, blur 50px
  - Blob C (accent orange): opacity 4%, blur 45px
- **Glassmorphism container:**
  - `background: rgba(255, 255, 255, 0.07)`
  - `backdrop-filter: blur(16px)`
  - `border: 1px solid rgba(255, 255, 255, 0.12)`
  - `border-radius: 20px`

### 2.3 Navbar Behavior

- On all public pages: navbar uses glassmorphism (`backdrop-filter: blur(12px)`, semi-transparent background) consistently
- `background: rgba(255, 255, 255, 0.75)` in light mode, `background: rgba(255, 255, 255, 0.08)` in dark mode
- A subtle bottom border (`border-b border-white/20 dark:border-white/10`) separates navbar from content below

---

## 3. Scope — Affected Pages

All public pages receive the hero aurora + glassmorphism treatment:

| Page | Hero Content |
|------|-------------|
| Home | Profile photo, headline, subtitle, CTA buttons |
| About | Page title "About", brief intro text |
| Blog Index | Page title "Blog", description |
| Blog Detail | Post title, category, date, author |
| Portfolio Index | Page title "Portfolio", description |
| Portfolio Detail | Project title, type badge, company name |
| Contact | Page title "Contact", contact info |

---

## 4. Architecture

### 4.1 Component Strategy

- Create a reusable **Blade component** (`x-aurora-background`) for the aurora background blobs — included in each page's hero section
- Create a reusable **Blade component** (`x-glass-container`) for wrapping hero content in the glassmorphism effect
- Include both components in each public page's hero section (not in the layout, so each page controls its own hero content)

### 4.2 CSS Approach

- Aurora blobs: implemented as absolutely positioned `div` elements with radial gradients and `filter: blur()`
- Glassmorphism: Tailwind utility classes combined with custom CSS for `backdrop-filter` (since Tailwind 3.1 supports `backdrop-blur` natively)
- Dark mode: use `dark:` Tailwind modifiers and existing `dark` class on `<html>`

### 4.3 Tailwind Classes to Use

```
/* Aurora blobs */
absolute rounded-full filter blur-[50px] opacity-10 bg-primary-600

/* Glassmorphism container */
backdrop-blur-xl bg-white/60 border border-white/40 rounded-2xl

/* Dark mode glass */
dark:bg-white/[0.07] dark:border-white/[0.12]
```

---

## 5. Performance & Fallbacks

1. **Feature detection:** Wrap `backdrop-filter` usage in `@supports (backdrop-filter: blur(12px))`. Browsers that don't support it get a solid background fallback.
2. **Mobile optimization:** Reduce blur amount on mobile devices (e.g., `blur(8px)` instead of `blur(16px)`) or fallback to solid.
3. **No JavaScript:** Aurora blobs are pure CSS. No JS animations, no canvas.
4. **No animated blobs:** Static positioning only. Optional: very subtle CSS float animation (`@keyframes` with `transform: translateY()`) if requested later, but static is the default.

---

## 6. Transition to Solid Section

Below the hero section, a subtle visual separator indicates the transition:

- Option A: A `border-b` or subtle gradient fade from hero base color to section background color
- Option B: Direct transition with adequate vertical spacing (`py-16` gap) — the contrast between aurora hero and solid section is enough

**Decision:** Use Option B (direct transition with spacing). The contrast between the aurora hero and solid white/neutral cards is visually sufficient without an explicit separator.

---

## 7. Accessibility

- Glassmorphism containers must maintain **WCAG 4.5:1 contrast ratio** for text inside them. The `bg-white/60` fallback ensures text remains readable over the aurora blobs.
- CTA buttons remain fully opaque to ensure they are always perceived as interactive.
- `prefers-reduced-motion`: if any subtle float animation is added later, it must respect this media query.

---

## 8. Out of Scope

- Admin panel pages (`/admin/*`) — no changes
- Auth pages (login, register, forgot password) — no changes
- Card components below hero — remain solid (not glassmorphism)
- Footer — no changes
- Existing noise overlay, custom cursor, scroll progress — remain unchanged

---

## 9. Acceptance Criteria

- [ ] All 7 public pages display aurora blobs in the hero section
- [ ] All 7 public pages display glassmorphism container around hero content
- [ ] Dark mode renders subtle aurora blobs with reduced opacity
- [ ] Dark mode renders glassmorphism containers with white-tinted transparency
- [ ] Navbar has glassmorphism effect when overlapping hero
- [ ] Sections below hero remain solid background (no aurora, no glassmorphism on cards)
- [ ] Browser without `backdrop-filter` support shows solid fallback
- [ ] Mobile view remains performant (no jank on scroll)
- [ ] Existing `prefers-color-scheme: dark` behavior is preserved

---

## 10. Files Expected to Change

- `resources/views/layouts/public.blade.php` — navbar glassmorphism, possible hero wrapper
- `resources/views/pages/home.blade.php` — hero section aurora + glass
- `resources/views/pages/about.blade.php` — hero section aurora + glass
- `resources/views/pages/blog/index.blade.php` — hero section aurora + glass
- `resources/views/pages/blog/show.blade.php` — hero section aurora + glass
- `resources/views/pages/portfolio/index.blade.php` — hero section aurora + glass
- `resources/views/pages/portfolio/show.blade.php` — hero section aurora + glass
- `resources/views/pages/contact.blade.php` — hero section aurora + glass
- `resources/css/app.css` — aurora blob utilities, glassmorphism utilities, `@supports` fallback
- `tailwind.config.js` — possibly extend utilities if needed (unlikely)
