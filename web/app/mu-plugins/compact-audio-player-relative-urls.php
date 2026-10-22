<?php
/*
Plugin Name:  Compact Audio Player relative URLs
Description:  Compact WP Audio Player 1.9.15 resolves relative fileurl values against site_url() (/wp on
              Bedrock), so [sc_embed_player fileurl="/app/uploads/..."] fails its check. Skip the check
              only for plain relative upload paths; anything else is still validated by the plugin.
Version:      1.1.0
License:      MIT License
*/

add_filter('pre_do_shortcode_tag', function ($output, $tag, $attr) {
    $skip = $tag === 'sc_embed_player'
        && isset($attr['fileurl'])
        && preg_match('#^/app/uploads/[A-Za-z0-9._/-]+\.(mp3|m4a|ogg|wav)$#', $attr['fileurl'])
        && strpos($attr['fileurl'], '..') === false;

    if ($skip) {
        add_filter('sc_audio_disable_url_validation', '__return_true');
    } else {
        remove_filter('sc_audio_disable_url_validation', '__return_true');
    }

    return $output;
}, 10, 3);
