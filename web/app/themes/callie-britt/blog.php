<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

if ( function_exists('callie_britt_elm_is_preview') && callie_britt_elm_is_preview()) {

	// Redirect to the page
	get_template_part( apply_filters('callie_britt_filter_get_template_part', 'page') );

} else {
	
	// Store post with blog archive template
	if ( have_posts() ) {
		the_post();
		if (isset($GLOBALS['post']) && is_object($GLOBALS['post'])) callie_britt_storage_set('blog_archive_template_post', $GLOBALS['post']);
	}

	// Prepare args for a new query
	$callie_britt_args = array(
		'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
	);
	$callie_britt_args = callie_britt_query_add_posts_and_cats($callie_britt_args, '', callie_britt_get_theme_option('post_type'), callie_britt_get_theme_option('parent_cat'));
	$callie_britt_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
	if ($callie_britt_page_number > 1) {
		$callie_britt_args['paged'] = $callie_britt_page_number;
		$callie_britt_args['ignore_sticky_posts'] = true;
	}
	$callie_britt_ppp = callie_britt_get_theme_option('posts_per_page');
	if ((int) $callie_britt_ppp != 0)
		$callie_britt_args['posts_per_page'] = (int) $callie_britt_ppp;
	// Make a new main query
	$GLOBALS['wp_the_query']->query($callie_britt_args);

	get_template_part( apply_filters('callie_britt_filter_get_template_part', callie_britt_blog_archive_get_template()) );
}
?>