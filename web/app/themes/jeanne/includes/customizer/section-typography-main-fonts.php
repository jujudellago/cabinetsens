<?php
/**
 * Customizer: Main Fonts
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_typography_main_fonts', array(
	'title'      => esc_attr__( 'Typography: Main Fonts', 'jeanne' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'description' => esc_attr__( 'The primary font is generally for main elements and headings; the secondary font is for body elements. You can fine-tune font properties in other typography sections.', 'jeanne' ),
	'settings'    => 'jeanne_ctmzr_typography_main_fonts_blank',
	'section'     => 'jeanne_ctmzr_typography_main_fonts',
) );



/**
 * Primary Font
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_main_fonts_primary_font',
	'label'       => esc_attr__( 'Primary Font', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_main_fonts',
	'default'     => array(
		'font-family'    => 'Roboto',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6, .site-title-heading, .site-title, .menu-style, .social-links, .portfolio-category-wrapper, .active-portfolio-category-title, .portfolio-category-wrapper a, .portfolio-item-title',
			'suffix'  => '',
		),
	),
) );



/**
 * Secondary Font
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_main_fonts_secondary_font',
	'label'       => esc_attr__( 'Secondary Font', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_main_fonts',
	'default'     => array(
		'font-family'    => 'Roboto',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => 'body, .fancybox-caption',
			'suffix'  => '',
		),
	),
) );