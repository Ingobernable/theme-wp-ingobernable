<?php
/*active callback function for box shadow*/
if ( !function_exists('supermag_active_callback_box_layout') ) :
	function supermag_active_callback_box_layout() {
		$supermag_customizer_all_values = supermag_get_theme_options();
		if ( 'boxed' == $supermag_customizer_all_values['supermag-default-layout'] ) {
			return true;
		}
		return false;
	}
endif;

/*adding sections for default layout options*/
$wp_customize->add_section( 'supermag-design-default-layout-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Layout', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );

/*global default layout*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-default-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-default-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );

$choices = supermag_default_layout();
$wp_customize->add_control( 'supermag_theme_options[supermag-default-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Layout', 'supermag' ),
    'description'=> __( 'Boxed will add box-shadow', 'supermag' ),
    'section'   => 'supermag-design-default-layout-option',
    'settings'  => 'supermag_theme_options[supermag-default-layout]',
    'type'	  	=> 'select'
) );

/*box shadow enable disable*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-enable-box-shadow]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-enable-box-shadow'],
	'sanitize_callback' => 'supermag_sanitize_checkbox'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-enable-box-shadow]', array(
	'label'		=> __( 'Enable Box Shadow', 'supermag' ),
	'section'   => 'supermag-design-default-layout-option',
	'settings'  => 'supermag_theme_options[supermag-enable-box-shadow]',
	'type'	  	=> 'checkbox',
	'active_callback'   => 'supermag_active_callback_box_layout'
) );