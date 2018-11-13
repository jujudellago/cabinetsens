<?php
/**
 * This is the main template file for listing blog posts
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0.0
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>
	
		<?php
			
			// If it's the search result page, display the top section here
			if ( is_search() ) {
				get_template_part( 'template-parts/content-top' );
			}
			
			$list_class = jeanne_get_post_list_class();
			
		?>
		
		<div class="<?php echo esc_attr( implode( ' ', array( $list_class, 'list-wrapper' ) ) ); ?> clearfix">
			
			<?php 
			
				// If it's the archive page, display the top section here
				if ( is_archive() ) {
					get_template_part( 'template-parts/content-top' );
				}
			
			?>
			
			<?php while ( have_posts() ) : the_post(); // Start the Loop ?>
					
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<?php if ( ! is_search() ) : // Do not display the date on the search result page ?>
							
						<div class="post-date-wrapper">
							<a href="<?php the_permalink(); ?>">
								<time class="published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" title="<?php echo get_the_time( 'F j, Y' ); ?>"><?php echo get_the_time( get_option( 'date_format' ) ); ?></time>
							</a>
						</div>
					
					<?php endif; // ! is_search() ?>
					
					<?php
						
						$post_layout_class = '';
						
						if ( ! is_search() ) {
								
							if ( has_post_thumbnail() ) {
								
								$image_meta = wp_get_attachment_metadata( get_post_thumbnail_id() );
								
								if ( $image_meta ) {
										
									$width = $image_meta['width'];
									$height = $image_meta['height'];
									
									if ( $height > 0 && $width/$height < 1 ) {
										$post_layout_class = 'portrait-layout';
									}
								
								}
								
							}
							
						}
						
						if ( ! get_theme_mod( 'jeanne_ctmzr_settings_enable_auto_blog_layout', true ) ) {
							$post_layout_class = '';
						}
					
					?>
					
					<div class="post-content-container <?php echo esc_attr( $post_layout_class ); ?> clearfix">
							
						<?php 
							
							if ( has_post_thumbnail() ) {
								
								$image_size = jeanne_get_blog_image_size();
								
								if ( is_search() ) {
									
									echo '<a href="' . esc_url( get_permalink() ) . '" class="image-link">';
									echo '<div class="post-image" data-img-src="' . esc_url( get_the_post_thumbnail_url( get_the_ID(), $image_size ) ) . '">';
									echo '</div>';
									echo '</a>';
									
								} else {
										
									echo '<div class="post-image">';
									echo '<a href="' . esc_url( get_permalink() ) . '">';
									the_post_thumbnail( $image_size );
									echo '</a>';
									echo '</div>';
									
								}
								
							}
							
						?>
						
						<div class="post-title-content-wrapper">
								
							<div class="post-title-wrapper">
								<h2 class="post-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
							</div>
							<div class="post-content-wrapper">
								<div class="post-content excerpt clearfix">
									<p>
										<?php jeanne_print_post_excerpt(); ?>
									</p>
								</div>
							</div>
							
						</div>
						
					</div>
					<!-- .post-content-container -->
					
					<?php
						
						if ( ! is_search() ) {
							get_template_part( 'template-parts/content-blog-meta' );
						}
						
					?>
		
				</article>
					
			<?php endwhile; // End the Loop ?>
		
		</div>
		<!-- .blog-list -->
		
		<?php
		
			// Include the post pagination
			get_template_part( 'template-parts/pagination' );
			
		?>
		
	<?php
	// If no content, include the "No posts found" template.
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif; // End if ( have_posts() )
	?>
	
<?php get_footer(); ?>