<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'supermag-options', array(
    'priority'       => 210,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Theme Options', 'supermag' ),
    'description'    => __( 'Customize your awesome site with theme options ', 'supermag' )
) );

/*
* file for front page
*/
$supermag_customizer_options_front_page_file_path = supermag_file_directory('acmethemes/customizer/options/front-page.php');
require $supermag_customizer_options_front_page_file_path;

/*
* file for header breadcrumb options
*/
$supermag_customizer_options_breadcrumb_file_path = supermag_file_directory('acmethemes/customizer/options/breadcrumb.php');
require $supermag_customizer_options_breadcrumb_file_path;

/*
* file for header search options
*/
$supermag_customizer_options_search_file_path = supermag_file_directory('acmethemes/customizer/options/search.php');
require $supermag_customizer_options_search_file_path;