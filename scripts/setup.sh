#!/bin/sh
set -eu
attempt=0
until [ -f wp-config.php ] && [ -f wp-includes/version.php ]; do
  attempt=$((attempt + 1))
  [ "$attempt" -lt 60 ] || { echo "WordPress files not ready. Start wordpress service first."; exit 1; }
  sleep 2
done
if ! wp core is-installed; then
  wp core install --url="$SITE_URL" --title="Portfolio demo" --admin_user="$WP_ADMIN_USER" --admin_password="$WP_ADMIN_PASSWORD" --admin_email="$WP_ADMIN_EMAIL" --skip-email
fi

wp theme activate studio-forma
wp plugin activate studio-faq
wp eval-file /portfolio/scripts/seed.php
wp rewrite structure '/%postname%/' --hard
wp eval-file /portfolio/scripts/smoke.php
