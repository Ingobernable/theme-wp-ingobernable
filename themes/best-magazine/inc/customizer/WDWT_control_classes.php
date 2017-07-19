<?php



class WDWT_control extends WP_Customize_Control {
  public $type = '';
  public $context = 'option';
  public $opt_val ='';
  public $element = array();
  public $params= array(
      "input_size"=>"36",
      "textarea_height"=>"200",
      "textarea_width"=>"250",
      "select_width"=>"200",
      "upload_size" => "36",
      "upload_filetype" => "image",
    );
  public function __construct( $manager, $id, $args = array() ) {
    
    parent::__construct( $manager, $id, $args );
    $this->section = $args['element']['section'];
    $this->label = isset($args['element']['title']) ? $args['element']['title'] : "";
    $this->description = isset($args['element']['description']) ? $args['element']['description'] : '';
    $this->type = $args['element']['type'];
    $this->element['custom_attrs'] = array();
    
  }
  protected function refresh_link( $setting_key = 'default'){
    if ( isset( $this->settings[ $setting_key ] ) ){
      /*if($this->type == 'select' || $this->type == 'select_open'){
        
        $this->element['custom_attrs']['data-customize-setting-link'] = esc_attr( $this->settings[ $setting_key ]->id )."[]";  
      }
      else{*/
        $this->element['custom_attrs']['data-customize-setting-link'] = esc_attr( $this->settings[ $setting_key ]->id );  
      /*}*/
      
    
    }
  }

}

class WDWT_control_Color extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
    $wdwt_admin_elements->color($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}



class WDWT_control_Checkbox extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->checkbox($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}


class WDWT_control_Checkbox_Open extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->checkbox_open($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}

class WDWT_control_Radio extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->radio($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}

class WDWT_control_Radio_Open extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->radio_open($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}

class WDWT_control_Layout extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->radio_images($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}
class WDWT_control_Layout_Open extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->radio_images_open($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}

class WDWT_control_Number extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
    $wdwt_admin_elements->number($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}


class WDWT_control_Select extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->select($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}

class WDWT_control_Select_Open extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->select_open($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}
class WDWT_control_Select_Style extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->select_style($this->element, 'customizer', $this->opt_val);
    ?>
    </label>

    <?php
  }
}

class WDWT_control_Textarea extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    $this->element['width'] = $this->params['textarea_width'];
    $this->element['height'] = $this->params['textarea_height'];
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
    $wdwt_admin_elements->textarea($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}

class WDWT_control_Text extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
    $wdwt_admin_elements->input($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}


class WDWT_control_Upload_Single extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    $this->refresh_link();
    
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->upload_single($this->element, 'option', $this->opt_val);
    ?>
    </label>

    <?php
  }
}

class WDWT_control_Upload_Multiple extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    /* hardcode data-customize-setting-link in element view*/
    
    ?>
    <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    <?php
      $wdwt_admin_elements->upload_multiple($this->element, 'customizer', $this->opt_val);
    ?>
    </label>

    <?php
  }
}
class WDWT_control_Text_Slider extends  WDWT_control {
  public function render_content(){
    
    /*show nothing!*/
  }
}
class WDWT_control_Textarea_Slider extends  WDWT_control {
  public function render_content(){
    /*show nothing!*/
  }
}



class WDWT_control_Diagram extends  WDWT_control {
  public function render_content(){
    global $wdwt_admin_elements;
    /* hardcode data-customize-setting-link in element view*/  ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
      <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
      <?php $wdwt_admin_elements->diagram($this->element, 'customizer', $this->opt_val); ?>
    </label>
    <?php
  }
}

class WDWT_control_Text_Diagram extends  WDWT_control {
  public function render_content(){ 
    /*show nothing!*/
  }
}




