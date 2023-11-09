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
            <div class="step">
                <h4>Drag and drop your JSON here or write your code.</h4>
            </div>
            <div class="first-step">
                <div class="textarea-container">
                    <textarea id="json-input" placeholder="Drag and drop your JSON file here or write your code" class="json-textarea" ondrop="handleDrop(event)" ondragover="handleDragOver(event)"></textarea>
                </div>
                <div class="process-button-container">
                    <div class="select-container-1">
                        <h5>Formatting Style</h5>
                        <select id="format-select" class="button-panel">
                            <option value="0">Compact</option>
                            <option value="1">1 Space Tab</option>
                            <option value="2">2 Space Tab</option>
                            <option value="3">3 Space Tab</option>
                            <option value="4">4 Space Tab</option>
                        </select>
                    </div>
                    <div class="select-container-2">
                        <h5>Validation Type</h5>
                        <select id="validation-type" class="button-panel">
                            <option value="ecma-404">ECMA-404</option>
                            <option value="rfc-8259">RFC-8259</option>
                            <option value="rfc-7159">RFC-7159</option>
                            <option value="rfc-4627">RFC-4627</option>
                            <option value="skip-validation">Skip Validation</option>
                        </select>
                    </div>
                    <div class="select-container-3">
                        <h5>Press Process Button</h5>
                        <button class="button-panel" id="format-button">Process JSON</button>
                    </div>
                </div>
            </div>
            <div class="step">
                <h4>The Processed JSON Result.</h4>
            </div>
            <div class="first-step">
                <div class="textarea-container">
                    <textarea id="formatted-json" class="json-textarea"></textarea>
                </div>
                <div class="process-button-container">
                    <div class="select-container-1">
                        <h5>Download result</h5>
                        <button class="button-panel" id="download-button">Download</button>
                    </div>
                    <div class="select-container-3">
                        <h5>Copy result</h5>
                        <button class="button-panel" id="copy-button">Copy to Clipboard</button>
                    </div>
                    <div class="select-container-2">
                        <h5>Clear result</h5>
                        <button class="button-panel" id="clear-button">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="<?php echo plugin_dir_url(__FILE__) . 'js/json-formatter.js'; ?>"></script>
    <?php
    return ob_get_clean();
}
add_shortcode('jsonformatter', 'json_formatter_shortcode');
?>
