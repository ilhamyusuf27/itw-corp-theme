# ITW Corp — WordPress site code

This repository is the site's `wp-content/` folder, with only our own code tracked:

```
wp-content/
├── themes/itw-corp/   Block theme (design, templates, patterns) — see its README
└── mu-plugins/        Must-use plugins, always active
    ├── itw-content.php + itw-content/   Projects, Services, Team (content model)
    └── itw-login.php                    Private login address + styled login screen
```

WordPress core, `uploads/`, third-party plugins and backups are not in git (see `.gitignore`).
Content (pages, projects, posts, settings) lives in the database and moves between
environments with All-in-One WP Migration, not with git.

## Set up on a new environment

1. Install WordPress.
2. Clone this repository as `wp-content/`, or copy `themes/itw-corp/` and `mu-plugins/` into it.
3. Activate the **ITW Corp** theme.
4. Set the private login path in `wp-config.php`: `define( 'ITW_LOGIN_SLUG', 'your-private-path' );`
   (never commit the real path).

Theme details: [`themes/itw-corp/README.md`](themes/itw-corp/README.md).
