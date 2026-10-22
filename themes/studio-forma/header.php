<?php defined('ABSPATH') || exit; ?>
<!doctype html><html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?><a class="skip-link" href="#main">Przejdź do treści</a>
<header class="site-header wrap"><div class="classic-top"><a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a><nav class="classic-nav" aria-label="Menu główne"><?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'fallback_cb'=>'wp_page_menu']); ?></nav></div></header>
<main id="main" class="wrap">
