<?php
/**
 * Main include functions ( to support child theme )
 *
 * @since SuperMag 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('supermag_file_directory') ){

    function supermag_file_directory( $file_path ){
        $located = locate_template( $file_path );
        if( '' != $located ){
            return $located;
        }
        return false;
    }

}

/**
 * Check empty or null
 *
 * @since SuperMag 1.0.0
 *
 * @param string $str, string
 * @return boolean
 *
 */
if( !function_exists('supermag_is_null_or_empty') ){
	function supermag_is_null_or_empty( $str ){
		return ( !isset($str) || trim($str)==='' );
	}
}

/*file for library*/
require supermag_file_directory('acmethemes/library/tgm/class-tgm-plugin-activation.php');

/*
* file for customizer theme options
*/
$supermag_customizer_file_path = supermag_file_directory('acmethemes/customizer/customizer.php');
require $supermag_customizer_file_path;


/*
* file for additional functions files
*/
$supermag_date_display_file_path = supermag_file_directory('acmethemes/functions.php');
require $supermag_date_display_file_path;

require_once supermag_file_directory('acmethemes/functions/header.php');


/*
* files for hooks
*/
require supermag_file_directory('acmethemes/hooks/tgm.php');

$supermag_front_page_file_path = supermag_file_directory('acmethemes/hooks/front-page.php');
require $supermag_front_page_file_path;

$supermag_slider_selection_file_path = supermag_file_directory('acmethemes/hooks/slider-selection.php');
require $supermag_slider_selection_file_path;

$supermag_slider_side_file_path = supermag_file_directory('acmethemes/hooks/slider-side.php');
require $supermag_slider_side_file_path;

$supermag_hooks_header_file_path = supermag_file_directory('acmethemes/hooks/header.php');
require $supermag_hooks_header_file_path;

$supermag_social_links_file_path = supermag_file_directory('acmethemes/hooks/social-links.php');
require $supermag_social_links_file_path;

$supermag_hooks_dynamic_css_file_path = supermag_file_directory('acmethemes/hooks/dynamic-css.php');
require $supermag_hooks_dynamic_css_file_path;

$supermag_hooks_footer_file_path = supermag_file_directory('acmethemes/hooks/footer.php');
require $supermag_hooks_footer_file_path;

$supermag_comment_form_file_path = supermag_file_directory('acmethemes/hooks/comment-forms.php');
require $supermag_comment_form_file_path;

$supermag_excerpts_form_file_path = supermag_file_directory('acmethemes/hooks/excerpts.php');
require $supermag_excerpts_form_file_path;

$supermag_related_posts_file_path = supermag_file_directory('acmethemes/hooks/related-posts.php');
require $supermag_related_posts_file_path;

require supermag_file_directory('acmethemes/hooks/siteorigin-panels.php');

require supermag_file_directory('acmethemes/hooks/acme-demo-setup.php');

/*
* file for sidebar and widgets
*/
$supermag_acme_ad_widget = supermag_file_directory('acmethemes/sidebar-widget/acme-ad.php');
require $supermag_acme_ad_widget;

$supermag_col_posts = supermag_file_directory('acmethemes/sidebar-widget/acme-col-posts.php');
require $supermag_col_posts;

$supermag_sidebar = supermag_file_directory('acmethemes/sidebar-widget/sidebar.php');
require $supermag_sidebar;

/*
* file for core functions imported from functions.php while downloading Underscores
*/
$supermag_sidebar = supermag_file_directory('acmethemes/core.php');
require $supermag_sidebar;

/**
 * Implement Custom Metaboxes
 */
require supermag_file_directory('acmethemes/metabox/metabox.php');

/*themes info*/
require supermag_file_directory('acmethemes/at-theme-info/class-at-theme-info.php');