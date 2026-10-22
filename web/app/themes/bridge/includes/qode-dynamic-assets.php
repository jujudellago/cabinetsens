<?php

if ( ! function_exists( 'bridge_qode_get_dynamic_assets_upload_dir' ) ) {
	/**
	 * Uploads location for generated dynamic CSS/JS.
	 * These files must live outside the theme folder so theme updates do not delete them.
	 *
	 * @return array {
	 *     @type string $basedir
	 *     @type string $baseurl
	 * }
	 */
	function bridge_qode_get_dynamic_assets_upload_dir() {
		$upload  = wp_upload_dir();
		$subdir  = apply_filters( 'bridge_qode_filter_dynamic_assets_upload_subdir', 'bridge' );
		$basedir = trailingslashit( $upload['basedir'] ) . $subdir;
		$baseurl = trailingslashit( $upload['baseurl'] ) . $subdir;

		return array(
			'basedir' => $basedir,
			'baseurl' => $baseurl,
			'error'   => ! empty( $upload['error'] ) ? $upload['error'] : '',
		);
	}
}

if ( ! function_exists( 'bridge_qode_get_dynamic_asset_map' ) ) {
	/**
	 * Metadata for each generated dynamic asset.
	 *
	 * @return array
	 */
	function bridge_qode_get_dynamic_asset_map() {
		$blog_id = function_exists( 'bridge_qode_get_multisite_blog_id' ) ? bridge_qode_get_multisite_blog_id() : 0;

		return array(
			'style_dynamic'            => array(
				'type'            => 'css',
				'wp_handle'       => 'bridge-style-dynamic',
				'filename'        => 'style_dynamic.css',
				'legacy_filename' => is_multisite() ? 'style_dynamic_ms_id_' . $blog_id . '.css' : 'style_dynamic.css',
				'legacy_dir'      => 'css',
				'callback'        => 'css/style_dynamic_callback.php',
				'source_php'      => 'css/style_dynamic.php',
			),
			'style_dynamic_responsive' => array(
				'type'            => 'css',
				'wp_handle'       => 'bridge-style-dynamic-responsive',
				'filename'        => 'style_dynamic_responsive.css',
				'legacy_filename' => is_multisite() ? 'style_dynamic_responsive_ms_id_' . $blog_id . '.css' : 'style_dynamic_responsive.css',
				'legacy_dir'      => 'css',
				'callback'        => 'css/style_dynamic_responsive_callback.php',
				'source_php'      => 'css/style_dynamic_responsive.php',
			),
			'default_dynamic'           => array(
				'type'            => 'js',
				'wp_handle'       => 'bridge-default-dynamic',
				'filename'        => 'default_dynamic.js',
				'legacy_filename' => is_multisite() ? 'default_dynamic_ms_id_' . $blog_id . '.js' : 'default_dynamic.js',
				'legacy_dir'      => 'js',
				'callback'        => 'js/default_dynamic_callback.php',
				'source_php'      => 'js/default_dynamic.php',
			),
		);
	}
}

if ( ! function_exists( 'bridge_qode_get_dynamic_asset_versioned_filename' ) ) {
	/**
	 * Host caches often key CSS/JS by path and ignore ?ver=.
	 * style_dynamic.css → style_dynamic-1791970988.css
	 *
	 * @param string $filename
	 * @param string $version
	 *
	 * @return string
	 */
	function bridge_qode_get_dynamic_asset_versioned_filename( $filename, $version ) {
		$version = preg_replace( '/[^0-9]/', '', (string) $version );
		if ( $version === '' || ! is_string( $filename ) || $filename === '' ) {
			return $filename;
		}

		$versioned = preg_replace( '/(\.[a-z0-9]+)$/i', '-' . $version . '$1', $filename, 1 );

		return is_string( $versioned ) ? $versioned : $filename;
	}
}

if ( ! function_exists( 'bridge_qode_cleanup_old_versioned_dynamic_assets' ) ) {
	/**
	 * Remove previous hashed copies so uploads/bridge does not grow on every Save.
	 *
	 * @param string $current_version
	 */
	function bridge_qode_cleanup_old_versioned_dynamic_assets( $current_version ) {
		$upload = bridge_qode_get_dynamic_assets_upload_dir();
		$dir    = isset( $upload['basedir'] ) ? $upload['basedir'] : '';
		if ( $dir === '' || ! is_dir( $dir ) ) {
			return;
		}

		foreach ( bridge_qode_get_dynamic_asset_map() as $asset ) {
			$keep      = bridge_qode_get_dynamic_asset_versioned_filename( $asset['filename'], $current_version );
			$base_name = preg_replace( '/\.[a-z0-9]+$/i', '', $asset['filename'] );
			$extension = pathinfo( $asset['filename'], PATHINFO_EXTENSION );
			if ( ! is_string( $base_name ) || $base_name === '' || $extension === '' ) {
				continue;
			}

			$files = glob( trailingslashit( $dir ) . $base_name . '-*.' . $extension );
			if ( ! is_array( $files ) ) {
				continue;
			}

			foreach ( $files as $file ) {
				if ( basename( $file ) !== $keep ) {
					@unlink( $file );
				}
			}
		}
	}
}

if ( ! function_exists( 'bridge_qode_is_dynamic_asset_file_usable' ) ) {
	/**
	 * Generated files must exist, be readable and not empty.
	 * Writable-folder checks are intentionally not required for serving files.
	 *
	 * @param string $path
	 *
	 * @return bool
	 */
	function bridge_qode_is_dynamic_asset_file_usable( $path ) {
		return is_string( $path ) && $path !== '' && file_exists( $path ) && is_readable( $path ) && filesize( $path ) > 0;
	}
}

if ( ! function_exists( 'bridge_qode_prepare_dynamic_assets_upload_dir' ) ) {
	/**
	 * Create uploads/bridge and add basic hardening files.
	 *
	 * @return bool
	 */
	function bridge_qode_prepare_dynamic_assets_upload_dir() {
		$dir = bridge_qode_get_dynamic_assets_upload_dir();

		if ( ! empty( $dir['error'] ) ) {
			return false;
		}

		if ( ! is_dir( $dir['basedir'] ) && ! wp_mkdir_p( $dir['basedir'] ) ) {
			return false;
		}

		if ( ! is_writable( $dir['basedir'] ) ) {
			return false;
		}

		$index_file = trailingslashit( $dir['basedir'] ) . 'index.php';
		if ( ! file_exists( $index_file ) ) {
			file_put_contents( $index_file, "<?php\n// Silence is golden.\n" );
		}

		$htaccess_file = trailingslashit( $dir['basedir'] ) . '.htaccess';
		if ( ! file_exists( $htaccess_file ) ) {
			file_put_contents( $htaccess_file, "<Files *.php>\ndeny from all\n</Files>\n" );
		}

		return true;
	}
}

if ( ! function_exists( 'bridge_qode_is_dynamic_assets_upload_writable' ) ) {
	function bridge_qode_is_dynamic_assets_upload_writable() {
		return bridge_qode_prepare_dynamic_assets_upload_dir();
	}
}

if ( ! function_exists( 'bridge_qode_get_dynamic_asset_version' ) ) {
	/**
	 * Cache-bust with parent theme version plus filemtime / stored generation time.
	 * No extra Qode Options control is needed: Save and theme updates already regenerate files.
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	function bridge_qode_get_dynamic_asset_version( $path = '' ) {
		$version_parts = array( BRIDGE_THEME_VERSION );

		if ( bridge_qode_is_dynamic_asset_file_usable( $path ) ) {
			$version_parts[] = (string) filemtime( $path );
		}

		$stored_version = get_option( 'qode_dynamic_assets_version' );
		if ( ! empty( $stored_version ) ) {
			$version_parts[] = (string) $stored_version;
		}

		return implode( '-', array_unique( $version_parts ) );
	}
}

if ( ! function_exists( 'bridge_qode_get_dynamic_asset' ) ) {
	/**
	 * Resolve which file should be served.
	 *
	 * Priority:
	 * 1. newer of theme-folder vs uploads/bridge (theme URLs stay if that copy is current)
	 * 2. PHP callback fallback
	 *
	 * Existing theme-folder files are never deleted.
	 *
	 * @param string $key
	 *
	 * @return array|false
	 */
	function bridge_qode_get_dynamic_asset( $key ) {
		$map = bridge_qode_get_dynamic_asset_map();

		if ( empty( $map[ $key ] ) ) {
			return false;
		}

		$asset       = $map[ $key ];
		$upload      = bridge_qode_get_dynamic_assets_upload_dir();
		$upload_path = trailingslashit( $upload['basedir'] ) . $asset['filename'];
		$legacy_path = trailingslashit( QODE_ROOT_DIR ) . $asset['legacy_dir'] . '/' . $asset['legacy_filename'];
		$legacy_ok   = bridge_qode_is_dynamic_asset_file_usable( $legacy_path );
		$upload_ok   = bridge_qode_is_dynamic_asset_file_usable( $upload_path );
		$stored_ver  = get_option( 'qode_dynamic_assets_version' );
		$hashed_name = bridge_qode_get_dynamic_asset_versioned_filename( $asset['filename'], $stored_ver );
		$hashed_path = trailingslashit( $upload['basedir'] ) . $hashed_name;
		$hashed_ok   = ( $hashed_name !== $asset['filename'] ) && bridge_qode_is_dynamic_asset_file_usable( $hashed_path );

		// Unique filename in uploads so host/CDN caches that ignore ?ver= cannot keep an old body.
		if ( $hashed_ok ) {
			return array(
				'source'  => 'uploads',
				'path'    => $hashed_path,
				'url'     => trailingslashit( $upload['baseurl'] ) . $hashed_name,
				'version' => bridge_qode_get_dynamic_asset_version( $hashed_path ),
				'asset'   => $asset,
			);
		}

		// Prefer the newer copy. Theme files keep current URLs when they are current;
		// uploads wins after a theme update or when the theme folder is not writable.
		$use_uploads = $upload_ok && ( ! $legacy_ok || filemtime( $upload_path ) > filemtime( $legacy_path ) );

		if ( $use_uploads ) {
			return array(
				'source'  => 'uploads',
				'path'    => $upload_path,
				'url'     => trailingslashit( $upload['baseurl'] ) . $asset['filename'],
				'version' => bridge_qode_get_dynamic_asset_version( $upload_path ),
				'asset'   => $asset,
			);
		}

		if ( $legacy_ok ) {
			return array(
				'source'  => 'theme',
				'path'    => $legacy_path,
				'url'     => trailingslashit( QODE_ROOT ) . $asset['legacy_dir'] . '/' . $asset['legacy_filename'],
				'version' => bridge_qode_get_dynamic_asset_version( $legacy_path ),
				'asset'   => $asset,
			);
		}

		return array(
			'source'  => 'callback',
			'path'    => trailingslashit( QODE_ROOT_DIR ) . $asset['callback'],
			'url'     => trailingslashit( QODE_ROOT ) . $asset['callback'],
			'version' => BRIDGE_THEME_VERSION,
			'asset'   => $asset,
		);
	}
}

if ( ! function_exists( 'bridge_qode_enqueue_dynamic_style' ) ) {
	function bridge_qode_enqueue_dynamic_style( $key ) {
		$resolved = bridge_qode_get_dynamic_asset( $key );

		if ( empty( $resolved ) ) {
			return;
		}

		wp_enqueue_style( $resolved['asset']['wp_handle'], $resolved['url'], array(), $resolved['version'] );
	}
}

if ( ! function_exists( 'bridge_qode_enqueue_dynamic_script' ) ) {
	function bridge_qode_enqueue_dynamic_script( $key, $deps = array( 'jquery' ), $in_footer = true ) {
		$resolved = bridge_qode_get_dynamic_asset( $key );

		if ( empty( $resolved ) ) {
			return;
		}

		wp_enqueue_script( $resolved['asset']['wp_handle'], $resolved['url'], $deps, $resolved['version'], $in_footer );

		if ( $key === 'default_dynamic' ) {
			wp_add_inline_script( $resolved['asset']['wp_handle'], bridge_qode_get_dynamic_js_fallback(), 'before' );
		}
	}
}

if ( ! function_exists( 'bridge_qode_get_dynamic_js_fallback' ) ) {
	/**
	 * Prevent header/menu JS from throwing if default_dynamic fails to load.
	 *
	 * @return string
	 */
	function bridge_qode_get_dynamic_js_fallback() {
		return 'if(typeof header_height==="undefined"){var header_height=100;}if(typeof min_header_height_scroll==="undefined"){var min_header_height_scroll=57;}if(typeof min_header_height_fixed_hidden==="undefined"){var min_header_height_fixed_hidden=50;}if(typeof min_header_height_sticky==="undefined"){var min_header_height_sticky=60;}if(typeof scroll_amount_for_sticky==="undefined"){var scroll_amount_for_sticky=85;}if(typeof content_line_height==="undefined"){var content_line_height=60;}if(typeof header_bottom_border_weight==="undefined"){var header_bottom_border_weight=1;}if(typeof scroll_amount_for_fixed_hiding==="undefined"){var scroll_amount_for_fixed_hiding=200;}if(typeof paspartu_width_init==="undefined"){var paspartu_width_init=0.02;}if(typeof header_top_height==="undefined"){var header_top_height=0;}if(typeof logo_height==="undefined"){var logo_height=130;}if(typeof logo_width==="undefined"){var logo_width=280;}';
	}
}

if ( ! function_exists( 'bridge_qode_write_dynamic_asset_file' ) ) {
	/**
	 * @param string $path
	 * @param string $contents
	 *
	 * @return bool
	 */
	function bridge_qode_write_dynamic_asset_file( $path, $contents ) {
		if ( $contents === '' || $contents === null ) {
			return false;
		}

		$dir = dirname( $path );
		if ( ! is_dir( $dir ) && ! wp_mkdir_p( $dir ) ) {
			return false;
		}

		if ( ! is_writable( $dir ) ) {
			return false;
		}

		$written = @file_put_contents( $path, $contents, LOCK_EX );
		if ( $written === false ) {
			$written = @file_put_contents( $path, $contents );
		}

		return $written !== false && bridge_qode_is_dynamic_asset_file_usable( $path );
	}
}

if ( ! function_exists( 'bridge_qode_get_dynamic_asset_generated_contents' ) ) {
	/**
	 * @param string $relative_php
	 *
	 * @return string
	 */
	function bridge_qode_get_dynamic_asset_generated_contents( $relative_php ) {
		$file = trailingslashit( QODE_ROOT_DIR ) . ltrim( $relative_php, '/' );

		if ( ! file_exists( $file ) ) {
			return '';
		}

		$previous_reporting = error_reporting( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR );
		ob_start();
		include $file;
		$contents = (string) ob_get_clean();
		error_reporting( $previous_reporting );

		return $contents;
	}
}

if ( ! function_exists( 'bridge_qode_generate_dynamic_css_and_js' ) ) {
	/**
	 * Generate static dynamic assets.
	 * Writes to uploads first (survives updates), then also to the theme folder when writable
	 * so already-cached HTML that still points at the old theme URLs keeps working.
	 *
	 * @param bool $overwrite_legacy When false, existing theme-folder files are left untouched.
	 *                               Auto-regenerate uses false so a first admin visit cannot
	 *                               replace working client files with a partial generate.
	 *
	 * @return array
	 */
	function bridge_qode_generate_dynamic_css_and_js( $overwrite_legacy = true ) {
		static $already_ran = false;
		static $last_result = null;

		if ( $already_ran && is_array( $last_result ) ) {
			return $last_result;
		}

		$already_ran = true;

		global $bridge_qode_options;

		if ( ! is_array( $bridge_qode_options ) ) {
			$bridge_qode_options = get_option( 'qode_options_proya' );
		}

		$map           = bridge_qode_get_dynamic_asset_map();
		$upload        = bridge_qode_get_dynamic_assets_upload_dir();
		$upload_ready  = bridge_qode_prepare_dynamic_assets_upload_dir();
		$written       = array();
		$failed        = array();
		$generated_any = false;
		$stamp         = (string) time();

		foreach ( $map as $key => $asset ) {
			$contents = bridge_qode_get_dynamic_asset_generated_contents( $asset['source_php'] );

			if ( $contents === '' ) {
				$failed[] = $key;
				continue;
			}

			$generated_any   = true;
			$wrote_somewhere = false;
			$upload_path     = trailingslashit( $upload['basedir'] ) . $asset['filename'];
			$legacy_path     = trailingslashit( QODE_ROOT_DIR ) . $asset['legacy_dir'] . '/' . $asset['legacy_filename'];
			$hashed_name     = bridge_qode_get_dynamic_asset_versioned_filename( $asset['filename'], $stamp );
			$hashed_path     = trailingslashit( $upload['basedir'] ) . $hashed_name;

			if ( $upload_ready && bridge_qode_write_dynamic_asset_file( $upload_path, $contents ) ) {
				$wrote_somewhere = true;
			}

			if ( $upload_ready && $hashed_name !== $asset['filename'] && bridge_qode_write_dynamic_asset_file( $hashed_path, $contents ) ) {
				$wrote_somewhere = true;
			}

			$legacy_dir_writable = is_writable( dirname( $legacy_path ) );
			$should_write_legacy = $legacy_dir_writable && ( $overwrite_legacy || ! file_exists( $legacy_path ) );

			if ( $should_write_legacy && bridge_qode_write_dynamic_asset_file( $legacy_path, $contents ) ) {
				$wrote_somewhere = true;
			}

			if ( $wrote_somewhere ) {
				$written[] = $key;
			} else {
				$failed[] = $key;
			}
		}

		$success = $generated_any && empty( $failed );

		if ( ! empty( $written ) ) {
			update_option( 'qode_dynamic_assets_version', $stamp );
			bridge_qode_cleanup_old_versioned_dynamic_assets( $stamp );
		}

		if ( $success ) {
			update_option( 'qode_dynamic_assets_theme_version', BRIDGE_THEME_VERSION );
			delete_transient( 'qode_dynamic_assets_generate_attempt' );
		}

		$last_result = array(
			'success'  => $success,
			'written'  => $written,
			'failed'   => $failed,
			'message'  => $success
				? esc_html__( 'Saved', 'bridge' )
				: esc_html__( 'Options were saved, but dynamic CSS/JS files could not be generated. Check writing permissions for wp-content/uploads/bridge and the theme css/js folders.', 'bridge' ),
		);

		return $last_result;
	}

	add_action( 'bridge_qode_action_after_theme_option_save', 'bridge_qode_generate_dynamic_css_and_js' );
	add_action( 'bridge_core_action_after_options_import', 'bridge_qode_generate_dynamic_css_and_js' );
}

if ( ! function_exists( 'bridge_qode_maybe_regenerate_dynamic_assets' ) ) {
	/**
	 * Recreate dynamic files after a theme update, including FTP/manual updates.
	 */
	function bridge_qode_maybe_regenerate_dynamic_assets() {
		if ( ! is_admin() || ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$stored_version = get_option( 'qode_dynamic_assets_theme_version' );

		if ( $stored_version === BRIDGE_THEME_VERSION ) {
			return;
		}

		if ( get_transient( 'qode_dynamic_assets_generate_attempt' ) ) {
			return;
		}

		set_transient( 'qode_dynamic_assets_generate_attempt', 1, HOUR_IN_SECONDS );

		bridge_qode_generate_dynamic_css_and_js( false );
	}

	add_action( 'admin_init', 'bridge_qode_maybe_regenerate_dynamic_assets', 30 );
}

if ( ! function_exists( 'bridge_qode_regenerate_dynamic_assets_on_theme_switch' ) ) {
	function bridge_qode_regenerate_dynamic_assets_on_theme_switch() {
		if ( function_exists( 'bridge_qode_generate_dynamic_css_and_js' ) ) {
			bridge_qode_generate_dynamic_css_and_js( false );
		}
	}

	add_action( 'after_switch_theme', 'bridge_qode_regenerate_dynamic_assets_on_theme_switch' );
}

if ( ! function_exists( 'bridge_qode_regenerate_dynamic_assets_after_update' ) ) {
	/**
	 * @param WP_Upgrader $upgrader
	 * @param array       $options
	 */
	function bridge_qode_regenerate_dynamic_assets_after_update( $upgrader, $options ) {
		if ( empty( $options['type'] ) || $options['type'] !== 'theme' ) {
			return;
		}

		$updated_themes = array();
		if ( ! empty( $options['themes'] ) && is_array( $options['themes'] ) ) {
			$updated_themes = $options['themes'];
		} elseif ( ! empty( $options['theme'] ) ) {
			$updated_themes = array( $options['theme'] );
		}

		if ( ! empty( $updated_themes ) && ! in_array( get_template(), $updated_themes, true ) ) {
			return;
		}

		bridge_qode_generate_dynamic_css_and_js( false );
	}

	add_action( 'upgrader_process_complete', 'bridge_qode_regenerate_dynamic_assets_after_update', 10, 2 );
}
