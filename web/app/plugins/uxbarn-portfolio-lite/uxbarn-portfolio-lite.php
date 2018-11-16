<?php

/**
 * Plugin Name: UXBARN Portfolio Lite
 * Plugin URI: https://uxbarn.com
 * Description: A plugin that allows you to create portfolio items. This 'Lite' version includes only custom post type/taxonomy registration and core template files.
 * Version: 1.0.0
 * Author: UXBARN
 * Author URI: https://uxbarn.com
 * License: GPL, ThemeForest Licenses
*/



// If the original UXBARN Portfolio plugin is active, do not run this Lite version
if ( ! is_plugin_active( 'uxbarn-portfolio/uxbarn-portfolio.php' ) ) {

	/**
	 * Set up plugin constants
	 *
	 * @since 1.0.0
	 */
	define( 'UXB_PORT_LITE_PATH', plugin_dir_path( __FILE__ ) );
	define( 'UXB_PORT_LITE_URL', plugins_url( '', __FILE__ ) . '/' );



	/**
	 * Include all the required asset files
	 *
	 * @since 1.0.0
	 */
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	require_once( UXB_PORT_LITE_PATH . 'includes/plugin-functions.php' );



	/**
	 * Initialize the plugin
	 *
	 * @since 1.0.0
	 */
	add_action( 'plugins_loaded', 'uxb_port_lite_init_plugin' );
	
	// This "uxb_port_lite_init_plugin()" function is mainly for older themes compatibility
	// Most older themes detect the "uxb_port_init_plugin()" function so it must not be removed
	if ( ! function_exists( 'uxb_port_lite_init_plugin' ) ) {

		function uxb_port_lite_init_plugin() {
			uxb_port_init_plugin();
		}
		
	}
	
	if ( ! function_exists( 'uxb_port_init_plugin' ) ) {

		function uxb_port_init_plugin() {
			
			// Register post type and taxonomy
			add_action( 'init', 'uxb_port_register_cpt', 11 );
			
			// Create custom columns
			add_filter( 'manage_uxbarn_portfolio_posts_columns', 'uxb_port_create_columns_header' );
			add_action( 'manage_uxbarn_portfolio_posts_custom_column', 'uxb_port_create_columns_content' );
			
			// Add custom function to the "template_include" filter hook to load the plugin templates for single and archive pages
			add_filter( 'template_include', 'uxb_port_template_chooser' );
			
			// Load available text domains for localization of the plugin
			load_plugin_textdomain( 'uxb_port', false, basename( dirname( __FILE__ ) ) . '/languages' );
			
		}
		
	}
	
}