<?php
/*adding sections for custom css options */
$wp_customize->add_section( 'supermag-design-custom-css-option', array(
    'priority'       => 60,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Custom CSS', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );

/*custom-css*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-custom-css]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-custom-css'],
    'sanitize_callback'    => 'wp_strip_all_tags'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-custom-css]', array(
    'label'		=> __( 'Custom CSS', 'supermag' ),
    'section'   => 'supermag-design-custom-css-option',
    'settings'  => 'supermag_theme_options[supermag-custom-css]',
    'type'	  	=> 'textarea',
    'priority'  => 2
) );