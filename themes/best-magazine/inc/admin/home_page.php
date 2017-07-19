<?php

class WDWT_HOMEPAGE_page_class{
	
	public $homepage;
	public $shorthomepage;
	public $options;
	
	function __construct(){

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		
		$this->shorthomepage = "";
		$frst_post_wordpress=array();
		
		$sticky = get_option( 'sticky_posts' );
		rsort( $sticky );
		$frst_post_wordpress = array_slice( $sticky, 0, 1 ); /*latest*/
		if(empty($frst_post_wordpress)){
			$post_in_array=get_posts( array('posts_per_page' => 1));
			if($post_in_array)
				$frst_post_wordpress=array($post_in_array[0]->ID);
			else
				$frst_post_wordpress=array();	
			unset($post_in_array);	
		}
		
		
		
		$this->options = array(
		
			
			
			"hide_top_posts" => array(
				"name" => "hide_top_posts",
				"title" => "",
				'type' => 'checkbox_open',
				'show' => array("top_post_cat_name","top_post_categories"),
				'hide' => array(),
				"description" => __("Check the box to display the top posts from the homepage.","best-magazine"),
				'section' => 'top_posts',
				'tab' => 'homepage',
				'default' => true,
				'customizer' => array()				
			),
			
			"top_post_cat_name" => array(
				"name" => "top_post_cat_name",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Name of top post category","best-magazine"),
				'section' => 'top_posts',
				'tab' => 'homepage',
				'default' => '',
				'customizer' => array()	
			),
			
			"top_post_categories" => array(
				"name" => "top_post_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"valid_options" => $this->get_categories(),
				"description" => __("Select the categories from which you want the homepage top posts to be selected (the posts are selected automatically).","best-magazine"),
				'section' => 'top_posts',
				'tab' => 'homepage',
				'default' => $this->get_categories_ids(),
				'customizer' => array()	
			),
				"top_post_order" => array(
				"name" => "top_post_order",
				"title" => "",
				'type' => 'select',
				"sanitize_type" => "sanitize_text_field",
				"valid_options" => array('asc'=>__("Ascending", "best-magazine"), 'desc'=>__("Descending", "best-magazine")),
				"description" => __("Order of posts", "best-magazine"),
				'section' => 'top_posts',
				'tab' => 'homepage',
				'default' => array('desc'),
				'customizer'=>array()
			),
			
				"top_post_orderby" => array(
				"name" => "top_post_orderby",
				"title" => "",
				'type' => 'select',
				"sanitize_type" => "sanitize_text_field",
				"valid_options" => array('date'=>__("Date", "best-magazine"), 'name'=>__("Slug", "best-magazine"),'title'=>__("Title", "best-magazine")),
				"description" => __("Order by", "best-magazine"),
				'section' => 'top_posts',
				'tab' => 'homepage',
				'default' => array('date'),
				'customizer'=>array()
			),
			"hide_category_tabs_posts" => array(
				"name" => "hide_category_tabs_posts",
				"title" =>"",
				'type' => 'checkbox_open',
				'show' => array("home_page_tabs_exclusive"),
				'hide' => array(),
				"description" => __("Check the box to display the category tabs from the homepage.","best-magazine"),
				'section' => 'category_tabs',
				'tab' => 'homepage',
				'default' => true,
				'customizer' => array()
			),
			
			"home_page_tabs_exclusive" => array(
				"name" => "home_page_tabs_exclusive",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"valid_options" => $this->get_categories(true),
				'section' => 'category_tabs',
				'tab' => 'homepage',
				'default' => array('random'),
				'customizer' => array()
			),
			
			"hide_video_post" => array(
				"name" => "hide_video_post",
				"title" => "",
				'type' => 'checkbox_open',
				'show' => array("video_post_name","home_video_post"),
				'hide' => array(),
				"description" => __("Check the box to display the featured post from the homepage.","best-magazine"),
				'section' => 'featured_post',
				'tab' => 'homepage',
				'default' => true,
				'customizer' => array()
			),
			
			"video_post_name" => array(
				"name" => "video_post_name",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Name of featured post","best-magazine"),
				'section' => 'featured_post',
				'tab' => 'homepage',
				'default' =>'MOST POPULAR',
				'customizer' => array()
			),
			
			"home_video_post" => array(
				"name" => "home_video_post",
				"title" => "",
				'type' => 'select',
				"valid_options" => $this->get_posts(),
				"description" => __("Select post for displaying in featured us page","best-magazine"),
				'section' => 'featured_post',
				'tab' => 'homepage',
				'default' =>  $frst_post_wordpress,
				'customizer' => array()
			),
			
			"hide_content_posts" => array(
				"name" => "hide_content_posts",
				"title" =>'',
				'type' => 'checkbox_open',
				'show' => array("content_post_cat_name","content_post_categories"),
				'hide' => array(),
				"description" => __("Check the box to select the categories from which top posts will be displayed.","best-magazine"),
				'section' => 'content_post',
				'tab' => 'homepage',
				'default' => true,
				'customizer' => array()
			),

			"content_post_cat_name" => array(
				"name" => "content_post_cat_name",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Name of top post category","best-magazine"),
				'section' => 'content_post',
				'tab' => 'homepage',
				'default' => '',
				'customizer' => array()
			),

			"content_post_categories" => array(
				"name" => "content_post_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"valid_options" => $this->get_categories(),
				"description" => __("Select the categories.","best-magazine"),
				'section' => 'content_post',
				'tab' => 'homepage',
				'default' => $this->get_categories_ids(),
				'customizer' => array()
			),
			"content_post_order" => array(
				"name" => "content_post_order",
				"title" => "",
				'type' => 'select',
				"sanitize_type" => "sanitize_text_field",
				"valid_options" => array('asc'=>__("Ascending", "best-magazine"), 'desc'=>__("Descending", "best-magazine")),
				"description" => __("Order of posts", "best-magazine"),
				'section' => 'content_post',
				'tab' => 'homepage',
				'default' => array('desc'),
				'customizer'=>array()
			),
			
			"content_post_orderby" => array(
				"name" => "content_post_orderby",
				"title" => "",
				'type' => 'select',
				"sanitize_type" => "sanitize_text_field",
				"valid_options" => array('date'=>__("Date", "best-magazine"), 'name'=>__("Slug", "best-magazine"),'title'=>__("Title", "best-magazine")),
				"description" => __("Order by", "best-magazine"),
				'section' => 'content_post',
				'tab' => 'homepage',
				'default' => array('date'),
				'customizer'=>array()
			),
			"show_thumbnails" => array(
				"name" => "show_thumbnails",
				"title" => __("Show Posts Thumbnails","best-magazine"),
				'type' => 'checkbox',
				"description" => __("Check the box to show posts thumbnails in content posts","best-magazine"),
				'section' => 'content_post',
				'tab' => 'homepage',
				'default' => false,
				'customizer' => array()
			),
		);
	}


	private function get_posts(){
		$args= array(
				'posts_per_page'   => 3000,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				 );

		$posts_array_custom=array();
		$posts_array = get_posts( $args );

		foreach($posts_array as $post){
			$key = $post->ID;
		  $posts_array_custom[$key] = $post->post_title;
		}
		if(empty($posts_array_custom)){
			$posts_array_custom = array('');
    }
		return $posts_array_custom;
	}

	private function get_categories($custom = false){
		$args= array(
				'hide_empty' => 0,
				'orderby' => 'name',
				'order' => 'ASC',
			);
		
		$categories_array_custom=array();
		$categories_array = get_categories( $args );
    if($custom===true){
			$categories_array_custom["random"] = __("Random Posts","best-magazine");
			$categories_array_custom["popular"] = __("Popular Posts","best-magazine");
			$categories_array_custom["recent"] = __("Recent Posts","best-magazine");
		}
		foreach($categories_array as $category){
		  $categories_array_custom[$category->term_id] = $category->name;
		}
		if(empty($categories_array_custom)){
      $categories_array_custom = array('');
    }
		return $categories_array_custom;
	}

	private function get_categories_ids(){
		$args= array(
				'hide_empty' => 0,
				'orderby' => 'name',
				'order' => 'ASC',
			);
		
		$categories_array_custom=array();
		$categories_array = get_categories( $args );
		foreach($categories_array as $category){
		  array_push($categories_array_custom,$category->term_id);
		}
		return $categories_array_custom;
	}

	

}
 