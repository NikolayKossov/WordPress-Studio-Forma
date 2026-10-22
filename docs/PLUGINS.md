# Plugin configuration exercise

Third-party plugins are optional and are not silently installed. Use Plugins → Add New, verify the publisher, compatibility and update date, then install in the local demo.

1. SEO: install Yoast SEO (`wordpress-seo`, publisher Team Yoast) OR another single SEO plugin. Complete basic site representation with demo data, set homepage title and description, review indexing and sitemap settings. Do not enable two SEO plugins together.
2. Contact form: install Contact Form 7 (`contact-form-7`, publisher Takayuki Miyoshi). Create fields for name, email and message with visible labels; place its shortcode on Kontakt. Configure the recipient and a sender at a domain you control before real delivery. SMTP configuration and actual test receipt are required before claiming email works. The delivered site only contains a demo email link.
3. On Studio Forma, the included Studio FAQ plugin is installed/activated by setup. Edit three questions in Settings → Studio FAQ. It uses WordPress capabilities, a nonce supplied by Settings API, sanitization and escaped output.

Record the actual version, purpose, settings changed, test result and date below after installation. Avoid adding unused plugins just to increase the count.

| Plugin | Version | Configuration | Evidence | Status |
|---|---|---|---|---|
| SEO plugin | — | Title, description, sitemap | — | Not installed |
| Contact Form 7 | — | Labels and mail configuration | — | Not installed |

Before production: back up the database and uploads, test updates in staging, check compatibility and repeat a form submission test. Never commit SMTP passwords or database exports.
