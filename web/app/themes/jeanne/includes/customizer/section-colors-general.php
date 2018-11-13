<?php
/**
 * Customizer: General Colors
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_colors_general', array(
	'title'      => esc_attr__( 'Colors: General', 'jeanne' ),
	'priority'   => 30,
	'capability' => 'edit_theme_options',
) );



/**
 * Accent Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_general_accent_color',
	'label'    			=> esc_attr__( 'Accent Color', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_general',
	'default'  			=> '#0048ff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' 		=> 'auto',
	'output' 			=> array(
								array(
									'element' => 'a:not(.wp-block-button__link):hover, .post-item a:not(.wp-block-button__link):hover, .site-title > span, .menu-style > li:hover > a, .menu-style > li > a:hover, .menu-style > .current_page_item > a, .menu-style > .current-menu-item > a, .menu-style > .current-menu-parent > a, .menu-style > .current-menu-ancestor > a, .menu-style > li.active > a, .sub-menu > li:hover > a, .menu-list .children > li:hover > a, .loading-text, .portfolio-item:hover .portfolio-title,  .active-portfolio-category-title',
									'property' => 'color',
								),
								array(
									'element' => '.progress-bar',
									'property' => 'background-color',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_colors_general_blank',
	'section'     => 'jeanne_ctmzr_colors_general',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Line Color 1
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_general_line_color1',
	'label'    			=> esc_attr__( 'Line Color 1', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_general',
	'default'  			=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' 		=> 'auto',
	'output' 			=> array(
								array(
									'element' => 'body .inner-header-container, body .footer-container',
									'property' => 'border-top-color',
								),
							),
) );



/**
 * Line Color 2
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_colors_general_line_color2',
	'label'    			=> esc_attr__( 'Line Color 2', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'color',
	'section'  			=> 'jeanne_ctmzr_colors_general',
	'default'  			=> '#aaa',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' 		=> 'auto',
	'output' 			=> array(
								array(
									'element' => '.inner-header-container, .logo-tagline-wrapper, .site-menu, .post-content-container, .post-title-content-wrapper, #comments, .numbers-pagination, .next-prev-pagination, .next-prev-post-navigation, .search-result-list article.post-item, .portfolio-template-side-content,.portfolio-page-content, .portfolio-item-list, .footer-container, .inner-footer-container, .copyright, .portfolio-format-content, .portfolio-related-work',
									'property' => 'border-color',
								),
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_colors_general_blank1',
	'section'     => 'jeanne_ctmzr_colors_general',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Site Background
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_colors_general_site_background',
	'label'       	=> esc_attr__( 'Site Background', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'background',
	'section'     	=> 'jeanne_ctmzr_colors_general',
	'default'     	=> array(
							'background-color'      => '#F5F7F8',
							'background-image'      => '',
							'background-repeat'     => 'repeat',
							'background-position'   => 'center center',
							'background-size'       => 'cover',
							'background-attachment' => 'scroll',
						),
	'transport' 		=> 'auto',
	'output'		=> array(
							array(
								'element' => 'body',
							),
							array(
								'element' => '.curtain',
								'property' => 'background-color',
							),
						),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_colors_general_blank2',
	'section'     => 'jeanne_ctmzr_colors_general',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Search Overlay: Text Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_colors_general_search_overlay_text_color',
	'label'       	=> esc_attr__( 'Search Overlay: Text Color', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'color',
	'section'     	=> 'jeanne_ctmzr_colors_general',
	'default'     	=> '#050505',
	'sanitize_callback' => 'sanitize_hex_color',
	'output'		=> array(
							array(
								'element' => '#search-panel-wrapper .search-field, #search-close-button',
								'property' => 'color',
							),
							array(
								'element' => '#search-panel-wrapper .search-field',
								'property' => 'border-color',
							),
						),
	'transport' 	=> 'postMessage',
	'js_vars'   	=> array(
							array(
								'element' => '#search-panel-wrapper .search-field, #search-close-button',
								'property' => 'color',
							),
							array(
								'element' => '#search-panel-wrapper .search-field',
								'property' => 'border-color',
							),
						),
) );



/**
 * Search Overlay: Background Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_colors_general_search_overlay_background_color',
	'label'       	=> esc_attr__( 'Search Overlay: Background Color', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'color',
	'section'     	=> 'jeanne_ctmzr_colors_general',
	'default'     	=> 'rgba(255,255,255,1)',
	'choices'     	=> array(
							'alpha' => true,
						),
	'output'		=> array(
							array(
								'element' => '#search-panel-wrapper',
								'property' => 'background',
							),
						),
	'transport' 	=> 'postMessage',
	'js_vars'   	=> array(
							array(
								'element'  => '#search-panel-wrapper',
								'property' => 'background',
								'function' => 'css',
							),
						),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_colors_general_blank3',
	'section'     => 'jeanne_ctmzr_colors_general',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Lightbox Overlay: Background Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_colors_general_lightbox_overlay_background_color',
	'label'       	=> esc_attr__( 'Lightbox Overlay: Background Color', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'color',
	'section'     	=> 'jeanne_ctmzr_colors_general',
	'default'     	=> 'rgba(30,30,30,1)',
	'choices'     	=> array(
							'alpha' => true,
						),
	'output'		=> array(
							array(
								'element' => '.fancybox-bg',
								'property' => 'background',
							),
						),
	'transport' 	=> 'postMessage',
	'js_vars'   	=> array(
							array(
								'element'  => '.fancybox-bg',
								'property' => 'background',
								'function' => 'css',
							),
						),
) );



/**
 * Lightbox Overlay: Toolbar's Icon Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_colors_general_lightbox_overlay_toolbar_icon_color',
	'label'       	=> esc_attr__( "Lightbox Overlay: Toolbar's Icon Color", 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'color',
	'section'     	=> 'jeanne_ctmzr_colors_general',
	'default'     	=> '#ccc',
	'sanitize_callback' => 'sanitize_hex_color',
	'choices'     	=> array(
							'alpha' => false,
						),
	'output'		=> array(
							array(
								'element' => '.fancybox-button, .fancybox-button:visited, .fancybox-button:link',
								'property' => 'color',
							),
						),
	'transport' 	=> 'postMessage',
	'js_vars'   	=> array(
							array(
								'element'  => '.fancybox-button, .fancybox-button:visited, .fancybox-button:link',
								'property' => 'color',
								'function' => 'css',
							),
						),
) );



/**
 * Lightbox Overlay: Toolbar's Background Color
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_colors_general_lightbox_overlay_toolbar_background_color',
	'label'       	=> esc_attr__( "Lightbox Overlay: Toolbar's Background Color", 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'color',
	'section'     	=> 'jeanne_ctmzr_colors_general',
	'default'     	=> 'rgba(30,30,30,0.6)',
	'choices'     	=> array(
							'alpha' => true,
						),
	'output'		=> array(
							array(
								'element' => '.fancybox-button',
								'property' => 'background',
							),
						),
	'transport' 	=> 'postMessage',
	'js_vars'   	=> array(
							array(
								'element'  => '.fancybox-button',
								'property' => 'background',
								'function' => 'css',
							),
						),
) );