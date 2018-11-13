<?php
/**
 * Customizer: Portfolio Settings
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_settings_portfolio', array(
	'title'      => esc_attr__( 'Portfolio Settings', 'jeanne' ),
	'priority'   => 15,
	'capability' => 'edit_theme_options',
	'panel'		 => 'jeanne_ctmzr_panel_settings',
) );



// Featured Works Template
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_title01',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<h2 class="custom-heading">' . esc_html__( 'Featured Works Template', 'jeanne' ) . '</h2>',
) );



/**
 * Max Row Height
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_featured_works_grid_max_row_height',
	'label'    			=> esc_attr__( 'Grid Max Row Height (px)', 'jeanne' ),
	'tooltip' 			=> esc_attr__( 'The theme will try to arrange portfolio images within this maximum row height. Note that this will not have any effect on the portfolio items that are using the full-width view.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'number',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> '450',
	'choices'     		=> array(
								'min'  => 0,
								'step' => 1,
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator0',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/>',
) );



/**
 * Select Categories
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_featured_works_categories',
	'label'    			=> esc_attr__( 'Select Categories', 'jeanne' ),
	'description'		=> esc_attr__( 'Select which portfolio categories to display on the template. Unchecking all will display the work from all categories.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'multicheck',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> array(),
	'choices'     		=> jeanne_ctmzr_get_portfolio_categories(),
	'transport'         => 'auto',
) );



/**
 * Max Number of Items
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_featured_works_number_of_items',
	'label'    			=> esc_attr__( 'Max Number of Items', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'number',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> 6,
	'transport'         => 'auto',
) );



/**
 * Order by
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_featured_works_order_by',
	'label'    			=> esc_attr__( 'Order by', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> 'date',
	'multiple'			=> 1,
	'choices'     		=> jeanne_ctmzr_get_order_by_list(),
) );



/**
 * Order
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_featured_works_order',
	'label'    			=> esc_attr__( 'Order', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> 'DESC',
	'multiple'			=> 1,
	'choices'     		=> jeanne_ctmzr_get_order_list(),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator1',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/>',
) );



/**
 * Show Page Content?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_portfolio_featured_works_show_page_content',
	'label'       	=> esc_attr__( 'Show Page Content?', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_portfolio',
	'default'     	=> '1',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );




// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator_end_0',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/><hr/><br/>',
) );




// All Works Template
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_title02',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<h2 class="custom-heading">' . esc_html__( 'All Works Template', 'jeanne' ) . '</h2>',
) );



/**
 * Max Row Height
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_all_works_grid_max_row_height',
	'label'    			=> esc_attr__( 'Grid Max Row Height (px)', 'jeanne' ),
	'tooltip' 			=> esc_attr__( 'The theme will try to arrange portfolio images within this maximum row height. Note that this will not have any effect on the portfolio items that are using the full-width view.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'number',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> '450',
	'choices'     		=> array(
								'min'  => 0,
								'step' => 1,
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator2',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/>',
) );



/**
 * Select Categories
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_all_works_categories',
	'label'    			=> esc_attr__( 'Select Categories', 'jeanne' ),
	'description'		=> esc_attr__( 'Select which portfolio categories to display on the template. Unchecking all will display the work from all categories.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'multicheck',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> array(),
	'choices'     		=> jeanne_ctmzr_get_portfolio_categories(),
	'transport'         => 'auto',
) );



/**
 * Number of Items
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_all_works_number_of_items',
	'label'    			=> esc_attr__( 'Number of Items per Page', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'number',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> 8,
	'transport'         => 'auto',
) );



/**
 * Order by
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_all_works_order_by',
	'label'    			=> esc_attr__( 'Order by', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> 'date',
	'multiple'			=> 1,
	'choices'     		=> jeanne_ctmzr_get_order_by_list(),
) );



/**
 * Order
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_all_works_order',
	'label'    			=> esc_attr__( 'Order', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> 'DESC',
	'multiple'			=> 1,
	'choices'     		=> jeanne_ctmzr_get_order_list(),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator3',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/>',
) );



/**
 * Show Page Content?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_portfolio_all_works_show_page_content',
	'label'       	=> esc_attr__( 'Show Page Content?', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_portfolio',
	'default'     	=> '0',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator4',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/>',
) );



/**
 * Show Category Menu?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_portfolio_show_category_menu',
	'label'       	=> esc_attr__( 'Show Category Menu?', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_portfolio',
	'default'     	=> '1',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



/**
 * Set Active Category
 * 
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_active_term_id',
	'label'    			=> esc_attr__( 'Set Active Category', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> '',
	'type'     			=> 'select',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> jeanne_ctmzr_get_default_active_portfolio_category(),
	'multiple'			=> 1,
	'choices'     		=> jeanne_ctmzr_get_portfolio_categories_for_active_setting(),
	'transport'         => 'auto',
) );



/**
 * "All" Category Menu Text
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_category_menu_text_all',
	'label'    			=> esc_attr__( '"All" Category Menu Text', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> esc_html__( 'All Works', 'jeanne' ),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator_end_1',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/><hr/><br/>',
) );



// Portfolio Single Pages
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_title03',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<h2 class="custom-heading">' . esc_html__( 'Portfolio Single Pages', 'jeanne' ) . '</h2>',
) );



/**
 * Max Row Height
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_single_grid_max_row_height',
	'label'    			=> esc_attr__( 'Grid Max Row Height (px)', 'jeanne' ),
	'tooltip' 			=> esc_attr__( 'The theme will try to arrange portfolio images within this maximum row height. Note that this will not have any effect on the portfolio items that are using the full-width view.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'number',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> '450',
	'choices'     		=> array(
								'min'  => 0,
								'step' => 1,
							),
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator5',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/>',
) );



/**
 * Enable Lightbox?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_portfolio_single_enable_lightbox',
	'label'       	=> esc_attr__( 'Enable Lightbox?', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_portfolio',
	'default'     	=> '1',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



/**
 * Enable Related Category Links?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_portfolio_single_enable_related_category_links',
	'label'       	=> esc_attr__( 'Enable Related Category Links?', 'jeanne' ),
	'description' 	=> esc_attr__( 'This section displays at the bottom of the portfolio single page.', 'jeanne' ),
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_portfolio',
	'default'     	=> '1',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



/**
 * Enable Comments?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_portfolio_single_enable_comments',
	'label'       	=> esc_attr__( 'Enable Comments?', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_portfolio',
	'default'     	=> '0',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator_end_2',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<br/><hr/><br/>',
) );



// Others
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_title04',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description' => '<h2 class="custom-heading">' . esc_html__( 'Others', 'jeanne' ) . '</h2>',
) );



/**
 * Use Full Size Image on Portfolio Templates?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_templates_use_full_size',
	'label'    			=> esc_attr__( 'Use Full Size Image on Portfolio Templates?', 'jeanne' ),
	'description' 		=> esc_attr__( 'If this is enabled, the full size (original size) of the featured image will be used instead of the theme image sizes. It will also make the GIF animation work.', 'jeanne' ),
	'tooltip'      		=> '',
	'type'     			=> 'switch',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> '0',
	'choices' 			=> array(
								'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
								'off' 	=> esc_attr__( 'No', 'jeanne' ),
							),
	'transport'         => 'auto',
) );



/**
 * Use Full Size Image on Portfolio Single Pages?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_single_use_full_size',
	'label'    			=> esc_attr__( 'Use Full Size Image on Portfolio Single Pages?', 'jeanne' ),
	'description' 		=> '',
	'tooltip'      		=> '',
	'type'     			=> 'switch',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> '0',
	'choices' 			=> array(
								'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
								'off' 	=> esc_attr__( 'No', 'jeanne' ),
							),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator6',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description'     => '<br/>',
) );



/**
 * View More Works Text
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_view_more_works_text',
	'label'    			=> esc_attr__( 'View More Works Text', 'jeanne' ),
	'description' 		=> esc_attr__( 'This text displays at the bottom of each portfolio single page.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> esc_attr__( 'View more work in this category:', 'jeanne' ),
	'transport'         => 'auto',
) );



/**
 * View More Works Text (Many Categories)
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_view_more_works_text_many',
	'label'    			=> esc_attr__( 'View More Works Text (Many Categories)', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> esc_attr__( 'View more work in these categories:', 'jeanne' ),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator7',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description'     => '<br/>',
) );



/**
 * Portfolio Menu Text for Active Status
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_menu_text_active_status',
	'label'    			=> esc_attr__( 'Portfolio Menu Text for Active Status', 'jeanne' ),
	'description' 		=> esc_attr__( 'By default, when viewing a portfolio single page, WP will not set the active status on the blog menu. Use this option to tell WP what text on the menu to be set as active for portfolio-related pages.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> esc_attr__( 'Works', 'jeanne' ),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_portfolio_separator8',
	'section'     => 'jeanne_ctmzr_settings_portfolio',
	'description'     => '<br/>',
) );



/**
 * Portfolio Category Slug
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_category_slug',
	'label'    			=> esc_attr__( 'Portfolio Category Slug', 'jeanne' ),
	'description' 		=> jeanne_wp_kses_escape( __( '<p>The slug is displayed in the URL when viewing the portfolio category template.</p><p>IMPORTANT: Make sure that these slugs are NOT the same as any page slug.</p><p>*After saving, go to "Settings > Permalinks" and click save to make the new slugs work.</p>', 'jeanne' ) ),
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> esc_html__( 'portfolio-category', 'jeanne' ),
	'transport'         => 'auto',
) );



/**
 * Portfolio Slug
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_portfolio_slug',
	'label'    			=> esc_attr__( 'Portfolio Slug', 'jeanne' ),
	'description' 		=> jeanne_wp_kses_escape( __( '<p>The slug is displayed in the URL when viewing portfolio single pages.', 'jeanne' ) ),
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_portfolio',
	'default'  			=> esc_html__( 'portfolio', 'jeanne' ),
	'transport'         => 'auto',
) );