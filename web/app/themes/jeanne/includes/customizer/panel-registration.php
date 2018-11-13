<?php
/**
 * Register the customizer panels
 *
 * @since 1.0.0
 */



Kirki::add_panel( 'jeanne_ctmzr_panel_settings', array(
	'priority'    => 55,
	'title'       => esc_attr__( 'Theme Settings', 'jeanne' ),
	'description' => '',
));