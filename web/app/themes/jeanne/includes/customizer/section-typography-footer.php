<?php
/**
 * Customizer: Footer Typography
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_typography_footer', array(
	'title'      => esc_attr__( 'Typography: Footer', 'jeanne' ),
	'priority'   => 25,
	'capability' => 'edit_theme_options',
) );



/**
 * Widget Title: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_footer_widget_title_font_properties',
	'label'       => esc_attr__( 'Widget Title: Font Properties', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_footer',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '12px',
		'line-height'    => '1.4',
		'letter-spacing' => '1px',
		'text-transform' => 'uppercase',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => '.footer-container .widget-title',
			'suffix'  => '',
		),
	),
) );



/**
 * Widget Title: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_footer_widget_title_font_weight',
	'label'    			=> esc_attr__( 'Widget Title: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_footer',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.footer-container .widget-title',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_footer_blank',
	'section'     => 'jeanne_ctmzr_typography_footer',
	'description' => '<br/><br/>',
) );



/**
 * Widget Text: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_footer_widget_text_font_properties',
	'label'       => esc_attr__( 'Widget Text: Font Properties', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_footer',
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
			'element' => '.footer-container, .copyright',
			'suffix'  => '',
		),
	),
) );



/**
 * Widget Text: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_footer_widget_text_font_weight',
	'label'    			=> esc_attr__( 'Widget Text: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_footer',
	'default'  			=> '400',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.footer-container, .copyright',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



/**
 * Widget Text: Link Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_footer_widget_text_link_font_weight',
	'label'    			=> esc_attr__( 'Widget Text: Link Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_footer',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.footer-container a, .copyright a',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_footer_blank2',
	'section'     => 'jeanne_ctmzr_typography_footer',
	'description' => '<br/><br/><hr/><br/><br/>',
) );



/**
 * Copyright Font Size
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_footer_copyright_font_size',
	'label'    			=> esc_attr__( 'Copyright Font Size', 'jeanne' ),
	'tooltip' 			=> esc_attr__( 'You can use either em or px unit here.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'dimension',
	'section'  			=> 'jeanne_ctmzr_typography_footer',
	'default'  			=> '12px',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.copyright',
									'property' => 'font-size',
									'suffix'  => ' !important',
								),
							),
) );