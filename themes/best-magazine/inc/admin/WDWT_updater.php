<?php



class WDWT_updater{

  /*old version saved in settings*/
  public $version_old;
  /*current new version*/
  public $version_new;
  protected $options = array();
  protected $mods = array();

  function __construct($new_version, $old_version = '0.0.0' ){
    if(substr ( $old_version , 0, 1 ) == '2'){
      $this->version_old = '1'.substr ($old_version, 1);
    }
    else{
      $this->version_old = $old_version; 
    }
    if(substr ( $new_version , 0, 1 ) == '2'){
      $this->version_new = '1'.substr ($new_version, 1);
    }
    else{
      $this->version_new = $new_version; 
    }

  }



  /**
   *  get all params saved in previous versions in new format
   */

  public function get_old_params(){
    /*if not update or upgrade*/
    if(!$this->compare_version($this->version_new, $this->version_old)){
      $this->options = get_option(WDWT_OPT, false );
      $current_theme = wp_get_theme();
      $current_version = $current_theme->get( 'Version' );

      if(substr( $current_version , 0, 1 ) == '2' && 
        substr( $this->version_old , 0, 1 ) == '1' && 
        substr( $current_version , 1) == substr( $this->version_old , 1) ){
        /*upgrade to same pro*/
      }
      /*save theme version*/
      $this->options['theme_version'] = $current_version;
      update_option(WDWT_OPT, $this->options);
      return $this->options;
    }

    $from_theme_mod = false;
    $this->mods = get_option($this->theme_mods_name );
    $this->options = get_option(WDWT_OPT, false );
    $this->update_old_meta();
    $widgets_updated = $this->update_old_widgets();

    /* if theme is installed first time*/
	  if(!$widgets_updated && count($this->mods) <= 1  && empty($this->options)){
  	  /*save only version*/
  	  $current_theme = wp_get_theme();
  		$this->options['theme_version'] = $current_theme->get( 'Version' );
  		update_option(WDWT_OPT, $this->options);
  		/*does not save other options*/
      return $this->options;
	  }
    

    foreach ($this->rules as $version => $changes) {
      if($this->compare_version($version, $this->version_old)){
        foreach($changes as $change){
          
          $function_name = $change['type'];
          $args = isset($change['args']) ? $change['args'] : array();
          $old_name = $change['old'];
          $new_name = $change['new'];
          if($version == $this->version_set_api){
            /*get param from theme mods*/
            $from_theme_mod = true;
            $old_val = $this->get_param($old_name, $this->mods, null);
            if(isset($this->mods[$old_name])){
              unset($this->mods[$old_name]); /*string only ttt!!!*/  
            }
          }
          else{
            /*get param from options*/
            $old_val = $this->get_param($old_name, $this->options, null);
            if(isset($this->options[$old_name])){
              unset($this->options[$old_name]); /*string only ttt!!!*/ 
            }
          }
    		  if(!is_null($old_val)){
    			  $this->$function_name($old_val, $new_name, $args); /*set new val*/
    		  }
        }
      }


    }
    
    if($from_theme_mod || $widgets_updated){
      update_option($this->theme_mods_name, $this->mods); /*save theme_mod back without old params*/
    }
    
    

    $current_theme = wp_get_theme();
    $current_version = $current_theme->get( 'Version' );

    if(substr( $current_version , 0, 1 ) == '2' && 
      substr( $this->version_old , 0, 1 ) == '1' && 
      substr( $current_version , 1) == substr( $this->version_old , 1) ){
      /*upgrade to pro*/
    }

    /*save theme version*/
    $this->options['theme_version'] = $current_version;
    update_option(WDWT_OPT, $this->options);

    return $this->options;

  }

  /**
   *  get all meta params saved in previous versions in new format
   */

  private function update_old_meta(){

    /*return if there is no change */
    $update_needed = false;
    foreach($this->rules_meta as $version => $changes){
      if($this->compare_version($version, $this->version_old)){
        $update_needed = true;
      }
    }
    if(!$update_needed ){
      return false;
    }

  	$all_posts = get_posts();
  	$all_pages = get_pages();
  	$all_posts = array_merge($all_posts, $all_pages);

  	foreach($all_posts as $current_post) {
  	  foreach(get_post_meta( $current_post ->ID ) as $key => $post_meta_value) {
  			if($key == $this->old_meta_name) {
  				$old_meta = get_post_meta( $current_post ->ID, $key, TRUE);		
  				if($old_meta != "") {
  					foreach($this->rules_meta as $version => $changes){
              if($this->compare_version($version, $this->version_old)){
    						
                foreach($changes as $change){
    							$old_name = $change['old'];
    							$new_name = $change['new'];
    							if(isset($old_meta[$old_name])){
                    if(isset($change['type'])){
                      /*if value changed*/
                      $function_name = $change['type'];
                      $old_meta[$new_name] = $this->$function_name($old_meta[$old_name]); 
                    }
                    else{
                      /*if only name changed*/
                      $old_meta[$new_name] = $old_meta[$old_name];  
                    }
                    if($new_name != $new_name){
                      unset($old_meta[$old_name]);  
                    }
    							}
                  elseif(isset($change['external']) && $change['external'] == true ){
                    /*bring lost meta into profixed theme meta */
                    $old_val = get_post_meta( $current_post ->ID, $old_name, TRUE); 

                    if(!empty($old_meta)){
                      if(isset($change['type'])){
                        /*if value changed*/
                        $function_name = $change['type'];
                        $old_meta[$new_name] = $this->$function_name($old_val); 
                      }
                      else{
                        /*if only name changed*/
                        $old_meta[$new_name] = $old_val;  
                      }
                      /*delete not prefixed old meta key*/
                      delete_post_meta($current_post ->ID, $old_name, $old_val);
                    }
                  }
    						}
              }
  					}
  				    if(! update_post_meta( $current_post ->ID, WDWT_META, $old_meta)){
  						add_post_meta( $current_post ->ID, WDWT_META, $old_meta);
  					}
  					delete_post_meta( $current_post ->ID, $key);
  			    }
  			}
  		} 
  	  
  	}

  }


 /**
  *  
  */
  private function update_old_widgets(){
    $theme_mode = $this->mods;
    $updated = false;

    $mods_sidebars_widgets = array();
    if(isset($theme_mode['sidebars_widgets']['data'])){ 
      $mods_sidebars_widgets = $theme_mode['sidebars_widgets']['data'];
    }
    
    $opt_sidebars_widgets = get_option( 'sidebars_widgets', array() );

    foreach($this->rules_widget as $version => $changes){
      if($this->compare_version($version, $this->version_old)){

        foreach($changes as $change){
          $old_name = $change['old'];
          $new_name = $change['new'];
          $widget_opt = get_option( "widget_".$old_name );
          if( isset($widget_opt ) ){
            add_option( "widget_".$new_name, $widget_opt );
            delete_option( "widget_".$old_name );
            $updated = true;
          }
          /*sidebars_widgets array in theme_mods*/
          foreach($mods_sidebars_widgets as $sidebar_name => $widgets){
            if(is_array($widgets)){
              foreach($widgets as $i => $widget){
                if(strpos($widget,$old_name) !== false){
                  $updated = true;
                  $mods_sidebars_widgets[$sidebar_name][$i] = str_replace($old_name,$new_name,$widget);
                }
              }
            }
          }
          
          /*sidebars_widgets in wp_option*/
          foreach($opt_sidebars_widgets as $sidebar_name => $widgets){
            if(is_array($widgets)){
              foreach($widgets as $i => $widget){
                if(strpos($widget,$old_name) !== false){
                  $opt_sidebars_widgets[$sidebar_name][$i] = str_replace($old_name,$new_name,$widget);
                }
              }
            }
          }


        }
      }
    }/*all changes are applied*/
    if(!empty($mods_sidebars_widgets)){
      $this->mods['sidebars_widgets']['data'] = $mods_sidebars_widgets;  
    }
    update_option( 'sidebars_widgets', $opt_sidebars_widgets );
    
    return $updated;
  }
  

  /**
   *  return true if $new= $old 
   *  
   */

  public function compare_version($new, $old){
     $old_v = explode(".", $old);
     $new_v = explode(".", $new);

     if($old_v[0] == '0'){
      return true;
     }
     /*free->free OR pro-->pro*/
     elseif($old_v[0] == $new_v[0] ){
      if($old_v[1] < $new_v[1]){
        return true;
      }
      elseif($old_v[1] > $new_v[1]){
        return false;
      }
      elseif($old_v[2] < $new_v[2]){
        return true;
      }
     }
     /*free->pro*/
     elseif($old_v[0] == '1' && $new_v[0] == '2'){
      if($old_v[1] < $new_v[1]){
        return true;
      }
      elseif($old_v[1] > $new_v[1]){
        return false;
      }
      elseif($old_v[2] < $new_v[2]){
        return true;
      }
     }
     /*pro->free*/
     elseif($old_v[0] == '2' && $new_v[0] == '1'){
      return false;
     }
     return false;


  }
  

  /**
   * get posts and categories createdwith checkboxes
   */
  protected function get_old_posts_cats($val,$param_name, $args = array()){
    if(!is_array($val)){
  		$value = $val;
      if(is_integer($value)){
        $this->options[$param_name] = array($value);
      }

  		$val = json_decode( $val , true );
  		if( is_null($val)){ 
  		   if(is_string($value)){
  			   $this->options[$param_name] = explode(",", $value);
  		   }
  		}
      else {
        $new_val = array();
        foreach ($val as $key => $value) {
          array_push($new_val, $value);
        }
  		  $this->options[$param_name]= $new_val;
  		}
    }
    else{
  	  $this->options[$param_name]= $val;
  	}
  }
  /**
   * get posts and categories createdwith checkboxes
   */
  protected function get_old_posts_cats_meta($val){

    $value = $val;
    if(is_integer($value)){
      $result = array($value);
      return $result;
    }
    $val = json_decode( $val , true );
    $result = array();

    if( is_null($val)){ 
       if(is_string($value)){
        $result = explode(",", $value);
       }
    } else {
      $new_val = array();
      foreach ($val as $key => $value) {
        array_push($new_val, $value);
      }
      $result = $new_val;
    }
    return $result;
     
  }
  /**
   * 
   */

  protected function json_to_string($val,$param_name, $args = array()){
    if(is_array($val)){
      $this->options[$param_name] = implode("||wd||", $val);
    } else{
       $val = json_decode( $val , true );
       if( !is_null($val)){ 
        $this->options[$param_name] = implode("||wd||", $val);
       }else{
	    $this->options[$param_name] = $val;
	   }
    }
  } 

  /**
   * 
   */

  protected function select_to_select_array( $val,$param_name, $args = array()){

     if(is_array($val)){
      $this->options[$param_name] = $val;
     } else {
      $this->options[$param_name] = array($val);
     }
  }
  
  /**
   * 
   */

  protected function boolean_to_array( $val, $param_name, $args = array()){
	 if(is_bool($val)){
		 if($val === true){
		   $this->options[$param_name] = array('Only on Homepage');
		 }
		 if($val === false){
		   $this->options[$param_name] = array('Hide Slider');
		 }
	 }
   if(is_string($val)){
     if(trim($val) == '' || trim($val) === 'false'){
       $this->options[$param_name] = array('Hide Slider');
     }
     else{
       $this->options[$param_name] = array('Only on Homepage');
     }
   }

  }
  /**
   * 
   */

  protected function checkbox_add_to_radio( $val, $param_name, $args = array('value'=>'none','option_type'=>'option')){
	 if($val==='' || $val===false ){
		$this->options[$param_name] = array($args['value']);
	 } else {
	    if($args['option_type']=='option')
			$this->options[$param_name] = $this->get_param($param_name, $this->options, 'none');
		else
			$this->options[$param_name] = $this->get_param($param_name, $this->mods, 'none');
	}
}

  
  /*
   * only param name changed
   */

  protected function get_param_with_old_name( $val, $param_name, $args = array()){
		$this->options[$param_name] = $val;
  }

  
  
 



  /**
   * get param with given name from theme mods
   */

  protected function get_theme_mod_param(){



  }


  /**
  *
  * return value of parameter
  * first looks for parameter in $opt_array
  * @param $param_name 'menu_bg_color' or '[colors][menu][bg_color]'
  */
  public function get_param($param_name, $opt_array = array(), $default =''){
    $value=false;
    preg_match_all("/\[([^\]]*)\]/", $param_name, $matches);
    /*if param name is string*/
    if(empty($matches[1])){
      if(isset($opt_array[$param_name])){
        $value = $opt_array[$param_name];
      }
      else{
        $value = $default;
      }
      return $value;
    }
    else{/*if param name is array*/
      $in_opts = false;
      $value = $opt_array;
      foreach($matches[1] as $subparam)
      {
        if(isset($value[$subparam])){
          /*dig into meta array*/
          $value = $value[$subparam];
          $in_opts = true;
        }
        else{
          $in_opts = false;
          break;
        }
      }
      
      if($in_opts){
        /*param value is found in meta*/
        return $value;
      }
      else{
        return $default;
      }
    }
    return $default;
    
  }









}


















