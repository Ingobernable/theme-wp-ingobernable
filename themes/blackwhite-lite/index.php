<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BlackWhite
 */


get_header(); ?>

	<div id="primary" class="content-area content-left col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :
			?>

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

get_sidebar();

get_footer();
