<?php
/**
 * Register Header Content section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'glades_customize_register_header_settings' );

function glades_customize_register_header_settings( $wp_customize ) {

	// Add Sections for Header Content
	$wp_customize->add_section( 'glades_section_header', array(
        'title'    => esc_html__( 'Header Settings', 'glades' ),
        'priority' => 20,
		'panel' => 'glades_options_panel' 
		)
	);

	// Add Header Content Header
	$wp_customize->add_setting( 'glades_theme_options[header_content]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Header_Control(
        $wp_customize, 'glades_control_header_content', array(
            'label' => esc_html__( 'Header Content', 'glades' ),
            'section' => 'glades_section_header',
            'settings' => 'glades_theme_options[header_content]',
            'priority' => 2
            )
        )
    );

	// Add Settings and Controls for Header
	$wp_customize->add_setting( 'glades_theme_options[header_icons]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'glades_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'glades_control_header_icons', array(
        'label'    => esc_html__( 'Display Social Icons on top navigation', 'glades' ),
        'section'  => 'glades_section_header',
        'settings' => 'glades_theme_options[header_icons]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);
	
}

?>