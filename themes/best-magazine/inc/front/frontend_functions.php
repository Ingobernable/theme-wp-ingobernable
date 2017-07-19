<?php


require_once( 'WDWT_front_functions.php');

class Best_magazine_front_functions extends WDWT_front_functions{

  

  public static function top_posts(){
    global $post;
    global $wdwt_front;
    $show_top_posts = $wdwt_front->get_param('hide_top_posts');
    if (!$show_top_posts) {
    return;
    }
    $top_post_categories = implode(',',$wdwt_front->get_param('top_post_categories', array(), array('')));
    $top_post_cat_name = $wdwt_front->get_param('top_post_cat_name');

    $order = $wdwt_front->get_param('top_post_order', array(), array('date'));

    $order = $order[0];
    $orderby = $wdwt_front->get_param('top_post_orderby', array(), array('desc'));
    $orderby = $orderby[0];

    $grab_image = $wdwt_front->grab_image();
    $lbox_width = $wdwt_front->get_param('lbox_image_width');
    $lbox_height = $wdwt_front->get_param('lbox_image_height');
    $lbox_enable = $wdwt_front->get_param('lbox_enable', array(), '1');
    if($lbox_enable == '1'){
      $lbox_enable = true;
    }
    else{
      $lbox_enable = false;
    }

    $args = array(
    "posts_per_page" =>4,
    "ignore_sticky_posts"=>1,
    "cat"=>$top_post_categories,
    "orderby"=>$orderby,
    "order"=> $order,
    );
  ?>
      <div id="top-posts">
      <?php
          $wp_query = new WP_Query($args);
          $curent_query_posts=$wp_query->get_posts();
          if(!isset($curent_query_posts[0]))
            $curent_query_posts[0]='';
          $expert_News_post_date=get_the_time( 'Y.m.d, l',$curent_query_posts[0]);
          unset($curent_query_posts);
           ?>
        <div class="container">
          <h2><?php echo esc_html($top_post_cat_name); ?></h2>
          <span class="date"><?php echo $expert_News_post_date ?></span>
          <div id="top-posts-scroll">
            <span class="top-posts-left"><span>&laquo;<?php echo __('Left',"best-magazine"); ?></span></span>
            <span class="top-posts-right"><span><?php echo __('Right',"best-magazine"); ?>&raquo;</span></span>

            <div class="top-posts-wrapper">
              <div class="top-posts-block">
                <ul id="top-posts-list">

                  <?php
                    $id = 0;
                  if($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {

                      $wp_query->the_post();

                      $tumb_id=get_post_thumbnail_id( $post->ID );
                      $thumb_url=wp_get_attachment_image_src($tumb_id,'full');

                      $has_thumb = true;
                      if( $thumb_url ){
                        $thumb_url = $thumb_url[0];
                      }
                      else{
                        $thumb_url = self::catch_that_image();
                        if(isset($thumb_url['image_catched']) && $thumb_url['image_catched'] ){
                        $has_thumb = true;
                        }
                        else{
                        $has_thumb = false;
                        }
                        $thumb_url = $thumb_url['src'];
                      }

                    ?>
                  <li class="top_effect">

                      <?php
                      if(!has_post_thumbnail() && !$grab_image)
                        $thumb_div_class = "no-image";
                      else
                        $thumb_div_class = "";
                      ?>
                      <div class="image-block <?php echo $thumb_div_class; ?>">

                        <?php
                          if($grab_image)
                           {
                          echo self::display_thumbnail(340,200);
                           }
                           else
                           {
                          echo self::thumbnail(340,200);
                           }
                        if($has_thumb && $lbox_enable):
                           ?>
                        <div class="mask">
                          <a  class=" " href="<?php echo $thumb_url; ?>" onclick="wdwt_lbox.init(this, 'wdwt-lightbox', <?php echo intval($lbox_width);?> , <?php echo intval($lbox_height);?>); return false;" rel="wdwt-lightbox" id="image-block-<?php echo $id; ?>" >
                          <img class="zoom-icon" src="<?php echo get_template_directory_uri(); ?>/images/zoom-icon.png" >
                          </a>
                        </div>
                      <?php endif; ?>
                      </div>
                      <h4><a href="<?php the_permalink(); ?>"  rel="image-block-<?php echo $id; ?>-title"><?php the_title(); ?></a></h4>
                    <div class="text">
                      <p rel="image-block-<?php echo $id; ?>-desc"><?php self::the_excerpt_max_charlength(120); ?></p>

                    </div>

                  </li>
                  <?php $id++;} }
                  $id=0;    ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
  <?php
  }

  public static function category_tab(){

  global $post;
  global $wdwt_front;
  $hide_category_tabs_posts = $wdwt_front->get_param('hide_category_tabs_posts');
  $home_page_tabs_exclusive = $wdwt_front->get_param('home_page_tabs_exclusive');
  $grab_image = $wdwt_front->grab_image();

  $args = array(
    'orderby' => 'name',
    'order' => 'ASC'
    );
  $categories = get_categories($args);

   if ($hide_category_tabs_posts){

    $count_of_posts=4; // count posts in category tabs this is static variable
    $user_selected_categories=$home_page_tabs_exclusive;// get user selected categoryes for category tabs
    $top_tabs_categorys = array(); // array for geting category requerid information by id
    $real_category_exsist=0; // if selected category not removed
    if( $home_page_tabs_exclusive == "" ){ // if category not selected
      $user_selected_categories=array();
      for($i=1; $i<count($categories); $i++){
        $user_selected_category = $categories[$i]->name;
        $user_selected_category_desc = $categories[$i]->description;
        $top_tabs_categorys[$i]['category_name']=$user_selected_category;
        $top_tabs_categorys[$i]['category_description']=$user_selected_category_desc;
        $top_tabs_categorys[$i]['query']='posts_per_page='.($count_of_posts).'&cat='.$categories[$i]->term_id.'&order=DESC';
        if($i==4)
          break;
      }

    }
    foreach($user_selected_categories as $key=>$user_selected_categorie){
      if(is_numeric($user_selected_categorie)){

        if(isset(get_category($user_selected_categorie)->name)){
          $user_selected_category = get_category($user_selected_categorie)->name;
          $user_selected_category_desc =get_category($user_selected_categorie)->description;
        }
        else{
          $user_selected_category = "";
          $user_selected_category_desc = "";
        }
        $top_tabs_categorys[$key]['category_name']=$user_selected_category;
        $top_tabs_categorys[$key]['category_description']=$user_selected_category_desc;
        $top_tabs_categorys[$key]['query']='posts_per_page='.($count_of_posts).'&cat='.$user_selected_categorie.'&order=DESC';
      }
      else
      {
        switch($user_selected_categorie){
          case 'random':{

            $top_tabs_categorys[$key]['category_name']=__('Random Posts',"best-magazine");
            $top_tabs_categorys[$key]['query']='orderby=rand&ignore_sticky_posts=1&posts_per_page='.$count_of_posts;

            break;
          }
          case 'popular':{

            $top_tabs_categorys[$key]['category_name']=__('Popular Posts',"best-magazine");
            $top_tabs_categorys[$key]['query']='meta_key=wpb_post_views_count&orderby=>meta_value&posts_per_page='.$count_of_posts;

            break;
          }
          case 'recent':{

            $top_tabs_categorys[$key]['category_name']=__('Recent Posts',"best-magazine");
            if(isset($data))
            $top_tabs_categorys[$key]['query']='meta_key=wpb_post_views_count&orderby=>meta_value&numberposts='.$data["postsCount"];
            $args = array(
                  'numberposts' => $count_of_posts,
                  'offset' => 0,
                  'category' => 0,
                  'orderby' => 'post_date',
                  'order' => 'DESC',
                  'post_type' => 'post',
                  'post_status' => 'draft, publish, future, pending, private',
                  'suppress_filters' => true
                );

              $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
              $recentList=array();
              foreach( $recent_posts as $recent ){
                $img_html='';
                $img=wp_get_attachment_image_src( get_post_thumbnail_id($recent["ID"]));
                if($img){
                  $img_html="<div class=\"thumbnail-block\"> \r\n \t\t\t\t\t\t\t\t <a class=\"image-block\" href=\"".get_permalink($recent["ID"]) ."\">\r\n \t\t\t\t\t\t\t\t\t<img src=\"".esc_attr( $img[0])."\" alt=\"".esc_attr( $recent["post_title"])."\" />\r\n \t\t\t\t\t\t\t\t</a>\r\n \t\t\t\t\t\t\t</div>";
                }

                $recentList[]= "\t\t\t\t\t\t<li>\r\n \t\t\t\t\t\t\t".$img_html."\r\n \t\t\t\t\t\t\t<div class=\"text\">\r\n \t\t\t\t\t\t\t\t<a href=\"".get_permalink($recent["ID"]) ."\">\r\n \t\t\t\t\t\t\t\t\t<h3>".esc_html($recent["post_title"])."</h3>\r\n \t\t\t\t\t\t\t\t</a>\r\n \t\t\t\t\t\t\t\t<p>".substr( strip_tags( $recent["post_content"] ),0,50)."...</p>\r\n \t\t\t\t\t\t\t\t<span class=\"date\">".esc_html($recent["post_date"])."</span>\r\n \t\t\t\t\t\t\t</div>\r\n \t\t\t\t\t\t</li>";
              }
            $top_tabs_categorys[$key]['recent']=$recentList;
            break;
          }
        }
      }

    }

   foreach($top_tabs_categorys as $key=>$top_tabs_category){
    if(!$top_tabs_category['category_name'])
      $real_category_exsist++;
   }
   if(count($top_tabs_categorys)!=$real_category_exsist){


   ?>
  <div id="wd-categories-tabs" class="content-inner-block blog">
    <div class="tabs-block">
      <span class="categories-tabs-left"><span>&laquo;<?php echo __('Left',"best-magazine"); ?></span></span>
      <span class="categories-tabs-right"><span><?php echo __('Right',"best-magazine"); ?>&raquo;</span></span>
    </div>
    <ul class="tabs">
    <?php

       foreach($top_tabs_categorys as $key=>$top_tabs_category){
      if($top_tabs_category['category_name']){
        ?>
      <li <?php if($key==0) echo 'class="active"'; ?>>
        <h2><a href="#<?php echo $key; ?>"><?php if(isset($top_tabs_category['category_name'])) echo esc_html($top_tabs_category['category_name']); ?> <br>
          <span><?php if(isset($top_tabs_category['category_description'])) echo esc_html($top_tabs_category['category_description']); ?></span>
        </a></h2>
      </li>
        <?php }} ?>
    </ul>

      <div class="cont_vat_tab">
    <ul class="content">
    <?php


    foreach($top_tabs_categorys as $key=>$top_tabs_category){

    if($top_tabs_category['category_name']){
     ?>
      <li <?php if($key==0) echo 'class="active"'; ?> id="categories-tabs-content-<?php echo $key; ?>">
        <ul>
          <?php

          if(isset($top_tabs_category['recent'])){
          foreach($top_tabs_category['recent'] as $res)
            echo $res;
          }
          else
          {
            $post = query_posts($top_tabs_category['query']);

             if ( have_posts() ) : while ( have_posts() ) : the_post();
                $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                if(!has_post_thumbnail() && !$grab_image)
                    $thumb_div_class = "no-image";
                else
                  $thumb_div_class = ""; ?>
                <li>
                <div class="thumbnail-block <?php echo $thumb_div_class; ?>">
                    <a class="image-block" href="<?php echo get_permalink(); ?>"><?php
                      if($grab_image)
                       {
                      echo self::display_thumbnail(150,150);
                       }
                       else
                       {
                      echo self::thumbnail(150,150);
                       } ?>
                </a>
                  </div>
                <div class="text">
                    <a href="<?php echo get_permalink()?>">
                      <h4><?php echo get_the_title()?></h4>
                    </a>
                    <p><?php echo substr( strip_tags( get_the_excerpt() ),0,50)?>...</p>
                    <span class="date"><?php echo get_the_time( 'Y.m.d, l' )?> </span>
                  </div>
                </li><?php
             endwhile;endif;
            wp_reset_query();
            }
           ?>
        </ul>
      </li>
      <?php }} ?>
      </ul>
          </div>
    </div>
      <div class="clear"></div>
    <?php }
   }
  }

  public static function home_video_post(){

  global $wdwt_front;

  $hide_video_post = $wdwt_front->get_param('hide_video_post');
  $video_post_name = $wdwt_front->get_param('video_post_name');


  $home_video_post_id = $wdwt_front->get_param('home_video_post');

  
  $home_video_post_id = isset($home_video_post_id[0]) ? $home_video_post_id[0] : '';


  $home_video_post_id_translated = apply_filters( 'wpml_object_id', $home_video_post_id, 'post' );
  if(!is_null($home_video_post_id_translated)){
    $home_video_post = get_post($home_video_post_id_translated);
  }
  else{
    $home_video_post = null;
  }




  if ($hide_video_post && !empty($home_video_post)){ ?>
  <div id="videos-block" class="content-inner-block">
    <h2><?php echo $video_post_name; ?></h2>
    <span class="date"><?php echo get_the_time( 'Y.m.d, l',$home_video_post ); ?></span>
    <div class="full-width">
      <?php echo get_the_post_thumbnail( $home_video_post->ID,array(260,220)); ?>
            <h2><?php echo $home_video_post->post_title; ?></h2>
      <?php echo apply_filters('the_content',$home_video_post->post_content); ?>
      <div class="clear"></div>
    </div>
    <?php  ?>
  </div>
  <?php }

  }

  public static function content_posts() {

    global $wp_query,$wdwt_front;

    $hide_content_posts = $wdwt_front->get_param('hide_content_posts');





    if(!$hide_content_posts ){
    return ;
    }



    $hide_video_post = $wdwt_front->get_param('hide_video_post');

    $grab_image= $wdwt_front->grab_image();
    $show_thumbnail = $wdwt_front->get_param('show_thumbnails');

    $content_post_categories = $wdwt_front->get_param('content_post_categories', array(), array(''));
    $content_post_cat_name = $wdwt_front->get_param('content_post_cat_name');
    $blog_style = $wdwt_front->blog_style();
    $content_post_categories = implode(',',$content_post_categories);
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $order_content = $wdwt_front->get_param('content_post_order', array(), array('date'));
    $order_content = $order_content[0];
    $orderby_content = $wdwt_front->get_param('content_post_orderby', array(), array('desc'));
    $orderby_content = $orderby_content[0];

    $cat_checked=0;
    $n_of_home_post=get_option( 'posts_per_page', 2);
    if($n_of_home_post ==0){
    $n_of_home_post = 1;
    }

      $args_content = array(
      "posts_per_page" => $n_of_home_post,
      "ignore_sticky_posts" => 1,
      "paged" => $paged,
      "cat" => $content_post_categories,
      "orderby"=>$orderby_content,
      "order"=> $order_content,
      );


      ?>







        <div id="blog" class="content-inner-block">


          <div class="blog-post">
            <h2><?php echo esc_html( $content_post_cat_name ); ?></h2>
            <div class="content_post_masonry">
                <?php

            $wp_query = new WP_Query($args_content);

          ?>
          <?php
             if(have_posts()) {
                  while ($wp_query->have_posts()) {
                    $wp_query->the_post();
            ?>
              <div class="masonry_item">
              <?php if($show_thumbnail): ?>
                <?php if(has_post_thumbnail() || (self::post_image_url() && $blog_style && $grab_image)){
                  ?>
                    <div class="img_container unfixed">
                      <?php echo self::auto_thumbnail($grab_image); ?>
                    </div>
                    <div class="clear"></div>
                  <?php
                 } ?>
              <?php endif; ?>
                <h4><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h4>
                <p> <?php if($blog_style)
              {
                 self::the_excerpt_max_charlength(250);
              }
              else
              {
                 the_content();
              }  ?></p>
              </div>
              <?php } }?>
            </div>
          </div>
          <div class="page-navigation">
            <div class="alignleft"><?php previous_posts_link( '<i class="fa fa-chevron-left"></i> '.__('Previous Entries', "best-magazine") ); ?>
            </div>
            <div class="alignright"><?php next_posts_link( __('Next Entries', "best-magazine").' <i class="fa fa-chevron-right"></i>', '' ); ?>
            </div>

          </div>
         <div class="clear"></div>
          
        </div>


        <?php
        wp_reset_query(); ?>

      <?php

  }

  public static function content_posts_for_home() {
  global $wp_query,$paged,$wdwt_front;

  $hide_content_posts = $wdwt_front->get_param('hide_content_posts');
  $hide_video_post = $wdwt_front->get_param('hide_video_post');
  $date_enable = $wdwt_front->get_param('date_enable');
  $blog_style = $wdwt_front->blog_style();
  $grab_image = $wdwt_front->grab_image();
  if(is_home()){


     if(have_posts()) {
        while (have_posts()) {
          the_post();

          ?>
      <div class="blog-post home-post">
        <a class="title_href" href="<?php echo get_permalink() ?>">
           <h2><?php the_title(); ?></h2>
        </a><?php  if($date_enable){ ?>
           <div class="home-post-date">
            <?php echo self::posted_on();?>
           </div>
          <?php }
           if($grab_image)
           {
          echo self::display_thumbnail(150,150);
           }
           else
           {
          echo self::thumbnail(150,150);
           }
          if($blog_style)
          {
             the_excerpt();
          }
          else
          {
             the_content(__('More',"best-magazine"));
          }
           ?><div class="clear"></div>

      </div>
      <?php
      }
      if( $wp_query->max_num_pages > 2 ){ ?>
        <div class="page-navigation">
          <div class="alignleft"><?php previous_posts_link( '<i class="fa fa-chevron-left"></i> '.__('Previous Entries', "best-magazine") ); ?>
          </div>
          <div class="alignright"><?php next_posts_link( __('Next Entries', "best-magazine") . ' <i class="fa fa-chevron-right"></i>', '' ); ?>
          </div>
          <div class="clear"></div>
        </div>
      <?php }

      } ?>
      <div class="clear"></div><?php
       
      wp_reset_query(); ?>
    </div>
    <?php }  else { ?>
     <div id="content">
       <?php
      if(have_posts()) : while(have_posts()) : the_post(); ?>
        <div class="single-post">
         <h2><?php the_title(); ?></h2>
         <div class="entry"><?php the_content(); ?></div>
        </div>
      <?php endwhile; ?>
         <div class="navigation">
          <div class="alignleft"><?php previous_posts_link( '<i class="fa fa-chevron-left"></i> '.__('Previous Entries', "best-magazine") ); ?>
          </div>
          <div class="alignright"><?php next_posts_link( __('Next Entries', "best-magazine") .' <i class="fa fa-chevron-right"></i>', '' ); ?>
          </div>
          <div class="clear"></div>
         </div>

      <?php endif; ?>
       <div class="clear"></div>
       <?php  wp_reset_query();
          if(comments_open())
          {  ?>
            <div class="comments-template">
              <?php echo comments_template(); ?>
            </div>

        <?php }



    }

  }
  




}



