<?php

// enqueue the child theme stylesheet

Function qode_child_theme_enqueue_scripts() {
	wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'qode_child_theme_enqueue_scripts', 11);

#
#function button_shortcode($atts) {
#    $atts = shortcode_atts( array(
#        'target' => '_blank',
#        'hover_type' => 'default',
#        'text' => '',
#        'link' => ''
#    ), $atts );
#
#    $output = '<a href="' . esc_url( $atts['link'] ) . '" target="' . esc_attr( $atts['target'] ) . '" class="mc-submit button-' . esc_attr( $atts['hover_type'] ) . '">' . esc_html( $atts['text'] ) . '</a>';
#
#    return $output;
#}
#add_shortcode( 'button', 'button_shortcode' );