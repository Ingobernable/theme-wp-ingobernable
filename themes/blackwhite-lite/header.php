<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BlackWhite
 */
$blackwhite_lite_theme_options = blackwhite_lite_theme_options();

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site-container">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'blackwhite-lite' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		
		<div class="inner clearfix">
			<div class="header-container col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
				<div class="site-branding">
								
					<?php blackwhite_lite_header_title() ?>
					
				</div><!-- site-branding -->

				<?php if ( is_active_sidebar( 'header-widget' )) : ?>
					<div class="ads-728x90 ads-top">
						<?php dynamic_sidebar( 'header-widget' ); ?>			
					</div>
				<?php endif; ?>
				
			</div><!-- header-container -->

		</div><!-- inner -->
		
		<?php if( has_nav_menu('primary'))  : ?>
			
			<div <?php if ( $blackwhite_lite_theme_options['sticky_header'] == 1 ) { ?> id="sticky"<?php } ?> class="menu-container">
				<div class="inner clearfix">
					<nav id="site-navigation" class="secondary-navigation col-xs-12 col-sm-12 col-md-12 col-lg-12" role="navigation">
						<span class="mobile-only mobile-menu menu-toggle" aria-controls="menu-main-menu" aria-expanded="false">Menu</span>
					
						<?php
						wp_nav_menu( array( 
							'theme_location' 	=> 'primary',
							'menu_id' 		 	=> 'menu-main-menu',
							'menu_class' 	 	=> 'secondary-menu',
							'container'			=> '',
						) );
						?>
						
					</nav><!-- #site-navigation -->						
				</div><!-- inner -->
			</div>

			<div id="catcher"></div>

		<?php else : ?>

			<div <?php if ( $blackwhite_lite_theme_options['sticky_header'] == 1 ) { ?> id="sticky"<?php } ?> class="menu-container">
				
				<div class="inner clearfix">
					<nav id="site-navigation" class="secondary-navigation col-xs-12 col-sm-12 col-md-12 col-lg-12" role="navigation">
						
						<span class="mobile-only mobile-menu menu-toggle" aria-controls="menu-main-menu" aria-expanded="false">Menu</span>
						
						<?php wp_nav_menu( array(
							'theme_location' 	=> 'primary',
							'menu_id' 		 	=> 'menu-main-menu',
							'menu_class' 	 	=> 'secondary-menu',
							'container'			=> false
						) ); ?>

					</nav><!-- #site-navigation -->						
				</div><!-- inner -->
			</div>
		<?php endif; ?>			

	</header><!-- #masthead -->
	
	<div id="content" class="site-content">
		<div class="inner clearfix">