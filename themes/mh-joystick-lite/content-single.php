<article <?php post_class('post-wrapper'); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1><?php
		mh_joystick_lite_post_meta();
		mh_joystick_lite_featured_image(); ?>
    </header><?php
	mh_joystick_lite_post_category(); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><?php
	mh_joystick_lite_post_tags(); ?>
</article>