<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mekanews_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-item clearfix'); ?>>

	<div class="post-thumbnail">
		<a href="<?php the_permalink() ?>" rel="bookmark" class="featured-thumbnail">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('mekanews-lite-post-thumbnails-list');  ?>
		<?php else : ?>
			<img src="<?php echo get_template_directory_uri(); ?>/images/post-thumbnails-list.png" />
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

				<a class="btn-read-more" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><span><?php _e('Read more','mekanews-lite'); ?></span></a>
		</div><!-- .entry-content -->
	</div><!-- .post-content -->
</article><!-- #post-## -->
