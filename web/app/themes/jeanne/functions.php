<?php
/**
 * The main file for setting up and initializing the theme
 *
 * @since 1.0.0
 */
 
 

/**
 * Set up the theme constant(s)
 *
 * @since 1.0.0
 */
define( 'JEANNE_THEME_ROOT_IMAGE_URL', get_template_directory_uri() . '/images/' );
define( 'JEANNE_DEFAULT_GOOGLE_FONTS', 'Roboto:400,400i,700,700i,900' );



/**
 * Include all the required asset files of the theme.
 *
 * @since 1.0.0
 */
require_once( get_template_directory() . '/includes/assets.php' );
require_once( get_template_directory() . '/includes/theme-functions.php' );
require_once( get_template_directory() . '/includes/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-init.php' );



/**
 * Initialize the theme.
 *
 * @since 1.0.0
 */
add_action( 'after_setup_theme', 'jeanne_init_theme' );

if ( ! function_exists( 'jeanne_init_theme' ) ) {
	
	function jeanne_init_theme() {
		
		// Register WP features
		if ( ! isset( $content_width ) ) {
			$content_width = 600;
		}
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'custom-background', array( 'default-color' => 'F5F7F8' ) );
		add_theme_support( 'align-wide' );
		
		/*
		 * This theme styles the visual editor on the backend to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-styles.css', jeanne_get_google_fonts_url(), jeanne_get_font_awesome_url() ) );
		add_action( 'enqueue_block_editor_assets', 'jeanne_load_block_editor_styles' );
		
		
		/*
		 * Register theme scripts and styles
		 * [assets.php]
		 */
		add_action( 'wp_enqueue_scripts', 'jeanne_load_theme_assets' );
		
		
		/*
		 * Register main WP modules
		 * [theme-functions.php]
		 */
		add_action( 'init', 'jeanne_register_menus' );
		add_action( 'widgets_init', 'jeanne_register_widget_areas' );
		
		
		
		/*
		 * Others
		 * [theme-functions.php]
		 */
		
		// Customize the menu classes
		add_filter( 'nav_menu_css_class', 'jeanne_customize_menu_item_classes', 10, 3 );
		
		// Modify the classes in WP post_class() for various locations
		add_filter( 'post_class', 'jeanne_modify_post_classes', 10, 3 );
		
		// Register theme's image sizes
		add_action( 'init', 'jeanne_register_theme_image_sizes' );
		
		// Modify page titles
		add_filter( 'the_title', 'jeanne_modify_page_titles' );
		
		// Adjust posts per page of the search template
		add_action( 'pre_get_posts', 'jeanne_adjust_search_posts_per_page' );
		
		// Register required and recommended plugins
		add_action( 'tgmpa_register', 'jeanne_register_additional_plugins' );
		
		// Create a wrapper to the video embed
		add_filter( 'embed_oembed_html', 'jeanne_create_video_embed_wrapper', 10, 4 );
		
		// Extend the WP default excerpt word length
		add_filter( 'excerpt_length', 'jeanne_extend_wp_excerpt_word_length', 999 );
		
		
		
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'jeanne', get_template_directory() . '/languages' );
		
	}
	
}



/**
 * PLUGIN CUSTOMIZATION
 */

/**
 * Customize the portfolio plugin
 *
 * @since 1.0.0
 */

/**
 * Deactivate the original version of the UXBARN Portfolio plugin if it's currently active 
 * to prevent any unexpected conflict with the Lite version that comes with the theme
 *
 * Note: The "uxb_port_load_shortcodes()" is only available in the original version
 */
if ( function_exists( 'uxb_port_load_shortcodes' ) ) {
	
	add_action( 'admin_init', 'jeanne_deactivate_plugins' );
	add_action( 'admin_notices', 'jeanne_show_plugin_deactivation_notice' );
	
}

if ( function_exists( 'uxb_port_lite_init_plugin' ) ) {
	
	require_once( get_template_directory() . '/includes/plugin-codes/custom-fields-portfolio.php' );
	require_once( get_template_directory() . '/includes/plugin-codes/custom-uxbarn-portfolio-lite.php' );
	
	// Load custom code for the plugin
	// [custom-uxbarn-portfolio-lite.php]
	add_action( 'init', 'jeanne_portfolio_custom' );
	
	// Register custom meta boxes and fields
	// [custom-fields-portfolio.php]
	
	// Custom fields for when any portfolio template is selected
	add_action( 'acf/init', 'jeanne_portfolio_cf_create_portfolio_template_settings' );
	
	// Custom fields for portfolio items
	add_action( 'acf/init', 'jeanne_portfolio_cf_create_portfolio_item_settings' );
	
	// Register custom fields to attachments
	add_action( 'acf/init', 'jeanne_custom_port_create_attachment_settings' );
	
}



/**
 * Customize some options of ACF via its filters and actions.
 *
 * @since 1.0.0
 */

if ( class_exists( 'ACF' ) ) {
	
	if ( ! function_exists( 'jeanne_customize_acf' ) ) {
		
		function jeanne_customize_acf() {
				
			// Disable ACF admin menu
			add_filter( 'acf/settings/show_admin', '__return_false' );
			
			// Disable update notification
			add_filter( 'acf/settings/show_updates', '__return_false' );
			
		}
		
	}
	
	jeanne_customize_acf();
	
}



/**
 * Customize some options of OptionTree via its filters and actions.
 *
 * @since 1.0.0
 */

if ( class_exists( 'OT_Loader' ) ) {
	
	if ( ! function_exists( 'jeanne_customize_optiontree' ) ) {
		
		function jeanne_customize_optiontree() {
						
			// Remove Settings page
			add_filter( 'ot_show_pages', '__return_false' );

			// Remove its default Theme Options menu
			add_filter( 'ot_use_theme_options', '__return_false' );
			
		}
		
	}
	
	jeanne_customize_optiontree();
	
}