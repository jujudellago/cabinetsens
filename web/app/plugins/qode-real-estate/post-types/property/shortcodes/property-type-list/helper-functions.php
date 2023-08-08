<?php
if(!function_exists('qodef_re_property_type_list_shortcode_helper')) {
    function qodef_re_property_type_list_shortcode_helper($shortcodes_class_name) {
        $shortcodes = array(
            'QodefRE\CPT\Shortcodes\Property\PropertyTypeList'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('qodef_re_filter_add_vc_shortcode', 'qodef_re_property_type_list_shortcode_helper');
}

if( !function_exists('qodef_re_set_property_type_list_icon_class_name_for_vc_shortcodes') ) {
    /**
     * Function that set custom icon class name for property list shortcode to set our icon for Visual Composer shortcodes panel
     */
    function qodef_re_set_property_type_list_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-property-type-list';

        return $shortcodes_icon_class_array;
    }

    add_filter('qodef_re_filter_add_vc_shortcodes_custom_icon_class', 'qodef_re_set_property_type_list_icon_class_name_for_vc_shortcodes');
}

if(!function_exists('qodef_re_include_elementor_property_type_list_shortcode')) {
	function qodef_re_include_elementor_property_type_list_shortcode() {
		include_once QODE_RE_CPT_PATH.'/property/shortcodes/property-type-list/elementor-property-type-list.php';
	}

	add_action('bridge_core_load_elementor_shortcodes_from_plugins', 'qodef_re_include_elementor_property_type_list_shortcode');
}
