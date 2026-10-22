# Studio Forma

WordPress portfolio project / projekt demonstracyjny. Fictional brand; no commercial client claims.

**Focus:** Classic PHP theme, configurable FAQ plugin, accessible native details elements.

## Quick start (Windows PowerShell)

Install Docker Desktop with Linux containers and Docker Compose. An Internet connection is needed for images and the parent theme. Run inside this repository:

```powershell
Copy-Item .env.example .env
# Edit .env and replace the three sample passwords.
docker compose up -d wordpress
docker compose run --rm cli /portfolio/scripts/setup.sh
```

Open the `SITE_URL` from `.env`; append `/wp-admin/` for the editor. Credentials come from `.env`. Each project uses its own port and named volumes, so all three can run together. Allow a few minutes for the first download. Re-running setup preserves existing post content. Setup is intended for a fresh demo installation.

Stop: `docker compose down`. The database persists. Do not add `--volumes` unless you intend to delete the demo database.

## Without Docker

Use an existing local WordPress 6.7+ / PHP 8.1+ installation. Copy `themes/studio-forma` to `wp-content/themes/`. Activate the theme. Copy plugins/studio-faq to wp-content/plugins and activate it. Create pages from `content/demo.json` in the block editor's code view, then switch to visual view. Set Start as the static homepage and Aktualności as the posts page under Settings → Reading. For automated import use the Docker procedure; its scripts use container paths.

## Repository map

- `themes/`: installable WordPress theme sources.
- `content/demo.json`: Polish editorial fixtures, not a database dump.
- `scripts/`: repeatable seed and WordPress smoke checks.
- `docs/`: client brief, SEO, plugins, manual QA and Russian walkthrough.
- `.github/`: CI, issue and pull request templates.
- `plugins/studio-faq/`: Settings API plugin with an editable FAQ shortcode.

## Verification

```powershell
docker compose run --rm cli /portfolio/scripts/smoke.sh
```

GitHub Actions checks PHP syntax, boots WordPress, imports twice, tests content/plugin behavior and HTTP routes. Local delivery checks and limitations are recorded in `docs/QA.md`. Manual visual/editor checks remain necessary. Docker image tags track their maintained PHP/MariaDB branches; record resolved image digests for exact reproduction.

## Recruiter demo (3 minutes)

1. Show the homepage at desktop and mobile sizes.
2. Edit a heading in WordPress, save and show the live change.
3. Change an FAQ answer under Settings → Studio FAQ; show keyboard interaction.
4. Explain one SEO decision and show a client change ticket.

These files demonstrate implementation. Team collaboration, English fluency and client experience must be explained honestly; templates alone do not prove those skills.

## References

- [WordPress theme structure](https://developer.wordpress.org/themes/core-concepts/theme-structure/)
- [Child themes](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
- [Global settings](https://developer.wordpress.org/themes/global-settings-and-styles/)
- [WP-CLI](https://developer.wordpress.org/cli/commands/)

License: GPL-2.0-or-later; see LICENSE.md.
