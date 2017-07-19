<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if (is_singular() && pings_open(get_queried_object())) : ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="mh-container">
<header class="mh-header header-logo-full mh-row clearfix">
	<?php mh_joystick_lite_logo(); ?>
</header>
<nav class="main-nav clearfix">
	<?php wp_nav_menu(array('theme_location' => 'main_nav')); ?>
</nav>
<div class="slicknav clearfix"></div>
<div class="mh-wrapper">