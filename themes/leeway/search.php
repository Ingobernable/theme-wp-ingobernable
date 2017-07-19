<?php get_header(); ?>

<?php // Get Theme Options from Database
	$theme_options = leeway_theme_options();
?>

	<div id="wrap" class="clearfix">
		
		<section id="content" class="primary" role="main">
		
			<?php // Display breadcrumbs or archive title
			if ( function_exists( 'themezee_breadcrumbs' ) ) :

				themezee_breadcrumbs(); 
				
			else : ?>
			
				<header class="page-header">
					<h1 id="search-title" class="archive-title">
						<?php printf( esc_html__( 'Search Results for: %s', 'leeway' ), '<span>' . get_search_query() . '</span>' ); ?>
					</h1>
				</header>
			
			<?php
			endif;
			
			if (have_posts()) : while (have_posts()) : the_post();
		
				if ( 'post' == get_post_type() ) :
		
					get_template_part( 'content', $theme_options['posts_length'] );
				
				else :
				
					get_template_part( 'content', 'search' );
					
				endif;
		
			endwhile;
			
			leeway_display_pagination();

		else : ?>

			<div class="type-page">
				
				<h2 class="page-title entry-title"><?php esc_html_e( 'No matches', 'leeway' ); ?></h2>
				
				<div class="entry clearfix">
					
					<p><?php esc_html_e( 'Please try again, or use the navigation menus to find what you search for.', 'leeway' ); ?></p>
					
					<?php get_search_form(); ?>
					
				</div>
				
			</div>

		<?php endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>