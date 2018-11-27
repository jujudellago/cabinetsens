<?php
/**
 * Child-Theme functions and definitions
 */

function callie_britt_child_scripts() {
    wp_enqueue_style( 'callie-britt-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'cabinetsens_scripts' );
?>