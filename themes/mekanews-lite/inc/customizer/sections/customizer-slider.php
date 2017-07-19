<?php
/**
 * Slideshow
 *
 * Register Slideshow, settings and controls for Theme Customizer
 *
 * @package Mekanews_Lite
 */
/**
 * Adds Slideshow settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function mekanews_lite_customize_register_slider_options( $wp_customize ) {
// Add Section for Theme Options
	$wp_customize->add_section( 'mekanews_lite_section_slider', array(
        'title'    => esc_html__( 'Slider Option', 'mekanews-lite' ),
        'priority' => 30,
		'panel' => 'mekanews_lite_options_panel' 
		)
	);

	//Option Disable & Enable Slide Show
	$wp_customize->add_setting( 'mekanews_lite_theme_options[slider]', array(
		'default'           => false,
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'mekanews_lite_sanitize_checkbox'
		)
	);
	$wp_customize->add_control( 'mekanews_lite_theme_options[slider]', array(
		'label'    => esc_html__( 'Feature Slide', 'mekanews-lite' ),
		'section'  => 'mekanews_lite_section_slider',
		'settings' => 'mekanews_lite_theme_options[slider]',
		'type'     => 'checkbox',
		'priority' => 1
		)
	);
	
	
}

add_action( 'customize_register', 'mekanews_lite_customize_register_slider_options' );