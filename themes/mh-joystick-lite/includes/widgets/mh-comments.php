<?php

/***** MH Recent Comments *****/

class mh_joystick_lite_comments extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mh_joystick_lite_comments', esc_html_x('MH Recent Comments', 'widget name', 'mh-joystick-lite'),
			array(
				'classname' => 'mh_joystick_lite_comments',
				'description' => esc_html__('MH Recent Comments widget to display your recent comments including user avatars.', 'mh-joystick-lite'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
    	$defaults = array('title' => '', 'number' => 5, 'offset' => 0);
		$instance = wp_parse_args($instance, $defaults);
        echo $args['before_widget'];
        	if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			} ?>
			<ul class="mh-recent-comments mh-row clearfix"><?php
				$comments = get_comments(array('number' => absint($instance['number']), 'offset' => absint($instance['offset']), 'status' => 'approve', 'type' => 'comment'));
				if ($comments) {
					foreach ($comments as $comment) { ?>
						<li class="rc-item clearfix">
							<div class="rc-avatar">
								<a href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID; ?>" title="<?php echo $comment->comment_author; ?>">
									<?php echo get_avatar($comment->comment_author_email, 56); ?>
								</a>
							</div>
							<div class="rc-text">
								<div class="rc-author">
									<?php printf(_x('%1$s on %2$s', 'comment widget', 'mh-joystick-lite'), $comment->comment_author, ''); ?>
								</div>
								<a href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID; ?>" title="<?php echo $comment->comment_author . ' | ' . get_the_title($comment->comment_post_ID); ?>">
									<?php echo get_the_title($comment->comment_post_ID); ?>
								</a>
							</div>
						</li><?php
					}
				} ?>
			</ul><?php
        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
		$instance = array();
		if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
		if (0 !== absint($new_instance['number'])) {
			$instance['number'] = absint($new_instance['number']);
		}
		if (0 !== absint($new_instance['offset'])) {
			$instance['offset'] = absint($new_instance['offset']);
		}
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => __('Recent Comments', 'mh-joystick-lite'), 'number' => 5, 'offset' => 0);
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-joystick-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Limit Comment Number:', 'mh-joystick-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['number']); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" id="<?php echo esc_attr($this->get_field_id('number')); ?>" />
	    </p>

		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Comments (Offset):', 'mh-joystick-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p><?php
    }
}

?>