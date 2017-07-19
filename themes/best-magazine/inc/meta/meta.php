<?php
if ( is_admin() ) {
    add_action( 'load-post.php', 'wdwt_meta_init' );
    add_action( 'load-post-new.php', 'wdwt_meta_init' );
}

function wdwt_meta_init(){
  
  $wdwt_post_meta = new Best_magazine_meta();  
}


require_once('WDWT_meta.php');

class Best_magazine_meta extends WDWT_meta{
  
  public function __construct(){
    wp_enqueue_style( WDWT_VAR.'_admin_stylesheet', WDWT_URL . '/inc/css/admin.css', array(), WDWT_VERSION );  
    wp_enqueue_script(WDWT_VAR.'_admin_element_view_script', WDWT_URL.'/inc/lib/WDWT_elements.js',array( /*'jquery','wp-color-picker'*/ ), WDWT_VERSION, true);
    wp_localize_script( WDWT_VAR.'_admin_element_view_script', 'wdwt_slide_warning', __("You cannot delete the last slide! Try to turn off the slider", "best-magazine") );
    /* parent classes for all meta models and controllers*/
    require_once('WDWT_meta_model_section.php');
    require_once ('WDWT_meta_controller_section.php');

    /*content for layout*/
    require_once('meta_layout_controller.php');
    $layout = new Best_magazine_meta_layout_controller();
    array_push($this->meta_sections, $layout);
        
    add_action( 'add_meta_boxes',array($this, 'init'));
    add_action( 'save_post', array($this, 'save')); 
  }

}

