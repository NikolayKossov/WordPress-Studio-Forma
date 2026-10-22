<?php
// CLI-only import: repeat runs keep existing editorial changes.
if (!defined('WP_CLI') || !WP_CLI) { exit(1); }
$data = json_decode(file_get_contents('/portfolio/content/demo.json'), true, 512, JSON_THROW_ON_ERROR);
function portfolio_insert($item, $type) {
    $existing = get_page_by_path($item['slug'], OBJECT, $type);
    if ($existing) { return $existing->ID; }
    $id = wp_insert_post(['post_type'=>$type, 'post_status'=>'publish', 'post_title'=>$item['title'], 'post_name'=>$item['slug'], 'post_content'=>$item['content'], 'post_excerpt'=>$item['excerpt'] ?? ''], true);
    if (is_wp_error($id)) { WP_CLI::error($id->get_error_message()); }
    if (!empty($item['category'])) {
        $term = term_exists($item['category'], 'category');
        if (!$term) { $term = wp_insert_term($item['category'], 'category'); }
        if (is_wp_error($term)) { WP_CLI::error($term->get_error_message()); }
        wp_set_post_categories($id, [(int) $term['term_id']]);
    }
    return $id;
}
foreach ($data['pages'] as $item) { portfolio_insert($item, 'page'); }
foreach ($data['posts'] as $item) { portfolio_insert($item, 'post'); }
// Configure only once; later imports must not reset user settings.
if (!get_option('portfolio_seeded')) {
    update_option('blogname', $data['title']);
    update_option('blogdescription', 'Projekt demonstracyjny WordPress');
    update_option('show_on_front', 'page');
    update_option('page_on_front', get_page_by_path('start')->ID);
    update_option('page_for_posts', get_page_by_path('aktualnosci')->ID);
    update_option('blog_public', '0');
    update_option('default_comment_status', 'closed');
    $menu = wp_create_nav_menu('Menu główne');
    if (!is_wp_error($menu)) {
        foreach ($data['pages'] as $item) {
            wp_update_nav_menu_item($menu, 0, ['menu-item-title'=>$item['title'], 'menu-item-object'=>'page', 'menu-item-object-id'=>get_page_by_path($item['slug'])->ID, 'menu-item-type'=>'post_type', 'menu-item-status'=>'publish']);
        }
        set_theme_mod('nav_menu_locations', ['primary'=>$menu]);
    }
    update_option('portfolio_seeded', '1');
}
WP_CLI::success('Demo content imported; existing pages preserved.');
