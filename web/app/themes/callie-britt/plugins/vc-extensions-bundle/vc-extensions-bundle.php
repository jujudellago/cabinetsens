<?php
/* WPBakery PageBuilder Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('callie_britt_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'callie_britt_vc_extensions_theme_setup9', 9 );
	function callie_britt_vc_extensions_theme_setup9() {

		add_filter( 'callie_britt_filter_merge_styles',						'callie_britt_vc_extensions_merge_styles' );
	
		if (is_admin()) {
			add_filter( 'callie_britt_filter_tgmpa_required_plugins',		'callie_britt_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'callie_britt_vc_extensions_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('callie_britt_filter_tgmpa_required_plugins',	'callie_britt_vc_extensions_tgmpa_required_plugins');
	function callie_britt_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (callie_britt_storage_isset('required_plugins', 'vc-extensions-bundle')) {
			$path = callie_britt_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.zip');
			if (!empty($path) || callie_britt_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> callie_britt_storage_get_array('required_plugins', 'vc-extensions-bundle'),
					'slug' 		=> 'vc-extensions-bundle',
					'source'	=> !empty($path) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'callie_britt_exists_vc_extensions' ) ) {
	function callie_britt_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Merge custom styles
if ( !function_exists( 'callie_britt_vc_extensions_merge_styles' ) ) {
	//Handler of the add_filter('callie_britt_filter_merge_styles', 'callie_britt_vc_extensions_merge_styles');
	function callie_britt_vc_extensions_merge_styles($list) {
		if (callie_britt_exists_vc()) {
			$list[] = 'plugins/vc-extensions-bundle/_vc-extensions-bundle.scss';
		}
		return $list;
	}
}
?>