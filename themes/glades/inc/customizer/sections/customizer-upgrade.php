<?php
/**
 * Register upgrade section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'glades_customize_register_upgrade_settings' );

function glades_customize_register_upgrade_settings( $wp_customize ) {
	
	// Add Upgrade / More Features Section
	$wp_customize->add_section( 'glades_section_upgrade', array(
        'title'    => esc_html__( 'More Features', 'glades' ),
        'priority' => 70,
		'panel' => 'glades_options_panel' 
		)
	);
	
	// Add custom Upgrade Content control
	$wp_customize->add_setting( 'glades_theme_options[upgrade]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Glades_Customize_Upgrade_Control(
        $wp_customize, 'glades_control_upgrade', array(
            'section' => 'glades_section_upgrade',
            'settings' => 'glades_theme_options[upgrade]',
            'priority' => 1
            )
        )
    );

}