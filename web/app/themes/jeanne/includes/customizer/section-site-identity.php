<?php
/**
 * Customizer: Site Identity Section
 *
 * @since 1.0.0
 */



/**
 * Copyright Text
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_copyright_text',
	'label'    			=> esc_attr__( 'Copyright Text', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'textarea',
	'section'  			=> 'title_tagline',
	'default'  			=> sprintf( __( '&copy; Jeanne WordPress Theme. Designed by <a href="%s">UXBARN</a>.', 'jeanne' ), 'https://uxbarn.com' ),
	'sanitize_callback' => 'jeanne_ctmzr_sanitize_with_theme_wpkes',
	'transport' 		=> 'postMessage',
	'js_vars'   		=> array(
								array(
									'element'  => '.copyright',
									'function' => 'html',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_site_identity_blank',
	'section'     => 'title_tagline',
	'description' => '<br/><br/>',
) );



/**
 * Social Network Display
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_site_identity_social_network_display',
	'label'       	=> esc_attr__( 'Social Network Display', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'select',
	'section'     	=> 'title_tagline',
	'default'     	=> 'text',
	'choices' 		=> array(
							'icons' => esc_attr__( 'Icons', 'jeanne' ),
							'text' 	=> esc_attr__( 'Text', 'jeanne' ),
						),
) );



/**
 * Social Networks
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_facebook_url',
	'label'    			=> esc_attr__( 'Facebook URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_twitter_url',
	'label'    			=> esc_attr__( 'Twitter URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_google_plus_url',
	'label'    			=> esc_attr__( 'Google+ URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_instagram_url',
	'label'    			=> esc_attr__( 'Instagram URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_flickr_url',
	'label'    			=> esc_attr__( 'Flickr URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_pinterest_url',
	'label'    			=> esc_attr__( 'Pinterest URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_500px_url',
	'label'    			=> esc_attr__( '500px URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_dribbble_url',
	'label'    			=> esc_attr__( 'Dribbble URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_behance_url',
	'label'    			=> esc_attr__( 'Behance URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_vimeo_url',
	'label'    			=> esc_attr__( 'Vimeo URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_youtube_url',
	'label'    			=> esc_attr__( 'YouTube URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_soundcloud_url',
	'label'    			=> esc_attr__( 'SoundCloud URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_linkedin_url',
	'label'    			=> esc_attr__( 'LinkedIn URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_rss_url',
	'label'    			=> esc_attr__( 'RSS URL', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'esc_url_raw',
) );

Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_site_identity_email',
	'label'    			=> esc_attr__( 'Email', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'title_tagline',
	'default'  			=> '',
	'sanitize_callback' => 'sanitize_email',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_site_identity_blank2',
	'section'     => 'title_tagline',
	'description' => '<br/><br/>',
) );



/**
 * Social Networks
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'     	=> 'jeanne_ctmzr_site_identity_custom_social_networks',
	'label'       	=> esc_attr__( 'Custom Social Networks', 'jeanne' ),
	'description' 	=> esc_attr__( 'If your social network is not in the list, you can use this option to add a custom one.', 'jeanne' ),
	'type'        	=> 'repeater',
	'section'     	=> 'title_tagline',
	'button_label' 	=> esc_attr__( 'Add', 'jeanne' ),
	'row_label' 	=> array(
							'type' => 'field',
							'field' => 'name',
							'value' => esc_attr__( '[Social Network Name]', 'jeanne' ),
						),
	'fields' 		=> array(
							'name' => array(
											'type'        => 'text',
											'label'       => esc_attr__( 'Name', 'jeanne' ),
											'description' => esc_attr__( 'Enter a social network name.', 'jeanne' ),
											'default'     => '',
											'sanitize_callback' => 'sanitize_text_field',
										),
							'url' => array(
											'type'        => 'text',
											'label'       => esc_attr__( 'Target URL', 'jeanne' ),
											'description' => esc_attr__( 'Enter a target URL for this social network.', 'jeanne' ),
											'default'     => '',
											'sanitize_callback' => 'esc_url_raw',
										),
							'icon' => array(
											'type'        => 'text',
											'label'       => esc_attr__( 'Icon Class Name', 'jeanne' ),
											'description' => jeanne_ctmzr_sanitize_with_theme_wpkes( __( 'Enter a full icon class name for this social network. For example, "fab fa-facebook-square". <a href="https://uxbarn.com/social-network-icons" target="_blank">Click here to choose the icon.</a> (You need to click on each icon again to see its full class name.)', 'jeanne' ) ),
											'default'     => '',
											'sanitize_callback' => 'esc_attr',
										),
						),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_site_identity_blank3',
	'section'     => 'title_tagline',
	'description' => '<br/><br/>',
) );