<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" <?php
	post_class( 'post_item'
				. ' post_layout_portfolio'
				. ' post_layout_portfolio_'.esc_attr($callie_britt_columns)
				. ' post_format_'.esc_attr($callie_britt_post_format)
				. (is_sticky() && !is_paged() ? ' sticky' : '')
				. (!empty($callie_britt_template_args['slider']) ? ' slider-slide swiper-slide' : '')
			);
	echo (!callie_britt_is_off($callie_britt_animation) && empty($callie_britt_template_args['slider']) ? ' data-animation="'.esc_attr(callie_britt_get_animation_classes($callie_britt_animation)).'"' : '');
?>><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$callie_britt_image_hover = !empty($callie_britt_template_args['hover']) && !callie_britt_is_inherit($callie_britt_template_args['hover'])
								? $callie_britt_template_args['hover']
								: callie_britt_get_theme_option('image_hover');
	// Featured image
	callie_britt_show_post_featured(array(
		'singular' => false,
		'hover' => $callie_britt_image_hover,
		'no_links' => !empty($callie_britt_template_args['no_links']),
		'thumb_size' => callie_britt_get_thumb_size(strpos(callie_britt_get_theme_option('body_style'), 'full')!==false || $callie_britt_columns < 3 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $callie_britt_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $callie_britt_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>