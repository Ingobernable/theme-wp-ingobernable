		
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		
		<div class="entry-meta postmeta clearfix"><?php glades_display_postmeta(); ?></div>
		
		<?php glades_display_thumbnail_index(); ?>
		
		<div class="entry clearfix">
			<?php the_content( esc_html__( 'Continue reading &raquo;', 'glades' )); ?>
			<div class="page-links"><?php wp_link_pages(); ?></div>
		</div>

	</article>