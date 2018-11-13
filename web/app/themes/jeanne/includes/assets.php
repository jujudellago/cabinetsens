<?php
/**
 * Collection of the functions for loading JS and CSS in the theme
 *
 * @since 1.0.0
 */



/**
 * Load the CSS and JS resources of the theme
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_load_theme_assets' ) ) {
	
	function jeanne_load_theme_assets() {
		
		jeanne_load_theme_css();
		jeanne_load_theme_js();
		
	}
	
}



if ( ! function_exists( 'jeanne_load_theme_css' ) ) {
	
	function jeanne_load_theme_css() {
		
		// Enqueue all CSS
		if ( ! class_exists( 'Kirki' ) ) {
			wp_enqueue_style( 'google-fonts', jeanne_get_google_fonts_url(), array(), null );
		}
		wp_enqueue_style( 'font-awesome', jeanne_get_font_awesome_url(), array(), null );
		wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), null );
		wp_enqueue_style( 'jeanne-theme', get_template_directory_uri() . '/style.css', array(), jeanne_get_theme_version() );
		
	}
	
}



if ( ! function_exists( 'jeanne_load_theme_js' ) ) {
	
	function jeanne_load_theme_js() {
		
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-custom.js', array( 'jquery' ), null );
		wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-flex-images', get_template_directory_uri() . '/js/jquery.flex-images.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jeanne-theme', get_template_directory_uri() . '/js/jeanne.js', array( 'jquery', 'imagesloaded' ), jeanne_get_theme_version(), true );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		$params = array(
			'featured_works_grid_row_height'	=> intval( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_featured_works_grid_max_row_height', 450 ) ),
			
			'all_works_grid_row_height'			=> intval( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_all_works_grid_max_row_height', 450 ) ),
			
			'portfolio_single_grid_row_height'  => intval( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_single_grid_max_row_height', 450 ) ),
			
			'clear_text'						=> esc_html__( 'Clear', 'jeanne' ),
			'modal_search_input_text'			=> get_theme_mod( 'jeanne_ctmzr_settings_general_search_placeholder_text', esc_html__( 'Type and hit enter', 'jeanne' ) ),
			'show_search_button'				=> get_theme_mod( 'jeanne_ctmzr_settings_general_show_search_button', true ),
			'enable_lightbox_wp_gallery' 		=> get_theme_mod( 'jeanne_ctmzr_settings_general_enable_lightbox_wp_images', true ),
			'lightbox_error_text' 				=> esc_attr__( 'The requested content cannot be loaded. <br/> Please try again later.', 'jeanne' ),
			'lightbox_next_text' 				=> esc_attr__( 'Next', 'jeanne' ),
			'lightbox_prev_text' 				=> esc_attr__( 'Previous', 'jeanne' ),
			'lightbox_close_text' 				=> esc_attr__( 'Close', 'jeanne' ),
			'lightbox_start_slide_text' 		=> esc_attr__( 'Start slideshow', 'jeanne' ),
			'lightbox_pause_slide_text' 		=> esc_attr__( 'Pause slideshow', 'jeanne' ),
			'lightbox_fullscreen_text' 			=> esc_attr__( 'Full Screen', 'jeanne' ),
			'lightbox_thumbnails_text' 			=> esc_attr__( 'Thumbnails', 'jeanne' ),
			'lightbox_download_text' 			=> esc_attr__( 'Download', 'jeanne' ),
			'lightbox_share_text'	 			=> esc_attr__( 'Share', 'jeanne' ),
			'lightbox_zoom_text'	 			=> esc_attr__( 'Zoom', 'jeanne' ),
		);
		
		wp_localize_script( 'jeanne-theme', 'ThemeOptions', $params );
		
	}
	
}



/**
 * Load the styles for the Gutenberg editor to match the theme's
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_load_block_editor_styles' ) ) {
	
	function jeanne_load_block_editor_styles() {
		
		wp_enqueue_style( 'google-fonts', jeanne_get_google_fonts_url(), array(), null );
		wp_enqueue_style( 'jeanne-block-editor-styles', get_theme_file_uri( '/css/gutenberg-styles.css' ), false, '1.0', 'all' );
		
	}
	
}



/**
 * Modify the style tag of the Font Awesome call
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_modify_style_tag' ) ) {
	
	function jeanne_modify_style_tag( $link, $handle ) {
		
		if ( 'jeanne-font-awesome' === $handle ) {
			
			$integrity = get_theme_mod( 'jeanne_ctmzr_settings_general_font_awesome_cdn_integrity', 'sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' );
			
			$link = str_replace( '/>', 'integrity="' . esc_attr( $integrity ) . '" crossorigin="anonymous" />', $link );
		}

		return $link;
		
	}
	
}



/**
 * Get Font Awesome URL to be used in the theme
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_font_awesome_url' ) ) {

	function jeanne_get_font_awesome_url() {
		return get_theme_mod( 'jeanne_ctmzr_settings_general_font_awesome_cdn_url', '//use.fontawesome.com/releases/v5.3.1/css/all.css' );
	}

}



/**
 * Get Google Font URL to be used in the theme
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_google_fonts_url' ) ) {

	function jeanne_get_google_fonts_url() {
		
		$font_families = array();
		$font_families[] = JEANNE_DEFAULT_GOOGLE_FONTS;

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		
		return esc_url_raw( $fonts_url );
		
	}

}