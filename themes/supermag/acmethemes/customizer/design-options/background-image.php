<?php
/*Adding default background image section in new panel */
$wp_customize->add_section( 'background_image', array(
    'priority'       => 50,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Background Image', 'supermag' ),
    'panel'  => 'supermag-design-panel'
) );