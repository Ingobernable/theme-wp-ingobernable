<?php /* Comments Template */
if (post_password_required()) {
	return;
}
$comments_by_type = separate_comments($comments);
$comment_count = count($comments_by_type['comment']);
if (have_comments()) {
	if (!empty($comments_by_type['comment'])) { ?>
		<div class="comments-wrap">
			<h4 class="comment-section-title">
				<?php printf(_n('Readers Comments (1)', 'Readers Comments (%1$s)', $comment_count, 'mh-joystick-lite'), number_format_i18n($comment_count)); ?>
			</h4>
			<ol class="commentlist">
				<?php echo wp_list_comments('callback=mh_joystick_lite_comments&type=comment'); ?>
			</ol>
		</div><?php
	}
	if (get_comments_number() > get_option('comments_per_page')) { ?>
		<div class="pagination comments-pagination">
			<?php paginate_comments_links(array('prev_text' => __('&laquo;', 'mh-joystick-lite'), 'next_text' => __('&raquo;', 'mh-joystick-lite'))); ?>
		</div><?php
	}
	if (!empty($comments_by_type['pings'])) {
		$pings = $comments_by_type['pings']; ?>
		<div class="pingback-wrap">
			<h4 class="comment-section-title">
				<?php printf(__('Trackbacks & Pingbacks (%s)', 'mh-joystick-lite'), count($comments_by_type['pings'])); ?>
			</h4>
			<ol class="pinglist">
				<?php foreach ($pings as $ping) { ?>
					<li class="pings">
						<i class="fa fa-link"></i><?php echo get_comment_author_link($ping); ?>
					</li>
				<?php } ?>
        	</ol>
		</div><?php
	}
	if (!comments_open()) { ?>
		<p class="no-comments">
			<?php _e('Comments are closed.', 'mh-joystick-lite'); ?>
		</p><?php
	}
} else {
	if (comments_open()) {
		echo '<div class="comments-wrap">' . "\n";
			echo '<h4 class="comment-section-title">' . __('Be the first to comment', 'mh-joystick-lite') . '</h4>' . "\n";
		echo '</div>' . "\n";
	}
}
if (comments_open()) {
	$custom_args = array(
    	'title_reply' => __('Leave a comment', 'mh-joystick-lite'),
		'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.', 'mh-joystick-lite') . '</p>',
		'comment_notes_after'  => '',
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __('Comment', 'mh-joystick-lite') . '</label><br/><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>');
	comment_form($custom_args);
}