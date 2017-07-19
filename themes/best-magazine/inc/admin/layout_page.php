<?php

class WDWT_layout_page_class{

	public $options;
	
	
	/***********************************/
	/* 			INITIAL PAGE		   */
	/***********************************/
	
	function __construct(){
			
		$this->options = array (
		
			'default_layout' => array(
				'name' => 'default_layout',
				'title' => __( 'Choose Default Layout', "best-magazine" ),
				'type' => 'layout_open',
				'valid_options' => array(
					  array('index' => '1', 'title'=>__( 'No Sidebar', "best-magazine" ), 'description'=>''),
					  array('index' => '2', 'title'=>__( 'Right Sidebar', "best-magazine" ), 'description'=>''),
					  array('index' => '3', 'title'=>__( 'Left Sidebar', "best-magazine" ), 'description'=>''),
					  array('index' => '4', 'title'=>__( 'Two Right Sidebars', "best-magazine" ), 'description'=>''),
					  array('index' => '5', 'title'=>__( 'Two Left Sidebars', "best-magazine" ), 'description'=>''),
					  array('index' => '6', 'title'=>__( 'One Right One Left Sidebars', "best-magazine" ), 'description'=>''),
				),
				'description' => __( 'Here you can select the default layout for pages and posts on the website.', "best-magazine" ),
				'show' => array(
                      '2'=>'main_column',
                      '3'=>'main_column',
                      '4'=>array('main_column', 'pwa_width'),
                      '5'=>array('main_column', 'pwa_width'),
                      '6'=>array('main_column', 'pwa_width'),
                      ),
				'hide' => array(),
				'img_src' => 'sprite-layouts.png',
				'img_height' => 289,
				'img_width' => 50,
				'section' => 'layout_editor',
				'tab' => 'layout_editor', 
				'default' => '2',
				'customizer' => array()
			),
			 
			'full_width' => array(
				'name' => 'full_width',
				'title' => __( 'Full Width', "best-magazine" ),
				'type' => 'checkbox',
				'description' => __( 'You can choose full width for pages and posts on the website.', "best-magazine" ),
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'default' => false,
				'customizer' => array()
			),	  
		
			'content_area_percent' => array(
				'name' => 'content_area_percent',
				'title' => __( 'Content Area Width', "best-magazine" ),
				'type' => 'number',
				'valid_options' => '',
				"sanitize_type" => "sanitize_text_field",
				'description' => __( 'Specify the width of the Content Area', "best-magazine" ),
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'step' => '1',
				'min' => '75',
				'max' => '99',
				'default' => '75',
				"unit_symbol" => "%",
				'customizer' => array()
			),		   
		
			 'main_column' => array(
				'name' => 'main_column',
				'title' => __( 'Main Column Width', "best-magazine" ),
				'type' => 'text',
				"sanitize_type" => "sanitize_text_field",
				'valid_options' =>'',
				'description' => __( 'Specify the width of the Main Column', "best-magazine" ),
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'input_size' => '2',
				'default' => '67',
				"unit_symbol" => "%",
				'customizer' => array()
			),	 
		
			'pwa_width' => array(
				'name' => 'pwa_width',
				'title' => __( 'Primary Widget Area width', "best-magazine" ),
				'type' => 'text',
				'valid_options' => '',
				"sanitize_type" => "sanitize_text_field",
				'description' => __( 'Specify the width of the Primary Widget Area', "best-magazine" ),
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'input_size' => '2',
				'default' => '16',
				"unit_symbol" => "%",
				'customizer' => array()
			),  
		);
	
	
	}
		
}
 