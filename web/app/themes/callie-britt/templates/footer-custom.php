<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.10
 */

$callie_britt_footer_id = str_replace('footer-custom-', '', callie_britt_get_theme_option("footer_style"));
if ((int) $callie_britt_footer_id == 0) {
	$callie_britt_footer_id = callie_britt_get_post_id(array(
												'name' => $callie_britt_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$callie_britt_footer_id = apply_filters('callie_britt_filter_get_translated_layout', $callie_britt_footer_id);
}
$callie_britt_footer_meta = get_post_meta($callie_britt_footer_id, 'trx_addons_options', true);
if (!empty($callie_britt_footer_meta['margin']) != '') 
	callie_britt_add_inline_css(sprintf('.page_content_wrap{padding-bottom:%s}', esc_attr(callie_britt_prepare_css_value($callie_britt_footer_meta['margin']))));
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($callie_britt_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($callie_britt_footer_id))); 
						if (!callie_britt_is_inherit(callie_britt_get_theme_option('footer_scheme')))
							echo ' scheme_' . esc_attr(callie_britt_get_theme_option('footer_scheme'));
						?>">
	<?php
    // Custom footer's layout
    do_action('callie_britt_action_show_layout', $callie_britt_footer_id);
	?>
</footer><!-- /.footer_wrap -->
