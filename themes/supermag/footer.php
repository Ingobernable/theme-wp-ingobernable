<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage SuperMag
 */


/**
 * supermag_action_after_content hook
 * @since SuperMag 1.0.0
 *
 * @hooked supermag_after_content - 10
 */
do_action( 'supermag_action_after_content' );

/**
 * supermag_action_before_footer hook
 * @since SuperMag 1.0.0
 *
 * @hooked null
 */
do_action( 'supermag_action_before_footer' );

/**
 * supermag_action_footer hook
 * @since SuperMag 1.0.0
 *
 * @hooked supermag_footer - 10
 */
do_action( 'supermag_action_footer' );

/**
 * supermag_action_after_footer hook
 * @since SuperMag 1.0.0
 *
 * @hooked null
 */
do_action( 'supermag_action_after_footer' );

/**
 * supermag_action_after hook
 * @since SuperMag 1.0.0
 *
 * @hooked supermag_page_end - 10
 */
do_action( 'supermag_action_after' );

wp_footer(); ?>
</body>
</html>