<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'supermag-feature-category', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Category Slider Selection', 'supermag' ),
    'panel'          => 'supermag-feature-panel'
) );

/* feature cat selection */
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-cat]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-cat'],
    'sanitize_callback' => 'supermag_sanitize_number'
) );

$wp_customize->add_control(
    new Supermag_Customize_Category_Dropdown_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-cat]',
        array(
            'label'		=> __( 'Select Category For Slider', 'supermag' ),
            'section'   => 'supermag-feature-category',
            'settings'  => 'supermag_theme_options[supermag-feature-cat]',
            'type'	  	=> 'category_dropdown',
            'priority'  => 5,
        )
    )
);

/*adding message for post*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-image-size-message]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-image-size-message'],
    'sanitize_callback' => 'esc_attr'
) );
$wp_customize->add_control(
    new Supermag_Customize_Message_Control(
        $wp_customize,
        'supermag_theme_options[supermag-image-size-message]',
        array(
            'section'   => 'supermag-feature-category',
            'description'   => sprintf( __( 'Note : If problem in image size, please follow the this %1$s documentation %2$s', 'supermag' ), '<a href="http://www.doc.acmethemes.com/supermag/" target="_blank">','</a>' ),
            'settings'  => 'supermag_theme_options[supermag-image-size-message]',
            'type'	  	=> 'message',
            'priority'  => 110,
        )
    )
);