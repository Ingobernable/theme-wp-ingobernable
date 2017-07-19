<?php
/**
 * Display default slider
 *
 * @since SuperMag 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('supermag_default_slider') ) :
    function supermag_default_slider(){
        ?>
        <li class="default-content">
            <a href="#">
                <img src="<?php echo esc_url( get_template_directory_uri()."/assets/img/fs-img-1.jpg" ); ?>"/>
            </a>
            <div class="slider-desc">
                <div class="slider-details">
                    <a href="#">
                        <div class="slide-title">
                            <?php _e('Welcome to SuperMag','supermag'); ?>
                        </div>
                    </a>
                </div>
                <?php
                echo '<div class="slide-caption">'.__('A very perfect theme for magazine','supermag').'</div>';
                ?>
            </div>
        </li>
        <li class="default-content">
            <a href="#">
                <img src="<?php echo esc_url( get_template_directory_uri()."/assets/img/fs-img-2.jpg" ); ?>"/>
            </a>
            <div class="slider-desc">
                <div class="slider-details">
                    <a href="#">
                        <div class="slide-title">
                            <?php _e('Slider Setting','supermag'); ?>
                        </div>
                    </a>
                </div>
                <?php
                echo '<div class="slide-caption">'.__('Goto Appearance > Customize > Featured Section Options, for setting up feature slider and featured options','supermag').'</div>';
                ?>
            </div>
        </li>
        <?php
    }
endif;

/**
 * Featured Slider display
 *
 * @since SuperMag 1.1.0
 *
 * @param null
 * @return void
 */

if ( ! function_exists( 'supermag_display_feature_slider' ) ) :

    function supermag_display_feature_slider( ){

	    $supermag_customizer_all_values = supermag_get_theme_options();
        $supermag_feature_cat = $supermag_customizer_all_values['supermag-feature-cat'];
        if ( 0 != $supermag_feature_cat ) {
            $sticky = get_option( 'sticky_posts' );
            $supermag_cat_post_args = array(
                'cat'                 => $supermag_feature_cat,
                'posts_per_page'      => 5,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'post__not_in' => $sticky
            );
            $slider_query = new WP_Query($supermag_cat_post_args);
            if ($slider_query->have_posts()):
                while ($slider_query->have_posts()): $slider_query->the_post();
                    if (has_post_thumbnail()) {
                        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                    } else {
                        $image_url[0] = get_template_directory_uri() . '/assets/img/no-image-660-365.png';
                    }
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url( $image_url[0] ); ?>"/>
                        </a>
                        <div class="slider-desc">
                            <div class="above-slider-details">
                                <?php
                                $archive_year  = get_the_date('Y');
                                $archive_month = get_the_date('m');
                                $archive_day   = get_the_date('d');
                                ?>
                                <a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
                                    <i class="fa fa-calendar"></i>
                                    <?php echo esc_html( get_the_date() ); ?>
                                </a>
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
                                    <i class="fa fa-user"></i>
                                    <?php echo esc_html( get_the_author() ); ?>
                                </a>
                                <?php comments_popup_link( '<i class="fa fa-comment"></i> 0', '<i class="fa fa-comment"></i> 1', '<i class="fa fa-comment"></i> %' );?>
                            </div>
                            <div class="slider-details">
                                <a href="<?php the_permalink()?>">
                                    <div class="slide-title">
                                        <?php the_title(); ?>
                                    </div>
                                    <?php
                                    $content = supermag_words_count( get_the_excerpt() ,12);
                                    echo '<div class="slide-caption">'.esc_html( $content ).'</div>';
                                    ?>
                                </a>
                            </div>
                            <div>
                                <?php
                                supermag_list_category();
                                ?>
                            </div>
                        </div>
                    </li>
                <?php endwhile;
                wp_reset_postdata();?>
            <?php endif; ?>
        <?php
        }
        else{
            supermag_default_slider();
        }
    }
endif;
/**
 * Display related posts from same category
 *
 * @since SuperMag 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('supermag_feature_slider') ) :
    function supermag_feature_slider() {
        ?>
        <div class="slider-section">
            <ul class="home-bxslider">
                <?php supermag_display_feature_slider(); ?>
            </ul>
        </div>
        <?php
    }
endif;
add_action( 'supermag_action_feature_slider', 'supermag_feature_slider', 0 );