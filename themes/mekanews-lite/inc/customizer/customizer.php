<?php
/**
 * customizer Theme Customizer.
 *
 * @package Mekanews_Lite
 */

// Load Customizer Helper Functions
require( trailingslashit( get_template_directory() ) . '/inc/customizer/functions/custom-controls.php' );
require( trailingslashit( get_template_directory() ) . '/inc/customizer/functions/sanitize-functions.php' );
require( trailingslashit( get_template_directory() ) . '/inc/customizer/functions/callback-functions.php' );

// Load Customizer Section Files
require( trailingslashit( get_template_directory() ) . '/inc/customizer/sections/customizer-general.php' );
require( trailingslashit( get_template_directory() ) . '/inc/customizer/sections/customizer-home-archives.php' );
require( trailingslashit( get_template_directory() ) . '/inc/customizer/sections/customizer-single.php' );
require( trailingslashit( get_template_directory() ) . '/inc/customizer/sections/customizer-slider.php' );
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer/pro/class-customize.php' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mekanews_lite_customize_register( $wp_customize ) {

	// Add Theme Options Panel
	$wp_customize->add_panel( 'mekanews_lite_options_panel', array(
		'priority'       => 200,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'mekanews-lite' ),
		'description'    => '',
	) );
	

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}
add_action( 'customize_register', 'mekanews_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mekanews_lite_customize_preview_js() {
	wp_enqueue_script( 'mekanews_lite_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'customize-preview' ), '20160530', true );
}
add_action( 'customize_preview_init', 'mekanews_lite_customize_preview_js' );

/**
 * Embed JS file for Customizer Controls
 *
 */
function mekanews_lite_customize_controls_js() {
	
	wp_enqueue_script( 'mekanews-lite-customizer-controls', get_template_directory_uri() . '/inc/customizer/js/customizer-controls.js', array(), '20160530', true );
	
	// Localize the script
	wp_localize_script( 'mekanews-lite-customizer-controls', 'mekanews_lite_theme_links', array(
		'title'	=> esc_html__( 'Theme Links', 'mekanews-lite' ),
		'themeURL'	=> esc_url( __( 'https://themecountry.com/mekanews-lite/', 'mekanews-lite' ) ),
		'themeLabel'	=> esc_html__( 'Theme Page', 'mekanews-lite' ),
		'docuURL'	=> esc_url( __( 'https://themecountry.com/docs/mekanews-lite/', 'mekanews-lite' )),
		'docuLabel'	=>  esc_html__( 'Theme Documentation', 'mekanews-lite' ),
		'rateURL'	=> esc_url( 'https://wordpress.org/support/view/theme-reviews/mekanews-lite#postform' ),
		'rateLabel'	=> esc_html__( 'Rate this theme', 'mekanews-lite' ),
		)
	);

}
add_action( 'customize_controls_enqueue_scripts', 'mekanews_lite_customize_controls_js' );


/**
 * Embed CSS styles for the theme options in the Customizer
 *
 */
function mekanews_lite_customize_preview_css() {
	wp_enqueue_style( 'mekanews-lite-customizer-css', get_template_directory_uri() . 'inc/customizer/css/customizer.css', array(), '20160530' );
}
add_action( 'customize_controls_print_styles', 'mekanews_lite_customize_preview_css' );

/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 */
function mekanews_lite_theme_options() {
	// Merge Theme Options Array from Database with Default Options Array
	$theme_options = wp_parse_args( 
		
		// Get saved theme options from WP database
		get_option( 'mekanews_lite_theme_options', array() ), 
		
		// Merge with Default Options if setting was not saved yet
		mekanews_lite_default_options() 
		
	);

	// Return theme options
	return $theme_options;
}

/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function mekanews_lite_default_options() {

	$default_options = array(
		'site_title'						=> true,
		'layout' 							=> 'right-sidebar',
		'sticky_header'						=> false,
		'post_layout_archives'				=> 'left',
		'post_layout_single' 				=> 'header',
		'post_content' 						=> 'excerpt',
		'excerpt_length' 					=> 30,
		'excerpt_more' 						=> ' [...]',
		'meta_date'							=> true,
		'meta_author'						=> true,
		'meta_category'						=> true,
		'meta_tags'							=> false,
		'post_navigation'					=> true,
		'page'								=> 'pageing-default',
		'related_posts'						=> 'cat',
		'paging'							=> 'pageing-default',
		'slider'							=> false,
		'layout_post'						=> 'grid',
	);
	
	return $default_options;
}