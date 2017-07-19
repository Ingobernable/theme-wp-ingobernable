<?php
/**
 * Magazine Functions
 *
 * Custom Functions and Template tags used in the Magazine widgets and Magazine templates
 *
 * @package Napoli
 */


/**
* Displays Magazine widget area
*/
function napoli_magazine_widgets() {

	// Only display on first page of blog.
	if ( is_home() && is_paged() ) {
		return;
	}

	// Check if there are widgets in Magazine sidebar.
	if ( is_active_sidebar( 'magazine-homepage' ) ) : ?>

		<div id="magazine-homepage-widgets" class="widget-area clearfix">

			<?php dynamic_sidebar( 'magazine-homepage' ); ?>

		</div><!-- #magazine-homepage-widgets -->

	<?php
	elseif ( is_customize_preview() ) :

		// Display Magazine Widget Placeholder in Customizer.
		napoli_customize_magazine_placeholder();

	elseif ( is_page_template( 'template-magazine.php' ) && current_user_can( 'edit_theme_options' ) ) :

		echo '<p class="empty-widget-area">';
		esc_html_e( 'Please go to Customize &#8594; Widgets and add at least one widget to the Magazine Homepage widget area.', 'napoli' );
		echo '</p>';

	endif;
}


if ( ! function_exists( 'napoli_magazine_widget_title' ) ) :
	/**
	 * Displays the widget title with link to the category archive
	 *
	 * @param String $widget_title Widget Title.
	 * @param int    $category_id  Category ID.
	 * @return String Widget Title
	 */
	function napoli_magazine_widget_title( $widget_title, $category_id ) {

		// Check if widget shows a specific category.
		if ( $category_id > 0 ) {

			// Set URL and Title for Category.
			$category_title = sprintf( esc_html__( 'View all posts from category %s', 'napoli' ), get_cat_name( $category_id ) );
			$category_url = get_category_link( $category_id );

			// Set Widget Title with link to category archive.
			$widget_title = '<a class="category-archive-link" href="' . esc_url( $category_url ) . '" title="' . esc_attr( $category_title ) . '">' . $widget_title . '</a>';
		}

		return $widget_title;
	}
endif;


/**
* Get Magazine Post IDs
*
* @param String $cache_id        Magazine Widget Instance.
* @param int    $category        Category ID.
* @param int    $number_of_posts Number of posts.
* @return array Post IDs
*/
function napoli_get_magazine_post_ids( $cache_id, $category, $number_of_posts ) {

	$cache_id = sanitize_key( $cache_id );
	$post_ids = get_transient( 'napoli_magazine_post_ids' );

	if ( ! isset( $post_ids[ $cache_id ] ) || is_customize_preview() ) {

		// Get Posts from Database.
		$query_arguments = array(
			'fields'              => 'ids',
			'cat'                 => (int) $category,
			'posts_per_page'      => (int) $number_of_posts,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);
		$query = new WP_Query( $query_arguments );

		// Create an array of all post ids.
		$post_ids[ $cache_id ] = $query->posts;

		// Set Transient.
		set_transient( 'napoli_magazine_post_ids', $post_ids );
	}

	return apply_filters( 'napoli_magazine_post_ids', $post_ids[ $cache_id ], $cache_id );
}


/**
* Delete Cached Post IDs
*
* @return void
*/
function napoli_flush_magazine_post_ids() {
	delete_transient( 'napoli_magazine_post_ids' );
}
add_action( 'save_post', 'napoli_flush_magazine_post_ids' );
add_action( 'deleted_post', 'napoli_flush_magazine_post_ids' );
add_action( 'customize_save_after', 'napoli_flush_magazine_post_ids' );
add_action( 'switch_theme', 'napoli_flush_magazine_post_ids' );
