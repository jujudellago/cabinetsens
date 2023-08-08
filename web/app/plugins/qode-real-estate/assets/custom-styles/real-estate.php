<?php

if (!function_exists('qode_real_estate_dynamic_style') && qodef_re_theme_installed()) {
    function qode_real_estate_dynamic_style() {

        $first_color = bridge_qode_options()->getOptionValue('first_color');

        if( ! empty( $first_color ) ){
            $color_selectors = '.qodef-property-tags .qodef-tag-item a:hover, .qodef-property-list-holder .qodef-property-list-filter-part .qodef-filter-features-holder .qodef-feature-item input[type=checkbox] + label .qode-label-view:after, .qodef-re-author-holder .qodef-re-author-footer.qodef-author-social .qodef-contact-social-icons a:hover, .qodef-property-single-holder .qodef-property-attachment a, .qodef-property-tags .qodef-tag-item a:hover, .qodef-property-title-section .qodef-property-stars, .qodef-property-title-section .qodef-title-inline-part .qodef-stars, .widget.qodef-contact-property-widget .qodef-contact-social-icons a:hover, .widget.qodef-recently-viewed-property-widget article:hover .qodef-pli-title a, .qodef-re-compare-popup #qodef-re-popup-items li > div .qodef-ci-price, .qodef-re-compare-items-holder.qodef-items-standard .qodef-ci-item .qodef-ci-price, .qodef-pl-standard-pagination ul li.qodef-pl-pag-active a, .qodef-property-list-holder .qodef-property-list-filter-part .qodef-filter-type-holder .qodef-property-type-list-holder .qodef-taxonomy-icon, .qodef-property-list-holder.qodef-pl-layout-info-over .qodef-pl-item .qodef-item-featured, .qodef-property-search-holder .qodef-search-type-section .qodef-property-type-list-holder .qodef-ptl-item.active .qodef-ptl-item-title, .dsidx-results .dsidx-prop-summary .dsidx-prop-title b, .dsidx-results .dsidx-prop-summary .dsidx-prop-title b a:hover, #ihf-main-container a:hover, #ihf-main-container .ihf-listing-detail h4.ihf-price .ihf-sold-price, .qodef-map-marker-holder .qodef-info-window-inner > a:hover ~ .qodef-info-window-details h5, .qodef-cluster-marker:hover .qodef-cluster-marker-inner .qodef-cluster-marker-number, .qodef-agency-agent-list .qodef-aal-item-social .qodef-icon-shortcode a:hover';
            $background_selectors = '.qodef-property-list-holder .qodef-property-list-filter-part .qodef-range-slider .ui-slider-range, .qodef-property-list-holder .qodef-property-list-filter-part .qodef-range-slider .ui-slider-handle, .qodef-property-enquiry-inner .qodef-property-enquiry-close, .qodef-property-title-section .qodef-property-statuses .qodef-property-status, .qodef-re-compare-popup #qodef-re-popup-items li > div .qodef-ci-statuses, .qodef-re-compare-items-holder.qodef-items-standard .qodef-ci-item .qodef-ci-statuses, .qodef-property-list-holder .qodef-property-list-filter-part .qodef-range-slider .ui-slider-range, .qodef-property-list-holder .qodef-property-list-filter-part .qodef-range-slider .ui-slider-handle, .qodef-property-list-holder.qodef-pl-layout-info-over .qodef-pl-item .qodef-property-statuses, .qodef-property-list-holder.qodef-pl-layout-standard .qodef-pl-item .qodef-property-statuses .qodef-property-status, .dsidx-resp-search-box input[type=submit]:hover, #dsidx #dsidx-listings li.dsidx-listing-container .dsidx-data .dsidx-primary-data .dsidx-price, .dsidx-details #dsidx-header #dsidx-primary-data #dsidx-price td, .dsidx-details #dsidx-contact-form #dsidx-contact-form-submit:hover, .widget.dsidx-widget-single-listing-wrap .dsidx-widget-single-listing .dsidx-widget-single-listing-meta .dsidx-widget-single-listing-price, #ihf-main-container button.btn.btn-default:not(.dropdown-toggle):hover, #ihf-main-container a.btn.btn-default:not(.dropdown-toggle):hover, #ihf-main-container a.btn.btn-primary:hover, #ihf-main-container button.btn.btn-primary:hover, #ihf-main-container .btn-group.open > .dropdown-menu > li > a:hover, #ihf-main-container .btn-group.open > .dropdown-menu > .active a, #ihf-main-container #ihf-main-search-form #ihf-search-location-tab .ihf-one-selectedArea button, #ihf-main-container #ihf-main-search-form #ihf-search-location-tab #areaPickerExpandAllCloseButton:hover span, #ihf-main-container #ihf-main-search-form #ihf-search-location-tab .areaPickerExpandAllElement > div.areaSelected, #ihf-main-container #ihf-main-search-form #ihf-search-location-tab .areaPickerExpandAllElement > div.autocompleteMouseOver, #ihf-main-container .title-bar-1, #ihf-main-container .ihf-grid-result .ihf-map-icon, #ihf-main-container .ihf-result.row .ihf-map-icon';
            $border_selectors = '.qodef-property-tags .qodef-tag-item a:hover, .dsidx-resp-search-box input[type=submit]:hover, .dsidx-details #dsidx-contact-form #dsidx-contact-form-submit:hover, #ihf-main-container button.btn.btn-default:not(.dropdown-toggle):hover, #ihf-main-container a.btn.btn-default:not(.dropdown-toggle):hover, #ihf-main-container a.btn.btn-primary:hover, #ihf-main-container button.btn.btn-primary:hover, #ihf-main-container #ihf-main-search-form #ihf-search-location-tab .ihf-one-selectedArea button, #ihf-main-container #ihf-main-search-form #ihf-search-location-tab #areaPickerExpandAllCloseButton:hover span, #ihf-main-container #ihf-main-search-form #ihf-search-location-tab .areaPickerExpandAllElement > div.areaSelected, #ihf-main-container #ihf-main-search-form #ihf-search-location-tab .areaPickerExpandAllElement > div.autocompleteMouseOver';
            $fill_selectors = '.qodef-map-marker-holder .qodef-map-marker .qodef-map-marker-inner svg path, .qodef-cluster-marker .qodef-cluster-marker-inner svg path';

            echo bridge_qode_dynamic_css( $color_selectors, array( 'color' => $first_color ) );
            echo bridge_qode_dynamic_css( $background_selectors, array( 'background-color' => $first_color ) );
            echo bridge_qode_dynamic_css( $border_selectors, array( 'border-color' => $first_color ) );
            echo bridge_qode_dynamic_css( $fill_selectors, array( 'fill' => $first_color ) );
        }
    }

    add_action('bridge_qode_action_style_dynamic', 'qode_real_estate_dynamic_style');
}