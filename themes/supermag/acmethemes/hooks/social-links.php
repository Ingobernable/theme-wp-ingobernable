<?php
/**
 * Display Social Links
 *
 * @since SuperMag 1.1.0
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('supermag_social_links') ) :

    function supermag_social_links( ) {

	    $supermag_customizer_all_values = supermag_get_theme_options();
        ?>
        <div class="socials">
            <?php
            if ( !empty( $supermag_customizer_all_values['supermag-facebook-url'] ) ) { ?>
                <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-facebook-url'] ); ?>" class="facebook" data-title="Facebook" target="_blank">
                    <span class="font-icon-social-facebook"><i class="fa fa-facebook"></i></span>
                </a>
            <?php }
            if ( !empty( $supermag_customizer_all_values['supermag-twitter-url'] ) ) { ?>
                <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-twitter-url'] ); ?>" class="twitter" data-title="Twitter" target="_blank">
                    <span class="font-icon-social-twitter"><i class="fa fa-twitter"></i></span>
                </a>
            <?php }
            if ( !empty( $supermag_customizer_all_values['supermag-youtube-url'] ) ) { ?>
                <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-youtube-url'] ); ?>" class="youtube" data-title="Youtube" target="_blank">
                    <span class="font-icon-social-youtube"><i class="fa fa-youtube"></i></span>
                </a>
            <?php }
            if ( !empty( $supermag_customizer_all_values['supermag-instagram-url'] ) ) { ?>
                <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-instagram-url'] ); ?>" class="instagram" data-title="Instagram" target="_blank">
                    <span class="font-icon-social-instagram"><i class="fa fa-instagram"></i></span>
                </a>
            <?php }
            if ( !empty( $supermag_customizer_all_values['supermag-google-plus-url'] ) ) {
                ?>
                <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-google-plus-url'] ); ?>" class="google-plus" data-title="Google Plus" target="_blank">
                    <span class="font-icon-social-google-plus"><i class="fa fa-google-plus"></i></span>
                </a>
                <?php
            }
            if ( !empty( $supermag_customizer_all_values['supermag-pinterest-url'] ) ) { ?>
                <a href="<?php echo esc_url( $supermag_customizer_all_values['supermag-pinterest-url'] ); ?>" class="pinterest" data-title="Pinterest" target="_blank">
                    <span class="font-icon-social-pinterest"><i class="fa fa-pinterest"></i></span>
                </a>
            <?php }
            ?>
        </div>
        <?php
    }

endif;

add_filter( 'supermag_action_social_links', 'supermag_social_links', 10 );