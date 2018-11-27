<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.06
 */

$callie_britt_header_css = '';
$callie_britt_header_image = get_header_image();
$callie_britt_header_video = callie_britt_get_header_video();
if (!empty($callie_britt_header_image) && callie_britt_trx_addons_featured_image_override(is_singular() || callie_britt_storage_isset('blog_archive') || is_category())) {
	$callie_britt_header_image = callie_britt_get_current_mode_image($callie_britt_header_image);
}

$callie_britt_header_id = str_replace('header-custom-', '', callie_britt_get_theme_option("header_style"));
if ((int) $callie_britt_header_id == 0) {
	$callie_britt_header_id = callie_britt_get_post_id(array(
												'name' => $callie_britt_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$callie_britt_header_id = apply_filters('callie_britt_filter_get_translated_layout', $callie_britt_header_id);
}
$callie_britt_header_meta = get_post_meta($callie_britt_header_id, 'trx_addons_options', true);
if (!empty($callie_britt_header_meta['margin']) != '') 
	callie_britt_add_inline_css(sprintf('.page_content_wrap{padding-top:%s}', esc_attr(callie_britt_prepare_css_value($callie_britt_header_meta['margin']))));

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($callie_britt_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($callie_britt_header_id)));
				echo !empty($callie_britt_header_image) || !empty($callie_britt_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($callie_britt_header_video!='') 
					echo ' with_bg_video';
				if ($callie_britt_header_image!='') 
					echo ' '.esc_attr(callie_britt_add_inline_css_class('background-image: url('.esc_url($callie_britt_header_image).');'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (callie_britt_is_on(callie_britt_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight callie-britt-full-height';
				if (!callie_britt_is_inherit(callie_britt_get_theme_option('header_scheme')))
					echo ' scheme_' . esc_attr(callie_britt_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($callie_britt_header_video)) {
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-video') );
	}
		
	// Custom header's layout
	do_action('callie_britt_action_show_layout', $callie_britt_header_id);

	// Header widgets area
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-widgets') );
		
?></header>