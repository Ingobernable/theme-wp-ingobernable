<?php
/**
 * BlackWhite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BlackWhite
 */


define('BLACKWHITE_PRO_URL', 'https://themecountry.com/themes/blackwhite/');

if ( ! function_exists( 'blackwhite_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blackwhite_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BlackWhite, use a find and replace
	 * to change 'blackwhite-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blackwhite-lite', get_template_directory() . '/languages' );

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
	set_post_thumbnail_size( 326, 236, true ); //post thumbnails List
	add_image_size( 'blackwhite-post-featured-full-width', 500, 180, true ); //post thumbnails featured full width
	add_image_size( 'blackwhite-post-related-small', 100, 80, true ); //small size & related posts
	add_image_size( 'blackwhite-post-featured', 516, 364, true ); //post thumbnails featured

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array( 
		'primary'  => esc_html__( 'Primary', 'blackwhite-lite' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'blackwhite-lite' )
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


	/**
	 * Support Logo
	 * 
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 90, // change to your height logo
		'width'       => 250, // change to your width logo
		'flex-width' => true, // change to flexible width
		'flex-width' => true, // change to flexible width
	) );

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
add_action( 'after_setup_theme', 'blackwhite_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blackwhite_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blackwhite_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'blackwhite_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blackwhite_lite_widgets_init() {
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar', 'blackwhite-lite' ),
		'id'			=> 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blackwhite-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="wrap-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Banner', 'blackwhite-lite' ),
		'id'            => 'header-widget',
		'description'   => esc_html__( 'Add widgets here.', 'blackwhite-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="wrap-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Feature Homepage', 'blackwhite-lite' ),
		'id'			=> 'feature-homepage',
		'description'	=> esc_html__( 'Add widgets here to appear on magazine template.', 'blackwhite-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<div class="wrap-header"><h3 class="widget-title">',
		'after_title'	=> '</h3></div>',
	));
	register_sidebar( array(
		'name'			=> esc_html__( 'Magazine Homepage', 'blackwhite-lite' ),
		'id'			=> 'magazine-homepage',
		'description'	=> esc_html__( 'Add widgets here to appear on magazine template.', 'blackwhite-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<div class="wrap-header"><h3 class="widget-title">',
		'after_title'	=> '</h3></div>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'blackwhite-lite' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'blackwhite-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="wrap-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'blackwhite-lite' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'blackwhite-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="wrap-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'blackwhite-lite' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'blackwhite-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="wrap-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'blackwhite-lite' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'blackwhite-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="wrap-header"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );
	
}
add_action( 'widgets_init', 'blackwhite_lite_widgets_init' );
	
/**
 * Enqueue scripts and styles.
 */
function blackwhite_lite_scripts() {
	
	global $wp_query;
	
	wp_enqueue_style( 'google-font-style', '//fonts.googleapis.com/css?family=PT+Sans:400,700');
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'blackwhite-style', get_stylesheet_uri() );
	wp_enqueue_style( 'blackwhite-responsive', get_template_directory_uri() .  '/css/responsive.css');
	wp_enqueue_style( 'blackwhite-custom-layout', get_template_directory_uri() .  '/css/custom-layout.css');

	
	wp_enqueue_script( 'blackwhite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'blackwhite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'blackwhite-script', get_template_directory_uri() . '/js/script.js', array(), '20160720', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	
}
add_action( 'wp_enqueue_scripts', 'blackwhite_lite_scripts' );

/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 */
function blackwhite_lite_theme_options() {
	// Merge Theme Options Array from Database with Default Options Array
	$theme_options = wp_parse_args( 
		
	// Get saved theme options from WP database
	get_option( 'blackwhite_lite_theme_options', array() ), 
	
	// Merge with Default Options if setting was not saved yet
	blackwhite_lite_default_options() 
		
	);

	// Return theme options
	return $theme_options;
}

/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function blackwhite_lite_default_options() {

	$default_options = array(
		'site_title'						=> true,
		'layout' 							=> 'right-sidebar',
		'sticky_header'						=> false,
		'post_layout_archives'				=> 'left',
		'post_content' 						=> 'excerpt',
		'excerpt_length' 					=> 20,
		'excerpt_more' 						=> ' [...]',
		'post_navigation'					=> true,
		'related_posts'						=> 'cat',
		'disable_slide'						=> false,
		'back_to_top'						=> true,
		'paging'							=> 'paging-default',
		'post_meta_info'					=> array()
	);
	
	return $default_options;
}

/*
|------------------------------------------------------------------------------
| Customize Tag
|------------------------------------------------------------------------------
*/
add_filter('widget_tag_cloud_args','blackwhite_lite_set_tag_cloud_sizes');
function blackwhite_lite_set_tag_cloud_sizes($args) {	
	$args['largest'] = 12;
	$args['smallest'] = 12;
	$args['unit'] = 'px';
	return $args;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
// include Theme Customizer Options
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widget.php';