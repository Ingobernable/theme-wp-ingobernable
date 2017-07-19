<!DOCTYPE html>
<html  <?php language_attributes(); ?>>
<head>
<?php 
global  $wdwt_front; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="viewport" content="initial-scale=1.0" />
<meta name="HandheldFriendly" content="true"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php  wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
$show_facebook_icon = $wdwt_front->get_param('show_facebook_icon');
$facebook_url = $wdwt_front->get_param('facebook_url');
$show_twitter_icon = $wdwt_front->get_param('show_twitter_icon');
$twitter_url = $wdwt_front->get_param('twitter_url');
$show_google_icon = $wdwt_front->get_param('show_google_icon');
$google_url = $wdwt_front->get_param('google_url');
$show_rss_icon = $wdwt_front->get_param('show_rss_icon');
$rss_url = $wdwt_front->get_param('rss_url');

$show_youtube_icon = $wdwt_front->get_param('show_youtube_icon');
$youtube_url = $wdwt_front->get_param('youtube_url');
$show_instagram_icon = $wdwt_front->get_param('show_instagram_icon');
$instagram_url = $wdwt_front->get_param('instagram_url');
$show_linkedin_icon = $wdwt_front->get_param('show_linkedin_icon');
$linkedin_url = $wdwt_front->get_param('linkedin_url');
$show_pinterest_icon = $wdwt_front->get_param('show_pinterest_icon');
$pinterest_url = $wdwt_front->get_param('pinterest_url');

$logo_img = $wdwt_front->get_param('logo_img');
$header_image = get_header_image();
$show_header_search = $wdwt_front->get_param('show_header_search', array(), true);

$show_slider_wd = $wdwt_front->get_param('show_slider_wd', array(), false);
$slider_wd_id = $wdwt_front->get_param('slider_wd_id');
if (is_array($slider_wd_id)) {
	$slider_wd_id = $slider_wd_id[0];
}

$hide_slider = $wdwt_front->get_param('hide_slider');

?>
<header>
 <?php if(! empty($header_image)){  ?>
    <div class="container">
		<a class="custom-header-a" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo header_image(); ?>" class="custom-header">	
		</a>
	</div>
 <?php } ?>
	<div id="header">
		<div id="header-top">
			<div class="container">
				<ul id="social" class="social-icon">
					<li class="facebook"><a <?php if( $show_facebook_icon!='on' || $facebook_url == "" ){ echo "style=\"display:none;\""; } ?> href="<?php if( trim($facebook_url) ) { echo esc_url($facebook_url);} else { echo "javascript:;";}?>"  target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li class="twitter"><a <?php if( $show_twitter_icon!='on' || $twitter_url == ""){ echo "style=\"display:none;\""; } ?> href="<?php if( trim($twitter_url) ){ echo esc_url($twitter_url);} else { echo "javascript:;";}?>" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li class="google-plus"><a <?php if( $show_google_icon!='on' || $google_url == "" ) { echo "style=\"display:none;\""; } ?>  href="<?php if( trim($google_url) ) { echo esc_url($google_url);} else { echo "javascript:;";}?>" target="_blank" title="Google +"><i class="fa fa-google-plus"></i></a></li>
					<li class="rss"><a <?php if( $show_rss_icon!='on' || $rss_url == "" ) { echo "style=\"display:none;\""; } ?>  href="<?php if( trim($rss_url) ) { echo esc_url($rss_url);} else { echo "javascript:;";}?>" target="_blank" title="Rss"><i class="fa fa-rss"></i></a></li>

					<li class="youtube"><a <?php if( $show_youtube_icon!='on' || $youtube_url == "" ) { echo "style=\"display:none;\""; } ?>  href="<?php if( trim($youtube_url) ) { echo esc_url($youtube_url);} else { echo "javascript:;";}?>" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>
					<li class="instagram"><a <?php if( $show_instagram_icon!='on' || $instagram_url == "" ) { echo "style=\"display:none;\""; } ?>  href="<?php if( trim($instagram_url) ) { echo esc_url($instagram_url);} else { echo "javascript:;";}?>" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
					<li class="linkedin"><a <?php if( $show_linkedin_icon!='on' || $linkedin_url == "" ) { echo "style=\"display:none;\""; } ?>  href="<?php if( trim($linkedin_url) ) { echo esc_url($linkedin_url);} else { echo "javascript:;";}?>" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
					<li class="pinterest"><a <?php if( $show_pinterest_icon!='on' || $pinterest_url == "" ) { echo "style=\"display:none;\""; } ?>  href="<?php if( trim($pinterest_url) ) { echo esc_url($pinterest_url);} else { echo "javascript:;";}?>" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
				</ul>
				<?php if($show_header_search){ ?>
					<div id="search-block">
						<?php get_search_form(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="container">
			<div id="header-middle">
			 <?php  if(trim($logo_img)){?> 
				<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<img id='site-title' src='<?php echo esc_url( $logo_img ); ?>' alt='<?php echo esc_attr(bloginfo( 'name' )); ?>'>
				</a>
			<?php }
			else{ ?>
				<h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a></h1>
			<?php } ?>	
			<div class="clear"></div>
			<?php if(!trim($logo_img)){ ?>	
				<h2 id="site_desc"><?php echo get_bloginfo( 'description', 'display' ); ?></h2>
			<?php } ?>
			</div>
		</div>
		<div class="phone-menu-block">
			<nav id="top-nav">
				<div class="container">
					<?php
					$best_magazine_show_home = true;
					if(has_nav_menu( 'primary-menu')){
						$best_magazine_show_home = false;
					}
					$wdwt_menu = wp_nav_menu(	array(
										'show_home' => $best_magazine_show_home,
										'theme_location'  => 'primary-menu',
										'container'       => false,
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => 'top-nav-list',
										'menu_id'         => '',
										'echo'            => false,
										'fallback_cb'     => 'wp_page_menu',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
										'items_wrap'      => '<ul id="top-nav-list" class=" %2$s">%3$s</ul>',
										'depth'           => 0,
										'walker'          => ''
									));
					echo $wdwt_menu;
					?>	
				</div>
			</nav>
		</div>
	</div>
	<?php

  if (is_plugin_active('slider-wd/slider-wd.php') && $show_slider_wd && function_exists("wd_slider")) {
    if( $hide_slider[0]!="Hide Slider" &&
      ((is_front_page() && $hide_slider[0]=="Only on Homepage") ||
        $hide_slider[0]=="On all the pages and posts")){
      ?>
      <div class="container">
        <?php wd_slider($slider_wd_id); ?>
      </div>
      <?php
    }
  } else {
    $wdwt_front->slideshow();
  }

  ?>
