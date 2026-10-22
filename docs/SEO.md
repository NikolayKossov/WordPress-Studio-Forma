# SEO checklist — Studio Forma

Demo starts with search indexing discouraged (`blog_public=0`). Keep that setting for local/staging environments. Enable indexing only when a real public site is ready; noindex is not an access control mechanism.

- Suggested homepage title: `Studio Forma — strony dla małych firm`.
- Suggested description: `Demonstracyjna pracownia projektowania stron dla małych firm. Od krótkiego briefu do przekazania gotowej strony.` Rewrite the demo wording before a real launch.
- Use one meaningful H1, descriptive H2 sections and descriptive link labels.
- Permalinks use `/%postname%/`. Check internal links after slug changes; add a deliberate redirect for published URLs.
- Set title/description per page in ONE SEO plugin. Theme does not duplicate its metadata.
- Check the rendered source for title, description, canonical and robots values. Check the sitemap URL reported by the selected SEO plugin; core normally uses `/wp-sitemap.xml` when indexing is enabled.
- Supply real alt text when adding content photos; use empty alt for purely decorative images. Resize before upload; avoid enormous backgrounds.
- Test mobile layout and run Lighthouse after deployment. Record measured values, date and URL; no performance scores have been fabricated.
- Verify 404, search and category archive behavior. Avoid keyword stuffing and invented reviews or business schema.

## Evidence to collect

Before/after metadata screenshot, page-source snippet, mobile screenshot, actual Lighthouse report, and the URL of one checked sitemap. Status: pending runtime setup.
