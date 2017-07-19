<?php
/*adding sections for menu */
$wp_customize->add_section( 'supermag-site-identity-placement', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Placement', 'supermag' ),
    'panel'          => 'supermag-header-panel',

) );

/*header menu type*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-logo-ads-display-position]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-header-logo-ads-display-position'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_header_logo_menu_display_position();
$wp_customize->add_control( 'supermag_theme_options[supermag-header-logo-ads-display-position]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Logo and Advertisement Position', 'supermag' ),
    'section'   => 'supermag-site-identity-placement',
    'settings'  => 'supermag_theme_options[supermag-header-logo-ads-display-position]',
    'type'	  	=> 'select',
    'priority'  => 15
) );
