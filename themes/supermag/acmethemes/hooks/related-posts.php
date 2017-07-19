<?php
/**
 * Display related posts from same category
 *
 * @since SuperMag 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('supermag_related_post_below') ) :

    function supermag_related_post_below( $post_id ) {

	    $supermag_customizer_all_values = supermag_get_theme_options();
	    $supermag_cat_post_args = array(
		    'post__not_in' => array($post_id),
		    'post_type' => 'post',
		    'posts_per_page'      => 3,
		    'post_status'         => 'publish',
		    'ignore_sticky_posts' => true
	    );
        if( 0 == $supermag_customizer_all_values['supermag-show-related'] ){
            return;
        }
	    $supermag_related_post_display_from = $supermag_customizer_all_values['supermag-related-post-display-from'];

        if( 'tag' == $supermag_related_post_display_from ){

	        $tags = get_post_meta( $post_id, 'related-posts', true );
	        if ( !$tags ) {
		        $tags = wp_get_post_tags( $post_id, array('fields'=>'ids' ) );
		        $supermag_cat_post_args['tag__in'] = $tags;
	        }
	        else {
		        $supermag_cat_post_args['tag_slug__in'] = explode(',', $tags);
	        }

        }
        else{

	        $cats = get_post_meta( $post_id, 'related-posts', true );
	        if ( !$cats ) {
		        $cats = wp_get_post_categories( $post_id, array('fields'=>'ids' ) );
		        $supermag_cat_post_args['category__in'] = $cats;
	        }
	        else {
		        $supermag_cat_post_args['cat'] = $cats;
	        }

        }
	    $supermag_featured_query = new WP_Query($supermag_cat_post_args);
        if( $supermag_featured_query->have_posts() ){
	        $supermag_related_title = $supermag_customizer_all_values['supermag-related-title'];
	        if( !empty( $supermag_related_title ) ){
		        ?>
                <h2 class="widget-title">
			        <?php echo esc_html( $supermag_related_title ); ?>
                </h2>
		        <?php
	        }
	        ?>
            <ul class="featured-entries-col featured-entries featured-col-posts featured-related-posts">
		        <?php


		        while ( $supermag_featured_query->have_posts() ) : $supermag_featured_query->the_post();
			        $thumb = 'large';
			        ?>
                    <li class="acme-col-3">
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
					        $content = supermag_words_count( get_the_excerpt() );
					        echo '<div class="details">'. esc_html( $content ).'</div>';
					        ?>
                            <div class="below-entry-meta">
						        <?php supermag_list_category(); ?>
                            </div>
                        </div>
                    </li>
			        <?php
		        endwhile;
		        wp_reset_postdata();
		        ?>
            </ul>
            <div class="clearfix"></div>
	        <?php
        }

    }

endif;

add_action( 'supermag_related_posts', 'supermag_related_post_below', 10, 1 );