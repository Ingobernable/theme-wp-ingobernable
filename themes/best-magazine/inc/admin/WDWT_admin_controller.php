<?php 
global $wdwt_options; 



/// include Layout page class
require_once( 'layout_page.php' );
/// include General Settings page class
require_once( 'general_settings_page.php' );
/// include Home page class
require_once( 'home_page.php' );
/// include Typography page class
require_once( 'typography_page.php' );
/// include Slider page class
require_once( 'slider_page.php' );

///include licensing page
require_once( 'licensing.php' );

/// include lightbox page class
+require_once( 'lightbox_page.php' );


$WDWT_layout_page = new WDWT_layout_page_class();
$WDWT_general_settings_page = new WDWT_general_settings_page_class();
$WDWT_homepage_page = new WDWT_HOMEPAGE_page_class();
$WDWT_typography_page = new WDWT_typography_page_class();
$WDWT_slider_page = new WDWT_slider_page_class();
$WDWT_lightbox_page = new WDWT_lightbox_page_class();
  $WDWT_licensing_page = new WDWT_licensing_page_class();



add_filter('option_'.WDWT_OPT, 'wdwt_options_mix_defaults');
/// ajax for install sample data
add_action('wp_ajax_wdwt_install_sample_data',  array(&$WDWT_sample_data,'install_ajax'));
/// ajax for remove sample data
add_action('wp_ajax_wdwt_remove_sample_data',  array(&$WDWT_sample_data,'remove_ajax'));

add_action( 'after_setup_theme', 'wdwt_options_init', 10, 2 );



function wdwt_options_init() {
  global $wdwt_options;

  $option_defaults = WDWT_get_option_defaults();
 
  $new_version = $option_defaults['theme_version'];
  $options = get_option( 'theme_'.WDWT_VAR.'_options', array() );

  if(isset($options['theme_version'])){
    $old_version = $options['theme_version'];
  }
  else{
    $old_version = '0.0.0';
  }

 
  if($new_version !== $old_version){
    require_once('updater.php');
    $theme_update = new Best_magazine_updater($new_version, $old_version);
    $options = $theme_update->get_old_params();  /* old params in new format */
  }
  /*overwrite defaults with new options*/
  $wdwt_options = apply_filters('wdwt_options_init', $options);
  

}

function wdwt_options_mix_defaults($options){
  $option_defaults = WDWT_get_option_defaults();
  /*theme version is saved separately*/
  /*for the updater*/
  if(isset($option_defaults['theme_version'])){
    unset($option_defaults['theme_version']);
  }
  $options = wp_parse_args( $options, $option_defaults);
  return $options;
}


function WDWT_get_options() {

  global $wdwt_options;
  wdwt_options_init();/*refrest options*/

  return apply_filters('WDWT_get_options', $wdwt_options);
}



function WDWT_get_option_defaults() {
  $option_parameters = WDWT_get_option_parameters();
  $option_defaults = array();
  
  $current_theme = wp_get_theme();
  $option_defaults['theme_version'] = $current_theme->get( 'Version' );
  
  foreach ( $option_parameters as $option_parameter ) {
    $name =  (isset($option_parameter['name']) && $option_parameter['name'] !='' ) ? $option_parameter['name'] : false;
    if($name && isset($option_parameter['default']))
      $option_defaults[$name] = $option_parameter['default'];
  }
  return apply_filters( 'WDWT_get_option_defaults', $option_defaults );
}




function WDWT_get_option_parameters() {
  global  $WDWT_layout_page,       
      $WDWT_general_settings_page , 
      $WDWT_homepage_page,
      $WDWT_typography_page,
      $WDWT_lightbox_page,
      $WDWT_slider_page;
      
    global $WDWT_licensing_page;
 
  
  $options=array();
  
  foreach($WDWT_layout_page->options as $kay => $x)
    $options[$kay] = $x;
  foreach($WDWT_general_settings_page->options as $kay =>  $x) 
    $options[$kay] = $x;

  foreach($WDWT_lightbox_page->options  as $kay => $x)  
    $options[$kay] = $x; 
  
  foreach($WDWT_homepage_page->options as $kay =>  $x)  
    $options[$kay] = $x;
  
  foreach($WDWT_typography_page->options  as $kay => $x)  
    $options[$kay] = $x;

  foreach($WDWT_slider_page->options  as $kay => $x)  
    $options[$kay] = $x;
  
  return apply_filters( 'WDWT_get_option_parameters', $options );
}



function WDWT_get_tabs() {
  $tabs= array();

  

  $tabs['layout_editor'] = array(
    'name' => 'layout_editor',
    'title' => __( 'Layout Editor', "best-magazine" ),
    'sections' => array(
      'layout_editor' => array(
        'name' => 'layout_editor',
        'title' => __( 'Layout Editor', "best-magazine" ),
        'description' => ''
      )
    ),
  'description' => wdwt_section_descr('layout_editor')
  );

  $tabs['general'] = array(
    'name' => 'general',
    'title' => __( 'General', "best-magazine" ),
    'sections' => array(
      'general_main' => array(
        'name' => 'general_main',
        'title' => __( 'General - Main', "best-magazine" ),
        'description' => ''
      ),
      'general_links' => array(
        'name' => 'general_links',
        'title' => __( 'General - Links', "best-magazine" ),
        'description' => ''
      ),

    ),
  'description' => wdwt_section_descr('general')
  );

  $tabs['homepage'] = array(
    'name' => 'homepage',
    'title' => __( 'Homepage', "best-magazine" ),
    'sections' => array(
      'top_posts' => array(
        'name' => 'top_posts',
        'title' => __( 'Top Posts', "best-magazine" ),
        'description' => ''
      ),
    'category_tabs' => array(
        'name' => 'category_tabs',
        'title' => __( 'Category Tabs', "best-magazine" ),
        'description' => ''
      ),
    'featured_post' => array(
        'name' => 'featured_post',
        'title' => __( 'Featured Post', "best-magazine" ),
        'description' => ''
      ),
    'content_post' => array(
        'name' => 'content_post',
        'title' => __( 'Content Post', "best-magazine" ),
        'description' => ''
      )
    ),
    'description' => wdwt_section_descr('homepage'),
  );

  

  $tabs['typography'] = array(
    'name' => 'typography',
    'title' => __( 'Typography', "best-magazine" ),
    'description' => wdwt_section_descr('typography'),
    'sections' => array(
      'text_headers' => array(
        'name' => 'text_headers',
        'title' => __( 'Typography - Text Headers', "best-magazine" ),
        'description' => ''
      ),
      'primary_font' => array(
        'name' => 'primary_font',
        'title' => __( 'Typography - Primary Font' , "best-magazine"),
        'description' => ''
      ),
      'secondary_font' => array(
        'name' => 'secondary_font',
        'title' => __( 'Typography - Secondary Font' , "best-magazine"),
        'description' => ''
      ),
      'inputs_textareas' => array(
        'name' => 'inputs_textareas',
        'title' => __( 'Typography - Inputs and Text Areas', "best-magazine" ),
        'description' => ''
      )
    ),
    
  );


  $tabs['slider'] = array(
    'name' => 'slider',
    'title' => __( 'Slider', "best-magazine" ),
    'description' => wdwt_section_descr('slider'),
    'sections' => array(
      'slider_main' => array(
        'name' => 'slider_main',
        'title' => __( 'Slider - General', "best-magazine" ),
        'description' => ''
      ),
      'slider_imgs' => array(
        'name' => 'slider_imgs',
        'title' => __( 'Slider - Images' , "best-magazine"),
        'description' => ''
      ),
    ),
  );

  $tabs['lightbox'] = array(
    'name' => 'lightbox',
    'title' => __( 'Lightbox', "best-magazine" ),
    'description' => wdwt_section_descr('lightbox'),
    'sections' => array(
      'lightbox' => array(
        'name' => 'lightbox',
        'title' => __( 'Lightbox', "best-magazine" ),
        'description' => ''
      ),
    ),
  );

  
  /* NO if WDWT_IS_PRO*/
    $tabs['color_control'] = array(
      'name' => 'color_control',
      'title' => __( 'Color Control', "best-magazine" ),
      'sections' => array(
        'color_control' => array(
          'name' => 'color_control',
          'title' => __( 'Color Control', "best-magazine" ),
          'description' => ''
        )
      ),
    'description' => wdwt_section_descr('color_control')
    );


    $tabs['licensing'] = 
      array(
        'name' => 'licensing',
        'title' => __( 'Upgrade to Pro', "best-magazine" ),
        'sections' => array(
          'licensing' => array(
            'name' => 'licensing',
            'title' => __( 'Upgrade to Pro', "best-magazine" ),
            'description' => ''
          )
        ),
        'description' =>  ''
      );
  

    
  return apply_filters( 'WDWT_get_tabs', $tabs );
}