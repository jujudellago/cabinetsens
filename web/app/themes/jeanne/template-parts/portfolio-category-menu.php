<?php 
/**
 * This template part is for displaying portfolio category menu
 * It is used in the template-portfolio.php and taxonomy-portfolio.php
 * 
 * @since 1.0.0
 */
?>

<?php

	$show_category_menu = jeanne_is_portfolio_category_menu_displayed();
	
	$category_menu_class = '';
	if ( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_make_category_menu_fixed_position', true ) ) {
		$category_menu_class = 'fixed-position';
	}
	
?>

<?php if ( $show_category_menu ) : ?>

	<div class="portfolio-category-wrapper content-style <?php echo esc_attr( $category_menu_class ); ?>">

	<?php
		
		// Create portfolio categories
		$port_categories = get_terms( 'uxbarn_portfolio_tax', array( 'hide_empty'=>false, 'parent' => 0 ) );
		
		if ( ! empty( $port_categories ) && ! is_wp_error( $port_categories ) ) {
			
			echo '<ul class="portfolio-categories">';
			
			$active_term_id = jeanne_get_active_term_id();
			
			// If there's a specific query string here (for showing all items), the active term will be reset to "0"
			// so that all the items from every category are loaded.
			if ( isset( $_GET['all'] ) ) {
				$active_term_id = 0;
			}
			
			
			
			$display_link_named_all = jeanne_is_portfolio_all_menu_item_displayed();
			$query_string_all = false;
			
			if ( $display_link_named_all ) {
				
				// Create the "All" category menu
				$all_categories_text = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_category_menu_text_all', esc_html__( 'All Works', 'jeanne' ) );
				
				if ( isset( $_GET['all'] ) ) {
					$query_string_all = true;
				}
				
				// If it's the portfolio template and the active term is not set, then the "All" menu will be active.
				// Or, if there's a specific query string value, the "All" menu will also be active.
				if ( ( is_page_template( 'template-all-works.php' ) && 0 === $active_term_id ) || $query_string_all ) {
					
					echo '<li class="all-items active"><h2 class="active-portfolio-category-title">' . $all_categories_text . '</h2></li>';
					
				} else { // Otherwise, create a link for the All menu
					
					$query_string_all_value = array( 'all' => '' );
					if ( 0 === $active_term_id ) {
						$query_string_all_value = array();
					}
					
					// Find the page URL that is currently using the portfolio template
					$page_url = '#';
					
					$pages = get_pages( array(
								'meta_key' 		=> '_wp_page_template',
								'meta_value' 	=> 'template-all-works.php'
							));
					
					// Pick only the first page in array
					if ( ! empty( $pages ) ) {
						
						$page_url = add_query_arg( $query_string_all_value, get_permalink( $pages[0]->ID ) );
						
					}
					
					echo '<li class="all-items"><a href="' . esc_url( $page_url ) . '">' . $all_categories_text . '</a></li>';
					
				}
				
			}
			
			
			// Terms
			$selected_terms = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_all_works_categories', array() );
			
			// Create portfolio category menu
			foreach ( $port_categories as $term ) {
				
				if ( empty( $selected_terms ) || ( ! empty( $selected_terms ) && in_array( $term->term_id, $selected_terms ) ) ) {
						
					$category_link_text = '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '">' . esc_html( $term->name ) . '</a>';
					$active_class = '';
					$term_class = 'item-term-' . $term->term_id;
					$active_tag_start = '';
					$active_tag_end = '';
					
					$wpml_active_term_id = apply_filters( 'wpml_object_id', $active_term_id, 'uxbarn_portfolio_tax' );
					
					// If the term is the active term user selected AND there's no specific query string, then set the active status.
					// Or, on the taxonomy template, set the active status for the term that is as same as the one in the WP query.
					if ( ( is_page_template( 'template-all-works.php' ) && 
							( ( $term->term_id == $active_term_id || $term->term_id == $wpml_active_term_id ) && 
								( ! $query_string_all )
							)
						 ) ||
						 ( is_tax( 'uxbarn_portfolio_tax' ) && $term->term_id == get_queried_object()->term_id ) ) {
						
						$category_link_text = esc_html( $term->name );
						$active_class = 'active';
						$active_tag_start = '<span class="active-portfolio-category-title">';
						$active_tag_end = '</span>';
						
					}
					
					echo '<li class="' . esc_attr( implode( ' ', array( $active_class, $term_class ) ) ) . '">' . $active_tag_start . $category_link_text . $active_tag_end . '</li>';
					
				}
				
			}
			
			echo '</ul>'; // .portfolio-categories
				
		}
		
	?>

	</div>
	
<?php endif; ?>