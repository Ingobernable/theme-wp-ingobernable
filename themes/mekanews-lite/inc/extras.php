<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mekanews_Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function mekanews_lite_body_classes( $classes ) {
	
	// Get Theme Options from Database
	
	$theme_options = mekanews_lite_theme_options();
		
	// Switch Sidebar Layout to left
	if ( 'left-sidebar' == $theme_options['layout'] ) {
		$classes[] = 'sidebar-left';
	}	
	
	// Add Small Post Layout class
	if ( ( is_archive() or is_home() ) and 'left' == $theme_options['post_layout_archives'] ) {
		$classes[] = 'post-layout-small';
	}

	return $classes;
}
add_filter( 'body_class', 'mekanews_lite_body_classes' );

/**
|------------------------------------------------------------------------------
| Excerpt
|------------------------------------------------------------------------------
|
*/

function mekanews_lite_excerpt_length( $length ) {

	$theme_options = mekanews_lite_theme_options();

	$number = intval ($theme_options['excerpt_length']) > 0 ?  intval ($theme_options['excerpt_length']) : $length;
	return $number;
}
add_filter( 'excerpt_length', 'mekanews_lite_excerpt_length', 999 );

function mekanews_lite_excerpt_more( $more ) {

	$theme_options = mekanews_lite_theme_options();

	return $theme_options['excerpt_more'];
}
add_filter('excerpt_more', 'mekanews_lite_excerpt_more');

/**
|------------------------------------------------------------------------------
| Related Posts
|------------------------------------------------------------------------------
|
| You can show related posts by Categories or Tags. 
| It has two options to show related posts
|
| 1. Thumbnail related posts (default)
| 2. List of related posts
| 
| @return void
|
*/
if (! function_exists('mekanews_lite_related_posts') ) :

	function mekanews_lite_related_posts() {
		global $post;

		$theme_options = mekanews_lite_theme_options();

		$taxonomy = $theme_options['related_posts'];
		$numberRelated = 6;
		$args =  array();

		if ($taxonomy == 'tag') {

			$tags = wp_get_post_tags($post->ID);
			$arr_tags = array();
			foreach($tags as $tag) {
				array_push($arr_tags, $tag->term_id);
			}
			
			if (!empty($arr_tags)) { 
			    $args = array(  
				    'tag__in' => $arr_tags,  
				    'post__not_in' => array($post->ID),  
				    'posts_per_page'=> $numberRelated,
			    ); 
			}

		} else {

			 $args = array( 
			 	'category__in' => wp_get_post_categories($post->ID), 
			 	'posts_per_page' => $numberRelated, 
			 	'post__not_in' => array($post->ID) 
			 );

		}

		if (! empty($args) ) {
			$posts = get_posts($args);

			if ($posts) {
				?>
			<h3 class="title-related-posts"><?php _e('Related Post', 'mekanews-lite') ?></h3>
				<ul class="related clearfix">
				<?php
				foreach ($posts as $p) {
					?>
					<li>
						<div class="related-entry">							
								<div class="thumbnail">
									<?php if (has_post_thumbnail($p->ID)) : ?>							
										<a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>">
											<?php echo get_the_post_thumbnail($p->ID, 'mekanews-lite-related-thumbnails') ?>
										</a>
									<?php else : ?>
										<a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>">
											<img src="<?php echo get_template_directory_uri(); ?>/images/related-thumbnails.jpg" />
										</a>
									<?php endif; ?>
								</div>							
							<a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>"><?php echo get_the_title($p->ID) ?></a>
							<div class="entry-meta-single">											
								<?php
									$modified_time = get_post_modified_time('F j, Y', null, $p->ID );
									
									echo "<span class='posted-on'>" . $modified_time . "</span>";	
									
									$comments_count = wp_count_comments($p->ID);								
									$comment_count =  number_format($comments_count->total_comments);
									if ( $comment_count > 1 ) :
										echo "<span class='comments-link'>" . $comment_count  . " Comments" . "</span>";
									else :
										echo "<span class='comments-link'>" . $comment_count  . " Comment" . "</span>";
									endif;	
								 ?>											
							</div>
								
						</div>
					</li>
					<?php
				}
				?>
				</ul>
				<?php
			
			}
		}
	}
endif;


if ( ! function_exists( 'mekanews_lite_slideshow' ) ) :
/**
 * Displays Slideshow in home page
 */
	function mekanews_lite_slideshow() {
		global $paged;
		global $wp_query;
		$theme_options = mekanews_lite_theme_options();
		if($theme_options['slider'] == 1 ) {
			$paged = $wp_query->get( 'paged' );
				if ( ! $paged || $paged < 2 ) :
					get_template_part( 'template-parts/content', 'slide' );
				endif;				
			
		}
	}

endif;

/**
 * Use something like this when slider is active, so the sticky posts are not show twice:
 * 
 */
function mekanews_lite_exclude_sticky_post( $query ) {

        $sticky = get_option( 'sticky_posts' );
        $theme_options = mekanews_lite_theme_options();

        if ( ! is_admin() && $query->is_home() && $query->is_main_query() && $theme_options['slider'] == 1 && $sticky ) {

                $query->set( 'post__not_in', $sticky );
                $query->set( 'ignore_sticky_posts', true );
        }    
}

add_action( 'pre_get_posts', 'mekanews_lite_exclude_sticky_post' );