<?php
/**
 * The template to display the 404 page
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */

get_header();

get_template_part( apply_filters('callie_britt_filter_get_template_part', 'content', '404'), '404' );

get_footer();
?>