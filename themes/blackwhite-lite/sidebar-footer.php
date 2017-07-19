<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BlackWhite
 */


	if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' )  ) :
	?>
		<div class="footer-widget">
			<div class="inner clearfix">
				
				<?php if ( is_active_sidebar( 'footer-1' )) : ?>
					<div class="col-4 column-1">
						<?php dynamic_sidebar( 'footer-1' ); ?>			
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' )) : ?>
					<div class="col-4 column-2">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' )) : ?>
					<div class="col-4 column-3">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-4' )) : ?>
					<div class="col-4 last column-4">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
<?php
	endif;

