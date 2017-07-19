<?php
/**
 * List down the post category
 *
 * @since SuperMag 1.0.0
 *
 * @param int $post_id
 * @return string list of category
 *
 */
if ( !function_exists('supermag_list_category') ) :
    function supermag_list_category( $post_id = 0 ) {

        if( 0 == $post_id ){
            global $post;
            $post_id = $post->ID;
        }
        $categories = get_the_category($post_id);
        $separator = '&nbsp;';
        $output = '';
        if($categories) {
            $output .= '<span class="cat-links">';
            foreach($categories as $category) {
                $output .= '<a class="at-cat-item-'.esc_attr($category->term_id).'" href="'.esc_url( get_category_link( $category->term_id ) ).'"  rel="category tag">'.esc_html( $category->cat_name ).'</a>'.$separator;
            }
            $output .='</span>';
            echo trim( $output, $separator );
        }

    }
endif;

/**
 * Callback functions for comments
 *
 * @since SuperMag 1.0.0
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 *
 */
if ( !function_exists('supermag_commment_list') ) :

    function supermag_commment_list($comment, $args, $depth) {
        extract($args, EXTR_SKIP);
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        }
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo $tag ?>
        <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, '64'); ?>
            <?php printf(__('<cite class="fn">%s</cite>', 'supermag' ), get_comment_author_link()); ?>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'supermag'); ?></em>
            <br/>
        <?php endif; ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                <i class="fa fa-clock-o"></i>
                <?php
                /* translators: 1: date, 2: time */
                printf(__('%1$s at %2$s', 'supermag'), get_comment_date(), get_comment_time()); ?>
            </a>
            <?php edit_comment_link(__('(Edit)', 'supermag'), '  ', ''); ?>
        </div>
        <?php comment_text(); ?>
        <div class="reply">
            <?php comment_reply_link( array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
        <?php if ('div' != $args['style']) : ?>
            </div>
        <?php endif; ?>
        <?php
    }
endif;

/**
 * Date display functions
 *
 * @since SuperMag 1.0.0
 * edited 1.5.0
 *
 * @param string $format
 * @return string
 *
 */
if ( ! function_exists( 'supermag_date_display' ) ) :
    function supermag_date_display( $format = 'l, F j, Y') {
	    $supermag_customizer_all_values = supermag_get_theme_options();
	    if( 'default' == $supermag_customizer_all_values['supermag-header-date-format'] ){
		    echo esc_html( date_i18n( $format ) );
        }
        else{
	        echo date_i18n(get_option('date_format'));
        }
    }
endif;

/**
 * Select sidebar according to the options saved
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('supermag_sidebar_selection') ) :
	function supermag_sidebar_selection( ) {
		wp_reset_postdata();
		$supermag_customizer_all_values = supermag_get_theme_options();
		global $post;
		if(
			isset( $supermag_customizer_all_values['supermag-sidebar-layout'] ) &&
			(
				'left-sidebar' == $supermag_customizer_all_values['supermag-sidebar-layout'] ||
				'both-sidebar' == $supermag_customizer_all_values['supermag-sidebar-layout'] ||
				'no-sidebar' == $supermag_customizer_all_values['supermag-sidebar-layout']
			)
		){
			$supermag_body_global_class = $supermag_customizer_all_values['supermag-sidebar-layout'];
		}
		else{
			$supermag_body_global_class= 'right-sidebar';
		}

		if( is_front_page() ){
			if( isset( $supermag_customizer_all_values['supermag-front-page-sidebar-layout'] ) ){
				if(
					'right-sidebar' == $supermag_customizer_all_values['supermag-front-page-sidebar-layout'] ||
					'left-sidebar' == $supermag_customizer_all_values['supermag-front-page-sidebar-layout'] ||
					'both-sidebar' == $supermag_customizer_all_values['supermag-front-page-sidebar-layout'] ||
					'no-sidebar' == $supermag_customizer_all_values['supermag-front-page-sidebar-layout']
				){
					$supermag_body_classes = $supermag_customizer_all_values['supermag-front-page-sidebar-layout'];
				}
				else{
					$supermag_body_classes = $supermag_body_global_class;
				}
			}
			else{
				$supermag_body_classes= $supermag_body_global_class;
			}
		}
        elseif (is_singular() && isset( $post->ID )) {
			$post_class = get_post_meta( $post->ID, 'supermag_sidebar_layout', true );
			if ( 'default-sidebar' != $post_class ){
				if ( $post_class ) {
					$supermag_body_classes = $post_class;
				} else {
					$supermag_body_classes = $supermag_body_global_class;
				}
			}
			else{
				$supermag_body_classes = $supermag_body_global_class;
			}

		}
        elseif ( is_archive() ) {
			if( isset( $supermag_customizer_all_values['supermag-archive-sidebar-layout'] ) ){
				$supermag_archive_sidebar_layout = $supermag_customizer_all_values['supermag-archive-sidebar-layout'];
				if(
					'right-sidebar' == $supermag_archive_sidebar_layout ||
					'left-sidebar' == $supermag_archive_sidebar_layout ||
					'both-sidebar' == $supermag_archive_sidebar_layout ||
					'no-sidebar' == $supermag_archive_sidebar_layout
				){
					$supermag_body_classes = $supermag_archive_sidebar_layout;
				}
				else{
					$supermag_body_classes = $supermag_body_global_class;
				}
			}
			else{
				$supermag_body_classes= $supermag_body_global_class;
			}
		}
		else {
			$supermag_body_classes = $supermag_body_global_class;
		}
		return $supermag_body_classes;
	}
endif;

/**
 * Return content of fixed lenth
 *
 * @since SuperMag 1.0.0
 *
 * @param string $supermag_content
 * @param int $length
 * @return string
 *
 */
if ( ! function_exists( 'supermag_words_count' ) ) :
    function supermag_words_count( $supermag_content = null, $length = 16 ) {
        $length = absint( $length );
        $source_content = preg_replace( '`\[[^\]]*\]`', '', $supermag_content );
        $trimmed_content = wp_trim_words( $source_content, $length, '...' );
        return $trimmed_content;
    }
endif;

/**
 * BreadCrumb Settings
 */
if( ! function_exists( 'supermag_breadcrumbs' ) ):
    function supermag_breadcrumbs() {
        wp_reset_postdata();
        global $post;
        $trans_here = __( 'You are here', 'supermag' );
        $trans_home = __( 'Home', 'supermag' );
        $search_result_text = __( 'Search Results for ', 'supermag' );

        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '<span class="bread_arrow"> > </span>'; // delimiter between crumbs
        $home = $trans_home; // text for the 'Home' link
        $showHomeLink = 1;

        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb

        $homeLink = esc_url( home_url() );

        if (is_home() || is_front_page()) {

            if ($showOnHome == 1) echo '<div id="supermag-breadcrumbs"><div class="breadcrumb-container"><a href="' . $homeLink . '">' . $home . '</a></div></div>';

        } else {
            if($showHomeLink == 1){
                echo '<div id="supermag-breadcrumbs" class="clearfix"><span class="breadcrumb">'.esc_attr( $trans_here ).'</span><div class="breadcrumb-container"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
            } else {
                echo '<div id="supermag-breadcrumbs" class="clearfix"><span class="breadcrumb">'.esc_attr( $trans_here ).'</span><div class="breadcrumb-container">' . $home . ' ' . $delimiter . ' ';
            }

            if ( is_category() ) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0)
                    echo ( get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ') );
                echo $before .  esc_html( single_cat_title('', false) ) . $after;

            } elseif ( is_search() ) {
                echo $before . $search_result_text.' "' . esc_html( get_search_query() ) . '"' . $after;

            } elseif ( is_day() ) {
                echo '<a href="' . esc_url( get_year_link(get_the_time('Y'))) . '">' . esc_attr( get_the_time('Y') ) . '</a> ' . $delimiter . ' ';
                echo '<a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m'))  ). '">' . esc_html( get_the_time('F') ) . '</a> ' . $delimiter . ' ';
                echo $before . esc_html( get_the_time('d') ) . $after;

            } elseif ( is_month() ) {
                echo '<a href="' . esc_url( get_year_link(get_the_time('Y'))  ). '">' . esc_html( get_the_time('Y') ) . '</a> ' . $delimiter . ' ';
                echo $before . esc_html( get_the_time('F') ) . $after;

            } elseif ( is_year() ) {
                echo $before . esc_html( get_the_time('Y') ) . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<a href="' . $homeLink . '/' . esc_html( $slug['slug'] ) . '/">' . esc_html( $post_type->labels->singular_name ). '</a>';
                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;
                } else {
                    $cat = get_the_category();
                    if( !empty( $cat ) ){
                        $cat = $cat[0];
                        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                        echo $cats;
                    }
                    if ($showCurrent == 1) echo $before . esc_html( get_the_title() ) . $after;
                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . esc_html( $post_type->labels->singular_name ) . $after;

            } elseif ( is_attachment() ) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                if( !empty( $cat ) ){
                    $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                }
                echo '<a href="' . esc_url( get_permalink($parent)) . '">' . esc_html( $parent->post_title ). '</a>';
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;

            } elseif ( is_page() && !$post->post_parent ) {
                if ($showCurrent == 1) echo $before . esc_html( get_the_title() ). $after;

            } elseif ( is_page() && $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . esc_html( get_the_title($page->ID) ) . '</a>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;

            } elseif ( is_tag() ) {
                echo $before . __('Posts tagged :','supermag') . esc_html( single_tag_title('', false) ). '"' . $after;

            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . __('Author :','supermag') . $userdata->display_name . $after;

            } elseif ( is_404() ) {
                echo $before . __('Error 404 :','supermag') . $after;
            }
            else
            {

            }
            if ( get_query_var('paged') ) {
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                echo __('Page' , 'supermag') . ' ' . get_query_var('paged');
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
            }
            echo '</div></div>';
        }
    }
endif;