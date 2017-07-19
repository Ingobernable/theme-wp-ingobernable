<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage SuperMag
 */

$supermag_customizer_all_values = supermag_get_theme_options();
$supermag_single_image_layout = $supermag_customizer_all_values['supermag-single-image-layout'];
$supermag_single_category_display_options = $supermag_customizer_all_values['supermag-single-category-display-options'];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php supermag_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<!--post thumbnal options-->
	<?php
	if ( has_post_thumbnail() &&
		( $supermag_customizer_all_values['supermag-single-post-layout'] == 'left-image' ||
			$supermag_customizer_all_values['supermag-single-post-layout'] == 'large-image' )
	){
		?>
		<div class="single-feat clearfix">
			<figure class="single-thumb single-thumb-full">
				<?php the_post_thumbnail( $supermag_single_image_layout );?>
			</figure>
		</div><!-- .single-feat-->
	<?php
	}
	?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supermag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer featured-desc">
		<?php
		if( 'cat-color' == $supermag_single_category_display_options){
			?>
            <div class="below-entry-meta">
				<?php supermag_list_category(); ?>
            </div>
			<?php
		}
		else{
			supermag_entry_footer();
		}
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

