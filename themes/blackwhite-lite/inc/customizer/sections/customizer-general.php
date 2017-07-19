<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package BlackWhite
 */
function blackwhite_lite_customize_register_general_options( $wp_customize ) {
    // Add Section for Theme Options
    $wp_customize->add_section( 'blackwhite_lite_section_general', array(
        	'title'			 => esc_html__( 'General Settings', 'blackwhite-lite' ),
            'priority'		 => 10,
            'panel'			 => 'blackwhite_lite_options_panel' 
        )
    );

// Add Settings and Controls for Layout
    $wp_customize->add_setting( 'blackwhite_lite_theme_options[layout]', array(
            'default'			=> 'right-sidebar',
            'type'				=> 'option',
            'transport'			=> 'refresh',
            'sanitize_callback' => 'blackwhite_lite_sanitize_select'
        )
    );
    $wp_customize->add_control( 'blackwhite_lite_theme_options[layout]', array(
            'label'	            => esc_html__( 'Theme Layout', 'blackwhite-lite' ),
            'section'           => 'blackwhite_lite_section_general',
            'settings'          => 'blackwhite_lite_theme_options[layout]',
            'type'              => 'radio',
            'priority'          => 1,
            'choices'           => array(
                'left-sidebar'      => esc_html__( 'Left Sidebar', 'blackwhite-lite' ),
                'right-sidebar'     => esc_html__( 'Right Sidebar', 'blackwhite-lite' )
            )
        )
    );

    // Add Sticky Header Setting
    $wp_customize->add_setting( 'blackwhite_lite_theme_options[sticky_header_title]', array(
        'default'				=> '',
        'type'					=> 'option',
        'transport'				=> 'refresh',
        'sanitize_callback'     =>'esc_attr'
        )
    );

    $wp_customize->add_control( new blackwhite_lite_Customize_Header_Control(
    $wp_customize, 'blackwhite_lite_theme_options[sticky_header_title]', array(
            'label'			=> esc_html__( 'Sticky Header', 'blackwhite-lite' ),
            'section'		=> 'blackwhite_lite_section_general',
            'settings'		=> 'blackwhite_lite_theme_options[sticky_header_title]',
            'priority'		=> 2
            )
        )
    );

    $wp_customize->add_setting( 'blackwhite_lite_theme_options[sticky_header]', array(
        'default'			=> false,
        'type'				=> 'option',
        'transport'			=> 'refresh',
        'sanitize_callback'	=> 'blackwhite_lite_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 'blackwhite_lite_theme_options[sticky_header]', array(
        'label'				=> esc_html__( 'Enable', 'blackwhite-lite' ),
        'section'			=> 'blackwhite_lite_section_general',
        'settings'			=> 'blackwhite_lite_theme_options[sticky_header]',
        'type'				=> 'checkbox',
        'priority'			=> 3
        )
    );

    // Back to Top Setting
    $wp_customize->add_setting( 'blackwhite_lite_theme_options[back_to_top_function]', array(
            'default'			=> '',
            'type'				=> 'option',
            'transport'			=> 'refresh',
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new blackwhite_lite_Customize_Header_Control(
    $wp_customize, 'blackwhite_lite_theme_options[back_to_top_function]', array(
            'label'			=> esc_html__( 'Back to Top', 'blackwhite-lite' ),
            'section'		=> 'blackwhite_lite_section_general',
            'settings'		=> 'blackwhite_lite_theme_options[back_to_top_function]',
            'priority'		=> 4
            )
        )
    );

    $wp_customize->add_setting( 'blackwhite_lite_theme_options[back_to_top]', array(
        'default'			=> true,
        'type'				=> 'option',
        'transport'			=> 'refresh',
        'sanitize_callback'	=> 'blackwhite_lite_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 'blackwhite_lite_theme_options[back_to_top]', array(
            'label'			=> esc_html__( 'Enable', 'blackwhite-lite' ),
            'section'		=> 'blackwhite_lite_section_general',
            'settings'		=> 'blackwhite_lite_theme_options[back_to_top]',
            'type'			=> 'checkbox',
            'priority'		=> 5
            )
        );
    }

add_action( 'customize_register', 'blackwhite_lite_customize_register_general_options' );