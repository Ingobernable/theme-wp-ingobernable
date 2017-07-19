<?php
/**
 * Theme Customizer Functions
 *
 */

/*========================== CUSTOMIZER SANITIZE FUNCTIONS ==========================*/

// Sanitize checkboxes
function leeway_sanitize_checkbox( $value ) {

	if ( $value == 1) :
        return 1;
	else:
		return '';
	endif;
}


// Sanitize the layout sidebar value.
function leeway_sanitize_layout( $value ) {

	if ( ! in_array( $value, array( 'left-sidebar', 'right-sidebar' ), true ) ) :
        $value = 'right-sidebar';
	endif;

    return $value;
}


// Sanitize the post length value.
function leeway_sanitize_post_length( $value ) {

	if ( ! in_array( $value, array( 'index', 'excerpt' ), true ) ) :
        $value = 'excerpt';
	endif;

    return $value;
}


// Sanitize the slider animation value.
function leeway_sanitize_slider_animation( $value ) {

	if ( ! in_array( $value, array( 'slide', 'fade' ), true ) ) :
        $value = 'slide';
	endif;

    return $value;
}

?>