<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

// Header sidebar
$callie_britt_header_name = callie_britt_get_theme_option('header_widgets');
$callie_britt_header_present = !callie_britt_is_off($callie_britt_header_name) && is_active_sidebar($callie_britt_header_name);
if ($callie_britt_header_present) { 
	callie_britt_storage_set('current_sidebar', 'header');
	$callie_britt_header_wide = callie_britt_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($callie_britt_header_name) ) {
		dynamic_sidebar($callie_britt_header_name);
	}
	$callie_britt_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($callie_britt_widgets_output)) {
		$callie_britt_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $callie_britt_widgets_output);
		$callie_britt_need_columns = strpos($callie_britt_widgets_output, 'columns_wrap')===false;
		if ($callie_britt_need_columns) {
			$callie_britt_columns = max(0, (int) callie_britt_get_theme_option('header_columns'));
			if ($callie_britt_columns == 0) $callie_britt_columns = min(6, max(1, substr_count($callie_britt_widgets_output, '<aside ')));
			if ($callie_britt_columns > 1)
				$callie_britt_widgets_output = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($callie_britt_columns).' widget', $callie_britt_widgets_output);
			else
				$callie_britt_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($callie_britt_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$callie_britt_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($callie_britt_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'callie_britt_action_before_sidebar' );
				callie_britt_show_layout($callie_britt_widgets_output);
				do_action( 'callie_britt_action_after_sidebar' );
				if ($callie_britt_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$callie_britt_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>