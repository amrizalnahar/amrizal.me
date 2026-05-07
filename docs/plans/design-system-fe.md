# Design System — amrizal.me Frontend

> Pendekatan: Hybrid Design Tokens + Blade Components (prototipe via HTML statis + Tailwind CDN)
> Target: Laravel + Blade SSR, Tailwind CSS v3+

---

## 1. Design Principles

- **Mobile-first**: Semua komponen dirancang untuk mobile, kemudian scale up ke tablet/desktop
- **Bilingual-ready**: Layout harus menangani perbedaan panjang teks ID vs EN tanpa pecah
- **Warm & Personal**: Palet warna red-orange mencerminkan personal branding yang berani dan hangat
- **Content-first**: Tipografi dan spacing didesain agar konten mudah dibaca

---

## 2. Color System

### Brand Palette (Custom)

| Token | Hex | Usage |
|-------|-----|-------|
| `primary-950` | `#280905` | Darkest background accent, gradient start |
| `primary-900` | `#740A03` | Button primary, link hover, active nav |
| `primary-600` | `#C3110C` | Brand accent, badges, icon highlight, CTA |
| `primary-400` | `#E6501B` | Gradient end, hover glow, decorative element |

### Neutral Palette

| Token | Light Mode | Dark Mode | Usage |
|-------|------------|-----------|-------|
| `bg-base` | `#FFFFFF` | `#0A0A0A` | Background halaman |
| `bg-surface` | `#FAFAFA` | `#171717` | Background card, section alternate |
| `bg-elevated` | `#F5F5F5` | `#262626` | Input, dropdown, tooltip |
| `text-primary` | `#171717` | `#FAFAFA` | Heading, body utama |
| `text-secondary` | `#737373` | `#A3A3A3` | Caption, metadata, placeholder |
| `text-muted` | `#A3A3A3` | `#737373` | Timestamp, disabled |
| `border-default` | `#E5E5E5` | `#404040` | Card border, divider, input border |
| `border-focus` | `#C3110C` | `#E6501B` | Input focus, ring accent |

### Semantic Colors

| Token | Value | Usage |
|-------|-------|-------|
| `badge-personal-bg` | `primary-600/10` | Badge proyek Pribadi |
| `badge-personal-text` | `primary-600` | Text badge Pribadi |
| `badge-office-bg` | `primary-400/10` | Badge proyek Kantor |
| `badge-office-text` | `primary-400` | Text badge Kantor |
| `badge-tech-bg` | `neutral-100` (light) / `neutral-800` (dark) | Tag teknologi background |
| `badge-tech-text` | `text-secondary` | Tag teknologi text |

---

## 3. Typography

### Font Family

- **Primary:** `Plus Jakarta Sans` (Google Fonts) — cocok untuk bilingual ID/EN
- **Fallback:** `system-ui, -apple-system, sans-serif`
- **Mono (code):** `JetBrains Mono` atau `Fira Code`

### Type Scale

| Token | Size Mobile | Size Desktop | Line Height | Weight | Usage |
|-------|-------------|--------------|-------------|--------|-------|
| `display` | 40px | 64px | 1.1 | 700 | Hero name |
| `h1` | 32px | 48px | 1.2 | 700 | Page title |
| `h2` | 28px | 36px | 1.2 | 700 | Section heading |
| `h3` | 22px | 24px | 1.3 | 600 | Card title |
| `h4` | 18px | 18px | 1.4 | 600 | Subsection, label |
| `body` | 16px | 16px | 1.6 | 400 | Paragraph |
| `body-sm` | 14px | 14px | 1.5 | 400 | Caption, metadata |
| `label` | 12px | 12px | 1.4 | 500 | Tag, badge, timestamp |

---

## 4. Spacing System

### Layout

| Token | Tailwind Class | Usage |
|-------|---------------|-------|
| `page-container` | `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8` | Container halaman |
| `section-gap` | `py-16 md:py-24` | Jarak antar section vertikal |
| `section-gap-sm` | `py-12 md:py-16` | Jarak antar section (halaman pendek) |

### Component Spacing

| Token | Value | Usage |
|-------|-------|-------|
| `card-padding` | `p-6` | Padding dalam card |
| `card-gap` | `gap-4` | Gap antara elemen dalam card |
| `grid-gap` | `gap-6` | Gap grid layout |
| `stack-gap-sm` | `space-y-2` | Stack elemen rapat |
| `stack-gap-md` | `space-y-4` | Stack elemen normal |
| `stack-gap-lg` | `space-y-6` | Stack elemen longgar |

---

## 5. Border Radius

| Token | Value | Usage |
|-------|-------|-------|
| `radius-sm` | `6px` (`rounded-md`) | Button, input, badge |
| `radius-md` | `8px` (`rounded-lg`) | Card |
| `radius-lg` | `12px` (`rounded-xl`) | Image, large card |
| `radius-full` | `9999px` (`rounded-full`) | Avatar, pill badge |

---

## 6. Shadow & Elevation

| Token | Light Mode | Dark Mode | Usage |
|-------|------------|-----------|-------|
| `shadow-card` | `shadow-sm` | `shadow-none` | Card default |
| `shadow-card-hover` | `shadow-md` | `shadow-lg shadow-white/5` | Card hover |
| `shadow-button` | `shadow-sm` | `shadow-none` | Button default |
| `shadow-button-hover` | `shadow-md` | `shadow-lg shadow-primary-600/20` | Button hover |
| `ring-focus` | `ring-2 ring-primary-600 ring-offset-2` | `ring-2 ring-primary-400 ring-offset-2 ring-offset-neutral-950` | Focus state |

---

## 7. Component Specifications

### 7.1 Button

**Variants:**
- `primary` — bg `primary-600`, text white, hover bg `primary-900`
- `secondary` — bg `bg-elevated`, text `text-primary`, border `border-default`, hover bg `primary-600/5`
- `ghost` — transparent, text `text-primary`, hover bg `primary-600/5`
- `link` — transparent, text `primary-600`, underline on hover

**Sizes:**
- `sm` — px-3 py-1.5, text-sm
- `md` — px-4 py-2, text-base (default)
- `lg` — px-6 py-3, text-base

**States:** hover, active, disabled (opacity-50 cursor-not-allowed), focus (ring-focus)

---

### 7.2 Badge

**Variants:**
- `personal` — bg `badge-personal-bg`, text `badge-personal-text`, border `primary-600/20`
- `office` — bg `badge-office-bg`, text `badge-office-text`, border `primary-400/20`
- `tech` — bg `badge-tech-bg`, text `badge-tech-text`, border `border-default`

**Shapes:**
- `default` — `rounded-md` (project type)
- `pill` — `rounded-full` (technology tag)

---

### 7.3 Card Project

**Structure:**
- Thumbnail: aspect-ratio 16/9, `rounded-lg`, object-cover
- Badge tipe: positioned top-left or inline
- Title: `h3`
- Short description: `body-sm`, 2-3 lines max (line-clamp-3)
- Tech tags: row of `pill` badges
- Links: icon-only buttons (demo, repo)

**States:** default (`shadow-card border border-default`), hover (`shadow-card-hover -translate-y-1`)

---

### 7.4 Card Experience (Pengalaman Kerja)

**Structure:**
- Logo: 48x48, `rounded-lg`, object-contain
- Company name: `h4`
- Position: `body`, weight 500
- Period: `body-sm`, `text-muted`
- Description: `body-sm`, `text-secondary`

**Layout:** Horizontal on desktop (logo left, content right), vertical on mobile.

---

### 7.5 Card Blog

**Structure:**
- Thumbnail: aspect-ratio 16/10, `rounded-lg`
- Category badge: `pill`, `primary-600` bg
- Title: `h3`
- Excerpt: `body-sm`, line-clamp-2
- Meta row: date + read time, `body-sm`, `text-muted`

---

### 7.6 Form Input

**Structure:**
- Label: `label`, weight 500, mb-1
- Input: `w-full px-4 py-2.5 bg-bg-elevated border border-default rounded-md text-primary placeholder:text-muted`
- Focus: `border-focus ring-focus`
- Error: `border-red-500`, error text below `text-red-500 text-sm`

---

### 7.7 Navbar

**Structure:**
- Fixed top, full width, bg `bg-base/80 backdrop-blur-md border-b border-default`
- Logo/Name: left
- Nav links: center/right (hidden on mobile)
- Right actions: Lang switcher + Theme toggle
- Mobile: hamburger menu → slide-down or sheet

**Active state:** text `primary-600`, font-weight 600
**Hover:** text `primary-600`

---

### 7.8 Footer

**Structure:**
- Full width, bg `bg-surface`, border-t `border-default`
- Container: `page-container`
- Top row: Logo/brand + quick links + social icons
- Bottom row: copyright text, centered

---

### 7.9 Theme Toggle

**Icon:** Sun (light mode) / Moon (dark mode)
**Style:** `ghost` button, `rounded-full`, size `w-9 h-9`
**Animation:** icon rotate/fade on toggle

---

### 7.10 Lang Switcher

**Style:** `ghost` button or segmented control (ID | EN)
**Active:** `primary-600` bg, white text
**Inactive:** transparent, `text-secondary`

---

## 8. Dark Mode Strategy

- **Mechanism:** Tailwind `darkMode: 'class'`
- **Toggle:** JavaScript toggles `dark` class on `<html>`
- **Persistence:** `localStorage` key `theme`
- **Default:** `prefers-color-scheme` media query on first visit
- **All components** use `dark:` prefix for color overrides

---

## 9. Responsive Breakpoints

| Name | Width | Usage |
|------|-------|-------|
| `sm` | 640px | Small tablets |
| `md` | 768px | Tablets |
| `lg` | 1024px | Small laptops |
| `xl` | 1280px | Desktops |
| `2xl` | 1536px | Large screens |

---

## 10. Z-Index Scale

| Token | Value | Usage |
|-------|-------|-------|
| `z-dropdown` | 50 | Dropdown menu |
| `z-sticky` | 40 | Sticky navbar |
| `z-modal` | 60 | Modal/lightbox |
| `z-toast` | 70 | Toast notification |
| `z-tooltip` | 80 | Tooltip |

---

## 11. Prototipe Structure

Folder prototipe akan berisi:

```
prototype/
├── index.html                 # Halaman Beranda (reference implementation)
├── css/
│   └── tailwind-config.js     # CDN config dengan custom theme
├── components/
│   ├── button.html
│   ├── badge.html
│   ├── card-project.html
│   ├── card-experience.html
│   ├── card-education.html
│   ├── card-certificate.html
│   ├── card-blog.html
│   ├── form-input.html
│   ├── form-textarea.html
│   ├── navbar.html
│   ├── footer.html
│   ├── theme-toggle.html
│   ├── lang-switcher.html
│   ├── section-header.html
│   └── project-filter.html
└── assets/
    └── (placeholder images)
```

Setiap komponen HTML adalah **self-contained snippet** yang bisa di-copy-paste ke Blade component saat implementasi Laravel.

---

## 12. Tailwind Config Extension (for CDN prototype)

```javascript
tailwind.config = {
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: {
          950: '#280905',
          900: '#740A03',
          600: '#C3110C',
          400: '#E6501B',
        },
      },
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
      },
    },
  },
}
```

Saat migrasi ke Laravel, config di atas dipindahkan ke `tailwind.config.js` project.
