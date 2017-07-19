<?php
/**
 * customizer Theme Customizer.
 *
 * @package BlackWhite
 */

// Load Customizer Helper Functions
require( get_template_directory() . '/inc/customizer/functions/custom-controls.php' );
require( get_template_directory() . '/inc/customizer/functions/sanitize-functions.php' );
require( get_template_directory() . '/inc/customizer/functions/callback-functions.php' );

// Load Customizer Section Files
require( get_template_directory() . '/inc/customizer/sections/customizer-general.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-home-archives.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-single.php' );

require_once( trailingslashit( get_template_directory() ) . '/inc/customizer/pro/class-customize.php' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blackwhite_lite_customize_register( $wp_customize ) {

	// Add Theme Options Panel
	$wp_customize->add_panel( 'blackwhite_lite_options_panel', array(
		'priority'       => 200,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'blackwhite-lite' ),
		'description'    => '',
	) );
	

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'blackwhite_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blackwhite_lite_customize_preview_js() {
	wp_enqueue_script( 'blackwhite_lite_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'customize-preview' ), '20160530', true );
}
add_action( 'customize_preview_init', 'blackwhite_lite_customize_preview_js' );

/**
 * Embed JS file for Customizer Controls
 *
 */
function blackwhite_lite_customize_controls_js() {
	
	wp_enqueue_script( 'blackwhite-customizer-controls', get_template_directory_uri() . '/inc/customizer/js/customizer-controls.js', array(), '20160530', true );
	
	// Localize the script
	wp_localize_script( 'blackwhite-customizer-controls', 'blackwhite_lite_theme_links', array(
			'title'			=> esc_html__( 'Theme Links', 'blackwhite-lite' ),
			'themeURL'		=> esc_url( __( 'https://themecountry.com/themes/blackwhite/', 'blackwhite-lite' ) . '?utm_source=customizer&utm_medium=textlink&utm_campaign=blackwhite&utm_content=theme-page' ),
			'themeLabel'	=> esc_html__( 'Theme Page', 'blackwhite-lite' ),
			'docuURL'		=> esc_url( __( 'https://themecountry.com/docs/blackwhite-documentation/', 'blackwhite-lite' ) . '?utm_source=customizer&utm_medium=textlink&utm_campaign=blackwhite&utm_content=documentation' ),
			'docuLabel'		=> esc_html__( 'Theme Documentation', 'blackwhite-lite' ),
			'rateURL'		=> esc_url( 'http://wordpress.org/support/view/theme-reviews/blackwhite?filter=5' ),
			'rateLabel'		=> esc_html__( 'Rate this theme', 'blackwhite-lite' ),
		)
	);

}
add_action( 'customize_controls_enqueue_scripts', 'blackwhite_lite_customize_controls_js' );


/**
 * Embed CSS styles for the theme options in the Customizer
 *
 */
function blackwhite_lite_customize_preview_css() {
	wp_enqueue_style( 'blackwhite-customizer-css', get_template_directory_uri() . '/inc/customizer/css/customizer.css', array(), '20160530' );
}
add_action( 'customize_controls_print_styles', 'blackwhite_lite_customize_preview_css' );