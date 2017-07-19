<?php 
get_header();
global $wdwt_front; 
$best_magazine_meta = get_post_meta($post->ID,WDWT_META,TRUE);
?>
</header>
<div class="container">
   <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
        <aside id="sidebar1" >
            <div class="sidebar-container">     
        <?php  dynamic_sidebar( 'sidebar-1' );  ?>
        <div class="clear"></div>
            </div>
        </aside>
  <?php }  ?> 
    <div id="content">
        <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
        <div class="single-post">
         <h1 class="page-title"><?php the_title(); ?></h1>
      <?php   if($wdwt_front->get_param('show_featured_image', $best_magazine_meta, false)){
            if ( has_post_thumbnail()) { ?>
              <div class="post-thumbnail-div">
                <div class="img_container unfixed">
                  <?php echo Best_magazine_front_functions::auto_thumbnail(false); ?>
                </div> 
              </div>
              
      <?php } }  ?>
         <div class="entry"><?php the_content(); ?></div>
         <div class="clear"></div>
        </div>
      <?php endwhile; ?>
       <div class="navigation">
        <div class="alignleft"><?php previous_posts_link( '<i class="fa fa-chevron-left"></i> ' . __('Previous Entries', "best-magazine") ); ?>
        </div>
        <div class="alignright"><?php next_posts_link( __('Next Entries', "best-magazine") . ' <i class="fa fa-chevron-right"></i>', '' ); ?>
        </div>
        <div class="clear"></div>
       </div>
        <?php endif; ?>
    
    <?php $wdwt_front->bottom_advertisment();
    if(comments_open()){  ?>
        <div class="comments-template">
          <?php echo comments_template(); ?>
        </div>
    
    <?php } ?>  
    </div>
  <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
    <aside id="sidebar2">
      <div class="sidebar-container">
        <?php  dynamic_sidebar( 'sidebar-2' );  ?>
        <div class="clear"></div>
      </div>
    </aside>
  <?php } ?>
  <div class="clear"></div>
</div>
<?php get_footer(); ?>