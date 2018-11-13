<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the content div and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since 1.0.0
 */
?>
	
			</main>
			<!-- #content-container -->
		</div>
		<!-- #main-container -->
		
		<!-- Widget area -->
		<footer class="footer-container">
			
				<?php
						
					// Footer Widget Area
					get_sidebar();
					
				?>
				
			<?php
				
				// Copyright Text
				$default_copyright_text = jeanne_wp_kses_escape( sprintf( __( '&copy; Jeanne WordPress Theme. Designed by <a href="%s">UXBARN</a>.', 'jeanne' ), 'https://uxbarn.com' ) );
				
				// Get the saved copyright text
				$copyright_text = get_theme_mod( 'jeanne_ctmzr_site_identity_copyright_text', $default_copyright_text );
			
			?>

			<?php if ( ! empty( $copyright_text ) ) : ?>
				<div class="copyright">
					<?php echo jeanne_wp_kses_escape( $copyright_text ); ?>
				</div>
			<?php endif; ?>
			
		</footer>
		
	</div>
	<!-- #root-container -->

	<!-- Fullscreen Search Panel -->
	<div id="search-panel-wrapper">
		<div id="inner-search-panel">
			<?php get_search_form( true ); ?>
			<a id="search-close-button" href="javascript:;" title="<?php esc_attr_e( 'Close', 'jeanne' ); ?>"><i class="fas fa-times"></i></a>
		</div>
	</div>
	
	<?php wp_footer(); ?>
	
</body>
</html>