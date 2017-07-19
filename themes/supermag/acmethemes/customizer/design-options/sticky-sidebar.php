<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'supermag-design-sidebar-sticky-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Sticky Sidebar Option', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );

/*sticky sidebar enable disable*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-enable-sticky-sidebar]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-enable-sticky-sidebar'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-enable-sticky-sidebar]', array(
    'label'		=> __( 'Enable Sticky Sidebar Loader', 'supermag' ),
    'section'   => 'supermag-design-sidebar-sticky-option',
    'settings'  => 'supermag_theme_options[supermag-enable-sticky-sidebar]',
    'type'	  	=> 'checkbox',
    'priority'  => 30
) );