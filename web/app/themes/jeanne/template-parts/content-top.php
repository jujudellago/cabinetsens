<?php
/**
 * This template part is for printing out the additional top section for archive and search templates
 * 
 * @since 1.0.0
 */
?>

<?php 
	
	$show_top_section = true;
	$show_text = true;
	$text = '';
	$portfolio_item_class = '';
	$top_section_style_class = 'archive-top-section-style';
	
	if ( is_archive() || is_search() ) {
	
		$title = get_the_archive_title();
		
		if ( is_category() ) {
			
			$text = category_description();
			
		} else if ( is_search() ) {
			
			$keywords = $_GET['s'];
			$all_searches = new WP_Query( 's=' . $keywords . '&showposts=-1' );
			$title = sprintf( esc_html__( 'Found %s results for "%s"', 'jeanne' ), $all_searches->post_count, $_GET['s'] );
			wp_reset_postdata();
			
			$top_section_style_class = 'search-top-section-style';
			
		}
		
		
		
		$portfolio_item_class = '';
		if ( is_tax( 'uxbarn_portfolio_tax' ) ) {
			
			$portfolio_item_class = 'portfolio-item';
			$text = term_description();
			
		}
		
	} else { // For other templates
		
		$active_term_id = jeanne_get_active_term_id();
		
		if ( is_page_template( 'template-portfolio.php' ) ) {
			
			if ( 0 !== $active_term_id ) {
						
				// Do not show this top section when there's a query string 'all' passed in
				// (The query string is used for telling the theme to show all portfolio items from all categories.)
				if ( isset( $_GET['all'] ) ) {
					
					$show_top_section = false;
					
				} else {
					
					$portfolio_item_class = 'portfolio-item';
					
					$term = get_term( $active_term_id );
					$title = $term->name;
					$text = $term->description;
					
				}
				
			} else {
				$show_top_section = false;
			}
			
		}
		
	}
	
?>

<?php if ( $show_top_section ) : ?>

	<div class="top-section post-item <?php echo esc_attr( implode( ' ', array( $portfolio_item_class, $top_section_style_class ) ) ); ?> clearfix">
		<div class="post-content-container clearfix">
			
			<div class="post-title-content-wrapper">
					
				<div class="post-title-wrapper">
					<?php if ( is_front_page() ) : ?>
						<h2 class="post-title"><?php echo jeanne_wp_kses_escape( $title ); ?></h2>
					<?php else : ?>
						<h1 class="post-title"><?php echo jeanne_wp_kses_escape( $title ); ?></h1>
					<?php endif; ?>
				</div>
				
				<?php if ( ( ! empty( $text ) || is_search() ) && $show_text ) : ?>
					<div class="post-content-wrapper">
						<div class="post-content">
							<?php
							
								echo jeanne_wp_kses_escape( $text );
								
								if ( is_search() ) {
									get_search_form();
								}
								
							?>
						</div>
					</div>
				<?php endif; ?>
				
			</div>
					
		</div>
	</div>

<?php endif; ?>