<?php 
class best_magazine_categ extends WP_Widget
{
    function __construct(){
    $widget_ops = array('description' =>  __('Displays Categories Posts', "best-magazine" ));
    $control_ops = array('width' => '', 'height' => '');
    
    parent::__construct(false,$name= sprintf(__( '%s Categories Posts', "best-magazine" ), WDWT_TITLE ),$widget_ops,$control_ops);
  }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
    extract($args);
    $title =  esc_html( $instance['title']);
    $categ_id = empty( $instance['categ_id'] ) ? '' : $instance['categ_id'];
    $post_count = empty( $instance['post_count'] ) ? '' : $instance['post_count'];

    echo $before_widget;

    if ( $title )
      echo $before_title . $title . $after_title; ?>
  
    <?php 
      
    $wp_query= null;
    $wp_query = new WP_Query();
    if(!isset($post_count))
      $post_count =0;
    $wp_query->query('posts_per_page='.$post_count.'&cat='.$categ_id);

      while ($wp_query->have_posts()) : $wp_query->the_post();  ?>
    
          <div class="best_magazine_cat_widg_cont">
            <a href="<?php the_permalink(); ?>">
              <h5><?php the_title(); ?></h5>
            </a>
            <div class="best_magazine_cat_widg">
               <a href="<?php the_permalink(); ?>"> 
                <div class="best_magazine_cat_widg-img">
                 <?php echo Best_magazine_front_functions::auto_thumbnail();  ?>
                </div>
              </a>    
              <p>
                <?php  echo Best_magazine_front_functions::the_excerpt_max_charlength(100);  ?>
              </p>  
            </div>
                      <div style="clear:both;"></div>          
        </div>
          
  <?php endwhile; 
     
              
     wp_reset_postdata();
    
    echo $after_widget;
        
    }

  /*Saves the settings. */
    function update($new_instance, $old_instance){
    
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['categ_id'] = wp_filter_post_kses( addslashes($new_instance['categ_id']));
    $instance['post_count'] = wp_filter_post_kses( addslashes($new_instance['post_count']));

    return $instance;
    
    }

  /*Creates the form for the widget in the back-end. */
    function form($instance){
        //Defaults
    $instance = wp_parse_args( (array) $instance, array( 'title'=>__('Categories Posts', "best-magazine"), 'categ_id'=>'0', 'post_count'=>'3' ) );

    $title = esc_attr( $instance['title'] );
    $categ_id = esc_attr( $instance['categ_id'] ); 
        $post_count = esc_attr( $instance['post_count'] )?>
    
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', "best-magazine" ); ?>:</label><input class="widefat" id="<?php echo  $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
    
    
    <p><label for="<?php echo $this->get_field_id('categ_id'); ?>"><?php echo __('Select Category', "best-magazine" ); ?>:</label>
    <select name="<?php echo $this->get_field_name('categ_id'); ?>" id="<?php echo $this->get_field_id('categ_id') ?>" style="font-size:12px" class="inputbox">
          <option value="0"><?php echo __('Select Category', "best-magazine" ); ?></option>
     <?php  $categories=get_categories();
            $category_count=count($categories);
            for($i=0;$i<$category_count;$i++) {
        if(isset($categories[$i])){
       ?>
          <option value="<?php echo $categories[$i]->term_id?>" <?php selected($instance['categ_id'],$categories[$i]->term_id); ?>><?php echo $categories[$i]->name ?></option>
     <?php
        }
      }
       ?>
        </select></p>
    <p><label for="<?php echo $this->get_field_id('post_count'); ?>"><?php echo __('Number of Posts', "best-magazine" ); ?>:</label><input id="<?php echo  $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>" type="text" value="<?php echo $post_count; ?>" size="6"/></p>
<?php   
}

}// end exclusive_categ class
add_action('widgets_init', create_function('', 'return register_widget("best_magazine_categ");'))
?>