<?php 

class WDWT_meta_model{


  /**
  *
  * return value of parameter
  * looks for parameter in options
  * @param $param_name 'menu_bg_color' or '[colors][menu][bg_color]'
  */
  public function get_param($param_name, $default = false){
    global $wdwt_options;
    $value=false;
    $options_array = $wdwt_options;

    preg_match_all("/\[([^\]]*)\]/", $param_name, $matches);
    /*if param name is string*/
    if(empty($matches[1])){
      if(isset($options_array[$param_name])){
        $value = $options_array[$param_name];
      }
      else{
        $value = $default;
      }
      return $value;
    }
    else{/*if param name is array*/
      $value = $options_array;
      $in_options = true;
      foreach($matches[1] as $subparam)
      {
        if(isset($value[$subparam])){
          /*dig into options array*/
          $value = $value[$subparam];
          $in_options = true;
        }
        else{
          $in_options = false;
          break;
        }
      }
      if($in_options){
        /*param value is found in options*/
        return $value;
      }
      else{
        return $default;
      }
    }
    return $default;
    
  }

  protected function post_type_check(){
    $screen = get_current_screen();
    if($screen->post_type == 'page')
      return 'page';
    else
      return 'post';
 
  }
  
}


