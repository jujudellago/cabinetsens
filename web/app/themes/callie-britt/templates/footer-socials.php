<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.10
 */


// Socials
if ( callie_britt_is_on(callie_britt_get_theme_option('socials_in_footer')) && ($callie_britt_output = callie_britt_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php callie_britt_show_layout($callie_britt_output); ?>
		</div>
	</div>
	<?php
}
?>