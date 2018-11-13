<?php
/**
 * Collection of all theme functions
 *
 * @since 1.0.0
 */



/**
 * Register any required and recommended plugins to use with this theme via TGMPA
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_register_additional_plugins' ) ) {
	
	function jeanne_register_additional_plugins() {
		
		$plugins = array(
			
			array(
				'name' 		=> 'Kirki',
				'slug' 		=> 'kirki',
				'required' 	=> true,
			),
			
			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'required' 	=> false,
			),
			
			array(
				'name' 		=> 'UXBARN Portfolio Lite',
				'slug' 		=> 'uxbarn-portfolio-lite',
				'source'	=> get_template_directory() . '/includes/plugin-packages/uxbarn-portfolio-lite_1.0.0.zip',
				'required' 	=> true,
				'version' 	=> '1.0.0',
			),
			
			array(
				'name' 		=> 'Advanced Custom Fields PRO',
				'slug' 		=> 'advanced-custom-fields-pro',
				'source'	=> get_template_directory() . '/includes/plugin-packages/advanced-custom-fields-pro_5.7.6.zip',
				'required' 	=> true,
				'version' 	=> '5.7.6',
			),
			
			array(
				'name' 		=> 'Envato Market',
				'slug' 		=> 'envato-market',
				'source'	=> get_template_directory() . '/includes/plugin-packages/envato-market_2.0.1.zip',
				'required' 	=> true,
				'version' 	=> '2.0.1',
			),
			
		);
	
		tgmpa( $plugins );
		
	}

}



/**
 * Deactivate unused plugins
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_deactivate_plugins' ) ) {
	
	function jeanne_deactivate_plugins() {
		deactivate_plugins( 'uxbarn-portfolio/uxbarn-portfolio.php', false, false );
	}
	
}



/**
 * Show a notification about the plugin deactivation
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_show_plugin_deactivation_notice' ) ) {
		
	function jeanne_show_plugin_deactivation_notice() {
		?>
			<div class="notice notice-success is-dismissible">
				<p><?php _e( 'The UXBARN Portfolio plugin has been deactivated. This theme uses only the lite version (UXBARN Portfolio Lite) which is already bundled with the theme package. You should now see a notification asking you to install it.', 'jeanne' ); ?></p>
			</div>
		<?php
	}
	
}



/**
 * A simple function to return the theme version number
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_theme_version' ) ) {
		
	function jeanne_get_theme_version() {

		$theme = wp_get_theme();
		return $theme->get( 'Version' );
		
	}
	
}



/**
 * Register site menus
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_register_menus' ) ) {
		
	function jeanne_register_menus() {
		
		register_nav_menus( array(
				'main_menu' => esc_html__( 'Main Menu', 'jeanne' ),
			)
		);
		
	}

}



/**
 * Customize the menu classes for setting the active status when viewing on various templates
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_customize_menu_item_classes' ) ) {

	function jeanne_customize_menu_item_classes( $classes, $item, $args ) {
		
		if ( 'main_menu' !== $args->theme_location ) {
			return $classes;
		}
		
		$menu_text = '';
		
		// For Blog
		if ( is_singular( 'post' ) || is_category() || is_tag() || is_author() ) {
			$menu_text = esc_html( get_theme_mod( 'jeanne_ctmzr_settings_blog_menu_text_active_status', esc_html__( 'Blog', 'jeanne' ) ) );
		}
		
		// For Portfolio
		if ( is_tax( 'uxbarn_portfolio_tax' ) || is_singular( 'uxbarn_portfolio' ) ) {
			$menu_text = esc_html( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_menu_text_active_status', esc_html__( 'Works', 'jeanne' ) ) );
		}
		
		if ( $menu_text === $item->title ) {
			$classes[] = 'current-menu-item';
		}
		
		return array_unique( $classes );
		
	}

}



if ( ! function_exists( 'jeanne_register_widget_areas' ) ) {
	
	function jeanne_register_widget_areas() {
		
		// Theme Widget Area
		$column_number = jeanne_get_widget_column_number();
	
		for ( $i = 1; $i <= $column_number; $i++ ) {
			
			register_sidebar( array (
				'name' 			=> sprintf( esc_html__( 'Footer Column %d', 'jeanne' ), $i ),
				'id' 			=> 'jeanne-widget-area-' . $i,
				'description' 	=> '',
				'before_widget' => '<section id="%1$s" class="%2$s widget-item">',
				'after_widget' 	=> '</section>',
				'before_title' 	=> '<h4 class="widget-title">',
				'after_title' 	=> '</h4>',
				)
			);
			
		}
		
	}

}



if ( ! function_exists( 'jeanne_get_widget_column_number' ) ) {
	
	function jeanne_get_widget_column_number() {
		return intval( get_theme_mod( 'jeanne_ctmzr_settings_general_footer_widget_area_column_number', 3 ) );
	}

}
	


/**
 * Adjust the number of posts per page in the search template
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_adjust_search_posts_per_page' ) ) {

	function jeanne_adjust_search_posts_per_page( $query ) {
		
		if ( $query->is_search() ) {
			$query->set( 'posts_per_page', get_theme_mod( 'jeanne_ctmzr_settings_general_number_of_posts_search_results', 10 ) );
		}
		
	}

}



/**
 * Register theme image sizes
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_register_theme_image_sizes' ) ) {
		
	function jeanne_register_theme_image_sizes() {
		
		add_image_size( 'jeanne-large', 1140, 9999 );
		add_image_size( 'jeanne-medium', 880, 9999 );
		add_image_size( 'jeanne-portfolio-grid', 9999, 600 );
		
	}
	
}



/**
 * For getting the image size for blog posts
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_blog_image_size' ) ) {
		
	function jeanne_get_blog_image_size() {
		
		$image_size = 'jeanne-large';
		
		// In case users want to use the full-size image (it will make the GIF animation work)
		$use_full_size = get_theme_mod( 'jeanne_ctmzr_settings_blog_use_full_size', false );
		if ( $use_full_size ) {
			$image_size = 'full';
		}
		
		return $image_size;
		
	}
	
}



/**
 * For getting the image size for pages
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_page_image_size' ) ) {
		
	function jeanne_get_page_image_size() {
		
		$image_size = 'jeanne-large';
		
		// In case users want to use the full-size image (it will make the GIF animation work)
		$use_full_size = get_theme_mod( 'jeanne_ctmzr_settings_page_use_full_size', false );
		if ( $use_full_size ) {
			$image_size = 'full';
		}
		
		return $image_size;
		
	}
	
}



/**
 * Modify WP post_class() via a filter in functions.php
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_modify_post_classes' ) ) {

	function jeanne_modify_post_classes( $classes, $class, $post_id ) {
		
		if ( is_home() || is_page() || is_single() || is_archive() || is_search() ) {
			
			$classes = array_merge( $classes, array( 'post-item', 'clearfix' ) );

			if ( ! has_post_thumbnail() ) {
				$classes[] = 'no-featured-image';
			} else {
				$classes[] = 'has-featured-image';
			}
			
			if ( is_singular( 'uxbarn_portfolio' ) ) {
				
				$post_format = get_post_meta( $post_id, 'uxbarn_portfolio_item_format', true );
				$classes[] = $post_format;
				
			}
			
		}
		
		return $classes;
		
	}

}



/**
 * Get a special class for the blog list pages
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_post_list_class' ) ) {

	function jeanne_get_post_list_class() {
	
		$list_class = '';
		
		if ( is_home() ) {
			$list_class = 'blog-list';
		}
		
		if ( is_search() ) {
			$list_class = 'search-result-list';
		}
		
		if ( is_archive() ) {
			$list_class = 'blog-list archive-list';
		}
		
		return $list_class;
			
	}
	
}



/**
 * Modify the output of page titles
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_modify_page_titles' ) ) {

	function jeanne_modify_page_titles( $title ) {
		
		$findthese = array(
			'#Protected:#',
			'#Private:#'
		);

		$replacewith = array(
			'', // What to replace "Protected:" with
			'' // What to replace "Private:" with
		);

		$title = preg_replace( $findthese, $replacewith, $title );
		return $title;

	}

}



/**
 * Print the custom trimmed excerpt by character length
 * The function must be used in The Loop
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_the_excerpt_max_charlength' ) ) {
		
	function jeanne_the_excerpt_max_charlength( $charlength ) {
		
		$excerpt = get_the_excerpt();
		
		if ( ! empty( $excerpt ) ) {
				
			$charlength++;

			if ( mb_strlen( $excerpt ) > $charlength ) {
				
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					echo mb_substr( $subex, 0, $excut );
				} else {
					echo esc_html( $subex );
				}
				
				echo '...';
				
			} else {
				echo esc_html( $excerpt );
			}
			
			if ( ! is_search() ) {
				
				$read_more_text = get_theme_mod( 'jeanne_ctmzr_settings_blog_read_more_text', esc_html__( 'Read more', 'jeanne' ) );
				
				echo '<div class="more-link-wrapper"><a class="more-link" href="' . get_permalink() . '">' . esc_html( $read_more_text ) . '</a></div>';
			}
			
		}
		
	}

}



/**
 * Extend the word count of the excerpt to 999
 * So the "jeanne_the_excerpt_max_charlength()" above is in charge
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_extend_wp_excerpt_word_length' ) ) {

	function jeanne_extend_wp_excerpt_word_length( $length ) {
		return 999;
	}

}



/**
 * For printing out post excerpt in index.php
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_print_post_excerpt' ) ) {

	function jeanne_print_post_excerpt() {
		jeanne_the_excerpt_max_charlength( get_theme_mod( 'jeanne_ctmzr_settings_blog_excerpt_length', 370 ) );
	}

}



/**
 * For getting the array of the blog meta info users want to display
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_blog_meta_info_display' ) ) {

	function jeanne_get_blog_meta_info_display() {
		return get_theme_mod( 'jeanne_ctmzr_settings_blog_meta_info_display', array( 'author', 'comments', 'author-bio', 'categories', 'tags' ) );
	}

}



/**
 * Get the final output of the intro
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_intro_output' ) ) {

	function jeanne_get_intro_output( $intro ) {
		
		return jeanne_wp_kses_escape( $intro );
		
	}

}



/**
 * Adjust the title in archive templates
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_filter_archive_title' ) ) {
		
	function jeanne_filter_archive_title( $title ) {
		
		if ( is_category() ) {
			
			$title = single_cat_title( '', false );
			
		} else if ( is_tag() ) {
			
			$title = single_tag_title( '', false );
			
		} else if ( is_author() ) {
			
			$title = '<span class="vcard">' . get_the_author() . '</span>' ;
			
		} else if ( is_tax( 'uxbarn_portfolio_tax' ) ) {
			
			$title = single_term_title( '', false );
			
		}

		return $title;
		
	}
	
}



/**
 * Print the pagination on single posts and pages
 * Must be used within the Loop
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_print_post_pagination' ) ) {

	function jeanne_print_post_pagination() {
		
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jeanne' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'jeanne' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		
	}

}



/**
 * Print the pagination on single blog posts
 * Must be used within the Loop
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_print_post_navigation' ) ) {

	function jeanne_print_post_navigation() {
		
		$show_in_same_term = get_theme_mod( 'jeanne_ctmzr_settings_blog_link_same_category_posts', false );
		
		$image_size = 'thumbnail';
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		
		$prev_image_string = '';
		if ( $prev_post )  {
			$prev_image_string = '<div class="nav-post-image">' . get_the_post_thumbnail( $prev_post->ID, $image_size ) . '</div>';
		}
		
		$next_image_string = '';
		if ( $next_post ) {
			$next_image_string = '<div class="nav-post-image">' . get_the_post_thumbnail( $next_post->ID, $image_size ) . '</div>';
		}
		
		echo '<div class="next-prev-post-navigation content-width clearfix">';
			
			the_post_navigation( array(
				
				'prev_text' => $prev_image_string . '<div class="nav-title-group"><span class="screen-reader-text">' . esc_html__( 'Previous Post', 'jeanne' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Previous', 'jeanne' ) . '</span><span class="nav-title">%title</span></div>',
						
				'next_text' => $next_image_string . '<div class="nav-title-group"><span class="screen-reader-text">' . esc_html__( 'Next Post', 'jeanne' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Next', 'jeanne' ) . '</span><span class="nav-title">%title</span></div>',
				
				'in_same_term' => $show_in_same_term,
				
			) );
			
		echo '</div>';
			
	}

}



/**
 * Whether to print out the h1 tag for the site title
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_is_site_title_h1_allowed' ) ) {

	function jeanne_is_site_title_h1_allowed() {
		
		if ( is_front_page() ) {
			return true;
		}
		
		return false;
		
	}

}



/**
 * Create a video embed wrapper to handle the max width of the video
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_create_video_embed_wrapper' ) ) {

	function jeanne_create_video_embed_wrapper( $cache, $url, $attr, $post_ID ) {
		
		$wrapper_string = '';
		
		if ( false !== strpos( $url, 'vimeo.com' ) || 
			 false !== strpos( $url, 'youtube.com' ) ||
			 false !== strpos( $url, 'wordpress.tv' ) ) {
			return '<div class="video-wrapper">' . $cache . '</div>';
		} else {
			return $cache;
		}
		
	}

}



/**
 * Display site social icons
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_display_social_networks' ) ) {

	function jeanne_display_social_networks( $type = 'text' ) {
		
		// Default social network urls
		$social_array = jeanne_get_default_social_networks();
		
		// Custom social networks
		$custom_social_array = get_theme_mod( 'jeanne_ctmzr_site_identity_custom_social_networks', array() );
		
		// Merge both together
		$final_social_array = $social_array + $custom_social_array;
		
		// Check if there is any URL entered so the wrapper will be printed out
		$are_all_urls_empty = true;
		foreach( $final_social_array as $social ) {
			if ( ! empty( $social['url'] ) ) {
				$are_all_urls_empty = false;
				break;
			}
		}
		
		// Print out the social networks
		if ( ! $are_all_urls_empty ) {
			
			$social_ul_class = 'social-icons';
			if ( 'text' === $type ) {
				$social_ul_class = 'social-links';
			}
			
			echo '<div class="social-network-wrapper"><ul class="' . esc_attr( $social_ul_class ) . '">';
			
			foreach( $final_social_array as $social ) {
				
				if ( ! empty( $social['url'] ) ) {
					
					$url = $social['url'];
					
					// Check if it's an email address
					if ( false !== strpos( $url, '@' ) && filter_var( $url, FILTER_VALIDATE_EMAIL ) ) {
						$url = 'mailto:' . $url;
					}
					
					if ( 'icons' === $type ) {
							
						if ( ! empty( $social['icon'] ) ) {
								
							printf( '<li><a href="%s" target="_blank"><i class="%s"></i></a></li>', 
								esc_url( $url ), 
								esc_attr( $social['icon'] ) 
							);
							
						}
						
					} else {
						
						if ( ! empty( $social['name'] ) ) {
								
							printf( '<li><a href="%s" target="_blank">%s</a></li>', 
								esc_url( $url ), 
								esc_attr( $social['name'] )
							);
							
						}
						
					}
					
				}
				
			}
			
			echo '</ul></div>';
			
		}
		
	}

}



if ( ! function_exists( 'jeanne_get_default_social_networks' ) ) {

	function jeanne_get_default_social_networks() {
		
		$social_array = array();
		$social_array['facebook'] = array(
										'name' => esc_html__( 'Facebook', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_facebook_url', '' ),
										'icon' => 'fab fa-facebook',
									);
		$social_array['twitter'] = array(
										'name' => esc_html__( 'Twitter', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_twitter_url', '' ),
										'icon' => 'fab fa-twitter',
									);
		$social_array['google_plus'] = array(
										'name' => esc_html__( 'Google+', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_google_plus_url', '' ),
										'icon' => 'fab fa-google-plus-g',
									);
		$social_array['instagram'] = array(
										'name' => esc_html__( 'Instagram', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_instagram_url', '' ),
										'icon' => 'fab fa-instagram',
									);
		$social_array['flickr'] = array(
										'name' => esc_html__( 'Flickr', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_flickr_url', '' ),
										'icon' => 'fab fa-flickr',
									);
		$social_array['pinterest'] = array(
										'name' => esc_html__( 'Pinterest', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_pinterest_url', '' ),
										'icon' => 'fab fa-pinterest',
									);
		$social_array['px500'] = array(
										'name' => esc_html__( '500px', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_500px_url', '' ),
										'icon' => 'fab fa-500px',
									);
		$social_array['dribbble'] = array(
										'name' => esc_html__( 'Dribbble', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_dribbble_url', '' ),
										'icon' => 'fab fa-dribbble',
									);
		$social_array['behance'] = array(
										'name' => esc_html__( 'Behance', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_behance_url', '' ),
										'icon' => 'fab fa-behance',
									);
		$social_array['vimeo'] = array(
										'name' => esc_html__( 'Vimeo', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_vimeo_url', '' ),
										'icon' => 'fab fa-vimeo',
									);
		$social_array['youtube'] = array(
										'name' => esc_html__( 'YouTube', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_youtube_url', '' ),
										'icon' => 'fab fa-youtube',
									);
		$social_array['soundcloud'] = array(
										'name' => esc_html__( 'SoundCloud', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_soundcloud_url', '' ),
										'icon' => 'fab fa-soundcloud',
									);
		$social_array['linkedin'] = array(
										'name' => esc_html__( 'LinkedIn', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_linkedin_url', '' ),
										'icon' => 'fab fa-linkedin',
									);
		$social_array['rss'] = array(
										'name' => esc_html__( 'RSS', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_rss_url', '' ),
										'icon' => 'fas fa-rss',
									);
		$social_array['email'] = array(
										'name' => esc_html__( 'Email', 'jeanne' ),
										'url' => get_theme_mod( 'jeanne_ctmzr_site_identity_email', '' ),
										'icon' => 'far fa-envelope',
									);
		
		return $social_array;
		
	}
	
}



/**
 * Print out comments
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_create_custom_comment' ) ) {
	 
	function jeanne_create_custom_comment( $comment, $args, $depth ) {
		
		if ( 'div' === $args['style'] ) {
			
			$tag = 'div';
			$add_below = 'comment';
			
		} else {
			
			$tag = 'li';
			$add_below = 'div-comment';
			
		}

?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		
		<?php if ( 'div' !== $args['style'] ) : ?>
			<article id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
		<?php endif; ?>
		
			<div class="comment-author-avatar">
				<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			
			<div class="comment-content-wrapper">
				
				<?php edit_comment_link( esc_html__( 'Edit', 'jeanne' ), '', '' ); ?>
				
				<footer class="comment-meta">
					<div class="comment-author">
						<?php printf( '<cite class="fn">%s</cite> ', get_comment_author_link() ); ?>
					</div>
					
					<div class="comment-date">
						<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>"><?php echo jeanne_wp_kses_escape( sprintf( __( '%1$s at %2$s', 'jeanne' ), get_comment_date( 'F j, Y' ),  get_comment_time() ) ); ?></a>
					</div>
				</footer>
				
				<div class="comment-content">
					<?php comment_text(); ?>
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( '* Your comment is awaiting moderation.', 'jeanne' ); ?></p>
					<?php endif; ?>
				</div>
				
				<div class="reply">
					<?php 
						
						echo get_comment_reply_link( 
								array_merge( $args, array( 
									'reply_text' 	=> esc_html__( 'Reply', 'jeanne' ),
									'add_below' 	=> $add_below,
									'depth' 		=> $depth,
									'max_depth' 	=> $args['max_depth'],
								) ) 
							);
						
					?>
				</div>
				
			</div>
			
		<?php if ( 'div' !== $args['style'] ) : ?>
			</article>
		<?php endif; ?>
		<?php    
				
	}

}



/**
 * UTILITY FUNCTIONS
 */



/**
 * Sanitize strings using wp_kes() with initial allowed tags
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_wp_kses_escape' ) ) {

	function jeanne_wp_kses_escape( $string, $additional_allowed_tags = array() ) {
		
		return wp_kses( $string, 
			array(
				'span' => array(), 'strong' => array(), 'br' => array(), 'p' => array( 'class' => array() ), 'em' => array(),
				'a'	=> array( 'href' => array(), 'target' => array(), 'title' => array() ),
				'ul' => array( 'id' => array(), 'class' => array() ),
				'li' => array(),
			) + $additional_allowed_tags
		);
		
	}

}



/**
 * Get an attachment array
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_attachment' ) ) {
		
	function jeanne_get_attachment( $attachment_id, $image_size = 'full' ) {
		
		$attachment = get_post( $attachment_id );
		
		// Need to check it first
		if ( isset( $attachment ) ) {
			
			// [0] = src, [1] = width, [2] = height
			$attachment_array = wp_get_attachment_image_src( $attachment_id, $image_size );
			
			return array(
				'id'			=> $attachment->ID,
				'alt' 			=> get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
				'caption' 		=> $attachment->post_excerpt,
				'description' 	=> $attachment->post_content,
				'href' 			=> get_permalink( $attachment->ID ),
				'title' 		=> $attachment->post_title,
				'src' 			=> $attachment_array[0],
				'width'			=> $attachment_array[1],
				'height'		=> $attachment_array[2],
			);
		
		} else {
			
			return array();
			
		}
	}

}



/**
 * Get an attachment id from image URL
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jeanne_get_attachment_id_from_src' ) ) {
	
	function jeanne_get_attachment_id_from_src( $url ) {
		
		$attachment_id = 0;
		$dir = wp_upload_dir();
		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
			$file = basename( $url );
			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
					),
				)
			);
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ) {
				foreach ( $query->posts as $post_id ) {
					$meta = wp_get_attachment_metadata( $post_id );
					$original_file       = basename( $meta['file'] );
					$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
					if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
						$attachment_id = $post_id;
						break;
					}
				}
			}
		}
		return $attachment_id;
		
	}

}
	


if ( ! function_exists( 'jeanne_hex2rgb' ) ) {
	
	function jeanne_hex2rgb( $hex ) {
		
	   $hex = str_replace( "#", "", $hex );
	 
	   if ( strlen( $hex ) == 3 ) {
		
		  $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
		  $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
		  $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
		  
	   } else {
		
		  $r = hexdec( substr( $hex, 0, 2 ) );
		  $g = hexdec( substr( $hex, 2, 2 ) );
		  $b = hexdec( substr( $hex, 4, 2 ) );
		  
	   }
	   
	   $rgb = array( $r, $g, $b );
	   
	   return $rgb; // returns an array with the rgb values
	   
	}
	
}