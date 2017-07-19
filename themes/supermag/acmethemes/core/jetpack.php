<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Acme Themes
 * @subpackage SuperMag
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
if ( ! function_exists( 'supermag_jetpack_setup' ) ) :
	function supermag_jetpack_setup() {
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'supermag_infinite_scroll_render',
			'footer'    => 'page',
		) );
	} // end function supermag_jetpack_setup
endif;
add_action( 'after_setup_theme', 'supermag_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
if ( ! function_exists( 'supermag_infinite_scroll_render' ) ) :
	function supermag_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		}
	} // end function supermag_infinite_scroll_render
endif;
