<?php
/**
 * The left sidebar containing the main widget area.
 */
if ( ! is_active_sidebar( 'supermag-sidebar' ) ) {
    return;
}
$sidebar_layout = supermag_sidebar_selection();
?>
<?php if( $sidebar_layout == "left-sidebar" ) : ?>
    <div id="secondary-left" class="widget-area sidebar secondary-sidebar float-right" role="complementary">
        <div id="sidebar-section-top" class="widget-area sidebar clearfix">
            <?php dynamic_sidebar( 'supermag-sidebar' ); ?>
        </div>
    </div>
<?php endif;
