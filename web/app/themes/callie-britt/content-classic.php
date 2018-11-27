<?php
/**
 * The Classic template to display the content
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
} else {
	$callie_britt_blog_style = explode('_', callie_britt_get_theme_option('blog_style'));
	$callie_britt_columns = empty($callie_britt_blog_style[1]) ? 2 : max(2, $callie_britt_blog_style[1]);
}
$callie_britt_expanded = !callie_britt_sidebar_present() && callie_britt_is_on(callie_britt_get_theme_option('expand_content'));
$callie_britt_animation = callie_britt_get_theme_option('blog_animation');
$callie_britt_components = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('meta_parts'));
$callie_britt_counters = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('counters'));

$callie_britt_post_format = get_post_format();
$callie_britt_post_format = empty($callie_britt_post_format) ? 'standard' : str_replace('post-format-', '', $callie_britt_post_format);

?><div class="<?php
	if (!empty($callie_britt_template_args['slider']))
		echo ' slider-slide swiper-slide';
	else
		echo ('classic' == $callie_britt_blog_style[0] ? 'column' : 'masonry_item masonry_item') . '-1_' . esc_attr($callie_britt_columns);
?>"><?php
	?><article id="post-<?php the_ID(); ?>" <?php
		post_class( 'post_item post_format_'.esc_attr($callie_britt_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($callie_britt_columns)
					. ' post_layout_'.esc_attr($callie_britt_blog_style[0]) 
					. ' post_layout_'.esc_attr($callie_britt_blog_style[0]).'_'.esc_attr($callie_britt_columns)
		);
		echo (!callie_britt_is_off($callie_britt_animation) && empty($callie_britt_template_args['slider']) ? ' data-animation="'.esc_attr(callie_britt_get_animation_classes($callie_britt_animation)).'"' : '');
	?>><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$callie_britt_hover = !empty($callie_britt_template_args['hover']) && !callie_britt_is_inherit($callie_britt_template_args['hover'])
						? $callie_britt_template_args['hover'] 
						: callie_britt_get_theme_option('image_hover');
	callie_britt_show_post_featured( array( 'thumb_size' => callie_britt_get_thumb_size($callie_britt_blog_style[0] == 'classic'
													? (strpos(callie_britt_get_theme_option('body_style'), 'full')!==false 
															? ( $callie_britt_columns > 2 ? 'big' : 'huge' )
															: (	$callie_britt_columns > 2
																? ($callie_britt_expanded ? 'med' : 'small')
																: ($callie_britt_expanded ? 'big' : 'med')
																)
														)
													: (strpos(callie_britt_get_theme_option('body_style'), 'full')!==false 
															? ( $callie_britt_columns > 2 ? 'masonry-big' : 'full' )
															: (	$callie_britt_columns <= 2 && $callie_britt_expanded ? 'masonry-big' : 'masonry')
														)
												),
										'hover' => $callie_britt_hover,
										'no_links' => !empty($callie_britt_template_args['no_links']),
										'singular' => false
								) );

	if ( !in_array($callie_britt_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('callie_britt_action_before_post_title'); 

			// Post title
			if (empty($callie_britt_template_args['no_links']))
				the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			else
				the_title( '<h4 class="post_title entry-title">', '</h4>' );

			do_action('callie_britt_action_before_post_meta'); 

			// Post meta
			if (!empty($callie_britt_components) && !in_array($callie_britt_hover, array('border', 'pull', 'slide', 'fade'))) {
				callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(
					'components' => $callie_britt_components,
					'counters' => $callie_britt_counters,
					'seo' => false
					), $callie_britt_blog_style[0], $callie_britt_columns)
				);
			}

			do_action('callie_britt_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content"><?php
		if (empty($callie_britt_template_args['hide_excerpt'])) {
			?><div class="post_content_inner">
				<?php
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
		}
		// Post meta
		if (in_array($callie_britt_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($callie_britt_components))
				callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(
					'components' => $callie_britt_components,
					'counters' => $callie_britt_counters
					), $callie_britt_blog_style[0], $callie_britt_columns)
				);
		}
		// More button
		if ( false && empty($callie_britt_template_args['no_links']) && !in_array($callie_britt_post_format, array('link', 'aside', 'status', 'quote')) ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Learn More', 'callie-britt'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>