<?php
/**
 * Register Post Slider section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'leeway_customize_register_slider_settings' );

function leeway_customize_register_slider_settings( $wp_customize ) {

	// Add Sections for Slider Settings
	$wp_customize->add_section( 'leeway_section_slider', array(
        'title'    => esc_html__( 'Post Slider', 'leeway' ),
        'priority' => 50,
		'panel' => 'leeway_options_panel' 
		)
	);

	// Add settings and controls for Post Slider
	$wp_customize->add_setting( 'leeway_theme_options[slider_active_header]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Leeway_Customize_Header_Control(
        $wp_customize, 'leeway_control_slider_activated', array(
            'label' => esc_html__( 'Activate Post Slider', 'leeway' ),
            'section' => 'leeway_section_slider',
            'settings' => 'leeway_theme_options[slider_active_header]',
            'priority' => 1
            )
        )
    );
	$wp_customize->add_setting( 'leeway_theme_options[slider_active_magazine]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'leeway_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'leeway_control_slider_active_magazine', array(
        'label'    => esc_html__( 'Show Slider on Magazine Homepage', 'leeway' ),
        'section'  => 'leeway_section_slider',
        'settings' => 'leeway_theme_options[slider_active_magazine]',
        'type'     => 'checkbox',
		'priority' => 2
		)
	);
	$wp_customize->add_setting( 'leeway_theme_options[slider_active_blog]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'leeway_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'leeway_control_slider_active_blog', array(
        'label'    => esc_html__( 'Show Slider on posts page', 'leeway' ),
        'section'  => 'leeway_section_slider',
        'settings' => 'leeway_theme_options[slider_active_blog]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);
	
	// Select Featured Posts
	$wp_customize->add_setting( 'leeway_theme_options[featured_posts_header]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Leeway_Customize_Header_Control(
        $wp_customize, 'leeway_control_featured_posts_header', array(
            'label' => esc_html__( 'Select Featured Posts', 'leeway' ),
            'section' => 'leeway_section_slider',
            'settings' => 'leeway_theme_options[featured_posts_header]',
            'priority' => 4,
			'active_callback' => 'leeway_slider_activated_callback'
            )
        )
    );
	$wp_customize->add_setting( 'leeway_theme_options[featured_posts_description]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Leeway_Customize_Description_Control(
        $wp_customize, 'leeway_control_featured_posts_description', array(
			'label'    => esc_html__( 'The slideshow displays all your featured posts. You can easily feature posts by a tag of your choice.', 'leeway' ),
            'section' => 'leeway_section_slider',
            'settings' => 'leeway_theme_options[featured_posts_description]',
            'priority' => 5,
			'active_callback' => 'leeway_slider_activated_callback'
            )
        )
    );

	// Add Slider Animation Setting
	$wp_customize->add_setting( 'leeway_theme_options[slider_animation]', array(
        'default'           => 'slide',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'leeway_sanitize_slider_animation'
		)
	);
    $wp_customize->add_control( 'leeway_control_slider_animation', array(
        'label'    => esc_html__( 'Slider Animation', 'leeway' ),
        'section'  => 'leeway_section_slider',
        'settings' => 'leeway_theme_options[slider_animation]',
        'type'     => 'radio',
		'priority' => 9,
		'active_callback' => 'leeway_slider_activated_callback',
        'choices'  => array(
            'slide' => esc_html__( 'Slide Effect', 'leeway' ),
            'fade' => esc_html__( 'Fade Effect', 'leeway' )
			)
		)
	);
	
	// Add Setting and Control for Slider Speed
	$wp_customize->add_setting( 'leeway_theme_options[slider_speed]', array(
        'default'           => 7000,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
		)
	);
    $wp_customize->add_control( 'leeway_theme_options[slider_speed]', array(
        'label'    => esc_html__( 'Slider Speed (in ms)', 'leeway' ),
        'section'  => 'leeway_section_slider',
        'settings' => 'leeway_theme_options[slider_speed]',
        'type'     => 'number',
		'active_callback' => 'leeway_slider_activated_callback',
		'priority' => 10,
		'input_attrs' => array(
			'min'   => 1000,
			'step'  => 100,
		),
		)
	);
	
}