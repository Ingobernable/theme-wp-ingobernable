<?php
/**
 * Custom advertisement
 *
 * @package Acme Themes
 * @subpackage SuperMag
 */
if ( ! class_exists( 'supermag_ad_widget' ) ) :
    /**
     * Class for adding advertisement widget
     * A new way to add advertisement
     * @package Acme Themes
     * @subpackage SuperMag
     * @since 1.1.0
     */
    class supermag_ad_widget extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'supermag_ad_title' => '',
            'supermag_ad_image' => '',
            'supermag_ad_link'  => '',
            'supermag_ad_new_window' => 1,
            'supermag_ad_img_alt'  => ''
        );
        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'supermag_ad',
                /*Widget name will appear in UI*/
                __('AT Advertisement', 'supermag'),
                /*Widget description*/
                array( 'description' => __( 'Add advertisement with different options.', 'supermag' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            /*merging arrays*/
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $supermag_ad_title  = esc_attr( $instance['supermag_ad_title'] );
            $supermag_ad_image  = esc_url( $instance['supermag_ad_image'] );
            $supermag_ad_link   = esc_url( $instance['supermag_ad_link'] );
            $supermag_ad_new_window = esc_attr( $instance['supermag_ad_new_window'] );
            $supermag_ad_img_alt = esc_attr( $instance['supermag_ad_img_alt'] );
            ?>
            <p class="description">
                <?php
                _e('You can use any size of Advertisement image but recommended to use proper image according to sidebar width.', 'supermag' );
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_ad_title' ); ?>"><?php _e( 'Title:', 'supermag' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_ad_title' ); ?>" name="<?php echo $this->get_field_name( 'supermag_ad_title' ); ?>" type="text" value="<?php echo esc_attr( $supermag_ad_title ); ?>" />
            </p>
            <h4 class="accordion-toggle"><?php _e( 'Advertisement Image', 'supermag' ); ?></h4>
            <p>
                <label for="<?php echo $this->get_field_id('supermag_ad_image'); ?>">
                    <?php _e( 'Select Advertisement Image', 'supermag' ); ?>
                </label>
                <?php
                $supermag_display_none = '';
                if ( empty( $supermag_ad_image ) ){
                    $supermag_display_none = ' style="display:none;" ';
                }
                ?>
                <span class="img-preview-wrap" <?php echo esc_attr( $supermag_display_none ); ?>>
                    <img class="widefat" src="<?php echo esc_url( $supermag_ad_image ); ?>" alt="<?php _e( 'Image preview', 'supermag' ); ?>"  />
                </span><!-- .ad-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('supermag_ad_image'); ?>" id="<?php echo $this->get_field_id('supermag_ad_image'); ?>" value="<?php echo esc_url( $supermag_ad_image ); ?>" />
                <input type="button" value="<?php _e( 'Upload Image', 'supermag' ); ?>" class="button media-image-upload" data-title="<?php _e( 'Select Ad Image','supermag'); ?>" data-button="<?php _e( 'Select Ad Image','supermag'); ?>"/>
                <input type="button" value="<?php _e( 'Remove Image', 'supermag' ); ?>" class="button media-image-remove" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_ad_img_alt' ); ?>"><?php _e( 'Alt Text:', 'supermag' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_ad_img_alt' ); ?>" name="<?php echo $this->get_field_name( 'supermag_ad_img_alt' ); ?>" type="text" value="<?php echo esc_attr( $supermag_ad_img_alt ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_ad_link' ); ?>"><?php _e( 'Link URL:', 'supermag' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_ad_link' ); ?>" name="<?php echo $this->get_field_name( 'supermag_ad_link' ); ?>" type="text" value="<?php echo esc_attr( $supermag_ad_link ); ?>" />
            </p>
            <p>
                <input id="<?php echo $this->get_field_id( 'supermag_ad_new_window' ); ?>" name="<?php echo $this->get_field_name( 'supermag_ad_new_window' ); ?>" type="checkbox" <?php checked( 1 == $supermag_ad_new_window ? $instance['supermag_ad_new_window'] : 0); ?> />
                <label for="<?php echo $this->get_field_id( 'supermag_ad_new_window' ); ?>"><?php _e( 'Open in new window', 'supermag' ); ?></label>
            </p>
            <hr />
            <?php
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['supermag_ad_title'] = ( isset( $new_instance['supermag_ad_title'] ) ) ?  sanitize_text_field( $new_instance['supermag_ad_title'] ): '';
            $instance['supermag_ad_image'] = ( isset( $new_instance['supermag_ad_image'] ) ) ?  esc_url( $new_instance['supermag_ad_image'] ): '';
            $instance['supermag_ad_link'] = ( isset( $new_instance['supermag_ad_link'] ) ) ?  esc_url( $new_instance['supermag_ad_link'] ): '';
            $instance['supermag_ad_img_alt'] = ( isset( $new_instance['supermag_ad_img_alt'] ) ) ?  esc_attr( $new_instance['supermag_ad_img_alt'] ): '';
            $instance['supermag_ad_new_window'] = isset($new_instance['supermag_ad_new_window'])? 1 : 0;

            return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return array
         *
         */
        function widget( $args, $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $supermag_ad_title = apply_filters( 'widget_title', $instance['supermag_ad_title'], $instance, $this->id_base );
            $supermag_ad_image          = esc_url( $instance['supermag_ad_image'] );
            $supermag_ad_link           = esc_url( $instance['supermag_ad_link'] );
            $supermag_ad_new_window = esc_attr( $instance['supermag_ad_new_window'] );
            $supermag_ad_img_alt           = esc_attr( $instance['supermag_ad_img_alt'] );

            echo $args['before_widget'];

            if ( !empty($supermag_ad_title) ) {
                echo $args['before_title'] . $supermag_ad_title . $args['after_title'];
            }
            $ad_content_image = '';
            if ( ! empty( $supermag_ad_image ) ) {
                /*creating add*/
                $img_html = '<img src="' . $supermag_ad_image . '" alt="'.$supermag_ad_img_alt . '" />';
                $link_open = '';
                $link_close = '';
                if ( ! empty( $supermag_ad_link ) ) {
                    $target_text = ( 1 == $supermag_ad_new_window ) ? ' target="_blank" ' : '';
                    $link_open = '<a href="' . esc_url( $supermag_ad_link ) . '" ' . $target_text . '>';
                    $link_close = '</a>';
                }
                $ad_content_image = $link_open . $img_html .  $link_close;
            }
            if ( !empty( $ad_content_image ) ) {
                echo '<div class="supermag-ad-widget">';
                echo $ad_content_image;
                echo '</div>';
            }
            echo $args['after_widget'];
        }
    }
endif;

if ( ! function_exists( 'supermag_ad_widget' ) ) :
    /**
     * Function to Register and load the widget
     *
     * @since 1.0
     *
     * @param null
     * @return null
     *
     */
    function supermag_ad_widget() {
        register_widget( 'supermag_ad_widget' );
    }
endif;
add_action( 'widgets_init', 'supermag_ad_widget' );