<?php
$args = array(
	'custom_class' => '',
);
extract(shortcode_atts($args, $atts));
$html = "";
$classes = array(
	'qode_content_slider_item'
);

if ( ! empty( $custom_class ) ) {
	$classes[] = $custom_class;
}

$html .= '<div class="' . implode(' ', $classes) . '">';
$html .= do_shortcode($content);
$html .= '</div>';

echo bridge_qode_get_module_part( $html );

