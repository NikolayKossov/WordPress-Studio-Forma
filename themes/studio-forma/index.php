<?php defined('ABSPATH') || exit; get_header(); ?>
<?php if (is_home() || is_archive() || is_search()) : ?><h1><?php echo esc_html(is_search() ? 'Wyniki: '.get_search_query() : 'Dziennik studia'); ?></h1><?php endif; ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article <?php post_class('entry'); ?>>
<?php if (is_singular()) : ?><h1><?php the_title(); ?></h1><?php the_content(); wp_link_pages(); ?>
<?php else : ?><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); endif; ?>
</article><?php endwhile; the_posts_pagination(); else : ?><h1>Nie znaleziono strony</h1><?php get_search_form(); endif; ?>
<?php get_footer(); ?>
