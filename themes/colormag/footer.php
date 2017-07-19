<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #main div.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
?>

		</div><!-- .inner-wrap -->
	</div><!-- #main -->
   <?php if ( is_active_sidebar('colormag_advertisement_above_the_footer_sidebar') ) { ?>
      <div class="advertisement_above_footer">
         <div class="inner-wrap">
            <?php dynamic_sidebar('colormag_advertisement_above_the_footer_sidebar'); ?>
         </div>
      </div>
   <?php } ?>
	<?php do_action( 'colormag_before_footer' ); ?>
		<footer id="colophon" class="clearfix">
			<?php get_sidebar( 'footer' ); ?>
			<div class="footer-socket-wrapper clearfix">
				<div class="inner-wrap">
					<div class="footer-socket-area">
                  <div class="footer-socket-right-section">
   						<?php if( get_theme_mod( 'colormag_social_link_activate', 0 ) == 1 ) { colormag_social_links(); } ?>
                  </div>
                  <div class="footer-socket-left-sectoin">
   						<div class="copyright">
							Copyright © 2017 La Ingobernable. Licencia CC Reconocimiento 4.0
Internacional
						</div>
                  </div>
					</div>
				</div>
			</div>
		</footer>
		<a href="#masthead" id="scroll-up"><i class="fa fa-chevron-up"></i></a>
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>