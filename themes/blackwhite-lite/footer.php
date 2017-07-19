<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BlackWhite
 */
$blackwhite_lite_theme_options = blackwhite_lite_theme_options();
	?>
		</div><!-- .inner -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<?php get_sidebar('footer'); ?>
		
		<?php if ( has_nav_menu( 'footer-menu' ) || has_nav_menu( 'social-menu' ) ) : ?>
			<div class="wrap-footer-menu <?php if ( ! ( has_nav_menu( 'footer-menu' ) && has_nav_menu( 'social-menu' ) ) ) : ?>custom-menu-foot<?php endif; ?>">
				<div class="inner clearfix">
					<?php if ( has_nav_menu( 'footer-menu' ) ) :
				 		wp_nav_menu( array( 
							'theme_location' => 'footer-menu',
							'menu_id' 		 => 'menu-footer',
							'menu_class' 	 => 'menu-footer',
							'container'      => 'div',
							'container_class' => 'f-menu'
						) ); 
					endif; ?>

				</div>			
			</div>

		<?php endif; ?>

		<div class="site-info">
			<div class="inner clearfix">
				<div class="copyright">

					<?php blackwhite_lite_footer_copyright() ?>

				</div>
			</div><!-- .inner -->
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( $blackwhite_lite_theme_options['back_to_top'] == 1 )  : ?>
	<span class="back-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></span>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
