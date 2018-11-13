<?php
/**
 * Customizer: Content Colors
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_colors_content', array(
	'title'      => esc_attr__( 'Colors: Content', 'jeanne' ),
	'priority'   => 40,
	'capability' => 'edit_theme_options',
) );



/**
 * Heading Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_content_heading_color',
	'label'    			=> esc_attr__( 'Heading Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_content',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'h1, h2, h3, h4, h5, h6, .post-title, .post-item .post-title a, .section-title, .content-section-wrapper .section-title a',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_content_text_color',
	'label'    			=> esc_attr__( 'Text Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_content',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '#content-container, .meta-title',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Link Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_content_link_color',
	'label'    			=> esc_attr__( 'Link Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_content',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'main a:not(.wp-block-button__link), .post-meta a, .content-section-wrapper a, .next-prev-post-navigation a, .portfolio-categories a',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_colors_content_blank',
	'section'     => 'jeanne_ctmzr_colors_content',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Input Field: Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_content_input_field_text_color',
	'label'    			=> esc_attr__( 'Input Field: Text Color', 'jeanne' ),
	'description'		=> '',
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_content',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'input[type="text"], input[type="password"], input[type="email"], input[type="search"], input[type="number"], input[type="url"], input[type="tel"], textarea, select',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Input Field: Background Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_content_input_field_bg_color',
	'label'    			=> esc_attr__( 'Input Field: Background Color', 'jeanne' ),
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_content',
	'default'  			=> '#fff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'input[type="text"], input[type="password"], input[type="email"], input[type="search"], input[type="number"], input[type="url"], input[type="tel"], textarea, select',
									'property' => 'background-color',
									'suffix'  => '',
								),
								array(
									'element' => '.footer-container input[type="button"], .footer-container input[type="submit"], .footer-container button, .footer-container a.button',
									'property' => 'border-color',
									'suffix'  => '',
								),
							),
) );



/**
 * Input Field: Border Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_content_input_field_border_color',
	'label'    			=> esc_attr__( 'Input Field: Border Color', 'jeanne' ),
	'description'		=> '',
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_content',
	'default'  			=> '#ccc',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'input[type="text"], input[type="password"], input[type="email"], input[type="search"], input[type="number"], input[type="url"], input[type="tel"], textarea, select',
									'property' => 'border-color',
									'suffix'  => '',
								),
							),
) );



/**
 * Button: Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_content_button_text_color',
	'label'    			=> esc_attr__( 'Button: Text Color', 'jeanne' ),
	'description'		=> '',
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_content',
	'default'  			=> '#fff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'input[type="button"], input[type="submit"], button, a.button, .post-item .button, .wp-block-button__link:not(.has-text-color), .wp-block-button__link:not(.has-text-color):active, .wp-block-button__link:not(.has-text-color):focus, .wp-block-button__link:not(.has-text-color):hover, .wp-block-file__button, .wp-block-file__button:hover',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Button: Background Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_content_button_bg_color',
	'label'    			=> esc_attr__( 'Button: Background Color', 'jeanne' ),
	'description'		=> '',
	'tooltip'			=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_content',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'input[type="button"], input[type="submit"], button, a.button, .post-item .button, .wp-block-button__link:not(.has-background), .wp-block-button__link:not(.has-background):active, .wp-block-button__link:not(.has-background):focus, .wp-block-button__link:not(.has-background):hover, .wp-block-file__button, .wp-block-file__button:hover',
									'property' => 'background-color',
									'suffix'  => '',
								),
							),
) );