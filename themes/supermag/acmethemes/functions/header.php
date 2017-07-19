<?php
/**
 * Displays header media
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package Acme Themes
 * @subpackage SuperMag
 * @since 1.5.0
 */
function supermag_header_image_markup( $html, $header, $attr ) {

	$output = '';
	$supermag_customizer_all_values = supermag_get_theme_options();
	$supermag_header_image_link = $supermag_customizer_all_values['supermag-header-image-link'];
	$supermag_header_image_link_new_tab = $supermag_customizer_all_values['supermag-header-image-link-new-tab'];
	$output .= '<div class="wrapper header-image-wrap">';
	if ( !empty( $supermag_header_image_link)) {
		$target = "";
		if( 1 == $supermag_header_image_link_new_tab ){
			$target = 'target = _blank';
		}
		$output .= '<a '.esc_attr( $target ) .' href="'.esc_url( home_url('/') ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';
	}
	$output .= $html;
	if ( !empty( $supermag_header_image_link)) {
		$output .= ' </a>';
	}
	$output .= "</div>";
	return $output;

}
add_filter( 'get_header_image_tag', 'supermag_header_image_markup', 99, 3 );

if ( ! function_exists( 'supermag_header_markup' ) ) :

	function supermag_header_markup() {
		if ( function_exists( 'the_custom_header_markup' ) ) {
			the_custom_header_markup();
		}
		else {
			$header_image = get_header_image();
			if( ! empty( $header_image ) ) {
				$supermag_customizer_all_values = supermag_get_theme_options();
				$supermag_header_image_link = $supermag_customizer_all_values['supermag-header-image-link'];
				$supermag_header_image_link_new_tab = $supermag_customizer_all_values['supermag-header-image-link-new-tab'];
				echo '<div class="wrapper header-image-wrap">';
				if ( !empty( $supermag_header_image_link)) {
					$target = "";
				    if( 1 == $supermag_header_image_link_new_tab ){
				        $target = "target = _blank";
                    }
				    ?>
					<a <?php echo esc_attr( $target ); ?> href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php
				}
				?>
                <img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				<?php
				if ( !empty( $supermag_header_image_link ) ) { ?>
					</a>
					<?php
				}
				echo "</div>";
			}
		}
	}
endif;