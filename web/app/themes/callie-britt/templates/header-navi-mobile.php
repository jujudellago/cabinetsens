<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(callie_britt_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('callie_britt_logo_args', array('type' => 'mobile'));
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/header-logo') );
		set_query_var('callie_britt_logo_args', array());

		// Mobile menu
		$callie_britt_menu_mobile = callie_britt_get_nav_menu('menu_mobile');
		if (empty($callie_britt_menu_mobile)) {
			$callie_britt_menu_mobile = apply_filters('callie_britt_filter_get_mobile_menu', '');
			if (empty($callie_britt_menu_mobile)) $callie_britt_menu_mobile = callie_britt_get_nav_menu('menu_main');
			if (empty($callie_britt_menu_mobile)) $callie_britt_menu_mobile = callie_britt_get_nav_menu();
		}
		if (!empty($callie_britt_menu_mobile)) {
			if (!empty($callie_britt_menu_mobile))
				$callie_britt_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$callie_britt_menu_mobile
					);
			if (strpos($callie_britt_menu_mobile, '<nav ')===false)
				$callie_britt_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $callie_britt_menu_mobile);
			callie_britt_show_layout(apply_filters('callie_britt_filter_menu_mobile_layout', $callie_britt_menu_mobile));
		}

		// Search field
		do_action('callie_britt_action_search', 'normal', 'search_mobile', false);
		
		// Social icons
		callie_britt_show_layout(callie_britt_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
