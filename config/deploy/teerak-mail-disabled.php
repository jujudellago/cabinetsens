<?php
/** Plugin Name: Teerak mail disabled
 * Description: Reports unavailable mail honestly until a delivery service is configured.
 */
if (!defined('ABSPATH')) { return; }
if (is_file('/var/www/cabinetsens/shared/.mail-disabled')) {
    add_filter('pre_wp_mail', static function ($result, $attributes) {
        static $blocked_count = 0;
        ++$blocked_count;
        error_log('[teerak-mail-disabled] blocked_count=' . $blocked_count);
        return false;
    }, PHP_INT_MAX, 2);
}
