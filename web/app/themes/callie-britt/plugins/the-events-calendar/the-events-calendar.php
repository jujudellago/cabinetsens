<?php
/* Tribe Events Calendar support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('callie_britt_tribe_events_theme_setup1')) {
	add_action( 'after_setup_theme', 'callie_britt_tribe_events_theme_setup1', 1 );
	function callie_britt_tribe_events_theme_setup1() {
		add_filter( 'callie_britt_filter_list_sidebars', 'callie_britt_tribe_events_list_sidebars' );
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('callie_britt_tribe_events_theme_setup3')) {
	add_action( 'after_setup_theme', 'callie_britt_tribe_events_theme_setup3', 3 );
	function callie_britt_tribe_events_theme_setup3() {
		if (callie_britt_exists_tribe_events()) {
		
			// Section 'Tribe Events'
			callie_britt_storage_merge_array('options', '', array_merge(
				array(
					'events' => array(
						"title" => esc_html__('Events', 'callie-britt'),
						"desc" => wp_kses_data( __('Select parameters to display the events pages', 'callie-britt') ),
						"type" => "section"
						)
				),
				callie_britt_options_get_list_cpt_options('events')
			));
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('callie_britt_tribe_events_theme_setup9')) {
	add_action( 'after_setup_theme', 'callie_britt_tribe_events_theme_setup9', 9 );
	function callie_britt_tribe_events_theme_setup9() {
		
		add_filter( 'callie_britt_filter_merge_styles',							'callie_britt_tribe_events_merge_styles' );
		add_filter( 'callie_britt_filter_merge_styles_responsive',				'callie_britt_tribe_events_merge_styles_responsive' );

		if (callie_britt_exists_tribe_events()) {
			add_action( 'wp_enqueue_scripts', 								'callie_britt_tribe_events_frontend_scripts', 1100 );
			add_filter( 'callie_britt_filter_post_type_taxonomy',				'callie_britt_tribe_events_post_type_taxonomy', 10, 2 );
			if (!is_admin()) {
				add_filter( 'callie_britt_filter_detect_blog_mode',				'callie_britt_tribe_events_detect_blog_mode' );
				add_filter( 'callie_britt_filter_get_post_categories', 			'callie_britt_tribe_events_get_post_categories');
				add_filter( 'callie_britt_filter_get_post_date',		 			'callie_britt_tribe_events_get_post_date');
			}
		}
		if (is_admin()) {
			add_filter( 'callie_britt_filter_tgmpa_required_plugins',			'callie_britt_tribe_events_tgmpa_required_plugins' );
		}

	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'callie_britt_tribe_events_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('callie_britt_filter_tgmpa_required_plugins',	'callie_britt_tribe_events_tgmpa_required_plugins');
	function callie_britt_tribe_events_tgmpa_required_plugins($list=array()) {
		if (callie_britt_storage_isset('required_plugins', 'the-events-calendar')) {
			$list[] = array(
					'name' 		=> callie_britt_storage_get_array('required_plugins', 'the-events-calendar'),
					'slug' 		=> 'the-events-calendar',
					'required' 	=> false
				);
		}
		return $list;
	}
}


// Remove 'Tribe Events' section from Customizer
if (!function_exists('callie_britt_tribe_events_customizer_register_controls')) {
	add_action( 'customize_register', 'callie_britt_tribe_events_customizer_register_controls', 100 );
	function callie_britt_tribe_events_customizer_register_controls( $wp_customize ) {
		$wp_customize->remove_panel( 'tribe_customizer');
	}
}


// Check if Tribe Events is installed and activated
if ( !function_exists( 'callie_britt_exists_tribe_events' ) ) {
	function callie_britt_exists_tribe_events() {
		return class_exists( 'Tribe__Events__Main' );
	}
}

// Return true, if current page is any tribe_events page
if ( !function_exists( 'callie_britt_is_tribe_events_page' ) ) {
	function callie_britt_is_tribe_events_page() {
		$rez = false;
		if (callie_britt_exists_tribe_events())
			if (!is_search()) $rez = tribe_is_event() || tribe_is_event_query() || tribe_is_event_category() || tribe_is_event_venue() || tribe_is_event_organizer();
		return $rez;
	}
}

// Detect current blog mode
if ( !function_exists( 'callie_britt_tribe_events_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'callie_britt_filter_detect_blog_mode', 'callie_britt_tribe_events_detect_blog_mode' );
	function callie_britt_tribe_events_detect_blog_mode($mode='') {
		if (callie_britt_is_tribe_events_page())
			$mode = 'events';
		return $mode;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'callie_britt_tribe_events_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'callie_britt_filter_post_type_taxonomy',	'callie_britt_tribe_events_post_type_taxonomy', 10, 2 );
	function callie_britt_tribe_events_post_type_taxonomy($tax='', $post_type='') {
		if (callie_britt_exists_tribe_events() && $post_type == Tribe__Events__Main::POSTTYPE)
			$tax = Tribe__Events__Main::TAXONOMY;
		return $tax;
	}
}

// Show categories of the current event
if ( !function_exists( 'callie_britt_tribe_events_get_post_categories' ) ) {
	//Handler of the add_filter( 'callie_britt_filter_get_post_categories', 		'callie_britt_tribe_events_get_post_categories');
	function callie_britt_tribe_events_get_post_categories($cats='') {
		if (get_post_type() == Tribe__Events__Main::POSTTYPE)
			$cats = callie_britt_get_post_terms(', ', get_the_ID(), Tribe__Events__Main::TAXONOMY);
		return $cats;
	}
}

// Return date of the current event
if ( !function_exists( 'callie_britt_tribe_events_get_post_date' ) ) {
	//Handler of the add_filter( 'callie_britt_filter_get_post_date', 'callie_britt_tribe_events_get_post_date');
	function callie_britt_tribe_events_get_post_date($dt='') {
		if (get_post_type() == Tribe__Events__Main::POSTTYPE) {
			$dt = tribe_events_event_schedule_details( get_the_ID(), '', '' );
		}
		return $dt;
	}
}

// Enqueue Tribe Events custom scripts and styles
if ( !function_exists( 'callie_britt_tribe_events_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'callie_britt_tribe_events_frontend_scripts', 1100 );
	function callie_britt_tribe_events_frontend_scripts() {
		if (callie_britt_is_tribe_events_page()) {
			wp_deregister_style('tribe-events-custom-jquery-styles');
		}
	}
}

// Merge custom styles
if ( !function_exists( 'callie_britt_tribe_events_merge_styles' ) ) {
	//Handler of the add_filter('callie_britt_filter_merge_styles', 'callie_britt_tribe_events_merge_styles');
	function callie_britt_tribe_events_merge_styles($list) {
		if (callie_britt_exists_tribe_events()) {
			$list[] = 'plugins/the-events-calendar/_the-events-calendar.scss';
		}
		return $list;
	}
}


// Merge responsive styles
if ( !function_exists( 'callie_britt_tribe_events_merge_styles_responsive' ) ) {
	//Handler of the add_filter('callie_britt_filter_merge_styles_responsive', 'callie_britt_tribe_events_merge_styles_responsive');
	function callie_britt_tribe_events_merge_styles_responsive($list) {
		if (callie_britt_exists_tribe_events()) {
			$list[] = 'plugins/the-events-calendar/_the-events-calendar-responsive.scss';
		}
		return $list;
	}
}



// Add Tribe Events specific items into lists
//------------------------------------------------------------------------

// Add sidebar
if ( !function_exists( 'callie_britt_tribe_events_list_sidebars' ) ) {
	//Handler of the add_filter( 'callie_britt_filter_list_sidebars', 'callie_britt_tribe_events_list_sidebars' );
	function callie_britt_tribe_events_list_sidebars($list=array()) {
		$list['tribe_events_widgets'] = array(
											'name' => esc_html__('Tribe Events Widgets', 'callie-britt'),
											'description' => esc_html__('Widgets to be shown on the Tribe Events pages', 'callie-britt')
											);
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (callie_britt_exists_tribe_events()) { require_once CALLIE_BRITT_THEME_DIR . 'plugins/the-events-calendar/the-events-calendar-styles.php'; }
?>