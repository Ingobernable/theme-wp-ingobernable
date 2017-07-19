<?php
/**
 * Header logo/text display options alternative
 *
 * @since SuperMag 1.0.2
 *
 * @param null
 * @return array $supermag_header_id_display_opt
 *
 */
if ( !function_exists('supermag_breaking_news_options') ) :
    function supermag_breaking_news_options() {
        $supermag_breaking_news_options =  array(
            'disable' => __( 'Disable', 'supermag' ),
            'slide' => __( 'Slide', 'supermag' ),
            'ticker' =>  __( 'Ticker', 'supermag' )
        );
        return apply_filters( 'supermag_breaking_news_options', $supermag_breaking_news_options );
    }
endif;

/**
 * Header logo/text display options alternative
 *
 * @since SuperMag 1.0.2
 *
 * @param null
 * @return array $supermag_header_id_display_opt
 *
 */
if ( !function_exists('supermag_header_id_display_opt') ) :
    function supermag_header_id_display_opt() {
        $supermag_header_id_display_opt =  array(
            'logo-only' => __( 'Logo Only ( First Select Logo Above )', 'supermag' ),
            'title-only' => __( 'Site Title Only', 'supermag' ),
            'title-and-tagline' =>  __( 'Site Title and Tagline', 'supermag' ),
            'disable' => __( 'Disable', 'supermag' )
        );
        return apply_filters( 'supermag_header_id_display_opt', $supermag_header_id_display_opt );
    }
endif;

/**
 * Header Ads display options
 *
 * @since SuperMag 1.0.3
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('supermag_header_ads_display_options') ) :
    function supermag_header_ads_display_options() {
        $supermag_related_posts_display_options =  array(
            'hide'  => __( 'Hide', 'supermag' ),
            'image' => __( 'Ads Image', 'supermag' )
        );
        return apply_filters( 'supermag_related_posts_display_options', $supermag_related_posts_display_options );
    }
endif;

/**
 * Header Site identity and ads display options
 *
 * @since SuperMag 1.0.5
 *
 * @param null
 * @return array $supermag_header_logo_menu_display_position
 *
 */
if ( !function_exists('supermag_header_logo_menu_display_position') ) :
    function supermag_header_logo_menu_display_position() {
        $supermag_header_logo_menu_display_position =  array(
            'left-logo-right-ads' => __( 'Left Logo and Right Ads', 'supermag' ),
            'right-logo-left-ads' => __( 'Right Logo and Left Ads', 'supermag' ),
            'center-logo-below-ads' => __( 'Center Logo and Below Ads', 'supermag' )
        );
        return apply_filters( 'supermag_header_logo_menu_display_position', $supermag_header_logo_menu_display_position );
    }
endif;

/**
 * Header Display Options
 *
 * @since SuperMag 1.5.0
 *
 * @param null
 * @return array $supermag_header_date_format
 *
 */
if ( !function_exists('supermag_header_date_format') ) :
	function supermag_header_date_format() {
		$supermag_header_date_format =  array(
			'default' => __( 'Default', 'supermag' ),
			'wp-date-format' => __( 'From WordPress Date Setting', 'supermag' )
		);
		return apply_filters( 'supermag_header_date_format', $supermag_header_date_format );
	}
endif;

/**
 * Header Media Position options
 *
 * @since SuperMag 1.5.0
 *
 * @param null
 * @return array $supermag_header_media_position
 *
 */
if ( !function_exists('supermag_header_media_position') ) :
	function supermag_header_media_position() {
		$supermag_header_media_position =  array(
			'very-top' => __( 'Very Top', 'supermag' ),
			'above-logo' => __( 'Above Site Identity', 'supermag' ),
			'above-menu' => __( 'Below Site Identity and Above Menu', 'supermag' ),
			'below-menu' => __( 'Below Menu', 'supermag' )
		);
		return apply_filters( 'supermag_header_media_position', $supermag_header_media_position );
	}
endif;

/**
 * Header Site identity and ads display options
 *
 * @since SuperMag 1.0.5
 *
 * @param null
 * @return array $supermag_menu_search_type
 *
 */
if ( !function_exists('supermag_menu_search_type') ) :
    function supermag_menu_search_type() {
        $supermag_menu_search_type =  array(
            'normal-search' => __( 'Normal Search', 'supermag' ),
            'dropdown-search' => __( 'Dropdown Search', 'supermag' )
        );
        return apply_filters( 'supermag_menu_search_type', $supermag_menu_search_type );
    }
endif;


/**
 * Global layout options
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array $supermag_default_layout
 *
 */
if ( !function_exists('supermag_default_layout') ) :
    function supermag_default_layout() {
        $supermag_default_layout =  array(
            'fullwidth' => __( 'Fullwidth', 'supermag' ),
            'boxed' => __( 'Boxed', 'supermag' )
        );
        return apply_filters( 'supermag_default_layout', $supermag_default_layout );
    }
endif;

/**
 * Sidebar layout options
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array $supermag_sidebar_layout
 *
 */
if ( !function_exists('supermag_sidebar_layout') ) :
    function supermag_sidebar_layout() {
        $supermag_sidebar_layout =  array(
            'right-sidebar'=> __( 'Right Sidebar', 'supermag' ),
            'left-sidebar'=> __( 'Left Sidebar' , 'supermag' ),
            'no-sidebar'=> __( 'No Sidebar', 'supermag' )
        );
        return apply_filters( 'supermag_sidebar_layout', $supermag_sidebar_layout );
    }
endif;


/**
 * Blog layout options
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array $supermag_blog_layout
 *
 */
if ( !function_exists('supermag_blog_layout') ) :
    function supermag_blog_layout() {
        $supermag_blog_layout =  array(
            'left-image' => __( 'Left Image', 'supermag' ),
            'large-image' => __( 'Large Image', 'supermag' ),
            'no-image' => __( 'No Image', 'supermag' )
        );
        return apply_filters( 'supermag_blog_layout', $supermag_blog_layout );
    }
endif;

/**
 * Feature side display options
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array $supermag_feature_side_display_options
 *
 */
if ( !function_exists('supermag_feature_side_display_options') ) :
    function supermag_feature_side_display_options() {
        $supermag_feature_side_display_options =  array(
            'from-recent'   => __( 'Recents posts', 'supermag' ),
            'from-category' => __( 'Category', 'supermag' ),
            'post-2-add-2'  => __( 'Post 2 - Add 2', 'supermag' )
        );
        return apply_filters( 'supermag_feature_side_display_options', $supermag_feature_side_display_options );
    }
endif;

/**
 * Related post layout
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array supermag_pagination_options
 *
 */
if ( !function_exists('supermag_pagination_options') ) :
    function supermag_pagination_options() {
        $supermag_pagination_options =  array(
            'default'  => __( 'Default', 'supermag' ),
            'numeric' => __( 'Numeric', 'supermag' ),
        );
        return apply_filters( 'supermag_pagination_options', $supermag_pagination_options );
    }
endif;

/**
 * Related posts layout options
 *
 * @since SuperMag 1.1.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('supermag_reset_options') ) :
    function supermag_reset_options() {
        $supermag_reset_options =  array(
            '0'  => __( 'Do Not Reset', 'supermag' ),
            'reset-color-options'  => __( 'Reset Colors Options', 'supermag' ),
            'reset-all' => __( 'Reset All', 'supermag' )
        );
        return apply_filters( 'supermag_reset_options', $supermag_reset_options );
    }
endif;


/**
 * Blog Archive Display Options
 *
 * @since SuperMag 1.5.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('supermag_blog_archive_category_display_options') ) :
	function supermag_blog_archive_category_display_options() {
		$supermag_blog_archive_category_display_options =  array(
			'default'  => __( 'Default', 'supermag' ),
			'cat-color'  => __( 'Categories with Color', 'supermag' )
		);
		return apply_filters( 'supermag_blog_archive_category_display_options', $supermag_blog_archive_category_display_options );
	}
endif;

/**
 * Related Post Display From Options
 *
 * @since SuperMag 1.5.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('supermag_related_post_display_from') ) :
	function supermag_related_post_display_from() {
		$supermag_related_post_display_from =  array(
			'cat'  => __( 'Related Posts From Categories', 'supermag' ),
			'tag'  => __( 'Related Posts From Tags', 'supermag' )
		);
		return apply_filters( 'supermag_related_post_display_from', $supermag_related_post_display_from );
	}
endif;


/**
 * Blog layout options
 *
 * @since SuperMag 1.5.0
 *
 * @param null
 * @return array $supermag_get_image_sizes_options
 *
 */
if ( !function_exists('supermag_get_image_sizes_options') ) :
    function supermag_get_image_sizes_options( $add_disable = false ) {
        global $_wp_additional_image_sizes;
        $choices = array();
        if ( true == $add_disable ) {
            $choices['disable'] = __( 'No Image', 'supermag' );
        }
        foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
            $choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
        }
        $choices['full'] = __( 'full (original)', 'supermag' );
        if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

            foreach ($_wp_additional_image_sizes as $key => $size ) {
                $choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
            }

        }
        return apply_filters( 'supermag_get_image_sizes_options', $choices );
    }
endif;

/**
 *  Default Theme layout options
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array $supermag_theme_layout
 *
 */
if ( !function_exists('supermag_get_default_theme_options') ) :
    function supermag_get_default_theme_options() {

        $default_theme_options = array(
            /*feature section options*/
            'supermag-feature-cat'  => 0,
            'supermag-feature-post-one'  => 0,
            'supermag-feature-post-two'  => 0,
            'supermag-feature-side-display-options'  => 'post-2-add-2',
            'supermag-feature-side-title-length'  => 6,
            'supermag-feature-side-from-category'  => 0,
            'supermag-feature-add-one'  => get_template_directory_uri()."/assets/img/supermag-add1-240-172.png",
            'supermag-feature-add-one-link'  => "https://www.acmethemes.com/",
            'supermag-feature-add-two'  => get_template_directory_uri()."/assets/img/supermag-add2-240-172.png",
            'supermag-feature-add-two-link'  => "https://www.acmethemes.com/themes/supermag/",
            'supermag-enable-feature'  => '',

            /*header options*/
            'supermag-header-logo'  => '',
            'supermag-header-id-display-opt' => 'title-and-tagline',
            'supermag-show-date'  => 1,
            'supermag-breaking-news-title'  => __( 'Recent posts', 'supermag' ),
            'supermag-breaking-news-options'  => 'slide',
            'supermag-facebook-url'  => '',
            'supermag-twitter-url'  => '',
            'supermag-youtube-url'  => '',
            'supermag-instagram-url'        => '',
            'supermag-google-plus-url'  => '',
            'supermag-pinterest-url'        => '',
            'supermag-enable-social'  => 0,
            'supermag-header-main-show-banner-ads'  => 'image',
            'supermag-header-main-banner-ads'  => get_template_directory_uri()."/assets/img/supermag-new-ad.png",
            'supermag-header-main-banner-ads-link'  => 'https://www.acmethemes.com/themes/supermag/',
            'supermag-header-logo-ads-display-position'  => 'left-logo-right-ads',

            'supermag-menu-show-home-icon'  => 1,
            'supermag-enable-random-post'  => 1,
            'supermag-enable-sticky-menu'  => '',
            'supermag-menu-show-search'  => 1,
            'supermag-menu-search-type'  => 'dropdown-search',
            'supermag-enable-sticky-sidebar'  => 1,
            'supermag-header-date-format'  => 'default',

            'supermag-header-media-position'  => 'above-menu',
            'supermag-header-media-customizer-link'  => '',
            'supermag-header-image-link'  => esc_url( home_url() ),
            'supermag-header-image-link-new-tab'  => '',

            /*footer options*/
            'supermag-footer-copyright'  => __( 'Copyright &copy; All rights reserved', 'supermag' ),

            /*layout/design options*/
            'supermag-default-layout'  => 'boxed',
            'supermag-enable-box-shadow'  => '',
            'supermag-sidebar-layout'  => 'right-sidebar',
            'supermag-front-page-sidebar-layout'  => 'right-sidebar',
            'supermag-archive-sidebar-layout'  => 'right-sidebar',

            'supermag-blog-archive-layout'  => 'left-image',
            'supermag-blog-archive-image-layout' => 'full',
            'supermag-disable-image-zoom' => '',

            'supermag-blog-archive-more-text'  => __( 'Read More', 'supermag' ),

            'supermag-blog-archive-category-display-options' => 'default',
            'supermag-single-category-display-options' => 'default',

            'supermag-primary-color'  => '#4db2ec',
            'supermag-cat-hover-color'  => '#2d2d2d',

            'supermag-custom-css'  => '',

            /*single related post options*/
            'supermag-show-related'  => 1,
            'supermag-related-title'  => __( 'Related posts', 'supermag' ),
            'supermag-related-post-display-from'  => 'cat',
            'supermag-single-post-layout'  => 'large-image',
            'supermag-single-image-layout'  => 'full',

            /*theme options*/
            'supermag-search-placholder'  => __( 'Search', 'supermag' ),
            'supermag-show-breadcrumb'  => 0,
            'supermag-side-show-message'  => '',
            'supermag-image-size-message'  => '',
            'supermag-side-image-message'  => '',
            'supermag-hide-front-page-content'  => '',

            /*Reset*/
            'supermag-reset-options'  => '0',

        );

        return apply_filters( 'supermag_default_theme_options', $default_theme_options );
    }
endif;


/**
 *  Get theme options
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array supermag_theme_options
 *
 */
if ( !function_exists('supermag_get_theme_options') ) :
    function supermag_get_theme_options() {

        $supermag_default_theme_options = supermag_get_default_theme_options();
        $supermag_get_theme_options = get_theme_mod( 'supermag_theme_options');
        if( is_array($supermag_get_theme_options )){
            return array_merge( $supermag_default_theme_options ,$supermag_get_theme_options );
        }
        else{
            return $supermag_default_theme_options;
        }
    }
endif;