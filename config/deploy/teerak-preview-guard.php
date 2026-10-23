<?php
/**
 * Plugin Name: Cabinetsens private preview guard
 * Description: Suppress delivery, external HTTP, indexing and cron during preview.
 * Install as web/app/mu-plugins/000-cabinetsens-preview-guard.php before first bootstrap.
 */

if (!defined('ABSPATH') || !is_file('/var/www/cabinetsens/shared/.preview-mode')) {
    return;
}

if (!defined('DISABLE_WP_CRON')) {
    define('DISABLE_WP_CRON', true);
}

// Explicit wp-cron.php requests can run despite DISABLE_WP_CRON. Stop their
// bootstrap before normal plugins and scheduled callbacks are loaded.
if (defined('DOING_CRON') && DOING_CRON) {
    error_log('[cabinetsens-preview] {"event":"cron_blocked"}');
    if (PHP_SAPI !== 'cli' && !headers_sent()) {
        http_response_code(503);
        header('X-Robots-Tag: noindex, nofollow, noarchive');
    }
    exit(1);
}

add_filter('pre_wp_mail', static function ($previous, $attributes) {
    $attributes = is_array($attributes) ? $attributes : [];
    $to = $attributes['to'] ?? [];
    $attachments = $attributes['attachments'] ?? [];
    // Counts only: never log addresses, subject, body, headers, attachment names,
    // request URLs, IP addresses, user identifiers, cookies or tokens.
    $metadata = [
        'event' => 'mail_suppressed',
        'to_entries' => is_array($to) ? count($to) : (int)($to !== ''),
        'attachment_entries' => is_array($attachments) ? count($attachments) : (int)($attachments !== ''),
        'cli' => PHP_SAPI === 'cli',
    ];
    error_log('[cabinetsens-preview] ' . json_encode($metadata, JSON_UNESCAPED_SLASHES));
    // Simulate successful delivery so the local form-success path can be tested.
    // This deliberately does not assert that an actual message was delivered.
    return true;
}, PHP_INT_MAX, 2);

$cabinetsensPreviewLocalUrl = static function ($url): bool {
    $parts = wp_parse_url($url);
    if (!is_array($parts) || isset($parts['user']) || isset($parts['pass'])) {
        return false;
    }
    $scheme = strtolower($parts['scheme'] ?? '');
    $host = strtolower($parts['host'] ?? '');
    if (!in_array($host, ['cabinetsens.ch', 'www.cabinetsens.ch'], true)
        || !in_array($scheme, ['http', 'https'], true)) {
        return false;
    }
    $expectedPort = $scheme === 'https' ? 443 : 80;
    if ((int)($parts['port'] ?? $expectedPort) !== $expectedPort) {
        return false;
    }
    if (str_ends_with(rawurldecode($parts['path'] ?? ''), '/wp-cron.php')) {
        return false;
    }
    // The target's /etc/hosts must pin both names to loopback before preview.
    // Reject a same-host URL while its A record still resolves to shatzi.
    static $addresses = [];
    if (!array_key_exists($host, $addresses)) {
        $addresses[$host] = @gethostbynamel($host);
    }
    return is_array($addresses[$host]) && $addresses[$host] !== []
        && array_diff($addresses[$host], ['127.0.0.1']) === [];
};

add_filter('http_request_args', static function ($arguments) {
    // Redirects happen inside the HTTP transport and may bypass pre_http_request.
    // Returning a local 3xx to the caller is safer than following it externally.
    $arguments['redirection'] = 0;
    return $arguments;
}, PHP_INT_MAX, 1);

add_filter('pre_http_request', static function ($previous, $arguments, $url) use ($cabinetsensPreviewLocalUrl) {
    if ($cabinetsensPreviewLocalUrl($url)) {
        return $previous;
    }
    error_log('[cabinetsens-preview] {"event":"http_request_blocked"}');
    return new WP_Error('cabinetsens_preview_http_blocked', 'External HTTP and cron requests are disabled during private preview.');
}, PHP_INT_MAX, 3);

add_filter('pre_option_blog_public', static function () {
    return 0;
}, PHP_INT_MAX);

add_filter('wp_robots', static function ($robots) {
    $robots = is_array($robots) ? $robots : [];
    unset($robots['index'], $robots['follow']);
    $robots['noindex'] = true;
    $robots['nofollow'] = true;
    $robots['noarchive'] = true;
    return $robots;
}, PHP_INT_MAX);

add_filter('robots_txt', static function () {
    return "User-agent: *\nDisallow: /\n";
}, PHP_INT_MAX);

add_action('send_headers', static function () {
    if (!headers_sent()) {
        header('X-Robots-Tag: noindex, nofollow, noarchive', true);
    }
}, PHP_INT_MAX);
