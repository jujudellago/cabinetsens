<?php
namespace Bridge\Shortcodes\SpecificationList;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class SpecificationList implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_specification_list';
		add_action('bridge_qode_action_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Specification List', 'bridge-core'),
                'base' => $this->base,
                'icon' => 'icon-wpb-specification-list extended-custom-icon-qode',
                'category' => esc_html__('by QODE', 'bridge-core'),
                'params' => array(
					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__('Image', 'bridge-core'),
						'param_name'	=> 'image'
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'bridge-core'),
						'param_name'	=> 'title'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Title Tag', 'bridge-core'),
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'title', 'not_empty'=>true)
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'List Items', 'bridge-core' ),
						'param_name' => 'list_items',
						'value' => '',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Label', 'bridge-core' ),
								'param_name' => 'label',
								'admin_label' => true,
							),array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Value', 'bridge-core' ),
								'param_name' => 'value',
								'admin_label' => true,
							)
						)
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Enable Button', 'bridge-core'),
						'param_name'	=> 'enable_button',
						'value'       => array(
							esc_html__('No', 'bridge-core')  	=> 'no',
							esc_html__('Yes', 'bridge-core') 	=> 'yes'
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Button Link', 'bridge-core'),
						'param_name'	=> 'button_link',
						'dependency'	=> array('element'=>'enable_button', 'value'=>'yes')
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Button Target', 'bridge-core'),
						'param_name'	=> 'button_target',
						'value' => array(
							esc_html__('Self', 'bridge-core')	=> '_self',
							esc_html__('Blank', 'bridge-core')	=> '_blank',
						),
						'dependency'	=> array('element'=>'enable_button', 'value'=>'yes')
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Button Text', 'bridge-core'),
						'param_name'	=> 'button_text',
						'dependency'	=> array('element'=>'enable_button', 'value'=>'yes')
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Button Background Color', 'bridge-core'),
						'param_name'	=> 'button_background_color',
						'dependency'	=> array('element' => 'enable_button', 'value' => 'yes')
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Button Height(px)', 'bridge-core'),
						'param_name'	=> 'button_height',
						'dependency'	=> array('element' => 'enable_button', 'value' => 'yes')
					)
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'image'								=> '',
            'title'								=> '',
            'title_tag'							=> 'h3',
            'list_items'						=> '',
            'enable_button'						=> '',
            'button_link'						=> '',
            'button_target'						=> '_self',
            'button_text'						=> '',
			'button_background_color'			=> '',
			'button_height'						=> ''
        );

        $params = shortcode_atts($args, $atts);

		extract($params);

		$params['content'] = $content;
		$params['list_items'] = json_decode(urldecode($params['list_items']), true);

		$params['button_style']	= $this->getButtonStyle($params);

        $html = bridge_core_get_shortcode_template_part('templates/specification-list-template', 'specification-list', '', $params);

        return $html;
    }

	private function getButtonStyle ($params) {

		$style = array();

		if($params['button_background_color']) {
			$style[] = 'background-color:'. $params['button_background_color'];
		}

		if($params['button_height']) {
			$style[] = 'height:'. $params['button_height'].'px';
			$style[] = 'line-height:'. $params['button_height'].'px';
		}

		return implode(';', $style);
	}

}