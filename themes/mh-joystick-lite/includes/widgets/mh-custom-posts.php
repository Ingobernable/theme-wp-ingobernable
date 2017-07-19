<?php

/***** MH Custom Posts *****/

class mh_joystick_lite_custom_posts extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mh_joystick_lite_custom_posts', esc_html_x('MH Custom Posts [lite]', 'widget name', 'mh-joystick-lite'),
			array(
				'classname' => 'mh_joystick_lite_custom_posts',
				'description' => esc_html__('Display posts including thumbnail images.', 'mh-joystick-lite'),
				'customize_selective_refresh' => true
			)
		);
	}
	function widget($args, $instance) {
		$defaults = array('title' => '', 'category' => 0, 'postcount' => 5, 'offset' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults);
		$query_args = array();
		$query_args['ignore_sticky_posts'] = $instance['sticky'];
		if (0 !== $instance['category']) {
			$query_args['category__in'] = $instance['category'];
		}
		if (!empty($instance['postcount'])) {
			$query_args['posts_per_page'] = $instance['postcount'];
		}
		if (0 !== $instance['offset']) {
			$query_args['offset'] = $instance['offset'];
		}
		$widget_posts = new WP_Query($query_args);
        echo $args['before_widget'];
			if ($widget_posts->have_posts()) :
				$counter = 1;
				$max_posts = $widget_posts->post_count;
				if (!empty($instance['title'])) {
					echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
				}
				echo '<div class="custom-posts-widget">' . "\n";
					while ($widget_posts->have_posts()) : $widget_posts->the_post();
						if ($counter == 1) : ?>
							<div class="mh-row clearfix custom-posts-cols"><?php
						endif;
						if ($counter >= 1 && $counter <= 2) :  ?>
							<div class="mh-col-1-2 custom-posts-lead">
								<article <?php post_class('custom-posts-item'); ?>>
									<div class="custom-posts-thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php if (has_post_thumbnail()) { the_post_thumbnail('mh-joystick-lite-medium'); } else { echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="No Image" />'; } ?>
										</a>
									</div>
									<h3 class="custom-posts-title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
											<?php the_title(); ?>
										</a>
									</h3>
								</article>
							</div><?php
						endif;
						if ($counter == 1 && $counter == $max_posts || $counter == 2 && $counter == $max_posts || $counter == 3) : ?>
							</div><?php
						endif;
						if ($counter >= 3) : ?>
							<article <?php post_class('custom-posts-lower clearfix'); ?>>
								<div class="custom-posts-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php if (has_post_thumbnail()) { the_post_thumbnail('mh-joystick-lite-small'); } else { echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-small.png' . '" alt="No Image" />'; } ?>
									</a>
								</div>
								<h3 class="custom-posts-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
										<?php the_title(); ?>
									</a>
								</h3>
								<div class="custom-posts-excerpt">
									<?php the_excerpt(); ?>
								</div>
							</article><?php
						endif;
						$counter++;
					endwhile;
					wp_reset_postdata();
				echo '</div>' . "\n";
			endif;
		echo $args['after_widget'];
    }
	function update($new_instance, $old_instance) {
        $instance = array();
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
        if (0 !== absint($new_instance['category'])) {
			$instance['category'] = absint($new_instance['category']);
		}
		if (0 !== absint($new_instance['postcount'])) {
			if (absint($new_instance['postcount']) > 50) {
				$instance['postcount'] = 50;
			} else {
				$instance['postcount'] = absint($new_instance['postcount']);
			}
		}
		if (0 !== absint($new_instance['offset'])) {
			if (absint($new_instance['offset']) > 50) {
				$instance['offset'] = 50;
			} else {
				$instance['offset'] = absint($new_instance['offset']);
			}
		}
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'category' => 0, 'postcount' => 5, 'offset' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'mh-joystick-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Select a Category:', 'mh-joystick-lite'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('category')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('category')); ?>">
            	<option value="0" <?php selected(0, $instance['category']); ?>><?php esc_html_e('All', 'mh-joystick-lite'); ?></option><?php
            		$categories = get_categories();
            		foreach ($categories as $cat) { ?>
            			<option value="<?php echo absint($cat->cat_ID); ?>" <?php selected($cat->cat_ID, $instance['category']); ?>><?php echo esc_html($cat->cat_name) . ' (' . absint($cat->category_count) . ')'; ?></option><?php
            		} ?>
            </select>
            <small><?php _e('Select a category to display posts from.', 'mh-joystick-lite'); ?></small>
		</p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('postcount')); ?>"><?php esc_html_e('Post Count (max. 50):', 'mh-joystick-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['postcount']); ?>" name="<?php echo esc_attr($this->get_field_name('postcount')); ?>" id="<?php echo esc_attr($this->get_field_id('postcount')); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Skip Posts (max. 50):', 'mh-joystick-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['offset']); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" />
	    </p>
	    <p>
    		<strong><?php _e('Info:', 'mh-joystick-lite'); ?></strong> <?php _e('This is the lite version of this widget with basic features. If you need more advanced features and options, you can upgrade to the premium version of this theme.', 'mh-joystick-lite'); ?>
    	</p><?php
    }
}

?>