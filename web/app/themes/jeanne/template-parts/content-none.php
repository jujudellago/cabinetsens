<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @since 1.0.0
 */
?>

<article class="post-item no-results-section other-templates clearfix">
	<div class="post-content-container clearfix">
		
		<div class="post-title-content-wrapper">
				
			<div class="post-title-wrapper">
				<h1 class="post-title"><?php esc_html_e( 'Nothing Found', 'jeanne' ); ?></h1>
			</div>
			
			<div class="post-content-wrapper">
				<div class="post-content">
					
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

						<p><?php echo jeanne_wp_kses_escape( sprintf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jeanne' ), esc_url( admin_url( 'post-new.php' ) ) ) ); ?></p>

					<?php elseif ( is_search() ) : ?>

						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jeanne' ); ?></p>
						<?php get_search_form(); ?>

					<?php else : ?>
						
						<?php
							
							echo '<p>' . esc_html__( 'It seems we cannot find what you are looking for. Please try searching the site using the form below.', 'jeanne' ) . '</p>';
							get_search_form();

						?>

					<?php endif; ?>
					
				</div>
			</div>
			
		</div>
		
	</div>
</article>