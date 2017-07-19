<?php
get_header();
global $wdwt_front;
$date_enable = $wdwt_front->get_param('date_enable');
$blog_style = $wdwt_front->blog_style();
$grab_image = $wdwt_front->grab_image();
?>
	</header>
	<div class="container">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<aside id="sidebar1">
				<div class="sidebar-container">
					<?php dynamic_sidebar( 'sidebar-1' );	?>
					<div class="clear"></div>
				</div>
			</aside>
		<?php } ?>
		<div id="content" class="blog" ><?php

			if(have_posts()) {
				while (have_posts()) {
					the_post(); ?>
					<div class="blog-post home-post">
						<a class="title_href" href="<?php echo get_permalink() ?>">
							<h1 class="page-title"><?php the_title(); ?></h1>
						</a><?php  if($date_enable){ ?>
							<div class="home-post-date">
								<?php echo Best_magazine_front_functions::posted_on();?>
							</div>
						<?php }
						if($grab_image)
						{
							echo Best_magazine_front_functions::display_thumbnail(150,150);
						}
						else
						{
							echo Best_magazine_front_functions::thumbnail(150,150);
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
				<?php  }
				if( $wp_query->max_num_pages > 2 ){ ?>
					<div class="page-navigation">
						<div class="alignleft"><?php previous_posts_link( '<i class="fa fa-chevron-left"></i> '. __('Previous Entries', "best-magazine") ); ?>
						</div>
						<div class="alignright"><?php next_posts_link( __('Next Entries', "best-magazine") . ' <i class="fa fa-chevron-right"></i>', '' ); ?>
						</div>
						<div class="clear"></div>
					</div>
				<?php }
			} ?>
			<div class="clear"></div>
		</div>
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<aside id="sidebar2">
				<div class="sidebar-container">
					<?php  dynamic_sidebar( 'sidebar-2' ); 	?>
					<div class="clear"></div>
				</div>
			</aside>
		<?php } ?>
	</div>
<?php get_footer(); ?>