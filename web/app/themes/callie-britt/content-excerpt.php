<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

$callie_britt_template_args = get_query_var('callie_britt_template_args');
if (is_array($callie_britt_template_args)) {
	$callie_britt_columns = empty($callie_britt_template_args['columns']) ? 2 : max(2, $callie_britt_template_args['columns']);
	$callie_britt_blog_style = array($callie_britt_template_args['type'], $callie_britt_columns);
	if (!empty($callie_britt_template_args['slider'])) {
		?><div class="slider-slide swiper-slide"><?php
	} else if ($callie_britt_columns > 1) {
		?><div class="column-1_<?php echo esc_attr($callie_britt_columns); ?>"><?php
	}
}
$callie_britt_expanded = !callie_britt_sidebar_present() && callie_britt_is_on(callie_britt_get_theme_option('expand_content'));
$callie_britt_post_format = get_post_format();
$callie_britt_post_format = empty($callie_britt_post_format) ? 'standard' : str_replace('post-format-', '', $callie_britt_post_format);
$callie_britt_animation = callie_britt_get_theme_option('blog_animation');
$callie_britt_hover = !empty($callie_britt_template_args['hover']) && !callie_britt_is_inherit($callie_britt_template_args['hover'])
					? $callie_britt_template_args['hover'] 
					: callie_britt_get_theme_option('image_hover');
$callie_britt_components = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('meta_parts'));
$callie_britt_counters = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('counters'));

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($callie_britt_post_format) ); ?>
	<?php echo (!callie_britt_is_off($callie_britt_animation) && empty($callie_britt_template_args['slider']) ? ' data-animation="'.esc_attr(callie_britt_get_animation_classes($callie_britt_animation)).'"' : ''); ?>
	>
	<div class="post_article_wrap"><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	callie_britt_show_post_featured(array(
									'singular' => false,
									'no_links' => !empty($callie_britt_template_args['no_links']),
									'hover' => $callie_britt_hover,
									'thumb_size' => callie_britt_get_thumb_size( strpos(callie_britt_get_theme_option('body_style'), 'full')!==false ? 'full' : ($callie_britt_expanded ? 'huge' : 'huge') ) 
									));

	// Add categories to posts with media
	$has_thumb = has_post_thumbnail();
	$post_format = str_replace('post-format-', '', get_post_format());
	if ($has_thumb || $post_format == 'gallery' || $post_format == 'video') {
		if (in_array('categories',explode(',', $callie_britt_components))) {
			$callie_britt_post_meta = empty($callie_britt_components) || in_array($callie_britt_hover, array('border', 'pull', 'slide', 'fade'))
											? '' 
											: callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(
													'components' => 'categories',
													'counters' => '',
													'seo' => false,
													'echo' => false
													), !empty($callie_britt_blog_style[0])  ? $callie_britt_blog_style[0] : '', !empty($callie_britt_columns)  ? $callie_britt_columns : '')
												);
			echo "<div class='post_header_categories jjj'>";
			callie_britt_show_layout($callie_britt_post_meta); 
			echo "</div>";
		}
	}

	// Title and post meta
	if ( $post_format != 'quote' ) {
		?>
		<div class="post_header entry-header">
			<?php

			do_action('callie_britt_action_before_post_meta'); 

			// Post meta
			if ($has_thumb || $post_format == 'gallery' || $post_format == 'video') {
				if (in_array('categories',explode(',', $callie_britt_components))) {
					$callie_britt_components = str_replace('categories', '', $callie_britt_components);
				}
			}
			if (!empty($callie_britt_components) && !in_array($callie_britt_hover, array('border', 'pull', 'slide', 'fade')))
				callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(
					'components' => $callie_britt_components,
					'counters' => $callie_britt_counters,
					'seo' => false
					), 'excerpt', 1)
				);

			if(get_the_title() != '') {
				// Post title
				do_action('callie_britt_action_before_post_title'); 
				if (empty($callie_britt_template_args['no_links']))
					the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				else
					the_title( '<h2 class="post_title entry-title">', '</h2>' );
			}
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	if (empty($callie_britt_template_args['hide_excerpt'])) {

		?><div class="post_content entry-content"><?php
			if (callie_britt_get_theme_option('blog_content') == 'fullpost') {
				// Post content area
				?><div class="post_content_inner"><?php
					the_content( '' );
				?></div><?php
				// Inner pages
				wp_link_pages( array(
					'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'callie-britt' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'callie-britt' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			} else {
				// Post content area
				?><div class="post_content_inner"><?php
					if (has_excerpt()) {
						the_excerpt();
					} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
						the_content( '' );
					} else if (in_array($callie_britt_post_format, array('link', 'aside', 'status'))) {
						the_content();
					} else if ($callie_britt_post_format == 'quote') {
						if (($quote = callie_britt_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
							callie_britt_show_layout(wpautop($quote));
						else
							the_excerpt();
					} else if (substr(get_the_content(), 0, 4)!='[vc_') {
						the_excerpt();
					}
				?></div><?php
				// More button
				if ( empty($callie_britt_template_args['no_links']) && !in_array($callie_britt_post_format, array('link', 'aside', 'status', 'quote')) ) {
					?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Learn More', 'callie-britt'); ?></a></p><?php
				}
			}
		?></div><!-- .entry-content --><?php
	}

	// Title and post meta
	if (get_the_title() != '' && $post_format == 'quote' ) {
		?>
		<div class="post_header entry-header">
			<?php

			do_action('callie_britt_action_before_post_meta'); 

			// Post meta
			if ($has_thumb || $post_format == 'gallery' || $post_format == 'video' || is_sticky()) {
				if (in_array('categories',explode(',', $callie_britt_components))) {
					$callie_britt_components = str_replace('categories', '', $callie_britt_components);
				}
			}
			if (!empty($callie_britt_components) && !in_array($callie_britt_hover, array('border', 'pull', 'slide', 'fade')))
				callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(
					'components' => $callie_britt_components,
					'counters' => $callie_britt_counters,
					'seo' => false
					), 'excerpt', 1)
				);
			?>
		</div><!-- .post_header --><?php
	}

?></div></article><?php

if (is_array($callie_britt_template_args)) {
	if (!empty($callie_britt_template_args['slider']) || $callie_britt_columns > 1) {
		?></div><?php
	}
}
?>