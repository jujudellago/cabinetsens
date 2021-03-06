<?php

if (!function_exists('qode_quick_links_title_typography_styles') && qode_quick_links_theme_installed()) {
	/**
	 * Typography styles for all button types
	 */
	function qode_quick_links_title_typography_styles() {
		$selector = array(
			'.qode-quick-links-holder .qode-quick-links-items .qode-quick-links-item .qode-quick-links-item-title',
			'.qode-quick-links-holder .qode-quick-links-heading .qode-quick-links-heading-title .qode-quick-links-heading-title-text'
		);
		$styles = array();

		$color = bridge_qode_options()->getOptionValue('quick_links_title_color');
		if($color !== '') {
			$styles['color'] = $color;
		}

		$font_size = bridge_qode_options()->getOptionValue('quick_links_title_font_size');
		if($font_size !== '') {
			$styles['font-size'] = bridge_qode_filter_px($font_size).'px';
		}

		$line_height = bridge_qode_options()->getOptionValue('quick_links_title_line_height');
		if($line_height !== '') {
			$styles['line-height'] = bridge_qode_filter_px($line_height).'px';
		}

		$font_family = bridge_qode_options()->getOptionValue('quick_links_title_font_family');
		if(bridge_qode_is_font_option_valid($font_family)) {
			$styles['font-family'] = bridge_qode_get_font_option_val($font_family);
		}

		$text_transform = bridge_qode_options()->getOptionValue('quick_links_title_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		$font_style = bridge_qode_options()->getOptionValue('quick_links_title_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = bridge_qode_options()->getOptionValue('quick_links_title_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = bridge_qode_filter_px($letter_spacing).'px';
		}

		$font_weight = bridge_qode_options()->getOptionValue('quick_links_title_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}


		echo bridge_qode_dynamic_css($selector, $styles);
	}

	add_action('bridge_qode_action_style_dynamic', 'qode_quick_links_title_typography_styles');
}

if (!function_exists('qode_quick_links_text_typography_styles') && qode_quick_links_theme_installed()) {
	/**
	 * Typography styles for all button types
	 */
	function qode_quick_links_text_typography_styles() {
		$selector = array(
			'.qode-quick-links-item p'
		);
		$styles = array();

		$color = bridge_qode_options()->getOptionValue('quick_links_text_color');
		if($color !== '') {
			$styles['color'] = $color;
		}

		$font_size = bridge_qode_options()->getOptionValue('quick_links_text_font_size');
		if($font_size !== '') {
			$styles['font-size'] = bridge_qode_filter_px($font_size).'px';
		}

		$line_height = bridge_qode_options()->getOptionValue('quick_links_text_line_height');
		if($line_height !== '') {
			$styles['line-height'] = bridge_qode_filter_px($line_height).'px';
		}

		$font_family = bridge_qode_options()->getOptionValue('quick_links_text_font_family');
		if(bridge_qode_is_font_option_valid($font_family)) {
			$styles['font-family'] = bridge_qode_get_font_option_val($font_family);
		}

		$text_transform = bridge_qode_options()->getOptionValue('quick_links_text_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		$font_style = bridge_qode_options()->getOptionValue('quick_links_text_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = bridge_qode_options()->getOptionValue('quick_links_text_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = bridge_qode_filter_px($letter_spacing).'px';
		}

		$font_weight = bridge_qode_options()->getOptionValue('quick_links_text_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}


		echo bridge_qode_dynamic_css($selector, $styles);
	}

	add_action('bridge_qode_action_style_dynamic', 'qode_quick_links_text_typography_styles');
}