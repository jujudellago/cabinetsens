<?php
/**
 * Functions for Facebook login
 */

if ( ! function_exists( 'qode_membership_get_facebook_social_login' ) ) {
	/**
	 * Render form for facebook login
	 */
	function qode_membership_get_facebook_social_login() {

		$social_login_enabled   = bridge_qode_options()->getOptionValue( 'enable_social_login' ) == 'yes' ? true : false;
		$facebook_login_enabled = bridge_qode_options()->getOptionValue( 'enable_facebook_social_login' ) == 'yes' ? true : false;
		$enabled                = ( $social_login_enabled && $facebook_login_enabled ) ? true : false;

		if ( ! is_user_logged_in() && $enabled ) {

			$html = '<form class="qode-facebook-login-holder">'
			        . wp_nonce_field( 'qode_validate_facebook_login', 'qode_nonce_facebook_login_'.rand(), true, false ) .
				 '<button type="submit" class="qode-facebook-login"><i class="fa fa-facebook"></i></button>'.
			        '</form>';
			echo $html;

		}

	}

	add_action( 'qode_membership_social_network_login', 'qode_membership_get_facebook_social_login' );

}

if ( ! function_exists( 'qode_membership_verify_facebook_profile' ) ) {
	/**
	 * Confirm the posted Facebook access token with Graph API before login/register.
	 *
	 * @param array $response Client payload from the Facebook JS SDK.
	 *
	 * @return array|WP_Error id, email, name from Graph — not from the client.
	 */
	function qode_membership_verify_facebook_profile( $response ) {
		if ( ! is_array( $response ) ) {
			return new WP_Error( 'qode_fb_invalid', 'invalid' );
		}

		$token       = isset( $response['accessToken'] ) ? trim( (string) $response['accessToken'] ) : '';
		$facebook_id = isset( $response['id'] ) ? preg_replace( '/\D+/', '', (string) $response['id'] ) : '';

		if ( $token === '' || $facebook_id === '' || preg_match( '/[\r\n\0]/', $token ) ) {
			return new WP_Error( 'qode_fb_invalid', 'invalid' );
		}

		$remote = wp_remote_get(
			add_query_arg(
				array(
					'fields'       => 'id,email,name',
					'access_token' => $token,
				),
				'https://graph.facebook.com/' . $facebook_id
			),
			array(
				'timeout'   => 15,
				'sslverify' => true,
			)
		);

		if ( is_wp_error( $remote ) ) {
			return $remote;
		}

		if ( (int) wp_remote_retrieve_response_code( $remote ) !== 200 ) {
			return new WP_Error( 'qode_fb_invalid', 'invalid' );
		}

		$data = json_decode( wp_remote_retrieve_body( $remote ), true );

		if ( ! is_array( $data ) || empty( $data['id'] ) || empty( $data['email'] ) ) {
			return new WP_Error( 'qode_fb_invalid', 'invalid' );
		}

		if ( (string) $data['id'] !== $facebook_id ) {
			return new WP_Error( 'qode_fb_invalid', 'invalid' );
		}

		$email = sanitize_email( $data['email'] );

		if ( ! is_email( $email ) ) {
			return new WP_Error( 'qode_fb_invalid', 'invalid' );
		}

		$name = isset( $data['name'] ) ? sanitize_text_field( $data['name'] ) : '';

		if ( $name === '' ) {
			$name = 'Facebook User';
		}

		return array(
			'id'    => (string) $data['id'],
			'email' => $email,
			'name'  => $name,
		);
	}
}

if ( ! function_exists( 'qode_membership_check_facebook_user' ) ) {
	/**
	 * Function for getting facebook user data.
	 * Checks for user mail and register or log in user
	 */
	function qode_membership_check_facebook_user() {

		if ( empty( $_POST['response'] ) || ! is_array( $_POST['response'] ) ) {
			qode_membership_ajax_response( 'error', esc_html__( 'Username or password is invalid.', 'qode-membership' ) );
		}

		$response = wp_unslash( $_POST['response'] );
		$nonce    = isset( $response['nonce'] ) ? $response['nonce'] : '';
		$profile  = qode_membership_verify_facebook_profile( $response );

		if ( is_wp_error( $profile ) ) {
			qode_membership_ajax_response( 'error', esc_html__( 'Username or password is invalid.', 'qode-membership' ) );
		}

		$params = array(
			'id'      => $profile['id'],
			'email'   => $profile['email'],
			'name'    => $profile['name'],
			'network' => 'facebook',
			'nonce'   => $nonce,
			'link'    => '',
			'image'   => isset( $response['image'] ) ? esc_url_raw( $response['image'] ) : '',
		);

		if ( email_exists( $profile['email'] ) ) {
			$logged_in = qode_membership_login_user_from_social_network( $profile['email'], $nonce, 'facebook' );
		} else {
			$logged_in = qode_membership_register_user_from_social_network( $params );
		}

		if ( ! $logged_in ) {
			qode_membership_ajax_response( 'error', esc_html__( 'Username or password is invalid.', 'qode-membership' ) );
		}

		$url = qode_membership_get_dashboard_page_url();
		if ( $url == '' ) {
			$url = esc_url( home_url( '/' ) );
		}

		qode_membership_ajax_response( 'success', esc_html__( 'Login successful, redirecting...', 'qode-membership' ), $url );
	}

	add_action( 'wp_ajax_qode_membership_check_facebook_user', 'qode_membership_check_facebook_user' );
	add_action( 'wp_ajax_nopriv_qode_membership_check_facebook_user', 'qode_membership_check_facebook_user' );

}
