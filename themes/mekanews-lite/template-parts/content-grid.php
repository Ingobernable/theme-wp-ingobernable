<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mekanews_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid clearfix'); ?>>
	<div class="post-thumbnail">
		<a href="<?php the_permalink() ?>" rel="bookmark">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php else : ?>
			<img src="<?php echo esc_url ( get_template_directory_uri() ); ?>/images/post-thumbnails-grid.jpg" />
		<?php endif; ?>
		</a>
	</div><!-- .post-thumbnail -->
	<div class="post-content">
		<header class="entry-header">
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php mekanews_lite_posted_on() ?>				
				<?php mekanews_lite_entry_footer() ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				
				the_excerpt();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mekanews-lite' ),
					'after'  => '</div>',
				) );
			?>

		</div><!-- .entry-content -->
	</div><!-- .post-content -->
</article><!-- #post-## -->
