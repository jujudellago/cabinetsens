<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

if ( get_query_var('callie_britt_header_image')=='' && is_singular() && has_post_thumbnail() && in_array(get_post_type(), array('post', 'page')) )  {
	$callie_britt_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if (!empty($callie_britt_src[0])) {
		callie_britt_sc_layouts_showed('featured', false);
		/* ?><div class="sc_layouts_featured with_image without_content <?php echo esc_attr(callie_britt_add_inline_css_class('background-image:url('.esc_url($callie_britt_src[0]).');')); ?>"></div><?php */
	}
}
?>