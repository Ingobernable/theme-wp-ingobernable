<?php
/*The template for displaying Archive pages*/

get_header();
global $wdwt_front;
$grab_image = $wdwt_front->grab_image();
$blog_style = $wdwt_front->blog_style();
$date_enable = $wdwt_front->get_param('date_enable');
?>
</header>
<div class="container"><?php
	/* SIDBAR1 */
	if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<aside id="sidebar1">
			<div class="sidebar-container">
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>
				<div class="clear"></div>
			</div>
		</aside>
	<?php }?>

	<div id="content" class="blog archive-page">

		<?php if (have_posts()) : ?>
			<?php $post = $posts[0]; ?>

			<?php  if (is_category()) { ?>
				<h1 class="styledHeading"><?php _e('Archive For The ', "best-magazine"); ?>&ldquo;<?php single_cat_title(); ?>&rdquo; <?php _e('Category', "best-magazine"); ?></h1>
			<?php  } elseif( is_tag() ) { ?>
				<h1 class="styledHeading"><?php _e('Posts Tagged ', "best-magazine"); ?>&ldquo;<?php single_tag_title(); ?>&rdquo;</h1>
			<?php  } elseif (is_day()) { ?>
				<h1 class="styledHeading"><?php _e('Archive For ', "best-magazine"); ?><?php the_time(get_option( 'date_format' )); ?></h1>
			<?php  } elseif (is_month()) { ?>
				<h1 class="styledHeading"><?php _e('Archive For ', "best-magazine"); ?><?php the_time(get_option( 'date_format' )); ?></h1>
			<?php  } elseif (is_year()) { ?>
				<h1 class="styledHeading"><?php _e('Archive For ', "best-magazine"); ?><?php the_time(get_option( 'date_format' )); ?></h1>
			<?php  } elseif (is_author()) { ?>
				<h1 class="styledHeading"><?php _e('Author Archive', "best-magazine"); ?></h1>
			<?php  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="styledHeading"><?php _e('Blog Archives', "best-magazine"); ?></h1>
			<?php } ?>

			<?php while (have_posts()) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="post">
						<h2 class="archive-header">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
						<?php if($date_enable){ ?>
							<p class="meta-date"><?php _e('By ',"best-magazine"); ?><?php the_author_posts_link(); ?> | <?php Best_magazine_front_functions::posted_on(); ?></p>
						<?php } ?>
					</div>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( ); ?>" rel="bookmark">
						<?php if($grab_image && !has_post_thumbnail()){
							echo Best_magazine_front_functions::display_thumbnail(150,150);
						}else{
							echo Best_magazine_front_functions::thumbnail(150,150);
						} ?>
					</a>
					<?php
					if($blog_style){
						the_excerpt();
					}
					else{
						the_content();
					}  ?>
					<p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( ); ?>" rel="bookmark"><?php _e('Read more', "best-magazine"); ?> &raquo;</a></p>
				</div>
				<?php if($date_enable) Best_magazine_front_functions::entry_meta(); ?>
			<?php endwhile; ?>
			<div class="page-navigation">
				<div class="alignleft"><?php previous_posts_link( '<i class="fa fa-chevron-left"></i> ' . __('Previous Entries', "best-magazine") ); ?>
				</div>
				<div class="alignright"><?php next_posts_link( __('Next Entries', "best-magazine").' <i class="fa fa-chevron-right"></i>', '' ); ?>
				</div>
				<div class="clear"></div>
			</div>
		<?php else : ?>

			<h2 class="archive-header"><?php _e('Not Found', "best-magazine"); ?></h2>
			<p><?php _e('There are not posts belonging to this category or tag. Try searching below:', "best-magazine"); ?></p>
			<div id="search-block-category"><?php get_search_form(); ?></div>

		<?php endif; ?>

		<?php
		if(comments_open()){  ?>
			<div class="comments-template">
				<?php echo comments_template();	?>
			</div>
		<?php } ?>
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
</div>

<?php get_footer(); ?>
