<?php 
add_action('wp_head', 'leeway_css_layout');
function leeway_css_layout() {
	
	// Get Theme Options from Database
	$theme_options = leeway_theme_options();
		
	// Switch Sidebar to left
	if ( isset($theme_options['layout']) and $theme_options['layout'] == 'left-sidebar' ) :
	
		echo '<style type="text/css">
			@media only screen and (min-width: 60em) {
				#content {
					float: right;
					padding-right: 0;
					padding-left: 0.5em;
				}
				#sidebar {
					float: left;
				}
			}
		</style>';
	
	endif;
	
}