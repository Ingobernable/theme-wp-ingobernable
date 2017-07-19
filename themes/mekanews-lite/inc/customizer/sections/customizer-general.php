<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package Mekanews_Lite
 */
/**
 * Adds all general settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function mekanews_lite_customize_register_general_options( $wp_customize ) {
// Add Section for Theme Options
	$wp_customize->add_section( 'mekanews_lite_section_general', array(
        'title'    => esc_html__( 'General Settings', 'mekanews-lite' ),
        'priority' => 10,
		'panel' => 'mekanews_lite_options_panel' 
		)
	);
	
	//Add Settings and Controls for Layout
	$wp_customize->add_setting( 'mekanews_lite_theme_options[layout]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'mekanews_lite_sanitize_select'
		)
	);
    $wp_customize->add_control( 'mekanews_lite_theme_options[layout]', array(
        'label'    => esc_html__( 'Theme Layout', 'mekanews-lite' ),
        'section'  => 'mekanews_lite_section_general',
        'settings' => 'mekanews_lite_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'left-sidebar' => esc_html__( 'Left Sidebar', 'mekanews-lite' ),
            'right-sidebar' => esc_html__( 'Right Sidebar', 'mekanews-lite' )
			)
		)
	);
	
}
add_action( 'customize_register', 'mekanews_lite_customize_register_general_options' );