<?php
/**
 * Register upgrade section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'leeway_customize_register_upgrade_settings' );

function leeway_customize_register_upgrade_settings( $wp_customize ) {
	
	// Add Upgrade / More Features Section
	$wp_customize->add_section( 'leeway_section_upgrade', array(
        'title'    => esc_html__( 'More Features', 'leeway' ),
        'priority' => 70,
		'panel' => 'leeway_options_panel' 
		)
	);
	
	// Add custom Upgrade Content control
	$wp_customize->add_setting( 'leeway_theme_options[upgrade]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Leeway_Customize_Upgrade_Control(
        $wp_customize, 'leeway_control_upgrade', array(
            'section' => 'leeway_section_upgrade',
            'settings' => 'leeway_theme_options[upgrade]',
            'priority' => 1
            )
        )
    );

}