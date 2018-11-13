<?php
/**
 * Customizer: General Settings
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_settings_general', array(
	'title'      => esc_attr__( 'General Settings', 'jeanne' ),
	'priority'   => 5,
	'capability' => 'edit_theme_options',
	'panel'		 => 'jeanne_ctmzr_panel_settings',
) );



/**
 * Show Search Button?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_general_show_search_button',
	'label'       	=> esc_attr__( 'Show Search Button?', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_general',
	'default'     	=> '1',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



/**
 * Search Placeholder Text
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_general_search_placeholder_text',
	'label'    			=> esc_attr__( 'Search Placeholder Text', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_general',
	'default'  			=> esc_html__( 'Type and hit enter', 'jeanne' ),
	'transport'         => 'auto',
) );



/**
 * Number of Posts on Search Results
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_general_number_of_posts_search_results',
	'label'    			=> esc_attr__( 'Number of Posts on Search Results', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'number',
	'section'  			=> 'jeanne_ctmzr_settings_general',
	'default'  			=> 10,
	'choices'     		=> array(
								'min'  => 1,
								'step' => 1,
							),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_general_separator1',
	'section'     => 'jeanne_ctmzr_settings_general',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Show Footer Widget Area?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_general_show_footer_widget_area',
	'label'       	=> esc_attr__( 'Show Footer Widget Area?', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_general',
	'default'     	=> '1',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



/**
 * Number of Columns for Footer Widget Area
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_general_footer_widget_area_column_number',
	'label'    			=> esc_attr__( 'Number of Columns for Footer Area', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_settings_general',
	'default'  			=> '3',
	'multiple'			=> 1,
	'choices'     		=> array(
								'1'  => esc_attr__( '1 Column', 'jeanne' ),
								'2'  => esc_attr__( '2 Columns', 'jeanne' ),
								'3'  => esc_attr__( '3 Columns', 'jeanne' ),
								'4'  => esc_attr__( '4 Columns', 'jeanne' ),
							),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_general_separator2',
	'section'     => 'jeanne_ctmzr_settings_general',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Enable Lightbox on WP Images and Gallery
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_general_enable_lightbox_wp_images',
	'label'       	=> esc_attr__( 'Enable Lightbox on WP Images and Gallery', 'jeanne' ),
	'description' 	=> esc_attr__( 'To make it works, also make sure that you set the "Link To" option to "Media File" when adding WP image/gallery.', 'jeanne' ),
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_general',
	'default'     	=> '1',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_general_separator3',
	'section'     => 'jeanne_ctmzr_settings_general',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Font Awesome CDN URL
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_general_font_awesome_cdn_url',
	'label'    			=> esc_attr__( 'Font Awesome CDN URL', 'jeanne' ),
	'description' 		=> esc_attr__( 'The theme uses icons from Font Awesome. You can use the options in this section to update its CDN URL and integrity values.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_general',
	'default'  			=> 'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
) );



/**
 * Font Awesome CDN Integrity Value
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_general_font_awesome_cdn_integrity',
	'label'    			=> esc_attr__( 'Font Awesome CDN Integrity Value', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_general',
	'default'  			=> 'sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU',
) );