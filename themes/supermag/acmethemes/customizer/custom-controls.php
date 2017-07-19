<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Supermag_Customize_Category_Dropdown_Control' )):

    /**
     * Custom Control for category dropdown
     * @package Acme Themes
     * @subpackage SuperMag
     * @since 1.0.0
     *
     */
    class Supermag_Customize_Category_Dropdown_Control extends WP_Customize_Control {

        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'category_dropdown';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
        public function render_content() {
            $supermag_customizer_name = 'supermag_customizer_dropdown_categories_' . $this->id;;
            $supermag_dropdown_categories = wp_dropdown_categories(
                array(
                    'name'              => $supermag_customizer_name,
                    'echo'              => 0,
                    'show_option_none'  =>__('Select','supermag'),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
            $supermag_dropdown_final = str_replace( '<select', '<select ' . $this->get_link(), $supermag_dropdown_categories );
            printf(
                '<label><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $supermag_dropdown_final
            );
        }
    }
    endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Supermag_Customize_Post_Dropdown_Control' )):

    /**
     * Custom Control for post dropdown
     * @package Acme Themes
     * @subpackage SuperMag
     * @since 1.0.0
     *
     */
    class Supermag_Customize_Post_Dropdown_Control extends WP_Customize_Control {
        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'post_dropdown';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
        public function render_content() {
            $supermag_customizer_post_args = array(
                'posts_per_page'   => 20,
            );
            $supermag_posts = get_posts( $supermag_customizer_post_args );
            if(!empty($supermag_posts))  {
                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?>>
                        <?php
                        $supermag_default_value = $this->value();
                        if( -1 == $supermag_default_value || empty($supermag_default_value)){
                            $supermag_default_selected = 1;
                        }
                        else{
                            $supermag_default_selected = 0;
                        }
                        printf('<option value="0" %s>%s</option>',selected($supermag_default_selected, 1, false),__('Select','supermag'));
                        foreach ( $supermag_posts as $supermag_post ) {
                            printf('<option value="%s" %s>%s</option>', $supermag_post->ID, selected($this->value(), $supermag_post->ID, false), $supermag_post->post_title);
                        }
                        ?>
                    </select>
                </label>
                <?php
            }
        }
    }
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Supermag_Customize_Message_Control' )):
    /**
     * Custom Control for html display
     * @package Acme Themes
     * @subpackage SuperMag
     * @since 1.0.0
     *
     */
    class Supermag_Customize_Message_Control extends WP_Customize_Control {

        /**
         * Declare the control type.
         * @access public
         * @var string
         */
        public $type = 'message';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
        public function render_content() {
            if ( empty( $this->description ) ) {
                return;
            }
	        $allowed_html = array(
		        'a' => array(
			        'href' => array(),
			        'title' => array(),
			        'data-section' => array(),
			        'class' => array(),
			        'target' => array(),
		        ),
		        'hr' => array(),
		        'br' => array(),
		        'em' => array(),
		        'strong' => array(),
	        );
            ?>
            <div class="supermag-customize-customize-message">
                <?php
                echo wp_kses( $this->description , $allowed_html )
                ?>
            </div> <!-- .supermag-customize-customize-message -->
            <?php
        }
    }
endif;