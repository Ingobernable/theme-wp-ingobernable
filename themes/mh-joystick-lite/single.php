<?php get_header(); ?>
<div class="mh-row clearfix">
	<div id="main-content" class="mh-content"><?php
		mh_joystick_lite_before_post_content();
		while (have_posts()) : the_post();
			get_template_part('content', 'single');
			mh_joystick_lite_postnav();
			mh_joystick_lite_authorbox();
			comments_template();
		endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>