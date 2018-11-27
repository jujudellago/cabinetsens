<?php
/**
 * Admin utilities
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.1
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('callie_britt_admin_theme_setup') ) {
	add_action( 'after_setup_theme', 'callie_britt_admin_theme_setup' );
	function callie_britt_admin_theme_setup() {
		// Add theme icons
		add_action('admin_footer',	 						'callie_britt_admin_footer');

		// Enqueue scripts and styles for admin
		add_action("admin_enqueue_scripts",					'callie_britt_admin_scripts');
		add_action("admin_footer",							'callie_britt_admin_localize_scripts');
		
		// Show admin notice with control panel
		add_action('admin_notices',							'callie_britt_admin_notice');
		add_action('wp_ajax_callie_britt_hide_admin_notice',		'callie_britt_callback_hide_admin_notice');

		// Show admin notice with "Rate Us" panel
		add_action('after_switch_theme',					'callie_britt_save_activation_date');
		add_action('admin_notices',							'callie_britt_rate_notice');
		add_action('wp_ajax_callie_britt_hide_rate_notice',		'callie_britt_callback_hide_rate_notice');

		// TGM Activation plugin
		add_action('tgmpa_register',						'callie_britt_register_plugins');
	
		// Init internal admin messages
		callie_britt_init_admin_messages();
	}
}


//-------------------------------------------------------
//-- Welcome notice
//-------------------------------------------------------

// Show admin notice
if ( !function_exists( 'callie_britt_admin_notice' ) ) {
	//Handler of the add_action('admin_notices', 'callie_britt_admin_notice', 2);
	function callie_britt_admin_notice() {
		if (in_array(callie_britt_get_value_gp('action'), array('vc_load_template_preview'))) return;
		if (callie_britt_get_value_gp('page') == 'callie_britt_about') return;
		if (!current_user_can('edit_theme_options')) return;
		$show = get_option('callie_britt_admin_notice');
		if ($show !== false && (int) $show == 0) return;
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/admin-notice') );
	}
}

// Hide admin notice
if ( !function_exists( 'callie_britt_callback_hide_admin_notice' ) ) {
	//Handler of the add_action('wp_ajax_callie_britt_hide_admin_notice', 'callie_britt_callback_hide_admin_notice');
	function callie_britt_callback_hide_admin_notice() {
		if ( wp_verify_nonce( callie_britt_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			update_option('callie_britt_admin_notice', '0');
		die();
	}
}


//-------------------------------------------------------
//-- "Rate Us" notice
//-------------------------------------------------------

// Save activation date
if (!function_exists('callie_britt_save_activation_date')) {
	//Handler of the add_action('after_switch_theme', 'callie_britt_save_activation_date');
	function callie_britt_save_activation_date() {
		$theme_time = (int) get_option( 'callie_britt_theme_activated' );
		if ($theme_time == 0) {
			$theme_slug = get_option( 'template' );
			$stylesheet_slug = get_option( 'stylesheet' );
			if ($theme_slug == $stylesheet_slug) {
				update_option('callie_britt_theme_activated', time());
			}
		}
	}
}

// Show Rate Us notice
if ( !function_exists( 'callie_britt_rate_notice' ) ) {
	//Handler of the add_action('admin_notices', 'callie_britt_rate_notice', 2);
	function callie_britt_rate_notice() {
		if (in_array(callie_britt_get_value_gp('action'), array('vc_load_template_preview'))) return;
		if (!current_user_can('edit_theme_options')) return;
		// Display the message only on specified screens
		$allowed = array('dashboard', 'theme_options', 'trx_addons_options');
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if ( ( is_object($screen) && !empty($screen->id) && in_array($screen->id, $allowed) ) || in_array(callie_britt_get_value_gp('page'), $allowed) ) {
			$show = get_option('callie_britt_rate_notice');
			$start = get_option('callie_britt_theme_activated');
			if ( ($show !== false && (int) $show == 0) || ($start > 0 && (time()-$start)/(24*3600) < 14) ) return;
			get_template_part( apply_filters('callie_britt_filter_get_template_part', 'templates/admin-rate') );
		}
	}
}

// Hide rate notice
if ( !function_exists( 'callie_britt_callback_hide_rate_notice' ) ) {
	//Handler of the add_action('wp_ajax_callie_britt_hide_rate_notice', 'callie_britt_callback_hide_rate_notice');
	function callie_britt_callback_hide_rate_notice() {
		if ( wp_verify_nonce( callie_britt_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			update_option('callie_britt_rate_notice', '0');
		die();
	}
}


//-------------------------------------------------------
//-- Internal messages
//-------------------------------------------------------

// Init internal admin messages
if ( !function_exists( 'callie_britt_init_admin_messages' ) ) {
	function callie_britt_init_admin_messages() {
		$msg = get_option('callie_britt_admin_messages');
		if (is_array($msg))
			update_option('callie_britt_admin_messages', '');
		else
			$msg = array();
		callie_britt_storage_set('admin_messages', $msg);
	}
}

// Add internal admin message
if ( !function_exists( 'callie_britt_add_admin_message' ) ) {
	function callie_britt_add_admin_message($text, $type='success', $cur_session=false) {
		if (!empty($text)) {
			$new_msg = array('message' => $text, 'type' => $type);
			if ($cur_session) {
				callie_britt_storage_push_array('admin_messages', '', $new_msg);
			} else {
				$msg = get_option('callie_britt_admin_messages');
				if (!is_array($msg)) $msg = array();
				$msg[] = $new_msg;
				update_option('callie_britt_admin_messages', $msg);
			}
		}
	}
}

// Show internal admin messages
if ( !function_exists( 'callie_britt_show_admin_messages' ) ) {
	function callie_britt_show_admin_messages() {
		$msg = callie_britt_storage_get('admin_messages');
		if (!is_array($msg) || count($msg) == 0) return;
		?><div class="callie_britt_admin_messages"><?php
			foreach ($msg as $m) {
				?><div class="callie_britt_admin_message_item <?php echo esc_attr(str_replace('success', 'updated', $m['type'])); ?>">
					<p><?php echo wp_kses_data($m['message']); ?></p>
				</div><?php
			}
		?></div><?php
	}
}


//-------------------------------------------------------
//-- Styles and scripts
//-------------------------------------------------------
	
// Load inline styles
if ( !function_exists( 'callie_britt_admin_footer' ) ) {
	//Handler of the add_action('admin_footer', 'callie_britt_admin_footer');
	function callie_britt_admin_footer() {
		// Get current screen
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id=='nav-menus') {
			callie_britt_show_layout(callie_britt_show_custom_field('callie_britt_icons_popup',
													array(
														'type'	=> 'icons',
														'style'	=> callie_britt_get_theme_setting('icons_type'),
														'button'=> false,
														'icons'	=> true
													),
													null)
								);
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'callie_britt_admin_scripts' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'callie_britt_admin_scripts');
	function callie_britt_admin_scripts() {

		// Add theme styles
		wp_enqueue_style(  'callie-britt-admin',  callie_britt_get_file_url('css/admin.css'), array(), null );

		// Links to selected fonts
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen)) {
			if (callie_britt_options_override_allow(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
				// Load font icons
				wp_enqueue_style(  'callie-britt-icons', callie_britt_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
				wp_enqueue_style(  'callie-britt-icons-animation', callie_britt_get_file_url('css/font-icons/css/animation.css'), array(), null );
				// Load theme fonts
				$links = callie_britt_theme_fonts_links();
				if (count($links) > 0) {
					foreach ($links as $slug => $link) {
						wp_enqueue_style( sprintf('callie-britt-font-%s', $slug), $link, array(), null );
					}
				}
			} else if (apply_filters('callie_britt_filter_allow_theme_icons', is_customize_preview() || $screen->id=='nav-menus', !empty($screen->post_type) ? $screen->post_type : $screen->id)) {
				// Load font icons
				wp_enqueue_style(  'callie-britt-icons', callie_britt_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			}
		}

		// Add theme scripts
		wp_enqueue_script( 'callie-britt-utils', callie_britt_get_file_url('js/theme-utils.js'), array('jquery'), null, true );
		wp_enqueue_script( 'callie-britt-admin', callie_britt_get_file_url('js/theme-admin.js'), array('jquery'), null, true );
	}
}
	
// Add variables in the admin mode
if ( !function_exists( 'callie_britt_admin_localize_scripts' ) ) {
	//Handler of the add_action("admin_footer", 'callie_britt_admin_localize_scripts');
	function callie_britt_admin_localize_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		wp_localize_script( 'callie-britt-admin', 'CALLIE_BRITT_STORAGE', apply_filters( 'callie_britt_filter_localize_script_admin', array(
			'admin_mode' => true,
			'screen_id' => is_object($screen) ? esc_attr($screen->id) : '',
			'user_logged_in' => true,
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			'msg_ajax_error' => esc_html__('Server response error', 'callie-britt'),
			'msg_icon_selector' => esc_html__('Select the icon for this menu item', 'callie-britt'),
			'msg_scheme_reset' => esc_html__('Reset all changes of the current color scheme?', 'callie-britt'),
			'msg_scheme_copy' => esc_html__('Enter the name for a new color scheme', 'callie-britt'),
			'msg_scheme_delete' => esc_html__('Do you really want to delete the current color scheme?', 'callie-britt'),
			'msg_scheme_delete_last' => esc_html__('You cannot delete the last color scheme!', 'callie-britt'),
			'msg_scheme_delete_internal' => esc_html__('You cannot delete the built-in color scheme!', 'callie-britt')
			))
		);
	}
}



//-------------------------------------------------------
//-- Third party plugins
//-------------------------------------------------------

// Register optional plugins
if ( !function_exists( 'callie_britt_register_plugins' ) ) {
	//Handler of the add_action('tgmpa_register', 'callie_britt_register_plugins');
	function callie_britt_register_plugins() {
		tgmpa(	apply_filters('callie_britt_filter_tgmpa_required_plugins', array(
				// Plugins to include in the autoinstall queue.
				)),
				array(
					'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
					'default_path' => '',                      // Default absolute path to bundled plugins.
					'menu'         => 'tgmpa-install-plugins', // Menu slug.
					'parent_slug'  => 'themes.php',            // Parent menu slug.
					'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
					'has_notices'  => true,                    // Show admin notices or not.
					'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
					'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
					'is_automatic' => false,                   // Automatically activate plugins after installation or not.
					'message'      => ''                       // Message to output right before the plugins table.
				)
			);
	}
}
?>