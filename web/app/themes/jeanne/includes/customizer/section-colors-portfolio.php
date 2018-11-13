<?php
/**
 * Customizer: Portfolio Colors
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_colors_portfolio', array(
	'title'      => esc_attr__( 'Colors: Portfolio', 'jeanne' ),
	'priority'   => 50,
	'capability' => 'edit_theme_options',
) );



/**
 * Portfolio Title: Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_portfolio_title_badge_text_color',
	'label'    			=> esc_attr__( 'Portfolio Title: Text Color', 'jeanne' ),
	'description'		=> esc_attr__( 'The title is under each portfolio image on the portfolio templates.', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_portfolio',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.portfolio-title',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );