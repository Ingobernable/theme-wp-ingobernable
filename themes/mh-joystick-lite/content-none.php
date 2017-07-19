<article class="post-wrapper">
	<div class="entry-content">
		<?php if (is_search()) : ?>
        	<p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'mh-joystick-lite'); ?></p>
        <?php else : ?>
        	<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for, perhaps searching can help?', 'mh-joystick-lite'); ?></p>
        <?php endif;
        get_search_form(); ?>
	</div>
</article>