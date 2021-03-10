<?php

class QodeCourseListWidget extends BridgeQodeWidget {
	public function __construct() {
		parent::__construct(
			'qode_course_list_widget',
			esc_html__( 'Qode Course List Widget', 'qode-lms' ),
			array( 'description' => esc_html__( 'Display list of your course', 'qode-lms' ) )
		);
		
		$this->setParams();
	}

    /**
     * Sets widget options
     */
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'qode-lms' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'number_of_items',
				'title' => esc_html__( 'Number of Posts', 'qode-lms' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'category',
				'title'       => esc_html__( 'Category Slug', 'qode-lms' ),
				'description' => esc_html__( 'Leave empty for all or use comma for list', 'qode-lms' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'orderby',
				'title'   => esc_html__( 'Order By', 'qode-lms' ),
				'options' => bridge_qode_get_query_order_by_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order',
				'title'   => esc_html__( 'Order', 'qode-lms' ),
				'options' => bridge_qode_get_query_order_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'qode-lms' ),
				'options' => bridge_qode_get_title_tag( true )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_text_transform',
				'title'   => esc_html__( 'Title Text Transform', 'qode-lms' ),
				'options' => bridge_qode_get_text_transform_array( true )
			),
			array(
				'name'    => 'show_instructor',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Show Course Instructor', 'qode-lms' ),
				'options' => bridge_qode_get_yes_no_select_array( false, true )
			),
			array(
				'name'    => 'show_price',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Show Course Price', 'qode-lms' ),
				'options' => bridge_qode_get_yes_no_select_array( false, true )
			),
			array(
				'name'    => 'show_image',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Show Course Featured Image', 'qode-lms' ),
				'options' => bridge_qode_get_yes_no_select_array( false, true )
			)
		);
	}
	
	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$instance['item_layout']         = 'minimal';
		$instance['image_size']          = 'thumbnail';
		$instance['space_between_items'] = 'normal';
		$instance['number_of_columns']   = '1';
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		$params = '';
		//generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		$params .= " enable_price='" . $instance['show_price'] . "' ";
		$params .= " enable_instructor='" . $instance['show_instructor'] . "' ";
		$params .= " enable_image='" . $instance['show_image'] . "' ";
		$params .= " widget='yes' ";
		
		echo '<div class="widget qode-course-list-widget">';
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			
			echo do_shortcode( "[qode_course_list $params]" ); // XSS OK
		echo '</div>';
	}
}