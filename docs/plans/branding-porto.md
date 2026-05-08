# TASK: Professional Portfolio — AI Native System Analyst

## 🎯 Objective

Build a **single-file HTML portfolio** (`index.html`) as a professional branding page.
The goal is to position the owner as:

> *A System Analyst who thinks in systems and executes with AI — bridging the gap between strategic planning and production-grade delivery.*

---

## 👤 Subject Profile

| Attribute       | Detail                                                                                   |
| --------------- | ---------------------------------------------------------------------------------------- |
| **Name**        | Amrizal Faizi                                                                            |
| **Primary Role**| System Analyst                                                                           |
| **Superpower**  | AI Native Engineer                                                                       |
| **Stack**       | Laravel, Next.js, WooCommerce, REST API                                                  |
| **AI Tools**    | Claude, Kilo Code, Cursor (AI-assisted development workflow)                             |
| **Artifacts**   | PRD, FSD, User Stories, System Architecture, Agile Documentation                        |
| **Location**    | Yogyakarta, Indonesia                                                                    |
| **Experience**  | ~3 years in software house environment (System Analyst + R&D)                           |

---

## 📐 Content Architecture

Build these **sections** in order:

### 1. Hero Section
- Name + title: `System Analyst · AI Native Engineer`
- Tagline (use this): *"I don't just analyze systems — I build them, with AI as my co-pilot."*
- Subtle animation on load (staggered text reveal)
- CTA button: `View My Work` (smooth scroll to Projects)

---

### 2. Who I Am — Dual Identity Section
Present **two sides** as a visual split or toggle card:

**Side A — System Analyst**
- Requirement gathering & gap analysis
- Writing PRD (Product Requirements Document)
- Writing FSD (Functional Specification Document)
- User story & use case modeling
- Agile artifact management
- System architecture design

**Side B — AI Native Engineer**
- AI-augmented development planning (prompt engineering for dev tasks)
- Full-stack execution: Laravel (backend) + Next.js (frontend)
- WooCommerce & REST API integration
- Phased development using AI agents (Kilo Code, Claude)
- Translating system specs into executable AI workflows

> Design this section so visitors clearly understand: *this is not two separate people, this is one person with a full-spectrum capability.*

---

### 3. What I Do — Capability Grid
Show as an icon/card grid (6 cards):

1. **System Planning** — From business needs to technical blueprint
2. **AI-Powered Development** — Code faster, smarter, with AI orchestration
3. **Documentation Engineering** — PRD, FSD, and Agile docs as living artifacts
4. **API Integration** — REST API design and WooCommerce ecosystem
5. **Full-Stack Delivery** — Laravel + Next.js from database to UI
6. **Requirement Analysis** — Translating stakeholder needs into dev-ready specs

---

### 4. Featured Projects
Show **2–3 project cards** (use placeholder data, realistic format):

**Project 1: Importa**
- Subtitle: *Product Catalog Management System*
- Description: Laravel + Next.js application integrated with WooCommerce for incremental product sync, SKU taxonomy management, and multi-store catalog operations.
- Tags: `Laravel` `Next.js` `WooCommerce` `REST API` `PRD` `FSD`
- Role: System Analyst + AI Native Engineer

**Project 2: AKSARA (AFGoal)**
- Subtitle: *Financial Risk Management System Documentation*
- Description: Reverse-engineered full FSD documentation from existing repository using AI-assisted plan mode. Produced 13-section FSD covering architecture, schema, and functional flows.
- Tags: `FSD` `DBML` `System Analysis` `AI Documentation`
- Role: System Analyst

**Project 3: Kepala Desa Campaign Site**
- Subtitle: *Village Head Candidate Profile Website*
- Description: Campaign website with program showcase, profile, and community engagement sections built with modern frontend stack.
- Tags: `Next.js` `Tailwind CSS` `Frontend`
- Role: Developer

---

### 5. My AI-Native Workflow
Visual flow diagram (use HTML/CSS, no external chart library):

```
Business Requirement
       ↓
  System Analysis  ←→  AI-Assisted Research
       ↓
   PRD / FSD Writing  ←→  AI Documentation Assistant
       ↓
  Architecture Design  ←→  AI Diagram & Review
       ↓
  Phased Dev Planning  ←→  Kilo Code / Claude Agent
       ↓
  Code Execution & Review  ←→  AI Co-Pilot
       ↓
  Delivery & Iteration
```

Present this as a stylized vertical/horizontal stepper with AI touchpoints visually marked.

---

### 6. Tech Stack & Tools
Group and display as badge/chip clusters:

**Backend:** Laravel, PHP, MySQL
**Frontend:** Next.js, React, Tailwind CSS
**Integration:** WooCommerce, REST API
**Documentation:** PRD, FSD, DBML, User Stories
**AI Tools:** Claude, Kilo Code, Cursor
**Dev Environment:** Laragon, VS Code, Git

---

### 7. Contact / Footer
- Simple footer with:
  - Name
  - Email placeholder: `amrizal@example.com`
  - GitHub placeholder: `github.com/amrizal`
  - LinkedIn placeholder
  - Line: *"Open for freelance projects & collaboration."*

---

## 🎨 Design Direction

| Attribute         | Direction                                                                          |
| ----------------- | ---------------------------------------------------------------------------------- |
| **Theme**         | Dark mode — deep charcoal/near-black background                                    |
| **Accent**        | Electric cyan `#00D9FF` or amber `#F5A623` — pick ONE and commit                  |
| **Typography**    | Display: `Syne` or `Cabinet Grotesk` · Body: `DM Sans` or `Instrument Sans`       |
| **Aesthetic**     | Refined technical — clean grid, subtle grid lines as background texture            |
| **Motion**        | Staggered fade-in on scroll, smooth section transitions, hover lift on cards       |
| **Layout**        | Full-width sections, generous whitespace, asymmetric hero                          |
| **NO**            | Purple gradients, Inter font, stock-photo backgrounds, generic card shadows        |

---

## ⚙️ Technical Requirements

- **Single file**: Everything in one `index.html` (inline CSS + JS)
- **No build tools**: No npm, no webpack — pure HTML/CSS/JS
- **Fonts**: Load from Google Fonts CDN
- **Icons**: Use inline SVG or Lucide CDN
- **Responsive**: Mobile-first, must work on 375px and 1440px
- **Scroll behavior**: Smooth scroll, sticky header after hero
- **Animations**: CSS-only preferred, minimal JS for scroll triggers
- **No frameworks**: Vanilla JS only, no React/Vue

---

## 📁 Output

- File: `index.html`
- Location: root of the repository
- Self-contained, open-in-browser ready

---

## ✅ Acceptance Criteria

- [ ] Visitor immediately understands dual identity: *System Analyst + AI Native Engineer*
- [ ] Projects section communicates real scope and technical depth
- [ ] AI-Native Workflow section visually differentiates from a regular developer portfolio
- [ ] Design feels premium, dark-tech, professional — not generic
- [ ] All sections render correctly on mobile and desktop
- [ ] No broken layout, no lorem ipsum left in final output