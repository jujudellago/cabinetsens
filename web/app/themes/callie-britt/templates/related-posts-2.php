<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

$callie_britt_link = get_permalink();
$callie_britt_post_format = get_post_format();
$callie_britt_post_format = empty($callie_britt_post_format) ? 'standard' : str_replace('post-format-', '', $callie_britt_post_format);
$callie_britt_components = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('meta_parts'));
$callie_britt_hover = !empty($callie_britt_template_args['hover']) && !callie_britt_is_inherit($callie_britt_template_args['hover'])
					? $callie_britt_template_args['hover'] 
					: callie_britt_get_theme_option('image_hover');
$callie_britt_counters = callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('counters'));
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($callie_britt_post_format) ); ?>><?php
	
	// Post featured
	callie_britt_show_post_featured(array(
		'thumb_size' => apply_filters('callie_britt_filter_related_thumb_size', callie_britt_get_thumb_size( (int) callie_britt_get_theme_option('related_posts') == 1 ? 'huge' : 'big' )),
		'show_no_image' => callie_britt_get_theme_setting('allow_no_image'),
		'singular' => false
		)
	);
	
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
			echo "<div class='post_header_categories'>";
			callie_britt_show_layout($callie_britt_post_meta); 
			echo "</div>";
		}
	}
	
	?><div class="post_header entry-header"><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
			do_action('callie_britt_action_before_post_meta'); 

			// Post meta
			if ($has_thumb || $post_format == 'gallery' || $post_format == 'video' || $post_format == 'audio') {
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
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($callie_britt_link); ?>"><?php the_title(); ?></a></h6><?php
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
					if (has_excerpt()) {
					?><div class="post_content_inner"><?php
							echo substr(get_the_excerpt(), 0,90);
					?></div><?php
						} 
					// More button
					if ( empty($callie_britt_template_args['no_links']) && !in_array($callie_britt_post_format, array('link', 'aside', 'status', 'quote')) ) {
						?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Learn More', 'callie-britt'); ?></a></p><?php
					}
				}
			?></div><!-- .entry-content --><?php
		}
	?></div>
</div>