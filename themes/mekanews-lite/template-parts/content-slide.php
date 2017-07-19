<?php
/**
 * Template part for displaying slide.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mekanews_Lite
 */

?>
<?php 
	$args = array( 
		'posts_per_page' 	=> 10
	);
	$slide_posts = new WP_Query( $args );

	if ( $slide_posts->have_posts() ) :
?>
	<div class="section-slide loading">
		<div id="slider" class="owl-carousel">
			<?php if ( have_posts() ) : ?>
				<?php 
				while ($slide_posts->have_posts() ) : $slide_posts->the_post();
						if (has_post_thumbnail()) :						
						?>
								<div class="item">
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail('mekanews-lite-banner-thumbnails') ?>
									</a>
									<!-- modified date when last edited -->
									<?php $modified_time = get_post_modified_time('F j, Y', null, $slide_posts->ID ); ?>

									<span class="date"><?php echo $modified_time; ?></span>
									<p class="flex-caption">
										<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
									</p>					  
								</div>

						<?php 
							endif;
				endwhile; 
						?>

		<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	</div>



	<div id="controlNav" class="owl-carousel">
		<?php if ( have_posts() ) : ?>
				<?php 
				while ($slide_posts->have_posts() ) : $slide_posts->the_post();
					if (has_post_thumbnail()) :								
							?>
						<div class="item">
							<?php the_post_thumbnail('mekanews-lite-banner-thumbnails-list') ?>
						</div>

						<?php 
					endif;
				endwhile; 
					?>
			<?php endif; ?>
	<?php wp_reset_postdata(); ?>					
	<!-- items mirrored twice, total of 12 -->
	</div>
</div>

<?php 
endif;
wp_reset_postdata();
?>