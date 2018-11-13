<?php
/**
 * Register the customizer and all of its components
 *
 * @since 1.0.0
 */



/**
 * Customize the default sections from WP
 * 
 * @since 1.0.0
 */
add_action( 'customize_register', 'jeanne_modify_wp_customizer_sections' );

if ( ! function_exists( 'jeanne_modify_wp_customizer_sections' ) ) {

	function jeanne_modify_wp_customizer_sections( $wp_customize ) {
		
		/**
		 * Modify default sections
		 *
		 * @since 1.0.0
		 */
		
		// Remove the Colors section
		$wp_customize->remove_section( 'colors' );
		
		// Remove the Background Image section
		$wp_customize->remove_section( 'background_image' );
		
		// Move the Site Identity section to the top
		$wp_customize->get_section( 'title_tagline' )->priority = 0;
		
	}

}


		
/**
 * Build the theme customizer sections
 * Only run if the Kirki plugin is active
 *
 * @since 1.0.0
 */

// 20 = priority later than 11 that the UXBARN Portfolio plugin uses when registering cpt and tax
// It is required so the terms in portfolio options can be loaded properly
add_action( 'init', 'jeanne_init_customizer', 20 );

if ( ! function_exists( 'jeanne_init_customizer' ) ) {

	function jeanne_init_customizer() {
		
		if ( class_exists( 'Kirki' ) ) {
			
			// Include customizer functions
			require_once( get_template_directory() . '/includes/customizer/customizer-functions.php' );
			
			// Load variants and subsets
			jeanne_ctmzr_load_variants_and_subsets();
			
			// Add the theme configuration
			Kirki::add_config( 'uxbarn_jeanne', array(
				'capability'    => 'edit_theme_options',
				'option_type'   => 'theme_mod',
			) );
			
			/**
			 * Create panels, sections, and controls
			 */
			
			// Panels
			require_once( get_template_directory() . '/includes/customizer/panel-registration.php' );
			
			// Site Identity (Default WP Section)
			require_once( get_template_directory() . '/includes/customizer/section-site-identity.php' );
			
			// Typography: Main Fonts
			require_once( get_template_directory() . '/includes/customizer/section-typography-main-fonts.php' );
			// Typography: Header
			require_once( get_template_directory() . '/includes/customizer/section-typography-header.php' );
			// Typography: Content
			require_once( get_template_directory() . '/includes/customizer/section-typography-content.php' );
			// Typography: Footer
			require_once( get_template_directory() . '/includes/customizer/section-typography-footer.php' );
			// Typography: Portfolio
			require_once( get_template_directory() . '/includes/customizer/section-typography-portfolio.php' );
			
			// Colors: General
			require_once( get_template_directory() . '/includes/customizer/section-colors-general.php' );
			// Colors: Header
			require_once( get_template_directory() . '/includes/customizer/section-colors-header.php' );
			// Colors: Content
			require_once( get_template_directory() . '/includes/customizer/section-colors-content.php' );
			// Colors: Footer
			require_once( get_template_directory() . '/includes/customizer/section-colors-footer.php' );
			// Colors: Portfolio
			require_once( get_template_directory() . '/includes/customizer/section-colors-portfolio.php' );
			
			// Settings: General
			require_once( get_template_directory() . '/includes/customizer/section-settings-general.php' );
			// Settings: Blog
			require_once( get_template_directory() . '/includes/customizer/section-settings-blog.php' );
			// Settings: Page
			require_once( get_template_directory() . '/includes/customizer/section-settings-page.php' );
			// Settings: Portfolio
			require_once( get_template_directory() . '/includes/customizer/section-settings-portfolio.php' );
			
		}
		
	}

}
	


/**
 * Load the resources to be used on the customizer screen
 *
 * @since 1.0.0
 */
add_action( 'customize_controls_enqueue_scripts', 'jeanne_load_customizer_assets' );

if ( ! function_exists( 'jeanne_load_customizer_assets' ) ) {
	
	function jeanne_load_customizer_assets() {
		
		wp_enqueue_style( 'jeanne-customizer', get_template_directory_uri() . '/css/customizer.css', array(), null );
		
	}
	
}