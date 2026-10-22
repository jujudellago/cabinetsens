<?php
/**
 * Wordpress Users Login
 */

if ( ! function_exists( 'qode_membership_login_user' ) ) {
	/**
	 * Login user
	 */
	function qode_membership_login_user() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			qode_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'qode-membership' ) );
		} else {
			check_ajax_referer( 'qode-ajax-login-nonce', 'security' );
			$data = $_POST;
			
			$login = $data['login_data'];
			parse_str( $login, $login_data );
			
			$credentials['user_login']    = isset( $login_data['user_login_name'] ) ? sanitize_user( $login_data['user_login_name'], true ) : '';
			$credentials['user_password'] = isset( $login_data['user_login_password'] ) ? $login_data['user_login_password'] : '';
			$redirect_uri                 = isset( $login_data['redirect'] ) ? qode_membership_sanitize_redirect_url( $login_data['redirect'] ) : '';
			
			if ( isset( $credentials['remember'] ) && $credentials['remember'] == 'forever' ) {
				$credentials['remember'] = true;
			} else {
				$credentials['remember'] = false;
			}
			$user_signon = wp_signon( $credentials, false );
			
			if ( is_wp_error( $user_signon ) ) {
				qode_membership_ajax_response( 'error', esc_html__( 'Wrong username or password.', 'qode-membership' ) );
			} else {
				if ( $redirect_uri == '' ) {
					$redirect_uri = qode_membership_get_dashboard_page_url();
					if ( empty( $redirect_uri ) ) {
						$redirect_uri = esc_url( home_url( '/' ) );
					}
				}
				qode_membership_ajax_response( 'success', esc_html__( 'Login successful, redirecting...', 'qode-membership' ), $redirect_uri );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_qode_membership_login_user', 'qode_membership_login_user' );
}

if ( ! function_exists( 'qode_membership_sanitize_registration_role' ) ) {
	/**
	 * Restricts role assignment during public registration to a safe allowlist.
	 *
	 * @param string $role
	 *
	 * @return string
	 */
	function qode_membership_sanitize_registration_role( $role ) {
		$role = sanitize_key( $role );

		$safe_defaults = array( 'subscriber', 'customer' );
		$allowed_roles = apply_filters( 'qode_membership_allowed_registration_roles', $safe_defaults );

		if ( in_array( $role, $allowed_roles, true ) ) {
			return $role;
		}

		$default_role = sanitize_key( apply_filters( 'qode_membership_default_role', get_option( 'default_role', 'subscriber' ) ) );

		if ( in_array( $default_role, $allowed_roles, true ) ) {
			return $default_role;
		}

		return 'subscriber';
	}
}

if ( ! function_exists( 'qode_membership_register_user' ) ) {
	/**
	 * Register new user
	 */
	function qode_membership_register_user() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			qode_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'qode-membership' ) );
		} else {
			check_ajax_referer( 'qode-ajax-register-nonce', 'security' );
			$data = $_POST;
			
			$register = $data['register_data'];
			parse_str( $register, $register_data );
			$credentials['user_login']       = isset( $register_data['user_register_name'] ) ? sanitize_user( $register_data['user_register_name'], true ) : '';
			$credentials['user_email']       = isset( $register_data['user_register_email'] ) ? sanitize_email( $register_data['user_register_email'] ) : '';
			$credentials['password']         = isset( $register_data['user_register_password'] ) ? $register_data['user_register_password'] : '';
			$credentials['confirm_password'] = isset( $register_data['user_register_confirm_password'] ) ? $register_data['user_register_confirm_password'] : '';

			if ( $credentials['user_login'] === '' || ! validate_username( $credentials['user_login'] ) ) {
				qode_membership_ajax_response( 'error', esc_html__( 'Please enter a valid username.', 'qode-membership' ) );
			}

			if ( ! is_email( $credentials['user_email'] ) ) {
				qode_membership_ajax_response( 'error', esc_html__( 'Please enter a valid email address.', 'qode-membership' ) );
			}
			
			$user_id    = username_exists( $credentials['user_login'] );
			$user_email = email_exists( $credentials['user_email'] );
			
			if ( ! $user_id && ! $user_email ) {
				if ( $credentials['password'] === '' ) {
					qode_membership_ajax_response( 'error', esc_html__( 'Please enter a password.', 'qode-membership' ) );
				}

				if ( $credentials['password'] == $credentials['confirm_password'] ) {
					$user_save_flag = wp_create_user( $credentials['user_login'], $credentials['password'], $credentials['user_email'] );
					
					if ( is_wp_error( $user_save_flag ) ) {
						qode_membership_ajax_response( 'error', esc_html__( 'Something went wrong', 'qode-membership' ) );
					} else {
                        $default_params = array(
                            'ID' => $user_save_flag
                        );
                        $additional_params = array(
                            'role' =>  apply_filters('qode_membership_default_role', get_option('default_role'))
                        );
                        $additional_params = apply_filters('qode_membership_additional_registration_params', $additional_params, $register_data);
                        $additional_params['role'] = qode_membership_sanitize_registration_role( $additional_params['role'] );
                        wp_update_user( array_merge($default_params, $additional_params) );
						$mail_to = $credentials['user_email'];
						
						$subject = esc_html__( 'User Registration', 'qode-membership' ); //Subject
						$message = esc_html__( 'You have registered successfully on ', 'qode-membership' ) . esc_url( get_site_url() ); //Message
						wp_mail( $mail_to, $subject, $message );
						qode_membership_ajax_response( 'success', esc_html__( 'You have registered successfully, please login with the created credentials', 'qode-membership' ) );
						
					}
				} else {
					qode_membership_ajax_response( 'error', esc_html__( 'Both passwords must match in order to register', 'qode-membership' ) );
				}
			} elseif ( $user_id ) {
				qode_membership_ajax_response( 'error', esc_html__( 'Username already exists', 'qode-membership' ) );
			} else {
				qode_membership_ajax_response( 'error', esc_html__( 'User with that name already exists', 'qode-membership' ) );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_qode_membership_register_user', 'qode_membership_register_user' );
}

if ( ! function_exists( 'qode_membership_user_lost_password' ) ) {
	/**
	 * Reset user password
	 */
	function qode_membership_user_lost_password() {

		check_ajax_referer( 'qode-ajax-reset-nonce', 'security' );

		$user_login = isset( $_POST['user_login'] ) ? trim( wp_unslash( $_POST['user_login'] ) ) : '';
		$result     = retrieve_password( $user_login );

		if ( $result === true ) {
			qode_membership_ajax_response( 'success', esc_html__( 'We have sent you an email', 'qode-membership' ) );
		} elseif ( is_wp_error( $result ) ) {
			qode_membership_ajax_response( 'error', $result->get_error_message() );
		} else {
			qode_membership_ajax_response( 'error', esc_html__( 'Something went wrong', 'qode-membership' ) );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_qode_membership_user_lost_password', 'qode_membership_user_lost_password' );
}