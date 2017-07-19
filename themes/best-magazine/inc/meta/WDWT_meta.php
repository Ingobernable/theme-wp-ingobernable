<?php 

class WDWT_meta{
  protected $meta_sections = array();
  
  public function init(){
    $screen = get_current_screen();
    if($screen->post_type == 'post' || $screen->post_type == 'page'){
      add_meta_box(WDWT_META, WDWT_TITLE , array($this, 'view'), $screen->post_type, 'normal', 'high');  
    }
  }
  public function view(){

    ?>
    <div class="wdwt_meta" id="wdwt_meta_content">
      <?php
        wp_nonce_field( "WDWT_META", "WDWT_META_nonce");
    
        global $post;
        $meta = get_post_meta($post->ID, WDWT_META , true);

        foreach ($this->meta_sections as $section) {
          $section->view($meta);

        }
      ?>
    </div>

  <?php
  }
  public function save($post_id){

    if(!isset($_POST["WDWT_META_nonce"]) || !wp_verify_nonce( $_POST["WDWT_META_nonce"],  "WDWT_META" )){
      return $post_id;
    }

    $new_meta = array();
    foreach ($this->meta_sections as $section) {
      $section_meta =  $section->save($post_id);
      $new_meta = array_merge($new_meta, $section_meta);
    }


    // check user permissions
    if (isset($_POST['post_type']) && $_POST['post_type'] == 'page') {
        if (!current_user_can('edit_page', $post_id)) return $post_id;
    } else {
        if (!current_user_can('edit_post', $post_id)) return $post_id;
    }


    if (gettype ($post_id) == 'integer') {
      if(! update_post_meta($post_id, WDWT_META, $new_meta)){
        add_post_meta($post_id, WDWT_META, $new_meta, true);
      }
    }
    return $post_id;
  }


}