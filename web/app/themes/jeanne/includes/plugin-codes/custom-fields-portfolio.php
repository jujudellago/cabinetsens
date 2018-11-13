<?php
/**
 * Custom fields for portfolio
 *
 * @since 1.0.0
 */



if ( ! function_exists( 'jeanne_portfolio_cf_create_portfolio_template_settings' ) ) {
		
	function jeanne_portfolio_cf_create_portfolio_template_settings() {
		
		
		if ( function_exists( 'acf_add_local_field_group' ) ):

			acf_add_local_field_group(array(
				'key' => 'key_group_portfolio_template_settings',
				'title' => esc_html__('Portfolio Template Settings', 'jeanne'),
				'fields' => array(
					
					array(
						'key' => 'key_field_uxbarn_portfolio_template_message',
						'label' => 'Portfolio template is selected',
						'name' => 'uxbarn_portfolio_template_message',
						'type' => 'message',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => jeanne_wp_kses_escape( __('You can find the template settings by going to <em>Appearance > Customize > Theme Settings > Portfolio Settings</em>.', 'jeanne') ),
						'new_lines' => 'wpautop',
						'esc_html' => 0,
					),
					
				),
				
				'location' => array(
					array(
						array(
							'param' => 'page_template',
							'operator' => '==',
							'value' => 'template-featured-works.php',
						),
					),
					array(
						array(
							'param' => 'page_template',
							'operator' => '==',
							'value' => 'template-all-works.php',
						),
					),
				),
				
				'menu_order' => 0,
				'position' => 'side',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
				
			) );
			
		endif;
		
	}
	
}



if ( ! function_exists( 'jeanne_portfolio_cf_get_full_width_default_value' ) ) {
		
	function jeanne_portfolio_cf_get_full_width_default_value() {
		return '';
	}
	
}

if ( ! function_exists( 'jeanne_portfolio_cf_create_portfolio_item_settings' ) ) {
		
	function jeanne_portfolio_cf_create_portfolio_item_settings() {
		
		if ( function_exists( 'acf_add_local_field_group' ) ):

			acf_add_local_field_group(array(
				'key' => 'key_group_portfolio_item_settings',
				'title' => esc_html__('Portfolio Item Settings', 'jeanne'),
				'fields' => array(
					
					array(
						'key' => 'key_field_uxbarn_portfolio_enable_full_width_on_templates',
						'label' => esc_html__('Full-width Image on Portfolio Templates', 'jeanne'),
						'name' => 'uxbarn_portfolio_enable_full_width_on_templates',
						'type' => 'checkbox',
						'instructions' => esc_html__('Make the featured image of this item full-width when displaying on these templates:', 'jeanne'),
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'featured-works' => esc_html__('Featured Works', 'jeanne'),
							'all-works' => esc_html__('All Works', 'jeanne'),
						),
						'message' => '',
						'default_value' => jeanne_portfolio_cf_get_full_width_default_value(),
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					
					array(
						'key' => 'key_field_uxbarn_portfolio_item_format',
						'label' => esc_html__('Portfolio Item Format', 'jeanne'),
						'name' => 'uxbarn_portfolio_item_format',
						'type' => 'select',
						'instructions' => esc_html__('Select the format for this item; then you can manage its content using the option below.', 'jeanne'),
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'image-slideshow' => esc_html__('Image', 'jeanne'),
							'video' => esc_html__('Video', 'jeanne'),
							'mixed' => esc_html__('Mixed', 'jeanne'),
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'return_format' => 'value',
						'placeholder' => '',
					),
					array(
						'key' => 'key_field_uxbarn_portfolio_acf_image_slideshow',
						'label' => esc_html__('Images', 'jeanne'),
						'name' => 'uxbarn_portfolio_acf_image_slideshow',
						'type' => 'gallery',
						'instructions' => esc_html__('The uploaded images will be displayed on the portfolio single page.', 'jeanne'),
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'key_field_uxbarn_portfolio_item_format',
									'operator' => '==',
									'value' => 'image-slideshow',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'min' => '',
						'max' => '',
						'insert' => 'append',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => 'jpg, jpeg, png, gif',
					),
					array(
						'key' => 'key_field_uxbarn_portfolio_video_url',
						'label' => esc_html__('Video URL', 'jeanne'),
						'name' => 'uxbarn_portfolio_video_url',
						'type' => 'text',
						'instructions' => esc_html__('Enter a YouTube or Vimeo URL here.', 'jeanne'),
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'key_field_uxbarn_portfolio_item_format',
									'operator' => '==',
									'value' => 'video',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'key_field_uxbarn_portfolio_video_caption',
						'label' => esc_html__('Video Caption', 'jeanne'),
						'name' => 'uxbarn_portfolio_video_caption',
						'type' => 'textarea',
						'instructions' => esc_html__('This caption will display right below the video.', 'jeanne'),
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'key_field_uxbarn_portfolio_item_format',
									'operator' => '==',
									'value' => 'video',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'key_field_uxbarn_portfolio_acf_mixed_content',
						'label' => esc_html__('Mixed Content', 'jeanne'),
						'name' => 'uxbarn_portfolio_acf_mixed_content',
						'type' => 'repeater',
						'instructions' => esc_html__('Click to add new content and choose what content type you want to use.', 'jeanne'),
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'key_field_uxbarn_portfolio_item_format',
									'operator' => '==',
									'value' => 'mixed',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => 'key_sub_field_uxbarn_portfolio_acf_mixed_content_type',
						'min' => 0,
						'max' => 0,
						'layout' => 'row',
						'button_label' => esc_html__('Add New', 'jeanne'),
						'sub_fields' => array(
							array(
								'key' => 'key_sub_field_uxbarn_portfolio_acf_mixed_content_type',
								'label' => esc_html__('Content Type', 'jeanne'),
								'name' => 'uxbarn_portfolio_acf_mixed_content_type',
								'type' => 'select',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									'image-slideshow' => esc_html__('Image', 'jeanne'),
									'video' => esc_html__('Video', 'jeanne'),
								),
								'default_value' => array(
								),
								'allow_null' => 0,
								'multiple' => 0,
								'ui' => 0,
								'ajax' => 0,
								'return_format' => 'value',
								'placeholder' => '',
							),
							array(
								'key' => 'key_sub_field_uxbarn_portfolio_acf_mixed_content_image_slideshow',
								'label' => esc_html__('Images', 'jeanne'),
								'name' => 'uxbarn_portfolio_acf_mixed_content_image_slideshow',
								'type' => 'gallery',
								'instructions' => esc_html__('The uploaded images will be displayed on the portfolio single page.', 'jeanne'),
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'key_sub_field_uxbarn_portfolio_acf_mixed_content_type',
											'operator' => '==',
											'value' => 'image-slideshow',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'min' => '',
								'max' => '',
								'insert' => 'append',
								'library' => 'all',
								'min_width' => '',
								'min_height' => '',
								'min_size' => '',
								'max_width' => '',
								'max_height' => '',
								'max_size' => '',
								'mime_types' => 'jpg, jpeg, png, gif',
							),
							array(
								'key' => 'key_sub_field_uxbarn_portfolio_acf_mixed_content_video_url',
								'label' => esc_html__('Video URL', 'jeanne'),
								'name' => 'uxbarn_portfolio_acf_mixed_content_video_url',
								'type' => 'text',
								'instructions' => esc_html__('Enter a YouTube or Vimeo URL here.', 'jeanne'),
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'key_sub_field_uxbarn_portfolio_acf_mixed_content_type',
											'operator' => '==',
											'value' => 'video',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'key_field_uxbarn_portfolio_acf_mixed_content_video_caption',
								'label' => esc_html__('Video Caption', 'jeanne'),
								'name' => 'uxbarn_portfolio_acf_mixed_content_video_caption',
								'type' => 'textarea',
								'instructions' => esc_html__('This caption will display right below the video.', 'jeanne'),
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'key_sub_field_uxbarn_portfolio_acf_mixed_content_type',
											'operator' => '==',
											'value' => 'video',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
						),
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'uxbarn_portfolio',
						),
					),
				),
				'menu_order' => 4,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

			endif;

	}
	
}


if ( ! function_exists( 'jeanne_portfolio_cf_get_attachment_full_width_default_value' ) ) {
		
	function jeanne_portfolio_cf_get_attachment_full_width_default_value() {
		return '';
	}
	
}

if ( ! function_exists( 'jeanne_custom_port_create_attachment_settings' ) ) {
		
	function jeanne_custom_port_create_attachment_settings() {
	
		if ( function_exists( 'acf_add_local_field_group' ) ):

			acf_add_local_field_group(array(
				'key' => 'key_group_uxbarn_portfolio_attachment_settings',
				'title' => esc_html__('Portfolio Image Attachment Settings', 'jeanne'),
				'fields' => array(
					
					array(
						'key' => 'key_field_uxbarn_portfolio_attachment_is_full_width_on_singles',
						'label' => esc_html__('Full-width Image on Portfolio Single Pages?', 'jeanne'),
						'name' => 'uxbarn_portfolio_attachment_is_full_width_on_singles',
						'type' => 'true_false',
						'instructions' => esc_html__('This option will be applied to the image in the grid on the portfolio single pages.', 'jeanne'),
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => jeanne_portfolio_cf_get_attachment_full_width_default_value(),
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'attachment',
							'operator' => '==',
							'value' => 'image',
						),
					),
				),
				'menu_order' => 4,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

			endif;
		
	}
	
}