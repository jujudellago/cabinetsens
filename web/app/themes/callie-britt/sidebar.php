<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

if (callie_britt_sidebar_present()) {
	ob_start();
	$callie_britt_sidebar_name = callie_britt_get_theme_option('sidebar_widgets');
	callie_britt_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($callie_britt_sidebar_name) ) {
		dynamic_sidebar($callie_britt_sidebar_name);
	}
	$callie_britt_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($callie_britt_out)) {
		$callie_britt_sidebar_position = callie_britt_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($callie_britt_sidebar_position); ?> widget_area<?php if (!callie_britt_is_inherit(callie_britt_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(callie_britt_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'callie_britt_action_before_sidebar' );
				callie_britt_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $callie_britt_out));
				do_action( 'callie_britt_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>