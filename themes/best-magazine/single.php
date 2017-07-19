<?php 
/* The Template for displaying all single posts */

get_header(); 
global $wdwt_front,$post;

Best_magazine_front_functions::wpb_set_post_views($post->ID);// most populiar

$best_magazine_meta = get_post_meta($post->ID,WDWT_META,TRUE);


?>
</header>
<div class="container">
	<?php  if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<aside id="sidebar1">
			<div class="sidebar-container">
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>	
				<div class="clear"></div>
			</div>
		</aside>
    <?php }?>
	<div id="content">
		<?php $wdwt_front->integration_top(); ?>
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<div class="single-post">
				<?php  
				if($wdwt_front->get_param('show_featured_image', $best_magazine_meta, true)){
				if ( has_post_thumbnail()) { ?>
					  <div class="post-thumbnail-div">
						<div class="img_container unfixed">
							<?php echo Best_magazine_front_functions::auto_thumbnail(false); ?>
						</div> 
					 </div>
				
						  
			</div> 
		<?php } }  ?>
						 <h1 class="page-title"><?php the_title(); ?></h1>
						 <div class="entry">	
							<?php  the_content(); ?>
						</div>
						  <div class="clear"></div>
		
				<?php if($wdwt_front->get_param('date_enable', $best_magazine_meta, false)){ ?>
				<div class="entry-meta">
					  <?php Best_magazine_front_functions::posted_on_single(); ?>
				</div>
				<?php Best_magazine_front_functions::entry_meta_cat(); }?>
				<?php $wdwt_front->integration_bottom(); 
				wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Page', "best-magazine" ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-links-number">', 'link_after' => '</span>' ) ); 
				Best_magazine_front_functions::post_nav(); ?>
				<div class="clear"></div>
				
				<?php $wdwt_front->bottom_advertisment();
				if(comments_open()){  ?>
					<div class="comments-template">
						<?php echo comments_template();	?>
					</div>
				<?php } ?>
		   </div>

	<?php endwhile; ?>

	<?php endif;   ?>
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside id="sidebar2">
			<div class="sidebar-container">
			  <?php  dynamic_sidebar( 'sidebar-2' ); 	?>
			  <div class="clear"></div>
			</div>
		</aside>
    <?php } ?>
    <div class="clear"></div>
	</div>
	
</div>
<?php get_footer(); ?>