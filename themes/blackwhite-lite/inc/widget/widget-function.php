<?php
/**
 * Custom Widget Function for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BlackWhite
 */

if ( ! function_exists( 'blackwhite_lite_meta_date' ) ) :
	/**
	 * Displays the post date
	 */
	function blackwhite_lite_meta_date() {

		$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		return '<span class="meta-date">' . $time_string . '</span>';

	}  // blackwhite_lite_meta_date()
endif;

if ( ! function_exists( 'blackwhite_lite_meta_author' ) ) :
	/**
	 * Displays the post author
	 */
	function blackwhite_lite_meta_author() {

		$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'blackwhite-lite' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		return '<span class="meta-author">By ' . $author_string . '</span>';

	} // blackwhite_lite_meta_author()
endif;

if ( ! function_exists( 'blackwhite_lite_more_link' ) ) :
	/**
	 * Displays the more link on posts
	 */
	function blackwhite_lite_more_link() {
		?>

		<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php esc_html_e( 'Read more', 'blackwhite-lite' ); ?></a>

		<?php
	}
endif;

function tc_Magazine_posts_excerpt_length( $length ) {
	return 15;
}
