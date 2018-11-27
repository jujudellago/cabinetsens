<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.10
 */

// Footer menu
$callie_britt_menu_footer = callie_britt_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($callie_britt_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php callie_britt_show_layout($callie_britt_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>