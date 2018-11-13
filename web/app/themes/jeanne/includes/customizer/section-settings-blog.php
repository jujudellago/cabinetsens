<?php
/**
 * Customizer: Blog Settings
 *
 * @since 1.0.0
 */

Kirki::add_section( 'jeanne_ctmzr_settings_blog', array(
	'title'      => esc_attr__( 'Blog Settings', 'jeanne' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'		 => 'jeanne_ctmzr_panel_settings',
) );



/**
 * Enable Auto Blog Layout?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_enable_auto_blog_layout',
	'label'    			=> esc_attr__( 'Enable Auto Blog Layout?', 'jeanne' ),
	'description' 		=> esc_attr__( 'If this is enabled, the layout of a post on the blog list will be adjusted depending on the orientation of the featured image.', 'jeanne' ),
	'tooltip'      		=> '',
	'type'     			=> 'switch',
	'section'  			=> 'jeanne_ctmzr_settings_blog',
	'default'  			=> '1',
	'choices' 			=> array(
								'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
								'off' 	=> esc_attr__( 'No', 'jeanne' ),
							),
	'transport'         => 'auto',
) );



/**
 * Blog Excerpt Length
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_blog_excerpt_length',
	'label'    			=> esc_attr__( 'Blog Excerpt Length', 'jeanne' ),
	'tooltip' 			=> esc_attr__( 'The number of character for the excerpt that displays on the blog list page.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'number',
	'section'  			=> 'jeanne_ctmzr_settings_blog',
	'default'  			=> 370,
	'choices'     		=> array(
								'min'  => 1,
								'step' => 1,
							),
	'transport'         => 'auto',
) );



/**
 * Read More Text
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_blog_read_more_text',
	'label'    			=> esc_attr__( 'Read More Text', 'jeanne' ),
	'description' 		=> '',
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_blog',
	'default'  			=> esc_html__( 'Read more', 'jeanne' ),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_blog_blank1',
	'section'     => 'jeanne_ctmzr_settings_blog',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Enable Post Navigation?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_blog_enable_post_navigation',
	'label'       	=> esc_attr__( 'Enable Post Navigation?', 'jeanne' ),
	'description' 	=> esc_attr__( 'This navigation is on the blog single page.', 'jeanne' ),
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_blog',
	'default'     	=> '1',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



/**
 * Post Navigation: Link Same Category Posts Only?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_blog_link_same_category_posts',
	'label'       	=> esc_attr__( 'Post Navigation: Link Same Category Posts Only?', 'jeanne' ),
	'description' 	=> esc_attr__( 'If this option is disabled, the navigation will link the posts from all categories.', 'jeanne' ),
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_blog',
	'default'     	=> '0',
	'choices' 		=> array(
							'on' 	=> esc_attr__( 'Yes', 'jeanne' ),
							'off' 	=> esc_attr__( 'No', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



/**
 * Enable Blog Comments?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_blog_enable_blog_comment',
	'label'       	=> esc_attr__( 'Enable Blog Comments?', 'jeanne' ),
	'description' 	=> '',
	'type'        	=> 'switch',
	'section'     	=> 'jeanne_ctmzr_settings_blog',
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
	'settings'    => 'jeanne_ctmzr_settings_blog_blank2',
	'section'     => 'jeanne_ctmzr_settings_blog',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Meta Info Display
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings'    	=> 'jeanne_ctmzr_settings_blog_meta_info_display',
	'label'       	=> esc_attr__( 'Meta Info Display', 'jeanne' ),
	'description' 	=> esc_attr__( 'Select which meta info you want to display on the blog list and single posts.', 'jeanne' ),
	'type'        	=> 'multicheck',
	'section'     	=> 'jeanne_ctmzr_settings_blog',
	'default'     	=> array( 'author', 'comments', 'author-bio', 'categories', 'tags' ),
	'choices' 		=> array(
							'author' => esc_attr__( 'Author', 'jeanne' ),
							'comments' => esc_attr__( 'Comments', 'jeanne' ),
							'author-bio' => esc_attr__( 'Author Bio', 'jeanne' ),
							'categories' => esc_attr__( 'Categories', 'jeanne' ),
							'tags' => esc_attr__( 'Tags', 'jeanne' ),
						),
	'transport'         => 'auto',
) );



// Separator
Kirki::add_field( 'uxbarn_jeanne', array(
	'type'        => 'custom',
	'settings'    => 'jeanne_ctmzr_settings_blog_blank3',
	'section'     => 'jeanne_ctmzr_settings_blog',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Use Full Size Image on Blog Posts?
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_blog_use_full_size',
	'label'    			=> esc_attr__( 'Use Full Size Image on Blog Posts?', 'jeanne' ),
	'description' 		=> esc_attr__( 'If this is enabled, the full size (original size) of the featured image will be used instead of the theme image sizes. It will also make the GIF animation work.', 'jeanne' ),
	'tooltip'      		=> '',
	'type'     			=> 'switch',
	'section'  			=> 'jeanne_ctmzr_settings_blog',
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
	'settings'    => 'jeanne_ctmzr_settings_blog_blank4',
	'section'     => 'jeanne_ctmzr_settings_blog',
	'description' => '<br/><hr/><br/>',
) );



/**
 * Blog Menu Text for Active Status
 *
 * @since 1.0.0
 */
Kirki::add_field( 'uxbarn_jeanne', array(
	'settings' 			=> 'jeanne_ctmzr_settings_blog_menu_text_active_status',
	'label'    			=> esc_attr__( 'Blog Menu Text for Active Status', 'jeanne' ),
	'description' 		=> esc_attr__( 'By default, when viewing a blog single page, WP will not set the active status on the blog menu. Use this option to tell WP what text on the menu to be set as active for blog-related pages.', 'jeanne' ),
	'help'        		=> '',
	'type'     			=> 'text',
	'section'  			=> 'jeanne_ctmzr_settings_blog',
	'default'  			=> esc_attr__( 'Blog', 'jeanne' ),
	'transport'         => 'auto',
) );