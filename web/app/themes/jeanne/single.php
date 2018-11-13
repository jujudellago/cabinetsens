<?php 
/**
 * The template for displaying all single post content
 *
 * @since 1.0.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); // Start the loop ?>
	
	<article>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<div class="post-date-wrapper">
				<a href="<?php the_permalink(); ?>">
					<time class="published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" title="<?php echo get_the_time( 'F j, Y' ); ?>"><?php echo get_the_time( get_option( 'date_format' ) ); ?></time>
				</a>
			</div>
			
			<div class="post-content-container clearfix">
				
				<?php if ( has_post_thumbnail() ) : ?>
					
					<?php
						
						$image_size = jeanne_get_blog_image_size();
						
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
						
						<?php
							
							$meta_info_display = jeanne_get_blog_meta_info_display();
							
							$author_bio_display = true;
							if ( ! in_array( 'author-bio', $meta_info_display ) ) {
								$author_bio_display = false;
							}
							
							$categories_display = true;
							if ( ! in_array( 'categories', $meta_info_display ) ) {
								$categories_display = false;
							}
							
							$tags_display = true;
							if ( ! in_array( 'tags', $meta_info_display ) ) {
								$tags_display = false;
							}
							
							// Author bio
							$author_desc = get_the_author_meta( 'description' );
							
						?>
						
						<?php if ( $author_bio_display ) : ?>
							
							<?php if ( ! empty( $author_desc ) ) : ?>
								
								<!-- Author Section -->
								<section class="author-info clearfix">
									<h4 class="section-title"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html__( 'By', 'jeanne' ) . ' ' . get_the_author(); ?></a></h4>
									
									<div class="section-content">
										
										<?php if ( ! empty( $author_desc ) ) : ?>
											<p>
												<?php echo get_the_author_meta( 'description' ); ?>
											</p>
										<?php endif; ?>
										
									</div>
										
								</section>
							
							<?php endif; ?>
							
						<?php endif; ?>
						
						<?php if ( $categories_display || $tags_display ) : ?>
							
							<div class="post-categories-tags-wrapper">
								
								<?php if ( $categories_display ) : ?>
										
									<?php
										// Blog Category List
										$categories = get_the_category();
										
									?>
									
									<?php if ( is_single() && ! empty( $categories ) ) : // Display categories only on the blog single page ?>
										<ul class="post-meta meta-others meta-categories">
											<li class="meta-title">
												<?php
												
													if ( count( $categories ) > 1 ) {
														esc_html_e( 'Categories', 'jeanne' );
													} else {
														esc_html_e( 'Category', 'jeanne' );
													}
												
												?>
											</li>
											<?php
										
												foreach ( $categories as $category ) {
													echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
												}
												
											?>
										</ul>
									<?php endif; // if ( is_single() && ! empty( $categories ) ) : ?>
									
								<?php endif; ?>
								
								<?php if ( $tags_display ) : ?>
										
									<?php
										
										// Blog Tag List
										$tags = get_the_tags();
										
									?>
									
									<?php if ( is_single() && ! empty( $tags ) ) : // Display categories only on the blog single page ?>
										<ul class="post-meta meta-others meta-tags">
											<li class="meta-title">
												<?php
												
													if ( count( $tags ) > 1 ) {
														esc_html_e( 'Tags', 'jeanne' );
													} else {
														esc_html_e( 'Tag', 'jeanne' );
													}
												
												?>
											</li>
											<?php
										
												foreach ( $tags as $tag ) {
													echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li>';
												}
												
											?>
										</ul>
									<?php endif; // if ( is_single() && ! empty( $categories ) ) : ?>
									
								<?php endif; ?>
									
							</div>
							<!-- .post-categories-tags-wrapper -->
							
						<?php endif; ?>
						
					</div>
					<!-- .post-content-wrapper -->
					
				</div>
				<!-- .post-title-content-wrapper -->
				
				<?php
					
					// Post navigation
					if ( get_theme_mod( 'jeanne_ctmzr_settings_blog_enable_post_navigation', true ) ) {
						jeanne_print_post_navigation( get_the_ID() );
					}
					
					// Comment Section
					if ( get_theme_mod( 'jeanne_ctmzr_settings_blog_enable_blog_comment', true ) ) {
						comments_template(); 
					}
					
				?>
				
			</div>
			<!-- .post-content-container -->
		</div>
		<!-- .post-item -->
		
	</article>
	
<?php endwhile; // End of the loop ?>

<?php get_footer(); ?>