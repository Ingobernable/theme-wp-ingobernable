<?php

// Add Category Posts Boxed Widget
class Glades_Category_Posts_Boxed_Widget extends WP_Widget {

	function __construct() {
		
		// Setup Widget
		$widget_ops = array(
			'classname' => 'glades_category_posts_boxed', 
			'description' => esc_html__( 'Displays your posts from a selected category in a boxed layout. Please use this widget ONLY in the Magazine Homepage widget area.', 'glades' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct('glades_category_posts_boxed', sprintf( esc_html__( 'Category Posts: Boxed (%s)', 'glades' ), wp_get_theme()->Name ), $widget_ops);
		
		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}

	public function delete_widget_cache() {
		
		wp_cache_delete('widget_glades_category_posts_boxed', 'widget');
		
	}
	
	private function default_settings() {
	
		$defaults = array(
			'title'				=> '',
			'category'			=> 0,
			'layout'			=> 'horizontal',
			'postmeta'			=> 3
		);
		
		return $defaults;
		
	}
	
	// Display Widget
	function widget( $args, $instance ) {

		$cache = array();
				
		// Get Widget Object Cache
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_glades_category_posts_boxed', 'widget' );
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
		<div id="widget-category-posts-boxed" class="widget-category-posts clearfix">

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
			wp_cache_set( 'widget_glades_category_posts_boxed', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	
	}
	
	// Render Widget Content
	function render( $settings ) {
		
		if( $settings['layout'] == 'horizontal' ) : ?>
		
			<div class="category-posts-boxed-horizontal clearfix">
			
				<?php $this->display_category_posts_horizontal( $settings ); ?>

			</div>
		
		<?php else: ?>
			
			<div class="category-posts-boxed-vertical clearfix">
			
				<?php $this->display_category_posts_vertical( $settings ); ?>

			</div>
		
		<?php 
		endif;

	}
	
	// Display Category Posts in Horizontal Layout
	function display_category_posts_horizontal( $settings ) {
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => 4,
			'ignore_sticky_posts' => true,
			'cat' => (int)$settings['category']
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter('excerpt_length', 'glades_category_posts_medium_excerpt');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if(isset($i) and $i == 0) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('large-post clearfix'); ?>>

						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('glades-category-posts-widget-extra-large'); ?></a>
						
						<div class="post-content">

							<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<?php $this->display_postmeta( $settings ); ?>

							<div class="entry">
								<?php the_excerpt(); ?>
								<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php esc_html_e( 'Continue reading &raquo;', 'glades' ); ?></a>
							</div>
							
						</div>

					</article>

				<div class="medium-posts clearfix">

				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('medium-post clearfix'); ?>>

						<div class="medium-post-image">

							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('glades-category-posts-widget-medium'); ?></a>
							
						</div>

						<div class="medium-post-content">
							
							<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							
							<?php $this->display_postmeta( $settings ); ?>
						
						</div>

					</article>

				<?php
				endif; $i++;
				
			endwhile; ?>
			
				</div><!-- end .medium-posts -->
				
			<?php
			// Remove excerpt filter
			remove_filter('excerpt_length', 'glades_category_posts_medium_excerpt');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	}
	
	// Display Category Posts in Vertical Layout
	function display_category_posts_vertical( $settings ) {
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => 5,
			'ignore_sticky_posts' => true,
			'cat' => (int)$settings['category']
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter('excerpt_length', 'glades_category_posts_medium_excerpt');
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if(isset($i) and $i == 0) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('large-post clearfix'); ?>>

						<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('glades-category-posts-widget-large'); ?></a>
						
						<div class="post-content">

							<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<?php $this->display_postmeta( $settings ); ?>

							<div class="entry">
								<?php the_excerpt(); ?>
								<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php esc_html_e( 'Continue reading &raquo;', 'glades' ); ?></a>
							</div>
							
						</div>

					</article>

				<div class="small-posts clearfix">

				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('small-post clearfix'); ?>>

						<div class="small-post-image">

							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('glades-category-posts-widget-small'); ?></a>
					
						</div>

						<div class="small-post-content">
							
							<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							
							<?php $this->display_postmeta( $settings ); ?>
						
						</div>

					</article>

				<?php
				endif; $i++;
				
			endwhile; ?>
			
				</div><!-- end .medium-posts -->
				
			<?php
			// Remove excerpt filter
			remove_filter('excerpt_length', 'glades_category_posts_medium_excerpt');
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	}
	
	// Display Postmeta
	function display_postmeta( $settings ) {
	
		// Start Output Buffering
		ob_start();
		
		// Display Date unless deactivated
		if ( $settings['postmeta'] > 0 ) :
		
			glades_meta_date();
					
		endif; 
		
		// Display Author unless deactivated
		if ( $settings['postmeta'] == 2 ) :	
		
			glades_meta_author();
		
		endif; 
		
		// Display Comments
		if ( $settings['postmeta'] == 3 and comments_open() ) :
			
			glades_meta_comments();
			
		endif;
		
		// Save Output Buffer
		$meta_output = ob_get_contents();
		
		// Delete Buffer
		ob_end_clean();
		
		// Only display output if there is postmeta
		if ( $meta_output <> false ) :
		
			echo '<div class="entry-meta postmeta">' . $meta_output . '</div>';
		
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
			
				$link_title = sprintf( esc_html__( 'View all posts from category %s', 'glades' ), get_cat_name( $settings['category'] ) );
				$link_url = esc_url( get_category_link( $settings['category'] ) );
				
				echo '<a href="'. $link_url .'" title="'. $link_title . '">'. $widget_title . '</a>';
			
			endif;
			
			echo $args['after_title']; 
			
		endif;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title'] );
		$instance['category'] = (int)$new_instance['category'];
		$instance['layout'] = esc_attr($new_instance['layout'] );
		$instance['postmeta'] = (int)$new_instance['postmeta'];
		
		$this->delete_widget_cache();
		
		return $instance;
	}

	function form( $instance ) {
		
		// Get Widget Settings
		$settings = wp_parse_args( $instance, $this->default_settings() ); 
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'glades' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $settings['title']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Category:', 'glades' ); ?></label><br/>
			<?php // Display Category Select
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'glades' ),
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
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php esc_html_e( 'Post Layout:', 'glades' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
				<option <?php selected( $settings['layout'], 'horizontal' ); ?> value="horizontal" ><?php esc_html_e( 'Horizontal Arrangement', 'glades' ); ?></option>
				<option <?php selected( $settings['layout'], 'vertical' ); ?> value="vertical" ><?php esc_html_e( 'Vertical Arrangement', 'glades' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'postmeta' ); ?>"><?php esc_html_e( 'Post Meta:', 'glades' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id( 'postmeta' ); ?>" name="<?php echo $this->get_field_name( 'postmeta' ); ?>">
				<option value="0" <?php selected( $settings['postmeta'], 0); ?>><?php esc_html_e( 'Hide post meta', 'glades' ); ?></option>
				<option value="1" <?php selected( $settings['postmeta'], 1); ?>><?php esc_html_e( 'Display post date', 'glades' ); ?></option>
				<option value="2" <?php selected( $settings['postmeta'], 2); ?>><?php esc_html_e( 'Display date and author', 'glades' ); ?></option>
				<option value="3" <?php selected( $settings['postmeta'], 3); ?>><?php esc_html_e( 'Display date and comments', 'glades' ); ?></option>
			</select>
		</p>
		
<?php
	}
}

// Register Widget
add_action( 'widgets_init', 'glades_register_category_posts_boxed_widget' );

function glades_register_category_posts_boxed_widget() {

	register_widget('Glades_Category_Posts_Boxed_Widget');
	
}