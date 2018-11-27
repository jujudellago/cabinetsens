<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

$callie_britt_link = get_permalink();
$callie_britt_post_format = get_post_format();
$callie_britt_post_format = empty($callie_britt_post_format) ? 'standard' : str_replace('post-format-', '', $callie_britt_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($callie_britt_post_format) ); ?>><?php
	callie_britt_show_post_featured(array(
		'thumb_size' => apply_filters('callie_britt_filter_related_thumb_size', callie_britt_get_thumb_size( (int) callie_britt_get_theme_option('related_posts') == 1 ? 'huge' : 'big' )),
		'show_no_image' => callie_britt_get_theme_setting('allow_no_image'),
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">'.wp_kses_post(callie_britt_get_post_categories('')).'</div>'
							. '<h6 class="post_title entry-title"><a href="'.esc_url($callie_britt_link).'">'.wp_kses_data(get_the_title()).'</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="'.esc_url($callie_britt_link).'">'.wp_kses_data(callie_britt_get_date()).'</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>