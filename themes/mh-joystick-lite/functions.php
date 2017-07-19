<?php

/***** Fetch Theme Data & Options *****/

$mh_joystick_lite_data = wp_get_theme('mh_joystick_lite');
$mh_joystick_lite_version = $mh_joystick_lite_data['Version'];
$mh_joystick_lite_options = get_option('mh_joystick_lite_options');

/***** Custom Hooks *****/

function mh_joystick_lite_before_page_content() {
    do_action('mh_joystick_lite_before_page_content');
}

function mh_joystick_lite_before_post_content() {
    do_action('mh_joystick_lite_before_post_content');
}

/***** Theme Setup *****/

if (!function_exists('mh_joystick_lite_themes_setup')) {
	function mh_joystick_lite_themes_setup() {
		load_theme_textdomain('mh-joystick-lite', get_template_directory() . '/languages');
		add_filter('use_default_gallery_style', '__return_false');
		add_theme_support('custom-header', array('default-image' => '', 'default-text-color' => 'ffffff', 'width' => 350, 'height' => 100, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('html5', array('search-form'));
		add_theme_support('custom-background', array('default-color' => '0296c8'));
		add_theme_support('post-thumbnails');
		add_theme_support('customize-selective-refresh-widgets');
		add_image_size('mh-joystick-lite-slider', 728, 409, true);
		add_image_size('mh-joystick-lite-medium', 326, 183, true);
		add_image_size('mh-joystick-lite-small', 139, 78, true);
		register_nav_menus(array('main_nav' => __('Main Navigation', 'mh-joystick-lite')));
	}
}
add_action('after_setup_theme', 'mh_joystick_lite_themes_setup');

/***** Set Content Width *****/

if (!function_exists('mh_joystick_lite_content_width')) {
	function mh_joystick_lite_content_width() {
		global $content_width;
		if (!isset($content_width)) {
			if (is_page_template('template-full.php')) {
				$content_width = 1105;
			} else {
				$content_width = 728;
			}
		}
	}
}
add_action('template_redirect', 'mh_joystick_lite_content_width');

/***** Load CSS & JavaScript *****/

if (!function_exists('mh_joystick_lite_scripts')) {
	function mh_joystick_lite_scripts() {
		global $mh_joystick_lite_version;
		wp_enqueue_style('mh-google-fonts', "https://fonts.googleapis.com/css?family=Droid+Sans:400,700|Play:400,700", array(), null);
		wp_enqueue_style('mh-font-awesome', get_template_directory_uri() . '/includes/font-awesome.min.css', array(), null);
		wp_enqueue_style('mh-style', get_stylesheet_uri(), false, $mh_joystick_lite_version);
		wp_enqueue_script('mh-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), $mh_joystick_lite_version);
		if (is_singular() && comments_open() && get_option('thread_comments') == 1) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'mh_joystick_lite_scripts');

if (!function_exists('mh_joystick_lite_admin_scripts')) {
	function mh_joystick_lite_admin_scripts($hook) {
		if ('widgets.php' === $hook) {
			wp_enqueue_style('mh-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'mh_joystick_lite_admin_scripts');

/***** Register Widget Areas / Sidebars	*****/

if (!function_exists('mh_joystick_lite_widgets_init')) {
	function mh_joystick_lite_widgets_init() {
		register_sidebar(array('name' => __('Global - Sidebar', 'mh-joystick-lite'),	'id' => 'global-sidebar', 'description' => __('Sidebar widgets located on every page except the homepage, suitable for all widgets.', 'mh-joystick-lite'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => __('Home 1 - Main Column', 'mh-joystick-lite'), 'id' => 'home-main-column', 'description' => __('Main column widgets located on homepage only, suitable for widgets with the [MH] prefix and text widgets.', 'mh-joystick-lite'), 'before_widget' => '<div id="%1$s" class="home-main-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
		register_sidebar(array('name' => __('Home 2 - Sidebar', 'mh-joystick-lite'), 'id' => 'home-sidebar', 'description' => __('Sidebar widgets located on homepage only, suitable for all widgets.', 'mh-joystick-lite'), 'before_widget' => '<div id="%1$s" class="sb-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>'));
	}
}
add_action('widgets_init', 'mh_joystick_lite_widgets_init');

/***** Include Several Functions *****/

require_once('includes/mh-customizer.php');
require_once('includes/mh-custom-functions.php');
require_once('includes/mh-widgets.php');

?>