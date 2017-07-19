<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BlackWhite
 */

get_header(); ?>

	<div id="primary" class="content-area content-left col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'blackwhite-lite' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try to search?', 'blackwhite-lite' ); ?></p>

					<?php
						get_search_form();					

						// Only show the widget if site has multiple categories.
					
					?>				

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( $blackwhite_lite_theme_options['layout'] != 'no-sidebar' ) {
	get_sidebar();
}
get_footer();
