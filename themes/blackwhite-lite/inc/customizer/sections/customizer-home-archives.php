<?php
/**
 * Archive Settings
 *
 * Register Home & Archive Settings section, settings and controls for Theme Customizer
 *
 * @package BlackWhite
 */

function blackwhite_lite_customize_register_archive_options( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'blackwhite_lite_section_home_archive', array(
        'title'       => esc_html__( 'Archive Settings', 'blackwhite-lite' ),
		'panel'       => 'blackwhite_lite_options_panel',
        'priority'    => 20
		)
	);

	// Add Settings and Controls for Post length on home & archives
	$wp_customize->add_setting( 'blackwhite_lite_theme_options[post_content]', array(
        'default'           => 'excerpt',
        'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'blackwhite_lite_sanitize_select'
		)
	);
    $wp_customize->add_control( 'blackwhite_lite_theme_options[post_content]', array(
        'label'         => esc_html__( 'Post length on home & archives', 'blackwhite-lite' ),
        'section'       => 'blackwhite_lite_section_home_archive',
        'settings'      => 'blackwhite_lite_theme_options[post_content]',
        'type'          => 'radio',
		'priority'      => 3,
        'choices'       => array(
                'index'     => esc_html__( 'Show full posts', 'blackwhite-lite' ),
                'excerpt'   => esc_html__( 'Show post excerpts', 'blackwhite-lite' )
			)
		)
	);
	
	// Excerpt Length
	$wp_customize->add_setting( 'blackwhite_lite_theme_options[excerpt_length]', array(
        'default'           => 20,
		'type'           	=> 'option',
		'transport'         => 'refresh',
        'sanitize_callback' => 'absint'
		)
	);

    $wp_customize->add_control( 'blackwhite_lite_theme_options[excerpt_length]', array(
        'label'         => esc_html__( 'Excerpt Length', 'blackwhite-lite' ),
        'section'       => 'blackwhite_lite_section_home_archive',
        'settings'      => 'blackwhite_lite_theme_options[excerpt_length]',
        'type'          => 'text',
		'active_callback' => 'blackwhite_lite_control_post_content_callback',
		'priority'        => 3
		)
	);

	// Add Setting and Control for Excerpt More Text
	$wp_customize->add_setting( 'blackwhite_lite_theme_options[excerpt_more]', array(
        'default'           => ' [...]',
		'type'           	=> 'option',
		'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
		)
	);

    $wp_customize->add_control( 'blackwhite_lite_theme_options[excerpt_more]', array(
        'label'         => esc_html__( 'Excerpt More Text', 'blackwhite-lite' ),
        'section'       => 'blackwhite_lite_section_home_archive',
        'settings'      => 'blackwhite_lite_theme_options[excerpt_more]',
        'type'          => 'text',
        'active_callback' => 'blackwhite_lite_control_post_content_callback',
		'priority'        => 3
		)
	);

    // Add Settings and Controls for Pagination
    $wp_customize->add_setting( 'blackwhite_lite_theme_options[paging]', array(
        'default'           => 'paging-default',
        'type'              => 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'blackwhite_lite_sanitize_select'
        )
    );
    $wp_customize->add_control( 'blackwhite_lite_theme_options[paging]', array(
        'label'    => esc_html__( 'Pagination Type', 'blackwhite-lite' ),
        'section'  => 'blackwhite_lite_section_home_archive',
        'settings' => 'blackwhite_lite_theme_options[paging]',
        'type'     => 'radio',
        'priority' => 4,
        'choices'  => array(
                'paging-default'    => esc_html__( 'Default (Older Posts/Newer Posts)', 'blackwhite-lite' ),
                'paging-numberal'   => esc_html__( 'Numberal (1 2 3 ..)', 'blackwhite-lite' )
            )
        )
    );

}
add_action( 'customize_register', 'blackwhite_lite_customize_register_archive_options' );