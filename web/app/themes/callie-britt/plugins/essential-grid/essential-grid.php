<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('callie_britt_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'callie_britt_essential_grid_theme_setup9', 9 );
	function callie_britt_essential_grid_theme_setup9() {
		
		add_filter( 'callie_britt_filter_merge_styles',						'callie_britt_essential_grid_merge_styles' );

		if (is_admin()) {
			add_filter( 'callie_britt_filter_tgmpa_required_plugins',		'callie_britt_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'callie_britt_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('callie_britt_filter_tgmpa_required_plugins',	'callie_britt_essential_grid_tgmpa_required_plugins');
	function callie_britt_essential_grid_tgmpa_required_plugins($list=array()) {
		if (callie_britt_storage_isset('required_plugins', 'essential-grid')) {
			$path = callie_britt_get_file_dir('plugins/essential-grid/essential-grid.zip');
			if (!empty($path) || callie_britt_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
						'name' 		=> callie_britt_storage_get_array('required_plugins', 'essential-grid'),
						'slug' 		=> 'essential-grid',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'callie_britt_exists_essential_grid' ) ) {
	function callie_britt_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}
	
// Merge custom styles
if ( !function_exists( 'callie_britt_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('callie_britt_filter_merge_styles', 'callie_britt_essential_grid_merge_styles');
	function callie_britt_essential_grid_merge_styles($list) {
		if (callie_britt_exists_essential_grid()) {
			$list[] = 'plugins/essential-grid/_essential-grid.scss';
		}
		return $list;
	}
}
?>