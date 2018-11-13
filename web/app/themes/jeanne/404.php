<?php
/**
 * This template will be used when a page is not found
 *
 * @since 1.0.0
 */

get_header(); ?>

<article class="post-item no-results-section other-templates clearfix">
	<div class="post-content-container clearfix">
		
		<div class="post-title-content-wrapper">
				
			<div class="post-title-wrapper">
				<h1 class="post-title"><?php esc_html_e( 'Page Not Found', 'jeanne' ); ?></h1>
			</div>
			
			<div class="post-content-wrapper">
				<div class="post-content">
					<p>
						<?php echo jeanne_wp_kses_escape( sprintf( __( 'The requested page could not be found or it is currently unavailable.<br/>Please <a href="%s">click here</a> to go to our homepage or use the search form below.', 'jeanne' ), esc_url( home_url( '/' ) ) ) ); ?>
					</p>
					<?php get_search_form(); ?>
				</div>
			</div>
			
		</div>
		
	</div>
</article>
	
<?php get_footer(); ?>