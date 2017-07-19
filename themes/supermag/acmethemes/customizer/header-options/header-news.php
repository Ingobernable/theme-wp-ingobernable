<?php
/*adding sections for header news options*/
$wp_customize->add_section( 'supermag-header-news', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breaking News Options', 'supermag' ),
    'panel'          => 'supermag-header-panel'
) );

/*header news title*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-breaking-news-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-breaking-news-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-breaking-news-title]', array(
    'label'		=> __( 'Breaking News Title', 'supermag' ),
    'section'   => 'supermag-header-news',
    'settings'  => 'supermag_theme_options[supermag-breaking-news-title]',
    'type'	  	=> 'text',
    'priority'  => 10
) );

/*breaking news options*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-breaking-news-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-breaking-news-options'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_breaking_news_options();
$wp_customize->add_control( 'supermag_theme_options[supermag-breaking-news-options]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Breaking News Options', 'supermag' ),
    'section'   => 'supermag-header-news',
    'settings'  => 'supermag_theme_options[supermag-breaking-news-options]',
    'type'	  	=> 'select',
    'priority'  => 20
) );