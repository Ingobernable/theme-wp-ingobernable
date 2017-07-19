<?php
/*customizing default colors section and adding new controls-setting too*/
$wp_customize->add_section( 'colors', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Colors', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );
/*Primary color*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'supermag_theme_options[supermag-primary-color]',
        array(
            'label'		=> __( 'Primary Color', 'supermag' ),
            'section'   => 'colors',
            'settings'  => 'supermag_theme_options[supermag-primary-color]',
            'type'	  	=> 'color'
) ) );