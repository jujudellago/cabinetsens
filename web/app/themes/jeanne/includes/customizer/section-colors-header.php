<?php
/**
 * Customizer: Header Colors
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_colors_header', array(
	'title'      => esc_attr__( 'Colors: Header', 'jeanne' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
) );



/**
 * Site Title Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_site_title_color',
	'label'    			=> esc_attr__( 'Site Title Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.site-title-heading a, .site-title',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Tagline Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_tagline_color',
	'label'    			=> esc_attr__( 'Tagline Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.tagline',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_colors_header_blank',
	'section'     => 'jeanne_ctmzr_colors_header',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Menu Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_menu_text_color',
	'label'    			=> esc_attr__( 'Menu Text Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.menu-list > li > a, .menu-style > li::after, .search-button-wrapper a, .search-icon-button, .slicknav_menu .slicknav_btn, .slicknav_menu .slicknav_btn:hover',
									'property' => 'color',
									'suffix'  => '',
								),
								array(
									'element' => '.slicknav_menu .slicknav_icon-bar',
									'property' => 'background-color',
									'suffix'  => '',
								),
							),
) );



/**
 * Submenu Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_submenu_text_color',
	'label'    			=> esc_attr__( 'Submenu Text Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.menu-list .sub-menu a, .menu-list .children a, .slicknav_nav a',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Submenu Border Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_submenu_border_color',
	'label'    			=> esc_attr__( 'Submenu Border Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#ccc',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.sub-menu, .menu-list .children, .slicknav_nav, .slicknav_nav li',
									'property' => 'border-color',
									'suffix'  => '',
								),
							),
) );



/**
 * Submenu Level 1 Background Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_submenu_lv1_bg_color',
	'label'    			=> esc_attr__( 'Submenu: Level 1 Background Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#fff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.sub-menu, .slicknav_nav, .slicknav_menu .slicknav_nav .sub-menu',
									'property' => 'background-color',
									'suffix'  => '',
								),
							),
) );



/**
 * Submenu Level 2 Background Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_submenu_lv2_bg_color',
	'label'    			=> esc_attr__( 'Submenu: Level 2 Background Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#eee',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.sub-menu .sub-menu, .menu-list > li > .children .children',
									'property' => 'background-color',
									'suffix'  => '',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_colors_header_blank1',
	'section'     => 'jeanne_ctmzr_colors_header',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Social Link Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_social_link_color',
	'label'    			=> esc_attr__( 'Social Link Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.social-links a',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );



/**
 * Search Button Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_header_search_button_color',
	'label'    			=> esc_attr__( 'Search Button Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_header',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'auto',
	'output' 			=> array(
								array(
									'element' => '.search-button-wrapper a',
									'property' => 'color',
									'suffix'  => '',
								),
							),
) );