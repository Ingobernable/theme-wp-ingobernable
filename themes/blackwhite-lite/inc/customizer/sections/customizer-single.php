<?php
/**
 * Single Settings
 *
 * Register Single Settings section, settings and controls for Theme Customizer
 *
 * @package BlackWhite
 */


/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function blackwhite_lite_customize_register_single_options( $wp_customize ) {
	// Add Section for Theme Options
	$wp_customize->add_section( 'blackwhite_lite_section_single', array(
        'title'    => esc_html__( 'Single Post Settings', 'blackwhite-lite' ),
        'priority' => 30,
		'panel' => 'blackwhite_lite_options_panel' 
		)
	);

	// Add Settings and Controls for Post length on home & archives
	$wp_customize->add_setting( 'blackwhite_lite_theme_options[related_posts]', array(
        'default'           => 'cat',
        'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'blackwhite_lite_sanitize_select'
		)
	);
    $wp_customize->add_control( 'blackwhite_lite_theme_options[related_posts]', array(
        'label'    => esc_html__( 'Related posts', 'blackwhite-lite' ),
        'section'  => 'blackwhite_lite_section_single',
        'settings' => 'blackwhite_lite_theme_options[related_posts]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'cat' => esc_html__( 'Categories', 'blackwhite-lite' ),
            'tag' => esc_html__( 'Tags', 'blackwhite-lite' )
			)
		)
	);
}
add_action( 'customize_register', 'blackwhite_lite_customize_register_single_options' );