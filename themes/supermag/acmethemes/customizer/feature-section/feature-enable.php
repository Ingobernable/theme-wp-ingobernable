<?php
/*adding sections for enabling feature section in front page*/
$wp_customize->add_section( 'supermag-enable-feature', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Enable Feature Section', 'supermag' ),
    'panel'          => 'supermag-feature-panel'
) );

/*enable feature section*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-enable-feature]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-enable-feature'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );

$wp_customize->add_control( 'supermag_theme_options[supermag-enable-feature]', array(
    'label'		=> __( 'Enable Feature Section', 'supermag' ),
    'description'	=> __( 'Feature section will display on front/home page. Feature Section includes Category Slider and Slider Right Section. Please select "A static page" for displaying feature section', 'supermag' ),
    'section'   => 'supermag-enable-feature',
    'settings'  => 'supermag_theme_options[supermag-enable-feature]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );