<?php

  /* include  fornt end framework class */
  require_once('WDWT_front_params_output.php');

  class best_magazine_front extends WDWT_front {


    /**
     * print Layout styles
     *
     */

    public function layout(){
      global $post;
      if(is_singular() && isset($post)){
        /*get all the meta of the current theme for the post*/
        $meta = get_post_meta( $post->ID, WDWT_META, true );
      }
      else{
        $meta = array();
      }
      $default_layout = $this->get_param('default_layout', $meta) ;
      $main_column = esc_html( $this->get_param('main_column', $meta) );
      $pwa_width = esc_html( $this->get_param('pwa_width', $meta) );
      $full_width = trim(esc_html( $this->get_param('full_width', $meta) ));

      $content_area_percent = esc_html( $this->get_param('content_area_percent', $meta) );
      $content_area_percent = (intval($content_area_percent) < 100 && intval($content_area_percent) >= 75 ) ? intval($content_area_percent) : 75;

      if ($full_width) {
        $them_content_are_width='99';?>
        <script>var best_magazine_full_width=1</script>
        <?php
      } else {
        $them_content_are_width=$content_area_percent;
        ?>
        <script>
          var best_magazine_full_width=0;
          var best_magazine_content_width = <?php echo $content_area_percent; ?>;
        </script>
        <?php
      }

      switch ($default_layout) :
        case 1:
          ?>
          <style type="text/css">
            #sidebar1,
            #sidebar2 {
              display:none;
            }
            #blog {
              display:block;
              float:left;
            }
            .container,#blog{
              width: <?php echo $them_content_are_width; ?>%;
            }
          </style>
          <?php
          break;
        case 2:
          ?>
          <style type="text/css">
            #sidebar2{
              display:none;
            }
            #sidebar1 {
              display:block;
              float:right;
            }
            .container{
              width:<?php echo $them_content_are_width; ?>%;
            }
            .blog,#content{
              width:<?php echo $main_column ; ?>%;
              display:block;
              float:left;
            }
            #sidebar1{
              width:<?php echo (100 - $main_column); ?>%;
            }
          </style>
          <?php
          break;
        case 3:
          ?>
          <style type="text/css">
            #sidebar2{
              display:none;
            }
            #sidebar1 {
              display:block;
              float:left;
            }
            .container{
              width:<?php echo $them_content_are_width; ?>%;
            }
            .blog,#content{
              width:<?php echo $main_column ; ?>%;
              display:block;
              float:left;
            }
            #sidebar1{
              width:<?php echo (100 -  $main_column); ?>%;
            }
          </style>
          <?php
          break;
        case 4:
          ?>
          <style type="text/css">
            #sidebar2{
              display:block;
              float:right;
            }
            #sidebar1 {
              display:block; float:right;
            }
            .container{
              width:<?php echo $them_content_are_width; ?>%;
            }
            .blog,#content{
              width:<?php echo $main_column ; ?>%;
              display:block;
              float:left;
            }
            #sidebar1{
              width:<?php if(isset($pwa_width)) echo $pwa_width ; ?>%;
            }
            #sidebar2{
              width:<?php echo (100 -  $pwa_width - $main_column); ?>%;
            }
          </style>
          <?php
          break;
        case 5:
          ?>
          <style type="text/css">
            #sidebar2{
              display:block;
              float:left;
            }
            #sidebar1 {
              display:block;
              float:left;
            }
            .container{
              width:<?php echo $them_content_are_width; ?>%;
            }
            .blog,#content{
              width:<?php echo $main_column ; ?>%;
              display:block;
              float:right;
            }
            #sidebar1{
              width:<?php echo $pwa_width ; ?>%;
            }
            #sidebar2{
              width:<?php echo (100 - $pwa_width - $main_column); ?>%;
            }
          </style>
          <?php
          break;
        case 6:
          ?>
          <style type="text/css">
            #sidebar2{
              display:block;
              float:right;
            }
            #sidebar1 {
              display:block;
              float:left;
            }
            .container{
              width:<?php echo $them_content_are_width; ?>%;
            }
            .blog,#content{
              width:<?php echo $main_column; ?>%;
              display:block;
              float:left;
            }
            #sidebar1{
              width:<?php echo $pwa_width; ?>%;
            }
            #sidebar2{
              width:<?php echo (100 - $pwa_width - $main_column); ?>%;
            }
          </style>
          <?php
          break;
      endswitch;
    }


    /**
     *    FRONT END COLOR CONTROL
     */

    public function color_control(){

      $background_color = get_theme_mod('background_color', 'FEFEFE');
      $color_scheme = esc_html( $this->get_param('[colors_active][active]') );
      $menu_elem_back_color = esc_html( $this->get_param('[colors_active][colors][menu_elem_back_color][value]', array(), "#890000" ));
      $sideb_background_color = esc_html( $this->get_param('[colors_active][colors][sideb_background_color][value]', array(),"#FAFAFA" ));
      $footer_sideb_background_color = esc_html( $this->get_param('[colors_active][colors][footer_sideb_background_color][value]', array(), "#e4e4e4" ));
      $footer_back_color = esc_html( $this->get_param('[colors_active][colors][footer_back_color][value]', array(), "#CFCFCF" ));

      $home_top_posts_color = esc_html( $this->get_param('[colors_active][colors][home_top_posts_color][value]', array(), "#F5F5F5" ));
      $cat_tab_backgr_color = esc_html( $this->get_param('[colors_active][colors][cat_tab_backgr_color][value]', array(), "#000000" ));
      $top_posts_color = esc_html( $this->get_param('[colors_active][colors][top_posts_color][value]', array(), "#F5F5F5" ));
      $primary_text_headers_color = esc_html( $this->get_param('[colors_active][colors][primary_text_headers_color][value]', array(), "#000000"  ));

      $text_headers_color = esc_html( $this->get_param('[colors_active][colors][text_headers_color][value]', array(), "#890000" ));
      $primary_text_color = esc_html( $this->get_param('[colors_active][colors][primary_text_color][value]', array(), "#2C2C2C" ));
      $footer_text_color = esc_html( $this->get_param('[colors_active][colors][footer_text_color][value]', array(), "#000000" ));
      $primary_links_color = esc_html( $this->get_param('[colors_active][colors][primary_links_color][value]', array(), "#000000"));

      $primary_links_hover_color = esc_html( $this->get_param('[colors_active][colors][primary_links_hover_color][value]', array(), "#440000" ));
      $menu_links_color = esc_html( $this->get_param('[colors_active][colors][menu_links_color][value]', array(), "#FFFFFF" ));
      $menu_links_hover_color = esc_html( $this->get_param('[colors_active][colors][menu_links_hover_color][value]', array(), "#FFFFFF" ));
      $menu_color = esc_html( $this->get_param('[colors_active][colors][menu_color][value]', array(), "#000000" ));

      $selected_menu_color = esc_html( $this->get_param('[colors_active][colors][selected_menu_color][value]', array(), "#000000" ));
      $logo_text_color = esc_html( $this->get_param('[colors_active][colors][logo_text_color][value]', array(), "#890000" ));

      ?>
      <style type="text/css">
        h1, h3, h4, h5, h6, h1>a, h3>a, h4>a, h5>a, h6>a,h1 > a:link, h3 > a:link, h4 > a:link, h5 > a:link, h6 > a:link,h1 > a:hover,h3 > a:hover,h4 > a:hover,h5 > a:hover,h6 > a:hover,h61> a:visited,h3 > a:visited,h4 > a:visited,h5 > a:visited,h6 > a:visited, .full-width h2, #content .search-result h2 >a, #content .archive-header >a{
          color:<?php echo $text_headers_color; ?>;
        }
        h2, h2>a, h2 > a:link, h2 > a:hover,h2 > a:visited, .widget-container h3, .widget-area h3, h1.page-title, h1.styledHeading{
          color:<?php echo $primary_text_headers_color; ?>;
        }
        #sidebar-footer .widget-container h3{
          border-bottom: 1px solid <?php echo $primary_text_headers_color; ?>;
        }
        #back h3 a{
          color: <?php echo '#'.$this->negativeColor($this->ligthest_brigths($menu_elem_back_color, 10)); ?> !important;
        }
        a:link.site-title-a,a:hover.site-title-a,a:visited.site-title-a,a.site-title-a,#logo h1{
          color:<?php echo $logo_text_color;?>;
        }
        .read_more, #commentform #submit,.reply  {
          color:<?php echo $menu_links_color;?> !important;
          background-color: <?php echo $menu_elem_back_color; ?>;
        }
        .bwg_slideshow_title_text{
          color: <?php echo $text_headers_color; ?>;
        }
        .bwg_slideshow_title_text.none{
          display:none;
        }
        .bwg_slideshow_description_text.none{
          display:none;
        }


        .reply a{
          color:<?php echo $menu_links_color;?> !important;
        }
        .read_more:hover,#commentform #submit:hover, .reply:hover {
          color:<?php echo '#'.$this->ligthest_brigths($menu_links_color,50); ?> !important;
          background-color: <?php echo '#'.$this->ligthest_brigths($menu_elem_back_color,15); ?>;
        }

        #back {
          background-color: <?php echo '#'.$this->ligthest_brigths($menu_elem_back_color, 10); ?>;
        }

        #wd-categories-tabs ul.content, #wd-categories-tabs  ul.tabs li a, #videos-block {
          background:<?php echo $home_top_posts_color;?>;
        }

        #header-block{
          background-color:<?php echo $menu_color; ?>;
        }

        .topPost {
          background-image: url(<?php echo get_template_directory_uri(); ?>/images/topPost-back<?php if($color_scheme == "Theme-1") echo "1"; elseif($color_scheme == "Theme-2") echo "2"; elseif($color_scheme == "Theme-3") echo "3"; else echo "1"; ?>.png);
        }

        #footer-bottom {
          background-color: <?php echo $footer_back_color; ?>;
        }
        #footer{
          background-color:<?php echo $footer_back_color; ?>;

        }

        .footer-sidbar{
          background-color:<?php echo $footer_sideb_background_color; ?>;
          border-top-color:<?php echo '#'.$this->darkest_brigths($footer_sideb_background_color, 10); ?> !important;
        }

        #header,#site_desc {
          color: <?php echo $text_headers_color; ?>;
        }
        body{
          color: <?php echo $primary_text_color; ?>;
        }


        #footer-bottom {
          color: <?php echo $footer_text_color; ?>;
        }

        a:link, a:visited {
          text-decoration: none;
          color: <?php echo $primary_links_color; ?>;
        }

        .top-nav-list .current-menu-item{
          color: <?php echo $menu_links_hover_color; ?> !important;
          background-color: <?php echo  $selected_menu_color; ?>;
        }

        a:hover {
          color: <?php echo $primary_links_hover_color; ?>;
        }
        .sep{color:<?php echo $menu_elem_back_color; ?>;}

        #menu-button-block {
          background-color: <?php echo $menu_elem_back_color; ?>;
        }

        .blog.bage-news .news-post{
          border-bottom:1px solid <?php echo $menu_elem_back_color; ?>;
        }

        #sidebar-footer .widget-container ul li:before, aside .sidebar-container ul li:before,#sidebar-footer .widget-container ul li:before, .most_categories ul li:before {
          border-left:solid  <?php echo $menu_elem_back_color; ?>;
        }

        .top-nav-list li li:hover .top-nav-list a:hover, .top-nav-list .current-menu-item a:hover,.top-nav-list li:hover,.top-nav-list li a:hover{
          background-color: <?php echo $menu_color; ?>;
          color:<?php echo $menu_links_hover_color; ?> !important;
        }

        .top-nav-list li.current-menu-item, .top-nav-list li.current_page_item{
          background-color: <?php echo $selected_menu_color; ?> ;
          color: <?php echo $menu_links_hover_color; ?>;
        }
        .top-nav-list li.current-menu-item a, .top-nav-list li.current_page_item a{
          color: <?php echo $menu_links_hover_color; ?> !important;
        }

        #top-nav{
          background:<?php echo $menu_elem_back_color; ?>;
        }
        .top-nav-list> ul > li ul, .top-nav-list > li ul  {
          background:<?php echo $this->hex_to_rgba($selected_menu_color,0.8); ?>;
        }
        #reply-title small a:link{
          color:<?php echo $menu_links_color; ?>;
        }




        .masonry_item {
          background-color : <?php echo $home_top_posts_color; ?>;
        }
        .masonry_item:hover {
          background-color : #<?php echo $background_color; ?>;
        }

        aside .sidebar-container, .gallery_main_div,.blog.bage-news .news-post {
          background-color:<?php echo $sideb_background_color; ?>;
        }
        .commentlist li {
          background-color:<?php echo $sideb_background_color; ?>;
        }

        #respond{
          background-color:<?php echo $sideb_background_color; ?>;
        }
        #reply-title small{
          background:<?php echo $menu_elem_back_color; ?>;
        }

        @media only screen and (max-width : 767px){
          #top-nav ul{
            background:<?php echo $menu_elem_back_color; ?> !important;
          }
          #top-nav{
            background:none !important;
          }
          #top-nav  > li  > a, #top-nav  > li  > a:link, #top-nav  > li  > a:visited {
            color:<?php echo $menu_links_color; ?>;
            background:<?php echo $selected_menu_color; ?>;
          }
          .top-nav-list  > li:hover > a ,.top-nav-list  > li  > a:hover, .top-nav-list  > li  > a:focus, .top-nav-list  > li  > a:active {
            color:<?php echo $menu_links_hover_color; ?> !important;
            background:<?php echo $menu_color; ?> !important;
          }
        }

        #top-posts,
        #top-posts-list li h3 {
          background-color:<?php echo $top_posts_color; ?>;
        }

        #wd-categories-tabs .content{
          background-color:<?php echo $home_top_posts_color; ?>;
        }

        #wd-categories-tabs  ul.tabs li a:hover,/* #wd-categories-tabs  ul.tabs li a:focus,*/ #wd-categories-tabs  ul.tabs li a:active,
        #wd-categories-tabs  ul.tabs li.active a, #wd-categories-tabs  ul.tabs li.active a:link, #wd-categories-tabs  ul.tabs li.active a:visited,
        #wd-categories-tabs  ul.tabs li.active a:hover, #wd-categories-tabs  ul.tabs li.active a:focus, #wd-categories-tabs  ul.tabs li.active a:active{
          background:<?php echo $cat_tab_backgr_color; ?>;
          color: <?php echo $menu_links_hover_color; ?>;
        }

        #wd-categories-tabs ul.tabs{
          border-bottom: 1px solid <?php echo $cat_tab_backgr_color; ?>;
        }

        #wd-categories-tabs  ul.tabs li a{
          background:<?php echo $home_top_posts_color; ?>;
        }






        .top-nav-list >ul > li > a, .top-nav-list> ul > li ul > li > a,#top-nav  div  ul  li  a, #top-nav > div > ul > li > a:link, #top-nav > div > div > ul > li > a{
          color:<?php echo $menu_links_color ?>;
        }
        .top-nav-list > li:hover > a, .top-nav-list > li ul > li > a:hover{
          color:<?php echo $menu_links_hover_color ?>;
        }

        @media only screen and (max-width : 767px){
          .top-nav-list   li ul li  > a, .top-nav-list   li ul li  > a:link, .top-nav-list   li  ul li > a:visited {
            color:<?php echo $menu_links_color ?> !important;
          }
          .top-nav-list   li ul li:hover  > a,.top-nav-list   li ul li  > a:hover, .top-nav-list   li ul li  > a:focus, .top-nav-list   li ul li  > a:active {
            color:<?php echo $menu_links_hover_color; ?> !important;
            background-color:<?php echo $menu_elem_back_color; ?> !important;
          }
          .top-nav-list  li.has-sub >  a, .top-nav-list  li.has-sub > a:link, .top-nav-list  li.has-sub >  a:visited {
            background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right top no-repeat !important;
          }
          .top-nav-list  li.has-sub:hover > a,.top-nav-list  li.has-sub > a:hover, .top-nav-list  li.has-sub > a:focus, .top-nav-list  li.has-sub >  a:active {
            background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right top no-repeat !important;
          }

          .top-nav-list  li ul li.has-sub > a, .top-nav-list  li ul li.has-sub > a:link, .top-nav-list  li ul li.has-sub > a:visited{
            background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right -18px no-repeat !important;
          }
          .top-nav-list  li ul li.has-sub:hover > a,.top-nav-list  li ul li.has-sub > a:hover, .top-nav-list  li ul li.has-sub > a:focus, .top-nav-list  li ul li.has-sub > a:active {
            background:<?php echo '#'.$this->ligthest_brigths($menu_elem_back_color,15); ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right -18px no-repeat !important;
          }

          .top-nav-list  li.current-menu-ancestor > a:hover, .top-nav-list  li.current-menu-item > a:focus, .top-nav-list  li.current-menu-item > a:active{
            color:<?php echo $menu_links_color ?> !important;
            background-color:<?php echo $menu_elem_back_color; ?> !important;
          }

          .top-nav-list  li.current-menu-item > a,.top-nav-list  li.current-menu-item > a:visited,
          {
            color:<?php echo $primary_links_hover_color ?> !important;
            background-color:<?php echo $selected_menu_color; ?> !important;
          }

          .top-nav-list  li.current-menu-parent > a, .top-nav-list  li.current-menu-parent > a:link, .top-nav-list  li.current-menu-parent > a:visited,
          .top-nav-list  li.current-menu-parent > a:hover, .top-nav-list  li.current-menu-parent > a:focus, .top-nav-list  li.current-menu-parent > a:active,
          .top-nav-list  li.has-sub.current-menu-item  > a, .top-nav-list  li.has-sub.current-menu-item > a:link, .top-nav-list  li.has-sub.current-menu-item > a:visited,
          .top-nav-list  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list  li.has-sub.current-menu-item > a:focus, .top-nav-list  li.has-sub.current-menu-item > a:active,
          .top-nav-list  li.current-menu-ancestor > a, .top-nav-list  li.current-menu-ancestor > a:link, .top-nav-list  li.current-menu-ancestor > a:visited,
          .top-nav-list  li.current-menu-ancestor > a:hover, .top-nav-list  li.current-menu-ancestor > a:focus, .top-nav-list  li.current-menu-ancestor > a:active {
            color:<?php echo $menu_links_color ?> !important;
            background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right bottom no-repeat !important;
          }
          .top-nav-list  li ul  li.current-menu-item > a, .top-nav-list  li ul  li.current-menu-item > a:link, .top-nav-list  li ul  li.current-menu-item > a:visited,
          .top-nav-list  li ul  li.current-menu-ancestor > a:hover, .top-nav-list  li ul  li.current-menu-item > a:focus, .top-nav-list  li ul  li.current-menu-item > a:active{
            color:<?php echo $menu_links_color ?> !important;
            background-color:<?php echo '#'.$this->ligthest_brigths($menu_elem_back_color,15); ?> !important;
          }
          .top-nav-list li ul  li.current-menu-parent > a, .top-nav-list  li ul  li.current-menu-parent > a:link, .top-nav-list  li ul  li.current-menu-parent > a:visited,
          .top-nav-list li ul li.current-menu-parent  > a:hover, .top-nav-list  li ul  li.current-menu-parent > a:focus, .top-nav-list  li ul  li.current-menu-parent > a:active,
          .top-nav-list  li ul  li.has-sub.current-menu-item > a, .top-nav-list  li ul  li.has-sub.current-menu-item > a:link, .top-nav-list  li ul  li.has-sub.current-menu-item > a:visited,
          .top-nav-list  li ul  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list  li ul  li.has-sub.current-menu-item > a:focus, .top-nav-list  li ul  li.has-sub.current-menu-item > a:active,
          .top-nav-list li ul  li.current-menu-ancestor > a, .top-nav-list  li ul  li.current-menu-ancestor > a:link, .top-nav-list  li ul  li.current-menu-ancestor > a:visited,
          .top-nav-list li ul li.current-menu-ancestor  > a:hover, .top-nav-list  li ul  li.current-menu-ancestor > a:focus, .top-nav-list  li ul  li.current-menu-ancestor > a:active {
            color:<?php echo $menu_links_color ?> !important;
            background:<?php echo '#'.$this->ligthest_brigths($menu_elem_back_color,15); ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right -158px no-repeat !important;
          }
        }





      </style>
      <?php
    }



    public function slideshow(){
      $hide_slider = $this->get_param('hide_slider');
      $imgs_url = $this->get_param('slider_head');
      $image_textarea = $this->get_param('slider_head_desc');
      $logo_text = $this->get_param('logo_text');
      $image_title = $this->get_param('slider_head_title');
      $image_height = $this->get_param('image_height');
      $title_position = $this->get_param('title_position');
      $description_position = $this->get_param('description_position');
      $imgs_href = $this->get_param('slider_head_href');

      $imgs_url = explode('||wd||',$imgs_url);
      $imgs_href = explode('||wd||',$imgs_href);
      $image_title = explode('||wd||',$image_title);
      $image_textarea = explode('||wd||',$image_textarea);
      $imgs_number = count($imgs_url);

      /*clear from spaces etc */

      foreach ($imgs_url as $i => $url){
        $imgs_url[$i] = trim($url);
      }
      for($i=0;$i<count($imgs_number);$i++){
        $imgs_href[$i] = isset($imgs_href[$i]) ? trim($imgs_href[$i]) : '';
        $image_title[$i] = isset($image_title[$i]) ? trim($image_title[$i]) : '';
        $image_textarea[$i] = isset($image_textarea[$i]) ? trim($image_textarea[$i]) : '';
      }


      if( ($hide_slider[0]!="Hide Slider" &&
          ((is_front_page() && $hide_slider[0]=="Only on Homepage") ||
            $hide_slider[0]=="On all the pages and posts"))
        && count($imgs_url) && is_array($imgs_url)){   ?>
        <script>
          var data = [];
          var event_stack = [];


          <?php

          if($imgs_url && is_array($imgs_url))
            $link_array=$imgs_url;
          else
            $link_array = array();

          for($i=0;$i<count($link_array);$i++){
            echo 'data["'.$i.'"]=[];';
          }

          for($i=0;$i<count($link_array);$i++){
            echo 'data["'.$i.'"]["id"]="'.$i.'";';
            echo 'data["'.$i.'"]["image_url"]="'.$link_array[$i].'";';
          }

          if($image_textarea && is_array($image_textarea))
            $textarea_array = $image_textarea;
          else
            $textarea_array = array();

          for($i=0;$i<count($textarea_array);$i++){
            echo 'data["'.$i.'"]["description"]="'. str_replace(array("\n","\r"), '', $textarea_array[$i]).'";';
          }

          if($image_title && is_array($image_title))
            $title_array = $image_title;
          else
            $title_array = array();

          for($i=0;$i<count($title_array);$i++){
            echo 'data["'.$i.'"]["alt"]="'.str_replace(array("\n","\r"), '',$title_array[$i]).'";';

          } ?>
        </script>

        <?php
        $slideshow_title_position = explode('-', trim($title_position[0]) );
        $slideshow_description_position = explode('-', trim($description_position[0]) );
        ?>
        <style>
          .bwg_slideshow_image_wrap {
            height:<?php echo esc_html( $image_height ); ?>px;
            width:100% !important;
          }

          .bwg_slideshow_title_span {
            text-align: <?php echo esc_html( $slideshow_title_position[0] ); ?>;
            vertical-align: <?php echo esc_html( $slideshow_title_position[1] ); ?>;
          }
          .bwg_slideshow_description_span {
            text-align: <?php echo esc_html( $slideshow_description_position[0] ); ?>;
            vertical-align: <?php echo esc_html( $slideshow_description_position[1] ); ?>;
          }
        </style>

        <!--SLIDESHOW START-->
        <div id="slideshow">
          <div class="container">
            <div class="slider_contener_for_exklusive">
              <div class="bwg_slideshow_image_wrap" id="bwg_slideshow_image_wrap_id">
                <?php
                  $current_image_id=0;
                  $current_pos =0;
                  $current_key=0; ?>
                <!--################# DOTS ################# -->

                <a id="spider_slideshow_left" onclick="bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) >= 0 ? (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) % data.length : data.length - 1, data); return false;"><span id="spider_slideshow_left-ico"><span><i class="bwg_slideshow_prev_btn fa"></i></span></span></a>
                <a id="spider_slideshow_right" onclick="bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + iterator()) % data.length, data); return false;"><span id="spider_slideshow_right-ico"><span><i class="bwg_slideshow_next_btn fa "></i></span></span></a>
                <!--################################## -->

                <!--################ IMAGES ################## -->
                <div id="bwg_slideshow_image_container"  width="100%" class="bwg_slideshow_image_container">
                  <div class="bwg_slide_container" width="100%">
                    <div class="bwg_slide_bg">
                      <div class="bwg_slider">
                        <?php
                          if($imgs_href && is_array($imgs_href))
                            $href_array = $imgs_href;
                          else
                            $href_array = array();

                          if($imgs_url && is_array($imgs_url))
                            $image_rows = $imgs_url;
                          else
                            $image_rows = array();
                          $i=0;

                          foreach ($image_rows as $key => $image_row) {
                            if ($i == $current_image_id) {
                              $current_key = $key;
                              ?>
                              <span class="bwg_slideshow_image_span" id="image_id_<?php echo $i; ?>">
                <span class="bwg_slideshow_image_span1">
                  <span class="bwg_slideshow_image_span2">
            <a href="<?php echo esc_url( $href_array[$i] ); ?>" >
              <img id="bwg_slideshow_image" class="bwg_slideshow_image" src="<?php echo esc_attr( $image_row ); ?>" image_id="<?php echo $i; ?>" />
            </a>
                  </span>
                </span>
              </span>
                              <input type="hidden" id="bwg_current_image_key" value="<?php echo $key; ?>" />
                              <?php
                            }
                            else {
                              ?>
                              <span class="bwg_slideshow_image_second_span" id="image_id_<?php echo $i; ?>">
                <span class="bwg_slideshow_image_span1">
                  <span class="bwg_slideshow_image_span2">
                    <a href="<?php echo esc_url( $href_array[$i] ); ?>" ><img id="bwg_slideshow_image_second" class="bwg_slideshow_image" src="<?php echo esc_attr( $image_row ); ?>" /></a>
                  </span>
                </span>
              </span>
                              <?php
                            }
                            $i++;
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>

                <!--################ TITLE ################## -->
                <div class="bwg_slideshow_image_container" style="position: absolute;">
                  <div class="bwg_slideshow_title_container">
                    <div style="display:table; margin:0 auto;">
            <span class="bwg_slideshow_title_span">
        <div class="bwg_slideshow_title_text <?php echo empty($title_array[0]) ? 'none' : '' ?>">
          <?php echo str_replace(array("\n","\r"), '', $title_array[0]); ?>
         </div>
            </span>
                    </div>
                  </div>
                </div>
                <!--################ DESCRIPTION ################## -->
                <div class="bwg_slideshow_image_container" style="position: absolute;">
                  <div class="bwg_slideshow_title_container">
                    <div style="display:table; margin:0 auto;">
            <span class="bwg_slideshow_description_span">
              <div class="bwg_slideshow_description_text <?php echo empty($textarea_array[0]) ? 'none' : '' ?>">
                <?php echo  str_replace(array("\n","\r"), '', $textarea_array[0]); ?>
        </div>
            </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--SLIDESHOW END-->

        <?php
        $this->slider_script();
      }

    }

    public function slider_script(){

      $animation_speed = $this->get_param('animation_speed');
      $effect = $this->get_param('effect');
      if(empty($effect[0])){
        $effect = array('fade');
      }

      $image_height = $this->get_param('image_height');
      $stop_on_hover = $this->get_param('stop_on_hover');
      $slideshow_interval = $this->get_param('slideshow_interval');
      $hide_slider = $this->get_param('hide_slider');
      $imgs_url = $this->get_param('slider_head');
      $imgs_url = explode('||wd||',$imgs_url);
      if($stop_on_hover===true)
        $stop_on_hover = 1;
      else
        $stop_on_hover = 0;

      ?>

      <script>

        var bwg_trans_in_progress = false;
        var bwg_transition_duration =  <?php echo $animation_speed; ?>;
        var bwg_playInterval;
        var kkk=1;
        /* Stop autoplay.*/
        window.clearInterval(bwg_playInterval);
        /* Set watermark container size.*/
        var bwg_current_key = '';



        function bwg_testBrowser_cssTransitions() {
          return bwg_testDom('Transition');
        }
        function bwg_testBrowser_cssTransforms3d() {
          return bwg_testDom('Perspective');
        }
        function bwg_testDom(prop) {
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
        function bwg_cube(tz, ntx, nty, nrx, nry, wrx, wry, current_image_class, next_image_class, direction) {

          /* If browser does not support 3d transforms/CSS transitions.*/
          if (!bwg_testBrowser_cssTransitions()) {
            return bwg_fallback(current_image_class, next_image_class, direction);
          }
          if (!bwg_testBrowser_cssTransforms3d()) {
            return bwg_fallback3d(current_image_class, next_image_class, direction);
          }
          bwg_trans_in_progress = true;
          /* Set active thumbnail.*/
          jQuery(".bwg_slide_bg").css('perspective', 1000);
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
          jQuery(".bwg_slider").css({
            transform: 'translateZ(-' + tz + 'px)',
            transformStyle: 'preserve-3d'
          });
          /* Execution steps.*/
          setTimeout(function () {
            jQuery(".bwg_slider").css({
              transition: 'all ' + bwg_transition_duration + 'ms ease-in-out',
              transform: 'translateZ(-' + tz + 'px) rotateX('+ wrx +'deg) rotateY('+ wry +'deg)'
            });
          }, 20);
          /* After transition.*/
          jQuery(".bwg_slider").one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(bwg_after_trans));
          function bwg_after_trans() {
            jQuery(current_image_class).removeAttr('style');
            jQuery(next_image_class).removeAttr('style');
            jQuery(".bwg_slider").removeAttr('style');
            jQuery(".bwg_slide_bg").css('perspective', 'none');
            jQuery(current_image_class).css({'opacity' : 0, filter: 'Alpha(opacity=0)', 'z-index': 1});
            jQuery(next_image_class).css({'opacity' : 1, filter: 'Alpha(opacity=100)', 'z-index' : 2});
            bwg_trans_in_progress = false;
            if (typeof event_stack !== 'undefined' && event_stack.length > 0) {
              key = event_stack[0].split("-");
              event_stack.shift();
              bwg_change_image(key[0], key[1], data, true);
            }
          }
        }
        function bwg_cubeH(current_image_class, next_image_class, direction) {
          /* Set to half of image width.*/
          var dimension = jQuery(current_image_class).width() / 2;
          if (direction == 'right') {
            bwg_cube(dimension, dimension, 0, 0, 90, 0, -90, current_image_class, next_image_class, direction);
          }
          else if (direction == 'left') {
            bwg_cube(dimension, -dimension, 0, 0, -90, 0, 90, current_image_class, next_image_class, direction);
          }
        }
        function bwg_cubeV(current_image_class, next_image_class, direction) {

          /* Set to half of image height.*/
          var dimension = jQuery(current_image_class).height() / 2;
          /* If next slide.*/
          if (direction == 'right') {
            bwg_cube(dimension, 0, -dimension, 90, 0, -90, 0, current_image_class, next_image_class, direction);
          }
          else if (direction == 'left') {
            bwg_cube(dimension, 0, dimension, -90, 0, 90, 0, current_image_class, next_image_class, direction);
          }
        }
        /* For browsers that does not support transitions.*/
        function bwg_fallback(current_image_class, next_image_class, direction) {
          bwg_fade(current_image_class, next_image_class, direction);
        }
        /* For browsers that support transitions, but not 3d transforms (only used if primary transition makes use of 3d-transforms).*/
        function bwg_fallback3d(current_image_class, next_image_class, direction) {
          bwg_sliceV(current_image_class, next_image_class, direction);
        }
        function bwg_none(current_image_class, next_image_class, direction) {
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
          /* Set active thumbnail.*/
        }
        function bwg_fade(current_image_class, next_image_class, direction) {
          /* Set active thumbnail.*/
          if (bwg_testBrowser_cssTransitions()) {
            jQuery(next_image_class).css('transition', 'opacity ' + bwg_transition_duration + 'ms linear');
            jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
            jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
          }
          else {
            jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, bwg_transition_duration);
            jQuery(next_image_class).animate({
              'opacity' : 1,
              'z-index': 2
            }, {
              duration: bwg_transition_duration,
              complete: function () {  }
            });
            /* For IE.*/
            jQuery(current_image_class).fadeTo(bwg_transition_duration, 0);
            jQuery(next_image_class).fadeTo(bwg_transition_duration, 1);
          }
        }
        function bwg_grid(cols, rows, ro, tx, ty, sc, op, current_image_class, next_image_class, direction) {
          /* If browser does not support CSS transitions.*/
          if (!bwg_testBrowser_cssTransitions()) {
            return bwg_fallback(current_image_class, next_image_class, direction);
          }
          bwg_trans_in_progress = true;
          /* Set active thumbnail.*/
          /* The time (in ms) added to/subtracted from the delay total for each new gridlet.*/
          var count = (bwg_transition_duration) / (cols + rows);
          /* Gridlet creator (divisions of the image grid, positioned with background-images to replicate the look of an entire slide image when assembled)*/
          function bwg_gridlet(width, height, top, img_top, left, img_left, src, imgWidth, imgHeight, c, r) {
            var delay = (c + r) * count;
            /* Return a gridlet elem with styles for specific transition.*/
            return jQuery('<div class="bwg_gridlet" />').css({
              width : width,
              height : height,
              top : top,
              left : left,
              backgroundImage : 'url("' + src + '")',
              backgroundColor: jQuery(".bwg_slideshow_image_wrap").css("background-color"),
              /*backgroundColor: rgba(0, 0, 0, 0),*/
              backgroundRepeat: 'no-repeat',
              backgroundPosition : img_left + 'px ' + img_top + 'px',
              backgroundSize : imgWidth + 'px ' + imgHeight + 'px',
              transition : 'all ' + bwg_transition_duration + 'ms ease-in-out ' + delay + 'ms',
              transform : 'none'
            });
          }
          /* Get the current slide's image.*/
          var cur_img = jQuery(current_image_class).find('img');
          /* Create a grid to hold the gridlets.*/
          var grid = jQuery('<div />').addClass('bwg_grid');
          /* Prepend the grid to the next slide (i.e. so it's above the slide image).*/
          jQuery(current_image_class).prepend(grid);
          /* vars to calculate positioning/size of gridlets*/
          var cont = jQuery(".bwg_slide_bg");
          var imgWidth = cur_img.width();
          var imgHeight = cur_img.height();
          var contWidth = cont.width(),
            contHeight = cont.height(),
            imgSrc = cur_img.attr('src'),/*.replace('/thumb', ''),*/
            colWidth = Math.floor(contWidth / cols),
            rowHeight = Math.floor(contHeight / rows),
            colRemainder = contWidth - (cols * colWidth),
            colAdd = Math.ceil(colRemainder / cols),
            rowRemainder = contHeight - (rows * rowHeight),
            rowAdd = Math.ceil(rowRemainder / rows),
            leftDist = 0,
            img_leftDist = (jQuery(".bwg_slide_bg").width() - cur_img.width()) / 2;
          /* tx/ty args can be passed as 'auto'/'min-auto' (meaning use slide width/height or negative slide width/height).*/
          tx = tx === 'auto' ? contWidth : tx;
          tx = tx === 'min-auto' ? - contWidth : tx;
          ty = ty === 'auto' ? contHeight : ty;
          ty = ty === 'min-auto' ? - contHeight : ty;
          /* Loop through cols*/
          for (var i = 0; i < cols; i++) {
            var topDist = 0,
              img_topDst = (jQuery(".bwg_slide_bg").height() - cur_img.height()) / 2,
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
              grid.append(bwg_gridlet(newColWidth, newRowHeight, topDist, img_topDst, leftDist, img_leftDist, imgSrc, imgWidth, imgHeight, i, j));
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
          }, 100);
          jQuery(next_image_class).css('opacity', 1);
          /* After transition.*/
          jQuery(last_gridlet).one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(bwg_after_trans));


          function bwg_after_trans() {
            jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
            jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
            cur_img.css('opacity', 1);
            grid.remove();
            bwg_trans_in_progress = false;
            if (typeof event_stack !== 'undefined' && event_stack.length > 0) {
              key = event_stack[0].split("-");
              event_stack.shift();
              bwg_change_image(key[0], key[1], data, true);
            }
          }
        }
        function bwg_sliceH(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var translateX = 'min-auto';
          }
          else if (direction == 'left') {
            var translateX = 'auto';
          }
          bwg_grid(1, 8, 0, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
        }
        function bwg_sliceV(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var translateY = 'min-auto';
          }
          else if (direction == 'left') {
            var translateY = 'auto';
          }
          bwg_grid(10, 1, 0, 0, translateY, 1, 0, current_image_class, next_image_class, direction);
        }
        function bwg_slideV(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var translateY = 'auto';
          }
          else if (direction == 'left') {
            var translateY = 'min-auto';
          }
          bwg_grid(1, 1, 0, 0, translateY, 1, 1, current_image_class, next_image_class, direction);
        }
        function bwg_slideH(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var translateX = 'min-auto';
          }
          else if (direction == 'left') {
            var translateX = 'auto';
          }
          bwg_grid(1, 1, 0, translateX, 0, 1, 1, current_image_class, next_image_class, direction);
        }
        function bwg_scaleOut(current_image_class, next_image_class, direction) {
          bwg_grid(1, 1, 0, 0, 0, 1.5, 0, current_image_class, next_image_class, direction);
        }
        function bwg_scaleIn(current_image_class, next_image_class, direction) {
          bwg_grid(1, 1, 0, 0, 0, 0.5, 0, current_image_class, next_image_class, direction);
        }
        function bwg_blockScale(current_image_class, next_image_class, direction) {
          bwg_grid(8, 6, 0, 0, 0, .6, 0, current_image_class, next_image_class, direction);
        }
        function bwg_kaleidoscope(current_image_class, next_image_class, direction) {
          bwg_grid(10, 8, 0, 0, 0, 1, 0, current_image_class, next_image_class, direction);
        }
        function bwg_fan(current_image_class, next_image_class, direction) {
          if (direction == 'right') {
            var rotate = 45;
            var translateX = 100;
          }
          else if (direction == 'left') {
            var rotate = -45;
            var translateX = -100;
          }
          bwg_grid(1, 10, rotate, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
        }
        function bwg_blindV(current_image_class, next_image_class, direction) {
          bwg_grid(1, 8, 0, 0, 0, .7, 0, current_image_class, next_image_class);
        }
        function bwg_blindH(current_image_class, next_image_class, direction) {
          bwg_grid(10, 1, 0, 0, 0, .7, 0, current_image_class, next_image_class);
        }
        function bwg_random(current_image_class, next_image_class, direction) {
          var anims = ['sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope', 'fan', 'blindH', 'blindV'];
          /* Pick a random transition from the anims array.*/
          this["bwg_" + anims[Math.floor(Math.random() * anims.length)] + ""](current_image_class, next_image_class, direction);
        }
        function iterator() {
          var iterator = 1;
          if (0) {
            iterator = Math.floor((data.length - 1) * Math.random() + 1);
          }
          return iterator;
        }
        function bwg_change_image(current_key, key, data, from_effect) {
          if (data[key]) {
            if (jQuery('.bwg_ctrl_btn').hasClass('fa-pause')) {
              play();
            }
            if (!from_effect) {
              jQuery("#bwg_current_image_key").val(key);
            }


            if (bwg_trans_in_progress) {
              event_stack.push(current_key + '-' + key);
              return;
            }
            var direction = 'right';
            if (bwg_current_key > key) {
              var direction = 'left';
            }
            else if (bwg_current_key == key) {
              return;
            }
            /* Set active thumbnail position.*/
            bwg_current_key = key;
            /* Change image id, title, description.*/

            // Change image id, key, title, description.
            jQuery("#bwg_current_image_key").val(key);
            jQuery("#bwg_slideshow_image").attr('image_id', data[key]["id"]);


            jQuery(".bwg_slideshow_title_text").html(data[key]["alt"]);
            jQuery(".bwg_slideshow_description_text").html(data[key]["description"]);

            jQuery("#bwg_slideshow_image").attr('image_id', data[key]["id"]);
            //jQuery(".bwg_slideshow_title_text").html(jQuery('<div />').html(data[key]["alt"]).text());
            //jQuery(".bwg_slideshow_description_text").html(jQuery('<div />').html(data[key]["description"]));
            var current_image_class = "#image_id_" + data[current_key]["id"];
            var next_image_class = "#image_id_" + data[key]["id"];
            bwg_<?php echo $effect[0]; ?>(current_image_class, next_image_class, direction);
          }
          jQuery('.bwg_slideshow_title_text').removeClass('none');
          if(jQuery('.bwg_slideshow_title_text').html()==""){jQuery('.bwg_slideshow_title_text').addClass('none');}

          jQuery('.bwg_slideshow_description_text').removeClass('none');
          if(jQuery('.bwg_slideshow_description_text').html()==""){jQuery('.bwg_slideshow_description_text').addClass('none');}
        }
        function wdwt_slider_resize() {

          //standart chap vor@ voroshvac chi bnav template um

          firstsize=1024;
          var bodyWidth=jQuery(window).width();
          var parentWidth=jQuery(".bwg_slideshow_image_wrap").parent().width();
          //tryuk vor hankarc responsive.js @  ushana body i chap@ verci vochte verevi div i
          if(parentWidth>bodyWidth){parentWidth=bodyWidth;}
          var kaificent=<?php echo $image_height; ?>;
          var str=( kaificent/firstsize  );

          jQuery(".bwg_slideshow_image_wrap").css({height: ((parentWidth) * str)});
          jQuery("#slideshow").css({height: ((parentWidth) * str)});

          jQuery(".bwg_slideshow_image_wrap > div").css({height: ((parentWidth) * str)});
          jQuery(".bwg_slideshow_title_container > div").css({height: ((parentWidth) * str)});
          jQuery(".bwg_slideshow_image").css({height: ((parentWidth) * str)});


          jQuery(".bwg_slideshow_image_container").css({width: (parentWidth)});
          jQuery(".bwg_slideshow_image_container").css({height: ((parentWidth) * str)});
          jQuery(".bwg_slideshow_image").css({
            maxWidth: parentWidth,
            maxHeight: ((parentWidth) * str)
          });

        }
        jQuery(window).resize(function() {
          wdwt_slider_resize();
        });
        jQuery(window).load(function () {

          if (typeof jQuery().swiperight !== 'undefined' && jQuery.isFunction(jQuery().swiperight)) {
            jQuery('#bwg_container1').swiperight(function () {
              bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) >= 0 ? (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) % data.length : data.length - 1, data);
              return false;
            });
          }
          if (typeof jQuery().swipeleft !== 'undefined' && jQuery.isFunction(jQuery().swipeleft)) {
            jQuery('#bwg_container1').swipeleft(function () {
              bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + iterator()) % data.length, data);
              return false;
            });
          }

          var isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
          var bwg_click = isMobile ? 'touchend' : 'click';
          wdwt_slider_resize();
          jQuery("#bwg_container1").css({visibility: 'visible'});

          /* Set image container height.*/

          var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel"; /* FF doesn't recognize mousewheel as of FF3.x */

          /* Play/pause.*/
          if (1) {
            play();
          }
        });
        function play() {
          window.clearInterval(bwg_playInterval);
          /* Play.*/
          bwg_playInterval = setInterval(function () {
            var iterator = 1;
            if (0) {
              iterator = Math.floor((data.length - 1) * Math.random() + 1);
            }
            bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + 1) % data.length, data)
          }, ''+<?php echo $slideshow_interval; ?>+'');
        }
        jQuery(window).focus(function() {
          /* event_stack = [];*/
          if (!jQuery(".bwg_ctrl_btn").hasClass("fa-play")) {
            play();
          }
          var iiii = 0;
          jQuery(".bwg_slider").children("span").each(function () {
            if (jQuery(this).css('opacity') == 1) {
              jQuery("#bwg_current_image_key").val(iiii);
            }
          });
        });
        jQuery(window).blur(function() {
          event_stack = [];
          window.clearInterval(bwg_playInterval);
        });
        var pausehover=<?php echo $stop_on_hover; ?>;
        if(pausehover==1){
          jQuery( document ).ready(function() {
            jQuery("#bwg_slideshow_image_container, .bwg_slideshow_image_container").hover(function(){
                event_stack = [];
                clearInterval(bwg_playInterval);
              },
              function(){play();});
          });
        }


      </script>
      <?php
    }


  } /*end of class*/

?>