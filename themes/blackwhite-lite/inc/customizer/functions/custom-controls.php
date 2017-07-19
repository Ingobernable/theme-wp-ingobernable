<?php
/**
 * Custom Controls for the Customizer
 *
 * @package BlackWhite
 */


/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Label text.
	 *
	 */
	class blackwhite_lite_Customize_Header_Control extends WP_Customize_Control {

		public function render_content() {  ?>
			
			<label>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			</label>
			
			<?php
		}
	}

	/**
	 * Description text
	 *
	 */
	class blackwhite_lite_Customize_Description_Control extends WP_Customize_Control {

		public function render_content() {  ?>
			
			<span class="description"><?php echo wp_kses_post( $this->label ); ?></span>
			
			<?php
		}
	}

	/**
	 * Category dropdown control for the Customizer
	 *
	 */
	class blackwhite_lite_Customize_Category_Dropdown_Control extends WP_Customize_Control {
		
		public function render_content() {
				
			$categories = get_categories( array( 'hide_empty' => false ) );
			
			if( !empty( $categories ) ) : ?>
					
					<label>
					
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						
						<select <?php $this->link(); ?>>
							<option value="0"><?php esc_html_e( 'All Categories', 'blackwhite-lite' ); ?></option>
						<?php
							foreach ( $categories as $category ) :
								
								printf(	'<option value="%s" %s>%s</option>', 
									$category->term_id, 
									selected( $this->value(), $category->term_id, false ), 
									$category->name . ' (' . $category->count . ')'
								);
								
							endforeach;
						?>
						</select>
					  
					</label>
					
				<?php
			endif;
		
		}
		
	}
	
	/**
	 * Upgrade to Pro Version
	 *
	 */
	class blackwhite_lite_Lite_Customize_Upgrade_Control extends WP_Customize_Control {
	
		public function render_content() {  ?>
			
			<div class="upgrade-pro-version">
			
				<span class="customize-control-title"><?php esc_html_e( 'Pro Version', 'blackwhite-lite' ); ?></span>
				
				<span class="textfield">
					<?php printf( esc_html__( 'Purchase the Pro Version of %s to get additional features and advanced customization options.', 'blackwhite-lite' ), 'blackwhite-lite'); ?>
				</span>
				
				<p>
					<a href="<?php echo esc_url( blackwhite_lite_PRO_URL ); ?>?fr=cz" target="_blank" class="button button-secondary">
						<?php printf( esc_html__( 'Learn more about %s Pro', 'blackwhite-lite' ), 'blackwhite-lite'); ?>
					</a>
				</p>
				
			</div>
			<?php
        }
	}
	
endif;