<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.1
 */
 
$callie_britt_theme_obj = wp_get_theme();
?>
<div class="callie_britt_admin_notice callie_britt_welcome_notice update-nag"><?php
	// Theme image
	if ( ($callie_britt_theme_img = callie_britt_get_file_url('screenshot.jpg')) != '') {
		?><div class="callie_britt_notice_image"><img src="<?php echo esc_url($callie_britt_theme_img); ?>" alt="<?php esc_attr_e('Theme screenshot', 'callie-britt'); ?>"></div><?php
	}

	// Title
	?><h3 class="callie_britt_notice_title"><?php
		// Translators: Add theme name and version to the 'Welcome' message
		echo esc_html(sprintf(__('Welcome to %1$s v.%2$s', 'callie-britt'),
				$callie_britt_theme_obj->name . (CALLIE_BRITT_THEME_FREE ? ' ' . __('Free', 'callie-britt') : ''),
				$callie_britt_theme_obj->version
				));
	?></h3><?php

	// Description
	?><div class="callie_britt_notice_text"><?php
		echo str_replace('. ', '.<br>', wp_kses_data($callie_britt_theme_obj->description));
		if (!callie_britt_exists_trx_addons()) {
			echo (!empty($callie_britt_theme_obj->description) ? '<br><br>' : '')
					. wp_kses_data(__('Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'callie-britt'));
		}
	?></div><?php

	// Buttons
	?><div class="callie_britt_notice_buttons"><?php
		// Link to the page 'About Theme'
		?><a href="<?php echo esc_url(admin_url().'themes.php?page=callie_britt_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php
			// Translators: Add theme name
			echo esc_html(sprintf(__('About %s', 'callie-britt'), $callie_britt_theme_obj->name));
		?></a><?php
		// Link to the page 'Install plugins'
		if (callie_britt_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'callie-britt'); ?></a>
			<?php
		}
		// Link to the 'One-click demo import'
		if (function_exists('callie_britt_exists_ocdi') && callie_britt_exists_ocdi()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=pt-one-click-demo-import'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Import', 'callie-britt'); ?></a>
			<?php
		} else if (!callie_britt_storage_isset('required_plugins', 'one-click-demo-import') && function_exists('callie_britt_exists_trx_addons') && callie_britt_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Import', 'callie-britt'); ?></a>
			<?php
		}
		// Link to the Customizer
		?><a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'callie-britt'); ?></a><?php
		// Link to the Theme Options
		if (!CALLIE_BRITT_THEME_FREE) {
			?><span> <?php esc_html_e('or', 'callie-britt'); ?> </span>
        	<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'callie-britt'); ?></a><?php
        }
        // Dismiss this notice
        ?><a href="#" class="callie_britt_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="callie_britt_hide_notice_text"><?php esc_html_e('Dismiss', 'callie-britt'); ?></span></a>
	</div>
</div>