<?php
/*adding header options panel*/
$wp_customize->add_panel( 'supermag-header-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Options', 'supermag' ),
    'description'    => __( 'Customize your awesome site header ', 'supermag' )
) );

/*
* file for header logo options
*/
$supermag_customizer_header_logo_file_path = supermag_file_directory('acmethemes/customizer/header-options/header-logo.php');
require $supermag_customizer_header_logo_file_path;

/*
* file for header date options
*/
$supermag_customizer_header_date_file_path = supermag_file_directory('acmethemes/customizer/header-options/header-date.php');
require $supermag_customizer_header_date_file_path;

/*
* file for header news options
*/
$supermag_customizer_header_news_file_path = supermag_file_directory('acmethemes/customizer/header-options/header-news.php');
require $supermag_customizer_header_news_file_path;

/*
* file for header social options
*/
$supermag_customizer_header_social_file_path = supermag_file_directory('acmethemes/customizer/header-options/social-options.php');
require $supermag_customizer_header_social_file_path;

/*
* file for header add options
*/
$supermag_customizer_header_ad_file_path = supermag_file_directory('acmethemes/customizer/header-options/ad-option.php');
require $supermag_customizer_header_ad_file_path;

/*
* file for header menu options
*/
$supermag_customizer_header_menu_option_file_path = supermag_file_directory('acmethemes/customizer/header-options/menu-option.php');
require $supermag_customizer_header_menu_option_file_path;

/*
* file for header menu options
*/
$supermag_customizer_header_menu_option_file_path = supermag_file_directory('acmethemes/customizer/header-options/site-identity-placement.php');
require $supermag_customizer_header_menu_option_file_path;

/*
* file for header media display option
*/
require_once supermag_file_directory('acmethemes/customizer/header-options/header-media-display-options.php');
