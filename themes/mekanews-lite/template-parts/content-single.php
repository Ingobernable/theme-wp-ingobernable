<?php
/**
 * Template part for displaying content single.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mekanews_Lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
	<div class="post-thumbnail">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('mekanews-lite-single-thumbnails'); ?>
		<?php else : ?>
			<img src="<?php echo get_template_directory_uri(); ?>/images/single-thumbnails.jpg" />
		<?php endif; ?>
	</div><!-- .post-thumbnail -->
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title single-title">', '</h1>' );

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
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mekanews-lite' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mekanews-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
