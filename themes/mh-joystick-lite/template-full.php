<?php /* Template Name: Full-Width */ ?>
<?php get_header(); ?>
<div class="mh-row clearfix">
	<div id="main-content" class="page-full-width"><?php
		mh_joystick_lite_before_page_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'page');
			comments_template();
		endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>