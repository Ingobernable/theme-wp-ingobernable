<?php
if ( ! function_exists( 'supermag_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function supermag_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on SuperMag, use a find and replace
         * to change 'supermag' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'supermag', get_template_directory() . '/languages' );

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
        * Enable support for custom logo.
        *
        *  @since SuperNews 1.3.0
       */
        add_theme_support( 'custom-logo', array(
            'height'      => 70,
            'width'       => 290,
            'flex-height' => true,
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 240, 172, true );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'supermag' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'supermag_custom_background_args', array(
            'default-color' => 'eeeeee',
            'default-image' => '',
        ) ) );

        /*woocommerce support*/
        add_theme_support( 'woocommerce' );
    }
endif; // supermag_setup
add_action( 'after_setup_theme', 'supermag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function supermag_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'supermag_content_width', 640 );
}
add_action( 'after_setup_theme', 'supermag_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function supermag_scripts() {
	$supermag_customizer_all_values = supermag_get_theme_options();
    /*bxslider css*/
    wp_enqueue_style( 'jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/css/jquery.bxslider.min.css', array(), '4.2.5' );

    /*google font*/
    wp_enqueue_style( 'supermag-googleapis', '//fonts.googleapis.com/css?family=Open+Sans:600,400|Roboto:300italic,400,500,700', array(), '1.0.1' );

    /*Font-Awesome-master*/
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/Font-Awesome/css/font-awesome.min.css', array(), '4.5.0' );

    /*main style*/
    wp_enqueue_style( 'supermag-style', get_stylesheet_uri() ,false, '1.4.9');

    /*jquery start*/
    /*html5*/
    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), '3.7.3', false);
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    /*respond*/
    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), '1.1.2', false);
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    /*bxslider*/
    wp_enqueue_script('jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/js/jquery.bxslider.min.js', array('jquery'), '4.2.5', 1);

    if( 1 == $supermag_customizer_all_values['supermag-enable-sticky-sidebar'] ){
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/assets/library/theia-sticky-sidebar/theia-sticky-sidebar.js', array('jquery'), '1.4.0', 1);
    }

    /*theme custom js*/
    wp_enqueue_script('supermag-custom', get_template_directory_uri() . '/assets/js/supermag-custom.js', array('jquery'), '1.4.0', 1);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'supermag_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function supermag_admin_scripts( $hook ) {

    wp_enqueue_media();
    wp_enqueue_script( 'supermag-widgets-script', get_template_directory_uri() . '/assets/js/acme-widget.js', array( 'jquery' ), '1.0.0' );

}
add_action( 'admin_enqueue_scripts', 'supermag_admin_scripts' );

/**
 * Custom template tags for this theme.
 */
$supermag_template_tags_file_path = supermag_file_directory('acmethemes/core/template-tags.php');
require $supermag_template_tags_file_path;

/**
 * Custom functions that act independently of the theme templates.
 */
$supermag_extras_file_path = supermag_file_directory('acmethemes/core/extras.php');
require $supermag_extras_file_path;

/**
 * Load custom header.
 */
$supermag_custom_header = supermag_file_directory('acmethemes/core/custom-header.php');
require $supermag_custom_header;

/**
 * Load Jetpack compatibility file.
 */
$supermag_jetpack_file_path = supermag_file_directory('acmethemes/core/jetpack.php');
require $supermag_jetpack_file_path;