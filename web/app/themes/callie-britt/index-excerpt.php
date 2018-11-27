<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

callie_britt_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	callie_britt_blog_archive_start();

	?><div class="posts_container"><?php
	
	$callie_britt_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$callie_britt_sticky_out = callie_britt_get_theme_option('sticky_style')=='columns' 
							&& is_array($callie_britt_stickies) && count($callie_britt_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($callie_britt_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($callie_britt_sticky_out && !is_sticky()) {
			$callie_britt_sticky_out = false;
			?></div><?php
		}
		$callie_britt_part = $callie_britt_sticky_out && is_sticky() ? 'sticky' : 'excerpt';
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'content', $callie_britt_part), $callie_britt_part );
	}
	if ($callie_britt_sticky_out) {
		$callie_britt_sticky_out = false;
		?></div><?php
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