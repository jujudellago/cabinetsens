<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

$callie_britt_template_args = get_query_var('callie_britt_template_args');
if (is_array($callie_britt_template_args)) {
	$callie_britt_columns = empty($callie_britt_template_args['columns']) ? 2 : max(2, $callie_britt_template_args['columns']);
	$callie_britt_blog_style = array($callie_britt_template_args['type'], $callie_britt_columns);
} else {
	$callie_britt_blog_style = explode('_', callie_britt_get_theme_option('blog_style'));
	$callie_britt_columns = empty($callie_britt_blog_style[1]) ? 2 : max(2, $callie_britt_blog_style[1]);
}
$callie_britt_post_format = get_post_format();
$callie_britt_post_format = empty($callie_britt_post_format) ? 'standard' : str_replace('post-format-', '', $callie_britt_post_format);
$callie_britt_animation = callie_britt_get_theme_option('blog_animation');
$callie_britt_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" <?php
	post_class( 'post_item'
				. ' post_layout_portfolio'
				. ' post_layout_gallery'
				. ' post_layout_gallery_'.esc_attr($callie_britt_columns)
				. ' post_format_'.esc_attr($callie_britt_post_format)
				. (!empty($callie_britt_template_args['slider']) ? ' slider-slide swiper-slide' : '')
			);
	echo (!callie_britt_is_off($callie_britt_animation) && empty($callie_britt_template_args['slider']) ? ' data-animation="'.esc_attr(callie_britt_get_animation_classes($callie_britt_animation)).'"' : '');
	?>
	data-size="<?php if (!empty($callie_britt_image[1]) && !empty($callie_britt_image[2])) echo intval($callie_britt_image[1]) .'x' . intval($callie_britt_image[2]); ?>"
	data-src="<?php if (!empty($callie_britt_image[0])) echo esc_url($callie_britt_image[0]); ?>"
><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$callie_britt_image_hover = 'icon';	// !empty($callie_britt_template_args['hover']) && !callie_britt_is_inherit($callie_britt_template_args['hover']) ? $callie_britt_template_args['hover'] : callie_britt_get_theme_option('image_hover');
	if (in_array($callie_britt_image_hover, array('icons', 'zoom'))) $callie_britt_image_hover = 'dots';
	$callie_britt_components = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('meta_parts'));
	$callie_britt_counters = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('counters'));
	callie_britt_show_post_featured(array(
		'hover' => $callie_britt_image_hover,
		'singular' => false,
		'no_links' => !empty($callie_britt_template_args['no_links']),
		'thumb_size' => callie_britt_get_thumb_size( strpos(callie_britt_get_theme_option('body_style'), 'full')!==false || $callie_britt_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title">'
								. (empty($callie_britt_template_args['no_links']) 
									? '<a href="'.esc_url(get_permalink()).'">' . esc_html(get_the_title()) . '</a>'
									: esc_html(get_the_title())
									)
							. '</h2>'
							. '<div class="post_description">'
								. (!empty($callie_britt_components)
									? callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(
											'components' => $callie_britt_components,
											'counters' => $callie_britt_counters,
											'seo' => false,
											'echo' => false
											), $callie_britt_blog_style[0], $callie_britt_columns))
									: ''
									)
								. (empty($callie_britt_template_args['hide_excerpt'])
									? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
									: ''
									)
								. (empty($callie_britt_template_args['no_links']) 
									? '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'callie-britt') . '</span></a>' 
									: ''
									)
							. '</div>'
						. '</div>'
	));
?></article>