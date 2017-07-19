<?php
class WDWT_slider_page_class{

  public $shorthomepage;
  public $options;

  function __construct(){
    $this->shortslider = "";
    $this->options = array();

    if ( is_plugin_active( 'slider-wd/slider-wd.php' )) {

      $this->options['show_slider_wd'] = array(
        "name" => "show_slider_wd",
        "title" =>  __("Show Slider WD in header","best-magazine"),
        'type' => 'checkbox_open',
        'show' => array('slider_wd_id'),
        'hide' => array("image_height","animation_speed","slideshow_interval","stop_on_hover","effect","title_position","description_position","slider_head","slider_head_href","slider_head_title","slider_head_desc"),
        "sanitize_type" => "",
        "description" => __("Show Slider WD","best-magazine"),
        'section' => 'slider_main',
        'tab' => 'slider',
        'default' => false,
        'customizer'=>array()
      );
      if(function_exists('wds_get_sliders')){
        $this->options['slider_wd_id'] = array(
          "name" => "slider_wd_id",
          "title" =>  __("Choose Slider","best-magazine"),
          'type' => 'select',
          "sanitize_type" => "sanitize_text_field",
          'valid_options' => wds_get_sliders(),
          "description" => "",
          'section' => 'slider_main',
          'tab' => 'slider',
          'default' => array(''),
          'customizer'=>array()
        );
      }
      else{
        $this->options['slider_wd_id'] = array(
          "name" => "slider_wd_id",
          "title" =>  __("Enter Slider WD id","best-magazine"),
          'type' => 'number',
          "sanitize_type" => "sanitize_text_field",
          "description" => "",
          'section' => 'slider_main',
          'tab' => 'slider',
          'default' => "1",
          'customizer'=>array()
        );
      }

    }

    $this->options['hide_slider'] = array(
      'name' => 'hide_slider',
      'title' => __( 'Specify where slider should be shown.', "best-magazine" ),
      'type' => 'select',
      'valid_options' => array(
        "Only on Homepage" => __( "Only on Homepage", "best-magazine" ),
        "On all the pages and posts" => __( "On all the pages and posts", "best-magazine" ),
        "Hide Slider" => __( "Hide Slider", "best-magazine" ),
      ),
      'description' => '',
      'section' => 'slider_main',
      'tab' => 'slider',
      'default' => array('Only on Homepage'),
      'customizer' => array()
    );

    $this->options["image_height"] =  array(
      "name" => "image_height",
      "title" => __("Slider Height", "best-magazine" ),
      'type' => 'text',
      "sanitize_type" => "sanitize_text_field",
      "description" => __("Slider with the width of 1024px will have this height. When resized, image dimensions ratio is preserved.", "best-magazine" ),
      'section' => 'slider_main',
      'tab' => 'slider',
      'default' => '360',
      'customizer' => array()

    );

    $this->options["animation_speed"] = array(
      "name" => "animation_speed",
      "title" => __("Animation Speed", "best-magazine" ),
      'type' => 'text',
      "sanitize_type" => "sanitize_text_field",
      "description" => __("When using an animation for the slider, you can control its speed. You can use the provided box to fill in the optimal speed.", "best-magazine" ),
      'section' => 'slider_main',
      'tab' => 'slider',
      'default' => '800',
      'customizer' => array()
    );

    $this->options["slideshow_interval"] = array(
      "name" => "slideshow_interval",
      "title" => __("Pause Time", "best-magazine" ),
      'type' => 'text',
      "sanitize_type" => "sanitize_text_field",
      "description" => __("The timing for the slider animation can be customized. You can adjust it providing timing in the corresponding box.", "best-magazine" ),
      'section' => 'slider_main',
      'tab' => 'slider',
      'default' => '5000',
      'customizer' => array()
    );


    $this->options["stop_on_hover"] = array(
      "name" => "stop_on_hover",
      "title" => __("Stop animation while hovering", "best-magazine" ),
      'type' => 'checkbox',
      "sanitize_type" => "sanitize_text_field",
      "description" =>__( "By default slider animation is constant. However you can choose it to stop while hovering, checking the box for this option.", "best-magazine" ),
      'section' => 'slider_main',
      'tab' => 'slider',
      'default' => false,
      'customizer' => array()
    );


    $this->options["effect"] = array(
      "name" => "effect",
      "title" => __("Effect", "best-magazine" ),
      'type' => 'select',
      "sanitize_type" => "sanitize_text_field",
      "description" => __("The animation of the slider can be customized with the help of various effects. You can choose the slider animation effect from the list included below.", "best-magazine" ),
      "valid_options" => array(
        "none" => "None",
        "cubeH"  =>  "Cube Horizontal",
        "cubeV"  =>  "Cube Vertical",
        "fade"  =>  "Fade",
        "sliceH"  =>  "Slice Horizontal",
        "sliceV"  =>  "Slice Vertical",
        "slideH"  =>  "Slide Horizontal",
        "slideV"  =>  "Slide Vertical",
        "scaleOut"  =>  "Scale Out",
        "scaleIn"  =>  "Scale In",
        "blockScale"  =>  "Block Scale",
        "kaleidoscope"  =>  "Kaleidoscope",
        "fan"  =>  "Fan",
        "blindH"  =>  "Blind Horizontal",
        "blindV"  =>  "Blind Vertical",
        "random"  =>  "Random",
      ),
      'disabled'=> array("cubeH", "cubeV", "sliceH", "sliceV","slideH", "slideV", "scaleOut", "scaleIn", "blockScale", "kaleidoscope", "fan", "blindH", "blindV",  "random" ),
      'section' => 'slider_main',
      'tab' => 'slider',
      'default' => array('fade'),
      'customizer' => array()
    );

    $this->options["title_position"] = array(
      "name" => "title_position",
      "title" => __("Title Position", "best-magazine" ),
      'type' => 'select',
      "sanitize_type" => "sanitize_text_field",
      "description" => "",
      "valid_options" => array(
        "left-top" => "left-top",
        "left-middle"  =>  "left-middle",
        "left-bottom"  =>  "left-bottom",
        "center-top"  =>  "center-top",
        "center-middle"  =>  "center-middle",
        "center-bottom"  =>  "center-bottom",
        "right-top"  =>  "right-top",
        "right-middle"  =>  "right-middle",
        "right-bottom"  =>  "right-bottom"
      ),
      'section' => 'slider_main',
      'tab' => 'slider',
      'default' => array('right-top'),
      'customizer' => array()
    );

    $this->options["description_position"] = array(
      "name" => "description_position",
      "title" => __("Description Position", "best-magazine" ),
      'type' => 'select',
      "sanitize_type" => "sanitize_text_field",
      "description" => "",
      "valid_options" => array(
        "left-top" => "left-top",
        "left-middle"  =>  "left-middle",
        "left-bottom"  =>  "left-bottom",
        "center-top"  =>  "center-top",
        "center-middle"  =>  "center-middle",
        "center-bottom"  =>  "center-bottom",
        "right-top"  =>  "right-top",
        "right-middle"  =>  "right-middle",
        "right-bottom"  =>  "right-bottom"
      ),
      'section' => 'slider_main',
      'tab' => 'slider',
      'default' => array('right-bottom'),
      'customizer' => array()
    );

    $this->options["slider_head"] = array(
      "name" => "slider_head",
      "title" => "",
      'type' => 'upload_multiple',
      "sanitize_type" => "esc_url_raw",
      "option" => array(
        "imgs_href" => "slider_head_href",
        "imgs_title" =>  "slider_head_title",
        "imgs_description" => "slider_head_desc"
      ),
      "description" => "",
      'section' => 'slider_imgs',
      'tab' => 'slider',
      'default' =>  get_template_directory_uri()."/images/slide_1.jpg" .
        $this->get_delimiter().
        get_template_directory_uri()."/images/slide_2.jpg",
      'customizer' => array()
    );

    $this->options["slider_head_href"] = array(
      "name" => "slider_head_href",
      "title" => "",
      'type' => 'text_slider',
      "sanitize_type" => "esc_url_raw",
      "description" => "",
      'section' => 'slider_imgs',
      'tab' => 'slider',
      'default' => $this->get_delimiter(),
      'customizer' => array()
    );

    $this->options["slider_head_title"] = array(
      "name" => "slider_head_title",
      "title" => "",
      'type' => 'text_slider',
      "sanitize_type" => "sanitize_text_field",
      "description" => "",
      'section' => 'slider_imgs',
      'tab' => 'slider',
      'default' => $this->get_delimiter(),
      'customizer' => array()
    );
    $this->options["slider_head_desc"] = array(
      "name" => "slider_head_desc",
      "title" => "",
      'type' => 'textarea_slider',
      "sanitize_type" => "sanitize_html_field",
      "description" => "",
      'section' => 'slider_imgs',
      'tab' => 'slider',
      'default' => "Responsive theme to create news websites with structured content and easy navigation.".
        $this->get_delimiter().
        "Minimum coding knowledge is required for customizing almost every detail that shows up in the front-end.",
      'customizer' => array()
    );





  }

  private function get_delimiter(){
    return "||wd||";
  }
}






