<?php
/*adding sections for header options panel*/
$wp_customize->add_section( 'supermag-header-menu', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Menu Options', 'supermag' ),
    'panel'          => 'supermag-header-panel'
) );

/*header show home icon*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-menu-show-home-icon]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-menu-show-home-icon'],
    'sanitize_callback' => 'supermag_sanitize_checkbox',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-menu-show-home-icon]', array(
    'label'		=> __( 'Show Home Icon On Menu', 'supermag' ),
    'section'   => 'supermag-header-menu',
    'settings'  => 'supermag_theme_options[supermag-menu-show-home-icon]',
    'type'	  	=> 'checkbox',
    'priority'  => 40
) );

/*random post*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-enable-random-post]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-enable-random-post'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-enable-random-post]', array(
    'label'		=> __( 'Enable Random Post', 'supermag' ),
    'section'   => 'supermag-header-menu',
    'settings'  => 'supermag_theme_options[supermag-enable-random-post]',
    'type'	  	=> 'checkbox',
    'priority'  => 42
) );

/*header show search*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-menu-show-search]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-menu-show-search'],
    'sanitize_callback' => 'supermag_sanitize_checkbox',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-menu-show-search]', array(
    'label'		=> __( 'Show Search On Menu', 'supermag' ),
    'section'   => 'supermag-header-menu',
    'settings'  => 'supermag_theme_options[supermag-menu-show-search]',
    'type'	  	=> 'checkbox',
    'priority'  => 45
) );

/*header search type*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-menu-search-type]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-menu-search-type'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$choices = supermag_menu_search_type();
$wp_customize->add_control( 'supermag_theme_options[supermag-menu-search-type]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Search Type', 'supermag' ),
    'section'   => 'supermag-header-menu',
    'settings'  => 'supermag_theme_options[supermag-menu-search-type]',
    'type'	  	=> 'select',
    'priority'  => 70
) );

/*sticky menu*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-enable-sticky-menu]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-enable-sticky-menu'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-enable-sticky-menu]', array(
    'label'		=> __( 'Enable Sticky Menu', 'supermag' ),
    'section'   => 'supermag-header-menu',
    'settings'  => 'supermag_theme_options[supermag-enable-sticky-menu]',
    'type'	  	=> 'checkbox',
    'priority'  => 70
) );