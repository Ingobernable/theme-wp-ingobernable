<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BlackWhite
 */

if ( ! function_exists('blackwhite_lite_header_title') ) :
/**
 |------------------------------------------------------------------------------
 | Logo Section
 |------------------------------------------------------------------------------
 */
	function blackwhite_lite_header_title() {

		$output = '';
		$description = get_bloginfo( 'description', 'display' );

		if ( function_exists( 'has_custom_logo' ) && has_custom_logo()  ) {
			$output = sprintf('<h1 class="site-title logo" itemprop="headline"> %s </h1>', get_custom_logo() ); ?>
		<?php
		} else {
			if ( is_front_page() || is_home() ) { ?>
				<?php $output = sprintf( '<div class="site-title"><h1 class="title-logo"><a href=" %s " rel="home" title="'. $description .'" > %s </a></h1><h2 class="title-description">'. $description .'</h2></div>', esc_url( home_url('/') ), get_bloginfo('name') ); ?>
			<?php
			} else {
			?>
				<?php $output = sprintf( '<div class="site-title"><h2 class="title-logo"><a href="%s" rel="home" title="'. $description .'" > %s </a></h2><h3 class="title-description">'. $description .'</h3></div>', esc_url( home_url('/') ), get_bloginfo('name') ); ?>
			<?php
			}
		}

	echo $output;
	}
endif;

if ( ! function_exists( 'blackwhite_lite_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function blackwhite_lite_entry_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( ' %s', 'post date', 'blackwhite-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( ' %s', 'post author', 'blackwhite-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"><i class="fa fa-user" aria-hidden="true"></i>' . $byline . '</span>';

	echo '<span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.



	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(', ');
		if ( $categories_list && blackwhite_lite_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-file" aria-hidden="true"></i>  %1$s</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tags" aria-hidden="true"></i>  %1$s</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'blackwhite-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


if ( ! function_exists( 'blackwhite_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function blackwhite_lite_posted_on() {


	$blackwhite_lite_theme_options = blackwhite_lite_theme_options();

	$meta_items = array_flip($blackwhite_lite_theme_options['post_meta_info']);

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

	$posted_on = sprintf('<a href="%s" rel="bookmark">%s</a>', esc_url( get_permalink() ),  $time_string);
	
	$byline = sprintf('<span class="author vcard"><a class="url fn n" href="%s">%s</a></a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) );


	
	echo '<span class="byline"><i class="fa fa-user"></i>' .  esc_html__( 'By ', 'blackwhite-lite' ) .  $byline . '</span>';
	
	echo '<span class="posted-on"><i class="fa fa-calendar"></i>' . $posted_on . '</span>';
	

}
endif;

if ( ! function_exists( 'blackwhite_lite_primary_category' ) ) {
	function blackwhite_lite_primary_category() {
		
		$firstCategory = get_the_category_list( esc_html__( ', ', 'blackwhite-lite' ) );
		
		echo $firstCategory;
	}
}


if ( ! function_exists( 'blackwhite_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function blackwhite_lite_entry_footer() {
	$theme_options = blackwhite_lite_theme_options();
	$meta_items = array_flip($theme_options['post_meta_info']);


	if ( is_single() ) {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			if ( isset( $meta_items['meta-cat'] ) ) :

				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list(',');
				if ( $categories_list && blackwhite_lite_categorized_blog() ) {
					printf( '<span class="cat-links"><i class="fa fa-archive"></i> %1$s</span>', $categories_list ); // WPCS: XSS OK.
				}

			endif;

			if ( isset( $meta_items['meta-tag'] ) ) :

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'blackwhite-lite' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links"><i class="fa fa-tags"></i> %1$s</span>', $tags_list ); // WPCS: XSS OK.
				}

			endif;
		}
	}

	if ( isset( $meta_items['meta-comment'] ) ) :

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="fa fa-comment-o" aria-hidden="true"></i>';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( '0 <span class="screen-reader-text"> on %s</span>', 'blackwhite-lite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

	endif;

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'blackwhite-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'blackwhite_lite_meta_category' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function blackwhite_lite_meta_category() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ', ');
		if ( $categories_list && blackwhite_lite_categorized_blog() ) {
			printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
	
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function blackwhite_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'blackwhite_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'blackwhite_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so blackwhite_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so blackwhite_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in blackwhite_lite_categorized_blog.
 */
function blackwhite_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'blackwhite_lite_categories' );
}
add_action( 'edit_category', 'blackwhite_lite_category_transient_flusher' );
add_action( 'save_post',     'blackwhite_lite_category_transient_flusher' );

if ( ! function_exists( 'blackwhite_lite_footer_copyright' ) ) :

	function blackwhite_lite_footer_copyright() {
		

		printf( __( '<a href="%s" rel="designer">BlackWhite Lite</a> powered by <a href="http://wordpress.org/">WordPress</a>', 'blackwhite-lite' ),  'https://themecountry.com/blackwhite-lite/');
 
	}

endif;

if ( ! function_exists( 'blackwhite_lite_the_posts_navigation' ) ) :
/**
 |------------------------------------------------------------------------------
 | Display navigation to next/previous set of posts when applicable.
 |------------------------------------------------------------------------------
 |
 | @todo Remove this function when WordPress 4.3 is released.
 |
 */
function blackwhite_lite_the_posts_navigation() {
	
	$theme_options = blackwhite_lite_theme_options();
	$nav_style = $theme_options['paging'];

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	if  ( $nav_style == 'paging-numberal') :
		echo '<div class="content-pagination">';
			the_posts_pagination( array(
				'prev_text'          => __( '<i class="fa fa-angle-left"></i>', 'blackwhite-lite' ),
				'next_text'          => __( '<i class="fa fa-angle-right"></i>', 'blackwhite-lite' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'blackwhite-lite' ) . ' </span>',
			) );
		echo '</div>';
	else :
	?>

	<nav class="navigation post-navigation clearfix" role="navigation">
		<span class="screen-reader-text">
			<?php _e( 'Posts navigation', 'blackwhite-lite' ); ?>
		</span>

		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous">
					<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'blackwhite-lite' ) ); ?>
				</div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next">
					<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'blackwhite-lite' ) ); ?>
				</div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->

	<?php
		endif;
	}
endif;

if ( ! function_exists( 'blackwhite_lite_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function blackwhite_lite_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$theme_options = blackwhite_lite_theme_options();
	$nav_style = $theme_options['paging'];

	if ( $nav_style == 'paging-numberal') :
		
		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => __( '<i class="fa fa-angle-left"></i>', 'blackwhite-lite' ),
			'next_text'          => __( '<i class="fa fa-angle-right"></i>', 'blackwhite-lite' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'blackwhite-lite' ) . ' </span>',
		) );

	else :
	?>

	<nav class="post-navigation clearfix" role="navigation">
		<span class="screen-reader-text"><?php _e( 'Posts navigation', 'blackwhite-lite' ); ?></span>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Previous', 'blackwhite-lite' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav"></span>', 'blackwhite-lite' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->

	<?php
	endif;
}
endif;

if ( ! function_exists( 'blackwhite_lite_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function blackwhite_lite_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="post-navigation clearfix" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'blackwhite-lite' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '%title', 'Previous post link', 'blackwhite-lite' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title', 'Next post link',     'blackwhite-lite' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;