<?php


class WDWT_meta_controller_section{
  
  protected $model;
  protected $view;

   
  public function view($meta)
  {
    $this->view->view($meta);
  }

  public function save($post_id)
  {
    /*add sanitization!*/

    $meta_old = get_post_meta($post_id, WDWT_META, true);

    if(isset($_POST[WDWT_META])){
      $meta_new = $_POST[WDWT_META];
    }
    else{
      $meta_new = ''; 
    }
    /*check empty selects Ttt!!!*/
    $section_meta = array();
    foreach ($this->model->params as $key => $value) {
      if(isset($meta_new[$key])){
        $sanitize_type = isset($value['sanitize_type']) ? $value['sanitize_type'] : '';
        $validate_type = isset($value['validate_type']) ? $value['validate_type'] : '';
        $valid_options = isset($value['valid_options']) ? $value['valid_options'] : '';
        $section_meta[$key] = wdwt_param_clean($meta_new[$key], $value['default'], $value['type'], $sanitize_type, $validate_type = '', $valid_options = array());
      }
      if($value['type']=='checkbox' || $value['type']=='checkbox_open'){/*not elseif !*/
        $section_meta[$key] = ( isset( $meta_new[$key] ) ? true : false );
      }
    }
    return $section_meta;
  }



}
