<?php 
add_action('wp_head', 'glades_css_layout');
function glades_css_layout() {
	
	// Get Theme Options from Database
	$theme_options = glades_theme_options();
		
	// Change Site Layout to boxed if activated
	if ( isset($theme_options['layout']) and $theme_options['layout'] == 'boxed' ) :
	
		echo '<style type="text/css">
			@media only screen and (min-width: 60em) {
				#wrapper {
					max-width: 1325px;
					width: 94%;
					margin: 0 auto;
				}
				.container {
					max-width: 100%;
					width: auto;
					margin: 0 2em;
				}
			}
		</style>';
	
	endif;
	
	
	// Switch Sidebar to left
	if ( isset($theme_options['sidebar']) and $theme_options['sidebar'] == 'left-sidebar' ) :
	
		echo '<style type="text/css">
			@media only screen and (min-width: 60em) {
				#content {
					float: right;
					padding-right: 0;
					padding-left: 2em;
				}
				#sidebar {
					float: left;
				}
			}
		</style>';
	
	endif;
	
}