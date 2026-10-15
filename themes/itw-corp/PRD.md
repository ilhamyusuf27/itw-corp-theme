# Product Requirements Document (PRD)
## itw-corp — Interior Design Company Website

| Item | Detail |
|---|---|
| Product | itw-corp corporate website |
| Platform | WordPress (self-hosted) |
| Document version | 1.0 (Draft) |
| Date | 14 October 2026 |
| Status | Draft — for review |
| Owner | _TBD_ |

---

## 1. Overview

itw-corp is an interior design company. This project delivers a corporate website built on WordPress that showcases the company's portfolio, explains its services, builds trust with prospective clients, and converts visitors into qualified leads (consultation requests).

The site must be visually strong (interior design is a visual business), fast, easy for non-technical staff to update, and optimized for search and mobile.

## 2. Goals & Success Metrics

### Business goals
1. Generate qualified leads for design consultations.
2. Showcase completed projects to establish credibility and style.
3. Strengthen the itw-corp brand online.
4. Allow the internal team to publish projects and articles without a developer.

### KPIs (measured 3–6 months after launch)
| Metric | Target |
|---|---|
| Consultation form submissions + WhatsApp clicks | ≥ 30 / month (baseline TBD) |
| Visitor-to-lead conversion rate | ≥ 2% |
| Average session duration | ≥ 2 minutes |
| Portfolio page views per session | ≥ 3 |
| Mobile PageSpeed (Lighthouse) performance | ≥ 85 |
| Core Web Vitals | All "Good" (LCP < 2.5s, INP < 200ms, CLS < 0.1) |
| Organic traffic | +25% quarter over quarter |

## 3. Target Audience

| Persona | Description | Needs |
|---|---|---|
| **Homeowner** | Owns or is buying a house/apartment, age 28–55 | Inspiration, style examples, price range, trust signals, easy contact |
| **Business owner** | Office, café, retail, hotel owner | Commercial project examples, process clarity, timelines, capacity |
| **Developer / Architect** | Property developers, architect partners | Track record, project scale, company profile, partnership contact |
| **Job seeker** | Designers, drafters, site supervisors | Careers info and application path |

## 4. Scope

### In scope (v1)
- Responsive marketing website on WordPress
- Portfolio / project showcase with filtering
- Services pages
- Lead capture (consultation form + WhatsApp)
- Blog / articles
- Basic SEO, analytics and security setup
- Admin training and handover documentation

### Out of scope (v1) — candidates for later phases
- E-commerce / furniture shop
- Client portal / project tracking
- Online payment
- 3D room configurator or AR viewer
- Online booking calendar with real-time availability (v1 uses a request form)

## 5. Sitemap

```
Home
├── About Us
│   ├── Company Profile
│   └── Our Team
├── Services
│   ├── Residential Interior
│   ├── Commercial Interior
│   ├── Renovation
│   └── Custom Furniture / Built-in
├── Portfolio
│   └── Project Detail (single)
├── Our Process
├── Blog / Insights
│   └── Article Detail (single)
├── Careers (optional)
├── Contact / Book a Consultation
├── FAQ
└── Legal: Privacy Policy, Terms of Use
```

## 6. Page Requirements

### 6.1 Home
- Hero: full-width image or short video of a signature project, headline, primary CTA "Book a Consultation"
- Short value proposition (3–4 USPs with icons)
- Featured projects (6 items, linked to Portfolio)
- Services overview (cards linking to each service)
- Design process summary (4–6 steps)
- Testimonials slider
- Client / partner logos
- Stats counter (projects completed, years of experience, cities served)
- Latest articles (3)
- Final CTA banner + contact strip

### 6.2 About Us
- Company story, vision & mission, design philosophy
- Team members (photo, name, role) from the Team content type
- Certifications, awards, press mentions

### 6.3 Services (overview + single service template)
- Description, scope of work, deliverables
- Related portfolio projects (auto-pulled by service category)
- Optional "starting from" price range
- FAQ block per service
- CTA to consultation form

### 6.4 Portfolio
- Grid layout with filters: **Category** (Residential, Commercial, Hospitality, Office…), **Style** (Modern, Minimalist, Industrial, Japandi, Classic…), **Location**
- Load more or pagination; no full page reload when filtering (AJAX)
- Hover state showing project name and category

### 6.5 Project Detail
- Title, location, year, area (m²), project type, style, duration, scope
- Cover image + gallery with lightbox
- Optional before/after slider
- Project story: brief, challenge, solution
- Optional video embed / 360° tour embed
- Client testimonial (if available)
- Related projects (same category/style)
- CTA: "Want a similar design? Book a consultation"

### 6.6 Our Process
- Step-by-step: Consultation → Survey & Measurement → Concept & Moodboard → 3D Design → Quotation → Production → Installation → Handover
- Estimated duration per step
- FAQ

### 6.7 Blog / Insights
- Categories and tags
- Featured image, author, publish date, reading time
- Social share buttons
- Related posts and CTA block at end of every article

### 6.8 Contact / Book a Consultation
- Consultation form (see 7.2)
- WhatsApp button, phone, email, office address
- Embedded Google Map
- Office hours
- Social media links

### 6.9 Careers (optional)
- Open positions list (Job content type)
- Application form with CV upload (PDF, max 5 MB)

### 6.10 Global elements
- Sticky header with logo, main menu, CTA button, language switcher
- Footer: short company info, quick links, contact, social icons, newsletter signup (optional), copyright, legal links
- Floating WhatsApp button on all pages
- Cookie consent banner
- Custom 404 page with search and links to Portfolio

## 7. Functional Requirements

### 7.1 Content management
| ID | Requirement | Priority |
|---|---|---|
| FR-01 | Admin can create/edit/delete **Projects** with custom fields (location, year, area, style, category, gallery, before/after, video URL, testimonial) | Must |
| FR-02 | Admin can manage **Services**, **Team Members**, **Testimonials**, **Clients/Partners**, **Jobs** as custom post types | Must |
| FR-03 | Custom taxonomies: Project Category, Design Style, Location | Must |
| FR-04 | Editors can build/modify page sections visually without code | Must |
| FR-05 | Reusable global blocks (CTA banner, testimonials, stats) editable in one place | Should |
| FR-06 | Revision history and scheduled publishing for posts | Should |

### 7.2 Lead capture
| ID | Requirement | Priority |
|---|---|---|
| FR-10 | Consultation form fields: name*, phone/WhatsApp*, email*, project type* (Residential/Commercial/Other), property type, location/city, area (m²), estimated budget range, preferred style, timeline, message, file upload (floor plan/photos, optional), consent checkbox* | Must |
| FR-11 | Spam protection (reCAPTCHA v3 or Cloudflare Turnstile + honeypot) | Must |
| FR-12 | Submissions stored in WordPress database and emailed to sales inbox | Must |
| FR-13 | Auto-reply email to the visitor confirming receipt | Must |
| FR-14 | Thank-you page (or message) that fires a conversion event in GA4 / Meta Pixel | Must |
| FR-15 | Floating WhatsApp button with pre-filled message including page title | Must |
| FR-16 | Optional: send leads to CRM / Google Sheets via webhook | Could |

### 7.3 Search & navigation
| ID | Requirement | Priority |
|---|---|---|
| FR-20 | Portfolio filtering by category, style, location (AJAX) | Must |
| FR-21 | Site search covering pages, projects and posts | Should |
| FR-22 | Breadcrumbs on inner pages | Should |

### 7.4 Multilingual
| ID | Requirement | Priority |
|---|---|---|
| FR-30 | Bahasa Indonesia (default) and English | Should |
| FR-31 | Language switcher in header; translated URLs with hreflang | Should |

### 7.5 Integrations
- Google Analytics 4 + Google Tag Manager
- Google Search Console
- Meta Pixel (if paid social ads are planned)
- Google Maps embed
- WhatsApp click-to-chat
- Instagram feed (optional)
- SMTP service for reliable email delivery

## 8. Non-Functional Requirements

### 8.1 Performance
- Lighthouse mobile performance ≥ 85; desktop ≥ 95
- Images served as WebP/AVIF, responsive `srcset`, lazy-loaded below the fold
- Max upload image size enforced (e.g. resized to 2560px long edge)
- Page caching, browser caching, CSS/JS minification
- CDN for static assets (e.g. Cloudflare)
- Hero video ≤ 5 MB, muted, with poster image; static image fallback on mobile

### 8.2 SEO
- SEO plugin configured (titles, meta descriptions, Open Graph, XML sitemap)
- Schema markup: `Organization`, `LocalBusiness` (InteriorDesigner/HomeAndConstructionBusiness), `BreadcrumbList`, `Article`, `FAQPage`
- Clean permalinks: `/portfolio/{project-name}/`, `/services/{service}/`, `/blog/{post}/`
- Alt text required on all images
- One H1 per page; logical heading hierarchy
- 301 redirects from any old site URLs
- Google Business Profile linked

### 8.3 Accessibility
- WCAG 2.1 AA target
- Sufficient color contrast, keyboard navigation, visible focus states
- Form labels and error messages announced to screen readers
- Lightbox and sliders operable via keyboard

### 8.4 Security
- HTTPS everywhere (SSL)
- Security plugin (firewall, login attempt limiting, malware scan)
- Two-factor authentication for admin accounts
- Custom login URL; XML-RPC disabled if unused
- Least-privilege user roles
- Automatic daily off-site backups, 30-day retention
- WordPress core, theme, plugins kept updated (monthly maintenance)

### 8.5 Compatibility
- Browsers: latest 2 versions of Chrome, Safari, Firefox, Edge; Safari iOS; Chrome Android
- Breakpoints: 360px, 768px, 1024px, 1440px+

### 8.6 Privacy & compliance
- Privacy policy aligned with Indonesia's Personal Data Protection Law (UU PDP No. 27/2022)
- Cookie consent banner; analytics loaded according to consent
- Explicit consent checkbox on forms

## 9. Technical Stack (WordPress)

| Layer | Recommendation | Notes |
|---|---|---|
| CMS | WordPress (latest stable) | PHP 8.2+, MySQL 8 / MariaDB 10.6+ |
| Theme | Lightweight base theme (e.g. Hello Elementor, GeneratePress, Astra, Kadence) with child theme | Keep custom code in child theme |
| Page builder | Elementor Pro **or** Gutenberg + block library (e.g. Kadence Blocks / GenerateBlocks) | Decide in kickoff — see Open Questions |
| Custom fields & CPT | Advanced Custom Fields (ACF) Pro + CPT UI (or register in code) | For Projects, Services, Team, etc. |
| Filtering | Elementor loop filter, Search & Filter Pro, or FacetWP | AJAX portfolio filter |
| Forms | Fluent Forms / Gravity Forms / WPForms | Must support file upload, entries, webhooks |
| SEO | Rank Math or Yoast SEO | |
| Multilingual | WPML or Polylang | |
| Caching / performance | LiteSpeed Cache (on LiteSpeed host) or WP Rocket | + image optimizer (ShortPixel / Imagify / EWWW) |
| Security | Wordfence or Solid Security | + 2FA plugin |
| Backups | UpdraftPlus or host-level backups | Off-site storage |
| SMTP | WP Mail SMTP / FluentSMTP | Via Google Workspace, Mailgun, Brevo, etc. |
| Gallery / lightbox | Built-in builder gallery or lightweight lightbox plugin | |
| Hosting | Managed WordPress hosting with local (Indonesia/Singapore) data center | Staging environment required |

**Guideline:** keep active plugins to the minimum needed (target ≤ 20) and avoid overlapping functionality.

### Environments
- **Local** → **Staging** (password-protected, `noindex`) → **Production**
- Version control (Git) for child theme and custom code

## 10. Content Model

### Project (CPT: `project`)
| Field | Type | Required |
|---|---|---|
| Title | Text | Yes |
| Featured image | Image | Yes |
| Gallery | Image gallery (min 4) | Yes |
| Location | Text / taxonomy | Yes |
| Year | Number | Yes |
| Area (m²) | Number | No |
| Category | Taxonomy | Yes |
| Style | Taxonomy | Yes |
| Duration | Text | No |
| Scope of work | Checkbox list | No |
| Brief / Challenge / Solution | Rich text | Yes |
| Before & after images | Image pair | No |
| Video / 360° URL | URL | No |
| Testimonial | Relationship → Testimonial | No |
| Featured on homepage | Toggle | No |

### Other CPTs
- **Service:** title, icon, short description, full content, price range (optional), FAQ repeater, related category
- **Team Member:** name, photo, position, short bio, LinkedIn/Instagram, display order
- **Testimonial:** client name, role/company, photo (optional), quote, rating, related project
- **Client/Partner:** name, logo, URL
- **Job:** title, department, location, type, description, requirements, closing date

## 11. User Roles & Permissions

| Role | Who | Access |
|---|---|---|
| Administrator | Developer / IT lead | Full access |
| Editor | Marketing team | All content, menus; no plugins/settings |
| Author | Writers / designers | Own blog posts and projects |
| Lead viewer (custom/Shop Manager-like) | Sales team | View/export form entries only |

## 12. Design Requirements

- Aesthetic reflecting itw-corp's brand: clean, premium, image-led, generous whitespace
- Brand guidelines (logo, colors, typography) to be supplied by itw-corp; if none exist, a mini style guide is created in the design phase
- Design deliverables: moodboard → wireframes (mobile + desktop) → high-fidelity mockups (Figma) for Home, Portfolio, Project Detail, Service, About, Contact, Blog, Article
- Max 2 font families; web fonts self-hosted or preloaded
- Consistent photo treatment; professional project photography strongly recommended

## 13. Content Responsibilities

| Content | Provided by | Due |
|---|---|---|
| Logo & brand assets | itw-corp | Kickoff |
| Company profile, vision/mission | itw-corp | Week 2 |
| Project photos & data (min 12 projects at launch) | itw-corp | Week 3 |
| Service descriptions | itw-corp (copywriter support optional) | Week 3 |
| Team photos & bios | itw-corp | Week 3 |
| Testimonials (min 5) | itw-corp | Week 3 |
| Initial blog articles (min 3) | itw-corp / copywriter | Week 5 |
| English translations | itw-corp / translator | Week 5 |
| Legal pages | itw-corp (legal review) | Week 5 |

## 14. Milestones & Timeline (estimate: ~8 weeks)

| Phase | Duration | Deliverables |
|---|---|---|
| 1. Discovery & kickoff | Week 1 | Confirmed scope, sitemap, stack decisions, content plan |
| 2. UX & UI design | Weeks 2–3 | Wireframes, high-fidelity mockups, approved design |
| 3. Development | Weeks 3–6 | Theme setup, CPTs, templates, forms, integrations on staging |
| 4. Content entry | Weeks 5–6 | Projects, pages, posts, translations loaded |
| 5. QA & UAT | Week 7 | Cross-browser/device testing, performance, SEO, accessibility, client UAT |
| 6. Launch | Week 8 | Production deploy, DNS, SSL, analytics verification, redirects |
| 7. Handover & training | Week 8 | Admin guide, training session, credentials handover |
| Post-launch support | 30 days | Bug fixes; then monthly maintenance plan |

## 15. Acceptance Criteria (launch checklist)

- [ ] All pages in sitemap built and approved per design
- [ ] Portfolio filter works on desktop and mobile without page reload
- [ ] Consultation form delivers email to sales inbox and auto-reply to visitor; entries stored in admin
- [ ] Spam protection active; test submissions pass
- [ ] WhatsApp button opens chat with pre-filled message on mobile and desktop
- [ ] GA4 records page views and `generate_lead` conversion event
- [ ] Lighthouse mobile performance ≥ 85 on Home, Portfolio, Project Detail
- [ ] No broken links; custom 404 works
- [ ] XML sitemap submitted to Google Search Console
- [ ] Schema validates in Google Rich Results Test
- [ ] SSL active, HTTP → HTTPS redirect works
- [ ] Backups scheduled and one restore tested
- [ ] Admin 2FA enabled; default `admin` username not used
- [ ] Both languages complete and switcher works (if in v1)
- [ ] Cookie consent and privacy policy live
- [ ] Editors can add a new project end-to-end without developer help (verified in training)

## 16. Risks & Mitigations

| Risk | Impact | Mitigation |
|---|---|---|
| Late or low-quality project photos | Delayed launch, weak portfolio | Request photos at kickoff; budget for professional shoot |
| Heavy images slow down the site | Poor UX & SEO | Auto-resize on upload, WebP conversion, CDN, lazy-load |
| Plugin bloat / conflicts | Performance & security issues | Approved plugin list; staging tests before updates |
| Scope creep | Timeline/budget overrun | Change requests logged and approved; defer to Phase 2 |
| Form spam | Polluted leads | Turnstile/reCAPTCHA + honeypot + entry moderation |

## 17. Future Enhancements (Phase 2+)

- Online consultation booking with calendar sync
- Cost estimator / budget calculator
- 3D virtual tours or AR furniture previews
- Furniture & décor e-commerce (WooCommerce)
- Client portal for project progress and documents
- CRM integration (HubSpot, Zoho, etc.)
- Downloadable company profile / lookbook (gated lead magnet)

## 18. Open Questions

1. Elementor Pro or Gutenberg-based build? (affects editing experience and license costs)
2. Is bilingual (ID/EN) required at launch or Phase 2?
3. Are price ranges shown publicly on service pages?
4. Which inbox(es) and team members receive leads? Is a CRM already in use?
5. Is there an existing website/domain requiring URL redirects?
6. Hosting provider already chosen?
7. Will Careers be included in v1?
8. Are paid ads planned at launch (Meta Pixel / Google Ads conversion tags)?

## 19. Assumptions

- Brand guidelines and logo exist or will be created during design.
- itw-corp supplies all text and images on schedule.
- Default site language is Bahasa Indonesia, with English as secondary.
- Primary market is Indonesia; hosting with a nearby data center.

---

**Approval**

| Name | Role | Signature | Date |
|---|---|---|---|
| | itw-corp — Project Owner | | |
| | Project Manager | | |
| | Lead Developer | | |
