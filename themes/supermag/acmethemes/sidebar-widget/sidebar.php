<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function supermag_widget_init(){

    register_sidebar(array(
        'name' => __('Main Sidebar Area', 'supermag'),
        'id'   => 'supermag-sidebar',
        'description' => __('Displays items on sidebar.', 'supermag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Home Main Content Area', 'supermag'),
        'id'   => 'supermag-home',
        'description' => __('Displays widgets on home page main content area. This is the Main Sidebar Area of this theme. Put "AT Posts Column" widgets to make your Home Page Awesome. You can put Advertisement and Others Widgets as you want!', 'supermag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));

    if( is_customize_preview() ){
    	$description = sprintf( __( ' Displays items on header area. Fit For Advertisement. You can put Advertisement from %1$s here %2$s too', 'supermag' ), '<a href="#" class="at-customizer" data-section="supermag-header-ad-option">','</a>' );
    }
    else{
	    $description = __('Displays items on header area. Fit For Advertisement', 'supermag');
    }
	register_sidebar(array(
		'name' => __('Header Area', 'supermag'),
		'id'   => 'supermag-header',
		'description' => $description,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	register_sidebar(array(
		'name' => __('Single After Content', 'supermag'),
		'id'   => 'single-after-content',
		'description' => __('Displays items on single post after content', 'supermag'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));

	register_sidebar(array(
		'name' => __('Full Width Footer Area', 'supermag'),
		'id'   => 'full-width-footer',
		'description' => __('Displays items on Footer area.', 'supermag'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));
    
    register_sidebar(array(
        'name' => __('Footer Column One', 'supermag'),
        'id' => 'footer-col-one',
        'description' => __('Displays items on top footer section.', 'supermag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column Two', 'supermag'),
        'id' => 'footer-col-two',
        'description' => __('Displays items on top footer section.', 'supermag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column Three', 'supermag'),
        'id' => 'footer-col-three',
        'description' => __('Displays items on top footer section.', 'supermag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
}
add_action('widgets_init', 'supermag_widget_init');