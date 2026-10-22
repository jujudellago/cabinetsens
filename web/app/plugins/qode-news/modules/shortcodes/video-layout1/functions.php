<?php

if(!function_exists('qode_news_add_video_layout1_shortcodes')) {
	function qode_news_add_video_layout1_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'qodeNews\CPT\Shortcodes\VideoLayout1\VideoLayout1'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('qode_news_filter_add_vc_shortcode', 'qode_news_add_video_layout1_shortcodes');
}

if( ! function_exists( 'qode_news_include_video_layout1_shortcode_for_fitvids_script' ) ) {
	function qode_news_include_video_layout1_shortcode_for_fitvids_script( $shortcodes_to_check ) {
		$shortcodes_to_check[] = 'qode_video_layout1';
		
		return $shortcodes_to_check;
	}
	
	add_filter( 'bridge_qode_filter_shortcodes_to_check_for_fitvids_script', 'qode_news_include_video_layout1_shortcode_for_fitvids_script' );
}