<?php 
require_once ('WDWT_updater.php');


class Best_magazine_updater extends WDWT_updater{

  /*first version with settings API*/
  protected $version_set_api = '1.0.50'; 

  protected $old_meta_name = 'best_magazine_meta_date';  

  protected $theme_mods_name = 'theme_mods_best-magazine';

 /**
  * rules for converting old param to new
  *
  * keep order from old to new
  * 
  * 
  * start from $version_set_api
  * @param types: get_param_with_old_name, get_old_colors, checkbox_to_select, option_change, widget name change, slider
  */
  protected $rules = array(
       '1.1.0' => array(
       array('old'=> "top_post_categories", 'new'=>'top_post_categories' , 'type'=>'get_old_posts_cats' ),
       array('old'=> "home_page_tabs_exclusive", 'new'=>'home_page_tabs_exclusive' , 'type'=>'get_old_posts_cats'),
       array('old'=> "home_video_post", 'new'=>'home_video_post' , 'type'=>'select_to_select_array', 'args'=>array()),
       array('old'=> "content_post_categories", 'new'=>'content_post_categories' , 'type'=>'get_old_posts_cats'),
       array('old'=> "hide_slider", 'new'=>'hide_slider' , 'type'=>'boolean_to_array'),
       array('old'=> "imgs_url", 'new'=>'slider_head' , 'type'=>'json_to_string'),
       array('old'=> "imgs_href", 'new'=>'slider_head_href' , 'type'=>'json_to_string'),
       array('old'=> "imgs_title", 'new'=>'slider_head_title' , 'type'=>'json_to_string'),
       array('old'=> "imgs_description", 'new'=>'slider_head_desc' , 'type'=>'json_to_string'),
       array('old'=> "effect", 'new'=>'effect' , 'type'=>'select_to_select_array'),
       array('old'=> "title_position", 'new'=>'title_position' , 'type'=>'select_to_select_array'),
       array('old'=> "description_position", 'new'=>'description_position' , 'type'=>'select_to_select_array'),
       array('old'=> "type_headers_font", 'new'=>'text_headers_font' , 'type'=>'select_to_select_array'),
       array('old'=> "type_headers_kern", 'new'=>'text_headers_kern' , 'type'=>'select_to_select_array'),
       array('old'=> "type_headers_transform", 'new'=>'text_headers_transform' , 'type'=>'select_to_select_array'),
       array('old'=> "type_headers_variant", 'new'=>'text_headers_variant' , 'type'=>'select_to_select_array'),
       array('old'=> "type_headers_weight", 'new'=>'text_headers_weight' , 'type'=>'select_to_select_array'),
       array('old'=> "type_headers_style", 'new'=>'text_headers_style' , 'type'=>'select_to_select_array'),
       array('old'=> "type_primary_font", 'new'=>'text_primary_font' , 'type'=>'select_to_select_array'),
       array('old'=> "type_primary_kern", 'new'=>'text_primary_kern' , 'type'=>'select_to_select_array'),
       array('old'=> "type_primary_transform", 'new'=>'text_primary_transform' , 'type'=>'select_to_select_array'),
       array('old'=> "type_primary_variant", 'new'=>'text_primary_variant' , 'type'=>'select_to_select_array'),
       array('old'=> "type_primary_weight", 'new'=>'text_primary_weight' , 'type'=>'select_to_select_array'),
       array('old'=> "type_primary_style", 'new'=>'text_primary_style' , 'type'=>'select_to_select_array'),
       array('old'=> "type_secondary_font", 'new'=>'text_secondary_font' , 'type'=>'select_to_select_array'),
       array('old'=> "type_secondary_kern", 'new'=>'text_secondary_kern' , 'type'=>'select_to_select_array'),
       array('old'=> "type_secondary_transform", 'new'=>'text_secondary_transform' , 'type'=>'select_to_select_array'),
       array('old'=> "type_secondary_variant", 'new'=>'text_secondary_variant' , 'type'=>'select_to_select_array'),
       array('old'=> "type_secondary_weight", 'new'=>'text_secondary_weight' , 'type'=>'select_to_select_array'),
       array('old'=> "type_secondary_style", 'new'=>'text_secondary_style' , 'type'=>'select_to_select_array'),
       array('old'=> "type_inputs_font", 'new'=>'text_inputs_font' , 'type'=>'select_to_select_array'),
       array('old'=> "type_inputs_kern", 'new'=>'text_inputs_kern' , 'type'=>'select_to_select_array'),
       array('old'=> "type_inputs_transform", 'new'=>'text_inputs_transform' , 'type'=>'select_to_select_array'),
       array('old'=> "type_inputs_variant", 'new'=>'text_inputs_variant' , 'type'=>'select_to_select_array'),
       array('old'=> "type_inputs_weight", 'new'=>'text_inputs_weight' , 'type'=>'select_to_select_array'),
       array('old'=> "type_inputs_style", 'new'=>'text_inputs_style' , 'type'=>'select_to_select_array'),
       array('old'=> "menu_elem_back_color", 'new'=>'menu_elem_back_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#890000")),
       array('old'=> "sideb_background_color", 'new'=>'sideb_background_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FAFAFA")),
       array('old'=> "footer_sideb_background_color", 'new'=>'footer_sideb_background_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#e4e4e4")),
       array('old'=> "footer_back_color", 'new'=>'footer_back_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#CFCFCF")),
       array('old'=> "home_top_posts_color", 'new'=>'home_top_posts_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#F5F5F5")),
       array('old'=> "cat_tab_backgr_color", 'new'=>'cat_tab_backgr_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
       array('old'=> "top_posts_color", 'new'=>'top_posts_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#F5F5F5")),
       array('old'=> "primary_text_headers_color", 'new'=>'primary_text_headers_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
       array('old'=> "text_headers_color", 'new'=>'text_headers_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#890000")),
       array('old'=> "primary_text_color", 'new'=>'primary_text_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#2C2C2C")),
       array('old'=> "footer_text_color", 'new'=>'footer_text_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
       array('old'=> "primary_links_color", 'new'=>'primary_links_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
       array('old'=> "primary_links_hover_color", 'new'=>'primary_links_hover_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#440000")),
       array('old'=> "menu_links_color", 'new'=>'menu_links_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
       array('old'=> "menu_links_hover_color", 'new'=>'menu_links_hover_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
       array('old'=> "menu_color", 'new'=>'menu_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
       array('old'=> "selected_menu_color", 'new'=>'selected_menu_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
       array('old'=> "logo_text_color", 'new'=>'logo_text_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#890000")),
     array('old'=> "int_integration_bottom_adsense_type", 'new'=>'integration_bottom_adsense_type' , 'type'=>'get_param_with_old_name' ),
       array('old'=> "int_integration_head_adsense_type", 'new'=>'integration_head_adsense_type' , 'type'=>'get_param_with_old_name' ),
    ),
     
  );
  /**
  *  meta content should not be changed
  * only name
  *
  */
  protected $rules_meta = array(
       '1.0.50' => array(
       array('old'=> "layout", 'new'=>'default_layout' ),
       array('old'=> "content_width", 'new'=>'content_area' ),
       array('old'=> "main_col_width", 'new'=>'main_column' ),
       array('old'=> "pr_widget_area_width", 'new'=>'pwa_width' ),
       array('old'=> "fullwidthpage", 'new'=>'full_width' ),
       array('old'=> "blogstyle", 'new'=>'blog_style' ),
       array('old'=> "address", 'new'=>'addrval' ),
       array('old'=> "categories", 'new'=>'categories', 'type'=>'get_old_posts_cats_meta' ),
       array('old'=> "category_tabs_mst_pop", 'new'=>'category_tabs_mst_pop', 'type'=>'get_old_posts_cats_meta' ),
       array('old'=> "_single_post_soe_title", 'new'=>'seo_single_title', 'external' => true ),
       array('old'=> "_single_post_soe_description", 'new'=>'seo_single_description', 'external' => true ),
       array('old'=> "_single_post_soe_keywords", 'new'=>'seo_single_keywords', 'external' => true ),
       ),
  );


/**
 *  widget content should not be changed
 * only name
 *
 */
  protected $rules_widget = array(
   '1.0.50' => array(
      array('old'=> "web_buis_adsens", 'new'=>'best_magazine_adsens' ),
      array('old'=> "web_buis_adv", 'new'=>'best_magazine_adv' ),
      array('old'=> "exclusive_categ", 'new'=>'best_magazine_categ' ),
      array('old'=> "exclusive_events_categ", 'new'=>'best_magazine_events_categ' ),
      ),
   '1.1.4' => array(
      array('old'=> "spider_random_post", 'new'=>'best_magazine_random_post' ),
    ),
  );

  /**
  * get colors created with theme mods
  * $args=array('default'=>'','title'=>'')
  */

  protected function get_old_colors( $val, $param_name, $args=array()){
     $this->options['color_scheme']['active']=0;
     $this->options['color_scheme']['themes']=array(
        array("name" => "theme_1", "title" => "Color Scheme 1",),
        array("name" => "theme_2", "title" => "Color Scheme 2",),
        array("name" => "theme_3", "title" => "Color Scheme 3",),
        array("name" => "theme_4", "title" => "Color Scheme 4",),
        array("name" => "theme_5", "title" => "Color Scheme 5",),
      );
    $this->options['color_scheme']['colors'][0][$param_name]=  array(
        'value' => $val,
        'default' => $args['default']
    );
    
    $this->options['color_scheme']['colors'][1]=array(
      "menu_elem_back_color"          =>array('value' => "#006088", 'default' =>"#006088"),                
      "sideb_background_color"        =>array('value' => "#FAFAFA", 'default' =>"#FAFAFA"),                
      "footer_sideb_background_color" =>array('value' => "#333333", 'default' =>"#333333"),                
      "footer_back_color"             =>array('value' => "#414141", 'default' =>"#414141"),                
      "home_top_posts_color"          =>array('value' => "#F5F5F5", 'default' =>"#F5F5F5"),                
      "cat_tab_backgr_color"          =>array('value' => "#E5E5E5", 'default' =>"#E5E5E5"),                
      "top_posts_color"               =>array('value' => "#006088", 'default' =>"#006088"),                
      "primary_text_headers_color"    =>array('value' => "#000000", 'default' =>"#000000"),                
      "text_headers_color"            =>array('value' => "#890000", 'default' =>"#890000"),                
      "primary_text_color"                  =>array('value' => "#999999",
                                                                    'default' =>"#999999"),                
      "footer_text_color"                   =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "primary_links_color"                 =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "primary_links_hover_color"     =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "menu_links_color"                    =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "menu_links_hover_color"            =>array('value' => "#003E58",
                                                                    'default' =>"#003E58"),                
      "menu_color"                                =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "selected_menu_color"                 =>array('value' => "#003E58",
                                                                    'default' =>"#003E58"),                
      "logo_text_color"                     =>array('value' => "#006088",
                                                                    'default' =>"#006088"),
    );
    $this->options['color_scheme']['colors'][2]=array(
      "menu_elem_back_color"          =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "sideb_background_color"        =>array('value' => "#FAFAFA",
                                                                    'default' =>"#FAFAFA"),                
      "footer_sideb_background_color" =>array('value' => "#E4E4E4",
                                                                    'default' =>"#E4E4E4"),                
      "footer_back_color"                   =>array('value' => "#D0D0D0",
                                                                    'default' =>"#D0D0D0"),                
      "home_top_posts_color"          =>array('value' => "#F5F5F5",
                                                                    'default' =>"#F5F5F5"),                
      "cat_tab_backgr_color"          =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "top_posts_color"                     =>array('value' => "#003E58",
                                                                    'default' =>"#003E58"),                
      "primary_text_headers_color"    =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "text_headers_color"                =>array('value' => "#1f1f1f",
                                                                    'default' =>"#1f1f1f"),                
      "primary_text_color"                  =>array('value' => "#A0A0A0",
                                                                    'default' =>"#A0A0A0"),                
      "footer_text_color"                   =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "primary_links_color"                 =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "primary_links_hover_color"     =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "menu_links_color"                    =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "menu_links_hover_color"            =>array('value' => "#003E58",
                                                                    'default' =>"#003E58"),                
      "menu_color"                                =>array('value' => "#003E58",
                                                                    'default' =>"#003E58"),                
      "selected_menu_color"                 =>array('value' => "#003E58",
                                                                    'default' =>"#003E58"),                
      "logo_text_color"                     =>array('value' => "#003E58",
                                                                    'default' =>"#003E58"),
    );
    $this->options['color_scheme']['colors'][3]=array(
      "menu_elem_back_color"          =>array('value' => "#004716",
                                                                    'default' =>"#004716"),                
      "sideb_background_color"        =>array('value' => "#FAFAFA",
                                                                    'default' =>"#FAFAFA"),                
      "footer_sideb_background_color" =>array('value' => "#E4E4E4",
                                                                    'default' =>"#E4E4E4"),                
      "footer_back_color"                   =>array('value' => "#CFCFCF",
                                                                    'default' =>"#CFCFCF"),                
      "home_top_posts_color"          =>array('value' => "#F5F5F5",
                                                                    'default' =>"#F5F5F5"),                
      "cat_tab_backgr_color"          =>array('value' => "#FEFEFE",
                                                                    'default' =>"#FEFEFE"),                
      "top_posts_color"                     =>array('value' => "#004716",
                                                                    'default' =>"#004716"),                
      "primary_text_headers_color"    =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "text_headers_color"                =>array('value' => "#1f1f1f",
                                                                    'default' =>"#1f1f1f"),                
      "primary_text_color"                  =>array('value' => "#A0A0A0",
                                                                    'default' =>"#A0A0A0"),                
      "footer_text_color"                   =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "primary_links_color"                 =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "primary_links_hover_color"     =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "menu_links_color"                    =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "menu_links_hover_color"            =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "menu_color"                                =>array('value' => "#004716",
                                                                    'default' =>"#004716"),                
      "selected_menu_color"                 =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "logo_text_color"                     =>array('value' => "#004716",
                                                                    'default' =>"#004716"),   
      );
    $this->options['color_scheme']['colors'][4]=array(
      "menu_elem_back_color"          =>array('value' => "#B26D01",
                                                                    'default' =>"#B26D01"),                
      "sideb_background_color"        =>array('value' => "#FAFAFA",
                                                                    'default' =>"#FAFAFA"),                
      "footer_sideb_background_color" =>array('value' => "#787878",
                                                                    'default' =>"#787878"),                
      "footer_back_color"                   =>array('value' => "#787878",
                                                                    'default' =>"#787878"),                
      "home_top_posts_color"          =>array('value' => "#F2F2F2",
                                                                    'default' =>"#F2F2F2"),                
      "cat_tab_backgr_color"          =>array('value' => "#F5F5F5",
                                                                    'default' =>"#F5F5F5"),                
      "top_posts_color"                     =>array('value' => "#B26D01",
                                                                    'default' =>"#B26D01"),                
      "primary_text_headers_color"    =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "text_headers_color"                =>array('value' => "#1f1f1f",
                                                                    'default' =>"#1f1f1f"),                
      "primary_text_color"                  =>array('value' => "#646464",
                                                                    'default' =>"#646464"),                
      "footer_text_color"                   =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "primary_links_color"                 =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "primary_links_hover_color"     =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "menu_links_color"                    =>array('value' => "#FFFFFF",
                                                                    'default' =>"#FFFFFF"),                
      "menu_links_hover_color"            =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "menu_color"                                =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "selected_menu_color"                 =>array('value' => "#000000",
                                                                    'default' =>"#000000"),                
      "logo_text_color"                     =>array('value' => "#B26D01",
                                                                    'default' =>"#B26D01"),  
       );
   
    
    $this->options['colors_active']['select_theme'] ='color_scheme';
    $this->options['colors_active']['active'] ='0';
    $this->options['colors_active']['colors'][$param_name] = array(
        'value' => $val,
        'default' => $args['default'],
    );
  
  


  }
  




}

