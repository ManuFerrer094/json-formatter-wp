<?php
// Enqueue scripts and styles
function load_json_formatter_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('json-formatter', plugin_dir_url(__FILE__) . 'assets/js/json-formatter.js', array('jquery'), '1.0', true);
    wp_enqueue_style('json-formatter-styles', plugin_dir_url(__FILE__) . 'assets/css/styles.css');
    wp_enqueue_script('jsonlint', 'https://cdnjs.cloudflare.com/ajax/libs/jsonlint/1.6.0/jsonlint.min.js', array('jquery'), '1.6.0', true);
}
add_action('wp_enqueue_scripts', 'load_json_formatter_scripts');

// Shortcode function
function json_formatter_shortcode() {
    ob_start();
    ?>
    <section class="json-formatter-section">
        <div class="container">
            <!-- Contenido HTML aquí -->
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('jsonformatter', 'json_formatter_shortcode');
?>