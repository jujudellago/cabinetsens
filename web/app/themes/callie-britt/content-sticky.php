<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

$callie_britt_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$callie_britt_post_format = get_post_format();
$callie_britt_post_format = empty($callie_britt_post_format) ? 'standard' : str_replace('post-format-', '', $callie_britt_post_format);
$callie_britt_animation = callie_britt_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($callie_britt_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($callie_britt_post_format) ); ?>
	<?php echo (!callie_britt_is_off($callie_britt_animation) ? ' data-animation="'.esc_attr(callie_britt_get_animation_classes($callie_britt_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	callie_britt_show_post_featured(array(
		'thumb_size' => callie_britt_get_thumb_size($callie_britt_columns==1 ? 'big' : ($callie_britt_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($callie_britt_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(), 'sticky', $callie_britt_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>