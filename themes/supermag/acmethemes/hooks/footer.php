<?php
/**
 * content and content wrapper end
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_after_content' ) ) :

    function supermag_after_content() {
      ?>
        </div><!-- #content -->
        </div><!-- content-wrapper-->
    <?php
    }
endif;
add_action( 'supermag_action_after_content', 'supermag_after_content', 10 );

/**
 * Footer content
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_footer' ) ) :

    function supermag_footer() {

	    $supermag_customizer_all_values = supermag_get_theme_options();
	    if( is_active_sidebar( 'full-width-footer' ) ) :
		    dynamic_sidebar( 'full-width-footer' );
	    endif;
        ?>
        <div class="clearfix"></div>
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="footer-wrapper">
                <div class="top-bottom wrapper">
                    <div id="footer-top">
                        <div class="footer-columns">
                           <?php if( is_active_sidebar( 'footer-col-one' ) ) : ?>
                                <div class="footer-sidebar acme-col-3">
                                    <?php dynamic_sidebar( 'footer-col-one' ); ?>
                                </div>
                            <?php endif; 
                           if( is_active_sidebar( 'footer-col-two' ) ) : ?>
                                <div class="footer-sidebar acme-col-3">
                                    <?php dynamic_sidebar( 'footer-col-two' ); ?>
                                </div>
                            <?php endif;
                           if( is_active_sidebar( 'footer-col-three' ) ) : ?>
                                <div class="footer-sidebar acme-col-3">
                                    <?php dynamic_sidebar( 'footer-col-three' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div><!-- #foter-top -->
                    <div class="clearfix"></div>
                 </div><!-- top-bottom-->
                <div class="wrapper footer-copyright border text-center">
                    <p>
                        <?php if( isset( $supermag_customizer_all_values['supermag-footer-copyright'] ) ): ?>
                            <?php echo wp_kses_post( $supermag_customizer_all_values['supermag-footer-copyright'] ); ?>
                        <?php endif; ?>
                    </p>
                    <div class="site-info">
                    <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'supermag' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'supermag' ), 'WordPress' ); ?></a>
                    <span class="sep"> | </span>
                    <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'supermag' ), 'SuperMag', '<a href="https://www.acmethemes.com/" rel="designer">Acme Themes</a>' ); ?>
                    </div><!-- .site-info -->
                </div>
            </div><!-- footer-wrapper-->
        </footer><!-- #colophon -->
    <?php
    }
endif;
add_action( 'supermag_action_footer', 'supermag_footer', 10 );

/**
 * Page end
 *
 * @since SuperMag 1.1.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_page_end' ) ) :

    function supermag_page_end() {
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'supermag_action_after', 'supermag_page_end', 10 );