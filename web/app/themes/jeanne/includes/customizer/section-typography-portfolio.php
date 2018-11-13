<?php
/**
 * Customizer: Portfolio Typography
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_typography_portfolio', array(
	'title'      => esc_attr__( 'Typography: Portfolio', 'jeanne' ),
	'priority'   => 30,
	'capability' => 'edit_theme_options',
) );



/**
 * Category Menu: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_portfolio_category_menu_font_properties',
	'label'       => esc_attr__( 'Category Menu: Font Properties', 'jeanne' ),
	'description' => esc_attr__( 'This element is on the All Works portfolio template.', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_portfolio',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '14px',
		'line-height'    => '1.8',
		'letter-spacing' => '0.5px',
		'text-transform' => 'uppercase',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => '.portfolio-category-wrapper, .active-portfolio-category-title, .portfolio-category-wrapper a',
			'suffix'  => '',
		),
		array(
			'element' => '.portfolio-categories li',
			'choice' => 'line-height',
		),
	),
) );



/**
 * Category Menu: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_portfolio_category_menu_font_weight',
	'label'    			=> esc_attr__( 'Category Menu: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_portfolio',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.portfolio-category-wrapper, .active-portfolio-category-title, .portfolio-category-wrapper a',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_portfolio_blank1',
	'section'     => 'jeanne_ctmzr_typography_portfolio',
	'description' => '<br/><br/><hr/><br/><br/>',
) );



/**
 * Portfolio Title: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_portfolio_title_badge_font_properties',
	'label'       => esc_attr__( 'Portfolio Title: Font Properties', 'jeanne' ),
	'description' => esc_attr__( 'The title is under each portfolio image on the portfolio templates.', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_portfolio',
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
			'element' => '.portfolio-title',
			'suffix'  => '',
		),
	),
) );



/**
 * Portfolio Title: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_portfolio_title_badge_font_weight',
	'label'    			=> esc_attr__( 'Portfolio Title: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_portfolio',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.portfolio-title',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );