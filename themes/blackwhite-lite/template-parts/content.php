<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BlackWhite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-item clearfix'); ?>>

	<div class="post-thumbnail">
		<a href="<?php the_permalink() ?>" rel="bookmark" class="featured-thumbnail">
			<?php if ( has_post_thumbnail() ) : ?>
				
				<?php the_post_thumbnail();  ?>

			<?php else : ?>
				
				<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured-3col.jpg" />
			
			<?php endif; ?>
		</a>
	</div><!-- .post-thumbnail -->
	
	<div class="post-content">
		<header class="entry-header">

			<?php blackwhite_lite_meta_category(); ?>
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
					
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blackwhite-lite' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php blackwhite_lite_posted_on() ?>				
				<?php blackwhite_lite_entry_footer() ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</div><!-- .post-content -->
</article><!-- #post-## -->
