<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

						// Widgets area inside page content
						callie_britt_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					callie_britt_create_widgets_area('widgets_below_page');

					$callie_britt_body_style = callie_britt_get_theme_option('body_style');
					if ($callie_britt_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$callie_britt_footer_type = callie_britt_get_theme_option("footer_type");
			if ($callie_britt_footer_type == 'custom' && !callie_britt_is_layouts_available())
				$callie_britt_footer_type = 'default';
			get_template_part( apply_filters('callie_britt_filter_get_template_part', "templates/footer-{$callie_britt_footer_type}") );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>

</body>
</html>