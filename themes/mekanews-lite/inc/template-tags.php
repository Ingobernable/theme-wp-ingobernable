<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mekanews_Lite
 */


if ( ! function_exists('mekanews_lite_header_title') ) :
	function mekanews_lite_header_title() {

		$logo = get_theme_mod('custom_logo');

		?>
			<?php if ( !empty($logo) ) : ?>
				<div class="site-title logo">		
					<?php if( (is_front_page() || is_home()) && function_exists( 'the_custom_logo' ) ) : ?>
					<h1 class="site-title logo" itemprop="headline">
						<?php  the_custom_logo() ?>
					</h1>				
					<?php else : ?>
						<?php if ( function_exists( 'the_custom_logo' ) ): ?>		
							<h2 class="image-logo" itemprop="headline">
								<?php

	      							the_custom_logo();

								?>
							</h2>
						<?php endif; ?>
			
				<?php endif ?>
				</div>
			<?php else : ?>	
				<div class="site-title">			
					<?php if( is_front_page() || is_home() ) : ?>
						<h1 class="title-logo" itemprop="headline" class="site-title">
							<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr(get_bloginfo( 'description' )); ?>">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
						<h2 class="title-description"><?php bloginfo( 'description' ); ?></h2>
				<?php else : ?>
						<h2 class="title-logo">
							<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr(get_bloginfo( 'description' )); ?>">
							<?php bloginfo( 'name' ); ?>
							</a>
						</h2>
						<h3 class="title-description"><?php bloginfo( 'description' ); ?></h3>
					<?php endif ?>
				</div>
			<?php endif ?>
		<?php
	}
endif;



if ( ! function_exists( 'mekanews_lite_related_posted_on' ) ) :

function mekanews_lite_related_posted_on($post_id) {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {

		$time_string = '<time class="entry-date published" datetime="%4$s">%4$s</time>';

	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('', $post_id) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date('', $post_id) )
	);

	$posted_on = sprintf(
		esc_html_x( '%s ', 'post date', 'mekanews-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo $posted_on;
}

endif;

if ( ! function_exists( 'mekanews_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mekanews_lite_posted_on() {

	$theme_options = mekanews_lite_theme_options();

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%4$s">%4$s</time>';
		//$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s ', 'post date', 'mekanews-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'mekanews-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);	

	if($theme_options['meta_author'] == 1 ) {
		echo '<span class="byline"><i class="fa fa-user" aria-hidden="true"></i>' . $byline . '</span>'; // WPCS: XSS OK.
	}

	if($theme_options['meta_date'] == 1 ) { 
			echo '<span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i>' . $posted_on . '</span>';
	}

}
endif;

if ( ! function_exists( 'mekanews_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function mekanews_lite_entry_footer() {
	if( is_single() ) {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'mekanews-lite' ) );
			if ( $categories_list && mekanews_lite_categorized_blog() ) {
				printf( '<span class="cat-links"><i class="fa fa-archive"></i>' . esc_html__( '%1$s', 'mekanews-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'mekanews-lite' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links"><i class="fa fa-tags"></i>' . esc_html__( 'Tagged %1$s', 'mekanews-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comment" aria-hidden="true"></i>';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'mekanews-lite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'mekanews-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'mekanews_lite_meta_category' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function mekanews_lite_meta_category() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'mekanews-lite' ) );
		if ( $categories_list && mekanews_lite_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'mekanews-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mekanews_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mekanews_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mekanews_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mekanews_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mekanews_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mekanews_lite_categorized_blog.
 */
function mekanews_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'mekanews_lite_categories' );
}
add_action( 'edit_category', 'mekanews_lite_category_transient_flusher' );
add_action( 'save_post',     'mekanews_lite_category_transient_flusher' );

if ( ! function_exists( 'mekanews_lite_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function mekanews_lite_paging_nav() {
	

	$theme_options = mekanews_lite_theme_options();

	$nav_style =  $theme_options['paging'];

	if  ( $nav_style == 'pageing-numberal') :
		// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( '<i class="fa fa-angle-left"></i>', 'mekanews-lite' ),
				'next_text'          => __( '<i class="fa fa-angle-right"></i>', 'mekanews-lite' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mekanews-lite' ) . ' </span>',
			) );
	else :

		$args = array(
			'prev_text'          => __( '<i class="fa fa-angle-left"></i> Previous', 'mekanews-lite' ),
			'next_text'          => __( 'Next <span class="meta-nav"><i class="fa fa-angle-right"></i>', 'mekanews-lite' ),
		);

	  the_posts_navigation( $args );

	endif;
}
endif;