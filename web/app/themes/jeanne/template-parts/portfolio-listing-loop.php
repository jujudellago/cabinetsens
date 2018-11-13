<?php 
/**
 * This template part is for displaying portfolio items in the Loop
 * 
 * @since 1.0.0
 */
?>

<?php
	
	/**
	 * Note: Most the $_SESSION in this file is initiated in "portfolio-listing.php" and "taxonomy-portfolio.php" files.
	 *
	 */

	if ( has_post_thumbnail() ) {
		
		$image_size = 'jeanne-portfolio-grid';
		
		// If the template enables the full-width view
		if ( $_SESSION['template_full_width_enabled'] ) {
			
			$is_full_width = false;
			
			if ( function_exists( 'get_field' ) ) {
				
				$template_array = get_field( 'uxbarn_portfolio_enable_full_width_on_templates' );
				
				if ( isset( $template_array ) && ! empty( $template_array ) ) {
					
					// The session is initiated in "template-featured-works.php" and "template-all-works.php"
					$current_template = $_SESSION['current_portfolio_template'];
					
					if ( in_array( $current_template, $template_array ) ) {
						$is_full_width = true;
					}
					
				}
				
			}
			
			
			if ( $is_full_width ) {
				
				// If the .justified-images tag still opens, close it before printing out a new full-width block
				if ( $_SESSION['tag_previously_opened'] ) {
					
					echo '</div>';
					$_SESSION['tag_previously_opened'] = false;
					
				}
				
				echo '<div class="full-width portfolio-item-block clearfix">';
				$image_size = 'jeanne-large';
				
			} else {
				
				if ( ! $_SESSION['tag_previously_opened'] ) {
					
					echo '<div class="justified-images portfolio-item-block clearfix">';
					$_SESSION['tag_previously_opened'] = true;
					
				}
				
			}
			
		}
		
		
		// In case users want to use the full-size image (it will make the GIF animation work)
		$use_full_size = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_templates_use_full_size', false );
		if ( $use_full_size ) {
			$image_size = 'full';
		}
		
		
		$attachment = jeanne_get_attachment( get_post_thumbnail_id() );
		$width = $attachment['width'];
		$height = $attachment['height'];
		$image_orientation_class = 'landscape';
		
		// Portrait orientation photo
		if ( $height > 0 && $width/$height < 1 ) {
			$image_orientation_class = 'portrait';
		}
		
		
		
		echo '<article class="' . esc_attr( implode( ' ', array( 'portfolio-item', 'portfolio-item-' . get_the_ID() ) ) ) . '" data-w="' . intval( $width ) . '" data-h="' . intval( $height ) . '">';
		
		echo 	'<a href="' . esc_url( get_permalink() ) . '">';
		echo 		'<div class="' . esc_attr( implode( ' ', array( 'portfolio-featured-image', $image_orientation_class ) ) ) . '">';
		echo 			get_the_post_thumbnail( get_the_ID(), $image_size );
		
		echo 			'<div class="curtain"></div>';
		
		echo 		'</div>';
		echo 		'<div class="portfolio-title-wrapper"><h3 class="portfolio-title">' . esc_html( get_the_title() ) . '</h3></div>';
		echo 	'</a>';
		
		echo '</article><!-- item -->'; // .portfolio-item
		
		
		
		// If the template enables the full-width view
		if ( $_SESSION['template_full_width_enabled'] ) {
			
			// If it's full-width or last item, close the block
			if ( ( $is_full_width ) || 
				 $_SESSION['counter'] === $_SESSION['post_count'] ) {
				
				echo '</div><!-- full-width or last item close -->';
			}
			
			$_SESSION['counter'] += 1;
		
		}
		
	}
	
?>