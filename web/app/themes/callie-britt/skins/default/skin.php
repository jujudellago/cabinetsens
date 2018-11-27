<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Setup skin-dependent fonts and colors, load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.46
 */


// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('callie_britt_skin_theme_setup3')) {
	add_action( 'after_setup_theme', 'callie_britt_skin_theme_setup3', 3 );
	function callie_britt_skin_theme_setup3() {
		// ToDo: Add / Modify theme options, required plugins, etc.
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'callie_britt_skin_tgmpa_required_plugins' ) ) {
	add_filter('callie_britt_filter_tgmpa_required_plugins',	'callie_britt_skin_tgmpa_required_plugins');
	function callie_britt_skin_tgmpa_required_plugins($list=array()) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if (callie_britt_storage_isset('required_plugins', 'skin-specific-plugin-slug')) {
			$list[] = array(
					'name' 		=> callie_britt_storage_get_array('required_plugins', 'skin-specific-plugin-slug'),
					'slug' 		=> 'skin-specific-plugin-slug',
					'required' 	=> false
				);
		}
		return $list;
	}
}

// Enqueue skin-specific styles and scripts
if ( !function_exists( 'callie_britt_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'callie_britt_skin_frontend_scripts', 1100 );
	function callie_britt_skin_frontend_scripts() {
		if (callie_britt_is_on(callie_britt_get_theme_option('debug_mode')) && ($callie_britt_url = callie_britt_get_file_url(CALLIE_BRITT_SKIN_DIR . 'skin.js')) != '')
			wp_enqueue_script( 'callie-britt-skin-' . esc_attr(CALLIE_BRITT_SKIN_NAME), $callie_britt_url, array('jquery'), null, true );
	}
}
	
// Merge custom styles
if ( !function_exists( 'callie_britt_skin_merge_styles' ) ) {
	add_filter('callie_britt_filter_merge_styles', 'callie_britt_skin_merge_styles');
	function callie_britt_skin_merge_styles($list) {
		if (callie_britt_get_file_dir(CALLIE_BRITT_SKIN_DIR . '_skin.scss') != '')
			$list[] = CALLIE_BRITT_SKIN_DIR . '_skin.scss';
		return $list;
	}
}


// Merge responsive styles
if ( !function_exists( 'callie_britt_skin_merge_styles_responsive' ) ) {
	add_filter('callie_britt_filter_merge_styles_responsive', 'callie_britt_skin_merge_styles_responsive');
	function callie_britt_skin_merge_styles_responsive($list) {
		if (callie_britt_get_file_dir(CALLIE_BRITT_SKIN_DIR . '_skin-responsive.scss') != '')
			$list[] = CALLIE_BRITT_SKIN_DIR . '_skin-responsive.scss';
		return $list;
	}
}

// Merge custom scripts
if ( !function_exists( 'callie_britt_skin_merge_scripts' ) ) {
	add_filter('callie_britt_filter_merge_scripts', 'callie_britt_skin_merge_scripts');
	function callie_britt_skin_merge_scripts($list) {
		if (callie_britt_get_file_dir(CALLIE_BRITT_SKIN_DIR . 'skin.js') != '')
			$list[] = CALLIE_BRITT_SKIN_DIR . 'skin.js';
		return $list;
	}
}


// Add slin-specific colors and fonts to the custom CSS
require_once CALLIE_BRITT_THEME_DIR . CALLIE_BRITT_SKIN_DIR . 'skin-styles.php';
?>