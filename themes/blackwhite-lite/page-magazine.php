<?php
/**
 * Template Name: Magazine Homepage
 *
 * @package BlackWhite
 */

get_header(); ?>

	<?php // Display Magazine Homepage Widgets.
	if ( is_active_sidebar( 'feature-homepage' ) ) : ?>

		<div id="magazine-homepage-featured" class="widget-area clearfix col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<?php dynamic_sidebar( 'feature-homepage' ); ?>

		</div><!-- #magazine-homepage-widgets -->

	<?php
	endif;
	?>

	<div id="primary" class="content-area content-left col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<main id="main" class="site-main" role="main">
			
			<?php
				//blackwhite_lite_ads_bellow_slideshow();

			if ( is_active_sidebar( 'magazine-homepage' ) ) :
			?>

				<div id="magazine-homepage-widgets" class="widget-area clearfix">

					<?php dynamic_sidebar( 'magazine-homepage' ); ?>

				</div><!-- #magazine-homepage-widgets -->

			<?php // Display Description about Magazine Homepage Widgets when widget area is empty.
			else :

				// Display only to users with permission.
				if ( current_user_can( 'edit_theme_options' ) ) : ?>

					<p class="empty-widget-area">
						<?php esc_html_e( 'Please go to Appearance &#8594; Widgets and add at least one widget to the "Magazine Homepage" widget area. You can use the Magazine Posts widgets to set up the theme like the demo website.', 'blackwhite-lite' ); ?>
					</p>

				<?php endif;

			endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
