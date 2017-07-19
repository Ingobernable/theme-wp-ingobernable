<?php
/***
 * Magazine Posts Boxed Widget
 *
 * Display the latest posts from a selected category in a boxed layout. 
 * Intented to be used in the Magazine Homepage widget area to built a magazine layouted page.
 *
 * @package BlackWhite
 */

class Blackwhite_Lite_Magazine_Posts_Lists_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 */
	function __construct() {
		
		// Setup Widget
		parent::__construct(
			'tc-magazine-posts-lists', // ID
			sprintf( esc_html__( 'TC: Magazine Layout', 'blackwhite-lite' ), wp_get_theme()->Name ), // Name
			array( 
				'classname' => 'tc_magazine_posts_lists', 
				'description' => esc_html__( 'Add this widgets to appear this style on magazine template.', 'blackwhite-lite' ),
				'customize_selective_refresh' => true, 
			) // Args
		);

		// Delete Widget Cache on certain actions
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		
	}
	
	
	/**
	 * Set default settings of the widget
	 */
	private function default_settings() {
	
		$defaults = array(
			'title'				=> '',
			'category'			=> 0,
			'layout'			=> 'box-style-vertical',
			'number'			=> 4,
			'meta_date'			=> true,
			'meta_author'		=> false,
		);
		
		return $defaults;
		
	}

	
	/**
	 * Main Function to display the widget
	 * 
	 * @uses this->render()
	 * 
	 * @param array $args / Parameters from widget area created with register_sidebar()
	 * @param array $instance / Settings for this widget instance
	 */
	function widget( $args, $instance ) {

		$cache = array();
				
		// Get Widget Object Cache
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_tc_magazine_posts_lists', 'widget' );
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
		<div class="widget-magazine-posts-lists widget-magazine-posts clearfix">

			<?php // Display Title
			$this->widget_title( $args, $settings ); ?>
			
			<div class="widget-magazine-posts-content">
			
				<?php $this->render( $settings ); ?>
				
			</div>
			
		</div>
	<?php
		echo $args['after_widget'];
		
		// Set Cache
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'widget_tc_magazine_posts_lists', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	
	}
	
	
	/**
	 * Renders the Widget Content
	 *
	 * Switches between horizontal and vertical layout style based on widget settings
	 * 
	 * @uses this->magazine_posts_right_list() or this->magazine_posts_left_list()
	 * @used-by this->widget()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function render( $settings ) {
		
		if( 'right' == $settings['layout'] ) : ?>
		
			<div class="magazine-posts-lists clearfix">
			
				<?php $this->magazine_posts_right_list( $settings ); ?>

			</div>

		<?php elseif ( 'box-style-vertical' == $settings['layout'] ) : ?>
			
			<div class="magazine-posts-boxed-vertical clearfix">

				<?php $this->magazine_posts_box_vertical( $settings ); ?>
			
			</div>		
		
		<?php else: ?>
			
			<div class="magazine-posts-lists clearfix">
			
				<?php $this->magazine_posts_left_list( $settings ); ?>

			</div>
		
		<?php 
		endif;

	}
	
	
	/**
	 * Display Magazine Posts in vertical Layout
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function magazine_posts_right_list( $settings ) {
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => (int) $settings['number'],
			'ignore_sticky_posts' => true,
			'cat' => (int)$settings['category']
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter( 'excerpt_length', 'tc_magazine_posts_excerpt_length' );
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				//if( isset($i) and $i == 0 ) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'right-post list-post clearfix' ); ?>>

						<div class="post-thumbnail">
							<a href="<?php the_permalink() ?>" rel="bookmark">
					 			<?php if ( has_post_thumbnail() ) : ?>

					 				<?php the_post_thumbnail(); ?>

					 			<?php else : ?>

					 				<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured-3col.jpg" />

					 			<?php endif; ?>	
							 </a>
						</div>

						<div class="post-content">
							<header class="entry-header">
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>								

							</header><!-- .entry-header -->
						
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div><!-- .entry-content -->

							<div class="entry-meta">
							
								<?php $this->entry_meta( $settings ); ?>

							</div>
						</div>

					</article>

				<?php
				//endif; 

				$i++;
				
			endwhile; ?>
		
				
			<?php
			// Remove excerpt filter
			remove_filter( 'excerpt_length', 'tc_magazine_posts_excerpt_length' );
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	} // magazine_posts_right_list()
	
	
	/**
	 * Displays Magazine Posts in Vertical Layout
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function magazine_posts_left_list( $settings ) {
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page' => (int) $settings['number'],
			'ignore_sticky_posts' => true,
			'cat' => (int)$settings['category']
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;

		// Check if there are posts
		if( $posts_query->have_posts() ) :
		
			// Limit the number of words for the excerpt
			add_filter( 'excerpt_length', 'tc_magazine_posts_excerpt_length' );
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				//if( isset($i) and $i == 0 ) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'left-post list-post clearfix' ); ?>>

						<div class="post-thumbnail ">
						 	<a href="<?php the_permalink() ?>" rel="bookmark">
						 		<?php if ( has_post_thumbnail() ) : ?>

						 			<?php the_post_thumbnail(); ?>
						 		
						 		<?php else : ?>

						 			<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured-3col.jpg" />

						 		<?php endif; ?>
						 	</a>
						</div>

						<div class="post-content">
							<header class="entry-header">
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>								

							</header><!-- .entry-header -->
						
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div><!-- .entry-content -->

							<div class="entry-meta">
							
								<?php $this->entry_meta( $settings ); ?>

							</div>
						</div>

					</article>



				<?php
				//endif; 

				$i++;
				
			endwhile; ?>
		
				
			<?php
			// Remove excerpt filter
			remove_filter( 'excerpt_length', 'tc_magazine_posts_excerpt_length' );
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	} // magazine_posts_left_list()

		/**
	 * Displays Magazine Posts in Full Thumbnail Layout
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function magazine_posts_box_vertical( $settings ) {
		
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
			add_filter( 'excerpt_length', 'tc_magazine_posts_excerpt_length' );
			
			// Display Posts
			while( $posts_query->have_posts() ) :
				
				$posts_query->the_post(); 
				
				if( isset($i) and $i == 0 ) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'large-post clearfix' ); ?>>

						<div class="post-thumbnail">
							<a href="<?php the_permalink() ?>" rel="bookmark">

								<?php if ( has_post_thumbnail() ) : ?>

									<?php the_post_thumbnail(); ?>

								<?php else : ?>

						 			<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured-3col.jpg" />

						 		<?php endif; ?>

							</a>
						</div>

						<div class="post-content">
							
							<header class="entry-header">

								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					
							</header><!-- .entry-header -->
						
							<div class="entry-content">
								
								<?php the_excerpt(); ?>

							</div><!-- .entry-content -->

							<?php $this->entry_meta( $settings ); ?>

						</div>

					</article>

				<div class="small-posts clearfix">

				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'small-post clearfix' ); ?>>

						<div class="post-thumbnail">
							<a href="<?php the_permalink() ?>" rel="bookmark">
								
								<?php if ( has_post_thumbnail() ) : ?>

									<?php the_post_thumbnail( 'blackwhite-post-related-small' ); ?>

								<?php else : ?>

									<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-related-small.jpg" />

								<?php endif; ?>

							</a>
						</div>
						
						<div class="small-post-content">
							
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>						
							
							<?php $this->entry_meta( $settings ); ?>
							
						</div>

					</article>

				<?php
				endif; $i++;
			endwhile; ?>
			
				</div><!-- end .medium-posts -->
				
			<?php
			// Remove excerpt filter
			remove_filter( 'excerpt_length', 'tc_magazine_posts_excerpt_length' );
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	} // magazine_posts_vertical()
	
	
	/**
	 * Displays Entry Meta of Posts
	 */
	function entry_meta( $settings ) { 

		$postmeta = '';

		if ( true === $settings['meta_author'] ) {

			$postmeta .= blackwhite_lite_meta_author();

		}

		if ( true === $settings['meta_date'] ) {

			$postmeta .= blackwhite_lite_meta_date();

		}

		if ( $postmeta ) {

			echo '<div class="entry-meta">' . $postmeta . '</div>';

		}
	
	} // entry_meta()
	
	
	/**
	 * Displays Widget Title
	 */
	function widget_title( $args, $settings ) {
		
		// Add Widget Title Filter
		$widget_title = apply_filters( 'widget_title', $settings['title'], $settings, $this->id_base );
		
		if( ! empty( $widget_title ) ) :

			// Link Category Title
			if( $settings['category'] > 0 ) : 
			
				// Set Link URL and Title for Category
				$link_title = sprintf( esc_html__( 'View all posts from category %s', 'blackwhite-lite' ), get_cat_name( $settings['category'] ) );
				$link_url = esc_url( get_category_link( $settings['category'] ) );
				
				// Display Widget Title with link to category archive
				echo '<div class="wrap-header">';
				echo '<h3 class="widget-title"><a class="category-archive-link" href="'. $link_url .'" title="'. $link_title . '">'. $widget_title . '</a></h3>';
				echo '</div>';
			
			else:
				
				// Display default Widget Title without link
				echo $args['before_title'] . $widget_title . $args['after_title']; 
			
			endif;
			
		endif;

	} // widget_title()
	
	
	/**
	 * Update Widget Settings
	 *
	 * @param array $new_instance / New Settings for this widget instance
	 * @param array $old_instance / Old Settings for this widget instance
	 * @return array $instance
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['category'] = (int)$new_instance['category'];
		$instance['layout'] = esc_attr($new_instance['layout']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['meta_date'] = !empty($new_instance['meta_date']);
		$instance['meta_author'] = !empty($new_instance['meta_author']);
		
		$this->delete_widget_cache();
		
		return $instance;
	}
	
	
	/**
	 * Displays Widget Settings Form in the Backend
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function form( $instance ) {
	
		// Get Widget Settings
		$settings = wp_parse_args( $instance, $this->default_settings() );
	
		$gl_1 = isset($settings['layout']) && $settings['layout'] === 'box-style-vertical' ? true : false;
		$gl_2 = isset($settings['layout']) && $settings['layout'] === 'left' ? true : false;
		$gl_3 = isset($settings['layout']) && $settings['layout'] === 'right' ? true : false;

	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'blackwhite-lite' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $settings['title']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Category:', 'blackwhite-lite' ); ?></label><br/>
			<?php // Display Category Select
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'blackwhite-lite' ),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $settings['category'],
					'name'               => $this->get_field_name('category'),
					'id'                 => $this->get_field_id('category')
				);
				wp_dropdown_categories( $args ); 
			?>
		</p>

		<!-- <p>
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php esc_html_e( 'Thumbnail Position:', 'blackwhite-lite' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
				<option <?php selected( $settings['layout'], 'box-style-vertical' ); ?> value="box-style-vertical" ><?php esc_html_e( 'Thumbnail on Top', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['layout'], 'left' ); ?> value="left" ><?php esc_html_e( 'Thumbnail on Left', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['layout'], 'right' ); ?> value="right" ><?php esc_html_e( 'Thumbnail on Right', 'blackwhite-lite' ); ?></option>
			</select>
		</p> -->

		<span class="wrap-featured-layout">

			<label class="featured-layout-style">
				<input class="radio" type="radio" name="<?php echo $this->get_field_name( 'layout' ); ?>" value="box-style-vertical" <?php checked($gl_1, 1) ?> />
				<img src="<?php echo get_template_directory_uri(); ?>/images/featured-images/box-style-vertical.png" title="Layout Style One" alt="Layout Style One" /></br>
			</label>

			<label class="featured-layout-style">
				<input id="<?php echo $this->get_field_id( 'layout' ); ?>" class="radio" type="radio" name="<?php echo $this->get_field_name( 'layout' ); ?>" value="left" <?php checked($gl_2, 1) ?> />
				<img src="<?php echo get_template_directory_uri(); ?>/images/featured-images/list-style-two.png" title="Layout Style Two" alt="Layout Style Two" /></br>
			</label>

			<label class="featured-layout-style">
				<input class="radio" type="radio" name="<?php echo $this->get_field_name( 'layout' ); ?>" value="right" <?php checked($gl_3, 1) ?> />
				<img src="<?php echo get_template_directory_uri(); ?>/images/featured-images/list-style-three.png" title="Layout Style Three" alt="Layout Style Three" /></br>
			</label>
		</span>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts:', 'blackwhite-lite' ); ?>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo (int) $settings['number']; ?>" size="3" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'meta_date' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['meta_date'] ) ; ?> id="<?php echo $this->get_field_id( 'meta_date' ); ?>" name="<?php echo $this->get_field_name( 'meta_date' ); ?>" />
				<?php esc_html_e( 'Display post date', 'blackwhite-lite' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'meta_author' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['meta_author'] ) ; ?> id="<?php echo $this->get_field_id( 'meta_author' ); ?>" name="<?php echo $this->get_field_name( 'meta_author' ); ?>" />
				<?php esc_html_e( 'Display post author', 'blackwhite-lite' ); ?>
			</label>
		</p>

<?php
	} // form()
	
	
	/**
	 * Delete Widget Cache
	 */
	public function delete_widget_cache() {
		
		wp_cache_delete( 'widget_tc_magazine_posts_lists', 'widget' );
		
	}
	
}

// Register Widget
add_action( 'widgets_init', 'blackwhite_lite_register_magazine_posts_lists_widget' );

function blackwhite_lite_register_magazine_posts_lists_widget() {

	register_widget( 'Blackwhite_Lite_Magazine_Posts_Lists_Widget' );
	
}