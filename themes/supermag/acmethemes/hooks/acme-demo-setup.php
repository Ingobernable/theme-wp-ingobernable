<?php
if( !function_exists( 'supermag_demo_nav_data') ){
    function supermag_demo_nav_data(){
        $demo_navs = array(
            'primary'  => 'Primary Menu'
        );
        return $demo_navs;
    }
}
add_filter('acme_demo_setup_nav_data','supermag_demo_nav_data');


if( !function_exists( 'supermag_update_image_size') ){
	function supermag_update_image_size(){
		/*Thumbnail Size*/
		update_option( 'thumbnail_size_w', 500 );
		update_option( 'thumbnail_size_h', 280 );
		update_option( 'thumbnail_crop', 1 );

		/*Medium Image Size*/
		update_option( 'medium_size_w', 660 );
		update_option( 'medium_size_h', 365 );

		/*Large Image Size*/
		update_option( 'large_size_w', 840 );
		update_option( 'large_size_h', 840 );
	}
}

add_action( 'acme_demo_setup_before_import', 'supermag_update_image_size' );
add_action( 'wp_ajax_acme_demo_setup_before_import', 'supermag_update_image_size' );