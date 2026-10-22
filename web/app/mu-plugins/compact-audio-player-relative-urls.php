<?php
/*
Plugin Name:  Compact Audio Player relative URLs
Description:  Skip Compact WP Audio Player's fileurl check (since 1.9.15). It resolves relative URLs
              against site_url() (/wp on Bedrock) and makes a HEAD request on every render, so
              [sc_embed_player fileurl="/app/uploads/..."] failed. The browser resolves them fine.
Version:      1.0.0
License:      MIT License
*/

add_filter('sc_audio_disable_url_validation', function () {
    return '1';
});
