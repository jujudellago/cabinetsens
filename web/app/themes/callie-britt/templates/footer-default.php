<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.10
 */

?>
<footer class="footer_wrap footer_default<?php
				if (!callie_britt_is_inherit(callie_britt_get_theme_option('footer_scheme')))
					echo ' scheme_' . esc_attr(callie_britt_get_theme_option('footer_scheme'));
				?>">
	<?php

	// Footer widgets area
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/footer-widgets') );

	// Logo
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/footer-logo') );

	// Socials
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/footer-socials') );

	// Menu
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/footer-menu') );

	// Copyright area
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/footer-copyright') );
	
	?>
</footer><!-- /.footer_wrap -->
