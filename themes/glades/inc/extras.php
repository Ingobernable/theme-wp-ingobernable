<?php
/**
 * Custom functions that are not template related
 *
 * @package Glades
 */


// Add Default Menu Fallback Function
function glades_default_menu() {
	echo '<ul id="mainnav-menu" class="main-navigation-menu menu">' . wp_list_pages( 'title_li=&echo=0' ) . '</ul>';
}


/**
 * Hide Elements with CSS.
 *
 * @return void
 */
function glades_hide_elements() {

	// Get theme options from database.
	$theme_options = glades_theme_options();

	$elements = array();

	// Hide Site Title?
	if ( false == $theme_options['site_title'] ) {
		$elements[] = '.site-title';
	}

	// Hide Site Description?
	if ( false == $theme_options['header_tagline'] ) {
		$elements[] = '.site-description';
	}

	// Return early if no elements are hidden.
	if ( empty( $elements ) ) {
		return;
	}

	// Create CSS.
	$classes = implode( ', ', $elements );
	$custom_css = $classes . ' {
	position: absolute;
	clip: rect(1px, 1px, 1px, 1px);
}';

	// Add Custom CSS.
	wp_add_inline_style( 'glades-stylesheet', $custom_css );
}
add_filter( 'wp_enqueue_scripts', 'glades_hide_elements', 11 );


// Get Featured Posts
function glades_get_featured_content() {
	return apply_filters( 'glades_get_featured_content', false );
}


// Check if featured posts exists
function glades_has_featured_content() {
	return ! is_paged() && (bool) glades_get_featured_content();
}


// Change Excerpt Length
add_filter( 'excerpt_length', 'glades_excerpt_length' );
function glades_excerpt_length( $length ) {
	return 60;
}

// Category Posts Large Excerpt Length
function glades_category_posts_large_excerpt( $length ) {
	return 32;
}

// Category Posts Medium Excerpt Length
function glades_category_posts_medium_excerpt( $length ) {
	return 20;
}

// Category Posts Small Excerpt Length
function glades_category_posts_small_excerpt( $length ) {
	return 8;
}
