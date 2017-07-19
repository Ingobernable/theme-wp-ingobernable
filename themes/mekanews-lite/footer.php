<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mekanews_Lite
 */

?>

		</div><!-- .inner -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="inner clearfix">
				<div class="copyright">
					<?php printf( sprintf(__( '&copy;2016 <a href="%s" rel="designer"> MekaNews Lite</a> powered by <a href="http://wordpress.org/">WordPress</a>', 'mekanews-lite' ), 'https://themecountry.com/mekanews-lite/' )); ?>
				</div>			
				<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
					<?php wp_nav_menu( array( 
								'theme_location' => 'footer-menu',
								'menu_id' 		 => 'menu-footer',
								'menu_class' 	 => 'menu-footer',
								'container'      => 'div',
								'container_class' => 'footer-menu-wrapper'
							 ) ); ?>
				<?php endif; ?>
				</div>	
			</div><!-- .inner -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>


<span class="back-to-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></span>
</body>
</html>
