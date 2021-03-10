<?php

if(!function_exists('qode_woocomerce_checkout_integration_get_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function qode_woocomerce_checkout_integration_get_shortcode_module_template_part($template, $shortcode, $slug = '', $params = array()) {

		//HTML Content from template
		$html          = '';
		$template_path = QODE_WOOCOMMERCE_CHECKOUT_INTEGRATION_PATH.'/'.$shortcode;

		$temp = $template_path.'/'.$template;

		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if (!empty($temp)) {
			if (!empty($slug)) {
				$template = "{$temp}-{$slug}.php";

				if(!file_exists($template)) {
					$template = $temp.'.php';
				}
			} else {
				$template = $temp.'.php';
			}
		}

		if ($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}

if(!function_exists('qode_woocomerce_checkout_integration_get_buy_form')) {
	/**
	 * Load form.
	 *
	 * @return html
	 */
	function qode_woocomerce_checkout_integration_get_buy_form($params = array(), $button_params =  array()) {

		$default_params = array(
			'show_quantity_field' => false
		);

		$default_button_params = array(
			'input_text' => esc_html__('Add to cart', 'qode-woocommerce-checkout-integration')
		);

		$params = array_unique (array_merge ($default_params, $params));
		$params['button_params'] = array_unique (array_merge ($default_button_params, $button_params));
		$html = qode_woocomerce_checkout_integration_get_shortcode_module_template_part('form','templates', '', $params);

		echo $html;
	}
}

if (!function_exists('qode_woocomerce_checkout_integration_core_plugin_installed')) {
	//is Qode Core installed?
	function qode_woocomerce_checkout_integration_core_plugin_installed() {
		return defined('QODE_CORE_VERSION');
	}
}

if (!function_exists('qode_woocomerce_checkout_integration_theme_installed')) {
	//is Qode Core installed?
	function qode_woocomerce_checkout_integration_theme_installed() {
		return defined('QODE_ROOT');
	}
}