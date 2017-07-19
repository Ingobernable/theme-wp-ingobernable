<?php
/***
 * Magazine Posts Featured Widget
 *
 * Display the latest posts from a selected category in a featured layout. 
 * Intented to be used in the Magazine Homepage widget area to built a magazine layouted page.
 *
 * @package BlackWhite
 */

class Blackwhite_Lite_Magazine_Posts_featured_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 */
	function __construct() {
		parent::__construct(
			'tc-magazine-posts-featured', // ID
			sprintf( esc_html__( 'TC: Featured Posts', 'blackwhite-lite' ), wp_get_theme()->Name ), // Name
			array( 
				'classname'		=> 'tc_magazine_posts_featured', 
				'description'	=> esc_html__( 'Use this widget to custom display style in featured homepage.', 'blackwhite-lite' ),
				'customize_selective_refresh' => true, 
			) //Args
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
			'layout'			=> 'grid-style-1',
			'order_posts'		=> 'display-latest-posts',
			'slide_number'		=> '6',
			'cats_post'			=> true,
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
			$cache = wp_cache_get( 'widget_tc_magazine_posts_featured', 'widget' );
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
		<div class="widget-magazine-posts-featured widget-magazine-posts clearfix">

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
			wp_cache_set( 'widget_tc_magazine_posts_featured', $cache, 'widget' );
		
		} else {
			
			ob_end_flush();

		}
	}
	
	
	/**
	 * Renders the Widget Content
	 *
	 * Switches between grid-style-1 and vertical layout style based on widget settings
	 * 
	 * @uses
	 *this->magazine_posts_grid-style-1()
	 * @used-by this->widget()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function render( $settings ) {
	?>
		
		<?php if( 'grid-style-1' == $settings['layout'] ) : ?>
		
			<div class="magazine-posts-featured magazine-posts-featured-style-one clearfix">
			
				<?php $this->magazine_posts_grid_style_1( $settings ); ?>

			</div>
		
		<?php else: ?>
		
			<div class="magazine-posts-featured magazine-posts-featured-style-two clearfix">
			
				<?php $this->magazine_posts_grid_style_2( $settings ); ?>

			</div>

		<?php 
		endif;
	}
	
	/**
	 * Display Magazine Posts in Grid Style 1 Layout
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function magazine_posts_grid_style_1( $settings ) {
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page'		=> 5,
			'ignore_sticky_posts'	=> true,
			'cat'					=> (int)$settings['category']
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

									<?php the_post_thumbnail( 'blackwhite-post-featured' ); ?>

								<?php else : ?>

						 			<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured.jpg" />

						 		<?php endif; ?>
						 	</a>
						</div>
						
						<div class="posts-info-container">

							<header class="entry-header">

								<?php $this->posts_categories( $settings ); ?>
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>							
								<?php $this->entry_meta( $settings ); ?>
						
							</header><!-- .entry-header -->
		
						</div>

					</article>

				<div class="medium-posts clearfix">

				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'medium-post clearfix' ); ?>>

						<div class="post-thumbnail">
							<a href="<?php the_permalink() ?>" rel="bookmark">
								<?php if ( has_post_thumbnail() ) : ?>

									<?php the_post_thumbnail(); ?>

								<?php else : ?>

					 				<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured-small.jpg" />

					 			<?php endif; ?>
							</a>
						</div>

						<div class="posts-info-container medium-post-content">
							<header class="entry-header">
			
								<?php $this->posts_categories( $settings ); ?>
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>							
								<?php $this->entry_meta( $settings ); ?>
						
							</header><!-- .entry-header -->
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

	} // magazine_posts_grid-style-1()
	

	/**
	 * Displays Magazine Posts in Grid Style 2 Layout
	 *
	 * @used-by this->render()
	 *
	 * @param array $instance / Settings for this widget instance
	 */
	function magazine_posts_grid_style_2( $settings ) {
		
		// Get latest posts from database
		$query_arguments = array(
			'posts_per_page'		=> 4,
			'ignore_sticky_posts'	=> true,
			'cat'					=> (int)$settings['category']
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
				
				if( isset($i) and $i == 0 ) :
				?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'large-post clearfix' ); ?>>

						<div class="post-thumbnail">
							<a href="<?php the_permalink() ?>" rel="bookmark">
								<?php if ( has_post_thumbnail() ) : ?>

									<?php the_post_thumbnail( 'blackwhite-post-featured' ); ?>

								<?php else : ?>

						 			<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured.jpg" />

						 		<?php endif; ?>
						 	</a>
						</div>
						
						<div class="posts-info-container">
							<header class="entry-header">

								<?php $this->posts_categories( $settings ); ?>
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>							
								<?php $this->entry_meta( $settings ); ?>
						
							</header><!-- .entry-header -->
						</div>

					</article>

				<div class="medium-posts clearfix">

				<?php elseif( isset($i) and $i == 1 ) : ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'full-width-post clearfix' ); ?>>
						<div class="post-thumbnail">
							<a href="<?php the_permalink() ?>" rel="bookmark">
								<?php if ( has_post_thumbnail() ) : ?>

									<?php the_post_thumbnail( 'blackwhite-post-featured-full-width' ); ?>

								<?php else : ?>

					 				<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured-full-width.jpg" />

					 			<?php endif; ?>
							</a>
						</div>

						<div class="posts-info-container medium-post-content">
							<header class="entry-header">
			
								<?php $this->posts_categories( $settings ); ?>
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>							
								<?php $this->entry_meta( $settings ); ?>
						
							</header><!-- .entry-header -->
						</div>

					</article>

				<div class="medium-buttom-posts">
				
				<?php else: ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'medium-post clearfix' ); ?>>
						<div class="post-thumbnail">
							<a href="<?php the_permalink() ?>" rel="bookmark">
								<?php if ( has_post_thumbnail() ) : ?>

									<?php the_post_thumbnail(); ?>

								<?php else : ?>

					 				<img class="wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/blackwhite-post-featured-small.jpg" />

					 			<?php endif; ?>
							</a>
						</div>

						<div class="posts-info-container medium-post-content">
							<header class="entry-header">
			
								<?php $this->posts_categories( $settings ); ?>
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>							
								<?php $this->entry_meta( $settings ); ?>
						
							</header><!-- .entry-header -->
						</div>

					</article>

				<?php
					endif; $i++;
				endwhile;
				?>

					</div>
				</div><!-- end .medium-posts -->
				
			<?php
			// Remove excerpt filter
			remove_filter( 'excerpt_length', 'tc_magazine_posts_excerpt_length' );
			
		endif;
		
		// Reset Postdata
		wp_reset_postdata();

	} // magazine_posts_grid_style_2()

	/**
	 * Displays categories of posts
	 */
	function posts_categories( $settings ) {

		if( true == $settings['cats_post'] ) {
			
			echo '<div class="info-category"><span class="con-cat">';
			blackwhite_lite_primary_category();
			echo '</span></div>';
			
		}
	
	} // posts categories()

	
	/**
	 * Displays Entry Meta of Posts
	 */
	function entry_meta( $settings ) { 

		$postmeta = '';
		
		if( true == $settings['meta_date'] ) {
		
			$postmeta .= blackwhite_lite_meta_date();
			
		}
		
		if( true == $settings['meta_author'] ) {
		
			$postmeta .= blackwhite_lite_meta_author();
			
		}
		
		if( $postmeta ) {
		
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
				echo '<div class="widget-header clearfix">';
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
		$instance['layout']	= esc_attr($new_instance['layout']);
		$instance['order_posts'] = esc_attr($new_instance['order_posts']);
		$instance['cats_post'] = !empty($new_instance['cats_post']);
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
		
		$gl_1 = isset($settings['layout']) && $settings['layout'] === 'grid-style-1' ? true : false;
		$gl_2 = isset($settings['layout']) && $settings['layout'] === 'grid-style-2' ? true : false;
	
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
			<label for="<?php echo $this->get_field_id('layout'); ?>"><?php esc_html_e( 'Display Style:', 'blackwhite-lite' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
				<option <?php selected( $settings['layout'], 'grid-style-1' ); ?> value="grid-style-1" ><?php esc_html_e( 'Grid Style 1', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['layout'], 'grid-style-2' ); ?> value="grid-style-2" ><?php esc_html_e( 'Grid Style 2', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['layout'], 'grid-style-3' ); ?> value="grid-style-3" ><?php esc_html_e( 'Grid Style 3', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['layout'], 'grid-style-4' ); ?> value="grid-style-4" ><?php esc_html_e( 'Grid Style 4', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['layout'], 'grid-style-5' ); ?> value="grid-style-5" ><?php esc_html_e( 'Grid Style 5', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['layout'], 'grid-style-6' ); ?> value="grid-style-6" ><?php esc_html_e( 'Grid Style 6', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['layout'], 'grid-style-7' ); ?> value="grid-style-7" ><?php esc_html_e( 'Grid Style 7', 'blackwhite-lite' ); ?></option>
			</select>
		</p> -->

		<span class="wrap-featured-layout">
			
			<label class="featured-layout-style">
				<input class="radio" type="radio" name="<?php echo $this->get_field_name( 'layout' ); ?>" <?php checked($gl_1, 1) ?> value="grid-style-1" />
				<img src="<?php echo get_template_directory_uri(); ?>/images/featured-images/featured-style-1.png" title="Featured Style One" alt="Featured Style One" /></br>
			</label>

			<label class="featured-layout-style">
				<input class="radio" type="radio" name="<?php echo $this->get_field_name( 'layout' ); ?>" <?php checked($gl_2, 1) ?> value="grid-style-2" />
				<img src="<?php echo get_template_directory_uri(); ?>/images/featured-images/featured-style-2.png" title="Featured Style Two" alt="Featured Style Two" /></br>
			</label>

		</span>

		<p>
			<label for="<?php echo $this->get_field_id('order_posts'); ?>"><?php esc_html_e( 'Order Posts:', 'blackwhite-lite' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id('order_posts'); ?>" name="<?php echo $this->get_field_name('order_posts'); ?>">
				<option <?php selected( $settings['order_posts'], 'display-latest-posts' ); ?> value="display-latest-posts" ><?php esc_html_e( 'Latest Posts', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['order_posts'], 'display-oldest-posts' ); ?> value="display-latest-posts" ><?php esc_html_e( 'Oldest Posts', 'blackwhite-lite' ); ?></option>
				<option <?php selected( $settings['order_posts'], 'display-random-posts' ); ?> value="display-latest-posts" ><?php esc_html_e( 'Random Posts', 'blackwhite-lite' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cats_post' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['cats_post'] ) ; ?> id="<?php echo $this->get_field_id( 'cats_post' ); ?>" name="<?php echo $this->get_field_name( 'cats_post' ); ?>" />
				<?php esc_html_e( 'Display categories', 'blackwhite-lite' ); ?>
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
		
		wp_cache_delete( 'widget_tc_magazine_posts_featured', 'widget' );
		
	}
}

// Register Widget
add_action( 'widgets_init', 'blackwhite_lite_register_magazine_posts_featured_widget' );

function blackwhite_lite_register_magazine_posts_featured_widget() {

	register_widget( 'Blackwhite_Lite_Magazine_Posts_featured_Widget' );
	
}