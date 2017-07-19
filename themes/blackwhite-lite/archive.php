<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BlackWhite
 */

get_header(); ?>

	<div id="primary" class="content-area content-left col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<main id="main" class="site-main" role="main">

		<?php
			if ( have_posts() ) : ?>
			
			<header class="wrap-header title-container">
				<?php
					the_archive_title( '<h1 class="default-header-title">', '</h1>' );		
				?>
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
				
			</div><!-- post-wrap -->

			<?php

				blackwhite_lite_paging_nav();

			else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
