<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

// Page (category, tag, archive, author) title

if ( callie_britt_need_page_title() ) {
	callie_britt_sc_layouts_showed('title', true);
	callie_britt_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								callie_britt_show_post_meta(apply_filters('callie_britt_filter_post_meta_args', array(
									'components' => callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('meta_parts')),
									'counters' => callie_britt_array_get_keys_by_value(callie_britt_get_theme_option('counters')),
									'seo' => callie_britt_is_on(callie_britt_get_theme_option('seo_snippets'))
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$callie_britt_blog_title = callie_britt_get_blog_title();
							$callie_britt_blog_title_text = $callie_britt_blog_title_class = $callie_britt_blog_title_link = $callie_britt_blog_title_link_text = '';
							if (is_array($callie_britt_blog_title)) {
								$callie_britt_blog_title_text = $callie_britt_blog_title['text'];
								$callie_britt_blog_title_class = !empty($callie_britt_blog_title['class']) ? ' '.$callie_britt_blog_title['class'] : '';
								$callie_britt_blog_title_link = !empty($callie_britt_blog_title['link']) ? $callie_britt_blog_title['link'] : '';
								$callie_britt_blog_title_link_text = !empty($callie_britt_blog_title['link_text']) ? $callie_britt_blog_title['link_text'] : '';
							} else
								$callie_britt_blog_title_text = $callie_britt_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($callie_britt_blog_title_class); ?>"><?php
								$callie_britt_top_icon = callie_britt_get_category_icon();
								if (!empty($callie_britt_top_icon)) {
									$callie_britt_attr = callie_britt_getimagesize($callie_britt_top_icon);
									?><img src="<?php echo esc_url($callie_britt_top_icon); ?>" alt="<?php esc_attr_e('Site icon', 'callie-britt'); ?>" <?php if (!empty($callie_britt_attr[3])) callie_britt_show_layout($callie_britt_attr[3]);?>><?php
								}
								echo wp_kses_data($callie_britt_blog_title_text);
							?></h1>
							<?php
							if (!empty($callie_britt_blog_title_link) && !empty($callie_britt_blog_title_link_text)) {
								?><a href="<?php echo esc_url($callie_britt_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($callie_britt_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'callie_britt_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>