# Patterns

WordPress registers every `.php` file in this folder and its subfolders. A pattern is
identified by the `Slug:` in its header, never by its file name, so files can move freely.

## Folders

| Folder      | What lives here                                                      | Inserter category        |
| ----------- | -------------------------------------------------------------------- | ------------------------ |
| `pages/`    | Whole pages, composed from the sections below. Insert into an empty page. | ITW · Full pages     |
| `home/`     | Sections only used on the home page.                                 | ITW · Home               |
| `contact/`  | Sections only used on the Contact page.                              | ITW · Contact            |
| `process/`  | Sections only used on the Our Process page.                          | ITW · Process            |
| `about/`    | Sections only used on the About page (recognition is optional).      | ITW · About              |
| `shared/`   | Sections used on more than one page (reply cards, process row, project card). | ITW · Shared     |
| `layouts/`  | Bodies of the theme templates (portfolio, project, services, service, 404). Hidden from the inserter. | — |
| `blog/`     | Pieces of the blog templates (posts grid, post meta, comments).      | ITW · Shared / hidden    |
| `parts/`    | Template-part content (footer). Hidden from the inserter.            | —                        |
| `starter/`  | The original scaffold sections. Not used anywhere; safe to delete.   | ITW · Starter (unused)   |

## Naming

- File: `{folder}/{name}.php`, e.g. `home/hero.php`.
- Slug: `itw-corp/{prefix}-{name}`, where the prefix follows the folder:
  `page-`, `home-`, `contact-`, `process-`, `about-`, `shared-`, `layout-`, `blog-`, `part-`, `starter-`.
  Example: `home/hero.php` → `itw-corp/home-hero`.
- Title: `{Area}: {what it is}`, e.g. `Home: hero`.
- A section used by a second page moves to `shared/` and gets a `shared-` slug; update the
  `<!-- wp:pattern {"slug":"…"} /-->` references in `pages/`, `layouts/` and `../templates/`.

## Where things are referenced

- `../templates/*.html` include `layout-*` and `blog-*` patterns.
- `../parts/footer.html` includes `part-footer`.
- `pages/*.php` include the page's own sections plus `shared-*` ones.

Pages already saved in the database hold their own copy of the blocks, so editing a pattern
here changes new insertions, not pages that were already built. Re-insert the matching
`pages/` pattern (or ask for a re-sync) to refresh an existing page.

Styles for each folder live in `../assets/css/` (`home.css`, `contact.css`, `process.css`, `about.css`,
`portfolio.css`, `services.css`).
