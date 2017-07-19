<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_set_global' ) ) :

    function supermag_set_global() {
        /*Getting saved values start*/
        $supermag_saved_theme_options = supermag_get_theme_options();
        $GLOBALS['supermag_customizer_all_values'] = $supermag_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'supermag_action_before_head', 'supermag_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_doctype' ) ) :
    function supermag_doctype() {
        ?>
        <!DOCTYPE html><html <?php language_attributes(); ?>>
    <?php
    }
endif;
add_action( 'supermag_action_before_head', 'supermag_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_before_wp_head' ) ) :

    function supermag_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="<?php echo esc_url('http://gmpg.org/xfn/11')?>">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
    }
endif;
add_action( 'supermag_action_before_wp_head', 'supermag_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_body_class' ) ) :

    function supermag_body_class( $supermagbody_classes ) {
	    $supermag_customizer_all_values = supermag_get_theme_options();
        if ( 'boxed' == $supermag_customizer_all_values['supermag-default-layout'] ) {
            $supermagbody_classes[] = 'boxed-layout';
        }
	    if ( 1 == $supermag_customizer_all_values['supermag-enable-box-shadow'] ) {
		    $supermagbody_classes[] = 'supermag-enable-box-shadow';
	    }

        if ( 'no-image' == $supermag_customizer_all_values['supermag-blog-archive-layout'] ) {
            $supermagbody_classes[] = 'blog-no-image';
        }
        if ( $supermag_customizer_all_values['supermag-blog-archive-layout'] == 'large-image') {
            $supermagbody_classes[] = 'blog-large-image';
        }
        if ( $supermag_customizer_all_values['supermag-single-post-layout'] == 'large-image') {
            $supermagbody_classes[] = 'single-large-image';
        }
        if ( 1 == $supermag_customizer_all_values['supermag-disable-image-zoom'] ) {
            $supermagbody_classes[] = 'blog-disable-image-zoom';
        }
        $supermag_header_logo_menu_display_position = $supermag_customizer_all_values['supermag-header-logo-ads-display-position'];
        $supermagbody_classes[] = esc_attr( $supermag_header_logo_menu_display_position );

        $supermagbody_classes[] = supermag_sidebar_selection();
        
        if( 1 == $supermag_customizer_all_values['supermag-enable-sticky-sidebar'] ){
            $supermagbody_classes[] = 'at-sticky-sidebar';
        }

        return $supermagbody_classes;

    }
endif;
add_action( 'body_class', 'supermag_body_class', 10, 1);

/**
 * Page start
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_page_start' ) ) :

    function supermag_page_start() {
        ?>
        <div id="page" class="hfeed site">
<?php
    }
endif;
add_action( 'supermag_action_before', 'supermag_page_start', 15 );

/**
 * Skip to content
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_skip_to_content' ) ) :

    function supermag_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content" title="link"><?php esc_html_e( 'Skip to content', 'supermag' ); ?></a>
    <?php
    }

endif;
add_action( 'supermag_action_before_header', 'supermag_skip_to_content', 10 );

/**
 * Main header
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_header' ) ) :

    function supermag_header() {
	    $supermag_customizer_all_values = supermag_get_theme_options();
	    $supermag_header_media_position = $supermag_customizer_all_values['supermag-header-media-position'];
	    if( 'very-top' == $supermag_header_media_position ){
		    supermag_header_markup();
        }
        ?>
        <header id="masthead" class="site-header" role="banner">
            <div class="top-header-section clearfix">
                <div class="wrapper">
                    <?php
                    if ( 1 == $supermag_customizer_all_values['supermag-show-date'] ){
                        echo ' <div class="header-latest-posts float-left bn-title">';
                        supermag_date_display();
                        echo "</div>";
                    }
                    $supermag_breaking_news_options = $supermag_customizer_all_values['supermag-breaking-news-options'];
                    if ( 'disable' != $supermag_breaking_news_options ) {
                        $recent_args = array(
                            'posts_per_page' => 5,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => true
                        );
                        $recent_posts = wp_get_recent_posts($recent_args);
                        if ( !empty( $recent_posts ) ):
                            if ( !empty( $supermag_customizer_all_values['supermag-breaking-news-title'] ) ){
                                $bn_title = $supermag_customizer_all_values['supermag-breaking-news-title'];
                            }
                            else{
                                $bn_title = __( 'Recent posts', 'supermag' );
                            }
                            $ul_class = 'bn';
                            if( 'slide' ==  $supermag_breaking_news_options ) {
                                $ul_class = 'duper-bn';
                            }
                            ?>
                            <div class="header-latest-posts bn-wrapper float-left">
                                <div class="bn-title">
                                    <?php echo esc_html( $bn_title ); ?>
                                </div>
                                <ul class="<?php echo $ul_class; ?>">
                                    <?php foreach ($recent_posts as $recent): ?>
                                        <li class="bn-content">
                                            <a href="<?php echo esc_url( get_permalink($recent["ID"]) ); ?>" title="<?php echo esc_attr($recent['post_title']); ?>">
                                                <?php echo esc_html( $recent['post_title'] ); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div> <!-- .header-latest-posts -->
                        <?php
                        endif;
                    }
                    ?>
                    <div class="right-header float-right">
                        <?php
                        if ( 1 == $supermag_customizer_all_values['supermag-enable-social'] ) {
                            /*Social Sharing*/
                            /**
                             * supermag_action_social_links
                             * @since SuperMag 1.1.0
                             *
                             * @hooked supermag_social_links -  10
                             */
                            do_action('supermag_action_social_links');
                            /* Social Links*/
                        }
                        ?>
                    </div>
                </div>
            </div><!-- .top-header-section -->
            <div class="header-wrapper clearfix">
                <div class="header-container">
	                <?php
	                if( 'above-logo' == $supermag_header_media_position ){
		                supermag_header_markup();
	                }
	                ?>
                    <div class="wrapper">
                        <div class="site-branding clearfix">
                            <?php if ( 'disable' != $supermag_customizer_all_values['supermag-header-id-display-opt'] ):?>
                                <div class="site-logo float-left">
                                    <?php
                                    if ( 'logo-only' == $supermag_customizer_all_values['supermag-header-id-display-opt'] ):
                                        if ( function_exists( 'the_custom_logo' ) ) :
                                            the_custom_logo();
                                        else :
                                            if( !empty( $supermag_customizer_all_values['supermag-header-logo'] ) ):
                                                $supermag_header_alt = get_bloginfo('name');
                                                ?>
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                                    <img src="<?php echo esc_url( $supermag_customizer_all_values['supermag-header-logo'] ); ?>" alt="<?php echo esc_attr( $supermag_header_alt ); ?>">
                                                </a>
                                                <?php
                                            endif;/*supermag-header-logo*/
                                        endif;
                                    else:/*else is title-only or title-and-tagline*/
                                        if ( is_front_page() && is_home() ) : ?>
                                            <h1 class="site-title">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                            </h1>
                                        <?php else : ?>
                                            <p class="site-title">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                            </p>
                                        <?php endif;
                                        if ( 'title-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt'] ):
                                            $description = get_bloginfo( 'description', 'display' );
                                            if ( $description || is_customize_preview() ) : ?>
                                                <p class="site-description"><?php echo esc_html( $description ); ?></p>
                                            <?php endif;
                                        endif;
                                    endif; ?>
                                </div><!--site-logo-->
                            <?php endif;/*supermag-header-id-display-opt*/
                            if ( (!empty( $supermag_customizer_all_values['supermag-header-main-banner-ads'] ) && 'hide' != $supermag_customizer_all_values['supermag-header-main-show-banner-ads'] ) ||
                                 is_active_sidebar( 'supermag-header' ) ):
                                $supermag_header_main_banner_ads_link = $supermag_customizer_all_values['supermag-header-main-banner-ads-link'];
                                ?>
                                <div class="header-ads float-right">
                                    <?php
                                    if (!empty( $supermag_customizer_all_values['supermag-header-main-banner-ads'] ) && 'hide' != $supermag_customizer_all_values['supermag-header-main-show-banner-ads'] ){
                                        ?>
                                        <a href="<?php echo esc_url( $supermag_header_main_banner_ads_link ); ?>" target="_blank">
                                            <img src="<?php echo esc_url( $supermag_customizer_all_values['supermag-header-main-banner-ads'] )?>">
                                        </a>
                                        <?php
                                    }

                                    if( is_active_sidebar( 'supermag-header' ) ) :
	                                    dynamic_sidebar( 'supermag-header' );
                                    endif;
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
	                <?php
	                if( 'above-menu' == $supermag_header_media_position ){
		                supermag_header_markup();
	                }

                    $supermag_enable_sticky_menu = '';
                    if ( 1 == $supermag_customizer_all_values['supermag-enable-sticky-menu'] ){
                        $supermag_enable_sticky_menu = 'supermag-enable-sticky-menu';
                    }
                    ?>
                    <nav id="site-navigation" class="main-navigation <?php echo esc_attr( $supermag_enable_sticky_menu );?> clearfix" role="navigation">
                        <div class="header-main-menu wrapper clearfix">
                            <?php
                            if ( 1 == $supermag_customizer_all_values['supermag-menu-show-home-icon'] ) {
                                if ( is_front_page() ) {
                                    $home_icon_class = 'home-icon front_page_on';
                                } else {
                                    $home_icon_class = 'home-icon';
                                }
                                ?>
                                <div class="<?php echo esc_attr( $home_icon_class ); ?>">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><i class="fa fa-home"></i></a>
                                </div>
                                <?php
                            }
                            if( !has_nav_menu('primary') ){
                                echo "<div class='acmethemes-nav'>";
                            }
                            wp_nav_menu(array('theme_location' => 'primary','container' => 'div', 'container_class' => 'acmethemes-nav'));
                            if( !has_nav_menu('primary') ){
                                echo "</div>";
                            }
                            if ( 1 == $supermag_customizer_all_values['supermag-enable-random-post'] ){
                                $sticky = get_option( 'sticky_posts' );
                                $supermag_random_post_query = new WP_Query(
                                    array (
                                        'orderby' => 'rand',
                                        'posts_per_page' => 1,
                                        'ignore_sticky_posts' => true,
                                        'post__not_in' => $sticky
                                    )
                                );
                                if ( $supermag_random_post_query->have_posts() ) {
                                    echo '<div class="random-post">';
                                    while ( $supermag_random_post_query->have_posts() ) {
                                        $supermag_random_post_query->the_post();
                                        ?>
                                        <a title="<?php echo esc_attr(get_the_title())?>" href="<?php the_permalink()?>">
                                            <i class="fa fa-random icon-menu"></i>
                                        </a>
                                        <?php
                                    }
                                    echo '</div>';/*random-post*/
                                }
                                wp_reset_postdata();
                            }
                            if ( isset( $supermag_customizer_all_values['supermag-menu-show-search']) && $supermag_customizer_all_values['supermag-menu-show-search'] == 1 ):

                                $supermag_menu_search_type = $supermag_customizer_all_values['supermag-menu-search-type'];
                                if ( 'dropdown-search' == $supermag_menu_search_type ){
                                    echo '<i class="fa fa-search icon-menu search-icon-menu"></i>';
                                    echo "<div class='menu-search-toggle'>";
                                    echo "<div class='menu-search-inner'>";
                                }
                                get_search_form();
                                
                                if ( 'dropdown-search' == $supermag_menu_search_type ){
                                    echo '</div>';/*menu-search-inner*/
                                    echo '</div>';/*menu-search-toggle*/
                                }
                            endif;
                           ?>
                        </div>
                        <div class="responsive-slick-menu clearfix"></div>
                    </nav>
                    <!-- #site-navigation -->
	                <?php
	                if( 'below-menu' == $supermag_header_media_position ){
		                supermag_header_markup();
	                }
	                ?>
                </div>
                <!-- .header-container -->
            </div>
            <!-- header-wrapper-->
        </header>
        <!-- #masthead -->
    <?php
    }
endif;
add_action( 'supermag_action_header', 'supermag_header', 10 );

/**
 * Before main content
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_before_content' ) ) :

    function supermag_before_content() {
        ?>
        <div class="wrapper content-wrapper clearfix">
        <?php
	    $supermag_customizer_all_values = supermag_get_theme_options();
        $supermag_enable_feature = $supermag_customizer_all_values['supermag-enable-feature'];
        if ( is_front_page() && 1 == $supermag_enable_feature ) {
            echo '<div class="slider-feature-wrap clearfix">';
            /*Slide*/
            /**
             * supermag_action_feature_slider
             * @since SuperMag 1.1.0
             *
             * @hooked supermag_feature_slider -  0
             */
            do_action('supermag_action_feature_slider');

            /*Featured Post Beside Slider*/
            /**
             * supermag_action_feature_side
             * @since SuperMag 1.1.0
             *
             * @hooked supermag_feature_side-  0
             */
            do_action('supermag_action_feature_side');
            echo "</div>";
            $supermag_content_id = "home-content";
        } else {
            $supermag_content_id = "content";
        }
        ?>
    <div id="<?php echo esc_attr( $supermag_content_id ); ?>" class="site-content">
    <?php
        if( 1 == $supermag_customizer_all_values['supermag-show-breadcrumb'] ){
            supermag_breadcrumbs();
        }
    }
endif;
add_action( 'supermag_action_after_header', 'supermag_before_content', 10 );
