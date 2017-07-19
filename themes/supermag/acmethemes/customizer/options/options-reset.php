<?php
/**
 * Reset options
 * Its outside options panel
 *
 * @param  array $reset_options
 * @return void
 *
 * @since SuperMag 1.1.0
 */
if ( ! function_exists( 'supermag_reset_db_options' ) ) :
    function supermag_reset_db_options( $reset_options ) {
        set_theme_mod( 'supermag_theme_options', $reset_options );
    }
endif;

function supermag_reset_db_setting( ){
	$supermag_customizer_all_values = supermag_get_theme_options();
    $input = $supermag_customizer_all_values['supermag-reset-options'];
    if( '0' == $input ){
        return;
    }
    $supermag_default_theme_options = supermag_get_default_theme_options();
    $supermag_get_theme_options = get_theme_mod( 'supermag_theme_options');

    switch ( $input ) {
        case "reset-color-options":
            $supermag_get_theme_options['supermag-primary-color'] = $supermag_default_theme_options['supermag-primary-color'];
            supermag_reset_db_options($supermag_get_theme_options);
            break;

        case "reset-all":
            supermag_reset_db_options($supermag_default_theme_options);
            break;

        default:
            break;
    }
}
add_action( 'customize_save_after','supermag_reset_db_setting' );

/*adding sections for Reset Options*/
$wp_customize->add_section( 'supermag-reset-options', array(
    'priority'       => 220,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Reset Options', 'supermag' )
) );

/*Reset Options*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-reset-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-reset-options'],
    'transport'			=> 'postMessage',
    'sanitize_callback' => 'supermag_sanitize_select'
) );

$choices = supermag_reset_options();
$wp_customize->add_control( 'supermag_theme_options[supermag-reset-options]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Reset Options', 'supermag' ),
    'description'=> __( 'Caution: Reset theme settings according to the given options. Refresh the page after saving to view the effects. ', 'supermag' ),
    'section'   => 'supermag-reset-options',
    'settings'  => 'supermag_theme_options[supermag-reset-options]',
    'type'	  	=> 'select'
) );