<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'supermag-feature-panel', array(
    'priority'       => 70,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Featured Section Options', 'supermag' ),
    'description'    => __( 'Customize your awesome site feature section ', 'supermag' )
) );

/*
* file for feature slider category
*/
$supermag_customizer_feature_category_file_path = supermag_file_directory('acmethemes/customizer/feature-section/feature-category.php');
require $supermag_customizer_feature_category_file_path;

/*
* file for feature side
*/
$supermag_customizer_feature_side_file_path = supermag_file_directory('acmethemes/customizer/feature-section/feature-side.php');
require $supermag_customizer_feature_side_file_path;

/*
* file for feature section enable
*/
$supermag_customizer_feature_enable_file_path = supermag_file_directory('acmethemes/customizer/feature-section/feature-enable.php');
require $supermag_customizer_feature_enable_file_path;