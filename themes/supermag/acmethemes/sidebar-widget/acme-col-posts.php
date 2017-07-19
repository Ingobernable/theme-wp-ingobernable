<?php
/**
 * Custom columns of category with various options
 *
 * @package Acme Themes
 * @subpackage SuperMag
 */
if ( ! class_exists( 'supermag_posts_col' ) ) {
    /**
     * Class for adding widget
     *
     * @package Acme Themes
     * @subpackage SuperMag_posts_col
     * @since 1.0.0
     */
    class supermag_posts_col extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
            'supermag_cat_title'            => '',
            'supermag_cat'                  => 0,
            'supermag_enable_first_featured'=> 0,
            'supermag_post_col_layout'      => 0,
            'supermag_post_col_first_featured_image_layout' => 'large',
            'supermag_post_col_normal_image_layout' => 'large'
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'supermag_posts_col',
                /*Widget name will appear in UI*/
                __('AT Posts Column', 'supermag'),
                /*Widget description*/
                array( 'description' => __( 'Show posts selected category', 'supermag' ), )
            );
        }
        /*Widget Backend*/
        public function form( $instance ) {
            /*defaults values*/
            $instance = wp_parse_args( (array) $instance, $this->defaults );

            /*selected cat*/
            $supermag_selected_cat = esc_attr( $instance['supermag_cat'] );
            /*Main title*/
            $supermag_col_posts_title = esc_attr( $instance['supermag_cat_title'] );
            if( empty( $supermag_col_posts_title ) && 0 != $supermag_selected_cat ){
                $supermag_col_posts_title = get_cat_name($supermag_selected_cat);
            }

            /*Enable first featured*/
            $supermag_enable_first_featured = esc_attr( $instance['supermag_enable_first_featured'] );

            /*Layout options*/
            $supermag_layout_arrays = array( __('Layout 1','supermag'), __('Layout 2','supermag')  );
            $supermag_post_col_layout = $instance['supermag_post_col_layout'];

            /*first featured image*/
            $supermag_post_col_first_featured_image_layout = $instance['supermag_post_col_first_featured_image_layout'];

            /*normal featured image*/
            $supermag_post_col_normal_image_layout = $instance['supermag_post_col_normal_image_layout'];

            $choices = supermag_get_image_sizes_options();

            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_cat_title' ); ?>"><?php _e( 'Title:', 'supermag' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_cat_title' ); ?>" name="<?php echo $this->get_field_name( 'supermag_cat_title' ); ?>" type="text" value="<?php echo $supermag_col_posts_title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('supermag_cat'); ?>"><?php _e('Select Category', 'supermag'); ?></label>
                <?php
                $supermag_dropown_cat = array(
                    'show_option_none'   => __('From Recent Posts','supermag'),
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $supermag_selected_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('supermag_cat'),
                    'id'                 => $this->get_field_name('supermag_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories($supermag_dropown_cat);
                ?>
            </p>
            <p>
                <input class="widefat supermag-enable-first-featured" id="<?php echo $this->get_field_id( 'supermag_enable_first_featured' ); ?>" name="<?php echo $this->get_field_name( 'supermag_enable_first_featured' ); ?>" type="checkbox" <?php checked( 1, esc_attr( $supermag_enable_first_featured ), 1 ); ?>/>
                <label for="<?php echo $this->get_field_id( 'supermag_enable_first_featured' ); ?>"><?php _e( 'Enable First Post Featured' ,'supermag'); ?></label>
                <br />
            </p>
            <div class="supermag-enable-first-featured-toggle">
                <p>
                    <label for="<?php echo $this->get_field_id( 'supermag_post_col_layout' ); ?>">
                        <?php _e( 'First Featured Post Layout', 'supermag' ); ?>
                        <br />
                        <small><?php _e( 'Enable First Post Featured to work this layout', 'supermag' ); ?></small>
                    </label>
                    <select class="widefat" id="<?php echo $this->get_field_id( 'supermag_post_col_layout' ); ?>" name="<?php echo $this->get_field_name( 'supermag_post_col_layout' ); ?>">
                        <?php
                        foreach( $supermag_layout_arrays as $key => $supermag_column_array ){
                            echo ' <option value="'.$key.'"'.selected( $supermag_post_col_layout, $key, 0).'>'.$supermag_column_array.'</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id( 'supermag_post_col_first_featured_image_layout' ); ?>">
                        <?php _e( 'First Featured Post Image', 'supermag' ); ?>
                        <br />
                        <small><?php _e( 'Enable First Post Featured to work this layout', 'supermag' ); ?></small>
                    </label>
                    <select class="widefat" id="<?php echo $this->get_field_id( 'supermag_post_col_first_featured_image_layout' ); ?>" name="<?php echo $this->get_field_name( 'supermag_post_col_first_featured_image_layout' ); ?>">
                        <?php
                        foreach( $choices as $key => $supermag_column_array ){
                            echo ' <option value="'.$key.'"'.selected( $supermag_post_col_first_featured_image_layout, $key, 0).'>'.$supermag_column_array.'</option>';
                        }
                        ?>
                    </select>
                </p>
            </div>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_post_col_normal_image_layout' ); ?>">
                    <?php _e( 'Normal Featured Post Image', 'supermag' ); ?>
                    <br />
                    <small><?php _e( 'Enable First Post Featured to work this layout', 'supermag' ); ?></small>
                </label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'supermag_post_col_normal_image_layout' ); ?>" name="<?php echo $this->get_field_name( 'supermag_post_col_normal_image_layout' ); ?>">
                    <?php
                    foreach( $choices as $key => $supermag_column_array ){
                        echo ' <option value="'.$key.'"'.selected( $supermag_post_col_normal_image_layout, $key, 0).'>'.$supermag_column_array.'</option>';
                    }
                    ?>
                </select>
            </p>
            <p>
                <small><?php _e( 'Note: Some of the features only work in "Home main content area" due to minimum width in other areas.' ,'supermag'); ?></small>
            </p>
            <?php
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['supermag_cat_title'] = ( isset( $new_instance['supermag_cat_title'] ) ) ? sanitize_text_field( $new_instance['supermag_cat_title'] ) : '';
            $instance['supermag_cat'] = ( isset( $new_instance['supermag_cat'] ) ) ? esc_attr( $new_instance['supermag_cat'] ) : '';
            $instance['supermag_enable_first_featured'] = isset($new_instance['supermag_enable_first_featured'])? 1 : 0;
            $instance['supermag_post_col_layout'] = isset($new_instance['supermag_post_col_layout'])? absint( $new_instance['supermag_post_col_layout'] ) : 1;
            $instance['supermag_post_col_first_featured_image_layout'] = isset($new_instance['supermag_post_col_first_featured_image_layout'])? esc_attr( $new_instance['supermag_post_col_first_featured_image_layout'] ) : 'large';
            $instance['supermag_post_col_normal_image_layout'] = isset($new_instance['supermag_post_col_normal_image_layout'])? esc_attr( $new_instance['supermag_post_col_normal_image_layout'] ) : 'large';

            return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return array
         *
         */
        public function widget($args, $instance) {
            if( isset( $args['id'] ) ){
                $supermag_sidebar_id = $args['id'];
            }
            else{
                $supermag_sidebar_id = 'supermag-home';
            }
            /*defaults values*/
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*selected cat*/
            $supermag_selected_cat = esc_attr( $instance['supermag_cat'] );

            /*Main title*/
            $supermag_col_posts_title = !empty( $instance['supermag_cat_title'] ) ? esc_attr( $instance['supermag_cat_title'] ) : get_cat_name($supermag_selected_cat);
            $supermag_col_posts_title = apply_filters( 'widget_title', $supermag_col_posts_title, $instance, $this->id_base );

            /*Enable first featured*/
            $supermag_enable_first_featured = esc_attr( $instance['supermag_enable_first_featured'] );

            if( 1 == $supermag_enable_first_featured ){
                $supermag_number = 4;
            }
            else{
                $supermag_number = 6;
            }
            $supermag_other_class = '';
            if( 'supermag-home' != $supermag_sidebar_id ){
                if( 1 != $supermag_enable_first_featured ){
                    $supermag_number = 3;
                }
                if( 'supermag-sidebar')
                $supermag_other_class = 'supermag-except-home';
            }
            else{
                $supermag_other_class = '';
            }

            /*column layout*/
            $supermag_post_col_layout = absint( $instance['supermag_post_col_layout'] );

            /*first featured post layout*/
            $supermag_post_col_first_featured_image_layout = esc_attr( $instance['supermag_post_col_first_featured_image_layout'] );

            /*normal featured image*/
            $supermag_post_col_normal_image_layout = esc_attr( $instance['supermag_post_col_normal_image_layout'] );

            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 1.0.0
             *
             * @see WP_Query
             *
             */
            $sticky = get_option( 'sticky_posts' );
            $supermag_cat_post_args = array(
                'posts_per_page'      => $supermag_number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'post__not_in' => $sticky
            );
            if( -1 != $supermag_selected_cat ){
                $supermag_cat_post_args['cat'] = $supermag_selected_cat;
            }
            $supermag_featured_query = new WP_Query($supermag_cat_post_args);

            if ($supermag_featured_query->have_posts()) :

                echo $args['before_widget'];
                if ( !empty( $supermag_col_posts_title ) ){
	                if( -1 != $supermag_selected_cat ){
		                echo "<div class='at-cat-color-wrap-".$supermag_selected_cat."'>";
	                }
                    echo $args['before_title'] . $supermag_col_posts_title . $args['after_title'];

	                if( -1 != $supermag_selected_cat ){
		                echo "</div>";
	                }
                }
                $supermag_post_col_layout_class ='';
                if( 1 == $supermag_post_col_layout ){
                    $supermag_post_col_layout_class = 'sm-col-post-type-2';
                }
                ?>
                <ul class="<?php echo esc_attr( $supermag_post_col_layout_class ); ?> featured-entries-col featured-entries <?php echo esc_attr( $supermag_other_class ); ?> featured-col-posts <?php echo esc_attr( $supermag_sidebar_id ); ?>">
                    <?php
                    $supermag_featured_index = 1;
                    while ( $supermag_featured_query->have_posts() ) :$supermag_featured_query->the_post();
                        if( 1 == $supermag_featured_index && 1 == $supermag_enable_first_featured ){
                            $thumb = $supermag_post_col_first_featured_image_layout;
                            $supermag_list_classes = 'acme-col-3 featured-post-main';
                            $supermag_words = 48;
                        }
                        else{
                            $thumb = $supermag_post_col_normal_image_layout;
                            $supermag_list_classes = 'acme-col-3';
                            $supermag_words = 16;
                            if( 1 == $supermag_post_col_layout ){
                                $supermag_words = 8;
                            }
                        }
                        ?>
                        <li class="<?php echo esc_attr( $supermag_list_classes ); ?>">
                            <figure class="widget-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if( has_post_thumbnail() ):
                                        the_post_thumbnail( $thumb );
                                    else:
                                        ?>
                                        <div class="no-image-widgets">
                                            <?php
                                            the_title( sprintf( '<h2 class="caption-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                                            if( !get_the_title() ){
                                                the_date( '', sprintf( '<h2 class="caption-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    endif;
                                    ?>
                                </a>
                            </figure>
                            <div class="featured-desc">
                                <div class="above-entry-meta">
                                    <?php
                                    $archive_year  = get_the_date('Y');
                                    $archive_month = get_the_date('m');
                                    $archive_day   = get_the_date('d');
                                    ?>
                                    <span>
                                        <a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
                                            <i class="fa fa-calendar"></i>
                                            <?php echo esc_html( get_the_date() ); ?>
                                        </a>
                                    </span>
                                    <span>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
                                            <i class="fa fa-user"></i>
                                            <?php echo esc_html( get_the_author() ); ?>
                                        </a>
                                    </span>
                                    <span>
                                        <?php comments_popup_link( '<i class="fa fa-comment"></i>0', '<i class="fa fa-comment"></i>1', '<i class="fa fa-comment"></i>%' );?>
                                    </span>
                                </div>
                                <a href="<?php the_permalink()?>">
                                    <h4 class="title">
                                        <?php the_title(); ?>
                                    </h4>
                                </a>
                                <?php
                                $content = supermag_words_count( get_the_excerpt(), $supermag_words );
                                echo '<div class="details">'.esc_html( $content ).'</div>';
                                ?>
                                <div class="below-entry-meta">
                                    <?php supermag_list_category(); ?>
                                </div>
                            </div>
                        </li>
                    <?php
                        if( 1 == $supermag_enable_first_featured ){
                            if( 1 == $supermag_featured_index ){
                                if( 1 == $supermag_post_col_layout ){
                                    echo '<div class="sm-col-post-type-2-beside">';
                                }
                                else{
                                    echo '<div class="clearfix"></div>';
                                }

                            }
                            if( ($supermag_featured_index - 1) % 3 == 0 ){
                                echo '<div class="clearfix visible-lg"></div>';
                            }
                            if( ( $supermag_featured_index - 1 ) % 2 == 0 ){
                                echo '<div class="clearfix visible-sm"></div>';
                            }
                        }
                        else{
                            if( $supermag_featured_index % 3 == 0 ){
                                echo '<div class="clearfix visible-lg"></div>';
                            }
                            if( $supermag_featured_index % 2 == 0 ){
                                echo '<div class="clearfix visible-sm"></div>';
                            }
                        }
                        $supermag_featured_index++;
                    endwhile;
                    if( 1 == $supermag_post_col_layout && 1 == $supermag_enable_first_featured){
                        echo '</div>';
                    }
                    ?>
                </ul>
                <?php echo $args['after_widget'];
                echo "<div class='clearfix'></div>";
                // Reset the global $the_post as this query will have stomped on it
                wp_reset_postdata();
            endif;
        }
    } // Class supermag_posts_col ends here
}
if ( ! function_exists( 'supermag_posts_col' ) ) :
    /**
     * Function to Register and load the widget
     *
     * @since 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function supermag_posts_col() {
        register_widget( 'supermag_posts_col' );
    }
endif;
add_action( 'widgets_init', 'supermag_posts_col' );
