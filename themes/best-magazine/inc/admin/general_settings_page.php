<?php

class WDWT_general_settings_page_class{
	public $options;

	
	/***********************************/
	/* 			INITIAL PAGE		   */
	/***********************************/
	

	function __construct(){

		
		$this->options = array(
			
			'custom_css_enable' => array(
				'name' => 'custom_css_enable',
				'title' => __( 'Custom CSS', "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("custom_css_text"),
				'hide' => array(),
				'description' => __( 'Custom CSS will change the visual style of the website. The CSS code provided here can be applied to any page or post.', "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => false,
				'customizer' => array()				
				),
			'custom_css_text' => array(
				'name' => 'custom_css_text',
				'title' => '',
				'type' => 'textarea',
				"sanitize_type" => "css",
				'valid_options' => '',
				'description' => __( 'Provide the custom CSS code below.', "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => '',
				'customizer' => array()	
				),
			'logo_img' => array(
				'name' => 'logo_img',
				'title' => __( 'Logo', "best-magazine" ),
				'type' => 'upload_single',
				"sanitize_type" => "esc_url_raw",
				'valid_options' => '',
				'description' => __( 'You can apply a custom logo image by clicking on the Upload Image button and uploading your image.', "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => WDWT_IMG. 'logo.png',
				'customizer' => array()		
				),
			'show_header_search' => array(
				'name' => 'show_header_search',
				'title' => __( 'Show Search in Header', "best-magazine" ),
				'type' => 'checkbox',
				'description' => __( 'Check to display search form in header.', "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()	
				),
			'blog_style' => array(
				'name' => 'blog_style',
				'title' =>  __( 'Blog Style post format', "best-magazine" ),
				'type' => 'checkbox',
				'description' => __( 'Check the box to have short previews for the homepage/index posts.', "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()	
				),
			'grab_image' => array(
				'name' => 'grab_image',
				'title' =>  __( 'Grab the first post image', "best-magazine" ),
				'type' => 'checkbox',
				'description' => __( 'Enable this option if you want to use the images that are already in your post to create a thumbnail without using custom fields. In this case thumbnail images will be generated automatically using the first image of the post. Note that the image needs to be hosted on your own server.', "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => false,
				'customizer' => array()	
				),
			
			'date_enable' => array(
				"name" => "date_enable",
				"title" => __("Display post meta information", "best-magazine" ),
				'type' => 'checkbox',
				"description" => __("Choose whether to display the post meta information such as date, author and etc.", "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),
			
			'footer_text_enable' => array(
				"name" => "footer_text_enable",
				"title" => __("Information in the Footer", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("footer_text"),
				'hide' => array(),
				"description" => __("Check the box to display custom HTML for the footer.", "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),

			'footer_text' => array(
				"name" => "footer_text",
				"title" => __("Information in the Footer", "best-magazine" ),
				'type' => 'textarea',
				"sanitize_type" => "sanitize_footer_html_field",
				"description" => __("Here you can provide the HTML code to be inserted in the footer of your web site.", "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => '<span id="copyright">WordPress Themes by <a href="'.WDWT_HOMEPAGE.'"  target="_blank" title="Web-Dorado">Web-Dorado</a></span>',
				'customizer' => array()
			),	
			'show_twitter_icon' => array(
				"name" => "show_twitter_icon",
				"title" => __("Show Twitter Icon", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("twitter_url"),
				'hide' => array(),
				"description" => __("Check the box to display Twitter icon.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()				
			),
			
			'twitter_url' => array(
			    "name" => "twitter_url",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your Twitter Profile URL below.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => '#',
				'customizer' => array()
			),
			
			'show_rss_icon' => array(
			    "name" => "show_rss_icon",
				"title" => __("Show RSS Icon", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("rss_url"),
				'hide' => array(),
				"description" => __("Check the box to display RSS feed icon.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),
			
			'rss_url' => array(
				"name" => "rss_url",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your RSS URL below.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => '#',
				'customizer' => array()
			),
			
			'show_facebook_icon' => array(
				"name" => "show_facebook_icon",
				"title" => __("Show Facebook Icon", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("facebook_url"),
				'hide' => array(),
				"description" => __("Check the box to display Facebook icon.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),
			
			'facebook_url' => array(
				"name" => "facebook_url",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your Facebook Profile URL below.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => '#',
				'customizer' => array()
			),	
			
			'show_google_icon' => array(
				"name" => "show_google_icon",
				"title" => __("Show Google+ Icon", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("google_url"),
				'hide' => array(),
				"description" => __("Check the box to display Google + icon.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),
			'google_url' => array(
				"name" => "google_url",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your Google+ Profile URL below.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => '#',
				'customizer' => array()
			),

			'show_youtube_icon' => array(
				"name" => "show_youtube_icon",
				"title" => __("Show Youtube Icon", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("youtube_url"),
				'hide' => array(),
				"description" => __("Check the box to display Youtube icon.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),
			'youtube_url' => array(
				"name" => "youtube_url",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your Youtube Profile URL below.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => '#',
				'customizer' => array()
			),

			'show_instagram_icon' => array(
				"name" => "show_instagram_icon",
				"title" => __("Show Instagram Icon", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("instagram_url"),
				'hide' => array(),
				"description" => __("Check the box to display Instagram icon.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),
			'instagram_url' => array(
				"name" => "instagram_url",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your Instagram Profile URL below.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => '#',
				'customizer' => array()
			),
			'show_linkedin_icon' => array(
				"name" => "show_linkedin_icon",
				"title" => __("Show LinkedIn Icon", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("linkedin_url"),
				'hide' => array(),
				"description" => __("Check the box to display LinkedIn icon.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),
			'linkedin_url' => array(
				"name" => "linkedin_url",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your LinkedIn Profile URL below.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => '#',
				'customizer' => array()
			),
			'show_pinterest_icon' => array(
				"name" => "show_pinterest_icon",
				"title" => __("Show Pinterest Icon", "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("pinterest_url"),
				'hide' => array(),
				"description" => __("Check the box to display Pinterest icon.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),
			'pinterest_url' => array(
				"name" => "pinterest_url",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your Pinterest Profile URL below.", "best-magazine" ),
				'section' => 'general_links',
				'tab' => 'general',
				'default' => '#',
				'customizer' => array()
			),

		);


			
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {

			$this->options['favicon_enable'] = array(
				'name' => 'favicon_enable',
				'title' => __( 'Show Favicon', "best-magazine" ),
				'type' => 'checkbox_open',
				'show' => array("favicon_img"),
				'hide' => array(),
				'description' => __( 'Check the box to display custom favicon if your version of WordPress does not support it.', "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => false,
				'customizer' => array()	
				);

			$this->options['favicon_img'] = array(
				'name' => 'favicon_img',
				'title' => '',
				'type' => 'upload_single',
				"sanitize_type" => "esc_url_raw",
				'valid_options' => '',
				'description' => __( 'Click on the Upload Image button to upload the favicon image.', "best-magazine" ),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => WDWT_IMG. 'favico.ico',
				'customizer' => array()	
				);
		}
		
		
	}
		

}
 