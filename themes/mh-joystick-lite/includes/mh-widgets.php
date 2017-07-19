<?php

/***** Register Widgets *****/

function mh_joystick_lite_register_widgets() {
	register_widget('mh_joystick_lite_custom_posts');
	register_widget('mh_joystick_lite_comments');
	register_widget('mh_joystick_lite_slider');
}
add_action('widgets_init', 'mh_joystick_lite_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-custom-posts.php');
require_once('widgets/mh-comments.php');
require_once('widgets/mh-slider.php');

?>