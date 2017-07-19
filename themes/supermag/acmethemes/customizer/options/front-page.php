<?php
/*adding sections for front page */
$wp_customize->add_section( 'supermag-front-page-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front Page Options', 'supermag' ),
    'panel'          => 'supermag-options'
) );

/*Show Hide Front Page Content*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-hide-front-page-content]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-hide-front-page-content'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );

$wp_customize->add_control( 'supermag_theme_options[supermag-hide-front-page-content]', array(
    'label'		=> __( 'Hide Blog Posts or Static Page on Front Page', 'supermag' ),
    'section'   => 'supermag-front-page-options',
    'settings'  => 'supermag_theme_options[supermag-hide-front-page-content]',
    'type'	  	=> 'checkbox',
    'priority'  => 1
) );