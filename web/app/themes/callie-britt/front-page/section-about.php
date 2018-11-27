<div class="front_page_section front_page_section_about<?php
			$callie_britt_scheme = callie_britt_get_theme_option('front_page_about_scheme');
			if (!callie_britt_is_inherit($callie_britt_scheme)) echo ' scheme_'.esc_attr($callie_britt_scheme);
			echo ' front_page_section_paddings_'.esc_attr(callie_britt_get_theme_option('front_page_about_paddings'));
		?>"<?php
		$callie_britt_css = '';
		$callie_britt_bg_image = callie_britt_get_theme_option('front_page_about_bg_image');
		if (!empty($callie_britt_bg_image)) 
			$callie_britt_css .= 'background-image: url('.esc_url(callie_britt_get_attachment_url($callie_britt_bg_image)).');';
		if (!empty($callie_britt_css))
			echo ' style="' . esc_attr($callie_britt_css) . '"';
?>><?php
	// Add anchor
	$callie_britt_anchor_icon = callie_britt_get_theme_option('front_page_about_anchor_icon');	
	$callie_britt_anchor_text = callie_britt_get_theme_option('front_page_about_anchor_text');	
	if ((!empty($callie_britt_anchor_icon) || !empty($callie_britt_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_about"'
										. (!empty($callie_britt_anchor_icon) ? ' icon="'.esc_attr($callie_britt_anchor_icon).'"' : '')
										. (!empty($callie_britt_anchor_text) ? ' title="'.esc_attr($callie_britt_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_about_inner<?php
			if (callie_britt_get_theme_option('front_page_about_fullheight'))
				echo ' callie-britt-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$callie_britt_css = '';
			$callie_britt_bg_mask = callie_britt_get_theme_option('front_page_about_bg_mask');
			$callie_britt_bg_color = callie_britt_get_theme_option('front_page_about_bg_color');
			if (!empty($callie_britt_bg_color) && $callie_britt_bg_mask > 0)
				$callie_britt_css .= 'background-color: '.esc_attr($callie_britt_bg_mask==1
																	? $callie_britt_bg_color
																	: callie_britt_hex2rgba($callie_britt_bg_color, $callie_britt_bg_mask)
																).';';
			if (!empty($callie_britt_css))
				echo ' style="' . esc_attr($callie_britt_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$callie_britt_caption = callie_britt_get_theme_option('front_page_about_caption');
			if (!empty($callie_britt_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo !empty($callie_britt_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($callie_britt_caption); ?></h2><?php
			}
		
			// Description (text)
			$callie_britt_description = callie_britt_get_theme_option('front_page_about_description');
			if (!empty($callie_britt_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo !empty($callie_britt_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($callie_britt_description)); ?></div><?php
			}
			
			// Content
			$callie_britt_content = callie_britt_get_theme_option('front_page_about_content');
			if (!empty($callie_britt_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo !empty($callie_britt_content) ? 'filled' : 'empty'; ?>"><?php
					$callie_britt_page_content_mask = '%%CONTENT%%';
					if (strpos($callie_britt_content, $callie_britt_page_content_mask) !== false) {
						$callie_britt_content = preg_replace(
									'/(\<p\>\s*)?'.$callie_britt_page_content_mask.'(\s*\<\/p\>)/i',
									sprintf('<div class="front_page_section_about_source">%s</div>',
												apply_filters('the_content', get_the_content())),
									$callie_britt_content
									);
					}
					callie_britt_show_layout($callie_britt_content);
				?></div><?php
			}
			?>
		</div>
	</div>
</div>