<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

callie_britt_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	callie_britt_blog_archive_start();

	$callie_britt_classes = 'posts_container '
						. (substr(callie_britt_get_theme_option('blog_style'), 0, 7) == 'classic' 
							? 'columns_wrap columns_padding_bottom' 
							: 'masonry_wrap'
							);
	$callie_britt_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$callie_britt_sticky_out = callie_britt_get_theme_option('sticky_style')=='columns' 
							&& is_array($callie_britt_stickies) && count($callie_britt_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($callie_britt_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$callie_britt_sticky_out) {
		if (callie_britt_get_theme_option('first_post_large') && !is_paged() && !in_array(callie_britt_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( apply_filters('callie_britt_filter_get_template_part', 'content', 'excerpt'), 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($callie_britt_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($callie_britt_sticky_out && !is_sticky()) {
			$callie_britt_sticky_out = false;
			?></div><div class="<?php echo esc_attr($callie_britt_classes); ?>"><?php
		}
		$callie_britt_part = $callie_britt_sticky_out && is_sticky() ? 'sticky' : 'classic';
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'content', $callie_britt_part), $callie_britt_part );
	}
	
	?></div><?php

	callie_britt_show_pagination();

	callie_britt_blog_archive_end();

} else {

	if ( is_search() )
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'content', 'none-search'), 'none-search' );
	else
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'content', 'none-archive'), 'none-archive' );

}

get_footer();
?>