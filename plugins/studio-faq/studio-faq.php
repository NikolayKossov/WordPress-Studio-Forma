<?php
/**
 * Plugin Name: Studio FAQ
 * Description: Three editable, keyboard-accessible FAQ entries for a portfolio demo.
 * Version: 1.0.0
 * Requires at least: 6.7
 * Requires PHP: 8.1
 * License: GPL-2.0-or-later
 * Text Domain: studio-faq
 */
defined('ABSPATH') || exit;

function studio_faq_defaults() {
    return [
        ['question'=>'Co przygotować przed rozmową?', 'answer'=>'Cel strony, listę podstron i dostępne treści.'],
        ['question'=>'Czy można samodzielnie zmieniać teksty?', 'answer'=>'Tak. Treści stron edytuje się w panelu WordPress.'],
        ['question'=>'Czy to prawdziwa oferta?', 'answer'=>'Nie. To fikcyjna marka i demonstracyjny projekt do portfolio.'],
    ];
}
function studio_faq_sanitize($input) {
    if (!is_array($input)) { return studio_faq_defaults(); }
    $items = [];
    foreach (array_slice($input, 0, 3) as $row) {
        if (!is_array($row)) { continue; }
        $question = sanitize_text_field(is_scalar($row['question'] ?? null) ? (string)$row['question'] : '');
        $answer = sanitize_textarea_field(is_scalar($row['answer'] ?? null) ? (string)$row['answer'] : '');
        $items[] = ['question'=>$question, 'answer'=>$answer];
    }
    return $items;
}
add_action('admin_init', function () {
    register_setting('studio_faq', 'studio_faq_items', ['type'=>'array', 'sanitize_callback'=>'studio_faq_sanitize', 'default'=>studio_faq_defaults()]);
});
add_action('admin_menu', function () {
    add_options_page('Studio FAQ', 'Studio FAQ', 'manage_options', 'studio-faq', 'studio_faq_settings');
});
function studio_faq_settings() {
    if (!current_user_can('manage_options')) { return; }
    $items = get_option('studio_faq_items', studio_faq_defaults());
    echo '<div class="wrap"><h1>Studio FAQ</h1><p>Uzupełnij maksymalnie trzy pytania. Puste pary nie są wyświetlane.</p><form action="options.php" method="post">';
    settings_fields('studio_faq');
    for ($i=0; $i<3; $i++) {
        $row = $items[$i] ?? ['question'=>'', 'answer'=>''];
        echo '<p><label for="faq-q-'.esc_attr($i).'">Pytanie '.esc_html($i+1).'</label><br><input class="large-text" id="faq-q-'.esc_attr($i).'" name="studio_faq_items['.esc_attr($i).'][question]" value="'.esc_attr($row['question']).'"></p>';
        echo '<p><label for="faq-a-'.esc_attr($i).'">Odpowiedź '.esc_html($i+1).'</label><br><textarea class="large-text" rows="3" id="faq-a-'.esc_attr($i).'" name="studio_faq_items['.esc_attr($i).'][answer]">'.esc_textarea($row['answer']).'</textarea></p>';
    }
    submit_button();
    echo '</form></div>';
}
add_shortcode('studio_faq', function () {
    $html = '<div class="studio-faq">';
    foreach (get_option('studio_faq_items', studio_faq_defaults()) as $row) {
        if (empty($row['question']) || empty($row['answer'])) { continue; }
        $html .= '<details><summary>'.esc_html($row['question']).'</summary><p>'.nl2br(esc_html($row['answer'])).'</p></details>';
    }
    return $html.'</div>';
});
