<?php

// Add Category Posts Columns Widget
class Leeway_Category_Posts_Columns_Widget extends WP_Widget {

	function __construct() {
		
		// Setup Widget
		$widget_ops = array(
			'classname' => 'leeway_category_posts_columns', 
			'description' => esc_html__( 'Displays your posts from two selected categories. Please use this widget ONLY in the Magazine Homepage widget area.', 'leeway' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct('leeway_category_posts_columns', sprintf( esc_html__( 'Category Posts: 2 Columns (%s)', 'leeway' ), wp_get_theme()->Name ), $widget_ops);
		
		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}

	public function delete_widget_cache() {
		
		wp_cache_delete('widget_leeway_category_posts_columns', 'widget');
		
	}
	
	private function default_settings() {
	
		$defaults = array(
			'category_one'			=> 0,
			'category_two'			=> 0,
			'category_one_title'	=> '',
			'category_two_title'	=> '',
			'number'				=> 4,
			'highlight_post'		=> true,
			'postmeta'			=> 3
		);
		
		return $defaults;
		
	}
	
	// Display Widget
	function widget( $args, $instance ) {

		$cache = array();
				
		// Get Widget Object Cache
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_leeway_category_posts_columns', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		// Display Widget from Cache if exists
		if ( isset( $cache[ $this->id ] ) ) {
			echo $cache[ $this->id ];
			return;
		}
		
		// Start Output Buffering
		ob_start();
		
		// Get Widget Settings
		$settings = wp_parse_args( $instance, $this->default_settings() );

		// Output
		echo $args['before_widget'];
	?>
		<div id="widget-category-posts-columns" class="widget-category-posts clearfix">
			
			<div class="widget-category-posts-content clearfix">
			
				<?php echo $this->render( $args, $settings ); ?>
				
			</div>

		</div>
	<?php
		echo $args['after_widget'];
		
		// Set Cache
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'widget_leeway_category_posts_columns', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	
	}
	
	// Render Widget Content
	function render( $args, $settings ) {
		
		?>
		
		<div class="category-posts-column-left category-posts-columns clearfix">
				
			<div class="category-posts-columns-content clearfix">
			
				<?php //Display Category Title
					$this->display_category_title( $args, $settings, $settings['category_one'], $settings['category_one_title'] ); ?>
					
				<div class="category-posts-columns-post-list clearfix">
					<?php $this->display_category_posts( $settings, $settings['category_one'] ); ?>
				</div>
				
			</div>
			
		</div>
		
		<div class="category-posts-column-right category-posts-columns clearfix">
		
			<div class="category-posts-columns-content clearfix">
			
				<?php //Display Category Title
					$this->display_category_title( $args, $settings, $settings['category_two'], $settings['category_two_title'] ); ?>
					
				<div class="category-posts-columns-post-list clearfix">
					<?php $this->display_category_posts( $settings, $settings['category_two'] ); ?>
				</div>
				
			</div>
			
		</div>
		
	<?php
	}
	
	// Display Category Posts
	function display_category_posts( $settings, $category_id ) {
	
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => (int)$settings['number'],
			'ignore_sticky_posts' => true,
			'cat' => (int)$category_id
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;
		
		// Limit the number of words for the excerpt
		add_filter('excerpt_length', 'leeway_category_posts_small_excerpt');

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if( $settings['highlight_post'] == true and (isset($i) and $i == 0) ) : 
				
					// Limit the number of words for the excerpt
					add_filter('excerpt_length', 'leeway_category_posts_medium_excerpt');
				?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('large-post clearfix'); ?>>

						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('leeway-category-posts-widget-large'); ?></a>

						<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

						<div class="entry-meta postmeta"><?php $this->display_postmeta( $settings ); ?></div>

						<div class="entry">
							<?php the_excerpt(); ?>
							<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php esc_html_e( 'Read more', 'leeway' ); ?></a>
						</div>

					</article>

				<?php 	
					// Remove excerpt filter
					remove_filter('excerpt_length', 'leeway_category_posts_medium_excerpt');
					
				else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('small-post clearfix'); ?>>

						<?php if ( '' != get_the_post_thumbnail() ) : ?>
							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('leeway-category-posts-widget-small'); ?></a>
						<?php endif; ?>
						
						<div class="small-post-content">
							
							<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<div class="entry-meta-small postmeta-small"><?php $this->display_postmeta( $settings ); ?></div>
							
						</div>

					</article>

				<?php
				endif; $i++;
				
			endwhile; ?>
				
			<?php

		endif;
		
		// Remove excerpt filter
		remove_filter('excerpt_length', 'leeway_category_posts_small_excerpt');
		
		// Reset Postdata
		wp_reset_postdata();
		
	}
	
	// Display Postmeta
	function display_postmeta( $settings ) {
	
		// Display Date unless deactivated
		if ( $settings['postmeta'] > 0 ) :
		
			leeway_meta_date();
					
		endif; 
		
		// Display Author unless deactivated
		if ( $settings['postmeta'] == 2 ) :	
		
			leeway_meta_author();
		
		endif; 
		
		// Display Comments
		if ( $settings['postmeta'] == 3 and comments_open() ) :
			
			leeway_meta_comments();
			
		endif;

	}
	
	// Display Category Widget Title
	function display_category_title( $args, $settings, $category_id, $category_title ) {
		
		// Add Widget Title Filter
		$widget_title = apply_filters('widget_title', $category_title, $settings, $this->id_base);
		
		if( !empty( $widget_title ) ) :
		
			echo $args['before_title'];
			
			// Check if "All Categories" is selected
			if( $category_id == 0 ) :
			
				echo $widget_title;

			else:
			
				$link_title = sprintf( esc_html__( 'View all posts from category %s', 'leeway' ), get_cat_name( $category_id ) );
				$link_url = esc_url( get_category_link( $category_id ) );
				
				echo '<a href="'. $link_url .'" title="'. $link_title . '">'. $widget_title . '</a>';
				echo '<a class="category-archive-link" href="'. $link_url .'" title="'. $link_title . '"><span class="category-archive-icon"></span></a>';
			
			endif;
			
			echo $args['after_title']; 
			
		endif;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['category_one_title'] = sanitize_text_field($new_instance['category_one_title'] );
		$instance['category_one'] = (int)$new_instance['category_one'];
		$instance['category_two_title'] = sanitize_text_field($new_instance['category_two_title'] );
		$instance['category_two'] = (int)$new_instance['category_two'];
		$instance['number'] = (int)$new_instance['number'];
		$instance['highlight_post'] = !empty($new_instance['highlight_post'] );
		$instance['postmeta'] = (int)$new_instance['postmeta'];
		
		$this->delete_widget_cache();
		
		return $instance;
	}

	function form( $instance ) {
		
		// Get Widget Settings
		$settings = wp_parse_args( $instance, $this->default_settings() ); 
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('category_one_title'); ?>"><?php esc_html_e( 'Left Category Title:', 'leeway' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('category_one_title'); ?>" name="<?php echo $this->get_field_name('category_one_title'); ?>" type="text" value="<?php echo $settings['category_one_title']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category_one'); ?>"><?php esc_html_e( 'Left Category:', 'leeway' ); ?></label><br/>
			<?php // Display Category One Select
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'leeway' ),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $settings['category_one'],
					'name'               => $this->get_field_name('category_one'),
					'id'                 => $this->get_field_id('category_one')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>
		
				<p>
			<label for="<?php echo $this->get_field_id('category_two_title'); ?>"><?php esc_html_e( 'Right Category Title:', 'leeway' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('category_two_title'); ?>" name="<?php echo $this->get_field_name('category_two_title'); ?>" type="text" value="<?php echo $settings['category_two_title']; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('category_two'); ?>"><?php esc_html_e( 'Right Category:', 'leeway' ); ?></label><br/>
			<?php // Display Category One Select
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'leeway' ),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $settings['category_two'],
					'name'               => $this->get_field_name('category_two'),
					'id'                 => $this->get_field_id('category_two')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of posts:', 'leeway' ); ?>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo (int)$settings['number']; ?>" size="3" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('highlight_post'); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['highlight_post'] ) ; ?> id="<?php echo $this->get_field_id('highlight_post'); ?>" name="<?php echo $this->get_field_name('highlight_post'); ?>" />
				<?php esc_html_e( 'Highlight first post (big image + excerpt)', 'leeway' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'postmeta' ); ?>"><?php esc_html_e( 'Post Meta:', 'leeway' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id( 'postmeta' ); ?>" name="<?php echo $this->get_field_name( 'postmeta' ); ?>">
				<option value="0" <?php selected( $settings['postmeta'], 0); ?>><?php esc_html_e( 'Hide post meta', 'leeway' ); ?></option>
				<option value="1" <?php selected( $settings['postmeta'], 1); ?>><?php esc_html_e( 'Display post date', 'leeway' ); ?></option>
				<option value="2" <?php selected( $settings['postmeta'], 2); ?>><?php esc_html_e( 'Display date and author', 'leeway' ); ?></option>
				<option value="3" <?php selected( $settings['postmeta'], 3); ?>><?php esc_html_e( 'Display date and comments', 'leeway' ); ?></option>
			</select>
		</p>
		
<?php
	}
}

// Register Widget
add_action( 'widgets_init', 'leeway_register_category_posts_columns_widget' );

function leeway_register_category_posts_columns_widget() {

	register_widget('Leeway_Category_Posts_Columns_Widget');
	
}