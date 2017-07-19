<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mekanews_Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site-container">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'mekanews-lite' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<?php if ( has_nav_menu( 'top-menu' ) || has_nav_menu( 'social-menu' ) ) : ?>			
				<div class="top-bar">
					<div class="inner clearfix">
						<div class="left-top-nav primary-navigation">
							<?php if ( has_nav_menu( 'top-menu' ) ) : ?>
															
								<?php wp_nav_menu( array( 
										'theme_location' => 'top-menu',
										'menu_id' => 'top-menu',
										'menu_class' => 'top-menu',
										'container'      => ''								
									 ) ); ?>

								<?php endif; ?>

						</div><!-- primary-navigation -->
						<div class="top-nav-right">
							<div class="top-search">
							 	<a id="trigger-overlay">
							 		<i class="fa fa-search"></i>
							 	</a>
							 	<div class="overlay overlay-slideleft">
							 		<div class="search-row">
							 			<a ahref="#" class="overlay-close"><i class="fa fa-times"></i></a>
										<form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" _lpchecked="1">
										<input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_html_e('Search ...', 'mekanews-lite'); ?>" />
										</form>
							 		</div>							 		
							 	</div>
							</div><!-- .top-search -->							

						</div><!-- .top-nav-left -->						

					</div><!-- inner -->
				</div><!-- top-bar -->
		<?php endif; ?>

		<div class="site-branding">
			<div class="inner clearfix">				
				<?php mekanews_lite_header_title() ?>
				<?php //mekanews_lite_ads_header() ?>
				<?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
					<div class="ads-728x90 ads-top">
						<?php dynamic_sidebar( 'header-widget' ); ?>
					</div>
				<?php endif; ?>
						
			</div><!-- inner -->
		</div><!-- site-branding -->
		
		<?php if( has_nav_menu('primary'))  : ?>
			
				<div class="menu-container">
					<div class="inner clearfix">
						<nav id="site-navigation" class="secondary-navigation" role="navigation">
							<span class="mobile-only mobile-menu menu-toggle" aria-controls="menu-main-menu" aria-expanded="false">Menu</span>
						
							<?php wp_nav_menu( array( 
											'theme_location' => 'primary',
											'menu_id' => 'menu-main-menu',
											'container'      => '',
											

							) ); ?>
							
						</nav><!-- #site-navigation -->						
					</div><!-- inner -->
				</div>
				<div id="catcher"></div>
		<?php endif; ?>				
		

	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="inner clearfix">
