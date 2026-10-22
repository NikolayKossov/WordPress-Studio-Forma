<?php
if (!defined('WP_CLI') || !WP_CLI) { exit(1); }
$data = json_decode(file_get_contents('/portfolio/content/demo.json'), true, 512, JSON_THROW_ON_ERROR);
if (get_stylesheet() !== $data['theme']) { WP_CLI::error('Wrong active theme'); }
foreach ($data['pages'] as $item) {
    $page = get_page_by_path($item['slug']);
    if (!$page || $page->post_status !== 'publish') { WP_CLI::error('Missing page: '.$item['slug']); }
    $blocks = parse_blocks($page->post_content);
    if ($item['content'] && !$blocks) { WP_CLI::error('Cannot parse blocks'); }
}
if ((int)get_option('page_on_front') !== get_page_by_path('start')->ID) { WP_CLI::error('Wrong homepage'); }
if (get_stylesheet() === 'studio-forma') {
    if (!shortcode_exists('studio_faq')) { WP_CLI::error('FAQ plugin inactive'); }
    $html = do_shortcode('[studio_faq]');
    if (substr_count($html, '<details>') !== 3 || strpos($html, '<summary>') === false) { WP_CLI::error('FAQ output invalid'); }
    $old = get_option('studio_faq_items', null);
    update_option('studio_faq_items', [['question'=>'<script>alert(1)</script>', 'answer'=>'<img src=x onerror=alert(1)>']]);
    $unsafe = do_shortcode('[studio_faq]');
    if ($old === null) { delete_option('studio_faq_items'); } else { update_option('studio_faq_items', $old); }
    if (strpos($unsafe, '<script>') !== false || strpos($unsafe, '<img') !== false) { WP_CLI::error('FAQ escaping failed'); }
}
WP_CLI::success('WordPress smoke tests passed.');
