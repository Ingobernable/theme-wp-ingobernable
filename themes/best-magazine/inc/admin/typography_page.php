<?php

	class WDWT_typography_page_class{
		public $options;

		/***********************************/
		/* 			INITIAL PAGE		   */
		/***********************************/

		function __construct(){

			global $best_magazine_special_id_for_db;
			$this->options = array(
				/*headers*/

				'text_headers_font' => array(
					'name' => 'text_headers_font',
					'title' => __( 'Select Font', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->fonts_options(),
					'text_preview' => 'text_headers',
					'style_param' => 'font-family',
					'section' => 'text_headers',
					'tab' => 'typography',
					'default' => array('Open Sans, sans-serif'),
					'customizer' => array(),
				),
				'text_headers' => array(
					'name' => 'text_headers',
					'title' => __( 'Preview', "best-magazine" ),
					'type' => 'text_preview',
					'section' => 'text_headers',
					'tab' => 'typography',
					'default' => ''
				),
				'text_headers_button' => array(
					'name' =>'text_headers_button',
					'title' => __( 'Edit font styling', "best-magazine" ),
					'type' => 'button',
					'show' => array(
						'text_headers_kern',
						'text_headers_transform',
						'text_headers_variant',
						'text_headers_weight',
						'text_headers_style',
					),
					'hide' => array(),
					'section' => 'text_headers',
					'tab' => 'typography',
					'default' => '',
				),
				'text_headers_kern' => array(
					'name' => 'text_headers_kern',
					'title' => __( 'Letter Spacing', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->inputs_kern(),
					'text_preview' => 'text_headers',
					'style_param' => 'letter-spacing',
					'section' => 'text_headers',
					'tab' => 'typography',
					'default' => array('0.00em'),
					'customizer' => array(),
				),
				'text_headers_transform' => array(
					'name' => 'text_headers_transform',
					'title' => __( 'Text Transform', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_transform(),
					'text_preview' => 'text_headers',
					'style_param' => 'text-transform',
					'section' => 'text_headers',
					'tab' => 'typography',
					'default' => array('none'),
					'customizer' => array(),
				),
				'text_headers_variant' => array(
					'name' => 'text_headers_variant',
					'title' => __( 'Variant', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_variant(),
					'text_preview' => 'text_headers',
					'style_param' => 'font-variant',
					'section' => 'text_headers',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
				'text_headers_weight' => array(
					'name' => 'text_headers_weight',
					'title' => __( 'Weight', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_weight(),
					'text_preview' => 'text_headers',
					'style_param' => 'font-weight',
					'section' => 'text_headers',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
				'text_headers_style' => array(
					'name' => 'text_headers_style',
					'title' => __( 'Style', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_style(),
					'text_preview' => 'text_headers',
					'style_param' => 'font-style',
					'section' => 'text_headers',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),

				/*inputs*/

				'text_inputs_font' => array(
					'name' => 'text_inputs_font',
					'title' => __( 'Select Font', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->fonts_options(),
					'text_preview' => 'text_inputs',
					'style_param' => 'font-family',
					'section' => 'inputs_textareas',
					'tab' => 'typography',
					'default' => array('Open Sans, sans-serif'),
					'customizer' => array(),
				),
				'text_inputs' => array(
					'name' => 'text_inputs',
					'title' => __( 'Preview', "best-magazine" ),
					'type' => 'text_preview',
					'section' => 'inputs_textareas',
					'tab' => 'typography',
					'default' => '',
				),
				'text_inputs_button' => array(
					'name' => 'text_inputs_button',
					'title' => __( 'Edit font styling', "best-magazine" ),
					'type' => 'button',
					'show' => array(
						'text_inputs_kern',
						'text_inputs_transform',
						'text_inputs_variant',
						'text_inputs_weight',
						'text_inputs_style',
					),
					'hide' => array(),
					'section' => 'inputs_textareas',
					'tab' => 'typography',
					'default' => ''
				),
				'text_inputs_kern' => array(
					'name' => 'text_inputs_kern',
					'title' => __( 'Letter Spacing', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->inputs_kern(),
					'text_preview' => 'text_inputs',
					'style_param' => 'letter-spacing',
					'section' => 'inputs_textareas',
					'tab' => 'typography',
					'default' => array('0.00em'),
					'customizer' => array(),
				),
				'text_inputs_transform' => array(
					'name' => 'text_inputs_transform',
					'title' => __( 'Text Transform', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_transform(),
					'text_preview' => 'text_inputs',
					'style_param' => 'text-transform',
					'section' => 'inputs_textareas',
					'tab' => 'typography',
					'default' => array('none'),
					'customizer' => array(),
				),
				'text_inputs_variant' => array(
					'name' => 'text_inputs_variant',
					'title' => __( 'Variant', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_variant(),
					'text_preview' => 'text_inputs',
					'style_param' => 'font-variant',
					'section' => 'inputs_textareas',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
				'text_inputs_weight' => array(
					'name' => 'text_inputs_weight',
					'title' => __( 'Weight', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_weight(),
					'text_preview' => 'text_inputs',
					'style_param' => 'font-weight',
					'section' => 'inputs_textareas',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
				'text_inputs_style' => array(
					'name' => 'text_inputs_style',
					'title' => __( 'Style', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_style(),
					'text_preview' => 'text_inputs',
					'style_param' => 'font-style',
					'section' => 'inputs_textareas',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),

				/*links*/

				'text_primary_font' => array(
					'name' => 'text_primary_font',
					'title' => __( 'Select Font', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->fonts_options(),
					'text_preview' => 'text_primary',
					'style_param' => 'font-family',
					'section' => 'primary_font',
					'tab' => 'typography',
					'default' => array('Open Sans, sans-serif'),
					'customizer' => array(),
				),
				'text_primary' => array(
					'name' => 'text_primary',
					'title' => __( 'Preview', "best-magazine" ),
					'type' => 'text_preview',
					'section' => 'primary_font',
					'tab' => 'typography',
					'default' => ''
				),
				'text_primary_button' => array(
					'name' => 'text_primary_button',
					'title' => __( 'Edit font styling', "best-magazine" ),
					'type' => 'button',
					'show' => array(
						'text_primary_kern',
						'text_primary_transform',
						'text_primary_variant',
						'text_primary_weight',
						'text_primary_style',
					),
					'hide' => array(),
					'section' => 'primary_font',
					'tab' => 'typography',
					'default' => ''
				),
				'text_primary_kern' => array(
					'name' => 'text_primary_kern',
					'title' => __( 'Letter Spacing', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->inputs_kern(),
					'text_preview' => 'text_primary',
					'style_param' => 'letter-spacing',
					'section' => 'primary_font',
					'tab' => 'typography',
					'default' => array('0.00em'),
					'customizer' => array(),
				),
				'text_primary_transform' => array(
					'name' => 'text_primary_transform',
					'title' => __( 'Text Transform', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_transform(),
					'text_preview' => 'text_primary',
					'style_param' => 'text-transform',
					'section' => 'primary_font',
					'tab' => 'typography',
					'default' => array('none'),
					'customizer' => array(),
				),
				'text_primary_variant' => array(
					'name' => 'text_primary_variant',
					'title' => __( 'Variant', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_variant(),
					'text_preview' => 'text_primary',
					'style_param' => 'font-variant',
					'section' => 'primary_font',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
				'text_primary_weight' => array(
					'name' => 'text_primary_weight',
					'title' => __( 'Weight', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_weight(),
					'text_preview' => 'text_primary',
					'style_param' => 'font-weight',
					'section' => 'primary_font',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
				'text_primary_style' => array(
					'name' => 'text_primary_style',
					'title' => __( 'Style', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_style(),
					'text_preview' => 'text_primary',
					'style_param' => 'font-style',
					'section' => 'primary_font',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),

				/*secondary*/

				'text_secondary_font' => array(
					'name' => 'text_secondary_font',
					'title' => __( 'Select Font', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->fonts_options(),
					'text_preview' => 'text_secondary',
					'style_param' => 'font-family',
					'section' => 'secondary_font',
					'tab' => 'typography',
					'default' => array('Open Sans, sans-serif'),
					'customizer' => array(),
				),
				'text_secondary' => array(
					'name' => 'text_secondary',
					'title' => __( 'Preview', "best-magazine" ),
					'type' => 'text_preview',
					'text_preview' => 'text_secondary',
					'section' => 'secondary_font',
					'tab' => 'typography',
					'default' => ''
				),
				'text_secondary_button' => array(
					'name' => 'text_secondary_button',
					'title' => __( 'Edit font styling', "best-magazine" ),
					'type' => 'button',
					'show' => array(
						'text_secondary_kern',
						'text_secondary_transform',
						'text_secondary_variant',
						'text_secondary_weight',
						'text_secondary_style',
					),
					'hide' => array(),
					'section' => 'secondary_font',
					'tab' => 'typography',
					'default' => ''
				),
				'text_secondary_kern' => array(
					'name' => 'text_secondary_kern',
					'title' => __( 'Letter Spacing', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->inputs_kern(),
					'text_preview' => 'text_secondary',
					'style_param' => 'letter-spacing',
					'section' => 'secondary_font',
					'tab' => 'typography',
					'default' => array('0.00em'),
					'customizer' => array(),
				),
				'text_secondary_transform' => array(
					'name' => 'text_secondary_transform',
					'title' => __( 'Text Transform', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_transform(),
					'text_preview' => 'text_secondary',
					'style_param' => 'text-transform',
					'section' => 'secondary_font',
					'tab' => 'typography',
					'default' => array('none'),
					'customizer' => array(),
				),
				'text_secondary_variant' => array(
					'name' => 'text_secondary_variant',
					'title' => __( 'Variant', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_variant(),
					'text_preview' => 'text_secondary',
					'style_param' => 'font-variant',
					'section' => 'secondary_font',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
				'text_secondary_weight' => array(
					'name' => 'text_secondary_weight',
					'title' => __( 'Weight', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_weight(),
					'text_preview' => 'text_secondary',
					'style_param' => 'font-weight',
					'section' => 'secondary_font',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
				'text_secondary_style' => array(
					'name' => 'text_secondary_style',
					'title' => __( 'Style', "best-magazine" ),
					'type' => 'select_style',
					'valid_options' => $this->text_style(),
					'text_preview' => 'text_secondary',
					'style_param' => 'font-style',
					'section' => 'secondary_font',
					'tab' => 'typography',
					'default' => array('normal'),
					'customizer' => array(),
				),
			);

		}


		public function fonts_options(){
			$font_choices[ 'Open Sans, sans-serif' ] = 'Open Sans (sans-serif)';
			$font_choices[ 'Arial,Helvetica Neue,Helvetica,sans-serif' ] = 'Arial (sans-serif)*';
			$font_choices[ 'Arial Black,Arial Bold,Arial,sans-serif' ] = 'Arial Black (sans-serif)*';
			$font_choices[ 'Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif' ] = 'Arial Narrow (sans-serif)*';
			$font_choices[ 'Courier,Verdana,sans-serif' ] = 'Courier (sans-serif)*';
			$font_choices[ 'Georgia,Times New Roman,Times,serif' ] = 'Georgia (serif)*';
			$font_choices[ 'Times New Roman,Times,Georgia,serif' ] = 'Times New Roman (serif)*';
			$font_choices[ 'Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Arial,sans-serif' ] = 'Trebuchet MS (sans-serif)*';
			$font_choices[ 'Verdana,sans-serif' ] = 'Verdana *';


			$font_choices[ 'Alegreya SC, serif' ] = 'Alegreya SC (serif)';
			$font_choices[ 'Anonymous Pro, monospace' ] = 'Anonymous Pro (monospace)';
			$font_choices[ 'Cabin Sketch, cursive' ] = 'Cabin Sketch (cursive)';
			$font_choices[ 'Comfortaa, cursive' ] = 'Comfortaa (cursive)';
			$font_choices[ 'Cutive Mono, monospace' ] = 'Cutive Mono (monospace)';
			$font_choices[ 'Inconsolata, monospace' ] = 'Inconsolata (monospace)';
			$font_choices[ 'Indie Flower, cursive' ] = 'Indie Flower (cursive)';
			$font_choices[ 'Droid Serif, serif' ] = 'Droid Serif (serif)';
			$font_choices[ 'Josefin Slab, serif' ] = 'Josefin Slab (serif)';
			$font_choices[ 'Karma, serif' ] = 'Karma (serif)';
			$font_choices[ 'Kaushan Script, cursive' ] = 'Kaushan Script (cursive)';
			$font_choices[ 'Lobster Two, cursive' ] = 'Lobster Two (cursive)';
			$font_choices[ 'Lora, serif' ] = 'Lora (serif)';
			$font_choices[ 'Merriweather, serif' ] = 'Merriweather (serif)';
			$font_choices[ 'Noticia Text, serif' ] = 'Noticia Text (serif)';
			$font_choices[ 'Noto Sans, sans-serif' ] = 'Noto Sans (sans-serif)';
			$font_choices[ 'Oswald, sans-serif'  ] = 'Oswald (sans-serif)';
			$font_choices[ 'Playfair Display, serif'  ] = 'Playfair Display (serif)';
			$font_choices[ 'Poiret One, cursive'  ] = 'Poiret One (cursive)';
			$font_choices[ 'Raleway, sans-serif'  ] = 'Raleway Display (sans-serif)';
			$font_choices[ 'Roboto, sans-serif'  ] = 'Roboto (sans-serif)';
			$font_choices[ 'Satisfy, cursive' ] = 'Satisfy (cursive)';
			$font_choices[ 'Source Code Pro, monospace' ] = 'Source Code Pro (monospace)';
			$font_choices[ 'Tangerine, cursive' ] = 'Tangerine (cursive)';
			$font_choices[ 'Titillium Web, sans-serif'  ] = 'Titillium Web (sans-serif)';
			$font_choices[ 'Ubuntu, sans-serif' ] = 'Ubuntu (sans-serif)';
			$font_choices[ 'Ubuntu Mono, monospace' ] = 'Ubuntu Mono (monospace)';

			$font_choices = apply_filters('wdwt_more_google_fonts', $font_choices );

			return $font_choices;
		}
		private function font_sizes(){
			$font_sizes = array(
				'0.8em' => '0.8em',
				'0.9em' => '0.9em',
				'1em' => '1em',
				'1.1em' => '1.1em',
				'1.2em' => '1.2em',
				'1.5em' => '1.5em',
				'1.8em' => '1.8em',
				'2em' => '2em',
				'2.5em' => '2.5em',
				'3em' => '3em',
				'4em' => '4em',
				'5em' => '5em',
			);

			return $font_sizes;
		}

		/***********************************/
		/* 	  ADMIN REQUERID FUNCTIONS     */
		/***********************************/

		private function inputs_kern($start=-0.3,$trichqy=0.0500001,$count_of_select=26){
			$array_of_kern=array();
			for($i=0;$i<$count_of_select;$i++){
				$array_of_kern[number_format($start,2).'em']=number_format($start,2).'em';
				$start=$start+$trichqy;
			}
			return $array_of_kern;
		}
		private function text_transform(){
			return array('none'=>'None','uppercase'=>'Uppercase ','capitalize'=>'Capitalize ','lowercase'=>'Lowercase  ');
		}
		private function text_variant(){
			return array('normal'=>'Normal ','small-caps'=>'Small-Caps ');
		}
		private function text_weight(){
			return array('normal'=>'Normal ','bold'=>'Bold ','lighter'=>'Light  ');
		}
		private function text_style(){
			return array('normal'=>'Normal ','italic'=>'Italic ');
		}

	}
 
