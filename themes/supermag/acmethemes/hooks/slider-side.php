<?php
/**
 * feature sider side posts and ads
 *
 * @since SuperMag 1.1.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('supermag_feature_side') ) :

    function supermag_feature_side() {

	    $supermag_customizer_all_values = supermag_get_theme_options();
        $supermag_slider_side_args = array();

        echo '<div class="besides-slider">';
        echo '<div class="besides-slider-left">';
        /*Featured Post Beside Slider*/
        $supermag_beside_slider_ids = array();
        $supermag_beside_adds = array();
        $supermag_featured_main_layout = $supermag_customizer_all_values['supermag-feature-side-display-options'];
        $supermag_feature_side_title_length = $supermag_customizer_all_values['supermag-feature-side-title-length'];

        if( 'post-2-add-2' == $supermag_featured_main_layout ){
            if( 0 != $supermag_customizer_all_values['supermag-feature-post-one'] ){
                $supermag_beside_slider_ids[] = $supermag_customizer_all_values['supermag-feature-post-one'];
            }
            if( 0 != $supermag_customizer_all_values['supermag-feature-post-two'] ){
                $supermag_beside_slider_ids[] = $supermag_customizer_all_values['supermag-feature-post-two'];
            }
            if( !empty($supermag_customizer_all_values['supermag-feature-add-one']) ){
                $supermag_beside_adds[0]['supermag-feature-add'] = $supermag_customizer_all_values['supermag-feature-add-one'];
                $supermag_beside_adds[0]['supermag-feature-add-link'] = $supermag_customizer_all_values['supermag-feature-add-one-link'];
            }
            if( !empty($supermag_customizer_all_values['supermag-feature-add-two']) ){
                $supermag_beside_adds[1]['supermag-feature-add'] = $supermag_customizer_all_values['supermag-feature-add-two'];
                $supermag_beside_adds[1]['supermag-feature-add-link'] = $supermag_customizer_all_values['supermag-feature-add-two-link'];
            }
        }
        elseif( 'from-category' == $supermag_featured_main_layout ){
            $supermag_feature_side_from_category = $supermag_customizer_all_values['supermag-feature-side-from-category'];
            if( 0 != $supermag_feature_side_from_category ){
                $supermag_slider_side_args =    array(
                    'post_type' => 'post',
                    'cat' => $supermag_feature_side_from_category,
                    'posts_per_page' => 4
                );
            }
        }
        elseif ( 'from-recent' == $supermag_featured_main_layout ){
            $sticky = get_option( 'sticky_posts' );
            $supermag_slider_side_args =    array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'ignore_sticky_posts ' => true,
                'post__not_in' => $sticky
            );
        }
        else{
            /*do nothing*/
        }

        $supermag_float_fixed = 1;
        if( 'post-2-add-2' == $supermag_featured_main_layout ||
            'from-category' == $supermag_featured_main_layout ||
            'from-recent' == $supermag_featured_main_layout ){

            if( 'post-2-add-2' == $supermag_featured_main_layout ) {
                if(  empty( $supermag_beside_slider_ids ) ){
                    if( !empty( $supermag_beside_adds ) ) {
                        foreach ( $supermag_beside_adds as $supermag_beside_add_id){
                            ?>
                            <div class="beside-post clearfix">
                                <figure class="beside-thumb clearfix">
                                    <a href="<?php echo esc_url( $supermag_beside_add_id['supermag-feature-add-link']); ?>" target="_blank">
                                        <img src="<?php echo esc_url( $supermag_beside_add_id['supermag-feature-add']); ?>">
                                    </a>
                                </figure>
                            </div>
                            <?php
                            if( 2 == $supermag_float_fixed ){
                                echo "</div>";
                                echo '<div class="besides-slider-right">';
                            }
                            $supermag_float_fixed++;
                        }
                    }
                }
                else{
                    $sticky = get_option( 'sticky_posts' );
                    $supermag_slider_side_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 2,
                        'post__in' => $supermag_beside_slider_ids,
                        'orderby' => 'post__in',
                        'ignore_sticky_posts' => true,
                        'post__not_in' => $sticky
                    );
                }

            }

            $beside_query = new WP_Query( $supermag_slider_side_args );
            if ($beside_query->have_posts()) {

                $supermag_no_image_post_thumb = get_template_directory_uri().'/assets/img/no-image-240-172.png';

                while ($beside_query->have_posts()) {
                    $beside_query->the_post();
                    if (has_post_thumbnail()) {
                        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
                    }
                    else {
                        $image_url[0] = $supermag_no_image_post_thumb;
                    }
                    ?>
                    <div class="beside-post clearfix">
                        <a href="<?php the_permalink(); ?>">
                            <figure class="beside-thumb clearfix">
                                <img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr( the_title_attribute() ); ?>" title="<?php echo esc_attr( the_title_attribute() ); ?>" />
                                <div class="overlay"></div>
                            </figure>
                        </a>
                        <div class="beside-caption clearfix">
                            <h3 class="post-title">
                                <a href="<?php the_permalink()?>">
                                    <?php
                                    $title = supermag_words_count( get_the_title() ,$supermag_feature_side_title_length);
                                    echo esc_html( $title);
                                    ?>
                                </a>
                            </h3>
                            <div class="post-date">
                                <?php
                                $archive_year  = get_the_date('Y');
                                $archive_month = get_the_date('m');
                                $archive_day   = get_the_date('d');
                                ?>
                                <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
                                    <i class="fa fa-calendar"></i>
                                    <?php echo esc_attr( get_the_date() ); ?>
                                </a>
                                <?php comments_popup_link( '<i class="fa fa-comment"></i> 0', '<i class="fa fa-comment"></i> 1', '<i class="fa fa-comment"></i> %' );?>
                            </div>
                        </div>

                    </div>
                    <?php
                    if( 2 == $supermag_float_fixed ){
                        echo "</div>";
                        echo '<div class="besides-slider-right">';
                    }
                    $supermag_float_fixed++;
                }
            }
            wp_reset_postdata();
        }
        if( !empty( $supermag_beside_adds ) ) {
            foreach ( $supermag_beside_adds as $supermag_beside_add_id){
                ?>
                <div class="beside-post clearfix">
                    <figure class="beside-thumb clearfix">
                        <a href="<?php echo esc_url( $supermag_beside_add_id['supermag-feature-add-link']); ?>" target="_blank">
                            <img src="<?php echo esc_url( $supermag_beside_add_id['supermag-feature-add']); ?>">
                        </a>
                    </figure>
                </div>
                <?php
                if( 2 == $supermag_float_fixed ){
                    echo "</div>";
                    echo '<div class="besides-slider-right">';
                }
                $supermag_float_fixed++;
            }
        }
        echo '</div><!-- .feature-side-slider-left -->';
        echo '</div><!-- .feature-side-slider -->';

    }
endif;
add_action( 'supermag_action_feature_side', 'supermag_feature_side', 0 );