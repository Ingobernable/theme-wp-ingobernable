<?php 


 
///// initial menu
add_action('admin_menu','WDWT_admin_menu');

function WDWT_admin_menu(){
		
  $WDWT_option=add_theme_page( WDWT_TITLE, WDWT_TITLE, 'edit_theme_options', WDWT_SLUG, 'WDWT_admin_options_page' ); 
  add_action('admin_print_styles-' . $WDWT_option, 'WDWT_admin_scripts'); 
}








function wdwt_register_settings() {
  global $WDWT_tabs;
  $WDWT_tabs = WDWT_get_tabs();

  $option_parameters = WDWT_get_option_parameters();

  register_setting(   'wdwt_options', 'theme_'.WDWT_VAR.'_options',  'wdwt_options_validate' ); 

}

add_action( 'admin_init', 'wdwt_register_settings' );


function WDWT_get_settings_by_tab() {
  $tabs = WDWT_get_tabs();
  $settingsbytab = array();
  foreach ( $tabs as $tab ) {
    $tabname = $tab['name'];
    $settingsbytab[] = $tabname;
  }
  $option_parameters = WDWT_get_option_parameters();
  foreach ( $option_parameters as $option_parameter ) {
    $optionname =  (isset($option_parameter['name']) && $option_parameter['name'] !='' ) ? $option_parameter['name'] : false;
    if($optionname){
      $optiontab = $option_parameter['tab'];
      $settingsbytab[$optiontab][] = $optionname;
      $settingsbytab['all'][] = $optionname;
    }
  }

  return $settingsbytab;
}

function wdwt_get_current_tab() {

    if ( isset( $_GET['tab'] ) ) {
        $current = $_GET['tab'];
        if($current != 'licensing' && $current != 'featured_plugins'){
          $current = 'licensing';
        }
    }
    else {
      $current = 'licensing';
    }
    $tabs = wdwt_get_tabs();
    
    if(!array_key_exists($current, $tabs)){
      $current = 'general';
    }
  return apply_filters( 'wdwt_get_current_tab', $current );
}




function WDWT_admin_options_page() {

  global $wdwt_options;
  
  global $WDWT_licensing_page;
  
  $currenttab = wdwt_get_current_tab();
  $tabs = WDWT_get_tabs();
  $options = $wdwt_options;
  
  $current_settings_sections = 'WDWT_' . $currenttab . '_tab'; 
  $tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'general' ); 

  ?>

  <div class="wrap free" id="main_<?php echo $currenttab; ?>_page">
    <h1 class="screen-reader-text"><?php echo WDWT_TITLE; ?></h1>
    <?php 
      if(WDWT_LOGO_SHOW){
      ?>
      <a href="<?php echo WDWT_HOMEPAGE ?>/wordpress-themes.html" target="_blank">
        <div style="background:url(<?php echo WDWT_IMG_INC; ?>adminheader.jpg) no-repeat; background-size: auto 100%; background-position:center; width:calc(100% - 4px); height:72px; margin:2px;"></div>
      </a>
      <?php }

      WDWT_admin_options_page_tabs(); 
      if ( isset( $_GET['settings-updated']) ){
        echo "<div class='updated'><p>Theme settings updated successfully.</p></div>";
      }
      /*pages without option submit forms*/
      if ($currenttab == 'licensing'):
        echo $WDWT_licensing_page->view();
      /*pages with forms to submit options*/
      else:
        echo $WDWT_licensing_page->view();
      endif; 
      ?>
   </div>
  <?php 
}


function WDWT_admin_scripts(){
  wp_enqueue_script( 'common' );
  wp_enqueue_script( 'jquery-color' );
  wp_print_scripts('editor');
  if (function_exists('add_thickbox')) {
    add_thickbox();
  }
  wp_print_scripts('media-upload');
  wp_admin_css();
  wp_enqueue_script('utils');
  do_action("admin_print_styles-post-php");
  do_action('admin_print_styles');

  wp_enqueue_style( WDWT_VAR.'_admin_stylesheet', WDWT_URL . '/inc/css/admin.css', array(), WDWT_VERSION );
  wp_enqueue_script( 'admin_element_view_script', WDWT_URL.'/inc/lib/WDWT_elements.js',array( 'jquery' ), WDWT_VERSION, true);
  wp_localize_script( 'admin_element_view_script', 'wdwt_slide_warning', __("You cannot delete the last slide! Try to turn off the slider", "best-magazine") );


}



?>