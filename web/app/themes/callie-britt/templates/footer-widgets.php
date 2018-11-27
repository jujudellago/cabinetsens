<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.10
 */

// Footer sidebar
$callie_britt_footer_name = callie_britt_get_theme_option('footer_widgets');
$callie_britt_footer_present = !callie_britt_is_off($callie_britt_footer_name) && is_active_sidebar($callie_britt_footer_name);
if ($callie_britt_footer_present) { 
	callie_britt_storage_set('current_sidebar', 'footer');
	$callie_britt_footer_wide = callie_britt_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($callie_britt_footer_name) ) {
		dynamic_sidebar($callie_britt_footer_name);
	}
	$callie_britt_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($callie_britt_out)) {
		$callie_britt_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $callie_britt_out);
		$callie_britt_need_columns = true;	//or check: strpos($callie_britt_out, 'columns_wrap')===false;
		if ($callie_britt_need_columns) {
			$callie_britt_columns = max(0, (int) callie_britt_get_theme_option('footer_columns'));
			if ($callie_britt_columns == 0) $callie_britt_columns = min(4, max(1, substr_count($callie_britt_out, '<aside ')));
			if ($callie_britt_columns > 1)
				$callie_britt_out = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($callie_britt_columns).' widget', $callie_britt_out);
			else
				$callie_britt_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($callie_britt_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$callie_britt_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($callie_britt_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'callie_britt_action_before_sidebar' );
				callie_britt_show_layout($callie_britt_out);
				do_action( 'callie_britt_action_after_sidebar' );
				if ($callie_britt_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$callie_britt_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>