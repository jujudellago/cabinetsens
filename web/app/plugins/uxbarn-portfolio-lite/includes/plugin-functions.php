<?php
/**
 * Main functions of the plugin
 *
 * @since 1.0.0
 */



if ( ! function_exists( 'uxb_port_register_cpt' ) ) {

	function uxb_port_register_cpt() {
	
		$cpt_args = array(
					'label' 			=> __( 'Portfolio', 'uxb_port' ),
					'labels' 			=> array(
												'singular_name'		=> __( 'Portfolio', 'uxb_port' ),
												'add_new' 			=> __( 'Add New Portfolio Item', 'uxb_port' ),
												'add_new_item' 		=> __( 'Add New Portfolio Item', 'uxb_port' ),
												'new_item' 			=> __( 'New Portfolio Item', 'uxb_port' ),
												'edit_item' 		=> __( 'Edit Portfolio Item', 'uxb_port' ),
												'all_items' 		=> __( 'All Portfolio Items', 'uxb_port' ),
												'view_item' 		=> __( 'View Portfolio', 'uxb_port' ),
												'search_items' 		=> __( 'Search Portfolio', 'uxb_port' ),
												'not_found' 		=> __( 'Nothing found', 'uxb_port' ),
												'not_found_in_trash' => __( 'Nothing found in Trash', 'uxb_port' ),
											),
					'menu_icon' 		=> UXB_PORT_LITE_URL . 'images/uxbarn-admin-s.jpg',
					'description' 		=> __( 'Portfolio of your business', 'uxb_port' ),
					'public' 			=> true,
					'show_ui' 			=> true,
					'capability_type' 	=> 'post',
					'hierarchical' 		=> false,
					'has_archive' 		=> false,
					'supports' 			=> array( 'title', 'editor', 'thumbnail', 'revisions', 'comments' ),
					'rewrite' 			=> array( 'slug' => __( 'portfolio', 'uxb_port' ), 'with_front' => false )
				);
				
				
		// Make this argument overridable by the filter with custom callback in a theme
		$cpt_args = apply_filters( 'uxb_port_register_cpt_args_filter', $cpt_args );
		
		// Register post type
		register_post_type( 'uxbarn_portfolio', $cpt_args );
		
		
		
		$tax_args = array(
						'label' 			=> __( 'Portfolio Categories', 'uxb_port' ), 
						'labels' 			=> array(
													'singular_name' => __( 'Portfolio Category', 'uxb_port' ),
													'search_items' 	=> __( 'Search Categories', 'uxb_port' ),
													'all_items' 	=> __( 'All Categories', 'uxb_port' ),
													'edit_item' 	=> __( 'Edit Category', 'uxb_port' ), 
													'update_item' 	=> __( 'Update Category', 'uxb_port' ),
													'add_new_item' 	=> __( 'Add New Category', 'uxb_port' ),
												),
						'singular_label' 	=> __( 'Portfolio Category', 'uxb_port' ),
						'hierarchical' 		=> true, 
						'rewrite' 			=> array( 'slug' => __( 'portfolio-category', 'uxb_port' ) ),
					);
		
		// Make this argument overridable by the filter with custom callback in a theme
		$tax_args = apply_filters( 'uxb_port_register_tax_args_filter', $tax_args );
		
		// Register taxonomy
		register_taxonomy( 'uxbarn_portfolio_tax', array( 'uxbarn_portfolio' ), $tax_args );
		
	}

}



if ( ! function_exists( 'uxb_port_create_columns_header' ) ) {
	
	function uxb_port_create_columns_header( $defaults ) {
		
        $custom_columns = array(
            'cb' 			=> '<input type=\"checkbox\" />',
            'title' 		=> esc_html__( 'Title', 'uxb_port' ),
            'cover_image' 	=> esc_html__( 'Featured Image', 'uxb_port' ),
            'item_format' 	=> esc_html__( 'Item Format', 'uxb_port' ),
            'terms' 		=> esc_html__( 'Categories', 'uxb_port' )
        );

        $merged_columns = array_merge( $custom_columns, $defaults );
        
		$merged_columns = apply_filters( 'uxb_port_create_columns_header_filter', $merged_columns, $defaults, $custom_columns );
		
        return $merged_columns;
        
	}
	
}



if ( ! function_exists( 'uxb_port_create_columns_content') ) {
	
	function uxb_port_create_columns_content( $column ) {
		
		global $post;
		switch ( $column ) {
			case 'cover_image':
				the_post_thumbnail( 'thumbnail' );
				break;
			case 'item_format':
				echo ucwords( get_post_meta( $post->ID, 'uxbarn_portfolio_item_format', true ) );
				break;
			case 'terms':
				$terms = get_the_terms( $post->ID, 'uxbarn_portfolio_tax' );
				
				if ( ! empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $term )
						$out[] = '<a href="' . esc_url( get_term_link( $term->slug, 'uxbarn_portfolio_tax' ) ) .'">' . $term->name . '</a>';
						echo join( ', ', $out );
				
				} else {
					echo ' ';
				}
				break;
		}
		
	}
	
}



if ( ! function_exists( 'uxb_port_template_chooser' ) ) {

	function uxb_port_template_chooser( $template ) {
		
		if ( ! is_404() && ! is_search() ) {
				
			// Get current post ID
			$post_id = get_the_ID();
			
			// For other post type that is not "uxbarn_portfolio", simply return the default one
			if ( get_post_type( $post_id ) != 'uxbarn_portfolio' ) {
				return $template;
			}
			
			// Otherwise, follow the conditions here to load the proper template
			if ( is_singular( 'uxbarn_portfolio' ) ) {
				return uxb_port_get_template_hierarchy( 'single-portfolio' );
			} else if ( is_tax( 'uxbarn_portfolio_tax' ) ) {
				return uxb_port_get_template_hierarchy( 'taxonomy-portfolio' );
			} else {
				return $template;
			}
			
		} else {
			return $template;
		}
		
	}

}



if ( ! function_exists( 'uxb_port_get_template_hierarchy' ) ) {
	
	function uxb_port_get_template_hierarchy( $template ) {
		
		// Get the template slug
		$template_slug = rtrim( $template, '.php' );
		$template = $template_slug . '.php';
		
		// Check if a custom template exists in the theme folder, if not, load the plugin template file
		if ( $theme_file = locate_template( array( 'uxb_templates/' . $template, 'uxb-templates/' . $template ) ) ) {
			$file = $theme_file;
		} else {
			$file = UXB_PORT_LITE_PATH . 'uxb-templates/' . $template;
		}
		
		return $file;
		
	}

}