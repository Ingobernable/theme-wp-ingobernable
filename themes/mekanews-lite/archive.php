<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mekanews_Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
			if ( have_posts() ) : ?>
			
			<div class="post-wrap clearfix">

				<?php
				$theme_options = mekanews_lite_theme_options();
				$post_format = $theme_options['layout_post'] == 'grid' ? 'grid' :  get_post_format();
				/* Start the Loop */				
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', $post_format );

				endwhile;

				?>
			</div>

			<?php

				mekanews_lite_paging_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
