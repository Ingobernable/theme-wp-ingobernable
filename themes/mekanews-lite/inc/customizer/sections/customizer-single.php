<?php
/**
 * Single Settings
 *
 * Register Single Settings section, settings and controls for Theme Customizer
 *
 * @package Mekanews_Lite
 */


/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function mekanews_lite_customize_register_single_options( $wp_customize ) {
		// Add Section for Theme Options
		$wp_customize->add_section( 'mekanews_lite_section_single', array(
	        'title'    => esc_html__( 'Single Post Settings', 'mekanews-lite' ),
	        'priority' => 40,
			'panel' => 'mekanews_lite_options_panel' 
			)
		);

		// Add Settings and Controls for Post length on home & archives
		$wp_customize->add_setting( 'mekanews_lite_theme_options[related_posts]', array(
	        'default'           => 'cat',
	        'type'           	=> 'option',
	        'transport'         => 'refresh',
	        'sanitize_callback' => 'mekanews_lite_sanitize_select'
			)
		);
	    $wp_customize->add_control( 'mekanews_lite_theme_options[related_posts]', array(
	        'label'    => esc_html__( 'Related posts', 'mekanews-lite' ),
	        'section'  => 'mekanews_lite_section_single',
	        'settings' => 'mekanews_lite_theme_options[related_posts]',
	        'type'     => 'radio',
			'priority' => 1,
	        'choices'  => array(
	            'cat' => esc_html__( 'Categories', 'mekanews-lite' ),
	            'tag' => esc_html__( 'Tags', 'mekanews-lite' )
				)
			)
		);
	}
add_action( 'customize_register', 'mekanews_lite_customize_register_single_options' );