<?php
/**
 * For displaying theme's footer widget area
 *
 * @since 1.0.0
 */
?>

<?php

	$has_any_widgets = false;
	$display_widget_area = get_theme_mod( 'jeanne_ctmzr_settings_general_show_footer_widget_area', true );
	$widget_area_columns = jeanne_get_widget_column_number();
	$widget_area_id_prefix = 'jeanne-widget-area-';
	
	for ( $i = 1; $i <= $widget_area_columns; $i++ ) {
		
		// The same ID as what registered in theme-functions.php
		$widget_area_id = $widget_area_id_prefix . $i;
		
		// Check if the current sidebar has any widgets
		if ( is_active_sidebar( $widget_area_id ) ) {
			$has_any_widgets = true;
		}
		
	}
	
?>

<?php if ( $display_widget_area && $has_any_widgets ) : ?>

	<div class="inner-footer-container clearfix">
			
		<?php
		
			$col_num = 12 / $widget_area_columns;
			
			for ( $i = 1; $i <= $widget_area_columns; $i++ ) {
				
				// The same ID as what registered in theme-functions.php
				$widget_area_id = $widget_area_id_prefix . $i;
					
				?>
				
				<div class="w<?php echo esc_attr( intval( $col_num ) ); ?> widget-column clearfix">
					<?php dynamic_sidebar( $widget_area_id ); ?>
				</div>
				
				<?php
				
			}
		
		?>
		
	</div>

<?php endif; ?>