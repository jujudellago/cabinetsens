<?php
/**
 * Customizer: Page Settings
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_settings_page', array(
	'title'      => esc_attr__( 'Page Settings', 'jeanne' ),
	'priority'   => 12,
	'capability' => 'edit_theme_options',
	'panel'		 => 'jeanne_ctmzr_panel_settings',
) );



/**
 * Use Full Size Image on Pages?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_page_use_full_size',
	'label'    			=> esc_attr__( 'Use Full Size Image on Pages?', 'jeanne' ),
	'description' 		=> esc_attr__( 'If this is enabled, the full size (original size) of the featured image will be used instead of the theme image sizes. It will also make the GIF animation work.', 'jeanne' ),
	'tooltip'      		=> '',
	'type'     			=> 'switch',
	'section'  			=> 'jeanne_ctmzr_settings_page',
	'default'  			=> '0',
	'choices' 			=> array(
								'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
								'off' 	=> esc_attr__( 'No', 'jeanne' ),
							),
	'transport'         => 'auto',
) );