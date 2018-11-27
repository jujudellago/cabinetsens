<?php
/**
 * Skins support
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.46
 */

if (!defined("CALLIE_BRITT_SKIN_NAME"))	define("CALLIE_BRITT_SKIN_NAME", get_option(sprintf('theme_skin_%s', get_option('stylesheet')), CALLIE_BRITT_DEFAULT_SKIN));
if (!defined("CALLIE_BRITT_SKIN_DIR"))	define("CALLIE_BRITT_SKIN_DIR",  'skins/' . trailingslashit(CALLIE_BRITT_SKIN_NAME));

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
if ( !function_exists('callie_britt_skins_theme_setup1') ) {
	add_action( 'after_setup_theme', 'callie_britt_skins_theme_setup1', 1 );
	function callie_britt_skins_theme_setup1() {
		callie_britt_storage_set('skins', apply_filters('callie_britt_filter_skins_list', array(
											'default' => array(
																'title' => esc_html__('Default', 'callie-britt'),
																'description' => '',
																'image' => 'skin.jpg',
																'demo_url' => '//trex3.dev.themerex.dnw/'
																),
											)));
	}
}



// Add skins folder to the theme-specific file search
//------------------------------------------------------------

// Check if file exists in the skin folder and return its path or empty string if file is not found
if ( !function_exists('callie_britt_skins_get_file_dir') ) {
	function callie_britt_skins_get_file_dir($file, $skin=CALLIE_BRITT_SKIN_NAME, $return_url=false) {
		$dir = '';
		$skin_dir = 'skins/' . trailingslashit($skin);
		if (file_exists(CALLIE_BRITT_CHILD_DIR . ($skin_dir) . ($file)))
			$dir = ($return_url ? CALLIE_BRITT_CHILD_URL : CALLIE_BRITT_CHILD_DIR) . ($skin_dir) . callie_britt_check_min_file($file, CALLIE_BRITT_CHILD_DIR . ($skin_dir));
		else if (file_exists(CALLIE_BRITT_THEME_DIR . ($skin_dir) . ($file)))
			$dir = ($return_url ? CALLIE_BRITT_THEME_URL : CALLIE_BRITT_THEME_DIR) . ($skin_dir) . callie_britt_check_min_file($file, CALLIE_BRITT_THEME_DIR . ($skin_dir));
		return $dir;
	}
}

// Check if file exists in the skin folder and return its url or empty string if file is not found
if ( !function_exists('callie_britt_skins_get_file_url') ) {
	function callie_britt_skins_get_file_url($file, $skin=CALLIE_BRITT_SKIN_NAME) {
		return callie_britt_skins_get_file_dir($file, $skin, true);
	}
}


// Add skins folder to the theme-specific files search
if ( !function_exists('callie_britt_skins_get_theme_file_dir') ) {
	add_filter('callie_britt_filter_get_theme_file_dir', 'callie_britt_skins_get_theme_file_dir', 10, 3);
	function callie_britt_skins_get_theme_file_dir($dir, $file, $return_url=false) {
		return callie_britt_skins_get_file_dir($file, CALLIE_BRITT_SKIN_NAME, $return_url);
	}
}


// Check if folder exists in the current skin folder and return its path or empty string if the folder is not found
if ( !function_exists('callie_britt_skins_get_folder_dir') ) {
	function callie_britt_skins_get_theme_folder_dir($folder, $skin=CALLIE_BRITT_SKIN_NAME, $return_url=false) {
		$dir = '';
		$skin_dir = 'skins/' . trailingslashit($skin);
		if (BASEKIR_ALLOW_SKINS && is_dir(CALLIE_BRITT_CHILD_DIR . ($skin_dir) . ($folder)))
			$dir = ($return_url ? CALLIE_BRITT_CHILD_URL : CALLIE_BRITT_CHILD_DIR) . ($skin_dir) . ($folder);
		else if (BASEKIR_ALLOW_SKINS && is_dir(CALLIE_BRITT_THEME_DIR . ($skin_dir) . ($folder)))
			$dir = ($return_url ? CALLIE_BRITT_THEME_URL : CALLIE_BRITT_THEME_DIR) . ($skin_dir) . ($folder);
		return $dir;
	}
}

// Check if folder exists in the skin folder and return its url or empty string if folder is not found
if ( !function_exists('callie_britt_skins_get_folder_url') ) {
	function callie_britt_skins_get_folder_url($folder, $skin=CALLIE_BRITT_SKIN_NAME) {
		return callie_britt_skins_get_folder_dir($folder, $skin, true);
	}
}

// Add skins folder to the theme-specific folders search
if ( !function_exists('callie_britt_skins_get_theme_folder_dir') ) {
	add_filter('callie_britt_filter_get_theme_folder_dir', 'callie_britt_skins_get_theme_folder_dir', 10, 3);
	function callie_britt_skins_get_theme_folder_dir($dir, $folder, $return_url=false) {
		return callie_britt_skins_get_folder_dir($folder, CALLIE_BRITT_SKIN_NAME, $return_url);
	}
}


// Add skins folder to the get_template_part
if ( !function_exists('callie_britt_skins_get_template_part') ) {
	add_filter('callie_britt_filter_get_template_part', 'callie_britt_skins_get_template_part', 10, 2);
	function callie_britt_skins_get_template_part($slug, $part='') {
		if (!empty($part)) $part = "-{$part}";
		if (callie_britt_skins_get_file_dir("{$slug}{$part}.php") != '')
			$slug = sprintf('skins/%s/%s', CALLIE_BRITT_SKIN_NAME, $slug);
		return $slug;
	}
}



// Add tab with skins to the 'About theme' page
//------------------------------------------------------

// Add tab link 'Skins'
if ( !function_exists('callie_britt_skins_add_tab_to_about_theme') ) {
	add_action('callie_britt_action_theme_about_before_tabs_list', 'callie_britt_skins_add_tab_to_about_theme', 10, 1);
	function callie_britt_skins_add_tab_to_about_theme($theme) {
		?><li><a href="#callie_britt_about_section_skins"><?php esc_html_e('Choose skin', 'callie-britt'); ?></a></li><?php
	}
}


// Add tab section with skins
if ( !function_exists('callie_britt_skins_add_section_to_about_theme') ) {
	add_action('callie_britt_action_theme_about_before_tabs_sections', 'callie_britt_skins_add_section_to_about_theme', 10, 1);
	function callie_britt_skins_add_section_to_about_theme($theme) {
		?><div id="callie_britt_about_section_skins" class="callie_britt_tabs_section callie_britt_about_section"><?php
			$skins = callie_britt_storage_get('skins');
			foreach ($skins as $skin => $data) {
				?><div class="callie_britt_about_block"><div class="callie_britt_about_block_inner"><?php
					// Skin title
					if (!empty($data['title'])) {
						?><h2 class="callie_britt_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php echo esc_html($data['title']); ?>
						</h2><?php
					}
					// Skin image
					if ( ($img = callie_britt_skins_get_file_url($data['image'], $skin)) != '' ) {
						?><img src="<?php echo esc_url($img); ?>" class="callie_britt_about_block_image" alt="<?php echo esc_attr($data['title']); ?>"><?php
					}
					// Skin description
					if ( !empty($data['description'])) {
						?><div class="callie_britt_about_block_description"><?php
							echo wp_kses_post($data['description']);
						?></div><?php
					}
					// Link to choose skin
					if ($skin == CALLIE_BRITT_SKIN_NAME) {
						?><span class="callie_britt_about_block_link button button-action callie_britt_about_block_link_active"><?php
							esc_html_e('Active skin', 'callie-britt');
						?></span><?php
					} else {
						?><a href="#"
							class="callie_britt_about_block_link callie_britt_about_block_link_choose_skin button button-primary"
							data-skin="<?php echo esc_attr($skin); ?>"
						><?php
							esc_html_e('Choose skin', 'callie-britt');
						?></a><?php
					}
					// Link to demo site
					if ( !empty($data['demo_url'])) {
						?><a href="<?php echo esc_url($data['demo_url']); ?>" class="callie_britt_about_block_link callie_britt_about_block_link_view_demo button" target="_blank"><?php
							esc_html_e('View demo', 'callie-britt');
						?></a><?php
					}
				?></div></div><?php
			}
		?></div><?php
	}
}


// Load page-specific scripts and styles
if (!function_exists('callie_britt_skins_about_enqueue_scripts')) {
	add_action( 'admin_enqueue_scripts', 'callie_britt_skins_about_enqueue_scripts' );
	function callie_britt_skins_about_enqueue_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id == 'appearance_page_callie_britt_about') {
			//wp_enqueue_style(  'callie-britt-skins-admin', callie_britt_get_file_url('skins/skins-admin.css'), array(), null );
			wp_enqueue_script( 'callie-britt-skins-admin', callie_britt_get_file_url('skins/skins-admin.js'), array('jquery'), null, true );
		}
	}
}

// Add page-specific vars to the localize array
if (!function_exists('callie_britt_skins_localize_script')) {
	add_filter( 'callie_britt_filter_localize_script_admin','callie_britt_skins_localize_script' );
	function callie_britt_skins_localize_script($arr) {
		$arr['msg_switch_skin'] = esc_html__("Attention!\nIf you choose a new skin,\nyou will have changed theme options,\nyou may be asked to install additional plugins\nif they are used in the new skin!", 'callie-britt');
		$arr['msg_switch_skin_success'] = esc_html__('A new skin is selected. The page will be reloaded.', 'callie-britt');
		return $arr;
	}
}

// AJAX handler for the 'callie_britt_switch_skin' action
if ( !function_exists( 'callie_britt_skins_ajax_switch_skin' ) ) {
	add_action('wp_ajax_callie_britt_switch_skin', 'callie_britt_skins_ajax_switch_skin');
	function callie_britt_skins_ajax_switch_skin() {

		if ( !wp_verify_nonce( callie_britt_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
	
		$response = array('error' => '');

		$skin = callie_britt_get_value_gp('skin');
		$skins = callie_britt_storage_get('skins');

		if (empty($skin) || !isset($skins[$skin]) || $skin==CALLIE_BRITT_SKIN_NAME) {
			// Translators: Add the skin's name to the message
			$response['error'] = sprintf(__("Can not switch to the skin %s", 'callie-britt'), $skin);
		} else {
			// Get current theme slug
			$theme_slug = get_option('stylesheet');
			// Get options from new skin
			if ( !($skin_mods = get_option(sprintf('theme_mods_%1$s_skin_%2$s', $theme_slug, $skin), false)) ) {
				require_once CALLIE_BRITT_THEME_DIR . 'skins/skins-options.php';
				if (isset($skins_options[$skin])) {
					$skin_mods = callie_britt_unserialize($skins_options[$skin]['options']);
				}
			}
			if ( $skin_mods !== false ) {
				// Save current options
				update_option(sprintf('theme_mods_%1$s_skin_%2$s', $theme_slug, CALLIE_BRITT_SKIN_NAME), get_theme_mods());
				// Replace theme mods with options from new skin
				callie_britt_options_update($skin_mods);
				// Replace current skin
				update_option(sprintf('theme_skin_%s', $theme_slug), $skin);
			} else {
				$response['error'] = esc_html__("Options of the new skin are not found!", 'callie-britt');
			}
		}

		echo json_encode($response);
		die();
	}
}


// One-click import support
//------------------------------------------------------------------------

// Export custom layouts
if ( !function_exists( 'callie_britt_skins_importer_export' ) ) {
	if (is_admin()) add_action( 'trx_addons_action_importer_export', 'callie_britt_skins_importer_export', 10, 1 );
	function callie_britt_skins_importer_export($importer) {
		$skins = callie_britt_storage_get('skins');
		$output = '';
		if (is_array($skins) && count($skins) > 0) {
			$output = "<?php"
						. "\n//" . esc_html__('Skins', 'callie-britt')
						. "\n\$skins_options = array(";
			$counter = 0;
			$theme_mods = get_theme_mods();
			$theme_slug = get_option('stylesheet');
			foreach ($skins as $skin=>$skin_data) {
				if ( ($options = get_option(sprintf('theme_mods_%1$s_skin_%2$s', $theme_slug, $skin), false)) === false)
					$options = $theme_mods;
				$output .= ($counter++ ? ',' : '') 
						. "\n\t\t'{$skin}' => array("
						. "\n\t\t\t\t'options' => " . '"' . addslashes(serialize(apply_filters('callie_britt_filter_export_skin_options', $options, $skin))) . '"'
						. "\n\t\t\t\t)";
			}
			$output .= "\n\t\t);"
					.  "\n?>";
		}
		callie_britt_fpc($importer->export_file_dir('skins.txt'), $output);
	}
}

// Display exported data in the fields
if ( !function_exists( 'callie_britt_skins_importer_export_fields' ) ) {
	if (is_admin()) add_action( 'trx_addons_action_importer_export_fields',	'callie_britt_skins_importer_export_fields', 12, 1 );
	function callie_britt_skins_importer_export_fields($importer) {
		$importer->show_exporter_fields(array(
			'slug'	=> 'skins',
			'title' => esc_html__('Skins', 'callie-britt'),
			'download' => 'skins-options.php'
			)
		);
	}
}


// Load file with current skin
if ( ($callie_britt_skin_file = callie_britt_skins_get_file_dir('skin.php')) != '' ) {
	require_once $callie_britt_skin_file;
}
?>