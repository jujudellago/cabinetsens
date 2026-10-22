<?php
/**
 * Common functions for all social networks
 */

if ( ! function_exists( 'qode_membership_set_social_vars' ) ) {
	/**
	 * Save social variables for later use in js files
	 */
	function qode_membership_set_social_vars() {

		if ( !qode_membership_theme_installed() ) {
			return;
		}
		$social_login_enabled = bridge_qode_options()->getOptionValue( 'enable_social_login' ) == 'yes' ? true : false;
		if ( $social_login_enabled ) {

			$social_variables = array(
				'facebookAppId'  => bridge_qode_options()->getOptionValue( 'enable_facebook_social_login' ) == 'yes' ? bridge_qode_options()->getOptionValue( 'enable_facebook_login_fbapp_id' ) : null,
				'googleClientId' => bridge_qode_options()->getOptionValue( 'enable_google_social_login' ) == 'yes' ? bridge_qode_options()->getOptionValue( 'enable_google_login_client_id' ) : null
			);

			wp_localize_script( 'qode_membership_script', 'qodeSocialLoginVars', array(
				'social' => $social_variables
			) );
		}

	}

	add_action( 'wp_enqueue_scripts', 'qode_membership_set_social_vars', 11 );

}

if ( ! function_exists( 'qode_membership_get_facebook_app_id' ) ) {
	/**
	 * Configured Facebook App ID, or empty string.
	 *
	 * @return string
	 */
	function qode_membership_get_facebook_app_id() {
		if ( ! qode_membership_theme_installed() ) {
			return '';
		}

		return sanitize_text_field( (string) bridge_qode_options()->getOptionValue( 'enable_facebook_login_fbapp_id' ) );
	}
}

if ( ! function_exists( 'qode_membership_is_facebook_login_enabled' ) ) {
	/**
	 * Whether Facebook social login is enabled in theme options.
	 *
	 * @return bool
	 */
	function qode_membership_is_facebook_login_enabled() {
		if ( ! qode_membership_theme_installed() ) {
			return false;
		}

		return bridge_qode_options()->getOptionValue( 'enable_social_login' ) === 'yes'
			&& bridge_qode_options()->getOptionValue( 'enable_facebook_social_login' ) === 'yes'
			&& qode_membership_get_facebook_app_id() !== '';
	}
}

if ( ! function_exists( 'qode_membership_sanitize_redirect_url' ) ) {
	/**
	 * Allow only local redirects after login.
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	function qode_membership_sanitize_redirect_url( $url ) {
		if ( empty( $url ) ) {
			return '';
		}

		return wp_validate_redirect( esc_url_raw( $url ), '' );
	}
}

if ( ! function_exists( 'qode_membership_sanitize_social_image_url' ) ) {
	/**
	 * Restrict stored social avatar URLs to Facebook CDN hosts.
	 *
	 * @param string $url
	 *
	 * @return string
	 */
	function qode_membership_sanitize_social_image_url( $url ) {
		$url = esc_url_raw( $url, array( 'https' ) );
		if ( empty( $url ) ) {
			return '';
		}

		$host = wp_parse_url( $url, PHP_URL_HOST );
		if ( empty( $host ) ) {
			return '';
		}

		$host              = strtolower( $host );
		$allowed_suffixes = array( 'facebook.com', 'fbcdn.net', 'facebook.net' );

		foreach ( $allowed_suffixes as $suffix ) {
			if ( $host === $suffix || substr( $host, - strlen( '.' . $suffix ) ) === '.' . $suffix ) {
				return $url;
			}
		}

		return '';
	}
}

if ( ! function_exists( 'qode_membership_request_facebook_graph' ) ) {
	/**
	 * Call a fixed Facebook Graph endpoint with a user access token.
	 *
	 * @param string $endpoint
	 * @param string $access_token
	 * @param string $fields
	 *
	 * @return array|WP_Error
	 */
	function qode_membership_request_facebook_graph( $endpoint, $access_token, $fields = '' ) {
		$endpoint = sanitize_key( $endpoint );
		if ( ! in_array( $endpoint, array( 'me', 'app' ), true ) ) {
			return new WP_Error( 'invalid_endpoint', 'Invalid Facebook endpoint.' );
		}

		$query = array(
			'access_token' => $access_token,
		);

		if ( $fields !== '' ) {
			$query['fields'] = $fields;
		}

		$url      = add_query_arg( $query, 'https://graph.facebook.com/' . $endpoint );
		$response = wp_remote_get(
			$url,
			array(
				'timeout'   => 15,
				'sslverify' => true,
				'headers'   => array(
					'Accept' => 'application/json',
				),
			)
		);

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$code = (int) wp_remote_retrieve_response_code( $response );
		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( 200 !== $code || ! is_array( $body ) || isset( $body['error'] ) ) {
			return new WP_Error( 'facebook_graph_error', 'Facebook verification failed.' );
		}

		return $body;
	}
}

if ( ! function_exists( 'qode_membership_verify_facebook_access_token' ) ) {
	/**
	 * Verify a Facebook user access token against Graph API and this site's App ID.
	 * Returns verified profile fields; never trust client-supplied identity data.
	 *
	 * @param string $access_token
	 *
	 * @return array|WP_Error
	 */
	function qode_membership_verify_facebook_access_token( $access_token ) {
		if ( ! is_string( $access_token ) || $access_token === '' || strlen( $access_token ) > 2048 ) {
			return new WP_Error( 'invalid_token', 'Invalid token.' );
		}

		if ( ! preg_match( '/^[A-Za-z0-9._~+\/=|-]+$/', $access_token ) ) {
			return new WP_Error( 'invalid_token', 'Invalid token.' );
		}

		$app_id = qode_membership_get_facebook_app_id();
		if ( $app_id === '' ) {
			return new WP_Error( 'missing_app_id', 'Missing app id.' );
		}

		$app = qode_membership_request_facebook_graph( 'app', $access_token );
		if ( is_wp_error( $app ) || empty( $app['id'] ) || (string) $app['id'] !== (string) $app_id ) {
			return new WP_Error( 'token_app_mismatch', 'Token does not belong to this app.' );
		}

		$me = qode_membership_request_facebook_graph( 'me', $access_token, 'id,email,name,link,picture.type(large)' );
		if ( is_wp_error( $me ) || empty( $me['id'] ) ) {
			return new WP_Error( 'invalid_user', 'Could not verify Facebook user.' );
		}

		$email = isset( $me['email'] ) ? sanitize_email( $me['email'] ) : '';
		if ( ! is_email( $email ) ) {
			return new WP_Error( 'missing_email', 'Facebook account has no email.' );
		}

		$image = '';
		if ( isset( $me['picture']['data']['url'] ) ) {
			$image = qode_membership_sanitize_social_image_url( $me['picture']['data']['url'] );
		}

		return array(
			'id'    => sanitize_text_field( (string) $me['id'] ),
			'email' => $email,
			'name'  => isset( $me['name'] ) ? sanitize_text_field( $me['name'] ) : '',
			'link'  => isset( $me['link'] ) ? esc_url_raw( $me['link'] ) : '',
			'image' => $image,
		);
	}
}

if ( ! function_exists( 'qode_membership_login_user_from_social_network' ) ) {
	/**
	 * Login user from social network
	 *
	 * @param string $email
	 * @param string $nonce
	 * @param string $network
	 *
	 * @return bool
	 */
	function qode_membership_login_user_from_social_network( $email, $nonce, $network ) {

		$email   = sanitize_email( $email );
		$network = sanitize_key( $network );

		if ( ! is_email( $email ) ) {
			return false;
		}

		if ( ! wp_verify_nonce( $nonce, 'qode_validate_' . $network . '_login' ) ) {
			return false;
		}

		$user = get_user_by( 'email', $email );
		if ( ! $user instanceof WP_User ) {
			return false;
		}

		if ( is_user_logged_in() ) {
			return (int) get_current_user_id() === (int) $user->ID;
		}

		wp_clear_auth_cookie();
		wp_set_current_user( $user->ID, $user->user_login );
		wp_set_auth_cookie( $user->ID );
		do_action( 'wp_login', $user->user_login, $user );

		return true;
	}

}

if ( ! function_exists( 'qode_membership_register_user_from_social_network' ) ) {
	/**
	 * Register facebook user
	 *
	 * @param array $params - verified parameters for logging in
	 *
	 * @return bool
	 */
	function qode_membership_register_user_from_social_network( $params ) {

		if ( empty( $params['nonce'] ) || empty( $params['network'] ) ) {
			return false;
		}

		$email   = isset( $params['email'] ) ? sanitize_email( $params['email'] ) : '';
		$network = sanitize_key( $params['network'] );
		$nonce   = $params['nonce'];

		if ( ! is_email( $email ) ) {
			return false;
		}

		if ( ! wp_verify_nonce( $nonce, 'qode_validate_' . $network . '_login' ) ) {
			return false;
		}

		if ( email_exists( $email ) ) {
			return qode_membership_login_user_from_social_network( $email, $nonce, $network );
		}

		$nicename = isset( $params['name'] ) ? sanitize_text_field( $params['name'] ) : '';
		$username = str_replace( '-', '_', sanitize_title( $nicename ) ) . '_' . $network;
		$username = sanitize_user( $username, true );

		if ( $username === '' || username_exists( $username ) ) {
			$username = sanitize_user( 'fb_' . wp_generate_password( 12, false, false ), true );
		}

		$userdata = array(
			'user_login'   => $username,
			'display_name' => $nicename,
			'user_email'   => $email,
			'user_pass'    => wp_generate_password( 24, true, true ),
			'role'         => 'subscriber',
		);

		$user_id = wp_insert_user( $userdata );

		if ( is_wp_error( $user_id ) ) {
			return false;
		}

		$profile_image = isset( $params['image'] ) ? qode_membership_sanitize_social_image_url( $params['image'] ) : '';
		$link          = isset( $params['link'] ) ? esc_url_raw( $params['link'] ) : '';

		if ( $profile_image !== '' ) {
			add_user_meta( $user_id, 'social_profile_image', $profile_image, true );
		}

		if ( $link !== '' ) {
			update_user_meta( $user_id, $network, $link );
		}

		return qode_membership_login_user_from_social_network( $email, $nonce, $network );
	}

}

if ( ! function_exists( 'qode_membership_generate_password' ) ) {
	/**
	 * Generate password for user
	 *
	 * @param $str1
	 * @param $str2
	 *
	 * @return array|string
	 */
	function qode_membership_generate_password( $str1, $str2 ) {

		$str1 = str_split( $str1 );
		$str2 = str_split( $str2 );

		$password = array_merge( $str1, $str2 );
		shuffle( $password );
		$password = implode( '', $password );

		return $password;
	}

}
