<?php
/**
 * Functions used by the customizer
 *
 * @since 1.0.0
 */



/**
 * Return portfolio categories
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_ctmzr_get_portfolio_categories' ) ) {

	function jeanne_ctmzr_get_portfolio_categories() {

		$terms = Kirki_Helper::get_terms( array( 'taxonomy' => 'uxbarn_portfolio_tax', 'hide_empty' => false, 'parent' => 0, 'orderby' => 'name', 'order' => 'ASC' ) );

		return $terms;

	}

}




if ( ! function_exists( 'jeanne_ctmzr_get_default_active_portfolio_category' ) ) {

	function jeanne_ctmzr_get_default_active_portfolio_category() {
		
		$terms = jeanne_ctmzr_get_portfolio_categories_for_active_setting();

		// Return the key value of the first item in the array
		return key( $terms );
		
	}

}



if ( ! function_exists( 'jeanne_ctmzr_get_portfolio_categories_for_active_setting' ) ) {

	function jeanne_ctmzr_get_portfolio_categories_for_active_setting() {
		
		$terms = jeanne_ctmzr_get_portfolio_categories();
		$first[0] = esc_attr__( 'Not set', 'jeanne' );
		$terms = $first + $terms;

		return $terms;
		
	}

}



/**
 * Sanitize any input text using the theme function
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_ctmzr_sanitize_with_theme_wpkes' ) ) {

	function jeanne_ctmzr_sanitize_with_theme_wpkes( $input ) {
		return jeanne_wp_kses_escape( $input );
	}

}



/**
 * Font weight list
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_ctmzr_get_font_weight_list' ) ) {

	function jeanne_ctmzr_get_font_weight_list() {
		return array(
					'100'  => '100',
					'200'  => '200',
					'300'  => '300',
					'400'  => '400',
					'500'  => '500',
					'600'  => '600',
					'700'  => '700',
					'800'  => '800',
					'900'  => '900',
					'inherit' => 'inherit',
				);
	}

}



/**
 * Font style list
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_ctmzr_get_font_style_list' ) ) {

	function jeanne_ctmzr_get_font_style_list() {
		return array(
					'none'		=> esc_attr__( 'Normal', 'jeanne' ),
					'uppercase' => esc_attr__( 'Uppercase', 'jeanne' ),
					'lowercase' => esc_attr__( 'Lowercase', 'jeanne' ),
				);
	}

}



/**
 * Italic list
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_ctmzr_get_font_italic_list' ) ) {

	function jeanne_ctmzr_get_font_italic_list() {
		return array(
					'normal' => esc_attr__( 'Normal', 'jeanne' ),
					'italic' => esc_attr__( 'Italic', 'jeanne' ),
				);
	}

}



/**
 * Order by list
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_ctmzr_get_order_by_list' ) ) {

	function jeanne_ctmzr_get_order_by_list() {
		return array(
					'ID'  		=> esc_attr__( 'ID', 'jeanne' ),
					'title'  	=> esc_attr__( 'Title', 'jeanne' ),
					'name'  	=> esc_attr__( 'Slug', 'jeanne' ),
					'date'  	=> esc_attr__( 'Published Date', 'jeanne' ),
					'modified'  => esc_attr__( 'Modified Date', 'jeanne' ),
					'rand'  	=> esc_attr__( 'Random', 'jeanne' ),
				);
	}

}



/**
 * Order list
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_ctmzr_get_order_list' ) ) {

	function jeanne_ctmzr_get_order_list() {
		return array(
					'ASC'  		=> esc_attr__( 'Ascending', 'jeanne' ),
					'DESC'  	=> esc_attr__( 'Descending', 'jeanne' ),
				);
	}

}
	


/**
 * Force loading all variants and subsets for Google Fonts
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_ctmzr_load_variants_and_subsets' ) ) {

	function jeanne_ctmzr_load_variants_and_subsets() {
		
		if ( class_exists( 'Kirki_Fonts_Google' ) ) {
			
			Kirki_Fonts_Google::$force_load_all_variants = true;
			Kirki_Fonts_Google::$force_load_all_subsets = false;
			
		}
		
	}

}