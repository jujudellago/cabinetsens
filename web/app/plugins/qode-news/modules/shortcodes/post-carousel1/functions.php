<?php

if(!function_exists('qode_news_add_post_carousel1_shortcodes')) {
	function qode_news_add_post_carousel1_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'qodeNews\CPT\Shortcodes\PostCarousel1\PostCarousel1'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('qode_news_filter_add_vc_shortcode', 'qode_news_add_post_carousel1_shortcodes');
}

if( ! function_exists( 'qode_news_include_post_carousel1_shortcode_for_owl_carousel' ) ) {
	function qode_news_include_post_carousel1_shortcode_for_owl_carousel( $shortcodes_to_check ) {
		$shortcodes_to_check[] = 'qode_post_carousel1';
		
		return $shortcodes_to_check;
	}
	
	add_filter( 'bridge_qode_filter_owl_carousel_shortcodes', 'qode_news_include_post_carousel1_shortcode_for_owl_carousel' );
}
