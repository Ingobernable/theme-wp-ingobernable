<?php
/**
 * Register General section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'glades_customize_register_general_settings' );

function glades_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options
	$wp_customize->add_section( 'glades_section_general', array(
        'title'    => esc_html__( 'General Settings', 'glades' ),
        'priority' => 10,
		'panel' => 'glades_options_panel' 
		)
	);
	
	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'glades_theme_options[layout]', array(
        'default'           => 'wide',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_layout'
		)
	);
    $wp_customize->add_control( 'glades_control_layout', array(
        'label'    => esc_html__( 'Theme Width', 'glades' ),
        'section'  => 'glades_section_general',
        'settings' => 'glades_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'wide' => esc_html__( 'Wide Layout (Fullwidth)', 'glades' ),
			'boxed' => esc_html__( 'Boxed Layout', 'glades' )
			)
		)
	);
	
	// Add Settings and Controls for Sidebar
	$wp_customize->add_setting( 'glades_theme_options[sidebar]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_sidebar'
		)
	);
    $wp_customize->add_control( 'glades_control_sidebar', array(
        'label'    => esc_html__( 'Theme Layout', 'glades' ),
        'section'  => 'glades_section_general',
        'settings' => 'glades_theme_options[sidebar]',
        'type'     => 'radio',
		'priority' => 2,
        'choices'  => array(
            'left-sidebar' => esc_html__( 'Left Sidebar', 'glades' ),
            'right-sidebar' => esc_html__( 'Right Sidebar', 'glades' )
			)
		)
	);
	
	// Add Footer Settings
	$wp_customize->add_setting( 'glades_theme_options[footer_text]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_footer_text'
		)
	);
    $wp_customize->add_control( 'glades_control_footer_text', array(
        'label'    => esc_html__( 'Footer Text', 'glades' ),
        'section'  => 'glades_section_general',
        'settings' => 'glades_theme_options[footer_text]',
        'type'     => 'textarea',
		'priority' => 3
		)
	);
	
	// Add Default Fonts Header
	$wp_customize->add_setting( 'glades_theme_options[default_fonts]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Header_Control(
        $wp_customize, 'glades_control_default_fonts', array(
            'label' => esc_html__( 'Default Fonts', 'glades' ),
            'section' => 'glades_section_general',
            'settings' => 'glades_theme_options[default_fonts]',
            'priority' => 5
            )
        )
    );
	
	// Add Settings and Controls for Deactivate Google Font setting
	$wp_customize->add_setting( 'glades_theme_options[deactivate_google_fonts]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_deactivate_google_fonts', array(
        'label'    => esc_html__( 'Deactivate Google Fonts in case your language is not compatible.', 'glades' ),
        'section'  => 'glades_section_general',
        'settings' => 'glades_theme_options[deactivate_google_fonts]',
        'type'     => 'checkbox',
		'priority' => 6
		)
	);
	
}