<?php

function mh_joystick_lite_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Joystick_Lite_Upgrade extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="mh-upgrade-thumb">
        		<img src="<?php echo get_template_directory_uri(); ?>/images/mh_joystick.png" />
        	</p>
        	<p class="customize-control-title mh-upgrade-title">
        		<?php esc_html_e('MH Joystick Pro', 'mh-joystick-lite'); ?>
        	</p>
        	<p class="textfield mh-upgrade-text">
        		<?php esc_html_e('If you like the free version of this theme, you will LOVE the full version of MH Joystick which includes unique custom widgets, additional features and more useful options to customize your website.', 'mh-joystick-lite'); ?>
			</p>
			<p class="customize-control-title mh-upgrade-title">
        		<?php esc_html_e('Additional Features:', 'mh-joystick-lite'); ?>
        	</p>
        	<ul class="mh-upgrade-features">
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Options to modify color scheme', 'mh-joystick-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Typography options', 'mh-joystick-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Several additional widget areas', 'mh-joystick-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Additional custom widgets', 'mh-joystick-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Additional custom menu slots', 'mh-joystick-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Social buttons, related articles, ...', 'mh-joystick-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('News ticker and many more...', 'mh-joystick-lite'); ?>
	        	</li>
        	</ul>
			<p class="mh-button mh-upgrade-button">
				<a href="https://www.mhthemes.com/themes/mh/joystick/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Upgrade to MH Joystick Pro', 'mh-joystick-lite'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://www.mhthemes.com/themes/showcase/" target="_blank" class="button button-secondary">
					<?php esc_html_e('MH Themes Showcase', 'mh-joystick-lite'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://www.mhthemes.com/support/documentation-mh-joystick/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Theme Documentation', 'mh-joystick-lite'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://wordpress.org/support/theme/mh-joystick-lite" target="_blank" class="button button-secondary">
					<?php esc_html_e('Support Forum', 'mh-joystick-lite'); ?>
				</a>
			</p><?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_joystick_lite_theme_options', array('title' => esc_html__('Theme Options', 'mh-joystick-lite'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_joystick_lite_general', array('title' => esc_html__('General', 'mh-joystick-lite'), 'priority' => 1, 'panel' => 'mh_joystick_lite_theme_options'));
	$wp_customize->add_section('mh_joystick_lite_layout', array('title' => esc_html__('Layout', 'mh-joystick-lite'), 'priority' => 2, 'panel' => 'mh_joystick_lite_theme_options'));
	$wp_customize->add_section('mh_joystick_lite_upgrade', array('title' => esc_html__('More Features', 'mh-joystick-lite'), 'priority' => 3, 'panel' => 'mh_joystick_lite_theme_options'));


	/***** Add Settings *****/

	$wp_customize->add_setting('mh_joystick_lite_options[excerpt_length]', array('default' => 16, 'type' => 'option', 'sanitize_callback' => 'mh_joystick_lite_sanitize_integer'));
	$wp_customize->add_setting('mh_joystick_lite_options[read_more]', array('default' => esc_html__('Read More', 'mh-joystick-lite'), 'type' => 'option', 'sanitize_callback' => 'mh_joystick_lite_sanitize_text'));
	$wp_customize->add_setting('mh_joystick_lite_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_joystick_lite_sanitize_select'));
	$wp_customize->add_setting('mh_joystick_lite_options[premium_version_upgrade]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));

	/***** Add Controls *****/

	$wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-joystick-lite'), 'section' => 'mh_joystick_lite_general', 'settings' => 'mh_joystick_lite_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
	$wp_customize->add_control('read_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-joystick-lite'), 'section' => 'mh_joystick_lite_general', 'settings' => 'mh_joystick_lite_options[read_more]', 'priority' => 2, 'type' => 'text'));
	$wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar Alignment', 'mh-joystick-lite'), 'section' => 'mh_joystick_lite_layout', 'settings' => 'mh_joystick_lite_options[sidebar]', 'priority' => 1, 'type' => 'select', 'choices' => array('right' => esc_html__('Right Sidebar', 'mh-joystick-lite'), 'left' => esc_html__('Left Sidebar', 'mh-joystick-lite'))));
	$wp_customize->add_control(new MH_Joystick_Lite_Upgrade($wp_customize, 'premium_version_upgrade', array('section' => 'mh_joystick_lite_upgrade', 'settings' => 'mh_joystick_lite_options[premium_version_upgrade]', 'priority' => 1)));
}
add_action('customize_register', 'mh_joystick_lite_customize_register');

/***** Data Sanitization *****/

function mh_joystick_lite_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_joystick_lite_sanitize_integer($input) {
	if (absint($input)) {
		return absint($input);
	} else {
		return 16;
	}
}
function mh_joystick_lite_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_joystick_lite_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'mh-joystick-lite'),
        'disable' => esc_html__('Disable', 'mh-joystick-lite'),
		'right' => esc_html__('Right Sidebar', 'mh-joystick-lite'),
        'left' => esc_html__('Left Sidebar', 'mh-joystick-lite'),
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_joystick_lite_theme_options')) {
	function mh_joystick_lite_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_joystick_lite_options', array()),
			mh_joystick_lite_default_options()
		);
		return $theme_options;
	}
}
if (!function_exists('mh_joystick_lite_default_options')) {
	function mh_joystick_lite_default_options() {
		$default_options = array(
			'excerpt_length' => 16,
			'read_more' => esc_html__('Read More', 'mh-joystick-lite'),
			'sidebar' => 'right'
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_joystick_lite_customizer_css() {
	wp_enqueue_style('mh-customizer', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_joystick_lite_customizer_css');

?>