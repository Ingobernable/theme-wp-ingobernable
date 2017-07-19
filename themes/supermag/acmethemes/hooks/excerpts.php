<?php
/**
 * Excerpt length 90 return
 *
 * @since SuperMag 1.1.0
 *
 * @param null
 * @return null
 *
 */
if ( !function_exists('supermag_alter_excerpt') ) :
    function supermag_alter_excerpt( $excerpt_length ){
		if( is_admin() ){
			return $excerpt_length;
		}
        return 90;
    }
endif;

add_filter('excerpt_length', 'supermag_alter_excerpt');

/**
 * Add ... for more view
 *
 * @since SuperMag 1.1.0
 *
 * @param null
 * @return null
 *
 */

if ( !function_exists('supermag_excerpt_more') ) :
    function supermag_excerpt_more($more) {
	    if( is_admin() ){
		    return $more;
	    }
        return '&hellip;';
    }
endif;
add_filter('excerpt_more', 'supermag_excerpt_more');