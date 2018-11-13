<?php 
/**
 * Template Name: Portfolio: All Works
 * Description: This template is for showing all of your works with the category menu
 * 
 * @since 1.0.0
 */

get_header(); ?>

<?php if ( function_exists( 'uxb_port_lite_init_plugin' ) ) : ?>
	
	<?php if ( post_password_required() ) : ?>
		
		<?php get_template_part( 'template-parts/content-page' ); ?>
		
	<?php else : ?>
		
		<?php
		
			$show_page_content = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_all_works_show_page_content', false );
			$show_category_menu = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_show_category_menu', true );
			
			$page_content_class = 'with-page-content';
			if ( ! $show_page_content ) {
				$page_content_class = 'no-page-content';
			}
			
			$category_menu_class = 'with-category-menu';
			if ( ! $show_category_menu ) {
				$category_menu_class = 'no-category-menu';
			}
			
		?>
		
		<div class="portfolio-template-container all-works-template clearfix <?php echo esc_attr( implode( ' ', array( $page_content_class, $category_menu_class ) ) ); ?>">
			
			<?php if ( $show_page_content || $show_category_menu ) : ?>
				
				<div class="portfolio-template-side-content">
						
					<?php
					
						if ( $show_page_content ) {
							
							while ( have_posts() ) {
								the_post();
								
								echo '<div class="portfolio-page-content">';
								the_content();
								echo '</div>';
								
							}
							
						}
						
						
						// Display portfolio category title and category menu
						if ( $show_category_menu ) {
							
							// Display portfolio category menus
							get_template_part( 'template-parts/portfolio-category-menu' );
							
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