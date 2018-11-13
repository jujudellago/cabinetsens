<?php
/**
 * Customizer: Content Typography
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_typography_content', array(
	'title'      => esc_attr__( 'Typography: Content', 'jeanne' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );



/**
 * Heading 1
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_content_heading1_font_properties',
	'label'       => esc_attr__( 'Heading 1 (h1)', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_content',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '1.6em',
		'line-height'    => '1.4',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => 'h1',
			'suffix'  => '',
		),
	),
) );



/**
 * Heading 2
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_content_heading2_font_properties',
	'label'       => esc_attr__( 'Heading 2 (h2)', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_content',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '1.4em',
		'line-height'    => '1.4',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => 'h2',
			'suffix'  => '',
		),
	),
) );



/**
 * Heading 3
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_content_heading3_font_properties',
	'label'       => esc_attr__( 'Heading 3 (h3)', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_content',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '1.2em',
		'line-height'    => '1.4',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => 'h3',
			'suffix'  => '',
		),
	),
) );



/**
 * Heading 4
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_content_heading4_font_properties',
	'label'       => esc_attr__( 'Heading 4 (h4)', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_content',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '1em',
		'line-height'    => '1.4',
		'letter-spacing' => '0.25px',
		'text-transform' => 'none',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => 'h4',
			'suffix'  => '',
		),
	),
) );



/**
 * Heading 5
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_content_heading5_font_properties',
	'label'       => esc_attr__( 'Heading 5 (h5)', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_content',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '0.8em',
		'line-height'    => '1.4',
		'letter-spacing' => '0.25px',
		'text-transform' => 'uppercase',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => 'h5',
			'suffix'  => '',
		),
	),
) );



/**
 * Heading 6
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_content_heading6_font_properties',
	'label'       => esc_attr__( 'Heading 6 (h6)', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_content',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '0.6em',
		'line-height'    => '1.4',
		'letter-spacing' => '0.25px',
		'text-transform' => 'uppercase',
	),
	'transport'         => 'auto',
	'output' => array(
		array(
			'element' => 'h6',
			'suffix'  => '',
		),
	),
) );



/**
 * Heading: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_content_heading_font_weight',
	'label'    			=> esc_attr__( 'Heading: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_content',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'h1, h2, h3, h4, h5, h6',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_typography_content_blank',
	'section'     => 'jeanne_ctmzr_typography_content',
	'description' => '<br/><br/><hr/><br/><br/>',
) );



/**
 * Content Text: Font Properties
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    => 'jeanne_ctmzr_typography_content_text_font_properties',
	'label'       => esc_attr__( 'Content Text: Font Properties', 'jeanne' ),
	'description' => esc_attr__( 'The font size here is the base size for other elements\' "em" unit in the content area.', 'jeanne' ),
	'type'        => 'typography',
	'section'     => 'jeanne_ctmzr_typography_content',
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
			'element' => 'body, main',
			'suffix'  => '',
		),
	),
) );



/**
 * Content Text: Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_content_text_font_weight',
	'label'    			=> esc_attr__( 'Content Text: Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_content',
	'default'  			=> '400',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'body, main, .post-meta-wrapper, .post-meta li::after',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );



/**
 * Content Text: Link Font Weight
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_typography_content_link_font_weight',
	'label'    			=> esc_attr__( 'Content Text: Link Font Weight', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> esc_attr__( 'It also depends on the typeface if it supports the selected weight or not.', 'jeanne' ),
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_typography_content',
	'default'  			=> '700',
	'choices'     		=> jeanne_ctmzr_get_font_weight_list(),
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => 'main a',
									'property' => 'font-weight',
									'suffix'  => ' !important',
								),
							),
) );