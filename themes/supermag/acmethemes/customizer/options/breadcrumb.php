<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'supermag-breadcrumb-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Options', 'supermag' ),
    'panel'          => 'supermag-options'
) );

/*show breadcrumb*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-show-breadcrumb]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-show-breadcrumb'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );

$wp_customize->add_control( 'supermag_theme_options[supermag-show-breadcrumb]', array(
    'label'		=> __( 'Enable Breadcrumb', 'supermag' ),
    'section'   => 'supermag-breadcrumb-options',
    'settings'  => 'supermag_theme_options[supermag-show-breadcrumb]',
    'type'	  	=> 'checkbox',
    'priority'  => 7
) );