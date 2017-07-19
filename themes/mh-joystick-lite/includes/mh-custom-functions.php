<?php

/***** Logo/Sitename *****/

if (!function_exists('mh_joystick_lite_logo')) {
	function mh_joystick_lite_logo() {
		$header_img = get_header_image();
		$header_title = get_bloginfo('name');
		$header_desc = get_bloginfo('description');
		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr($header_title) . '" rel="home">' . "\n";
			echo '<div class="logo-wrap" role="banner">' . "\n";
				if ($header_img) {
					echo '<img src="' . esc_url($header_img) . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="' . esc_attr($header_title) . '" />' . "\n";
				}
				if (display_header_text()) {
					$text_color = get_header_textcolor();
					if ($text_color != get_theme_support('custom-header', 'default-text-color')) {
						echo '<style type="text/css" id="mh-joystick-header-css">';
							echo '.logo-title, .logo-tagline { color: #' . esc_attr($text_color) . '; }';
						echo '</style>' . "\n";
					}
					echo '<div class="logo">' . "\n";
						if ($header_title) {
							echo '<h1 class="logo-title">' . esc_attr($header_title) . '</h1>' . "\n";
						}
						if ($header_desc) {
							echo '<h2 class="logo-tagline">' . esc_attr($header_desc) . '</h2>' . "\n";
						}
					echo '</div>' . "\n";
				}
			echo '</div>' . "\n";
		echo '</a>' . "\n";
	}
}

/***** Page Title Output *****/

if (!function_exists('mh_joystick_lite_page_title')) {
	function mh_joystick_lite_page_title() {
		if (!is_front_page()) {
			echo '<h1 class="archive-title">';
				if (is_archive()) {
					if (is_category() || is_tax()) {
						single_cat_title();
					} elseif (is_tag()) {
						single_tag_title();
					} elseif (is_author()) {
						global $author;
						$user_info = get_userdata($author);
						printf(_x('Articles by %s', 'post author', 'mh-joystick-lite'), esc_attr($user_info->display_name));
					} elseif (is_day()) {
						echo get_the_date();
					} elseif (is_month()) {
						echo get_the_date('F Y');
					} elseif (is_year()) {
						echo get_the_date('Y');
					} elseif (is_post_type_archive()) {
						global $post;
						$post_type = get_post_type_object(get_post_type($post));
						echo $post_type->labels->name;
					} else {
						_e('Archives', 'mh-joystick-lite');
					}
				} else {
					if (is_home()) {
						echo get_the_title(get_option('page_for_posts', true));
					} elseif (is_404()) {
						_e('Page not found (404 Error)', 'mh-joystick-lite');
					} elseif (is_search()) {
						printf(__('Search Results: %s', 'mh-joystick-lite'), esc_attr(get_search_query()));
					} else {
						the_title();
					}
				}
			echo '</h1>' . "\n";
		}
	}
}

/***** Output Post Tags *****/

if (!function_exists('mh_joystick_lite_post_tags')) {
	function mh_joystick_lite_post_tags() {
		the_tags('<div class="entry-tags"><span class="tag-title">' . __('Topics', 'mh-joystick-lite') . '</span>','','</div>');
	}
}

/***** Output Post Meta *****/

if (!function_exists('mh_joystick_lite_post_meta')) {
	function mh_joystick_lite_post_meta() {
		echo '<p class="entry-meta">' . "\n";
			echo '<span class="entry-meta-date updated"><i class="fa fa-clock-o"></i>' . get_the_date() . '</span>';
			echo '<span class="entry-meta-author vcard"><i class="fa fa-user"></i><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>';
			echo '<span class="entry-meta-comments"><i class="fa fa-comment"></i>' . sprintf(_nx('1 Comment', '%1$s Comments', get_comments_number(), 'comments number', 'mh-joystick-lite'), number_format_i18n(get_comments_number())) . '</span>';
		echo '</p>' . "\n";
	}
}

/***** Output Post Category *****/

if (!function_exists('mh_joystick_lite_post_category')) {
	function mh_joystick_lite_post_category() {
		echo '<p class="entry-category">' . "\n";
			echo '<span class="entry-category-title">' . __('Categories', 'mh-joystick-lite') . '</span>';
			echo get_the_category_list(' ', '');
		echo '</p>' . "\n";
	}
}

/***** Featured Image *****/

if (!function_exists('mh_joystick_lite_featured_image')) {
	function mh_joystick_lite_featured_image() {
		global $page, $post;
		if (has_post_thumbnail() && $page == '1') {
			$caption_text = get_post(get_post_thumbnail_id())->post_excerpt;
			echo "\n" . '<div class="entry-thumbnail">' . "\n";
				the_post_thumbnail('mh-joystick-lite-slider');
				if ($caption_text) {
					echo '<span class="wp-caption-text">' . wp_kses_post($caption_text) . '</span>' . "\n";
				}
			echo '</div>' . "\n";
		}
	}
}

/***** Custom Excerpts *****/

if (!function_exists('mh_joystick_lite_trim_excerpt')) {
	function mh_joystick_lite_trim_excerpt($text = '') {
		$raw_excerpt = $text;
		if ('' == $text) {
			$mh_joystick_lite_options = mh_joystick_lite_theme_options();
			$text = get_the_content('');
			$text = strip_shortcodes($text);
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$excerpt_length = apply_filters('excerpt_length', absint($mh_joystick_lite_options['excerpt_length']));
			$excerpt_more = apply_filters('excerpt_more', '...');
			$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mh_joystick_lite_trim_excerpt');

/***** Pagination *****/

if (!function_exists('mh_joystick_lite_pagination')) {
	function mh_joystick_lite_pagination() {
		global $wp_query;
	    $big = 9999;
	    $paginate_links = paginate_links(array(
	    	'base' 		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	    	'format' 	=> '?paged=%#%',
	    	'current' 	=> max(1, get_query_var('paged')),
	    	'prev_next' => true,
	    	'prev_text' => __('&laquo;', 'mh-joystick-lite'),
	    	'next_text' => __('&raquo;', 'mh-joystick-lite'),
	    	'total' 	=> $wp_query->max_num_pages
	    ));
	    if ($paginate_links) {
	    	echo '<div class="pagination">' . $paginate_links . '</div>';
		}
	}
}

/***** Post / Image Navigation *****/

if (!function_exists('mh_joystick_lite_postnav')) {
	function mh_joystick_lite_postnav() {
		global $post;
		$parent_post = get_post($post->post_parent);
		$attachment = is_attachment();
		$previous = ($attachment) ? $parent_post : get_adjacent_post(false, '', true);
		$next = get_adjacent_post(false, '', false);

		if (!$next && !$previous)
		return;

		if ($attachment) {
			$attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $parent_post->ID));
			$count = count($attachments);
		}
		echo '<nav class="post-nav-wrap" role="navigation">' . "\n";
			echo '<ul class="post-nav clearfix">' . "\n";
				if ($previous || $attachment) {
					echo '<li class="post-nav-prev">' . "\n";
						if ($attachment) {
							if ($count == 1) {
								$permalink = get_permalink($parent_post);
								echo '<a href="' . $permalink . '"><i class="fa fa-chevron-left"></i>' . __('Back to post', 'mh-joystick-lite') . '</a>';
							} else {
								previous_image_link('%link', '<i class="fa fa-chevron-left"></i>' . __('Previous image', 'mh-joystick-lite'));
							}
						} else {
							previous_post_link('%link', '<i class="fa fa-chevron-left"></i>' . __('Previous post', 'mh-joystick-lite'));
						}
					echo '</li>' . "\n";
				}
				if ($next || $attachment) {
					echo '<li class="post-nav-next">' . "\n";
						if ($attachment) {
							next_image_link('%link', __('Next image', 'mh-joystick-lite') . '<i class="fa fa-chevron-right"></i>');
						} else {
							next_post_link('%link', __('Next post', 'mh-joystick-lite') . '<i class="fa fa-chevron-right"></i>');
						}
					echo '</li>' . "\n";
				}
			echo '</ul>' . "\n";
		echo '</nav>' . "\n";
	}
}

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_joystick_lite_posts_pagination')) {
	function mh_joystick_lite_posts_pagination($content) {
		if (is_singular() && is_main_query()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination clear">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => __('&raquo;', 'mh-joystick-lite'), 'previouspagelink' => __('&laquo;', 'mh-joystick-lite'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_joystick_lite_posts_pagination', 1);

/***** Custom Commentlist *****/

if (!function_exists('mh_joystick_lite_comments')) {
	function mh_joystick_lite_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="vcard meta"><?php
					echo get_avatar($comment->comment_author_email, 50);
					echo '<span class="fn">' . get_comment_author_link() . '</span>' . "\n"; ?>
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s @ %2$s', 'mh-joystick-lite'), get_comment_date(),  get_comment_time()) ?></a>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="comment-info">
						<?php _e('Your comment is awaiting moderation.', 'mh-joystick-lite') ?>
					</div>
				<?php endif; ?>
				<div class="comment-text">
					<?php comment_text() ?>
				</div>
				<div class="comment-footer clearfix">
					<span class="comment-footer-meta"><?php
						if (comments_open() && $args['max_depth']!=$depth) {
							comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
						}
						edit_comment_link(__('Edit', 'mh-joystick-lite'),'  ',''); ?>
					</span>
				</div>
			</div><?php
	}
}

/***** Custom Comment Fields *****/

if (!function_exists('mh_joystick_lite_comment_fields')) {
	function mh_joystick_lite_comment_fields($fields) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . __('Name ', 'mh-joystick-lite') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . __('Email ', 'mh-joystick-lite') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . __('Website', 'mh-joystick-lite') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
		);
		return $fields;
	}
}
add_filter('comment_form_default_fields', 'mh_joystick_lite_comment_fields');

/***** Author Box *****/

if (!function_exists('mh_joystick_lite_authorbox')) {
	function mh_joystick_lite_authorbox() {
		$author_ID = get_the_author_meta('ID');
		if (!is_attachment() && get_the_author_meta('description', $author_ID)) { ?>
        	<div class="author-box">
                <h6 class="author-box-title">
                	<?php _e('About the author', 'mh-joystick-lite'); ?>
                </h6>
                <div class="mh-row clearfix author-box-content">
                	<div class="mh-col-1-5">
                		<div class="author-box-avatar">
                			<a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>">
                				<?php echo get_avatar($author_ID, 160); ?>
                			</a>
                		</div>
                	</div>
                	<div class="mh-col-4-5">
                		<h3 class="author-box-name">
                			<?php echo esc_attr(get_the_author_meta('display_name', $author_ID)); ?>
                		</h3>
                		<div class="author-box-desc">
                			<?php echo wp_kses_post(get_the_author_meta('description', $author_ID)); ?>
                		</div>
                		<div class="author-box-button">
                			<a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>">
                				<?php printf(__('More Posts (%s)', 'mh-joystick-lite'), get_the_author_posts()); ?>
                			</a>
                		</div>
                	</div>
                </div>
			</div><?php
		}
	}
}

/***** Add Custom CSS Classes to Body Tag *****/

if (!function_exists('mh_joystick_lite_body_class')) {
	function mh_joystick_lite_body_class($classes) {
		$mh_joystick_lite_options = mh_joystick_lite_theme_options();
		$classes[] = 'mh-' . esc_attr($mh_joystick_lite_options['sidebar']) . '-sb';
		if (get_header_image() && display_header_text()) {
			$classes[] = 'mh-textlogo';
		}
		return $classes;
	}
}
add_filter('body_class', 'mh_joystick_lite_body_class');

/***** Add CSS3 Media Queries Support for older versions of IE *****/

function mh_joystick_lite_media_queries() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'mh_joystick_lite_media_queries');

?>