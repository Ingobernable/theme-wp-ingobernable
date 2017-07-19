<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 modified for parent Web-Dorado themes for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once 'class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'wdwt_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function wdwt_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		/*array(
			'name'               => 'TGM Example Plugin', // The plugin name.
			'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),*/

		// This is an example of how to include a plugin from an arbitrary external source in your theme.
		/*array(
			'name'         => 'TGM New Media Plugin', // The plugin name.
			'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
			'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		),*/

		// This is an example of how to include a plugin from a GitHub repository in your theme.
		// This presumes that the plugin code is based in the root of the GitHub repository
		// and not in a subdirectory ('/src') of the repository.
		/*array(
			'name'      => 'Adminbar Link Comments to Pending',
			'slug'      => 'adminbar-link-comments-to-pending',
			'source'    => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip',
		),*/

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Form Maker',
			'slug'      => 'form-maker',
			'required'  => false,
      'popular'   => 1,
		),
		array(
			'name'      => 'Gallery',
			'slug'      => 'photo-gallery',
			'required'  => false,
      'popular'   => 2,
		),
		array(
			'name'      => 'Instagram Feed WD',
			'slug'      => 'wd-instagram-feed',
			'required'  => false,
      'popular'   => 3,
		),
		array(
			'name'      => 'Slider WD',
			'slug'      => 'slider-wd',
			'required'  => false,
      'popular'   => 4,
		),
    array(
      'name'      => 'Google Analytics',
      'slug'      => 'wd-google-analytics',
      'required'  => false,
      'popular'   => 5,
    ),
    array(
      'name'      => 'Calendar',
      'slug'      => 'event-calendar-wd',
      'required'  => false,
      'popular'   => 6,
    ),
    array(
      'name'      => 'Google Maps WD',
      'slug'      => 'wd-google-maps',
      'required'  => false,
      'popular'   => 7,
    ),
    array(
      'name'      => 'Ecommerce Shopping Cart WD',
      'slug'      => 'ecommerce-wd',
      'required'  => false,
      'popular'   => 8,
    ),
    array(
      'name'      => 'Facebook Feed WD',
      'slug'      => 'wd-facebook-feed',
      'required'  => false,
      'popular'   => 9,
    ),
    array(
      'name'      => 'MailChimp Forms WD',
      'slug'      => 'wd-mailchimp',
      'required'  => false,
      'popular'   => 10,
    ),
    

		// This is an example of the use of 'is_callable' functionality. A user could - for instance -
		// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
		// 'wordpress-seo-premium'.
		// By setting 'is_callable' to either a function from that plugin or a class method
		// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
		// recognize the plugin as being installed.
		/*array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),*/

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'wdwt',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'wdwt-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', "best-magazine" ),
			'menu_title'                      => __( 'Install Plugins', "best-magazine" ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', "best-magazine" ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', "best-magazine" ),
			'oops'                            => __( 'Something went wrong with the plugin API.', "best-magazine" ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				"best-magazine"
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				"best-magazine"
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				"best-magazine"
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				"best-magazine"
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				"best-magazine"
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				"best-magazine"
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				"best-magazine"
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				"best-magazine"
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				"best-magazine"
			),
			'return'                          => __( 'Return to Required Plugins Installer', "best-magazine" ),
			'plugin_activated'                => __( 'Plugin activated successfully.', "best-magazine" ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', "best-magazine" ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', "best-magazine" ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', "best-magazine" ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', "best-magazine" ),
			'dismiss'                         => __( 'Dismiss this notice', "best-magazine" ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', "best-magazine" ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', "best-magazine" ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}



function wdwt_plugins_description($slug){
  $string='';
  switch ($slug) {
    case 'form-maker':
      $string = 'Form Maker is user-friendly plugin to create highly customizable and responsive forms in a few minutes with simple drag and drop interface.' ;
      break;
    case 'slider-wd':
      $string = 'Create responsive, highly configurable sliders with various effects for your WordPress site. ' ;
      break;
    case 'photo-gallery':
      $string = 'Photo Gallery is an advanced plugin with a list of tools and options for adding and editing images for different views. It is fully responsive.' ;
      break;
    case 'wd-google-analytics':
      $string = 'Google Analytics WD is a powerful plugin, which adds tracking to your website, lets you view Analytics reports, manage goals, filters, etc.' ;
      break;
    case 'event-calendar-wd':
      $string = 'Organize and publish your events in an easy and elegant way using Event Calendar WD.' ;
      break;
    case 'wd-instagram-feed':
      $string = 'Bring your Instagram feeds to WordPress site with the most advanced and user-friendly Instagram plugin.' ;
      break;
    case 'wd-google-maps':
      $string = 'Google Maps WD is an intuitive tool for creating Google maps with advanced markers, custom layers and overlays for your website.' ;
      break;
    case 'ecommerce-wd':
      $string = 'A highly-functional, user friendly WordPress Ecommerce plugin, which is perfect for developing online stores for any level of complexity.' ;
      break;
    case 'wd-facebook-feed':
      $string = 'Facebook Feed WD is a comprehensive tool for displaying Facebook feed, events and photos in your website.' ;
      break;
    case 'wd-mailchimp':
      $string = 'MailChimp WD is a functional plugin developed to create MailChimp subscribe/unsubscribe forms and manage lists from your WordPress site.' ;
      break;
    default:
      /*do nothing*/
  }

  return $string;

}

function wdwt_tgmpa_admin_scripts(){
  wp_enqueue_style( WDWT_VAR.'_admin_stylesheet', WDWT_URL . '/inc/css/admin.css', array(), WDWT_VERSION );
}