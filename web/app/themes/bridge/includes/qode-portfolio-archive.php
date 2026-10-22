<?php

if ( ! function_exists( 'bridge_qode_is_portfolio_archive' ) ) {
	/**
	 * Portfolio category/tag archives and the portfolio post type archive.
	 *
	 * @return bool
	 */
	function bridge_qode_is_portfolio_archive() {
		return is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) || is_post_type_archive( 'portfolio_page' );
	}
}

if ( ! function_exists( 'bridge_qode_get_portfolio_archive_option' ) ) {
	/**
	 * @param string $name
	 * @param mixed  $default
	 *
	 * @return mixed
	 */
	function bridge_qode_get_portfolio_archive_option( $name, $default = '' ) {
		$value = '';

		if ( function_exists( 'bridge_qode_options' ) ) {
			$value = bridge_qode_options()->getOptionValue( $name );
		}

		if ( $value === null || $value === '' ) {
			return $default;
		}

		return $value;
	}
}

if ( ! function_exists( 'bridge_qode_get_portfolio_archive_item_ids' ) ) {
	/**
	 * @return int[]
	 */
	function bridge_qode_get_portfolio_archive_item_ids() {
		if ( ! is_tax( 'portfolio_category' ) && ! is_tax( 'portfolio_tag' ) ) {
			return array();
		}

		$term = get_queried_object();

		if ( empty( $term ) || is_wp_error( $term ) || empty( $term->term_id ) ) {
			return array();
		}

		$ids = get_posts(
			array(
				'post_type'      => 'portfolio_page',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'tax_query'      => array(
					array(
						'taxonomy'         => $term->taxonomy,
						'field'            => 'term_id',
						'terms'            => (int) $term->term_id,
						'include_children' => true,
					),
				),
			)
		);

		if ( empty( $ids ) || is_wp_error( $ids ) ) {
			return array();
		}

		return array_map( 'intval', $ids );
	}
}

if ( ! function_exists( 'bridge_qode_get_portfolio_archive_list_html' ) ) {
	/**
	 * Render the same Portfolio List shortcode used on overview pages.
	 *
	 * @return string
	 */
	function bridge_qode_get_portfolio_archive_list_html() {
		if ( ! shortcode_exists( 'portfolio_list' ) ) {
			return '<p>' . esc_html__( 'Portfolio List shortcode is not available. Please make sure Bridge Core is active.', 'bridge' ) . '</p>';
		}

		$type    = bridge_qode_get_portfolio_archive_option( 'portfolio_archive_type', 'masonry_with_space' );
		$columns = bridge_qode_get_portfolio_archive_option( 'portfolio_archive_columns', '3' );
		$number  = bridge_qode_get_portfolio_archive_option( 'portfolio_archive_number', '-1' );
		$load    = bridge_qode_get_portfolio_archive_option( 'portfolio_archive_show_load_more', 'no' );
		$space   = bridge_qode_get_portfolio_archive_option( 'portfolio_archive_spacing', '' );

		$atts = array(
			'type'            => $type,
			'columns'         => $columns,
			'number'          => $number,
			'filter'          => 'no',
			'show_load_more'  => $load,
			'lightbox'        => 'yes',
			'view_button'     => 'yes',
			'show_title'      => 'yes',
			'show_categories' => 'yes',
		);

		if ( $space !== '' ) {
			$atts['spacing'] = $space;
		}

		if ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) {
			$ids = bridge_qode_get_portfolio_archive_item_ids();
			if ( empty( $ids ) ) {
				return '<p>' . esc_html__( 'No portfolio items were found.', 'bridge' ) . '</p>';
			}

			$atts['selected_projects'] = implode( ',', $ids );
		}

		$shortcode = '[portfolio_list';
		foreach ( $atts as $key => $value ) {
			$shortcode .= ' ' . sanitize_key( $key ) . '="' . esc_attr( $value ) . '"';
		}
		$shortcode .= ']';

		return do_shortcode( $shortcode );
	}
}

if ( ! function_exists( 'bridge_qode_enqueue_portfolio_archive_assets' ) ) {
	function bridge_qode_enqueue_portfolio_archive_assets() {
		if ( ! bridge_qode_is_portfolio_archive() ) {
			return;
		}

		wp_enqueue_script( 'mixItUp' );
		wp_enqueue_script( 'justifiedGallery' );
		wp_enqueue_script( 'qode-portfolio-list' );
	}

	add_action( 'wp_enqueue_scripts', 'bridge_qode_enqueue_portfolio_archive_assets', 20 );
}
