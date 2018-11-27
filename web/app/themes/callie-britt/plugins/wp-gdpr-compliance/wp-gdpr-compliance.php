<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('callie_britt_gdpr_theme_setup9')) {
	add_action( 'after_setup_theme', 'callie_britt_gdpr_theme_setup9', 9 );
	function callie_britt_gdpr_theme_setup9() {
		if (is_admin()) {
			add_filter( 'callie_britt_filter_tgmpa_required_plugins',	'callie_britt_gdpr_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'callie_britt_gdpr_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('callie_britt_filter_tgmpa_required_plugins',	'callie_britt_gdpr_tgmpa_required_plugins');
	function callie_britt_gdpr_tgmpa_required_plugins($list=array()) {
		if (callie_britt_storage_isset('required_plugins', 'wp-gdpr-compliance')) {
            $list[] = array(
                'name' 		=> callie_britt_storage_get_array('required_plugins', 'wp-gdpr-compliance'),
                'slug' 		=> 'wp-gdpr-compliance',
                'required' 	=> false
            );
        }
        
		return $list;
	}
}

?>