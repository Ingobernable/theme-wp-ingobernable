<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'supermag-search', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Search', 'supermag' ), 
    'panel'          => 'supermag-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-search-placholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-search-placholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-search-placholder]', array(
    'label'		=> __( 'Search Placeholder', 'supermag' ),
    'section'   => 'supermag-search',
    'settings'  => 'supermag_theme_options[supermag-search-placholder]',
    'type'	  	=> 'text',
    'priority'  => 10
) );