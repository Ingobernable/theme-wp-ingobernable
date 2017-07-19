<?php

// Add Category Posts Grid Widget
class Leeway_Category_Posts_Grid_Widget extends WP_Widget {

	function __construct() {
		
		// Setup Widget
		$widget_ops = array(
			'classname' => 'leeway_category_posts_grid', 
			'description' => esc_html__( 'Displays your posts from a selected category in a grid layout. Please use this widget ONLY in the Magazine Homepage widget area.', 'leeway' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct('leeway_category_posts_grid', sprintf( esc_html__( 'Category Posts: Grid (%s)', 'leeway' ), wp_get_theme()->Name ), $widget_ops);
		
		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}

	public function delete_widget_cache() {
		
		wp_cache_delete('widget_leeway_category_posts_grid', 'widget');
		
	}
	
	private function default_settings() {
	
		$defaults = array(
			'title'				=> '',
			'category'			=> 0,
			'layout'			=> 'three-columns',
			'number'			=> 6,
			'postmeta'			=> 3
		);
		
		return $defaults;
		
	}
	
	// Display Widget
	function widget( $args, $instance ) {

		$cache = array();
				
		// Get Widget Object Cache
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_leeway_category_posts_grid', 'widget' );
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
		<div id="widget-category-posts-grid" class="widget-category-posts clearfix">
		
			<?php // Display Title
			$this->display_widget_title( $args, $settings ); ?>
			
			<div class="widget-category-posts-content">
			
				<?php $this->render( $settings ); ?>
				
			</div>
			
		</div>
	<?php
		echo $args['after_widget'];
		
		// Set Cache
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'widget_leeway_category_posts_grid', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
		
	}
	
	// Render Widget Content
	function render( $settings ) {
		
		if( $settings['layout'] == 'three-columns' ) :
		
			$this->display_category_posts_three_column_grid( $settings );
		
		else: 
			
			$this->display_category_posts_two_column_grid( $settings );
		
		endif;

	}
	
	// Display Category Posts Grid Two Column
	function display_category_posts_two_column_grid( $settings ) {

		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => (int)$settings['number'],
			'ignore_sticky_posts' => true,
			'cat' => (int)$settings['category']
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;
		
		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter('excerpt_length', 'leeway_category_posts_medium_excerpt');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				// Open new Row on the Grid
				if ( $i % 2 == 0) : $row_open = true; ?>
					<div class="category-posts-grid-row large-post-row clearfix">
				<?php endif; ?>
				
						<article id="post-<?php the_ID(); ?>" <?php post_class('large-post'); ?>>

							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('leeway-category-posts-widget-large'); ?></a>

							<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<div class="entry-meta postmeta"><?php $this->display_postmeta( $settings ); ?></div>

							<div class="entry">
								<?php the_excerpt(); ?>
							</div>

						</article>
		
				<?php // Close Row on the Grid
				if ( $i % 2 == 1) : $row_open = false; ?>
					</div>
				<?php endif; 
				
				$i++;
			endwhile;
			
			// Close Row if still open
			if ( $row_open == true ) : ?>
				</div>
			<?php endif;
			
			// Remove excerpt filter
			remove_filter('excerpt_length', 'leeway_category_posts_medium_excerpt');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();
		
	}
	
	// Display Category Posts Grid Three Column
	function display_category_posts_three_column_grid( $settings ) {

		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => (int)$settings['number'],
			'ignore_sticky_posts' => true,
			'cat' => (int)$settings['category']
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;
		
		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter('excerpt_length', 'leeway_category_posts_medium_excerpt');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				 // Open new Row on the Grid
				 if ( $i % 3 == 0 ) : $row_open = true; ?>
					<div class="category-posts-grid-row medium-post-row clearfix">
				<?php endif; ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('medium-post clearfix'); ?>>

							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('leeway-category-posts-widget-medium'); ?></a>

							<div class="medium-post-content">
								<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<div class="entry-meta-small postmeta-small"><?php $this->display_postmeta( $settings ); ?></div>
							</div>

						</article>
		
				<?php // Close Row on the Grid
				if ( $i % 3 == 2) : $row_open = false; ?>
					</div>
				<?php endif; 
				
				$i++;
			endwhile;
			
			// Close Row if still open
			if ( $row_open == true ) : ?>
				</div>
			<?php endif;
			
			// Remove excerpt filter
			remove_filter('excerpt_length', 'leeway_category_posts_medium_excerpt');
			
		endif;
		
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
	
	// Display Widget Title
	function display_widget_title( $args, $settings ) {
		
		// Add Widget Title Filter
		$widget_title = apply_filters('widget_title', $settings['title'], $settings, $this->id_base);
		
		if( !empty( $widget_title ) ) :
		
			echo $args['before_title'];
					
			// Check if "All Categories" is selected
			if( $settings['category'] == 0 ) :
			
				echo $widget_title;

			else:
			
				$link_title = sprintf( esc_html__( 'View all posts from category %s', 'leeway' ), get_cat_name( $settings['category'] ) );
				$link_url = esc_url( get_category_link( $settings['category'] ) );
				
				echo '<a href="'. $link_url .'" title="'. $link_title . '">'. $widget_title . '</a>';
				echo '<a class="category-archive-link" href="'. $link_url .'" title="'. $link_title . '"><span class="category-archive-icon"></span></a>';
			
			endif;
			
			echo $args['after_title']; 
			
		endif;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title'] );
		$instance['category'] = (int)$new_instance['category'];
		$instance['layout'] = esc_attr($new_instance['layout'] );
		$instance['number'] = (int)$new_instance['number'];
		$instance['postmeta'] = (int)$new_instance['postmeta'];
		
		$this->delete_widget_cache();
		
		return $instance;
	}

	function form( $instance ) {
		
		// Get Widget Settings
		$settings = wp_parse_args( $instance, $this->default_settings() ); 
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'leeway' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $settings['title']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Category:', 'leeway' ); ?></label><br/>
			<?php // Display Category Select
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'leeway' ),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $settings['category'],
					'name'               => $this->get_field_name('category'),
					'id'                 => $this->get_field_id('category')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php esc_html_e( 'Grid Layout:', 'leeway' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
				<option <?php selected( $settings['layout'], 'two-columns' ); ?> value="two-columns" ><?php esc_html_e( 'Two Columns Grid', 'leeway' ); ?></option>
				<option <?php selected( $settings['layout'], 'three-columns' ); ?> value="three-columns" ><?php esc_html_e( 'Three Columns Grid', 'leeway' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of posts:', 'leeway' ); ?>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $settings['number']; ?>" size="3" />
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
add_action( 'widgets_init', 'leeway_register_category_posts_grid_widget' );

function leeway_register_category_posts_grid_widget() {

	register_widget('Leeway_Category_Posts_Grid_Widget');
	
}