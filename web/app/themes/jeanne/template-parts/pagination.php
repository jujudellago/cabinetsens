<?php
/**
 * The template part for displaying the post pagination
 * This is mainly used in index.php, archive.php, search.php
 *
 * @since 1.0.0
 */



$type = get_theme_mod( 'jeanne_ctmzr_content_styles_blog_navigation_type', 'numbers' );
if ( is_search() ) {
	$type = 'numbers';
}

if ( 'numbers' === $type ) {
		
	// Page numbers pagination
	$pagination_output = get_the_posts_pagination( array(
							'mid_size'	=> 2,
							'prev_text' => '<i class="fas fa-caret-left"></i><span class="screen-reader-text">' . esc_html__( 'Previous', 'jeanne' ) . '</span>',
							'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'jeanne' ) . '</span><i class="fas fa-caret-right"></i>',
						) );

	if ( ! empty( $pagination_output ) ) {
		echo '<div class="numbers-pagination">' . $pagination_output . '</div>';
	}
	
} else {
	
	$next_posts_link = get_next_posts_link();
	$previous_posts_link = get_previous_posts_link();
	
	if ( ! empty( $next_posts_link ) || ! empty( $previous_posts_link ) ) {
			
		// Next/Prev pagination
		echo '<div class="next-prev-pagination">';
		
		if ( $next_posts_link ) {
				
			echo '<div class="next-posts">';
			next_posts_link( esc_html__( 'Older Posts', 'jeanne' ) . '<i class="fas fa-caret-right"></i>' );
			echo '</div>';
		
		}
		
		if ( $previous_posts_link ) {
				
			echo '<div class="prev-posts">';
			previous_posts_link( '<i class="fas fa-caret-left"></i>' . esc_html__( 'Newer Posts', 'jeanne' ) );
			echo '</div>';
			
		}
		
		echo '</div>';
		
	}
	
}