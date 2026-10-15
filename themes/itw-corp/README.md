# ITW Corp — WordPress Block Theme

The block theme (Full Site Editing) for the itw-corp interior design website.
WordPress 6.7+ and PHP 8.1+. Product requirements are in [`PRD.md`](PRD.md).

The look is calm and homey: warm paper background, walnut text, tan and sand fields,
one serif typeface (Sentient), the studio's own renders shown large, 8px corners on
pictures, pill-shaped buttons, no lines, gradients or shadows.

## Requirements

This theme works together with two **must-use plugins** in `wp-content/mu-plugins/`
(tracked in the same repository, one level up). Deploy them with the theme.

| Plugin | What it does |
| --- | --- |
| `itw-content.php` + `itw-content/` | Content model: **Projects** (with Category, Style and Location), **Services** and **Team**, their editor panels, block bindings, FAQ schema; **Settings → Contact details** |
| `itw-login.php` | Private login address and the styled login screen (see [Login](#login)) |

The content model is in a plugin, not in the theme, so projects and services survive a theme change.

## Structure

```
itw-corp/
├── style.css                 Theme header only
├── theme.json                Design tokens: palette, Sentient font, sizes, spacing, buttons
├── functions.php             Bootstrap: constants + autoloader + Theme::boot()
├── inc/                      Namespaced PHP (ITWCorp\), PSR-4 autoloaded
│   ├── Theme.php             Service container: list of services to boot
│   ├── Setup.php             Theme supports, text domain, editor styles
│   ├── Assets.php            Front-end CSS/JS + per-block CSS loader
│   ├── BlockStyles.php       Block style variations (button "Text link", …)
│   ├── Patterns.php          Pattern inserter categories (one per pattern folder)
│   ├── Media.php             Pattern helper: images from the media library by file name
│   ├── Projects.php          Query-loop rules: related, featured, service, team loops; lightbox
│   ├── Blog.php              Reading time, share links, related articles
│   └── Cleanup.php           <head> cleanup, XML-RPC off
├── templates/                One file per WordPress template (see below)
├── parts/                    header.html, footer.html
├── patterns/                 All markup, in folders by page (see patterns/README.md)
├── assets/
│   ├── css/                  global.css + one file per area (home, contact, …)
│   ├── css/blocks/           {namespace}-{block}.css, loaded only when that block renders
│   ├── js/theme.js           All front-end behaviour (progressive; works without it)
│   └── fonts/                Sentient 300/400/500 (self-hosted, woff2)
├── styles/                   Style variations
└── languages/
```

## Pages and templates

| URL | Template | Body pattern | Styles |
| --- | --- | --- | --- |
| `/` | `page-home` (Full width) | page content from `pages/home.php` | `home.css` |
| `/contact/` | `page-home` | `pages/contact.php` | `contact.css` |
| `/our-process/` | `page-home` | `pages/process.php` | `process.css` |
| `/about/` | `page-home` | `pages/about.php` | `about.css` |
| `/portfolio/`, `/portfolio/category|style|location/…` | `archive-project`, `taxonomy-project_*` | `layouts/portfolio.php` | `portfolio.css` |
| `/portfolio/{project}/` | `single-project` | `layouts/project.php` | `portfolio.css` |
| `/services/` | `archive-service` | `layouts/services.php` | `services.css` |
| `/services/{service}/` | `single-service` | `layouts/service.php` | `services.css` |
| `/blog/`, categories, tags, search | `home`, `archive`, `search`, `index` | `layouts/blog.php` | `blog.css` |
| `/blog/{article}/` | `single` | `layouts/post.php` | `blog.css` |
| 404 | `404` | `layouts/404.php` | — |

Designed pages (Home, Contact, Our Process, About) use the **"Full width (designed sections)"**
template (`templates/page-home.html`). Their blocks are saved in the page itself, so editors can
change text and images in the editor.

Expected WordPress settings:

- **Settings → Reading:** homepage = "Home", posts page = "Blogs" (slug `blog`).
- **Settings → Permalinks:** `/blog/%postname%/`. Projects and services keep `/portfolio/…` and `/services/…`.

## Patterns

Patterns are organised by folder with one naming rule (`itw-corp/{folder-prefix}-{name}`).
See [`patterns/README.md`](patterns/README.md).

Editing a pattern file changes **new** insertions only. Pages already built keep their own copy of
the blocks. To refresh a page, insert its `pages/` pattern again into an empty page.

## Content

Contact details (WhatsApp, phone, email, social links) are edited once in **Settings → Contact details**.
Patterns and pages use tokens such as `{{whatsapp}}`, `{{whatsapp_url}}`, `{{phone}}`, `{{email}}`;
never type the numbers themselves. The full list is on that settings screen.

| Content | Where to edit | Shown on |
| --- | --- | --- |
| Projects | Dashboard → Projects. Cover image, story and gallery as blocks; facts in the **Project details** panel; "Featured on homepage" toggle | Portfolio, project pages, homepage (featured), service pages |
| Services | Dashboard → Services. Scope, deliverables and FAQ as blocks (FAQ = Details blocks); starting price and project category in **Service details**; order with "Order" | Services, service pages |
| Team | Dashboard → Team. Name, photo, role, links; order with "Order" | About (hidden until the first member is published) |
| Articles | Dashboard → Posts | Insights, homepage "latest articles" |

Images in patterns come from the media library by file name, for example
`Media::image( '2ndf-liv', 'Alt text' )`. Upload files with the same names on every environment.

### Sample content to replace before launch

- Project names, styles, locations, years and areas (descriptions of the renders)
- Homepage testimonial and figures (180 / 12 / 9)
- Service descriptions, lists and FAQ answers; Our Process step times and FAQ
- About: story, vision, mission, design principles
- Phone, WhatsApp, email and social links: **Settings → Contact details** (one place for the whole site)
- Opening hours (address is real)
- Three starter articles under Insights

## Front-end behaviour (`assets/js/theme.js`)

Everything is progressive: without JavaScript all content is visible and links and forms still work.

- Sticky header tone change and `--itw-header-h` (header height, for sticky elements)
- Hero picture "shutter" opening, gentle entrance of sections
- Portfolio filters and "Load more" without page reload (plain links underneath)
- Process row arrows and progress bar; Our Process step highlighting
- Consultation form: validation, then a ready-written WhatsApp or email message
  (replace with a form plugin for stored submissions, spam protection and auto-replies)
- Articles: "Copy link" share button

## Login

`itw-login.php` hides `/wp-login.php`, `/wp-admin/` (when logged out) and the `/login`,
`/admin`, `/dashboard` shortcuts; they show "page not found". Login works only at a private path.

- **Set the path** per environment in `wp-config.php`: `define( 'ITW_LOGIN_SLUG', 'your-private-path' );`
  (or locally: `wp option update itw_login_slug your-private-path`).
- **Read the path:** `wp option get itw_login_slug`.
- **Locked out:** add `define( 'ITW_LOGIN_DISABLE', true );` to `wp-config.php`, or delete the file.

Never commit the real path. Hiding the login is not a replacement for strong passwords,
two-factor authentication and login-attempt limits.

## Conventions

- **Styling order:** `theme.json` → `assets/css/blocks/*.css` → area CSS (`home.css`, …) → `global.css`.
- **Tokens:** use the CSS variables from `home.css` (`--paper`, `--sand`, `--tan`, `--walnut`,
  `--soft`, `--s-sm` … `--s-disp`, `--g`, `--gap`, `--sec`, `--r`). Five type sizes; headings ≤ 2 lines.
- **New PHP feature:** create `inc/MyFeature.php` implementing `Contracts\Service`, add it to `Theme::SERVICES`.
- **New block CSS:** add `assets/css/blocks/core-quote.css`; it loads only on pages that use `core/quote`.
- **Cache busting:** asset versions use `filemtime()` while `WP_DEBUG` is on, the theme version otherwise.
- **Development:** add `define( 'WP_DEVELOPMENT_MODE', 'theme' );` to `wp-config.php` so new or
  edited pattern files show up without clearing the pattern cache.

## Linting

```
composer global require wp-coding-standards/wpcs
phpcs
```
