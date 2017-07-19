<?php
/**
 * MekanewsLite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mekanews_Lite
 */

define('MEKANEWS_PRO_URL', 'https://themecountry.com/themes/mekanews/');

if ( ! function_exists( 'mekanews_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mekanews_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MekanewsLite, use a find and replace
	 * to change 'mekanews-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mekanews-lite', trailingslashit( get_template_directory() ) . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 320, 200, true ); //post thumbnails grid
	add_image_size( 'mekanews-lite-post-thumbnails-list', 220 , 170, true );//post thumbnails list
	add_image_size( 'mekanews-lite-banner-thumbnails', 670 , 300, true ); //slider 
	add_image_size( 'mekanews-lite-banner-thumbnails-list', 134 , 100, true );//slider list
	add_image_size( 'mekanews-lite-single-thumbnails', 670 , 330, true );//single thumbnails post
	//add_image_size( 'related-thumbnails', 210 , 170, true );
	add_image_size( 'mekanews-lite-related-thumbnails', 70 , 70, true ); //thumbnail widget and related post in single

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top-menu' => esc_html__( 'Top Menu','mekanews-lite'),  
		'primary'  => esc_html__( 'Primary', 'mekanews-lite' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'mekanews-lite' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom logo feature.
	add_theme_support( 'custom-logo', apply_filters( 'mekanews_lite_custom_logo_args', array(
			'height' => 90,
			'width' => 250,
			'flex-height' => true,
			'flex-width' => true,
		) ) );
	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );	
}
endif;
add_action( 'after_setup_theme', 'mekanews_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mekanews_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mekanews_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'mekanews_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mekanews_lite_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mekanews-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mekanews-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Header', 'mekanews-lite' ),
		'id'            => 'header-widget',
		'description'   => esc_html__( 'Add widgets here.', 'mekanews-lite' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	
}
add_action( 'widgets_init', 'mekanews_lite_widgets_init' );
	
/**
 * Enqueue scripts and styles.
 */
function mekanews_lite_scripts() {
	wp_enqueue_style( 'mekanews-lite-droid-sans', '//fonts.googleapis.com/css?family=Droid+Sans:400,700');

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'mekanews-lite-style', get_stylesheet_uri() );

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() .  '/css/owl.carousel.css');

	wp_enqueue_style( 'mekanews-lite-responsive', get_template_directory_uri() .  '/css/responsive.css');	

	wp_enqueue_script( 'mekanews-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mekanews-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '20160720', true );

	wp_enqueue_script( 'mekanews-lite-script', get_template_directory_uri() . '/js/script.js', array(), '20160720', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mekanews_lite_scripts' );


/*
|------------------------------------------------------------------------------
| Customize Tag
|------------------------------------------------------------------------------
*/
add_filter('widget_tag_cloud_args','mekanews_lite_set_tag_cloud_sizes');
function mekanews_lite_set_tag_cloud_sizes($args) {	
	$args['largest'] = 12;
	$args['smallest'] = 12;
	$args['unit'] = 'px';
	return $args;
}

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . '/inc/extras.php';

/**
 * Customizer additions.
 */
// include Theme Customizer Options
require trailingslashit( get_template_directory() ) . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require trailingslashit( get_template_directory() ) . '/inc/jetpack.php';


