<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.10
 */

// Logo
if (callie_britt_is_on(callie_britt_get_theme_option('logo_in_footer'))) {
	$callie_britt_logo_image = callie_britt_get_logo_image('footer');
	$callie_britt_logo_text  = get_bloginfo( 'name' );
	if (!empty($callie_britt_logo_image) || !empty($callie_britt_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($callie_britt_logo_image)) {
					$callie_britt_attr = callie_britt_getimagesize($callie_britt_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'">'
							. '<img src="'.esc_url($callie_britt_logo_image).'"'
								. ' class="logo_footer_image"'
								. ' alt="'.esc_attr__('Site logo', 'callie-britt').'"'
								. (!empty($callie_britt_attr[3]) ? ' ' . wp_kses_data($callie_britt_attr[3]) : '')
							.'>'
						. '</a>' ;
				} else if (!empty($callie_britt_logo_text)) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="'.esc_url(home_url('/')).'">'
								. esc_html($callie_britt_logo_text)
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>