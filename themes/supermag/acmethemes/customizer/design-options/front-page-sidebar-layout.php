<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'supermag-front-page-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front/Home Sidebar Layout', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-front-page-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-front-page-sidebar-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_sidebar_layout();
$wp_customize->add_control( 'supermag_theme_options[supermag-front-page-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Front/Home Sidebar Layout', 'supermag' ),
    'section'   => 'supermag-front-page-sidebar-layout',
    'settings'  => 'supermag_theme_options[supermag-front-page-sidebar-layout]',
    'type'	  	=> 'select'
) );