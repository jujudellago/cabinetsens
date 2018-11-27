<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

callie_britt_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	callie_britt_blog_archive_start();

	$callie_britt_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$callie_britt_sticky_out = callie_britt_get_theme_option('sticky_style')=='columns' 
							&& is_array($callie_britt_stickies) && count($callie_britt_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$callie_britt_cat = callie_britt_get_theme_option('parent_cat');
	$callie_britt_post_type = callie_britt_get_theme_option('post_type');
	$callie_britt_taxonomy = callie_britt_get_post_type_taxonomy($callie_britt_post_type);
	$callie_britt_show_filters = callie_britt_get_theme_option('show_filters');
	$callie_britt_tabs = array();
	if (!callie_britt_is_off($callie_britt_show_filters)) {
		$callie_britt_args = array(
			'type'			=> $callie_britt_post_type,
			'child_of'		=> $callie_britt_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'taxonomy'		=> $callie_britt_taxonomy,
			'pad_counts'	=> false
		);
		$callie_britt_portfolio_list = get_terms($callie_britt_args);
		if (is_array($callie_britt_portfolio_list) && count($callie_britt_portfolio_list) > 0) {
			$callie_britt_tabs[$callie_britt_cat] = esc_html__('All', 'callie-britt');
			foreach ($callie_britt_portfolio_list as $callie_britt_term) {
				if (isset($callie_britt_term->term_id)) $callie_britt_tabs[$callie_britt_term->term_id] = $callie_britt_term->name;
			}
		}
	}
	if (count($callie_britt_tabs) > 0) {
		$callie_britt_portfolio_filters_ajax = true;
		$callie_britt_portfolio_filters_active = $callie_britt_cat;
		$callie_britt_portfolio_filters_id = 'portfolio_filters';
		?>
		<div class="portfolio_filters callie_britt_tabs callie_britt_tabs_ajax">
			<ul class="portfolio_titles callie_britt_tabs_titles">
				<?php
				foreach ($callie_britt_tabs as $callie_britt_id=>$callie_britt_title) {
					?><li><a href="<?php echo esc_url(callie_britt_get_hash_link(sprintf('#%s_%s_content', $callie_britt_portfolio_filters_id, $callie_britt_id))); ?>" data-tab="<?php echo esc_attr($callie_britt_id); ?>"><?php echo esc_html($callie_britt_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$callie_britt_ppp = callie_britt_get_theme_option('posts_per_page');
			if (callie_britt_is_inherit($callie_britt_ppp)) $callie_britt_ppp = '';
			foreach ($callie_britt_tabs as $callie_britt_id=>$callie_britt_title) {
				$callie_britt_portfolio_need_content = $callie_britt_id==$callie_britt_portfolio_filters_active || !$callie_britt_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $callie_britt_portfolio_filters_id, $callie_britt_id)); ?>"
					class="portfolio_content callie_britt_tabs_content"
					data-blog-template="<?php echo esc_attr(callie_britt_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(callie_britt_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($callie_britt_ppp); ?>"
					data-post-type="<?php echo esc_attr($callie_britt_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($callie_britt_taxonomy); ?>"
					data-cat="<?php echo esc_attr($callie_britt_id); ?>"
					data-parent-cat="<?php echo esc_attr($callie_britt_cat); ?>"
					data-need-content="<?php echo (false===$callie_britt_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($callie_britt_portfolio_need_content) 
						callie_britt_show_portfolio_posts(array(
							'cat' => $callie_britt_id,
							'parent_cat' => $callie_britt_cat,
							'taxonomy' => $callie_britt_taxonomy,
							'post_type' => $callie_britt_post_type,
							'page' => 1,
							'sticky' => $callie_britt_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		callie_britt_show_portfolio_posts(array(
			'cat' => $callie_britt_cat,
			'parent_cat' => $callie_britt_cat,
			'taxonomy' => $callie_britt_taxonomy,
			'post_type' => $callie_britt_post_type,
			'page' => 1,
			'sticky' => $callie_britt_sticky_out
			)
		);
	}

	callie_britt_blog_archive_end();

} else {

	if ( is_search() )
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'content', 'none-search'), 'none-search' );
	else
		get_template_part( apply_filters('callie_britt_filter_get_template_part', 'content', 'none-archive'), 'none-archive' );

}

get_footer();
?>