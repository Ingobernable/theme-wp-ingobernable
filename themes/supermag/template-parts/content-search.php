<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage SuperMag
 */
$supermag_customizer_all_values = supermag_get_theme_options();
$supermag_get_image_sizes_options = $supermag_customizer_all_values['supermag-blog-archive-image-layout'];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php supermag_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
	if (
		has_post_thumbnail() &&
		( $supermag_customizer_all_values['supermag-blog-archive-layout'] == 'left-image' ||
		$supermag_customizer_all_values['supermag-blog-archive-layout'] == 'large-image' )
	) {
		?>
		<!--post thumbnal options-->
		<div class="post-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php
				the_post_thumbnail( $supermag_get_image_sizes_options );
				?>
			</a>
		</div><!-- .post-thumb-->
		<?php
	}
	?>

	<div class="entry-summary entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php supermag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

