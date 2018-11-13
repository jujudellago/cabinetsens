<?php
/**
 * Shared page content for page.php and portfolio templates
 *
 * @since 1.0.0
 */
?>



<?php while ( have_posts() ) : the_post(); // Start the loop ?>
	
	<article>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<div class="post-content-container clearfix">
				
				<?php if ( has_post_thumbnail() ) : ?>
					
					<?php
						
						$image_size = jeanne_get_page_image_size();
						
						echo '<div class="post-image">';
						the_post_thumbnail( $image_size );
						echo '</div>';
						
					?>
				
				<?php endif; // has_post_thumbnail() ?>
				
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
					<!-- .post-content-wrapper -->
					
				</div>
				<!-- .post-title-content-wrapper -->
				
				<?php
							
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					
				?>
				
			</div>
			<!-- .post-content-container -->
		</div>
		<!-- .post-item -->
		
	</article>
	
<?php endwhile; // End of the loop ?>
