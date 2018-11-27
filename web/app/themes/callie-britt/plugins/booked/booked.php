<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('callie_britt_booked_theme_setup9')) {
	add_action( 'after_setup_theme', 'callie_britt_booked_theme_setup9', 9 );
	function callie_britt_booked_theme_setup9() {
		add_filter( 'callie_britt_filter_merge_styles', 						'callie_britt_booked_merge_styles' );
		if (is_admin()) {
			add_filter( 'callie_britt_filter_tgmpa_required_plugins',	'callie_britt_booked_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'callie_britt_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('callie_britt_filter_tgmpa_required_plugins',	'callie_britt_booked_tgmpa_required_plugins');
	function callie_britt_booked_tgmpa_required_plugins($list=array()) {
		if (callie_britt_storage_isset('required_plugins', 'booked')) {
			$path = callie_britt_get_file_dir('plugins/booked/booked.zip');
			if (!empty($path) || callie_britt_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> callie_britt_storage_get_array('required_plugins', 'booked'),
					'slug' 		=> 'booked',
					'source' 	=> !empty($path) ? $path : 'upload://booked.zip',
					'required' 	=> false
				);
			}
			$path = callie_britt_get_file_dir('plugins/booked/booked-calendar-feeds.zip');
			if (!empty($path) || callie_britt_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> esc_html__('Booked Calendar Feeds', 'callie-britt'),
					'slug' 		=> 'booked-calendar-feeds',
					'source' 	=> !empty($path) ? $path : 'upload://booked-calendar-feeds.zip',
					'required' 	=> false
				);
			}
			$path = callie_britt_get_file_dir('plugins/booked/booked-frontend-agents.zip');
			if (!empty($path) || callie_britt_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> esc_html__('Booked Front-End Agents', 'callie-britt'),
					'slug' 		=> 'booked-frontend-agents',
					'source' 	=> !empty($path) ? $path : 'upload://booked-frontend-agents.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}


// Check if plugin installed and activated
if ( !function_exists( 'callie_britt_exists_booked' ) ) {
	function callie_britt_exists_booked() {
		return class_exists('booked_plugin');
	}
}
	
// Merge custom styles
if ( !function_exists( 'callie_britt_booked_merge_styles' ) ) {
	//Handler of the add_filter('callie_britt_filter_merge_styles', 'callie_britt_booked_merge_styles');
	function callie_britt_booked_merge_styles($list) {
		if (callie_britt_exists_booked()) {
			$list[] = 'plugins/booked/_booked.scss';
		}
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (callie_britt_exists_booked()) { require_once CALLIE_BRITT_THEME_DIR . 'plugins/booked/booked-styles.php'; }
?>