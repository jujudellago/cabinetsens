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
	$callie_britt_columns = empty($callie_britt_template_args['columns']) ? 1 : max(1, min(3, $callie_britt_template_args['columns']));
	$callie_britt_blog_style = array($callie_britt_template_args['type'], $callie_britt_columns);
} else {
	$callie_britt_blog_style = explode('_', callie_britt_get_theme_option('blog_style'));
	$callie_britt_columns = empty($callie_britt_blog_style[1]) ? 1 : max(1, min(3, $callie_britt_blog_style[1]));
}
$callie_britt_expanded = !callie_britt_sidebar_present() && callie_britt_is_on(callie_britt_get_theme_option('expand_content'));
$callie_britt_post_format = get_post_format();
$callie_britt_post_format = empty($callie_britt_post_format) ? 'standard' : str_replace('post-format-', '', $callie_britt_post_format);
$callie_britt_animation = callie_britt_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" <?php
	post_class( 'post_item'
				. ' post_layout_chess'
				. ' post_layout_chess_'.esc_attr($callie_britt_columns)
				. ' post_format_'.esc_attr($callie_britt_post_format)
				. (!empty($callie_britt_template_args['slider']) ? ' slider-slide swiper-slide' : '')
				);
	echo (!callie_britt_is_off($callie_britt_animation) && empty($callie_britt_template_args['slider']) ? ' data-animation="'.esc_attr(callie_britt_get_animation_classes($callie_britt_animation)).'"' : '');
?>>

	<?php
	// Add anchor
	if ($callie_britt_columns == 1 && !is_array($callie_britt_template_args) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'" icon="'.esc_attr(callie_britt_get_post_icon()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$callie_britt_hover = !empty($callie_britt_template_args['hover']) && !callie_britt_is_inherit($callie_britt_template_args['hover'])
						? $callie_britt_template_args['hover'] 
						: callie_britt_get_theme_option('image_hover');
	callie_britt_show_post_featured( array(
											'class' => $callie_britt_columns == 1 && !is_array($callie_britt_template_args) ? 'callie-britt-full-height' : '',
											'singular' => false,
											'hover' => $callie_britt_hover,
											'no_links' => !empty($callie_britt_template_args['no_links']),
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => callie_britt_get_thumb_size(
																	strpos(callie_britt_get_theme_option('body_style'), 'full')!==false
																		? ( $callie_britt_columns > 1 ? 'huge' : 'original' )
																		: (	$callie_britt_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('callie_britt_action_before_post_title'); 

			// Post title
			if (empty($callie_britt_template_args['no_links']))
				the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			else
				the_title( '<h3 class="post_title entry-title">', '</h3>' );
			
			do_action('callie_britt_action_before_post_meta'); 

			// Post meta
			$callie_britt_components = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('meta_parts'));
			$callie_britt_counters = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('counters'));
			$callie_britt_post_meta = empty($callie_britt_components) || in_array($callie_britt_hover, array('border', 'pull', 'slide', 'fade'))
										? '' 
										: callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(
												'components' => $callie_britt_components,
												'counters' => $callie_britt_counters,
												'seo' => false,
												'echo' => false
												), $callie_britt_blog_style[0], $callie_britt_columns)
											);
			callie_britt_show_layout($callie_britt_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content"><?php
			if (empty($callie_britt_template_args['hide_excerpt'])) {
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
			}
			// Post meta
			if (in_array($callie_britt_post_format, array('link', 'aside', 'status', 'quote'))) {
				callie_britt_show_layout($callie_britt_post_meta);
			}
			// More button
			if ( empty($callie_britt_template_args['no_links']) && !in_array($callie_britt_post_format, array('link', 'aside', 'status', 'quote')) ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Learn More', 'callie-britt'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>