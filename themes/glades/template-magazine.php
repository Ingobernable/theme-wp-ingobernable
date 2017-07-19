<?php
/*
Template Name: Magazine Homepage
*/
?>
<?php get_header(); ?>
	
	<div id="wrap" class="container clearfix template-magazine">
	
		<?php // Get Theme Options from Database
		$theme_options = glades_theme_options();
				
		// Display Featured Posts on homepage
		if ( glades_has_featured_content() ) :
			
			// Include the featured content template.
			get_template_part( 'featured-content' );
			
		endif;
	?>
	
		<section id="content" class="primary" role="main">
		
		<?php if ( function_exists( 'themezee_breadcrumbs' ) ) themezee_breadcrumbs(); ?>
			
		<?php // Display Magazine Homepage Widgets
		if( is_active_sidebar('magazine-homepage') ) : ?>

			<div id="magazine-homepage-widgets" class="clearfix">

				<?php dynamic_sidebar('magazine-homepage'); ?>

			</div>

		<?php // Display Description about Magazine Homepage Widgets when widget area is empty
		else : 
		
			// Display only to users with permission
			if ( current_user_can( 'edit_theme_options' ) ) : ?>

				<p class="magazine-homepage-no-widgets">
					<?php esc_html_e( 'Please go to Appearance &#8594; Widgets and add at least one widget to the "Magazine Homepage" widget area. You can use the Category Posts widgets to set up the theme like the demo website.', 'glades' ); ?>
				</p>
				
			<?php endif;

		endif; ?>

		</section>
		
		<?php get_sidebar(); ?>
	
	</div>
	
<?php get_footer(); ?>