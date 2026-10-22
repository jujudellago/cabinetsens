<?php
define( 'BRIDGE_QODE', true );
define('QODE_ROOT', get_template_directory_uri());
define('QODE_ROOT_DIR', get_template_directory());
if ( ! defined( 'BRIDGE_THEME_VERSION' ) ) {
	define( 'BRIDGE_THEME_VERSION', '30.9.1' );
}
define('QODE_VAR_PREFIX', 'qode_');
define('QODE_FRAMEWORK_ROOT', get_template_directory_uri().'/framework');
define('QODE_FRAMEWORK_ROOT_DIR', get_template_directory().'/framework');
define('QODE_FRAMEWORK_ADMIN_ASSETS_ROOT', get_template_directory_uri() . '/framework/admin/assets' );
define('QODE_SHORTCODES_ROOT_DIR', get_template_directory().'/includes/shortcodes/shortcode-elements');
define('QODE_FRAMEWORK_MODULES_ROOT', get_template_directory_uri().'/framework/modules');
define('QODE_FRAMEWORK_MODULES_ROOT_DIR', get_template_directory().'/framework/modules');
define('QODE_INCLUDES_ROOT', QODE_ROOT . '/includes');
define('QODE_INCLUDES_ROOT_DIR', QODE_ROOT_DIR . '/includes');

include_once( QODE_INCLUDES_ROOT_DIR . '/qode-fallback-helper-functions.php' );
include_once( QODE_FRAMEWORK_ROOT_DIR . '/qode-framework.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-breadcrumbs.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-blog-helper-functions.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/nav_menu/qode-menu.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/sidebar/qode-custom-sidebar.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-plugin-helper-functions.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-custom-taxonomy-field.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-gradient-helper-functions.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-loading-spinners.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-related-posts.php' );
/* Include comment functionality */
include_once( QODE_INCLUDES_ROOT_DIR . '/comment/comment.php' );
/* Include sidebar functionality */
include_once( QODE_INCLUDES_ROOT_DIR . '/sidebar/sidebar.php' );
/* Include pagination functionality */
include_once( QODE_INCLUDES_ROOT_DIR . '/pagination/pagination.php' );
/* Include qode carousel select box for visual composer */
/* Include font awesome icons list */
include_once( QODE_INCLUDES_ROOT_DIR . '/font_awesome/font-awesome.php' );
/** Include the TGM_Plugin_Activation class. */
require_once( QODE_INCLUDES_ROOT_DIR . '/plugins/class-tgm-plugin-activation.php' );
/* Include plugins activation file */
include_once( QODE_INCLUDES_ROOT_DIR . '/plugins/plugins-activation.php' );
include_once( QODE_ROOT_DIR . '/css/custom-styles/general-custom-styles.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-dynamic-helper-functions.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-dynamic-assets.php' );
include_once( QODE_INCLUDES_ROOT_DIR . '/qode-portfolio-archive.php' );

if ( ! function_exists( 'bridge_qode_is_rest_request' ) ) {
	/**
	 * Detect REST API requests before REST_REQUEST is defined.
	 *
	 * WordPress sets REST_REQUEST in rest_api_loaded() during parse_request,
	 * which runs after after_setup_theme. URI / rest_route checks work this early.
	 *
	 * @return bool
	 */
	function bridge_qode_is_rest_request() {
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return true;
		}

		if ( function_exists( 'wp_is_serving_rest_request' ) && wp_is_serving_rest_request() ) {
			return true;
		}

		if ( isset( $_GET['rest_route'] ) || isset( $_REQUEST['rest_route'] ) ) {
			return true;
		}

		$uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
		if ( $uri === '' ) {
			return false;
		}

		$prefix = 'wp-json';
		if ( function_exists( 'rest_get_url_prefix' ) ) {
			$prefix = rest_get_url_prefix();
		}

		$path = wp_parse_url( $uri, PHP_URL_PATH );
		if ( ! is_string( $path ) ) {
			$path = $uri;
		}

		return (bool) preg_match( '#/' . preg_quote( $prefix, '#' ) . '(/|$)#', $path );
	}
}

if ( ! function_exists( 'bridge_qode_is_session_blocked_request' ) ) {
	/**
	 * Requests that must never open a PHP session (locking / Site Health / loopback).
	 *
	 * @return bool
	 */
	function bridge_qode_is_session_blocked_request() {
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return true;
		}

		if ( defined( 'WP_INSTALLING' ) && WP_INSTALLING ) {
			return true;
		}

		if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) {
			return true;
		}

		if ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) {
			return true;
		}

		if ( bridge_qode_is_rest_request() ) {
			return true;
		}

		// wp-admin HTML (including Site Health). admin-ajax.php still allowed below.
		if ( is_admin() && ! ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) ) {
			return true;
		}

		if ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
			$action = isset( $_REQUEST['action'] ) ? (string) $_REQUEST['action'] : '';
			if ( in_array( $action, array( 'heartbeat', 'wp-compression-test', 'health-check-site-status-result' ), true ) ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'bridge_qode_request_needs_session_write' ) ) {
	/**
	 * AJAX actions that store booking / compare data in $_SESSION.
	 *
	 * @return bool
	 */
	function bridge_qode_request_needs_session_write() {
		$action = isset( $_REQUEST['action'] ) ? (string) $_REQUEST['action'] : '';
		if ( $action === '' ) {
			return false;
		}

		$write_actions = apply_filters(
			'bridge_qode_session_write_actions',
			array(
				'qodef_re_handle_add_to_compare',
				'qodef_re_handle_clear_compare_list',
				'qodef_re_refresh_compare_popup',
				'check_tour_booking',
				'qode_tours_check_availability',
				'check_hotel_room_booking',
				'check_hotel_room_session_update',
			)
		);

		return in_array( $action, $write_actions, true );
	}
}

if ( ! function_exists( 'bridge_qode_maybe_start_session' ) ) {
	/**
	 * Start a PHP session only when this request actually needs one.
	 *
	 * Read-only front requests use read_and_close so the session file lock is
	 * released immediately and concurrent REST / ads / editor requests are not blocked.
	 *
	 * @param bool $write Whether this request will write to $_SESSION.
	 *
	 * @return bool
	 */
	function bridge_qode_maybe_start_session( $write = false ) {
		if ( headers_sent() ) {
			return false;
		}

		if ( bridge_qode_is_session_blocked_request() ) {
			return false;
		}

		if ( ! $write ) {
			$write = bridge_qode_request_needs_session_write();
		}

		if ( session_status() === PHP_SESSION_ACTIVE ) {
			return true;
		}

		if ( session_status() !== PHP_SESSION_NONE ) {
			return false;
		}

		// Do not create a new session on every page load. Existing compare / booking
		// / page-transition previews already sent a session cookie.
		if ( ! $write && empty( $_COOKIE[ session_name() ] ) ) {
			return false;
		}

		if ( ! $write && PHP_VERSION_ID >= 70000 ) {
			return session_start( array( 'read_and_close' => true ) );
		}

		return session_start();
	}

	add_action( 'after_setup_theme', 'bridge_qode_maybe_start_session', 1 );
}