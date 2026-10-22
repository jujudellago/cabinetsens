<?php
/**
 * The template for displaying [vc_gallery] shortcode of 'Image gallery' element.
 *
 * This template can be overridden by copying it to yourtheme/vc_templates/vc_gallery.php.
 *
 * @see https://kb.wpbakery.com/docs/developers-how-tos/change-shortcodes-html-output
 *
 * @var array $atts
 * @var WPBakeryShortCode_Vc_gallery $this
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$thumbnail = '';
$title = $source = $type = $onclick = $custom_links = $custom_links_target = $img_size = $external_img_size = $images = $custom_srcs = $el_class = $el_id = $interval = $css = $css_animation = '';
$column_number = '3';
$grayscale = 'no';
$enable_drag = $direction_nav = $control_nav = $show_image_description = 'no';
$pause_on_hover = $frame = $choose_frame = $images_space = '';
$large_img_src = '';

$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $attributes );

/**
 * Extracted values.
 *
 * @var string $title
 * @var string $source
 * @var string $type
 * @var string $onclick
 * @var string $custom_links
 * @var string|null $custom_links_target
 * @var string $img_size
 * @var string $external_img_size
 * @var string $images
 * @var string $custom_srcs
 * @var string $el_class
 * @var string|null $el_id
 * @var string $interval
 * @var string $css
 * @var string $css_animation
 * @var string $column_number
 * @var string $grayscale
 * @var string $enable_drag
 * @var string $direction_nav
 * @var string $control_nav
 * @var string $show_image_description
 * @var string $pause_on_hover
 * @var string $frame
 * @var string $choose_frame
 * @var string $images_space
 */

$default_src = vc_asset_url( 'vc/no_image.png' );

$gal_images = '';
$el_start = '';
$el_end = '';
$slides_wrap_start = '';
$slides_wrap_end = '';

$el_class = $this->getExtraClass( $el_class );

if ( 'nivo' === $type ) {
	$type = ' wpb_slider_nivo theme-default';
	wp_enqueue_script( 'nivo-slider' );
	wp_enqueue_style( 'nivo-slider-css' );
	wp_enqueue_style( 'nivo-slider-theme' );

	$slides_wrap_start = '<div class="nivoSlider">';
	$slides_wrap_end = '</div>';
} elseif ( 'flexslider' === $type || 'flexslider_fade' === $type || 'flexslider_slide' === $type || 'fading' === $type ) {
	$el_start = '<li>';
	$el_end = '</li>';
	$slides_wrap_start = '<ul class="slides">';
	$slides_wrap_end = '</ul>';
} elseif ( 'image_grid' === $type ) {
	$li_classes = ( 'yes' === $grayscale ) ? 'grayscale' : 'no_grayscale';

	$el_start = '<li class="' . esc_attr( $li_classes ) . '">';
	$el_end = '</li>';
	$slides_wrap_start = '<div class="gallery_holder"><ul class="gallery_inner ' . esc_attr( $images_space ) . ' v' . esc_attr( $column_number ) . '">';
	$slides_wrap_end = '</ul></div>';
}

$flex_fx = '';
$frame_class = '';
if ( 'flexslider' === $type || 'flexslider_fade' === $type || 'fading' === $type ) {
	$type = ' wpb_flexslider flexslider_fade flexslider';
	$flex_fx = ' data-flex_fx="fade"';
} elseif ( 'flexslider_slide' === $type ) {
	$type = ' wpb_flexslider flexslider_slide flexslider';
	$flex_fx = ' data-flex_fx="slide"';
	if ( 'use_frame' === $frame ) {
		$frame_class = ' have_frame';
	}
} elseif ( 'image_grid' === $type ) {
	$type = ' wpb_image_grid';
}

$control_nav_data = '';
if ( '' !== $control_nav ) {
	$control_nav_data .= ' data-control="' . ( 'yes' === $control_nav ? 'true' : 'false' ) . '"';
}

$direction_nav_data = '';
if ( '' !== $direction_nav ) {
	$direction_nav_data .= ' data-direction="' . ( 'yes' === $direction_nav ? 'true' : 'false' ) . '"';
}

$pause_on_hover_data = '';
if ( '' !== $pause_on_hover ) {
	$pause_on_hover_data .= ' data-pause-on-hover="' . ( 'yes' === $pause_on_hover ? 'true' : 'false' ) . '"';
}

$drag_data = '';
if ( '' !== $enable_drag ) {
	$drag_data .= ' data-drag="' . ( 'yes' === $enable_drag ? 'true' : 'false' ) . '"';
}

$additional_classes = '';
if ( 'yes' === $control_nav ) {
	$additional_classes .= ' has_control_nav';
}
if ( 'yes' === $enable_drag ) {
	$additional_classes .= ' drag_enabled';
}

if ( '' === $images ) {
	$images = '-1,-2,-3';
}

if ( 'custom_link' === $onclick ) {
	$custom_links = vc_value_from_safe( $custom_links );
	$custom_links = explode( ',', $custom_links );
}

$pretty_rel_random = ' data-rel="prettyPhoto[rel-' . get_the_ID() . '-' . wp_rand() . ']"';
$image_data = json_decode( $images, true );

foreach ( $this->get_images_list( $images, $source, $custom_srcs ) as $i => $image ) {
	switch ( $source ) {
		case 'media_library':
			if ( $image > 0 ) {
				$img = wpb_getImageBySize( [
					'attach_id' => $image,
					'thumb_size' => $img_size,
				] );
				$thumbnail = $img['thumbnail'];
				$large_img_src = $img['p_img_large'][0];
			} else {
				$large_img_src = $default_src;
				$img_attributes = [
					'src' => esc_url( $large_img_src ),
				];
				$img_attributes = vc_add_lazy_loading_attribute( $img_attributes );
				$thumbnail = '<img ' . vc_stringify_attributes( $img_attributes ) . ' />';
			}
			break;

		case 'external_link':
			$dimensions = vc_extract_dimensions( $external_img_size );
			$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';

			$img_attributes = [
				'src' => esc_url( $image ),
			];
			$img_attributes = vc_add_lazy_loading_attribute( $img_attributes );

			$thumbnail = '<img ' . $hwstring . ' ' . vc_stringify_attributes( $img_attributes ) . ' />';
			$large_img_src = $image;
			break;

		default:
			$thumbnail = '';
			$large_img_src = $default_src;
	}

	$hover_image = '';
	if ( ' wpb_image_grid' === $type && 'no' === $grayscale ) {
		$hover_image = '<span class="gallery_hover"><i class="fa fa-search"></i></span>';
	}

	$description_html = '';
	if ( 'yes' === $show_image_description && 'media_library' === $source && $image > 0 && '' !== get_post_field( 'post_content', $image ) ) {
		$description_html = '<div class="qode-image-slider-description"><p>' . get_post_field( 'post_content', $image ) . '</p></div>';
	}

	$link_start = '';
	$link_end = '';

	switch ( $onclick ) {
		case 'img_link_large':
			$link_start = '<a itemprop="url" href="' . esc_url( $large_img_src ) . '" target="' . esc_attr( $custom_links_target ) . '">' . $hover_image;
			$link_end = '</a>';
			break;

		case 'link_image':
			$link_start = '<a itemprop="image" class="qode-prettyphoto" href="' . esc_url( $large_img_src ) . '"' . $pretty_rel_random . '>' . $hover_image;
			$link_end = '</a>';
			break;

		case 'custom_link':
			if ( 'media_library' === $source && is_array( $image_data ) && ! empty( $image_data[ $image ]['url'] ) ) {
				$wpb_link = $image_data[ $image ];
				$link_start = '<a itemprop="url" href="' . esc_url( $wpb_link['url'] ) . '"';
				if ( ! empty( $wpb_link['target'] ) ) {
					$link_start .= ' target="' . esc_attr( $wpb_link['target'] ) . '"';
				}
				if ( ! empty( $wpb_link['rel'] ) ) {
					$link_start .= ' rel="' . esc_attr( $wpb_link['rel'] ) . '"';
				}
				if ( ! empty( $wpb_link['title'] ) ) {
					$link_start .= ' title="' . esc_attr( $wpb_link['title'] ) . '"';
				}
				$link_start .= '>' . $hover_image;
				$link_end = '</a>';
			} elseif ( ! empty( $custom_links[ $i ] ) ) {
				$link_start = '<a itemprop="url" href="' . esc_url( $custom_links[ $i ] ) . '"' . ( ! empty( $custom_links_target ) ? ' target="' . esc_attr( $custom_links_target ) . '"' : '' ) . '>' . $hover_image;
				$link_end = '</a>';
			}
			break;
	}

	$gal_images .= $el_start . $link_start . $thumbnail . $link_end . $description_html . $el_end;
}

$settings = $this->getSettings();
$element_class = empty( $settings['element_default_class'] ) ? '' : $settings['element_default_class'];
$class_to_filter = 'wpb_gallery wpb_content_element vc_clearfix';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . ' ' . esc_attr( $element_class ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $settings['base'], $atts );

if ( 'use_frame' === $frame ) {
	$css_class .= ' frame_holder';

	switch ( $choose_frame ) {
		case 'frame2':
			$css_class .= ' frame_holder2';
			break;
		case 'frame3':
			$css_class .= ' frame_holder3';
			break;
		case 'frame4':
			$css_class .= ' frame_holder4';
			break;
	}
}

$wrapper_attributes = [];
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$output = '';
$output .= '<div class="' . esc_attr( trim( $css_class ) ) . '" ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_widget_title( [
	'title' => $title,
	'extraclass' => 'wpb_gallery_heading',
] );
$output .= '<div class="wpb_gallery_slides' . esc_attr( $additional_classes . $type . $frame_class ) . '" data-interval="' . esc_attr( $interval ) . '"' . $flex_fx . $control_nav_data . $direction_nav_data . $pause_on_hover_data . $drag_data . '>' . $slides_wrap_start . $gal_images . $slides_wrap_end . '</div>';

if ( 'use_frame' === $frame ) {
	$output .= "<div class='gallery_frame'>";
	switch ( $choose_frame ) {
		case 'frame2':
			$output .= "<img itemprop='image' src='" . esc_url( get_template_directory_uri() . '/img/slider_frame-2.png' ) . "'/>";
			break;
		case 'frame3':
			$output .= "<img itemprop='image' src='" . esc_url( get_template_directory_uri() . '/img/slider_frame-3.png' ) . "'/>";
			break;
		case 'frame4':
			$output .= "<img itemprop='image' src='" . esc_url( get_template_directory_uri() . '/img/slider_frame-4.png' ) . "'/>";
			break;
		default:
			$output .= "<img itemprop='image' src='" . esc_url( get_template_directory_uri() . '/img/slider_frame.png' ) . "'/>";
			break;
	}
	$output .= '</div>';
}

$output .= '</div>';
$output .= '</div>';

echo bridge_qode_get_module_part( $output );
