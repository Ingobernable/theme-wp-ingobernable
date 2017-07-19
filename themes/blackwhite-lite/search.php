<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package BlackWhite
 */
$blackwhite_lite_theme_options = blackwhite_lite_theme_options();

get_header(); ?>

	<div id="primary" class="content-area content-left col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<main id="main" class="site-main" role="main">

		<?php
			if ( have_posts() ) : ?>

			<header class="wrap-header title-container">
				<h1 class="search-page-title default-header-title">
					<?php printf( __( 'Search Results for: %s', 'blackwhite-lite' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			</header><!-- .page-header -->

			<div class="post-wrap clearfix">
				
				<?php
				/* Start the Loop */				
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile;
				?>

			</div>

			<?php

		 		blackwhite_lite_paging_nav();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			<div class="infinite-scroll clearfix">
				<div class="la-ball-spin-clockwise la-dark la-2x">
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( $blackwhite_lite_theme_options['layout'] != 'no-sidebar' ) {
	get_sidebar();
}
get_footer();
