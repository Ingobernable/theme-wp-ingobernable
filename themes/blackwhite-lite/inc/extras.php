<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BlackWhite
 */

	/**
	|------------------------------------------------------------------------------
	| Adds custom classes to the array of body classes.
	|------------------------------------------------------------------------------
	|
	| @param array $classes Classes for the body element.
	| @return array
	|
	*/


function blackwhite_lite_body_classes( $classes ) {

	
	// Get Theme Options from Database
	
	$theme_options = blackwhite_lite_theme_options();
		
	// Switch Sidebar Layout to left
	if ( 'left-sidebar' == $theme_options['layout'] ) {
		$classes[] = 'sidebar-left';
	}

	return $classes;
}
add_filter( 'body_class', 'blackwhite_lite_body_classes' );

/**
|------------------------------------------------------------------------------
| Excerpt
|------------------------------------------------------------------------------
|
*/
function blackwhite_lite_excerpt_length( $length ) {

	$theme_options = blackwhite_lite_theme_options();
	$number = intval ($theme_options['excerpt_length']) > 0 ?  intval ($theme_options['excerpt_length']) : $length;
	return $number;

}
add_filter( 'excerpt_length', 'blackwhite_lite_excerpt_length', 999 );

function blackwhite_lite_excerpt_more( $more ) {

	$theme_options = blackwhite_lite_theme_options();
	return $theme_options['excerpt_more'];

}
add_filter('excerpt_more', 'blackwhite_lite_excerpt_more');

	/**
	|------------------------------------------------------------------------------
	| Related Posts
	|------------------------------------------------------------------------------
	|
	| You can show related posts by Categories or Tags.
	|
	| 1. Thumbnail related posts (default)
	| 2. List of related posts
	| 
	| @return void
	|
	*/
if (! function_exists('blackwhite_lite_related_posts') ):

	function blackwhite_lite_related_posts() {
		global $post;

		$theme_options = blackwhite_lite_theme_options();
		$taxonomy = $theme_options['related_posts'];
		$args =  array();

		if ($taxonomy == 'tag') {

			$tags = wp_get_post_tags($post->ID);
			$arr_tags = array();
			foreach($tags as $tag) {
				array_push($arr_tags, $tag->term_id);
			}
			
			if (!empty($arr_tags)) {
			    $args = array(  
				    'tag__in'		=> $arr_tags,
				    'post__not_in'	=> array($post->ID),
				    'posts_per_page'=> 4,
			    ); 
			}

		} else {

			 $args = array(
			 	'category__in' => wp_get_post_categories($post->ID),
			 	'posts_per_page' => 4,
			 	'post__not_in' => array($post->ID)
			 );

		}

		if (! empty($args) ) {
			
			$posts = get_posts($args);

			if ($posts) {
				
				?>
				<div class="related-posts clearfix">
					<div class="wrap-header">
						<h3 class="title-related-posts">
							<?php _e('You may also enjoy...', 'blackwhite-lite') ?>
						</h3>
					</div>

					<ul class="related clearfix">
						<?php
						foreach ($posts as $post) :
							setup_postdata($post);
							?>
							<li class="clearfix">
								<div class="related-entry">
									<div class="thumbnail">
										<?php if (has_post_thumbnail()) : ?>
											<a href="<?php the_permalink() ?>">
												<?php the_post_thumbnail('blackwhite-post-related-small') ?>
											</a>
										<?php else : ?>
											<a href="<?php the_permalink() ?>">
												<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-related-small.jpg" />
											</a>
										<?php endif; ?>
									</div>
									<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
										
								</div>
							</li>
						<?php
						endforeach;
						wp_reset_postdata();
						?>
					</ul>
				</div>
				
				<?php
			}
		}
	}
endif;

/**
	|------------------------------------------------------------------------------
	| Post Render
	|------------------------------------------------------------------------------
	| 
	| @return void
	|
	*/
function blackwhite_lite_post_render() {
	 if ( have_posts() ) : ?>
			<?php if (get_theme_mod('blackwhite_lite_general_layout') != 'grid_post') : ?>
			<div id="post-container" class="post-item-list-view">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<div id="post-container" class="post-item-grid-view clearfix">
				
				<?php /* Start the Loop */ ?>
				<?php
				 	while ( have_posts() ) : the_post(); 
				 ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'grid' );
					?>

				<?php 
					
					endwhile; 
				?>
				
			</div>
		<?php endif; ?>

			<?php blackwhite_lite_the_posts_navigation(); ?>

	<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

	<?php endif;
}

/**
	|------------------------------------------------------------------------------
	| Array Category
	|------------------------------------------------------------------------------
	| 
	| @return array
	|
	*/
function blackwhite_lite_get_category_list() {
	$categories = get_categories();
	$cats = array();
	
	foreach ($categories as $cat) {
		
		$cats[$cat->cat_ID] = $cat->name;
	}

	return $cats;
}

