<?php get_header();
global $wdwt_front,$wdwt_options;
$wdwt_front =  new best_magazine_front($wdwt_options);
//show_on_front ->latest posts
if( 'posts' == get_option( 'show_on_front' ) )
	Best_magazine_front_functions::top_posts();

?>
</header>
<div class="container">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<aside id="sidebar1" >
			<div class="sidebar-container">
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>
				<div class="clear"></div>
			</div>
		</aside>
	<?php } ?>
	<div id="content">
		<?php
		//show_on_front ->latest posts
		if( 'posts' == get_option( 'show_on_front' ) ){
			Best_magazine_front_functions::category_tab();
			Best_magazine_front_functions::home_video_post();
			Best_magazine_front_functions::content_posts();
		}
		elseif('page' == get_option( 'show_on_front' )){

			Best_magazine_front_functions::content_posts_for_home();
		}
		?>
	</div>
	<?php
	if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside id="sidebar2">
			<div class="sidebar-container">
				<?php  dynamic_sidebar( 'sidebar-2' ); 	?>
				<div class="clear"></div>
			</div>
		</aside>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>

					
					