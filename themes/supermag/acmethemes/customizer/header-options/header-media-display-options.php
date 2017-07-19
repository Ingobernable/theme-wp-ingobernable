<?php
/*adding sections for header news options*/
$wp_customize->add_section( 'supermag-header-media', array(
	'priority'       => 20,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __( 'Header Media Position', 'supermag' ),
	'description'    => sprintf( __( 'Add Header Media from %1$s here %2$s. Header Media includes Video and Image', 'supermag' ), '<a href="#" class="at-customizer" data-section="header_image">','</a>' ),
	'panel'          => 'supermag-header-panel'
) );

/*header media position options*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-media-position]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-header-media-position'],
	'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_header_media_position();
$wp_customize->add_control( 'supermag_theme_options[supermag-header-media-position]', array(
	'choices'  	=> $choices,
	'label'		=> __( 'Header Media Position', 'supermag' ),
	'section'   => 'supermag-header-media',
	'settings'  => 'supermag_theme_options[supermag-header-media-position]',
	'type'	  	=> 'radio',
	'priority'  => 10
) );

/*header ad img link*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-image-link]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-header-image-link'],
	'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-header-image-link]', array(
	'label'		=> __( 'Header Image Link', 'supermag' ),
	'description'=> __( 'Left empty for no link', 'supermag' ),
	'section'   => 'supermag-header-media',
	'settings'  => 'supermag_theme_options[supermag-header-image-link]',
	'type'	  	=> 'url',
	'priority'  => 20
) );

/*header image in new tab*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-image-link-new-tab]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-header-image-link-new-tab'],
	'sanitize_callback' => 'supermag_sanitize_checkbox',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-header-image-link-new-tab]', array(
	'label'		=> __( 'Check to Open New Tab Header Image Link', 'supermag' ),
	'section'   => 'supermag-header-media',
	'settings'  => 'supermag_theme_options[supermag-header-image-link-new-tab]',
	'type'	  	=> 'checkbox',
	'priority'  => 30
) );

/*adding hr between post and ad*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-media-customizer-link]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-header-media-customizer-link'],
	'sanitize_callback' => 'esc_attr'
) );
$wp_customize->add_control(
	new Supermag_Customize_Message_Control(
		$wp_customize,
		'supermag_theme_options[supermag-header-media-customizer-link]',
		array(
			'section'   => 'header_image',
			'description'    => sprintf( __( ' Header Media Position options available %1$s here %2$s', 'supermag' ), '<hr /><a href="#" class="at-customizer" data-section="supermag-header-media">','</a>' ),
			'settings'  => 'supermag_theme_options[supermag-header-media-customizer-link]',
			'type'	  	=> 'message',
			'priority'  => 74
		)
	)
);