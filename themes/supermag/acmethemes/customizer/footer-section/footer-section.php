<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'supermag-footer-option', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Option', 'supermag' )
) );

/*copyright*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-footer-copyright]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-footer-copyright'],
    'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-footer-copyright]', array(
    'label'		=> __( 'Copyright Text', 'supermag' ),
    'section'   => 'supermag-footer-option',
    'settings'  => 'supermag_theme_options[supermag-footer-copyright]',
    'type'	  	=> 'text',
    'priority'  => 2
) );