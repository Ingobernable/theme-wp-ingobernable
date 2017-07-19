<?php

add_action( 'after_setup_theme', 'wdwt_customizer_register' );


function wdwt_customizer_register(){
  
  add_action( 'customize_register', 'wdwt_customizer_add_panels' );
  add_action( 'customize_controls_enqueue_scripts', 'wdwt_customizer_add_scripts' );
  global $wp_customize;
  if ( isset( $wp_customize ) ) {
    add_action( 'customize_preview_init','wdwt_customizer_refresh_head', 9);
  }


}

function wdwt_customizer_add_panels($wp_customize ){

  /*
  the following sections are standard

  title_tagline – Site Title & Tagline
  colors – Colors
  header_image – Header Image
  background_image – Background Image
  nav – Navigation
  static_front_page – Static Front Page
  */
  
  $panels = wdwt_get_tabs();

  $priority = 1;
 
  // Add panels

  foreach ( $panels as $panel => $panel_data ) {
    $wp_customize->add_panel( WDWT_VAR .'_'. $panel, array(
        'priority'       => $priority,
        'capability'     => 'edit_theme_options',
        'title'          => $panel_data['title'],
        'description'    => $panel_data['description'],
      )
    );

    foreach ($panel_data['sections'] as $section => $section_data ){
      $wp_customize->add_section( $section, array(
          'priority'       => $priority,
          'capability'     => 'edit_theme_options',
          'title'          => $section_data['title'],
          'description'    =>  $section_data['description'],
          'panel'  => WDWT_VAR .'_'. $panel,
        )
      );
    }
    $priority += 1;
  }
  /*move standard WP sections to general panel*/
  
  $general_links_priority = $wp_customize->get_section( 'general_links' )->priority;
  $core_sections = array('title_tagline','header_image','background_image','static_front_page');
  $core_sections_priority = $general_links_priority+1;
  foreach($core_sections as $core_section){
    $core_sect = (object) $wp_customize->get_section( $core_section );
    $core_sect->panel = WDWT_VAR .'_general'; 
    $core_sect->priority = $core_sections_priority;
    $core_sections_priority += 1;
  }
  
  
  /*move background color to color control panel*/
  $wp_customize->get_control( 'background_color' )->section = 'color_control';

  $builtin_mods = array(
    'background',
    'navigation',
    'site-title-tagline',
    'static-front-page',
  );
 
  $options = wdwt_get_option_parameters();
  // Add options to the section

  wdwt_customizer_add_section_options( $options );
}



function wdwt_customizer_add_section_options( $options_array) {
  global $wp_customize;
 
  foreach ( $options_array as $optionname => $option ) {
    // Add setting
    if ( isset( $option['customizer'] ) ) {
      $defaults = array(
        'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'theme_supports'       => '',
        'transport'            => 'refresh',
        'sanitize_callback'    => '',
        'sanitize_js_callback' => ''
      );
      $setting = wp_parse_args( $option['customizer'], $defaults );
      $setting_id = WDWT_OPT.'[' . $optionname . ']';
      $sanitize_callback = wdwt_options_customizer_validate($option);

      $wp_customize->add_setting( $setting_id, array(
        'default'              => $option['default'],
        'type'                 => $setting['type'],
        'capability'           => $setting['capability'],
        'theme_supports'       => $setting['theme_supports'],
        'transport'            => $setting['transport'],
        'sanitize_callback'    => $sanitize_callback,
        'sanitize_js_callback' => $setting['sanitize_js_callback'],
      ) );

      // Add controls
      require_once('WDWT_control_classes.php');
      // Check for a specialized control class
          
      // Dynamically generate a new class instance
      if(class_exists ( "WDWT_control_".$option['type'] )){
        $classname  = "WDWT_control_".$option['type'];
        $wp_customize->add_control( new $classname( $wp_customize, $setting_id, array('element'=>$option) ) );
      
      } 
      else {

        $wp_customize->add_control( $setting_id, array(
          'settings' => $setting_id,
          'label'    => $option['title'],
          'section'  => $option['section'],
          'type'     => $option['type']
          )
        );
      }
    }
  }
}


function wdwt_options_customizer_validate($param){
  
  if(!isset($param['type'])){
    return '';
  }
  if(!isset($param ['sanitize_type'])){
    $param ['sanitize_type'] ='';
  }


  switch ($param['type']) :
    case 'text':
    case 'textarea':
    case 'upload_single':
    case 'number':
      $callback_func = "text_" . $param ['sanitize_type'];
      break;
    case 'textarea_slider':
    case 'text_slider' :
    case 'upload_multiple' :
      $callback_func = "text_slider_" . $param ['sanitize_type'];
      break;
    case 'select' :
    case 'select_open' :
    case 'select_style' :
      $callback_func = "select_". $param ['sanitize_type'];
      break;
    default :
      return '';
      break;
  endswitch;

  return array('WDWT_customizer_sanitizer', $callback_func);

}



function wdwt_customizer_add_scripts(){

  wp_enqueue_script('media-upload');
  add_thickbox();

  wp_enqueue_script( 'wdwt_jquery-show', WDWT_URL.'/inc/js/jquery-show.js',array( 'jquery'), WDWT_VERSION);
  wp_enqueue_script( 'wdwt_customizer-preview', WDWT_URL.'/inc/lib/WDWT_elements.js',array( 'jquery','wp-color-picker','wdwt_jquery-show' ), WDWT_VERSION, true);
  wp_localize_script( 'wdwt_customizer-preview', 'wdwt_slide_warning', __("You cannot delete the last slide! Try to turn off the slider", "best-magazine") );
  wp_localize_script( 'wdwt_customizer-preview', 'wdwt_is_customizer', 'yes' );
  
  wp_enqueue_style( 'wdwt_customizer_style', WDWT_URL. '/inc/css/admin.css', array(),WDWT_VERSION );
  
  wp_enqueue_script( 'wdwt_customizer-main', WDWT_URL.'/inc/customizer/customizer.js',array( 'jquery'), WDWT_VERSION);
  $params_array = array(
    'homepage' => WDWT_HOMEPAGE,
    'img_URL' => WDWT_IMG_INC,
  );
  wp_localize_script( 'wdwt_customizer-main', 'WDWT', $params_array );
}

/**
 * called right before the wdwt_include_head() to update the options variable value
 * pre_option hook is called in customizer API
 */

function wdwt_customizer_refresh_head(){
  global $wdwt_options,
    $wdwt_front;
  $wdwt_options = wdwt_get_options();
  $front_class = WDWT_VAR.'_front';
  $wdwt_front =  new $front_class($wdwt_options);

}



