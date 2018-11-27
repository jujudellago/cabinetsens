<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

$callie_britt_header_css = '';
$callie_britt_header_image = get_header_image();
$callie_britt_header_video = callie_britt_get_header_video();
if (!empty($callie_britt_header_image) && callie_britt_trx_addons_featured_image_override(is_singular() || callie_britt_storage_isset('blog_archive') || is_category())) {
	$callie_britt_header_image = callie_britt_get_current_mode_image($callie_britt_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($callie_britt_header_image) || !empty($callie_britt_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($callie_britt_header_video!='') echo ' with_bg_video';
					if ($callie_britt_header_image!='') echo ' '.esc_attr(callie_britt_add_inline_css_class('background-image: url('.esc_url($callie_britt_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (callie_britt_is_on(callie_britt_get_theme_option('header_fullheight'))) echo ' header_fullheight callie-britt-full-height';
					if (!callie_britt_is_inherit(callie_britt_get_theme_option('header_scheme')))
						echo ' scheme_' . esc_attr(callie_britt_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($callie_britt_header_video)) {
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-video') );
	}
	
	// Main menu
	if (callie_britt_get_theme_option("menu_style") == 'top') {
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-navi') );
	}

	// Mobile header
	if (callie_britt_is_on(callie_britt_get_theme_option("header_mobile_enabled"))) {
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-mobile') );
	}
	
	// Page title and breadcrumbs area
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-title') );

	// Header widgets area
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-widgets') );

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-single') );

?></header>