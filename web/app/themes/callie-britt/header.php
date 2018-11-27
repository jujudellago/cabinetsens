<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(callie_britt_get_theme_option('color_scheme'));
										 ?>">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'callie_britt_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap"><?php
			// Desktop header
			$callie_britt_header_type = callie_britt_get_theme_option("header_type");
			if ($callie_britt_header_type == 'custom' && !callie_britt_is_layouts_available())
				$callie_britt_header_type = 'default';
			get_template_part( apply_filters('callie_britt_filter_get_template_part', "templates/header-{$callie_britt_header_type}") );

			// Side menu
			if (in_array(callie_britt_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-navi-side') );
			}
			
			// Mobile menu
			get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-navi-mobile') );
			?>

			<div class="page_content_wrap">

				<?php if (callie_britt_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					callie_britt_create_widgets_area('widgets_above_page');
					?>				

					<div class="content">
						<?php
						// Widgets area inside page content
						callie_britt_create_widgets_area('widgets_above_content');
						?>				
