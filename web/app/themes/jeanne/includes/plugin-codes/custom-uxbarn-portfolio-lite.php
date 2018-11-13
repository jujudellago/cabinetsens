<?php
/**
 * Customizing UXBARN Portfolio Lite plugin
 *
 * @since 1.0.0
 */



if ( ! function_exists( 'jeanne_portfolio_custom' ) ) {
	
	function jeanne_portfolio_custom() {
		
		// Filter to override the plugin's CPT argument
		add_filter( 'uxb_port_register_cpt_args_filter', 'jeanne_custom_port_cpt_args' );
		
		// Filter to override the plugin's taxonomy argument
		add_filter( 'uxb_port_register_tax_args_filter', 'jeanne_custom_port_tax_args' );
		
		// Modify the query when displaying portfolio items
		add_action( 'pre_get_posts', 'jeanne_modify_portfolio_query' );
		
	}
	
}



if ( ! function_exists( 'jeanne_custom_port_cpt_args' ) ) {

	function jeanne_custom_port_cpt_args( $args ) {
	
		$args = array(
					'label' 			=> esc_html__( 'Portfolio', 'jeanne' ),
					'labels' 			=> array(
												'singular_name'		=> esc_html__( 'Portfolio', 'jeanne' ),
												'add_new' 			=> esc_html__( 'Add New Portfolio Item', 'jeanne' ),
												'add_new_item' 		=> esc_html__( 'Add New Portfolio Item', 'jeanne' ),
												'new_item' 			=> esc_html__( 'New Portfolio Item', 'jeanne' ),
												'edit_item' 		=> esc_html__( 'Edit Portfolio Item', 'jeanne' ),
												'all_items' 		=> esc_html__( 'All Portfolio Items', 'jeanne' ),
												'view_item' 		=> esc_html__( 'View Portfolio', 'jeanne' ),
												'search_items' 		=> esc_html__( 'Search Portfolio', 'jeanne' ),
												'not_found' 		=> esc_html__( 'Nothing found', 'jeanne' ),
												'not_found_in_trash' => esc_html__( 'Nothing found in Trash', 'jeanne' ),
											),
					'menu_icon' 		=> JEANNE_THEME_ROOT_IMAGE_URL . 'uxbarn-admin-s.jpg',
					'description' 		=> '',
					'public' 			=> true,
					'show_ui' 			=> true,
					'capability_type' 	=> 'post',
					'hierarchical' 		=> false,
					'has_archive' 		=> false,
					'supports' 			=> array( 'title', 'editor', 'thumbnail', 'revisions', 'comments' ),
					'rewrite' 			=> array( 'slug' => esc_html( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_slug', esc_html__( 'portfolio', 'jeanne' ) ) ), 'with_front' => false )
				);
		
		return $args;
		
	}

}



if ( ! function_exists( 'jeanne_custom_port_tax_args' ) ) {

	function jeanne_custom_port_tax_args( $args ) {
	
		$args = array(
					'label' 			=> esc_html__( 'Portfolio Categories', 'jeanne' ), 
					'labels' 			=> array(
											'singular_name' => esc_html__( 'Portfolio Category', 'jeanne' ),
											'search_items' 	=> esc_html__( 'Search Categories', 'jeanne' ),
											'all_items' 	=> esc_html__( 'All Categories', 'jeanne' ),
											'edit_item' 	=> esc_html__( 'Edit Category', 'jeanne' ), 
											'update_item' 	=> esc_html__( 'Update Category', 'jeanne' ),
											'add_new_item' 	=> esc_html__( 'Add New Category', 'jeanne' ),
										),
					'singular_label' 	=> esc_html__( 'Portfolio Category', 'jeanne' ),
					'hierarchical' 		=> true, 
					'rewrite' 			=> array( 'slug' => esc_html( get_theme_mod( 'jeanne_ctmzr_settings_portfolio_category_slug', esc_html__( 'portfolio-category', 'jeanne' ) ) ) ),
				);
				
		return $args;
	
	}
	
}



if ( ! function_exists( 'jeanne_get_current_portfolio_template' ) ) {

	function jeanne_get_current_portfolio_template() {
		
		$current_template = 'all-works';
		if ( is_page_template( 'template-featured-works.php' ) ) {
			$current_template = 'featured-works';
		}
		
		return $current_template;
		
	}
	
}



if ( ! function_exists( 'jeanne_modify_portfolio_query' ) ) {

	function jeanne_modify_portfolio_query( $query ) {
		
		// This will be applied to portfolio taxonomy template
		if ( $query->is_tax( 'uxbarn_portfolio_tax' ) && 
			 ! is_page_template( 'template-all-works.php' ) && 
			 ! is_page_template( 'template-featured-works.php' ) ) {
			
			$query_values = jeanne_get_portfolio_all_works_template_values();
			
			// Posts per page
			$query->set( 'posts_per_page', $query_values['posts_per_page'] );
			
			// Order by
			$query->set( 'orderby', $query_values['orderby'] );
			
			// Order
			$query->set( 'order', $query_values['order'] );
			
		}
		
	}

}



if ( ! function_exists( 'jeanne_get_portfolio_all_works_template_values' ) ) {

	function jeanne_get_portfolio_all_works_template_values() {
		
		return array(
			'posts_per_page'	=> get_theme_mod( 'jeanne_ctmzr_settings_portfolio_all_works_number_of_items', 8 ),
			'orderby'			=> get_theme_mod( 'jeanne_ctmzr_settings_portfolio_all_works_order_by', 'date' ),
			'order'				=> get_theme_mod( 'jeanne_ctmzr_settings_portfolio_all_works_order', 'DESC' ),
		);
		
	}

}



if ( ! function_exists( 'jeanne_get_active_term_id' ) ) {

	function jeanne_get_active_term_id() {
		return (int)get_theme_mod( 'jeanne_ctmzr_settings_portfolio_active_term_id', 0 );
	}

}



if ( ! function_exists( 'jeanne_is_portfolio_all_menu_item_displayed' ) ) {

	function jeanne_is_portfolio_all_menu_item_displayed() {
		return get_theme_mod( 'jeanne_ctmzr_settings_portfolio_display_menu_item_all', true );
	}

}



if ( ! function_exists( 'jeanne_is_portfolio_category_menu_displayed' ) ) {

	function jeanne_is_portfolio_category_menu_displayed() {
		return get_theme_mod( 'jeanne_ctmzr_settings_portfolio_show_category_menu', true );
	}

}



if ( ! function_exists( 'jeanne_get_portfolio_individual_image_size' ) ) {

	function jeanne_get_portfolio_individual_image_size( $enable_full_width, $image_size ) {
		
		if ( $enable_full_width ) {
			$image_size = 'jeanne-large';
		}
		
		return $image_size;
		
	}

}



if ( ! function_exists( 'jeanne_print_portfolio_loading' ) ) {

	function jeanne_print_portfolio_loading() {
		?>
		
		<div class="portfolio-loading-wrapper">
			<div class="portfolio-loading">
				<span class="loading-text"><?php echo esc_html__( 'Loading', 'jeanne' ); ?></span>
				<div class="loading-bar">
					<div class="progress-bar"></div>
				</div>
			</div>
		</div>
		
		<?php
	}
	
}
	


if ( ! function_exists( 'jeanne_print_portfolio_image_format_content' ) ) {

	function jeanne_print_portfolio_image_format_content( $images ) {
		
		if ( $images ) {
			
			echo '<div class="image-format portfolio-format-group">';
			
			$is_lightbox_enabled = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_single_enable_lightbox', true );
			
			$is_currently_justified = false;
			$is_tag_previously_opened = false;
			$counter = 1;
			$total = count( $images );
			
			// Create gallery images
			foreach( $images as $image ) {
				
				$individual_image_size = 'jeanne-portfolio-grid';
				
				// Check if each attachment's display size is specifically set
				if ( function_exists( 'get_field' ) ) {
					
					$enable_full_width = get_field( 'uxbarn_portfolio_attachment_is_full_width_on_singles', $image['ID'] );
					$individual_image_size = jeanne_get_portfolio_individual_image_size( $enable_full_width, $individual_image_size );
					
				}
				
				// In case users want to use the full-size image (it will make the GIF animation work)
				$use_full_size = get_theme_mod( 'jeanne_ctmzr_settings_portfolio_single_use_full_size', false );
				if ( $use_full_size ) {
					$individual_image_size = 'full';
				}
				
				
				
				if ( $enable_full_width ) {
					
					if ( $is_currently_justified ) {
						echo '</div>';
					} else {
						
						if ( $is_tag_previously_opened ) {
							echo '</div>';
						}
						
					}
					
					echo '<div class="full-width image-format-block clearfix">';
					$is_currently_justified = false;
					$is_tag_previously_opened = true;
					
				} else {
					
					if ( ! $is_currently_justified ) {
						
						if ( $is_tag_previously_opened ) {
							echo '</div>';
						}
					
						echo '<div class="justified-images image-format-block clearfix">';
						$is_currently_justified = true;
						$is_tag_previously_opened = true;
						
					}
					
				}
				
				
				
				// Prepare the image code and classes
				$image_code = wp_get_attachment_image( $image['ID'], $individual_image_size );
				$full_image_srcset = wp_get_attachment_image_srcset( $image['ID'], 'full' );
				$caption = $image['caption'];
				
				$width = $image['width'];
				$height = $image['height'];
				$orientation_class = 'landscape';
				
				if ( $height > 0 && $width/$height < 1 ) {
					$orientation_class = 'portrait';
				}
				
				$item_class = implode( ' ', array( $orientation_class, 'image-' . $image['ID'], $individual_image_size ) );
				
				// Print out image-format item
				echo '<div class="portfolio-format-item image-wrapper ' . esc_attr( $item_class ) . '" data-w="' . intval( $width ) . '" data-h="' . intval( $height ) . '">';
				echo 	'<div class="inner-image-wrapper">';
				
				if ( $is_lightbox_enabled ) {
					echo '<a href="' . esc_url( $image['url'] ) . '" class="image-lightbox" data-fancybox="portfolio-images" data-caption="' . esc_attr( $caption ) . '" data-srcset="' . esc_attr( $full_image_srcset ) . '">' . $image_code . '</a>';
				} else {
					echo '<div class="image-only">' . $image_code . '</div>';
				}
				
				echo 		'<div class="curtain"></div>';
		
				echo 	'</div>';
				
				if ( ! empty( $caption ) ) {
					echo '<div class="image-caption caption-element">' . jeanne_wp_kses_escape( $caption ) . '</div>';
				}
				
				echo '</div>';
				
				
				
				if ( $counter === $total ) {
					
					if ( $is_tag_previously_opened ) {
						echo '</div>';
					}
					
				}
				
				$counter++;
				
			} // end foreach
			
			echo '</div>'; // .portfolio-format-group
			
		} // if ( $images )
		
	}
	
}



if ( ! function_exists( 'jeanne_print_portfolio_video_format_content' ) ) {

	function jeanne_print_portfolio_video_format_content( $video_url, $caption ) {
		
		echo '<div class="video-format portfolio-format-group"><div class="video-format-block">';
		echo 	'<div class="portfolio-format-item">';
		echo 		'<div class="video-wrapper">' . wp_oembed_get( esc_url( $video_url ) ) . '</div>';
		
		if ( ! empty( $caption ) ) {
			echo 	'<div class="video-caption caption-element">' . jeanne_wp_kses_escape( $caption ) . '</div>';
		}
		
		echo 		'<div class="curtain"></div>';
		
		echo 	'</div>';
		echo '</div></div>';
		
	}
	
}



if ( ! function_exists( 'jeanne_print_portfolio_post_navigation' ) ) {

	function jeanne_print_portfolio_post_navigation() {
		
		$show_in_same_term = get_theme_mod( 'jeanne_ctmzr_portfolio_options_link_only_same_categories', true );
		
		$image_size = 'thumbnail';
		$prev_post = get_adjacent_post( $show_in_same_term, '', true, 'uxbarn_portfolio_tax' );
		$next_post = get_adjacent_post( $show_in_same_term, '', false, 'uxbarn_portfolio_tax' );
		
		$prev_image_string = '';
		if ( $prev_post )  {
			$prev_image_string = '<div class="nav-post-image">' . get_the_post_thumbnail( $prev_post->ID, $image_size ) . '</div>';
		}
		
		$next_image_string = '';
		if ( $next_post ) {
			$next_image_string = '<div class="nav-post-image">' . get_the_post_thumbnail( $next_post->ID, $image_size ) . '</div>';
		}
		
		echo '<div class="next-prev-post-navigation clearfix">';
			
			the_post_navigation( array(
				
				'prev_text' => $prev_image_string . '<div class="nav-title-group"><span class="screen-reader-text">' . esc_html__( 'Previous Post', 'jeanne' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Previous', 'jeanne' ) . '</span><span class="nav-title">%title</span></div>',
						
				'next_text' => $next_image_string . '<div class="nav-title-group"><span class="screen-reader-text">' . esc_html__( 'Next Post', 'jeanne' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Next', 'jeanne' ) . '</span><span class="nav-title">%title</span></div>',
				
				'in_same_term' => $show_in_same_term,
				'taxonomy' => 'uxbarn_portfolio_tax',
				
			) );
			
		echo '</div>';
		
	}

}



if ( ! function_exists( 'jeanne_print_related_work_text' ) ) {

	function jeanne_print_related_work_text( $category_count ) {
		
		if ( $category_count > 1 ) {
			return get_theme_mod( 'jeanne_ctmzr_settings_portfolio_view_more_works_text_many', esc_html__( 'View more work in these categories: ', 'jeanne' ) );
		} else {
			return get_theme_mod( 'jeanne_ctmzr_settings_portfolio_view_more_works_text', esc_html__( 'View more work in this category: ', 'jeanne' ) );
		}
		
	}
	
}



if ( ! function_exists( 'jeanne_print_related_work_section' ) ) {

	function jeanne_print_related_work_section() {
	?>
		<section class="portfolio-related-work">
			<div class="inner-portfolio-related-work clearfix">
				
				<?php
					
					$categories = get_the_terms( get_the_ID(), 'uxbarn_portfolio_tax' );
					
					if ( ! empty( $categories ) ) {
						
						$text = jeanne_print_related_work_text( count( $categories) );
						echo '<span class="more-work-text">' . esc_html( $text ) . '</span>';
						
						foreach ( $categories as $category ) {
							echo '<span class="related-category term-' . esc_attr( $category->term_id ) . '"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
						}
						
					}
					
					
				?>
				
			</div>
			<!-- inner-portfolio-related-work -->
		</section>
	
	<?php
	}
	
}



if ( ! function_exists( 'jeanne_create_portfolio_sessions' ) ) {

	function jeanne_create_portfolio_sessions( $current_template, $post_count ) {
		
		// Most sessions here are to be used in the "portfolio-listing-loop.php" file
		
		$featured_works_full_width_enabled = true;
		$all_works_full_width_enabled = true;
		
		
		if ( ( 'featured-works' === $current_template && ! $featured_works_full_width_enabled ) ||
			 ( 'all-works' === $current_template && ! $all_works_full_width_enabled ) ) {
			
			$_SESSION['template_full_width_enabled'] = false;
			echo '<div class="justified-images portfolio-item-block">';
			
		} else {
			
			$_SESSION['template_full_width_enabled'] = true;
			$_SESSION['tag_previously_opened'] = false;
			$_SESSION['post_count'] = intval( $post_count );
			$_SESSION['counter'] = 1;
			
		}
		
	}
	
}