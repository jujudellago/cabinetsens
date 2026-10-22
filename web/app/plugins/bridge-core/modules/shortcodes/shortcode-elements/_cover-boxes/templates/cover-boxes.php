<?php
	
	$html = "";
	$html .= "<div class='cover_boxes' data-active-element='" . esc_attr( $active_element ) . "'><ul class='clearfix'>";
	
	$html .= "<li>";
	$html .= "<div class='box'>";
	if ( $target1 != "" ) {
		$target1 = esc_attr( $target1 );
	} else {
		$target1 = "_self";
	}
	if ( is_numeric( $image1 ) ) {
		$image_src1 = esc_url( wp_get_attachment_url( $image1 ) );
	} else {
		$image_src1 = esc_url( $image1 );
	}
	if ( is_numeric( $image2 ) ) {
		$image_src2 = esc_url( wp_get_attachment_url( $image2 ) );
	} else {
		$image_src2 = esc_url( $image2 );
	}
	if ( is_numeric( $image3 ) ) {
		$image_src3 = esc_url( wp_get_attachment_url( $image3 ) );
	} else {
		$image_src3 = esc_url( $image3 );
	}
	$html .= "<a itemprop='url' class='thumb' href='" . esc_url( $link1 ) . "' target='" . esc_attr( $target1 ) . "'><img itemprop='image' alt='" . esc_attr( $title1 ) . "' src='" . esc_url( $image_src1 ) . "' /></a>";
	
	$title1_style = array();
	$text1_style = array();

	if ( ! empty( $title_color1 ) ) {
		$title1_style[] = 'color:' . esc_attr( $title_color1 );
	}
	if ( ! empty( $text_color1 ) ) {
		$text1_style[] = 'color:' . esc_attr( $text_color1 );
	}
	
	$html .= '<div class="box_content"><h3 ' . bridge_qode_get_inline_style($title1_style) . '>' . esc_html( $title1 ) . '</h3>';
	$html .= '<p ' . bridge_qode_get_inline_style($text1_style) . '>' . esc_html( $text1 ) . '</p>';
	
	$button_class               = "";
	$button_class_wrapper_open  = "";
	$button_class_wrapper_close = "";
	if ( $read_more_button_style != "no" ) {
		$button_class = "qbutton tiny";
	} else {
		$button_class               = "cover_boxes_read_more";
		$button_class_wrapper_open  = "<h5>";
		$button_class_wrapper_close = "</h5>";
	}
	
	if ( $link_label1 != "" ) {
		$html .= $button_class_wrapper_open . "<a itemprop='url' class='" . esc_attr( $button_class ) . "' href='" . esc_url( $link1 ) . "' target='" . esc_attr( $target1 ) . "'>" . esc_html( $link_label1 ) . "</a>" . $button_class_wrapper_close;
	}
	
	$html .= "</div></div>";
	$html .= "</li>";
	
	$html .= "<li>";
	$html .= "<div class='box'>";
	if ( $target2 != "" ) {
		$target2 = esc_attr( $target2 );
	} else {
		$target2 = "_self";
	}
	$html .= "<a itemprop='url' class='thumb' href='" . esc_url( $link2 ) . "' target='" . esc_attr( $target2 ) . "'><img itemprop='image' alt='" . esc_attr( $title2 ) . "' src='" . esc_url( $image_src2 ) . "' /></a>";
	

	$title2_style = array();
	$text2_style = array();
	
	if ( ! empty( $title_color2 ) ) {
		$title2_style[] = 'color:' . esc_attr( $title_color2 );
	}
	if ( ! empty( $text_color2 ) ) {
		$text2_style[] = 'color:' . esc_attr( $text_color2 );
	}

	$html .= '<div class="box_content"><h3 ' . bridge_qode_get_inline_style($title2_style) . '>' . esc_html( $title2 ) . '</h3>';
	$html .= '<p ' . bridge_qode_get_inline_style($text2_style) . '>' . esc_html( $text2 ) . '</p>';
	
	
	if ( $link_label2 != "" ) {
		$html .= $button_class_wrapper_open . "<a itemprop='url' class='" . esc_attr( $button_class ) . "' href='" . esc_url( $link2 ) . "' target='" . esc_attr( $target2 ) . "'>" . esc_html( $link_label2 ) . "</a>" . $button_class_wrapper_close;
	}
	
	$html .= "</div></div>";
	$html .= "</li>";
	
	$html .= "<li>";
	$html .= "<div class='box'>";
	if ( $target3 != "" ) {
		$target3 = esc_attr( $target3 );
	} else {
		$target3 = "_self";
	}
	$html .= "<a itemprop='url' class='thumb' href='" . esc_url( $link3 ) . "' target='" . esc_attr( $target3 ) . "'><img itemprop='image' alt='" . esc_attr( $title3 ) . "' src='" . esc_url( $image_src3 ) . "' /></a>";

	$title3_style = array();
	$text3_style = array();
	
	if ( ! empty( $title_color3 ) ) {
		$title3_style[] = 'color:' . esc_attr( $title_color3 );
	}
	if ( ! empty( $text_color3 ) ) {
		$text3_style[] = 'color:' . esc_attr( $text_color3 );
	}
	
	$html .= '<div class="box_content"><h3 ' . bridge_qode_get_inline_style( $title3_style ) . '>' . esc_html( $title3 ) . '</h3>';
	$html .= '<p ' . bridge_qode_get_inline_style( $text3_style ) . '>' . esc_html( $text3 ) . '</p>';
	
	if ( $link_label3 != "" ) {
		$html .= $button_class_wrapper_open . "<a itemprop='url' class='" . esc_attr( $button_class ) . "' href='" . esc_url( $link3 ) . "' target='" . esc_attr( $target3 ) . "'>" . esc_html( $link_label3 ) . "</a>" . $button_class_wrapper_close;
	}
	
	$html .= "</div></div>";
	$html .= "</li>";
	
	$html .= "</ul></div>";
	
	echo bridge_qode_get_module_part( $html );
