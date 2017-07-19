<?php
/***
 * Top Header Content
 *
 * This template displays the content in the right-hand header area based on theme options.
 *
 */

	// Get Theme Options from Database
	$theme_options = leeway_theme_options();

?>

	<div id="topheader" class="clearfix">

		<?php // Display Social Icons in Navigation
			if ( isset($theme_options['header_icons']) and $theme_options['header_icons'] == true ) : ?>

			<div id="navi-social-icons" class="social-icons-wrap clearfix">
				<?php leeway_display_social_icons(); ?>
			</div>

		<?php endif;

		// Display Top Navigation Menu
		if ( has_nav_menu( 'secondary' ) ) : ?>

		<nav id="topnav" class="clearfix" role="navigation">
			<?php // Display Top Navigation
				wp_nav_menu( array(
					'theme_location' => 'secondary',
					'container' => false,
					'menu_id' => 'topnav-menu',
					'menu_class' => 'top-navigation-menu',
					'echo' => true,
					'fallback_cb' => 'leeway_default_menu')
				);
			?>
		</nav>

		<?php endif; ?>

	</div>