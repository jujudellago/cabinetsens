<?php
/**
 * Customizer: Header Typography
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_typography_header', array(
	'title'      => esc_attr__( 'Typography: Header', 'jeanne' ),
	'priority'   => 15,
	'capability' => 'edit_theme_options',
) );



/**
 * Site Title: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_header_site_title_font_properties',
	'label'       => esc_attr__( 'Site Title: Font Properties', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_header',
	'default'     => array(
		'variant'        => '',
		'font-size'      => '28px',
		'line-height'    => '1.4',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => '.site-title-heading, .site-title, .logo-wrapper',
			'suffix'  => '',
		),
	),
) );



/**
 * Site Title: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_header_site_title_font_weight',
	'label'    			=> esc_attr__( 'Site Title: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_header',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.site-title-heading, .site-title, .logo-wrapper',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_header_blank',
	'section'     => 'jeanne_ctmzr_typography_header',
	'description' => '<br/><br/>',
) );



/**
 * Tagline: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_header_tagline_font_properties',
	'label'       => esc_attr__( 'Tagline: Font Properties', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_header',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '13px',
		'line-height'    => '1.6',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => '.tagline',
			'suffix'  => '',
		),
	),
) );



/**
 * Tagline: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_header_tagline_font_weight',
	'label'    			=> esc_attr__( 'Tagline: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_header',
	'default'  			=> '400',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.tagline',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_header_blank2',
	'section'     => 'jeanne_ctmzr_typography_header',
	'description' => '<br/><br/><hr/><br/><br/>',
) );



/**
 * Menu: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_header_menu_font_properties',
	'label'       => esc_attr__( 'Menu: Font Properties', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_header',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '14px',
		'line-height'    => '1.6',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => '.menu-style',
			'suffix'  => '',
		),
	),
) );



/**
 * Menu: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_header_menu_font_weight',
	'label'    			=> esc_attr__( 'Menu: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_header',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.menu-style, .menu-style a',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_header_blank3',
	'section'     => 'jeanne_ctmzr_typography_header',
	'description' => '<br/><br/>',
) );



/**
 * Submenu: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_header_submenu_font_properties',
	'label'       => esc_attr__( 'Submenu: Font Properties', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_header',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '12px',
		'line-height'    => '1.6',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => '.sub-menu li',
			'suffix'  => '',
		),
	),
) );



/**
 * Submenu: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_header_submenu_font_weight',
	'label'    			=> esc_attr__( 'Submenu: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_header',
	'default'  			=> '400',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.menu-list .sub-menu a, .menu-list .children a',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_header_blank4',
	'section'     => 'jeanne_ctmzr_typography_header',
	'description' => '<br/><br/><hr/><br/><br/>',
) );



/**
 * Social Links: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_header_social_links_font_properties',
	'label'       => esc_attr__( 'Social Links: Font Properties', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_header',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '11px',
		'line-height'    => '1.6',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => '.social-links li',
			'suffix'  => '',
		),
	),
) );



/**
 * Social Links: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_header_social_links_font_weight',
	'label'    			=> esc_attr__( 'Social Links: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_header',
	'default'  			=> '400',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.social-links a',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_header_blank5',
	'section'     => 'jeanne_ctmzr_typography_header',
	'description' => '<br/><br/><hr/><br/><br/>',
) );



/**
 * Search Button: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_header_search_button_font_properties',
	'label'       => esc_attr__( 'Search Button: Font Properties', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_header',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '11px',
		'line-height'    => '1.6',
		'letter-spacing' => '1px',
		'text-transform' => 'uppercase',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => '.search-button-wrapper a',
			'suffix'  => '',
		),
	),
) );



/**
 * Search Button: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_header_search_button_font_weight',
	'label'    			=> esc_attr__( 'Search Button: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_header',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.search-button-wrapper a',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );