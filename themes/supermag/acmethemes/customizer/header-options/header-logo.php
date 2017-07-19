<?php
global $wp_version;
// Return if wp version less than 4.5
if ( version_compare( $wp_version, '4.5', '<' ) ) {
    /*header logo*/
    $wp_customize->add_setting( 'supermag_theme_options[supermag-header-logo]', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['supermag-header-logo'],
        'sanitize_callback' => 'supermag_sanitize_image',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'supermag_theme_options[supermag-header-logo]',
            array(
                'label'		=> __( 'Logo', 'supermag' ),
                'section'   => 'title_tagline',
                'settings'  => 'supermag_theme_options[supermag-header-logo]',
                'type'	  	=> 'image',
                'priority'  => 10
            )
        )
    );
}

/*header logo/text display options*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-id-display-opt]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-header-id-display-opt'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_header_id_display_opt();
$wp_customize->add_control( 'supermag_theme_options[supermag-header-id-display-opt]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Logo/Site Title-Tagline Display Options', 'supermag' ),
    'section'   => 'title_tagline',
    'settings'  => 'supermag_theme_options[supermag-header-id-display-opt]',
    'type'	  	=> 'radio',
    'priority'  => 30
) );