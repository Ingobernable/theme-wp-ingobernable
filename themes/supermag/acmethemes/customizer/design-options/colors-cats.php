<?php
// Category Color Options
$wp_customize->add_section('supermag_category_color_setting', array(
    'priority'      => 40,
    'title'         => __('Category Color Options', 'supermag'),
    'description'   => __('Change the highlighted color of each category items as you want.', 'supermag'),
    'panel'          => 'supermag-design-panel'
));

$i = 1;
$args = array(
    'orderby' => 'id',
    'hide_empty' => 0
);
$categories = get_categories( $args );
$wp_category_list = array();
foreach ($categories as $category_list ) {
    $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

    $wp_customize->add_setting('supermag_theme_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']', array(
        'default'           => $defaults['supermag-primary-color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(
    	new WP_Customize_Color_Control(
    		$wp_customize,
		    'supermag_theme_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
		    array(
		    	'label'     => sprintf(__('"%s" Color', 'supermag'), $wp_category_list[$category_list->cat_ID] ),
			    'section'   => 'supermag_category_color_setting',
			    'settings'  => 'supermag_theme_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
			    'priority'  => $i
		    )
	    )
    );
	$wp_customize->add_setting('supermag_theme_options[cat-hover-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']', array(
		'default'           => $defaults['supermag-cat-hover-color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'supermag_theme_options[cat-hover-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
			array(
				'label'     => sprintf(__('"%s" Hover Color', 'supermag'), $wp_category_list[$category_list->cat_ID] ),
				'section'   => 'supermag_category_color_setting',
				'settings'  => 'supermag_theme_options[cat-hover-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
				'priority'  => $i
			)
		)
	);

	/*adding hr between cats*/
	$wp_customize->add_setting('supermag_theme_options[cat-hr-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> '',
		'sanitize_callback' => 'esc_attr'
	));

	$wp_customize->add_control(
		new Supermag_Customize_Message_Control(
			$wp_customize,
			'supermag_theme_options[cat-hr-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
			array(
				'section'   => 'supermag_category_color_setting',
				'description'    => "<hr>",
				'settings'  => 'supermag_theme_options[cat-hr-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
				'type'	  	=> 'message',
				'priority'  => $i
			)
		)
	);
    $i++;
}
