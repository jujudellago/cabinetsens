<?php
/**
 * Custom template that overrides the default one of UXbarn Portfolio plugin
 *
 * @since 1.0.0
 */
 
 get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	
	<?php 
		
		$post_id = get_the_ID();
		$display_post_format_content = true;
		$post_format = get_post_meta( $post_id, 'uxbarn_portfolio_item_format', true );
		$portfolio_format_content = '';
		$no_portfolio_format_content_class = '';
		
		if ( 'image-slideshow' === $post_format ) {

			if ( function_exists( 'get_field' ) ) {
				$portfolio_format_content = get_field( 'uxbarn_portfolio_acf_image_slideshow' );
			}

		} else if ( 'video' === $post_format ) {
			$portfolio_format_content = get_post_meta( $post_id, 'uxbarn_portfolio_video_url', true );
		} else { // For mixed format

			if ( function_exists( 'get_field' ) ) {
				$portfolio_format_content = get_field( 'uxbarn_portfolio_acf_mixed_content' );
			}

		}
		
		
		// If the content is empty and password required, then hide the format section
		if ( empty( $portfolio_format_content ) || post_password_required() ) {
		
			$display_post_format_content = false;
			$no_portfolio_format_content_class = 'no-format-content';
				
		}
		
	?>
	
	<article class="portfolio-content-container <?php echo esc_attr( $no_portfolio_format_content_class ); ?>">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<div class="<?php echo esc_attr( implode( ' ', array( 'post-content-container clearfix' ) ) ); ?>">
					
				<div class="post-title-content-wrapper">
								
					<div class="post-title-wrapper">
						<h1 class="post-title"><?php the_title(); ?></h1>
					</div>
					
					<div class="post-content-wrapper">
						<div class="post-content clearfix">
							<?php
							
								the_content();
								jeanne_print_post_pagination();
								
							?>
								
						</div>
					</div>
					
				</div>
				<!-- .post-title-content-wrapper -->
			</div>
			<!-- .post-content-container -->
			
		</div>
		<!-- .post-item -->
	
		<?php if ( $display_post_format_content ) : ?>
			
			<div class="portfolio-format-content clearfix">
				
				<?php 
					
					if ( $display_post_format_content ) {
						jeanne_print_portfolio_loading();
					}
					
					// For Images format
					if ( 'image-slideshow' === $post_format ) {
						jeanne_print_portfolio_image_format_content( $portfolio_format_content );
					} else if ( 'video' === $post_format ) {
						
						$caption = '';
						if ( function_exists( 'get_field' ) ) {
							$caption = get_field( 'uxbarn_portfolio_video_caption' );
						}
						
						jeanne_print_portfolio_video_format_content( $portfolio_format_content, $caption );
						
					} else { // For Mixed format
						
						foreach( $portfolio_format_content as $content ) {
							
							if ( 'image-slideshow' === $content['uxbarn_portfolio_acf_mixed_content_type'] ) {
								
								$image_content = $content['uxbarn_portfolio_acf_mixed_content_image_slideshow'];
								if ( ! empty( $image_content ) ) {
									jeanne_print_portfolio_image_format_content( $image_content );
								}
								
							} else {
								
								$video_content = $content['uxbarn_portfolio_acf_mixed_content_video_url'];
								if ( ! empty( $video_content ) ) {
									
									$caption = $content['uxbarn_portfolio_acf_mixed_content_video_caption'];
									jeanne_print_portfolio_video_format_content( $video_content, $caption );
									
								}
								
							}
							
						}
						
					}
					
				?>
			</div>
			<!-- .post-format-wrapper -->
			
		<?php endif; // End if ( $display_post_format_content ) : ?>
				
		<?php
			
			// Related Work section
			if ( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_single_enable_related_category_links', true ) ) {
				jeanne_print_related_work_section();
			}
			
			
			
			// Comment Section
			if ( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_single_enable_comments', false ) ) {
				comments_template();
			}
			
		?>
			
	</article>
	
<?php endwhile; ?>

<?php get_footer(); ?>