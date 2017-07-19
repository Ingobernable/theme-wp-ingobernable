<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package Acme Themes
 * @subpackage SuperMag
 * @since 1.5.0
 */

/**
 * Set up the WordPress core custom header feature.
 */
function supermag_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'supermag_custom_header_args', array(
		'default-image'				=> '',
		'header-text'				=> false,
		'width'						=> 1600,
		'height'					=> 460,
		'flex-width'				=> true,
		'flex-height'				=> true,
		'video'						=> true
    ) ) );
}
add_action( 'after_setup_theme', 'supermag_custom_header_setup' );