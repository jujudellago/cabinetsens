<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

include( 'include/settings.php' );

if( get_option( 'otw_bm_delete_data' ) == 'yes' ){

	global $wp_filesystem;
	
	$credentials = request_filesystem_credentials( self_admin_url() );
	
	if( $credentials && WP_Filesystem( $credentials ) ){
		
		if( $wp_filesystem->exists( $otw_bm_skin_dir.'custom.css' ) ){
			$wp_filesystem->delete( $otw_bm_skin_dir.'custom.css' );
		}
	}
	
	//delete message settings
	delete_option( $otw_bm_plugin_id.'_dnms' );
	delete_option( 'otw_bm_has_custom_css' );
	
	//get all lists
	$otw_bm_lists = get_option( 'otw_bm_lists' );
	
	if( is_array( $otw_bm_lists ) && count( $otw_bm_lists ) && isset( $otw_bm_lists['otw-bm-list'] ) ){
		
		foreach( $otw_bm_lists['otw-bm-list'] as $o_list ){
			$otw_bm_css_file = $otw_bm_skin_dir.'otw-bm-list-'.$o_list['id'].'-custom.css';
			
			if( $wp_filesystem->exists( $otw_bm_css_file ) ){
				$wp_filesystem->delete( $otw_bm_css_file );
			}
		}
	}
	
	//clear lists
	delete_option( 'otw_bm_lists' );
}
?>