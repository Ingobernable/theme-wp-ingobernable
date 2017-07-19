<?php
/**
 * Archive Settings
 *
 * Register Home & Archive Settings section, settings and controls for Theme Customizer
 *
 * @package Mekanews_Lite
 */


/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function mekanews_lite_customize_register_archive_options( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'mekanews_lite_section_home_archive', array(
        'title'    => esc_html__( 'Home & Archive Settings', 'mekanews-lite' ),
        'priority' => 20,
		'panel' => 'mekanews_lite_options_panel' 
		)
	);

    // Add Settings Post Layout Style
    $wp_customize->add_setting( 'mekanews_lite_theme_options[layout_post]', array(
        'default'           => 'list',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'mekanews_lite_sanitize_select'
        )
    );
    $wp_customize->add_control( 'mekanews_lite_theme_options[layout_post]', array(
        'label'    => esc_html__( 'Post Layout Style', 'mekanews-lite' ),
        'section'  => 'mekanews_lite_section_home_archive',
        'settings' => 'mekanews_lite_theme_options[layout_post]',
        'type'     => 'radio',
        'priority' => 1,
        'choices'  => array(
            'list' => esc_html__( ' List', 'mekanews-lite' ),
            'grid' => esc_html__( ' Grid', 'mekanews-lite' )
            )
        )
    );
	
	// Add Settings and Controls for Post length on home & archives
	$wp_customize->add_setting( 'mekanews_lite_theme_options[post_content]', array(
        'default'           => 'excerpt',
        'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'mekanews_lite_sanitize_select'
		)
	);

	// Add Setting and Control for Excerpt Length
	$wp_customize->add_setting( 'mekanews_lite_theme_options[excerpt_length]', array(
        'default'           => 30,
		'type'           	=> 'option',
		'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
		)
	);
    $wp_customize->add_control( 'mekanews_lite_theme_options[excerpt_length]', array(
        'label'    => esc_html__( 'Excerpt Length', 'mekanews-lite' ),
        'section'  => 'mekanews_lite_section_home_archive',
        'settings' => 'mekanews_lite_theme_options[excerpt_length]',
        'type'     => 'text',
		'priority' => 3
		)
	);
	

	// Add Setting and Control for Excerpt More Text
	$wp_customize->add_setting( 'mekanews_lite_theme_options[excerpt_more]', array(
        'default'           => '[...]',
		'type'           	=> 'option',
		'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
		)
	);

    $wp_customize->add_control( 'mekanews_lite_theme_options[excerpt_more]', array(
        'label'    => esc_html__( 'Excerpt More Text', 'mekanews-lite' ),
        'section'  => 'mekanews_lite_section_home_archive',
        'settings' => 'mekanews_lite_theme_options[excerpt_more]',
        'type'     => 'text',
		'priority' => 4
		)
	);
	
	
	

    // Add Settings and Controls for Pagination
    $wp_customize->add_setting( 'mekanews_lite_theme_options[paging]', array(
        'default'           => 'pageing-default',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'mekanews_lite_sanitize_select'
        )
    );
    $wp_customize->add_control( 'mekanews_lite_theme_options[paging]', array(
        'label'    => esc_html__( 'Pagination Type', 'mekanews-lite' ),
        'section'  => 'mekanews_lite_section_home_archive',
        'settings' => 'mekanews_lite_theme_options[paging]',
        'type'     => 'radio',
        'priority' => 5,
        'choices'  => array(
            'pageing-default' => esc_html__( ' Default (Older Posts/Newer Posts)', 'mekanews-lite' ),
            'pageing-numberal' => esc_html__( 'Numberal (1 2 3 ..)', 'mekanews-lite' )
            )
        )
    );
	
}
add_action( 'customize_register', 'mekanews_lite_customize_register_archive_options' );