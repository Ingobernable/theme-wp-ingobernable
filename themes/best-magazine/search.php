<?php 

get_header();
global $wdwt_front;
?>
</header>
<div class="container">
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
    <aside id="sidebar1">
      <div class="sidebar-container">
        <?php  dynamic_sidebar( 'sidebar-1' );  ?>  
        <div class="clear"></div>
      </div>
    </aside>
  <?php }  ?>
    <div id="content" class="blog search-page">
        <div class="single-post">
            <h1 class="page-title">
                <?php echo __('Search',"best-magazine"); ?>
            </h1>
        </div>
    <?php get_search_form(); ?>
        
        <?php  if( have_posts() ) {  while( have_posts()){  the_post(); ?>
                 <div class="search-result">
                    <h2>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
        
                    <div class="entry">
                        <?php the_content(); ?>
                    </div>
          <div class="clear"></div>
                </div>
        <?php } ?>
        <div class="page-navigation">
          <div class="alignleft"><?php previous_posts_link( '<i class="fa fa-chevron-left"></i> ' . __('Previous Entries', "best-magazine") ); ?>
          </div>
          <div class="alignright"><?php next_posts_link( __('Next Entries', "best-magazine") .' <i class="fa fa-chevron-right"></i>', '' ); ?>
          </div>
          <div class="clear"></div>
        </div>
        <?php }else {?>
        <div class="search-no-result">
         <?php echo __("Nothing was found. Please try another keyword.", "best-magazine");  ?>
        </div>
    <?php }
    $wdwt_front->bottom_advertisment();  ?>
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
