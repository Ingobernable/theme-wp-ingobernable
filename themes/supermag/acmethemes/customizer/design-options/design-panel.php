<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'supermag-design-panel', array(
    'priority'       => 90,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Layout/Design Option', 'supermag' )
) );

/*
* file for default layout
*/
$supermag_customizer_default_layout_file_path = supermag_file_directory('acmethemes/customizer/design-options/default-layout.php');
require $supermag_customizer_default_layout_file_path;

/*
* file for sticky sidebar
*/
$supermag_customizer_sticky_sidebar_file_path = supermag_file_directory('acmethemes/customizer/design-options/sticky-sidebar.php');
require $supermag_customizer_sticky_sidebar_file_path;

/*
* file for sidebar layout
*/
$supermag_customizer_sidebar_layout_file_path = supermag_file_directory('acmethemes/customizer/design-options/sidebar-layout.php');
require $supermag_customizer_sidebar_layout_file_path;

/*
* file for front page sidebar layout options
*/
$supermag_customizer_front_page_sidebar_layout_file_path = supermag_file_directory('acmethemes/customizer/design-options/front-page-sidebar-layout.php');
require $supermag_customizer_front_page_sidebar_layout_file_path;

/*
* file for front archive sidebar layout options
*/
require supermag_file_directory('acmethemes/customizer/design-options/archive-sidebar-layout.php');

/*
* file for blog layout
*/
$supermag_customizer_blog_layout_file_path = supermag_file_directory('acmethemes/customizer/design-options/blog-layout.php');
require $supermag_customizer_blog_layout_file_path;

/*
* file for color options
*/
$supermag_customizer_colors_options_file_path = supermag_file_directory('acmethemes/customizer/design-options/colors-options.php');
require $supermag_customizer_colors_options_file_path;

/*
* Category color options
*/
require supermag_file_directory('acmethemes/customizer/design-options/colors-cats.php');

/*
* file for background image layout
*/
$supermag_customizer_background_image_file_path = supermag_file_directory('acmethemes/customizer/design-options/background-image.php');
require $supermag_customizer_background_image_file_path;

/*
* file for custom css
*/
$supermag_customizer_custom_css_file_path = supermag_file_directory('acmethemes/customizer/design-options/custom-css.php');
require $supermag_customizer_custom_css_file_path;
