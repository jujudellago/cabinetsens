<?php 
/**
 * This template part is for displaying portfolio items
 * 
 * @since 1.0.0
 */
?>



<div class="inner-portfolio-list clearfix">
	
	<?php
		
		$current_template = $_SESSION['current_portfolio_template'];
		$max_items = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_featured_works_number_of_items', 6 );
		
		// Default values to All Works Template
		$nopaging = false;
		$selected_terms = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_all_works_categories', array() );
		
		$query_values = jeanne_get_portfolio_all_works_template_values();
		$posts_per_page = $query_values['posts_per_page'];
		$orderby = $query_values['orderby'];
		$order = $query_values['order'];
		
		$active_term_id = jeanne_get_active_term_id();
	
		// If there's a specific query string here (for showing all items), the active term will be reset to "0"
		// so that all the items from every category are loaded.
		if ( isset( $_GET['all'] ) ) {
			$active_term_id = 0;
		}
		
		// If the active category is set, use it for querying the data later
		if ( 0 !== $active_term_id ) {
			$selected_terms = $active_term_id;
		}
		
		// If it's featured works template, then get the value from its options
		if ( 'featured-works' === $current_template ) {
			
			// No pagination on the featured-works template
			$nopaging = true;
			$selected_terms = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_featured_works_categories', array() );
			$orderby = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_featured_works_order_by', 'date' );
			$order = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_featured_works_order', 'DESC' );
			
		}
		
		
		// Create tax query array to be merged with WP_Query parameter array
		$tax_query_array = array();

		if ( ! empty( $selected_terms ) ) {

			$tax_query_array = array(
				'tax_query'		=> array( array(
					'taxonomy'	=> 'uxbarn_portfolio_tax',
					'terms'		=> $selected_terms,
					'operator' 	=> 'IN',
				) ),
			);

		}
			
		
		// Prepare the correct value for "paged"
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		if ( is_front_page() ) {
			$paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
		}
		
		// Prepare WP_Query parameter array
		$args = array_merge( array(
					'post_type'			=> 'uxbarn_portfolio',
					'nopaging'			=> $nopaging,
					'posts_per_page'	=> $posts_per_page,
					'paged'				=> $paged,
					'orderby'			=> $orderby,
					'order'				=> $order,
				), $tax_query_array );
		
		// Get posts
		$query = new WP_Query( $args );
		
		$item_counter = 1;

		// Pagination fix for custom query
		$temp_query = $wp_query;
		$wp_query   = NULL;
		$wp_query   = $query;
		
		// Start the custom Loop
		if ( $query->have_posts() ) {
			
			$active_post_count = $query->post_count;
			
			if ( 'featured-works' === $current_template ) {
				
				if ( $max_items < $query->post_count ) {
					$active_post_count = $max_items;
				}
				
			}
			
			// Initiate required sessions [custom-uxbarn-portfolio.php]
			jeanne_create_portfolio_sessions( $current_template, $active_post_count );
			
			while ( $query->have_posts() ) {
				$query->the_post();
				
				if ( 'all-works' === $current_template ) {
					get_template_part( 'template-parts/portfolio-listing-loop' );
				} else {
					
					if ( $item_counter <= $max_items ) {
						get_template_part( 'template-parts/portfolio-listing-loop' );
					}
					
				}
				
				$item_counter++;
				
			}
			
			
			// If the full-width view on the current template is disabled, simply close the "justified-images" div
			if ( ! $_SESSION['template_full_width_enabled'] ) {
				echo '</div><!-- no full-width div -->';
			}
			
		}
		
		// Restore original Post Data
		wp_reset_postdata();
		
	?>
	
</div>
<!-- .inner-portfolio-list -->

<?php
	
	// Include the post pagination
	get_template_part( 'template-parts/pagination' );

	// Reset main query object (part of pagination fix above)
	$wp_query = NULL;
	$wp_query = $temp_query;

?>