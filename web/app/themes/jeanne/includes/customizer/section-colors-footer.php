<?php
/**
 * Customizer: Footer Colors
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_colors_footer', array(
	'title'      => esc_attr__( 'Colors: Footer', 'jeanne' ),
	'priority'   => 45,
	'capability' => 'edit_theme_options',
) );



/**
 * Widget: Title Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_footer_widget_title_color',
	'label'    			=> esc_attr__( 'Widget: Title Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_footer',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.widget-title',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Widget: Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_footer_widget_text_color',
	'label'    			=> esc_attr__( 'Widget: Text Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_footer',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.footer-container',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Widget: Link Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_footer_widget_link_color',
	'label'    			=> esc_attr__( 'Widget: Link Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_footer',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.footer-container a',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_colors_footer_blank',
	'section'     => 'jeanne_ctmzr_colors_footer',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Copyright: Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_footer_copyright_text_color',
	'label'    			=> esc_attr__( 'Copyright: Text Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_footer',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.copyright',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Copyright: Link Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_footer_copyright_link_color',
	'label'    			=> esc_attr__( 'Copyright: Link Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_footer',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.copyright a',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );