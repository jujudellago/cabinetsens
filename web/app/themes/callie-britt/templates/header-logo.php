<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

$callie_britt_args = get_query_var('callie_britt_logo_args');

// Site logo
$callie_britt_logo_type   = isset($callie_britt_args['type']) ? $callie_britt_args['type'] : '';
$callie_britt_logo_image  = callie_britt_get_logo_image($callie_britt_logo_type);
$callie_britt_logo_text   = callie_britt_is_on(callie_britt_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$callie_britt_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($callie_britt_logo_image) || !empty($callie_britt_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url(home_url('/')); ?>"><?php
		if (!empty($callie_britt_logo_image)) {
			if (empty($callie_britt_logo_type) && function_exists('the_custom_logo') && (int) $callie_britt_logo_image > 0) {
				the_custom_logo();
			} else {
				$callie_britt_attr = callie_britt_getimagesize($callie_britt_logo_image);
				echo '<img src="'.esc_url($callie_britt_logo_image).'" alt="'.esc_attr($callie_britt_logo_text).'"'.(!empty($callie_britt_attr[3]) ? ' '.wp_kses_data($callie_britt_attr[3]) : '').'>';
			}
		} else {
			callie_britt_show_layout(callie_britt_prepare_macros($callie_britt_logo_text), '<span class="logo_text">', '</span>');
			callie_britt_show_layout(callie_britt_prepare_macros($callie_britt_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>