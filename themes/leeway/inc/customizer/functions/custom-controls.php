<?php
/**
 * Theme Customizer Functions
 *
 */

/*========================== CUSTOMIZER CONTROLS FUNCTIONS ==========================*/

if ( class_exists( 'WP_Customize_Control' ) ) :

	// Title Control
    class Leeway_Customize_Header_Control extends WP_Customize_Control {

        public function render_content() {  ?>

			<label>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			</label>

			<?php
        }
    }

	// Description Control
	class Leeway_Customize_Description_Control extends WP_Customize_Control {

        public function render_content() {  ?>

			<span class="description"><?php echo wp_kses_post( $this->label ); ?></span>

			<?php
        }
    }

	// Upgrade Control
	class Leeway_Customize_Upgrade_Control extends WP_Customize_Control {

    public function render_content() {  ?>

			<div class="upgrade-pro-version">

				<span class="customize-control-title"><?php esc_html_e( 'Pro Version Add-on', 'leeway' ); ?></span>

				<span class="textfield">
					<?php printf( esc_html__( 'Purchase the %s Pro Add-on and get additional features and advanced customization options.', 'leeway' ), 'Leeway' ); ?>
				</span>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/addons/leeway-pro/', 'leeway' ) ); ?>?utm_source=customizer&utm_medium=button&utm_campaign=leeway&utm_content=pro-version" target="_blank" class="button button-secondary">
						<?php printf( esc_html__( 'Learn more about %s Pro', 'leeway' ), 'Leeway' ); ?>
					</a>
				</p>

			</div>

			<div class="upgrade-plugins">

				<span class="customize-control-title"><?php esc_html_e( 'Recommended Plugins', 'leeway' ); ?></span>

				<span class="textfield">
					<?php esc_html_e( 'Extend the functionality of your WordPress website with our free and easy to use plugins.', 'leeway' ); ?>
				</span>

				<p>
					<a href="<?php echo admin_url( 'plugin-install.php?tab=search&type=author&s=themezee' ); ?>" class="button button-secondary">
						<?php esc_html_e( 'Install Plugins', 'leeway' ); ?>
					</a>
				</p>

			</div>

			<?php
    }
  }

endif;


// Add a callback function to retrieve wether slider is activated or not
function leeway_slider_activated_callback( $control ) {

	// Check if Slider is turned on
	if ( $control->manager->get_setting('leeway_theme_options[slider_active_magazine]')->value() == 1 ) :
		return true;
	elseif ( $control->manager->get_setting('leeway_theme_options[slider_active_blog]')->value() == 1 ) :
		return true;
	else :
		return false;
	endif;

}
