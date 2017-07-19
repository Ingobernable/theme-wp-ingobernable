<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'supermag-archive-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Category/Archive Sidebar Layout', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-archive-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-archive-sidebar-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_sidebar_layout();
$wp_customize->add_control( 'supermag_theme_options[supermag-archive-sidebar-layout]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Category/Archive Sidebar Layout', 'supermag' ),
    'description'   => __( 'Sidebar Layout for listing pages like category, author etc', 'supermag' ),
    'section'       => 'supermag-archive-sidebar-layout',
    'settings'      => 'supermag_theme_options[supermag-archive-sidebar-layout]',
    'type'	  	    => 'select'
) );