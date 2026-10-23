<?php
/**
 * Plugin Name: Teerak Cabinetsens filesystem
 * Description: Use local filesystem access; operating-system permissions keep releases immutable.
 */
if (!defined('ABSPATH')) {
    return;
}
// WordPress's ownership heuristic selects FTP for deploy-owned releases. Runtime
// writes belong in uploads/private temp; direct access still obeys Unix permissions.
if (!defined('FS_METHOD')) {
    define('FS_METHOD', 'direct');
}

// The Bootstrap integration predates CF7's CSS spinner. Its removed loader GIF
// causes a stale request on every page, and dropping CF7's stylesheet hides the
// modern spinner/feedback styling. Keep Bootstrap's form layout and current CF7 UI.
add_action('wp_loaded', static function () {
    if (function_exists('cf7bs_inline_styles') && defined('WPCF7_PLUGIN_DIR')
        && !is_file(WPCF7_PLUGIN_DIR . '/images/ajax-loader.gif')) {
        remove_action('wp_head', 'cf7bs_inline_styles');
        add_action('wpcf7_enqueue_styles', static function () {
            wp_enqueue_style('contact-form-7');
        }, 20);
    }
});

// Cron runs only through the bounded systemd scheduler, independently of mail.
if (!defined('DISABLE_WP_CRON')) { define('DISABLE_WP_CRON', true); }
