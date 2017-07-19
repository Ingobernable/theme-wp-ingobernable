<?php

/**
 * Adds SuperMag Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since SuperMag 1.5.0
 *
 * @param null
 * @return null
 *
 */
function supermag_widgets($widgets) {
    $theme_widgets = array(
        'supermag_ad_widget',
        'supermag_posts_col'
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('supermag');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'supermag_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since SuperMag 1.5.0
 *
 * @param null
 * @return null
 *
 */
function supermag_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => __('AT SuperMag Widgets', 'supermag'),
        'filter' => array(
            'groups' => array('supermag')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'supermag_widgets_tab', 20);