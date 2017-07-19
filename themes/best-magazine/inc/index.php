<?php 



/*include framework */

 /* include admin controller */
  require_once('admin/WDWT_admin_controller.php');
  /*filter function for sanitizing and validating*/  
  require_once( 'lib/WDWT_input.php' );  
  /*views for theme options and meta*/  
  require_once( 'lib/WDWT_output.php' );
 /*include customizer*/
  require_once('customizer/customizer.php');

//notices
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
  include_once('notices/WDWT_notices.php');
  $wdwt_notices = new WDWT_Notices();
}

if(is_admin()){
  /*include admin cpanel*/
  require_once('admin/WDWT_admin_cpanel.php');
  /*include TGM PA*/
  require_once('admin/plugins.php'); 
  /*include meta*/
  require_once('meta/meta.php');
 
}
else{
  /* include front end */
  require_once('front/frontend_params_output.php');
  require_once('front/frontend_functions.php');

  global $wdwt_front;
  
  
}
/* include widgets*/
require_once( 'widgets/widgets.php' );

