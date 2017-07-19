<?php
/*adding sections for Single post options*/
$wp_customize->add_section( 'supermag-single-post', array(
    'priority'       => 90,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Single Post Options', 'supermag' )
) );

/*single page layout*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-single-post-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-single-post-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_blog_layout();
$wp_customize->add_control( 'supermag_theme_options[supermag-single-post-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Single Post Layout', 'supermag' ),
    'description'=> __( 'Image display options', 'supermag' ),
    'section'   => 'supermag-single-post',
    'settings'  => 'supermag_theme_options[supermag-single-post-layout]',
    'type'	  	=> 'select',
    'priority'  => 10
) );

/*single image layout*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-single-image-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-single-image-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_get_image_sizes_options();
$wp_customize->add_control( 'supermag_theme_options[supermag-single-image-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Image Layout Options', 'supermag' ),
    'section'   => 'supermag-single-post',
    'settings'  => 'supermag_theme_options[supermag-single-image-layout]',
    'type'	  	=> 'select',
    'priority'  => 20
) );

/*Entry Footer/Category Display Options*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-single-category-display-options]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-single-category-display-options'],
	'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_blog_archive_category_display_options();
$wp_customize->add_control( 'supermag_theme_options[supermag-single-category-display-options]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Entry Footer/Category Display Options', 'supermag' ),
	'section'   => 'supermag-single-post',
	'settings'  => 'supermag_theme_options[supermag-single-category-display-options]',
	'type'	  	=> 'select',
	'priority'  => 25
) );

/*show rlated posts*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-show-related]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-show-related'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-show-related]', array(
    'label'		=> __( 'Show Related Posts In Single Post', 'supermag' ),
    'section'   => 'supermag-single-post',
    'settings'  => 'supermag_theme_options[supermag-show-related]',
    'type'	  	=> 'checkbox',
    'priority'  => 30
) );

/*Related title*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-related-title]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-related-title'],
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-related-title]', array(
	'label'		=> __( 'Related Posts title', 'supermag' ),
	'section'   => 'supermag-single-post',
	'settings'  => 'supermag_theme_options[supermag-related-title]',
	'type'	  	=> 'text',
	'priority'  => 40
) );

/*related post by tag or category*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-related-post-display-from]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-related-post-display-from'],
	'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_related_post_display_from();
$wp_customize->add_control( 'supermag_theme_options[supermag-related-post-display-from]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Related Post Display From Options', 'supermag' ),
	'section'   => 'supermag-single-post',
	'settings'  => 'supermag_theme_options[supermag-related-post-display-from]',
	'type'	  	=> 'select',
	'priority'  => 50
) );