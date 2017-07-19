<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage SuperMag
 */
$supermag_customizer_all_values = supermag_get_theme_options();
$supermag_get_image_sizes_options = $supermag_customizer_all_values['supermag-blog-archive-image-layout'];
$supermag_blog_archive_category_display_options = $supermag_customizer_all_values['supermag-blog-archive-category-display-options'];
$supermag_blog_archive_read_more = $supermag_customizer_all_values['supermag-blog-archive-more-text'];
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
	$no_fs = '';
	if ( has_post_thumbnail() &&
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
	else{
		$no_fs = 'at-no-fs';
	}
	?>

	<div class="entry-content <?php echo $no_fs;?>">
		<?php
		the_excerpt();
		if( !empty( $supermag_blog_archive_read_more ) ){
		   ?>
            <a class="read-more" href="<?php the_permalink(); ?> ">
				<?php echo esc_html( $supermag_blog_archive_read_more ); ?>
            </a>
        <?php
        }
		?>

	</div><!-- .entry-content -->
    <?php
    $entry_footer = '';
    if( 'cat-color' == $supermag_blog_archive_category_display_options){
        $entry_footer = 'featured-desc';
    }
    ?>
	<footer class="entry-footer <?php echo $entry_footer; ?>">
        <?php
        if( 'cat-color' == $supermag_blog_archive_category_display_options ){
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
