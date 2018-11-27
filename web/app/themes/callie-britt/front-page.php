<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.31
 */

get_header();

// If front-page is a static page
if (get_option('show_on_front') == 'page') {

	// If Front Page Builder is enabled - display sections
	if (callie_britt_is_on(callie_britt_get_theme_option('front_page_enabled'))) {

		if ( have_posts() ) the_post();

		$callie_britt_sections = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('front_page_sections'), 1, false);
		if (is_array($callie_britt_sections)) {
			foreach ($callie_britt_sections as $callie_britt_section) {
				get_template_part( apply_filters('callie_britt_filter_get_template_part', "front-page/section", $callie_britt_section), $callie_britt_section );
			}
		}
	
	// Else if this page is blog archive
	} else if (is_page_template('blog.php')) {
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'blog') );

	// Else - display native page content
	} else {
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'page') );
	}

// Else get index template to show posts
} else {
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'index') );
}

get_footer();
?>