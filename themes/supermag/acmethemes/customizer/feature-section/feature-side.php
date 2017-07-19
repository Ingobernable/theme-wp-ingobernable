<?php
/*callback functions*/
if ( !function_exists('supermag_side_cat') ) :
    function supermag_side_cat(){
        $supermag_customizer_all_values = supermag_get_theme_options();
        $layout = $supermag_customizer_all_values['supermag-feature-side-display-options'];
        if( 'from-category' == $layout ){
            return true;
        }
        else{
            return false;
        }
    }
endif;

/*callback functions*/
if ( !function_exists('supermag_post_2_ads_2') ) :
    function supermag_post_2_ads_2(){
        $supermag_customizer_all_values = supermag_get_theme_options();
        $layout = $supermag_customizer_all_values['supermag-feature-side-display-options'];
        if( 'post-2-add-2' == $layout ){
            return true;
        }
        else{
            return false;
        }
    }
endif;


/*adding sections for feature side for front page */
$wp_customize->add_section( 'supermag-feature-side', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Slider Right Section', 'supermag' ),
    'panel'          => 'supermag-feature-panel'
) );

/*feature side layout options*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-side-display-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-side-display-options'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_feature_side_display_options();
$wp_customize->add_control( 'supermag_theme_options[supermag-feature-side-display-options]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Select Layout For Featured Side', 'supermag' ),
    'description'   => sprintf( __( 'Note : If problem in image size, please follow the this %1$s documentation %2$s', 'supermag' ), '<a href="http://www.doc.acmethemes.com/supermag/" target="_blank">','</a>' ),
    'section'   => 'supermag-feature-side',
    'settings'  => 'supermag_theme_options[supermag-feature-side-display-options]',
    'type'	  	=> 'select',
    'priority'  => 10
) );

/*feature side cat*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-side-from-category]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-side-from-category'],
    'sanitize_callback' => 'supermag_sanitize_number'
) );

$wp_customize->add_control(
    new Supermag_Customize_Category_Dropdown_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-side-from-category]',
        array(
            'label'		        => __( 'Select Category For Side', 'supermag' ),
            'section'           => 'supermag-feature-side',
            'settings'          => 'supermag_theme_options[supermag-feature-side-from-category]',
            'type'	  	        => 'category_dropdown',
            'priority'          => 20,
            'active_callback'   => 'supermag_side_cat'
        )
    )
);

/*slider side post one*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-post-one]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-post-one'],
    'sanitize_callback' => 'supermag_sanitize_page'
) );
$wp_customize->add_control(
    new Supermag_Customize_Post_Dropdown_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-post-one]',
        array(
            'label'		=> __( 'Select Post One', 'supermag' ),
            'section'   => 'supermag-feature-side',
            'settings'  => 'supermag_theme_options[supermag-feature-post-one]',
            'type'	  	=> 'post_dropdown',
            'priority'  => 55,
            'active_callback'   => 'supermag_post_2_ads_2'

        )
    )
);

/*slider side post two*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-post-two]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-post-two'],
    'sanitize_callback' => 'supermag_sanitize_page'
) );
$wp_customize->add_control(
    new Supermag_Customize_Post_Dropdown_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-post-two]',
        array(
            'label'		=> __( 'Select Post Two', 'supermag' ),
            'section'   => 'supermag-feature-side',
            'settings'  => 'supermag_theme_options[supermag-feature-post-two]',
            'type'	  	=> 'post_dropdown',
            'priority'  => 60,
            'active_callback'   => 'supermag_post_2_ads_2'
        )
    )
);

/*adding hr between post and ad*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-side-show-message]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-side-show-message'],
    'sanitize_callback' => 'esc_attr'
) );
$wp_customize->add_control(
    new Supermag_Customize_Message_Control(
        $wp_customize,
        'supermag_theme_options[supermag-side-show-message]',
        array(
            'section'   => 'supermag-feature-side',
            'description'   => sprintf( __( 'Note : If you select same post for post one and post two in the above selection, then only one post will display %s', 'supermag' ), '<hr />' ),
            'settings'  => 'supermag_theme_options[supermag-side-show-message]',
            'type'	  	=> 'message',
            'priority'  => 74,
            'active_callback'   => 'supermag_post_2_ads_2'
        )
    )
);

/*slider side ad one*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-add-one]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-add-one'],
    'sanitize_callback' => 'supermag_sanitize_image'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-add-one]',
        array(
            'label'		=> __( 'Enter Image One', 'supermag' ),
            'section'   => 'supermag-feature-side',
            'settings'  => 'supermag_theme_options[supermag-feature-add-one]',
            'type'	  	=> 'image',
            'priority'  => 75,
            'description' => __( 'Recommended image size of 240*172', 'supermag' ),
            'active_callback'   => 'supermag_post_2_ads_2'
        )
    )
);
/*slider side ad one link*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-add-one-link]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-add-one-link'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-feature-add-one-link]', array(
    'label'		=> __( 'Image One Link', 'supermag' ),
    'section'   => 'supermag-feature-side',
    'settings'  => 'supermag_theme_options[supermag-feature-add-one-link]',
    'type'	  	=> 'text',
    'priority'  => 80,
    'active_callback'   => 'supermag_post_2_ads_2'
) );

/*slider side ad two*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-add-two]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-add-two'],
    'sanitize_callback' => 'supermag_sanitize_image'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-add-two]',
        array(
            'label'		=> __( 'Enter Image Two', 'supermag' ),
            'section'   => 'supermag-feature-side',
            'settings'  => 'supermag_theme_options[supermag-feature-add-two]',
            'type'	  	=> 'image',
            'priority'  => 90,
            'description' => __( 'Recommended image size of 240*172', 'supermag' ),
            'active_callback'   => 'supermag_post_2_ads_2'
        )
    )
);
/*slider side ad two link*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-add-two-link]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-add-two-link'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-feature-add-two-link]', array(
    'label'		=> __( 'Image Two Link', 'supermag' ),
    'section'   => 'supermag-feature-side',
    'settings'  => 'supermag_theme_options[supermag-feature-add-two-link]',
    'type'	  	=> 'text',
    'priority'  => 100,
    'active_callback'   => 'supermag_post_2_ads_2'
) );

/*adding message for post*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-side-image-message]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-side-image-message'],
    'sanitize_callback' => 'esc_attr'
) );
$wp_customize->add_control(
    new Supermag_Customize_Message_Control(
        $wp_customize,
        'supermag_theme_options[supermag-side-image-message]',
        array(
            'section'   => 'supermag-feature-side',
            'description' => __( 'Note: if you want to add post here, just add image for post and link, Strongly recommended image size is 240*172', 'supermag' ),
            'settings'  => 'supermag_theme_options[supermag-side-image-message]',
            'type'	  	=> 'message',
            'priority'  => 110,
            'active_callback'   => 'supermag_post_2_ads_2'
        )
    )
);

/*title length*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-side-title-length]', array(
	'capability'		=> 'edit_theme_options',
	'default'			=> $defaults['supermag-feature-side-title-length'],
	'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-feature-side-title-length]', array(
	'label'		=> __( 'Title Length in Words', 'supermag' ),
	'section'   => 'supermag-feature-side',
	'settings'  => 'supermag_theme_options[supermag-feature-side-title-length]',
	'type'	  	=> 'number',
	'priority'  => 120
) );