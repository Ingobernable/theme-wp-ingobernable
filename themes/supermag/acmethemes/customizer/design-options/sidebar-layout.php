<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'supermag-design-sidebar-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Sidebar Layout', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-sidebar-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_sidebar_layout();
$wp_customize->add_control( 'supermag_theme_options[supermag-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Sidebar Layout', 'supermag' ),
    'section'   => 'supermag-design-sidebar-layout-option',
    'settings'  => 'supermag_theme_options[supermag-sidebar-layout]',
    'type'	  	=> 'select'
) );