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
 * @package Mekanews_Lite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php mekanews_lite_slideshow(); ?>
			
			<?php if ( ! is_paged() ) : ?>
			<h2 class="lastest-title"><?php _e('Latest Post', 'mekanews-lite'); ?></h2>
		<?php endif; ?>

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
