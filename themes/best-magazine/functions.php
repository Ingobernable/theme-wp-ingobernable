<?php

  /*define theme global constants*/

  define("WDWT_TITLE", "Best Magazine");
  
  define("WDWT_SLUG", "best-magazine");
  define("WDWT_VAR", "best_magazine");
  define("WDWT_OPT", 'theme_' . WDWT_VAR . '_options');
  define("WDWT_META", "_" . WDWT_VAR . "_meta");
  define("WDWT_VERSION", wp_get_theme()->get('Version'));

  define("WDWT_LOGO_SHOW", true);
  define("WDWT_HOMEPAGE", "https://web-dorado.com");
  /*directories*/
  define("WDWT_DIR", get_template_directory());
  /*URLs*/
  define("WDWT_URL", get_template_directory_uri());
  define("WDWT_IMG", WDWT_URL . '/images/');
  define("WDWT_IMG_INC", WDWT_URL . '/inc/images/');

  load_theme_textdomain("best-magazine", WDWT_DIR . '/languages');
  /*include admin, options and frontend classes*/
  require_once('inc/index.php');


  if (!is_admin()) {
    add_action('init', 'wdwt_front_init');
  }
  /* head*/
  add_action('wp_head', 'wdwt_include_head');
  /*  Frontend scripts and styles	*/
  add_action('wp_enqueue_scripts', 'wdwt_scripts_front');

  /* sidebars*/
  add_action('widgets_init', 'wdwt_widgets_init');
  /* change body class*/
  add_filter('body_class', 'wdwt_multisite_body_classes');
  /* add_theme_support , textdomain etc */
  add_action('after_setup_theme', 'wdwt_setup_elements');


  /*lightbox*/
  add_action('wp_ajax_wdwt_lightbox', 'wdwt_lightbox');
  add_action('wp_ajax_nopriv_wdwt_lightbox', 'wdwt_lightbox');
  /*WooCommerce support */
  remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
  remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
  add_action('woocommerce_before_main_content', array('Best_magazine_front_functions', 'wdwt_wrapper_start'), 10);
  add_action('woocommerce_after_main_content', array('Best_magazine_front_functions', 'wdwt_wrapper_end'), 10);
  remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


  /*functions are below*/
  function wdwt_front_init()
  {
    global $wdwt_options,
           $wdwt_front;

    global $wp_customize;
    if (!isset($wp_customize)) {
      $wdwt_front = new best_magazine_front($wdwt_options);

    }
    /* excerpt more */
    add_filter('excerpt_more', array('Best_magazine_front_functions', 'excerpt_more'));

    /*   remove more in posts and pages   */
    add_filter('the_content_more_link', array('Best_magazine_front_functions', 'remove_more_jump_link'));

  }


  function wdwt_include_head()
  {
    global $wdwt_front;

    wp_get_post_tags('type=monthly&format=link');  // geting posts tags
    $wdwt_front->layout();
    $wdwt_front->typography();
    $wdwt_front->color_control();
    $wdwt_front->favicon_img(); // favicon function print favicon html located front_end/front_end_functions.php
    $wdwt_front->custom_css();
    $wdwt_front->menu_bg_img();


  }

  /********************************************/
  /*  ADD REQUERID SCRIPTS STYLES FRONT END	*/
  /********************************************/


  function wdwt_scripts_front()
  {
    wp_enqueue_script('jquery-effects-core');
    wp_enqueue_script('jquery-effects-explode');
    wp_enqueue_script('jquery-effects-slide');
    wp_enqueue_script('jquery-effects-transfer');

    wp_enqueue_script('wdwt_custom_js', get_template_directory_uri() . '/inc/js/javascript.js', array('jquery'), WDWT_VERSION);
    wp_enqueue_script('wdwt_response', get_template_directory_uri() . '/inc/js/responsive.js', array('jquery'), WDWT_VERSION, true);
    wp_enqueue_style(WDWT_SLUG . '-style', get_stylesheet_uri(), array(), WDWT_VERSION);
    wp_enqueue_style('wdwt_slideshow-style', get_template_directory_uri() . '/slideshow/style.css', array(), WDWT_VERSION);
    wp_enqueue_script('comment-reply');


    // Styles/Scripts for popup.
    wp_enqueue_style('wdwt_font-awesome', WDWT_URL . '/inc/css/font-awesome/font-awesome.css', array(), WDWT_VERSION);
    wp_enqueue_script('wdwt_jquery_mobile', WDWT_URL . '/inc/js/jquery.mobile.js', array('jquery'), WDWT_VERSION);
    wp_enqueue_script('wdwt_mCustomScrollbar', WDWT_URL . '/inc/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), WDWT_VERSION);
    wp_enqueue_style('wdwt_mCustomScrollbar', WDWT_URL . '/inc/css/jquery.mCustomScrollbar.css', array(), WDWT_VERSION);
    wp_enqueue_script('wdwt_jquery-fullscreen', WDWT_URL . '/inc/js/jquery.fullscreen-0.4.1.js', array('jquery'), WDWT_VERSION);

    wp_enqueue_script('wdwt_lightbox_loader', WDWT_URL . '/inc/js/lightbox.js', array('jquery'), WDWT_VERSION);
    wp_localize_script('wdwt_lightbox_loader', 'wdwt_admin_ajax_url', admin_url('admin-ajax.php'));
    wp_localize_script('wdwt_lightbox_loader', 'best_magazine_objectL10n', array(
      'field_required' => __('field is required.', "best-magazine"),
      'mail_validation' => __('This is not a valid email address.', "best-magazine"),
      'search_result' => __('There are no images matching your search.', "best-magazine"),
    ));
  }


  /*************************************/
  /*   REGISTR SIDBARS [WIDGET AREA]   */
  /*************************************/

  function wdwt_widgets_init()
  {

    // Area 1, located at the top of the sidebar.

    register_sidebar(array(

        'name' => __('Primary Widget Area', "best-magazine"),

        'id' => 'sidebar-1',

        'description' => __('The primary widget area', "best-magazine"),

        'before_widget' => '<div id="%1$s" class="widget-area %2$s">',

        'after_widget' => '</div> ',

        'before_title' => '<h3>',

        'after_title' => '</h3>',

      )
    );

    // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.

    register_sidebar(array(

        'name' => __('Secondary Widget Area', "best-magazine"),

        'id' => 'sidebar-2',

        'description' => __('The secondary widget area', "best-magazine"),

        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',

        'after_widget' => '</div>',

        'before_title' => '<h3 class="widget-title">',

        'after_title' => '</h3>',
      )
    );

    // footer widget area

    register_sidebar(array(

        'name' => __('Footer Widget Area', "best-magazine"),

        'id' => 'footer-widget-area',

        'description' => __('The secondary widget area', "best-magazine"),

        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',

        'after_widget' => '</div>',

        'before_title' => '<h3 class="widget-title">',

        'after_title' => '</h3>',
      )
    );
  }


  /*************************************/
  /*        BODY CLASS BAD CLASS       */
  /*************************************/


  function wdwt_multisite_body_classes($classes)
  {
    foreach ($classes as $key => $class) {
      if ($class == 'blog')
        $classes[$key] = 'blog_body';
    }
    return $classes;
  }

  /*************************************/
  /* CALL FUNCTIONS AFTER THEME SETUP  */
  /*************************************/


  function wdwt_setup_elements()
  {
    // add custom header in admin menu
    add_theme_support('custom-header', array(
      'default-text-color' => '220e10',
      'default-image' => '',
      'header-text' => false,
      'height' => 230,
      'width' => 1024

    ));

    // add custom background in admin menu
    $expert_defaults = array(
      'default-color' => 'FEFEFE',
      'default-image' => '',
      'admin-head-callback' => '',
      'admin-preview-callback' => ''
    );
    add_theme_support('custom-background', $expert_defaults);

    // For Post thumbnail
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150);

    // requerid  features
    add_theme_support('automatic-feed-links');

    /// include language
    //load_theme_textdomain("best-magazine", get_template_directory() . '/languages' );

    // registr menu,
    register_nav_menu('primary-menu', 'Primary Menu');

    // for editor styles
    add_editor_style();

    if (!isset($content_width)) {
      $content_width = 1024;
    }
    add_theme_support('title-tag');

    /*WooCommerce support*/
    add_theme_support('woocommerce');

  }


  function wdwt_lightbox()
  {

    /* reset from user to site locale*/
    if (function_exists('switch_to_locale')) {
      switch_to_locale(get_locale());
    }
    
    $action = $_POST['action'];
    if ($action == "wdwt_lightbox") {
      require_once('inc/front/WDWT_lightbox.php');
      $lightbox = new WDWT_Lightbox();
      $lightbox->view();
    }
    die();
  }


?>
