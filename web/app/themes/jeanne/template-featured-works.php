<?php 
/**
 * Template Name: Portfolio: Featured Works
 * Description: This template is for showing only the selected works of your portfolio.
 * 
 * @since 1.0.0
 */

get_header(); ?>

<?php if ( function_exists( 'uxb_port_lite_init_plugin' ) ) : ?>
	
	<?php if ( post_password_required() ) : ?>
		
		<?php get_template_part( 'template-parts/content-page' ); ?>
		
	<?php else : ?>
		
		<?php
		
			$show_page_content = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_featured_works_show_page_content', true );
			
			$page_content_class = 'with-page-content';
			if ( ! $show_page_content ) {
				$page_content_class = 'no-page-content';
			}
		
		?>
		
		<div class="portfolio-template-container featured-works-template clearfix no-category-menu <?php echo esc_attr( $page_content_class ); ?>">
			
			<?php if ( $show_page_content ) : ?>
			
				<div class="portfolio-template-side-content">
						
					<?php
					
						while ( have_posts() ) {
							the_post();
							
							echo '<div class="portfolio-page-content">';
							the_content();
							echo '</div>';
							
						}
						
					?>
					
				</div>
				
			<?php endif; ?>
		
			<section class="portfolio-item-list portfolio-list-styles">

				<?php
					
					// This session will be used in the "portfolio-listing-loop.php" file.
					$_SESSION['current_portfolio_template'] = jeanne_get_current_portfolio_template();
					
					jeanne_print_portfolio_loading();
					
					// Display portfolio items
					get_template_part( 'template-parts/portfolio-listing' );

				?>

			</section>
				
		</div>
	
	<?php endif; ?>
	
<?php endif; ?>

<?php get_footer(); ?>