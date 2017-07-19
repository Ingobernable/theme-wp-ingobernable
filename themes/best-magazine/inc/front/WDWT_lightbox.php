<?php

  class WDWT_Lightbox {
    ////////////////////////////////////////////////////////////////////////////////////////
    // Events                                                                             //
    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    // Constants                                                                          //
    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    // Variables                                                                          //
    ////////////////////////////////////////////////////////////////////////////////////////
    private $params;
    private $images;
    private $titles;
    private $descrs;

    private $current_index;
    private $theme_row = array(
      'lightbox_bg_color' => 'fefefe',//ttt
      'lightbox_close_btn_border_radius' => '10px',
      'lightbox_close_btn_color' => 'ff0000',//ttt lightbox_ctrl_btn_color
      'lightbox_close_btn_bg_color' => '000000',//ttt lightbox_ctrl_cont_bg_color
      'lightbox_close_btn_height' => 20,
      'lightbox_close_btn_size' => 15,
      'lightbox_close_btn_border_width' => 1,
      'lightbox_close_btn_border_style' => 'none',
      'lightbox_close_btn_border_color' => '000000',
      'lightbox_close_btn_box_shadow' => 'none',
      'lightbox_close_btn_right' => -10,
      'lightbox_close_btn_top' => -10,
      'lightbox_close_btn_width' => 20,
      'lightbox_close_btn_full_color' => 'ffff00', //ttt lightbox_ctrl_btn_color
      'lightbox_close_btn_transparent' => 50,
      'lightbox_close_rl_btn_hover_color' => '00ffff', //ttt
      'lightbox_ctrl_cont_bg_color' => 'ffffff',      //ttt
      'lightbox_ctrl_btn_align' => 'center',
      'lightbox_ctrl_btn_color' => 'ff0000', //ttt 
      'lightbox_ctrl_btn_height' => 24,
      'lightbox_ctrl_btn_margin_top' => 6,
      'lightbox_ctrl_btn_transparent'=> 100,
      'lightbox_ctrl_btn_pos' => 'bottom',
      'lightbox_ctrl_cont_border_radius' => '12px',
      'lightbox_ctrl_cont_transparent' => 50,
      'lightbox_info_bg_color'=>'cccccc', //ttt lightbox_ctrl_cont_bg_color
      'lightbox_info_bg_transparent' => 50,
      'lightbox_info_align' => 'center',
      'lightbox_info_margin' => 5,
      'lightbox_info_padding' => '18px',
      'lightbox_info_pos' => 'top',
      'lightbox_info_border_width' => 1,
      'lightbox_info_border_style' => 'none',
      'lightbox_info_border_color' => '00ff33',
      'lightbox_info_border_radius' => '0',
      'lightbox_rl_btn_bg_color'=> '666666', //ttt lightbox_ctrl_cont_bg_color
      'lightbox_rl_btn_border_radius'=> '20px',
      'lightbox_rl_btn_border_width'=>1,
      'lightbox_rl_btn_border_color'=> '0000ff',
      'lightbox_rl_btn_border_style' => 'none',
      'lightbox_rl_btn_box_shadow' => 'none',
      'lightbox_rl_btn_color' => 'fff055', //ttt lightbox_ctrl_btn_color
      'lightbox_rl_btn_height' => 40,
      'lightbox_rl_btn_width' => 40,
      'lightbox_rl_btn_size' => 18,
      'lightbox_rl_btn_transparent' => 60,
      'lightbox_title_color' => '00cccc', //ttt
      'lightbox_title_font_style' => 'sans-serif',
      'lightbox_title_font_size' => '18',
      'lightbox_title_font_weight' => 400,
      'lightbox_toggle_btn_height' => 10,
      'lightbox_toggle_btn_width' => 30,
      'lightbox_description_color' => 'cc9900', //ttt
      'lightbox_description_font_style' => 'monospace',
      'lightbox_description_font_size' => 16,
      'lightbox_description_font_weight' => 500,
    );





    private $wdwt_front;

    ////////////////////////////////////////////////////////////////////////////////////////
    // Constructor & Destructor                                                           //
    ////////////////////////////////////////////////////////////////////////////////////////
    public function __construct() {
      global $wdwt_options;
      require_once('frontend_params_output.php');
      $this->wdwt_front = new best_magazine_front($wdwt_options);
      /*get images and current image*/
      $images = $_POST['imgs'];
      $img_titles = $_POST['titles'];
      $img_descrs = $_POST['descrs'];
      $current = $_POST['cur'];

      $this->images = json_decode(stripcslashes ($images), true);
      $this->titles = json_decode(stripcslashes ($img_titles), true);
      $this->descrs = json_decode(stripcslashes ($img_descrs), true);
      $this->current_index = intval($current);


      $this->params['slideshow_interval'] = intval($this->wdwt_front->get_param('lbox_slideshow_interval'));
      $this->params['image_width'] = $this->wdwt_front->get_param('lbox_image_width');
      $this->params['image_height'] = $this->wdwt_front->get_param('lbox_image_height');
      $img_eff = $this->wdwt_front->get_param('lbox_image_effect');
      $this->params['image_effect'] = $img_eff[0];
      $this->params['enable_image_fullscreen'] = $this->wdwt_front->get_param('lbox_enable_image_fullscreen');
      $this->params['open_with_fullscreen']= $this->wdwt_front->get_param('lbox_open_with_fullscreen');
      $this->params['enable_image_ctrl_btn'] = $this->wdwt_front->get_param('lbox_enable_image_ctrl_btn');
      $this->params['open_with_autoplay'] = $this->wdwt_front->get_param('lbox_open_with_autoplay');
      $this->params['image_right_click'] = false;
      $this->params['popup_enable_info'] = $this->wdwt_front->get_param('lbox_popup_enable_info');
      $this->params['popup_info_full_width'] = $this->wdwt_front->get_param('lbox_popup_info_full_width');
      $this->params['popup_info_always_show'] = $this->wdwt_front->get_param('lbox_popup_info_always_show');
      $this->params['popup_enable_fullsize_image'] = false;
      $this->params['preload_images'] = true;
      $this->params['preload_images_count'] = 6;

      $lbox_info_position = $this->wdwt_front->get_param('lbox_info_position');
      $lbox_info_position_array = explode('-', $lbox_info_position[0]);
      $lbox_info_horiz = isset($lbox_info_position_array[0]) ? $lbox_info_position_array[0] : 'right';
      $lbox_info_vert = isset($lbox_info_position_array[1]) ? $lbox_info_position_array[1] : 'top';

      $this->theme_row['lightbox_info_align'] = $lbox_info_horiz;
      $this->theme_row['lightbox_info_pos'] = $lbox_info_vert;
      /*colors*/
      $this->theme_row['lightbox_bg_color'] = $this->wdwt_front->get_param('[colors_active][colors][lightbox_bg_color][value]' , $meta_array = array(), $default = '#fefefe');


      $this->theme_row['lightbox_ctrl_btn_color'] = $this->wdwt_front->get_param('[colors_active][colors][lightbox_ctrl_btn_color][value]' , $meta_array = array(), $default = '#000000');
      $this->theme_row['lightbox_close_btn_full_color'] = $this->theme_row['lightbox_ctrl_btn_color'];
      $this->theme_row['lightbox_close_btn_color'] = $this->theme_row['lightbox_ctrl_btn_color'];
      $this->theme_row['lightbox_rl_btn_color'] = $this->theme_row['lightbox_ctrl_btn_color'];

      $this->theme_row['lightbox_ctrl_cont_bg_color'] = $this->wdwt_front->get_param('[colors_active][colors][lightbox_ctrl_cont_bg_color][value]' , $meta_array = array(), $default = '#cccccc');
      $this->theme_row['lightbox_info_bg_color'] = $this->theme_row['lightbox_ctrl_cont_bg_color'];
      $this->theme_row['lightbox_rl_btn_bg_color'] = $this->theme_row['lightbox_ctrl_cont_bg_color'];
      $this->theme_row['lightbox_close_btn_bg_color'] = $this->theme_row['lightbox_ctrl_cont_bg_color'];

      $this->theme_row['lightbox_title_color'] = $this->wdwt_front->get_param('[colors_active][colors][lightbox_title_color][value]' , $meta_array = array(), $default = '#000000');
      $lightbox_title_text_transform = $this->wdwt_front->get_param('text_headers_transform');
      $this->theme_row['lightbox_title_text_transform'] = $lightbox_title_text_transform[0];

      $this->theme_row['lightbox_description_color'] = $this->wdwt_front->get_param('[colors_active][colors][lightbox_description_color][value]' , $meta_array = array(), $default = '#000000');
      $this->theme_row['lightbox_close_rl_btn_hover_color'] = $this->wdwt_front->get_param('[colors_active][colors][lightbox_close_rl_btn_hover_color][value]' , $meta_array = array(), $default = '#890000');


      $lightbox_title_font_style = $this->wdwt_front->get_param('text_headers_font');
      $lightbox_description_font_style = $this->wdwt_front->get_param('text_primary_font');
      $this->theme_row['lightbox_title_font_style'] = $lightbox_title_font_style[0];
      $this->theme_row['lightbox_description_font_style'] = $lightbox_description_font_style[0];

    }
    ////////////////////////////////////////////////////////////////////////////////////////
    // Public Methods                                                                     //
    ////////////////////////////////////////////////////////////////////////////////////////


    public function view() {
      extract($this->params);

      $bwg = 0;
      $current_image_id = $this->current_index;

      $theme_row = $this->theme_row;
      $image_rows = $this->images;
      $title_rows = $this->titles;
      $descr_rows = $this->descrs;

      $rgb_lightbox_image_info_bg_color = $this->wdwt_front->hex2rgb($theme_row['lightbox_info_bg_color']);
      $rgb_lightbox_ctrl_cont_bg_color = $this->wdwt_front->hex2rgb($theme_row['lightbox_ctrl_cont_bg_color']);

      ?>
      <style>
        .wdwt_spider_popup_wrap * {
          -moz-box-sizing: border-box;
          -webkit-box-sizing: border-box;
          box-sizing: border-box;
        }
        .wdwt_spider_popup_wrap {
          background-color: <?php echo $theme_row['lightbox_bg_color']; ?>;
          display: inline-block;
          left: 50%;
          outline: medium none;
          position: fixed;
          text-align: center;
          top: 50%;
          z-index: 100000;
        }
        .wdwt_popup_image {
          max-width: <?php echo $image_width; ?>px;
          max-height: <?php echo $image_height; ?>px;
          vertical-align: middle;
          display: inline-block;
        }

        .wdwt_ctrl_btn {
          color: <?php echo $theme_row['lightbox_ctrl_btn_color']; ?>;
          font-size: <?php echo $theme_row['lightbox_ctrl_btn_height']; ?>px;
          margin: <?php echo $theme_row['lightbox_ctrl_btn_margin_top']; ?>px;
          padding: 0 5px;
          opacity: <?php echo number_format($theme_row['lightbox_ctrl_btn_transparent'] / 100, 2, ".", ""); ?>;
          filter: Alpha(opacity=<?php echo $theme_row['lightbox_ctrl_btn_transparent']; ?>);
        }
        .wdwt_toggle_btn {
          color: <?php echo $theme_row['lightbox_ctrl_btn_color'] ?>;
          font-size: <?php echo $theme_row['lightbox_toggle_btn_height']; ?>px;
          margin: 0;
          opacity: <?php echo number_format($theme_row['lightbox_ctrl_btn_transparent'] / 100, 2, ".", ""); ?>;
          filter: Alpha(opacity=<?php echo $theme_row['lightbox_ctrl_btn_transparent']; ?>);
          padding: 0;
        }
        .wdwt_btn_container {
          bottom: 0;
          left: 0;
          overflow: hidden;
          position: absolute;
          right: 0;
          top: 0;
        }

        .wdwt_ctrl_btn_container {
          background-color: rgba(<?php echo $rgb_lightbox_ctrl_cont_bg_color['red']; ?>, <?php echo $rgb_lightbox_ctrl_cont_bg_color['green']; ?>, <?php echo $rgb_lightbox_ctrl_cont_bg_color['blue']; ?>, <?php echo number_format($theme_row['lightbox_ctrl_cont_transparent'] / 100, 2, ".", ""); ?>);
          /*background: none repeat scroll 0 0 #<?php echo $theme_row['lightbox_ctrl_cont_bg_color']; ?>;*/
        <?php
        if ($theme_row['lightbox_ctrl_btn_pos'] == 'top') {
          ?>
          border-bottom-left-radius: <?php echo $theme_row['lightbox_ctrl_cont_border_radius']; ?>px;
          border-bottom-right-radius: <?php echo $theme_row['lightbox_ctrl_cont_border_radius']; ?>px;
        <?php
      }
      else {
        ?>
          bottom: 0;
          border-top-left-radius: <?php echo $theme_row['lightbox_ctrl_cont_border_radius']; ?>px;
          border-top-right-radius: <?php echo $theme_row['lightbox_ctrl_cont_border_radius']; ?>px;
        <?php
      }?>
          height: <?php echo $theme_row['lightbox_ctrl_btn_height'] + 2 * $theme_row['lightbox_ctrl_btn_margin_top']; ?>px;
          /*opacity: <?php echo number_format($theme_row['lightbox_ctrl_cont_transparent'] / 100, 2, ".", ""); ?>;
        filter: Alpha(opacity=<?php echo $theme_row['lightbox_ctrl_cont_transparent']; ?>);*/
          position: absolute;
          text-align: <?php echo $theme_row['lightbox_ctrl_btn_align']; ?>;
          width: 100%;
          z-index: 10150;
        }
        .wdwt_toggle_container {
          background: none repeat scroll 0 0 <?php echo $theme_row['lightbox_ctrl_cont_bg_color']; ?>;
        <?php
        if ($theme_row['lightbox_ctrl_btn_pos'] == 'top') {
          ?>
          border-bottom-left-radius: <?php echo $theme_row['lightbox_ctrl_cont_border_radius']; ?>px;
          border-bottom-right-radius: <?php echo $theme_row['lightbox_ctrl_cont_border_radius']; ?>px;
          top: <?php echo $theme_row['lightbox_ctrl_btn_height'] + 2 * $theme_row['lightbox_ctrl_btn_margin_top']; ?>px;
        <?php
      }
      else {
        ?>
          border-top-left-radius: <?php echo $theme_row['lightbox_ctrl_cont_border_radius']; ?>px;
          border-top-right-radius: <?php echo $theme_row['lightbox_ctrl_cont_border_radius']; ?>px;
          bottom: <?php echo $theme_row['lightbox_ctrl_btn_height'] + 2 * $theme_row['lightbox_ctrl_btn_margin_top']; ?>px;
        <?php
      }?>
          cursor: pointer;
          left: 50%;
          line-height: 0;
          margin-left: -<?php echo $theme_row['lightbox_toggle_btn_width'] / 2; ?>px;
          opacity: <?php echo number_format($theme_row['lightbox_ctrl_cont_transparent'] / 100, 2, ".", ""); ?>;
          filter: Alpha(opacity=<?php echo $theme_row['lightbox_ctrl_cont_transparent']; ?>);
          position: absolute;
          text-align: center;
          width: <?php echo $theme_row['lightbox_toggle_btn_width']; ?>px;
          z-index: 10150;
        }
        .wdwt_close_btn {
          opacity: <?php echo number_format($theme_row['lightbox_close_btn_transparent'] / 100, 2, ".", ""); ?>;
          filter: Alpha(opacity=<?php echo $theme_row['lightbox_close_btn_transparent']; ?>);
        }
        .wdwt_spider_popup_close {
          background-color: <?php echo $theme_row['lightbox_close_btn_bg_color']; ?>;
          border-radius: <?php echo $theme_row['lightbox_close_btn_border_radius']; ?>;
          border: <?php echo $theme_row['lightbox_close_btn_border_width']; ?>px <?php echo $theme_row['lightbox_close_btn_border_style']; ?> <?php echo $theme_row['lightbox_close_btn_border_color']; ?>;
          box-shadow: <?php echo $theme_row['lightbox_close_btn_box_shadow']; ?>;
          color: <?php echo $theme_row['lightbox_close_btn_color']; ?>;
          height: <?php echo $theme_row['lightbox_close_btn_height']; ?>px;
          font-size: <?php echo $theme_row['lightbox_close_btn_size']; ?>px;
          right: <?php echo $theme_row['lightbox_close_btn_right']; ?>px;
          top: <?php echo $theme_row['lightbox_close_btn_top']; ?>px;
          width: <?php echo $theme_row['lightbox_close_btn_width']; ?>px;
        }
        .wdwt_spider_popup_close_fullscreen {
          color: <?php echo $theme_row['lightbox_close_btn_full_color']; ?>;
          font-size: <?php echo $theme_row['lightbox_close_btn_size']; ?>px;
          right: 15px;
          top: -7px;
        }
        .wdwt_spider_popup_close span,
        #wdwt_spider_popup_left-ico span,
        #wdwt_spider_popup_right-ico span {
          display: table-cell;
          text-align: center;
          vertical-align: middle;
        }
        #wdwt_spider_popup_left-ico,
        #wdwt_spider_popup_right-ico {
          background-color: <?php echo $theme_row['lightbox_rl_btn_bg_color']; ?>;
          border-radius: <?php echo $theme_row['lightbox_rl_btn_border_radius']; ?>;
          border: <?php echo $theme_row['lightbox_rl_btn_border_width']; ?>px <?php echo $theme_row['lightbox_rl_btn_border_style']; ?> <?php echo $theme_row['lightbox_rl_btn_border_color']; ?>;
          box-shadow: <?php echo $theme_row['lightbox_rl_btn_box_shadow']; ?>;
          color: <?php echo $theme_row['lightbox_rl_btn_color']; ?>;
          height: <?php echo $theme_row['lightbox_rl_btn_height']; ?>px;
          font-size: <?php echo $theme_row['lightbox_rl_btn_size']; ?>px;
          width: <?php echo $theme_row['lightbox_rl_btn_width']; ?>px;
          opacity: <?php echo number_format($theme_row['lightbox_rl_btn_transparent'] / 100, 2, ".", ""); ?>;
          filter: Alpha(opacity=<?php echo $theme_row['lightbox_rl_btn_transparent']; ?>);
        }
        .wdwt_ctrl_btn:hover,
        .wdwt_toggle_btn:hover,
        .wdwt_spider_popup_close:hover,
        .wdwt_spider_popup_close_fullscreen:hover,
        #wdwt_spider_popup_left-ico:hover,
        #wdwt_spider_popup_right-ico:hover {
          color: <?php echo $theme_row['lightbox_close_rl_btn_hover_color']; ?>;
          cursor: pointer;
        }
        .wdwt_image_wrap {
          height: inherit;
          display: table;
          position: absolute;
          text-align: center;
          width: inherit;
        }
        .wdwt_image_wrap * {
          -moz-user-select: none;
          -khtml-user-select: none;
          -webkit-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }
        .wdwt_ctrl_btn_container a,
        .wdwt_ctrl_btn_container a:hover {
          text-decoration: none;
        }
        .wdwt_image_container {
          display: table;
          position: absolute;
          text-align: center;
          vertical-align: middle;
          width: 100%;
        }

        .wdwt_none_selectable {
          -webkit-touch-callout: none;
          -webkit-user-select: none;
          -khtml-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }
        .wdwt_slide_container {
          display: table-cell;
          position: absolute;
          vertical-align: middle;
          width:100%;
          height:100%;
        }
        .wdwt_slide_bg {
          margin: 0 auto;
          width: inherit;
          height: inherit;
        }
        .wdwt_slider {
          height: inherit;
          width: inherit;
        }
        .wdwt_popup_image_spun {
          height: inherit;
          display: table-cell;
          filter: Alpha(opacity=100);
          opacity: 1;
          position: absolute;
          vertical-align: middle;
          width: inherit;
          z-index: 2;
        }
        .wdwt_popup_image_second_spun {
          width: inherit;
          height: inherit;
          display: table-cell;
          filter: Alpha(opacity=0);
          opacity: 0;
          position: absolute;
          vertical-align: middle;
          z-index: 1;
        }
        .wdwt_grid {
          display: none;
          height: 100%;
          overflow: hidden;
          position: absolute;
          width: 100%;
        }
        .wdwt_gridlet {
          opacity: 1;
          filter: Alpha(opacity=100);
          position: absolute;
        }
        .wdwt_image_info_container1 {
          display: <?php echo $popup_info_always_show ? 'table-cell' : 'none'; ?>;
        }
        .wdwt_image_info_spun {
          text-align: <?php echo $theme_row['lightbox_info_align']; ?>;
          vertical-align: <?php echo $theme_row['lightbox_info_pos']; ?>;
        }
        .wdwt_image_info {
          background: rgba(<?php echo $rgb_lightbox_image_info_bg_color['red']; ?>, <?php echo $rgb_lightbox_image_info_bg_color['green']; ?>, <?php echo $rgb_lightbox_image_info_bg_color['blue']; ?>, <?php echo number_format($theme_row['lightbox_info_bg_transparent'] / 100, 2, ".", ""); ?>);
          border: <?php echo $theme_row['lightbox_info_border_width']; ?>px <?php echo $theme_row['lightbox_info_border_style']; ?> <?php echo $theme_row['lightbox_info_border_color']; ?>;
          border-radius: <?php echo $theme_row['lightbox_info_border_radius']; ?>;
        <?php echo ( $theme_row['lightbox_ctrl_btn_pos'] == 'bottom' && $theme_row['lightbox_info_pos'] == 'bottom') ? 'bottom: ' . ($theme_row['lightbox_ctrl_btn_height'] + 2 * $theme_row['lightbox_ctrl_btn_margin_top']) . 'px;' : '' ?>
        <?php if($popup_info_full_width) { ?>
          width: 100%;
        <?php } else { ?>
          margin: <?php echo $theme_row['lightbox_info_margin']; ?>;
        <?php } ?>
          padding: <?php echo $theme_row['lightbox_info_padding']; ?>;
        <?php echo ($theme_row['lightbox_ctrl_btn_pos'] == 'top' && $theme_row['lightbox_info_pos'] == 'top') ? 'top: ' . ($theme_row['lightbox_ctrl_btn_height'] + 2 * $theme_row['lightbox_ctrl_btn_margin_top']) . 'px;' : '' ?>
        }
        .wdwt_image_title,
        .wdwt_image_title * {
          color: <?php echo $theme_row['lightbox_title_color']; ?> !important;
          font-family: <?php echo $theme_row['lightbox_title_font_style']; ?>;
          font-size: <?php echo $theme_row['lightbox_title_font_size']; ?>px;
          font-weight: <?php echo $theme_row['lightbox_title_font_weight']; ?>;
          text-transform: <?php echo $theme_row['lightbox_title_text_transform']; ?>;;
        }
        .wdwt_image_description,
        .wdwt_image_description * {
          color: <?php echo $theme_row['lightbox_description_color']; ?> !important;
          font-family: <?php echo $theme_row['lightbox_description_font_style']; ?>;
          font-size: <?php echo $theme_row['lightbox_description_font_size']; ?>px;
          font-weight: <?php echo $theme_row['lightbox_description_font_weight']; ?>;
        }
        @media (max-width: 480px) {
          .wdwt_image_title,
          .wdwt_image_title * {
            font-size: 12px;
          }
          .wdwt_image_description,
          .wdwt_image_description * {
            font-size: 10px;
          }
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px){
          .wdwt_ctrl_btn_container {
            height: <?php echo $theme_row['lightbox_ctrl_btn_height'] + 2 * $theme_row['lightbox_ctrl_btn_margin_top'] + 10; ?>px;
          }
          .wdwt_ctrl_btn {
            font-size: <?php echo $theme_row['lightbox_ctrl_btn_height']+10; ?>px;
          }
        }

        @media only screen and (max-width : 767px){
          .wdwt_ctrl_btn{
            font-size: <?php echo $theme_row['lightbox_ctrl_btn_height']+10; ?>px;
          }
          .wdwt_ctrl_btn_container {
            height: <?php echo $theme_row['lightbox_ctrl_btn_height'] + 2 * $theme_row['lightbox_ctrl_btn_margin_top'] + 10; ?>px;
          }
        }








      </style>
      <script>
        var wdwt_data = [];
        var event_stack = [];
        <?php
        $image_id_exist = FALSE;


        foreach ($image_rows as $key => $image_row) {
        if ($key == $current_image_id) {
          $current_image_alt = isset($title_rows[$key]) ? $title_rows[$key] : "" ;
          $current_image_description = isset($descr_rows[$key]) ? $descr_rows[$key] : "" ;
          $current_image_url = '';
          $current_thumb_url = '';
          $current_filetype = '';
          $image_id_exist = TRUE;
        }
        ?>
        wdwt_data["<?php echo $key; ?>"] = [];
        wdwt_data["<?php echo $key; ?>"]["number"] = <?php echo $key + 1; ?>;
        wdwt_data["<?php echo $key; ?>"]["id"] = "";
        wdwt_data["<?php echo $key; ?>"]["alt"] = "<?php echo esc_attr(isset($title_rows[$key]) ? $title_rows[$key] : '' ); ?>" ;
        wdwt_data["<?php echo $key; ?>"]["description"] = "<?php echo esc_attr(isset($descr_rows[$key]) ? str_replace(array("\r\n", "\n", "\r"), esc_html('<br />'), $descr_rows[$key]) : '' ); ?>" ;
        wdwt_data["<?php echo $key; ?>"]["image_url"] = "<?php echo $image_row; ?>";
        wdwt_data["<?php echo $key; ?>"]["thumb_url"] = "";
        wdwt_data["<?php echo $key; ?>"]["date"] = "";
        <?php
        }
        ?>
      </script>

      <?php
      if (!$image_id_exist) {
        echo '<div style="width:99%"><div class="error"><p><strong>' . __('The image has been deleted.', "best-magazine") . '</strong></p></div></div>';
        die();
      }
      ?>

      <div class="wdwt_image_wrap">
        <?php
          if ($enable_image_ctrl_btn || $enable_image_fullscreen) {
            ?>
            <div class="wdwt_btn_container">
              <div class="wdwt_ctrl_btn_container">
                <?php
                  if ($enable_image_ctrl_btn) {
                    ?>
                    <i title="<?php esc_attr_e('Play', "best-magazine"); ?>" class="wdwt_ctrl_btn wdwt_play_pause fa fa-play"></i>
                    <?php
                  }
                  if ($enable_image_fullscreen) {
                    if (!$open_with_fullscreen) {
                      ?>
                      <i title="<?php esc_attr_e('Maximize', "best-magazine"); ?>" class="wdwt_ctrl_btn wdwt_resize-full fa fa-resize-full "></i>
                      <?php
                    }
                    ?>
                    <i title="<?php echo esc_attr_e('Fullscreen', "best-magazine"); ?>" class="wdwt_ctrl_btn wdwt_fullscreen fa fa-fullscreen"></i>
                  <?php }
                  if ($popup_enable_info) { ?>
                    <i title="<?php echo esc_attr_e('Show info', "best-magazine"); ?>" class="wdwt_ctrl_btn wdwt_info fa fa-info"></i>
                    <?php
                  }
                  if ($popup_enable_fullsize_image) {
                    ?>
                    <a id="wdwt_fullsize_image" href="<?php echo $current_image_url; ?>" target="_blank">
                      <i title="<?php echo esc_attr_e('Open image in original size.', "best-magazine"); ?>" class="wdwt_ctrl_btn fa fa-external-link"></i>
                    </a>
                    <?php
                  }
                ?>
              </div>
              <div class="wdwt_toggle_container">
                <i class="wdwt_toggle_btn fa <?php echo (($theme_row['lightbox_ctrl_btn_pos'] == 'top') ? 'fa-angle-up' : 'fa-angle-down'); ?>"></i>
              </div>
            </div>
            <?php
          }
          $current_pos = 0;
        ?>
        <div id="wdwt_image_container" class="wdwt_image_container">
          <div class="wdwt_image_info_container1">
            <div class="wdwt_image_info_container2">
            <span class="wdwt_image_info_spun">
              <div class="wdwt_image_info" <?php if(trim($current_image_alt) == '' && trim($current_image_description) == '') { echo 'style="background:none;"'; } ?>>
                <div class="wdwt_image_title"><?php echo html_entity_decode($current_image_alt); ?></div>
                <div class="wdwt_image_description"><?php echo html_entity_decode($current_image_description); ?></div>
              </div>
            </span>
            </div>
          </div>
          <div class="wdwt_slide_container">
            <div class="wdwt_slide_bg">
              <div class="wdwt_slider">
                <?php
                  $current_key = -6;
                  foreach ($image_rows as $key => $image_row) {

                    if ($key == $current_image_id) {
                      $current_key = $key;
                      ?>
                      <span class="wdwt_popup_image_spun" id="wdwt_popup_image" image_id="<?php echo $key; ?>">
                <span class="wdwt_popup_image_spun1" style="display: table; width: inherit; height: inherit;">
                  <span class="wdwt_popup_image_spun2" style="display: table-cell; vertical-align: middle; text-align: center;">
                    <img class="wdwt_popup_image" src="<?php echo $image_row; ?>" alt="" />
                  </span>
                </span>
              </span>
                      <span class="wdwt_popup_image_second_spun">                
              </span>
                      <input type="hidden" id="wdwt_current_image_key" value="<?php echo $key; ?>" />
                      <?php
                      break;
                    }
                  }
                ?>
              </div>
            </div>
          </div>
          <a id="wdwt_spider_popup_left"><span id="wdwt_spider_popup_left-ico"><span><i class="wdwt_prev_btn fa fa-chevron-left"></i></span></span></a>
          <a id="wdwt_spider_popup_right"><span id="wdwt_spider_popup_right-ico"><span><i class="wdwt_next_btn fa fa-chevron-right"></i></span></span></a>
        </div>
      </div>
      <a class="wdwt_spider_popup_close" onclick="wdwt_lbox.destroypopup(1000); return false;" ontouchend="wdwt_lbox.destroypopup(1000); return false;"><span><i class="wdwt_close_btn fa fa-times"></i></span></a>

      <script>
        var wdwt_trans_in_progress = false;
        var wdwt_transition_duration = <?php echo (($slideshow_interval < 4) && ($slideshow_interval != 0)) ? ($slideshow_interval * 1000) / 4 : 800; ?>;
        var wdwt_playInterval;
        if ((jQuery("#wdwt_spider_popup_wrap").width() >= jQuery(window).width()) || (jQuery("#wdwt_spider_popup_wrap").height() >= jQuery(window).height())) {
          jQuery(".wdwt_spider_popup_close").attr("class", "wdwt_ctrl_btn wdwt_spider_popup_close_fullscreen");
        }
        /* Stop autoplay.*/
        window.clearInterval(wdwt_playInterval);


        var wdwt_current_key = '<?php echo $current_key; ?>';

        function wdwt_testBrowser_cssTransitions() {
          return wdwt_testDom('Transition');
        }
        function wdwt_testBrowser_cssTransforms3d() {
          return wdwt_testDom('Perspective');
        }
        function wdwt_testDom(prop) {
          /* Browser vendor CSS prefixes.*/
          var browserVendors = ['', '-webkit-', '-moz-', '-ms-', '-o-', '-khtml-'];
          /* Browser vendor DOM prefixes.*/
          var domPrefixes = ['', 'Webkit', 'Moz', 'ms', 'O', 'Khtml'];
          var i = domPrefixes.length;
          while (i--) {
            if (typeof document.body.style[domPrefixes[i] + prop] !== 'undefined') {
              return true;
            }
          }
          return false;
        }


        function wdwt_cube(tz, ntx, nty, nrx, nry, wrx, wry, current_image_class, next_image_class, direction) {
          /* If browser does not support 3d transforms/CSS transitions.*/
          if (!wdwt_testBrowser_cssTransitions()) {
            return wdwt_fallback(current_image_class, next_image_class, direction);
          }
          if (!wdwt_testBrowser_cssTransforms3d()) {
            return wdwt_fallback3d(current_image_class, next_image_class, direction);
          }
          wdwt_trans_in_progress = true;
          /* Set active thumbnail.*/
          jQuery(".wdwt_slide_bg").css('perspective', 1000);
          jQuery(current_image_class).css({
            transform : 'translateZ(' + tz + 'px)',
            backfaceVisibility : 'hidden'
          });
          jQuery(next_image_class).css({
            opacity : 1,
            filter: 'Alpha(opacity=100)',
            backfaceVisibility : 'hidden',
            transform : 'translateY(' + nty + 'px) translateX(' + ntx + 'px) rotateY('+ nry +'deg) rotateX('+ nrx +'deg)'
          });
          jQuery(".wdwt_slider").css({
            transform: 'translateZ(-' + tz + 'px)',
            transformStyle: 'preserve-3d'
          });
          /* Execution steps.*/
          setTimeout(function () {
            jQuery(".wdwt_slider").css({
              transition: 'all ' + wdwt_transition_duration + 'ms ease-in-out',
              transform: 'translateZ(-' + tz + 'px) rotateX('+ wrx +'deg) rotateY('+ wry +'deg)'
            });
          }, 20);
          /* After transition.*/
          jQuery(".wdwt_slider").one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(wdwt_after_trans));
          function wdwt_after_trans() {
            jQuery(current_image_class).removeAttr('style');
            jQuery(next_image_class).removeAttr('style');
            jQuery(".wdwt_slider").removeAttr('style');
            jQuery(current_image_class).css({'opacity' : 0, filter: 'Alpha(opacity=0)', 'z-index': 1});
            jQuery(next_image_class).css({'opacity' : 1, filter: 'Alpha(opacity=100)', 'z-index' : 2});

            wdwt_trans_in_progress = false;
            jQuery(current_image_class).html('');
            if (typeof event_stack !== 'undefined' && event_stack.length > 0) {
              key = event_stack[0].split("-");
              event_stack.shift();
              wdwt_change_image(key[0], key[1], wdwt_data, true);
            }
          }
        }
        function wdwt_cubeH(current_image_class, next_image_class, direction) {
          /* Set to half of image width.*/
          var dimension = jQuery(current_image_class).width() / 2;
          if (direction == 'right') {
            wdwt_cube(dimension, dimension, 0, 0, 90, 0, -90, current_image_class, next_image_class, direction);
          }
          else if (direction == 'left') {
            wdwt_cube(dimension, -dimension, 0, 0, -90, 0, 90, current_image_class, next_image_class, direction);
          }
        }
        function wdwt_cubeV(current_image_class, next_image_class, direction) {
          /* Set to half of image height.*/
          var dimension = jQuery(current_image_class).height() / 2;
          /* If next slide.*/
          if (direction == 'right') {
            wdwt_cube(dimension, 0, -dimension, 90, 0, -90, 0, current_image_class, next_image_class, direction);
          }
          else if (direction == 'left') {
            wdwt_cube(dimension, 0, dimension, -90, 0, 90, 0, current_image_class, next_image_class, direction);
          }
        }
        /* For browsers that does not support transitions.*/
        function wdwt_fallback(current_image_class, next_image_class, direction) {
          wdwt_fade(current_image_class, next_image_class, direction);
        }
        /* For browsers that support transitions, but not 3d transforms (only used if primary transition makes use of 3d-transforms).*/
        function wdwt_fallback3d(current_image_class, next_image_class, direction) {
          wdwt_sliceV(current_image_class, next_image_class, direction);
        }
        function wdwt_none(current_image_class, next_image_class, direction) {
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
          wdwt_trans_in_progress = false;
          jQuery(current_image_class).html('');
        }
        function wdwt_fade(current_image_class, next_image_class, direction) {
          if (wdwt_testBrowser_cssTransitions()) {
            jQuery(next_image_class).css('transition', 'opacity ' + wdwt_transition_duration + 'ms linear');
            jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
            jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
          }
          else {
            jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, wdwt_transition_duration);
            jQuery(next_image_class).animate({
              'opacity' : 1,
              'z-index': 2
            }, {
              duration: wdwt_transition_duration,
              complete: function () {

                wdwt_trans_in_progress = false;
                jQuery(current_image_class).html('');}
            });
            /* For IE.*/
            jQuery(current_image_class).fadeTo(wdwt_transition_duration, 0);
            jQuery(next_image_class).fadeTo(wdwt_transition_duration, 1);
          }
        }

        function wdwt_grid(cols, rows, ro, tx, ty, sc, op, current_image_class, next_image_class, direction) {
          /* If browser does not support CSS transitions.*/
          if (!wdwt_testBrowser_cssTransitions()) {
            return wdwt_fallback(current_image_class, next_image_class, direction);
          }
          wdwt_trans_in_progress = true;
          /* The time (in ms) added to/subtracted from the delay total for each new gridlet.*/
          var count = (wdwt_transition_duration) / (cols + rows);

          /* Gridlet creator (divisions of the image grid, positioned with background-images to replicate the look of an entire slide image when assembled)*/
          function wdwt_gridlet(width, height, top, img_top, left, img_left, src, imgWidth, imgHeight, c, r) {
            var delay = (c + r) * count;
            /* Return a gridlet elem with styles for specific transition.*/
            return jQuery('<div class="wdwt_gridlet" />').css({
              width : width,
              height : height,
              top : top,
              left : left,
              backgroundImage : 'url("' + src + '")',
              backgroundColor: jQuery(".wdwt_spider_popup_wrap").css("background-color"),
              /*backgroundColor: 'rgba(0, 0, 0, 0)',*/
              backgroundRepeat: 'no-repeat',
              backgroundPosition : img_left + 'px ' + img_top + 'px',
              backgroundSize : imgWidth + 'px ' + imgHeight + 'px',
              transition : 'all ' + wdwt_transition_duration + 'ms ease-in-out ' + delay + 'ms',
              transform : 'none'
            });
          }
          /* Get the current slide's image.*/
          var cur_img = jQuery(current_image_class).find('img');
          /* Create a grid to hold the gridlets.*/
          var grid = jQuery('<div />').addClass('wdwt_grid');
          /* Prepend the grid to the next slide (i.e. so it's above the slide image).*/
          jQuery(current_image_class).prepend(grid);
          /* Vars to calculate positioning/size of gridlets.*/
          var cont = jQuery(".wdwt_slide_bg");
          var imgWidth = cur_img.width();
          var imgHeight = cur_img.height();
          var contWidth = cont.width(),
            contHeight = cont.height(),
            colWidth = Math.floor(contWidth / cols),
            rowHeight = Math.floor(contHeight / rows),
            colRemainder = contWidth - (cols * colWidth),
            colAdd = Math.ceil(colRemainder / cols),
            rowRemainder = contHeight - (rows * rowHeight),
            rowAdd = Math.ceil(rowRemainder / rows),
            leftDist = 0,
            img_leftDist = Math.ceil((jQuery(".wdwt_slide_bg").width() - cur_img.width()) / 2);
          var imgSrc = typeof cur_img.attr('src')=='undefined' ? '' :cur_img.attr('src');
          /* tx/ty args can be passed as 'auto'/'min-auto' (meaning use slide width/height or negative slide width/height).*/
          tx = tx === 'auto' ? contWidth : tx;
          tx = tx === 'min-auto' ? - contWidth : tx;
          ty = ty === 'auto' ? contHeight : ty;
          ty = ty === 'min-auto' ? - contHeight : ty;
          /* Loop through cols.*/
          for (var i = 0; i < cols; i++) {
            var topDist = 0,
              img_topDst = Math.floor((jQuery(".wdwt_slide_bg").height() - cur_img.height()) / 2),
              newColWidth = colWidth;
            /* If imgWidth (px) does not divide cleanly into the specified number of cols, adjust individual col widths to create correct total.*/
            if (colRemainder > 0) {
              var add = colRemainder >= colAdd ? colAdd : colRemainder;
              newColWidth += add;
              colRemainder -= add;
            }
            /* Nested loop to create row gridlets for each col.*/
            for (var j = 0; j < rows; j++)  {
              var newRowHeight = rowHeight,
                newRowRemainder = rowRemainder;
              /* If contHeight (px) does not divide cleanly into the specified number of rows, adjust individual row heights to create correct total.*/
              if (newRowRemainder > 0) {
                add = newRowRemainder >= rowAdd ? rowAdd : rowRemainder;
                newRowHeight += add;
                newRowRemainder -= add;
              }
              /* Create & append gridlet to grid.*/
              grid.append(wdwt_gridlet(newColWidth, newRowHeight, topDist, img_topDst, leftDist, img_leftDist, imgSrc, imgWidth, imgHeight, i, j));
              topDist += newRowHeight;
              img_topDst -= newRowHeight;
            }
            img_leftDist -= newColWidth;
            leftDist += newColWidth;
          }
          /* Set event listener on last gridlet to finish transitioning.*/
          var last_gridlet = grid.children().last();
          /* Show grid & hide the image it replaces.*/
          grid.show();
          cur_img.css('opacity', 0);
          /* Add identifying classes to corner gridlets (useful if applying border radius).*/
          grid.children().first().addClass('rs-top-left');
          grid.children().last().addClass('rs-bottom-right');
          grid.children().eq(rows - 1).addClass('rs-bottom-left');
          grid.children().eq(- rows).addClass('rs-top-right');
          /* Execution steps.*/
          setTimeout(function () {
            grid.children().css({
              opacity: op,
              transform: 'rotate('+ ro +'deg) translateX('+ tx +'px) translateY('+ ty +'px) scale('+ sc +')'
            });
          }, 20);
          jQuery(next_image_class).css('opacity', 1);
          /* After transition.*/
          jQuery(last_gridlet).one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(wdwt_after_trans));
          function wdwt_after_trans() {
            jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
            jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
            cur_img.css('opacity', 1);
            grid.remove();
            wdwt_trans_in_progress = false;
            jQuery(current_image_class).html('');

            if (typeof event_stack !== 'undefined' && event_stack.length > 0) {
              key = event_stack[0].split("-");
              event_stack.shift();
              wdwt_change_image(key[0], key[1], wdwt_data, true);
            }
          }
        }


        function wdwt_sliceH(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var translateX = 'min-auto';
          }
          else if (direction == 'left') {
            var translateX = 'auto';
          }
          wdwt_grid(1, 8, 0, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
        }
        function wdwt_sliceV(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var translateY = 'min-auto';
          }
          else if (direction == 'left') {
            var translateY = 'auto';
          }
          wdwt_grid(10, 1, 0, 0, translateY, 1, 0, current_image_class, next_image_class, direction);
        }
        function wdwt_slideV(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var translateY = 'auto';
          }
          else if (direction == 'left') {
            var translateY = 'min-auto';
          }
          wdwt_grid(1, 1, 0, 0, translateY, 1, 1, current_image_class, next_image_class, direction);
        }
        function wdwt_slideH(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var translateX = 'min-auto';
          }
          else if (direction == 'left') {
            var translateX = 'auto';
          }
          wdwt_grid(1, 1, 0, translateX, 0, 1, 1, current_image_class, next_image_class, direction);
        }






        function wdwt_scaleOut(current_image_class, next_image_class, direction) {
          wdwt_grid(1, 1, 0, 0, 0, 1.5, 0, current_image_class, next_image_class, direction);
        }
        function wdwt_scaleIn(current_image_class, next_image_class, direction) {
          wdwt_grid(1, 1, 0, 0, 0, 0.5, 0, current_image_class, next_image_class, direction);
        }
        function wdwt_blockScale(current_image_class, next_image_class, direction) {
          wdwt_grid(8, 6, 0, 0, 0, .6, 0, current_image_class, next_image_class, direction);
        }
        function wdwt_kaleidoscope(current_image_class, next_image_class, direction) {
          wdwt_grid(10, 8, 0, 0, 0, 1, 0, current_image_class, next_image_class, direction);
        }
        function wdwt_fan(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var rotate = 45;
            var translateX = 100;
          }
          else if (direction == 'left') {
            var rotate = -45;
            var translateX = -100;
          }
          wdwt_grid(1, 10, rotate, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
        }
        function wdwt_blindV(current_image_class, next_image_class, direction) {
          wdwt_grid(1, 8, 0, 0, 0, .7, 0, current_image_class, next_image_class);
        }
        function wdwt_blindH(current_image_class, next_image_class, direction) {
          wdwt_grid(10, 1, 0, 0, 0, .7, 0, current_image_class, next_image_class);
        }
        function wdwt_random(current_image_class, next_image_class, direction) {
          var anims = ['sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope', 'fan', 'blindH', 'blindV'];
          /* Pick a random transition from the anims array.*/
          this["wdwt_" + anims[Math.floor(Math.random() * anims.length)]](current_image_class, next_image_class, direction);
        }




        function wdwt_change_image(current_key, key, wdwt_data, from_effect) {
          if (typeof wdwt_data[key] != 'undefined' && typeof wdwt_data[current_key] != 'undefined') {
            if (jQuery('.wdwt_ctrl_btn').hasClass('fa-pause')) {
              wdwt_play();
            }
            if (!from_effect) {
              /* Change image key.*/
              jQuery("#wdwt_current_image_key").val(key);
              /*if (current_key == '-1') {
               current_key = jQuery(".wdwt_thumb_active").children("img").attr("image_key");
               }*/
            }
            if (wdwt_trans_in_progress) {
              event_stack.push(current_key + '-' + key);
              return;
            }
            var direction = 'right';
            if (wdwt_current_key > key) {
              var direction = 'left';
            }
            else if (wdwt_current_key == key) {
              return;
            }
            jQuery("#wdwt_spider_popup_left").hover().css({"display": "inline"});
            jQuery("#wdwt_spider_popup_right").hover().css({"display": "inline"});
            jQuery(".wdwt_image_count").html(wdwt_data[key]["number"]);
            wdwt_current_key = key;

            /* Change image id.*/
            jQuery("#wdwt_popup_image").attr('image_id', wdwt_data[key]["id"]);
            /* Change image title, description.*/
            jQuery(".wdwt_image_title").html(jQuery('<div />').html(wdwt_data[key]["alt"]).text());
            jQuery(".wdwt_image_description").html(jQuery('<div />').html(wdwt_data[key]["description"]).text());
            if (jQuery(".wdwt_image_info_container1").css("display") != 'none') {
              jQuery(".wdwt_image_info_container1").css("display", "table-cell");
            }
            else {
              jQuery(".wdwt_image_info_container1").css("display", "none");
            }

            var current_image_class = jQuery(".wdwt_popup_image_spun").css("zIndex") == 2 ? ".wdwt_popup_image_spun" : ".wdwt_popup_image_second_spun";
            var next_image_class = current_image_class == ".wdwt_popup_image_second_spun" ? ".wdwt_popup_image_spun" : ".wdwt_popup_image_second_spun";

            var cur_height = jQuery(current_image_class).height();
            var cur_width = jQuery(current_image_class).width();
            var innhtml = '<span class="wdwt_popup_image_spun1" style="display: table; width: inherit; height: inherit;"><span class="wdwt_popup_image_spun2" style="display: table-cell; vertical-align: middle; text-align: center;">';
            innhtml += '<img style="max-height: ' + cur_height + 'px; max-width: ' + cur_width + 'px;" class="wdwt_popup_image" src="' + jQuery('<div />').html(wdwt_data[key]["image_url"]).text() + '" alt="' + wdwt_data[key]["alt"] + '" />';
            innhtml += '</span></span>';
            jQuery(next_image_class).html(innhtml);

            function wdwt_afterload() {
              <?php
              if ($preload_images) {
                echo 'wdwt_preload_images(key);';
              }
              ?>
              wdwt_<?php echo $image_effect; ?>(current_image_class, next_image_class, direction);
              jQuery("#wdwt_fullsize_image").attr("href", wdwt_data[key]['image_url']);
              jQuery("#wdwt_download").attr("href", wdwt_data[key]['image_url']);
              var image_arr = wdwt_data[key]['image_url'].split("/");
              jQuery("#wdwt_download").attr("download", image_arr[image_arr.length - 1]);

              jQuery(".mCSB_scrollTools").hide();

            }


            var cur_img = jQuery(next_image_class).find('img');
            cur_img.one('load', function() {
              wdwt_afterload();
            }).each(function() {
              if(this.complete) jQuery(this).load();
            });


          }
        }



        jQuery(document).on('keydown', function (e) {

          if (e.keyCode === 39) { /* Right arrow.*/
            wdwt_change_image(parseInt(jQuery('#wdwt_current_image_key').val()), parseInt(jQuery('#wdwt_current_image_key').val()) + 1, wdwt_data)
          }
          else if (e.keyCode === 37) { /* Left arrow.*/
            wdwt_change_image(parseInt(jQuery('#wdwt_current_image_key').val()), parseInt(jQuery('#wdwt_current_image_key').val()) - 1, wdwt_data)
          }
          else if (e.keyCode === 27) { /* Esc.*/
              wdwt_lbox.destroypopup(1000);
            }
            else if (e.keyCode === 32) { /* Space.*/
                jQuery(".wdwt_play_pause").trigger('click');
              }
          if (e.preventDefault) {
            e.preventDefault();
          }
          else {
            e.returnValue = false;
          }
        });

        function wdwt_preload_images(key) {


          count = <?php echo (int) $preload_images_count / 2; ?>;
          if (count != 0) {
            var img_number = wdwt_data.length;
            //check if interval is within image numbers interval
            if(key - count >=0 ){
              for (var i = key - count; i < key; i++) {
                jQuery("<img/>").attr("src", (typeof wdwt_data[i] != "undefined" ) ? jQuery('<div />').html(wdwt_data[i]["image_url"]).text() : "");
              }
            }
            else{
              for (var i = 0; i < key; i++) {
                jQuery("<img/>").attr("src", (typeof wdwt_data[i] != "undefined" ) ? jQuery('<div />').html(wdwt_data[i]["image_url"]).text() : "");
              }
            }
            if(key + count <=img_number ){
              for (var i = key; i < key + count; i++) {
                jQuery("<img/>").attr("src", (typeof wdwt_data[i] != "undefined" ) ? jQuery('<div />').html(wdwt_data[i]["image_url"]).text() : "");
              }
            }
            else{
              for (var i = key; i < wdwt_data.length; i++) {
                jQuery("<img/>").attr("src", (typeof wdwt_data[i] != "undefined" ) ? jQuery('<div />').html(wdwt_data[i]["image_url"]).text() : "");
              }
            }

          }
          else {

            for (var i = 0; i < wdwt_data.length; i++) {

              jQuery("<img/>").attr("src", (typeof wdwt_data[i] != "undefined") ? jQuery('<div />').html(wdwt_data[i]["image_url"]).text() : "");
            }

          }


        }


        function wdwt_popup_resize() {

          if (typeof jQuery().fullscreen !== 'undefined' && jQuery.isFunction(jQuery().fullscreen) && !jQuery.fullscreen.isFullScreen()) {
            jQuery(".wdwt_resize-full").show();
            jQuery(".wdwt_resize-full").attr("class", "wdwt_ctrl_btn wdwt_resize-full fa fa-resize-full");
            jQuery(".wdwt_resize-full").attr("title", "<?php esc_attr_e('Maximize', "best-magazine"); ?>");
            jQuery(".wdwt_fullscreen").attr("class", "wdwt_ctrl_btn wdwt_fullscreen fa fa-fullscreen");
            jQuery(".wdwt_fullscreen").attr("title", "<?php esc_attr_e('Fullscreen', "best-magazine"); ?>");
          }

          jQuery(".wdwt_spider_popup_close_fullscreen").show();


          if (jQuery(window).height() > <?php echo $image_height; ?> && <?php echo $open_with_fullscreen ? 1 : 0 ; ?> != 1 ) {

            jQuery("#wdwt_spider_popup_wrap").css({
              height: <?php echo $image_height; ?>,
              top: '50%',
              marginTop: -<?php echo $image_height / 2; ?>,
              zIndex: 100000
            });
            jQuery(".wdwt_image_container").css({height: (<?php echo $image_height; ?>)});

            jQuery(".wdwt_popup_image").css({
              maxHeight: <?php echo $image_height ; ?>
            });

            wdwt_popup_current_height = <?php echo $image_height; ?>;
          }
          else {
            jQuery("#wdwt_spider_popup_wrap").css({
              height: jQuery(window).height(),
              top: 0,
              marginTop: 0,
              zIndex: 100000
            });
            jQuery(".wdwt_image_container").css({height: (jQuery(window).height() )});

            jQuery(".wdwt_popup_image").css({
              maxHeight: jQuery(window).height()
            });

            wdwt_popup_current_height = jQuery(window).height();
          }




          if (jQuery(window).width() >= <?php echo $image_width; ?> && <?php echo $open_with_fullscreen ? 1 : 0 ; ?> != 1 ) {
            jQuery("#wdwt_spider_popup_wrap").css({
              width: <?php echo $image_width; ?>,
              left: '50%',
              marginLeft: -<?php echo $image_width / 2; ?>,
              zIndex: 100000
            });
            jQuery(".wdwt_image_wrap").css({width: <?php echo $image_width; ?>});
            jQuery(".wdwt_image_container").css({width: (<?php echo $image_width; ?>)});

            jQuery(".wdwt_popup_image").css({maxWidth: <?php echo $image_width; ?>});

            wdwt_popup_current_width = <?php echo $image_width; ?>;
          }
          else {
            jQuery("#wdwt_spider_popup_wrap").css({
              width: jQuery(window).width(),
              left: 0,
              marginLeft: 0,
              zIndex: 100000
            });
            jQuery(".wdwt_image_wrap").css({width: (jQuery(window).width() )});
            jQuery(".wdwt_image_container").css({width: (jQuery(window).width() )});

            jQuery(".wdwt_popup_image").css({
              maxWidth: jQuery(window).width()
            });

            wdwt_popup_current_width = jQuery(window).width();

          }


          if (((jQuery(window).height() > <?php echo $image_height - 2 * $theme_row['lightbox_close_btn_top']; ?>) && (jQuery(window).width() >= <?php echo $image_width - 2 * $theme_row['lightbox_close_btn_right']; ?>)) && (<?php echo $open_with_fullscreen ? 1 : 0 ; ?> != 1)) {
            jQuery(".wdwt_spider_popup_close_fullscreen").attr("class", "wdwt_spider_popup_close");
          }
        else {
            if ((jQuery("#wdwt_spider_popup_wrap").width() < jQuery(window).width()) && (jQuery("#wdwt_spider_popup_wrap").height() < jQuery(window).height())) {
              jQuery(".wdwt_spider_popup_close").attr("class", "wdwt_ctrl_btn wdwt_spider_popup_close_fullscreen");
            }
          }

        }


        jQuery(window).resize(function() {

          if (typeof jQuery().fullscreen !== 'undefined' && jQuery.isFunction(jQuery().fullscreen) && !jQuery.fullscreen.isFullScreen()) {
            wdwt_popup_resize();
          }
        });

        /* Popup current width/height.*/
        var wdwt_popup_current_width = <?php echo $image_width; ?>;
        var wdwt_popup_current_height = <?php echo $image_height; ?>;

        function wdwt_reset_zoom() {
          var isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
          var viewportmeta = document.querySelector('meta[name="viewport"]');
          if (isMobile && viewportmeta) {
            viewportmeta.content = 'width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0';
          }
        }




        jQuery(document).ready(function () {
          <?php
          if ($image_right_click) {
          ?>
          /* Disable right click.*/
          jQuery(".wdwt_image_wrap").bind("contextmenu", function (e) {
            return false;
          });
          <?php
          }
          ?>
          if (typeof jQuery().swiperight !== 'undefined' && jQuery.isFunction(jQuery().swiperight)) {
            jQuery('#wdwt_spider_popup_wrap').swiperight(function () {
              wdwt_change_image(parseInt(jQuery('#wdwt_current_image_key').val()), parseInt(jQuery('#wdwt_current_image_key').val()) - 1, wdwt_data)
              return false;
            });
          }
          if (typeof jQuery().swipeleft !== 'undefined' && jQuery.isFunction(jQuery().swipeleft)) {
            jQuery('#wdwt_spider_popup_wrap').swipeleft(function () {
              wdwt_change_image(parseInt(jQuery('#wdwt_current_image_key').val()), parseInt(jQuery('#wdwt_current_image_key').val()) + 1, wdwt_data);
              return false;
            });
          }

          wdwt_reset_zoom();
          var isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
          var wdwt_click = isMobile ? 'touchend' : 'click';
          jQuery("#wdwt_spider_popup_left").on(wdwt_click, function () {
            wdwt_change_image(parseInt(jQuery('#wdwt_current_image_key').val()), (parseInt(jQuery('#wdwt_current_image_key').val()) + wdwt_data.length - 1) % wdwt_data.length, wdwt_data);
            return false;
          });
          jQuery("#wdwt_spider_popup_right").on(wdwt_click, function () {
            wdwt_change_image(parseInt(jQuery('#wdwt_current_image_key').val()), (parseInt(jQuery('#wdwt_current_image_key').val()) + 1) % wdwt_data.length, wdwt_data);
            return false;
          });
          if (navigator.appVersion.indexOf("MSIE 10") != -1 || navigator.appVersion.indexOf("MSIE 9") != -1) {
            setTimeout(function () {
              wdwt_popup_resize();
            }, 20);
          }
          else {
            wdwt_popup_resize();
          }

          /* If browser doesn't support Fullscreen API.*/
          if (typeof jQuery().fullscreen !== 'undefined' && jQuery.isFunction(jQuery().fullscreen) && !jQuery.fullscreen.isNativelySupported()) {
            jQuery(".wdwt_fullscreen").hide();
          }
          /* Set image container height.*/
          jQuery(".wdwt_image_container").height(jQuery(".wdwt_image_wrap").height());
          jQuery(".wdwt_image_container").width(jQuery(".wdwt_image_wrap").width());

          /* Show/hide image title/description.*/
          jQuery(".wdwt_info").on(wdwt_click, function() {

            if (jQuery(".wdwt_image_info_container1").css("display") == 'none') {
              jQuery(".wdwt_image_info_container1").css("display", "table-cell");
              jQuery(".wdwt_info").attr("title", "<?php echo __('Hide info', "best-magazine"); ?>");
            }
            else {
              jQuery(".wdwt_image_info_container1").css("display", "none");
              jQuery(".wdwt_info").attr("title", "<?php echo __('Show info', "best-magazine"); ?>");
            }

          });
          /* Open/close control buttons.*/
          jQuery(".wdwt_toggle_container").on(wdwt_click, function () {
            var wdwt_open_toggle_btn_class = "<?php echo ($theme_row['lightbox_ctrl_btn_pos'] == 'top') ? 'fa-angle-up' : 'fa-angle-down'; ?>";
            var wdwt_close_toggle_btn_class = "<?php echo ($theme_row['lightbox_ctrl_btn_pos'] == 'top') ? 'fa-angle-down' : 'fa-angle-up'; ?>";
            if (jQuery(".wdwt_toggle_container i").hasClass(wdwt_open_toggle_btn_class)) {
              // Close controll buttons.

              <?php
              if ($theme_row['lightbox_ctrl_btn_pos'] == 'bottom' && $theme_row['lightbox_info_pos'] == 'bottom') {
              ?>
              jQuery(".wdwt_image_info").animate({bottom: 0}, 500);
              <?php
              }
              elseif ( $theme_row['lightbox_ctrl_btn_pos'] == 'top' && $theme_row['lightbox_info_pos'] == 'top') {
              ?>
              jQuery(".wdwt_image_info").animate({top: 0}, 500);
              <?php
              }
              ?>

              jQuery(".wdwt_ctrl_btn_container").animate({<?php echo $theme_row['lightbox_ctrl_btn_pos']; ?> : '-' + jQuery(".wdwt_ctrl_btn_container").height()}, 500);

              jQuery(".wdwt_toggle_container").animate({
              <?php echo $theme_row['lightbox_ctrl_btn_pos']; ?>: 0
            }, {
                duration: 500,
                  complete: function () { jQuery(".wdwt_toggle_container i").attr("class", "wdwt_toggle_btn fa " + wdwt_close_toggle_btn_class) }
              });

            }
            else {

              // Open controll buttons.
              <?php
              if ( $theme_row['lightbox_ctrl_btn_pos'] == 'bottom' && $theme_row['lightbox_info_pos'] == 'bottom') {
              ?>
              jQuery(".wdwt_image_info").animate({bottom: jQuery(".wdwt_ctrl_btn_container").height()}, 500);
              <?php
              }
              elseif ( $theme_row['lightbox_ctrl_btn_pos'] == 'top' && $theme_row['lightbox_info_pos'] == 'top') {
              ?>
              jQuery(".wdwt_image_info").animate({top: jQuery(".wdwt_ctrl_btn_container").height()}, 500);
              <?php
              }
              ?>
              jQuery(".wdwt_ctrl_btn_container").animate({<?php echo $theme_row['lightbox_ctrl_btn_pos']; ?>: 0}, 500);
              jQuery(".wdwt_toggle_container").animate({
              <?php echo $theme_row['lightbox_ctrl_btn_pos']; ?>: jQuery(".wdwt_ctrl_btn_container").height()
            }, {
                duration: 500,
                  complete: function () { jQuery(".wdwt_toggle_container i").attr("class", "wdwt_toggle_btn fa " + wdwt_open_toggle_btn_class) }
              });

            }

          });
          // Maximize/minimize.
          jQuery(".wdwt_resize-full").on(wdwt_click, function () {


            if (jQuery(".wdwt_resize-full").hasClass("fa-resize-small")) {
              if (jQuery(window).width() > <?php echo $image_width; ?>) {
                wdwt_popup_current_width = <?php echo $image_width; ?>;
              }
              if (jQuery(window).height() > <?php echo $image_height; ?>) {
                wdwt_popup_current_height = <?php echo $image_height; ?>;
              }
              // Minimize.
              jQuery("#wdwt_spider_popup_wrap").animate({
                width: wdwt_popup_current_width,
                height: wdwt_popup_current_height,
                left: '50%',
                top: '50%',
                marginLeft: -wdwt_popup_current_width / 2,
                marginTop: -wdwt_popup_current_height / 2,
                zIndex: 100000
              }, 500);
              jQuery(".wdwt_image_wrap").animate({width: wdwt_popup_current_width }, 500);
              jQuery(".wdwt_image_container").animate({height: wdwt_popup_current_height , width: wdwt_popup_current_width }, 500);

              jQuery(".wdwt_popup_image").animate({
                maxWidth: wdwt_popup_current_width ,
                maxHeight: wdwt_popup_current_height
              }, {
                duration: 500,
                complete: function () {
                  if ((jQuery("#wdwt_spider_popup_wrap").width() < jQuery(window).width()) && (jQuery("#wdwt_spider_popup_wrap").height() < jQuery(window).height())) {
                    jQuery(".wdwt_spider_popup_close_fullscreen").attr("class", "wdwt_spider_popup_close");
                  }
                }
              });
              jQuery(".wdwt_resize-full").attr("class", "wdwt_ctrl_btn wdwt_resize-full fa fa-resize-full");
              jQuery(".wdwt_resize-full").attr("title", "<?php echo __('Maximize', "best-magazine"); ?>");
            }
            else {
              wdwt_popup_current_width = jQuery(window).width();
              wdwt_popup_current_height = jQuery(window).height();
              // Maximize.
              jQuery("#wdwt_spider_popup_wrap").animate({
                width: jQuery(window).width(),
                height: jQuery(window).height(),
                left: 0,
                top: 0,
                margin: 0,
                zIndex: 100000
              }, 500);
              jQuery(".wdwt_image_wrap").animate({width: (jQuery(window).width() )}, 500);
              jQuery(".wdwt_image_container").animate({height: (wdwt_popup_current_height ), width: wdwt_popup_current_width }, 500);
              jQuery(".wdwt_popup_image").animate({
                maxWidth: jQuery(window).width(),
                maxHeight: jQuery(window).height()
              }, {
                duration: 500,
                complete: function () {  }
              });

              jQuery(".wdwt_resize-full").attr("class", "wdwt_ctrl_btn wdwt_resize-full fa fa-resize-small");
              jQuery(".wdwt_resize-full").attr("title", "<?php echo __('Restore', "best-magazine"); ?>");
              jQuery(".wdwt_spider_popup_close").attr("class", "wdwt_ctrl_btn wdwt_spider_popup_close_fullscreen");
            }

          });
          // Fullscreen.

          //Toggle with mouse click
          jQuery(".wdwt_fullscreen").on(wdwt_click, function () {



            function wdwt_exit_fullscreen() {

              if (jQuery(window).width() > <?php echo $image_width; ?>) {
                wdwt_popup_current_width = <?php echo $image_width; ?>;
              }
              if (jQuery(window).height() > <?php echo $image_height; ?>) {
                wdwt_popup_current_height = <?php echo $image_height; ?>;
              }




              <?php
              if ($open_with_fullscreen) {
              ?>
              wdwt_popup_current_width = jQuery(window).width();
              wdwt_popup_current_height = jQuery(window).height();
              <?php
              }
              ?>


              jQuery("#wdwt_spider_popup_wrap").on("fscreenclose", function() {
                jQuery("#wdwt_spider_popup_wrap").css({
                  width: wdwt_popup_current_width,
                  height: wdwt_popup_current_height,
                  left: '50%',
                  top: '50%',
                  marginLeft: -wdwt_popup_current_width / 2,
                  marginTop: -wdwt_popup_current_height / 2,
                  zIndex: 100000
                });
                jQuery(".wdwt_image_wrap").css({width: wdwt_popup_current_width });
                jQuery(".wdwt_image_container").css({height: wdwt_popup_current_height , width: wdwt_popup_current_width });
                jQuery(".wdwt_popup_image").css({
                  maxWidth: wdwt_popup_current_width ,
                  maxHeight: wdwt_popup_current_height
                });


                jQuery(".wdwt_resize-full").show();
                jQuery(".wdwt_resize-full").attr("class", "wdwt_ctrl_btn wdwt_resize-full fa fa-resize-full");
                jQuery(".wdwt_resize-full").attr("title", "<?php echo __('Maximize', "best-magazine"); ?>");
                jQuery(".wdwt_fullscreen").attr("class", "wdwt_ctrl_btn wdwt_fullscreen fa fa-fullscreen");
                jQuery(".wdwt_fullscreen").attr("title", "<?php echo __('Fullscreen', "best-magazine"); ?>");
                if ((jQuery("#wdwt_spider_popup_wrap").width() < jQuery(window).width()) && (jQuery("#wdwt_spider_popup_wrap").height() < jQuery(window).height())) {
                  jQuery(".wdwt_spider_popup_close_fullscreen").attr("class", "wdwt_spider_popup_close");
                }
              });
            }

            if (typeof jQuery().fullscreen !== 'undefined' && jQuery.isFunction(jQuery().fullscreen)) {
              if (jQuery.fullscreen.isFullScreen()) {

                // Exit Fullscreen.
                jQuery.fullscreen.exit();
                wdwt_exit_fullscreen();

              }
              else {

                // Fullscreen.

                jQuery("#wdwt_spider_popup_wrap").fullscreen();
                var screen_width = screen.width;
                var screen_height = screen.height;
                jQuery("#wdwt_spider_popup_wrap").css({
                  width: screen_width,
                  height: screen_height,
                  left: 0,
                  top: 0,
                  margin: 0,
                  zIndex: 100000
                });
                jQuery(".wdwt_image_wrap").css({width: screen_width});
                jQuery(".wdwt_image_container").css({height: (screen_height ), width: screen_width  });
                jQuery(".wdwt_popup_image").css({
                  maxWidth: (screen_width ),
                  maxHeight: (screen_height )
                });


                jQuery(".wdwt_resize-full").hide();
                jQuery(".wdwt_fullscreen").attr("class", "wdwt_ctrl_btn wdwt_fullscreen fa fa-resize-small");
                jQuery(".wdwt_fullscreen").attr("title", "<?php esc_attr_e('Exit Fullscreen', "best-magazine"); ?>");
                jQuery(".wdwt_spider_popup_close").attr("class", "wdwt_ctrl_btn wdwt_spider_popup_close_fullscreen");

              }
            }
            return false;
          });


          /* Play/pause.*/
          jQuery(".wdwt_play_pause, .wdwt_popup_image").on(wdwt_click, function () {
            if (jQuery(".wdwt_ctrl_btn").hasClass("fa-play")) {
              /* PLay.*/
              wdwt_play();
              jQuery(".wdwt_play_pause").attr("title", "<?php echo __('Pause', "best-magazine"); ?>");
              jQuery(".wdwt_play_pause").attr("class", "wdwt_ctrl_btn wdwt_play_pause fa fa-pause");

            }
            else {
              /* Pause.*/

              window.clearInterval(wdwt_playInterval);
              jQuery(".wdwt_play_pause").attr("title", "<?php echo __('Play', "best-magazine"); ?>");
              jQuery(".wdwt_play_pause").attr("class", "wdwt_ctrl_btn wdwt_play_pause fa fa-play");

            }
          });
          /* Open with autoplay.*/

          <?php

          if ($open_with_autoplay) {
          ?>
          wdwt_play();
          jQuery(".wdwt_play_pause").attr("title", "<?php echo __('Pause', "best-magazine"); ?>");
          jQuery(".wdwt_play_pause").attr("class", "wdwt_ctrl_btn wdwt_play_pause fa fa-pause");
          <?php
          }
          ?>

          /* Open with fullscreen.*/

          <?php
          if ($open_with_fullscreen) {
          ?>
          wdwt_open_with_fullscreen();
          <?php
          }
          ?>


          <?php
          if ($preload_images) {
            echo "wdwt_preload_images(parseInt(jQuery('#wdwt_current_image_key').val()));";
          }
          ?>

        });



        /* Open with fullscreen.*/
        function wdwt_open_with_fullscreen() {

          wdwt_popup_current_width = jQuery(window).width();
          wdwt_popup_current_height = jQuery(window).height();
          jQuery("#wdwt_spider_popup_wrap").css({
            width: jQuery(window).width(),
            height: jQuery(window).height(),
            left: 0,
            top: 0,
            margin: 0,
            zIndex: 100000
          });
          jQuery(".wdwt_image_wrap").css({width: (jQuery(window).width())});
          jQuery(".wdwt_image_container").css({height: (wdwt_popup_current_height), width: wdwt_popup_current_width});
          jQuery(".wdwt_popup_image").css({
            maxWidth: jQuery(window).width() ,
            maxHeight: jQuery(window).height()
          });

          jQuery(".wdwt_resize-full").attr("class", "wdwt_ctrl_btn wdwt_resize-full fa fa-resize-small");
          jQuery(".wdwt_resize-full").attr("title", "<?php echo __('Restore', "best-magazine"); ?>");
          jQuery(".wdwt_spider_popup_close").attr("class", "wdwt_ctrl_btn wdwt_spider_popup_close_fullscreen");
        }


        function wdwt_play() {
          window.clearInterval(wdwt_playInterval);
          wdwt_playInterval = setInterval(function () {
            if (!wdwt_data[parseInt(jQuery('#wdwt_current_image_key').val()) + 1]) {
              /* Wrap around.*/
              wdwt_change_image(parseInt(jQuery('#wdwt_current_image_key').val()), 0, wdwt_data);
              return;
            }
            wdwt_change_image(parseInt(jQuery('#wdwt_current_image_key').val()), parseInt(jQuery('#wdwt_current_image_key').val()) + 1, wdwt_data)
          }, '<?php echo $slideshow_interval * 1000; ?>');
        }


        jQuery(window).focus(function() {
          /* event_stack = [];*/
          if (!jQuery(".wdwt_ctrl_btn").hasClass("fa-play")) {
            wdwt_play();
          }
          /*var i = 0;
           jQuery(".wdwt_slider").children("span").each(function () {
           if (jQuery(this).css('opacity') == 1) {
           jQuery("#wdwt_current_image_key").val(i);
           }
           i++;
           });*/
        });

        jQuery(window).blur(function() {
          event_stack = [];
          window.clearInterval(wdwt_playInterval);
        });










      </script>


      <?php
      // die();
    }


    ////////////////////////////////////////////////////////////////////////////////////////
    // Getters & Setters                                                                  //
    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    // Private Methods                                                                    //
    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    // Listeners                                                                          //
    ////////////////////////////////////////////////////////////////////////////////////////
  }