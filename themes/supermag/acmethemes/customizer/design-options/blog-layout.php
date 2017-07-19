<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'supermag-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog/Archive Layout', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-blog-archive-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_blog_layout();
$wp_customize->add_control( 'supermag_theme_options[supermag-blog-archive-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Blog/Archive Layout', 'supermag' ),
    'description'=> __( 'Image display options', 'supermag' ),
    'section'   => 'supermag-design-blog-layout-option',
    'settings'  => 'supermag_theme_options[supermag-blog-archive-layout]',
    'type'	  	=> 'select'
) );

/*blog image size*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-blog-archive-image-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-blog-archive-image-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_get_image_sizes_options();
$wp_customize->add_control( 'supermag_theme_options[supermag-blog-archive-image-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Image Layout Options', 'supermag' ),
    'section'   => 'supermag-design-blog-layout-option',
    'settings'  => 'supermag_theme_options[supermag-blog-archive-image-layout]',
    'type'	  	=> 'select',
) );

/*enable feature section*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-disable-image-zoom]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-disable-image-zoom'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );

$wp_customize->add_control( 'supermag_theme_options[supermag-disable-image-zoom]', array(
    'label'		=> __( 'Disable Zoom Image on Hover', 'supermag' ),
    'section'   => 'supermag-design-blog-layout-option',
    'settings'  => 'supermag_theme_options[supermag-disable-image-zoom]',
    'type'	  	=> 'checkbox',
) );

/*Entry Footer/Category Display Options*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-blog-archive-category-display-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-blog-archive-category-display-options'],
	'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_blog_archive_category_display_options();
$wp_customize->add_control( 'supermag_theme_options[supermag-blog-archive-category-display-options]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Entry Footer/Category Display Options', 'supermag' ),
	'section'   => 'supermag-design-blog-layout-option',
	'settings'  => 'supermag_theme_options[supermag-blog-archive-category-display-options]',
	'type'	  	=> 'select',
) );

/*Read More Text*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-blog-archive-more-text]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-blog-archive-more-text'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-blog-archive-more-text]', array(
	'label'		=> __( 'Read More Text', 'supermag' ),
	'section'   => 'supermag-design-blog-layout-option',
	'settings'  => 'supermag_theme_options[supermag-blog-archive-more-text]',
	'type'	  	=> 'text'
) );