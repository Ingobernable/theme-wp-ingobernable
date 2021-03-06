<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Napoli
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

if ( have_comments() ) : ?>

	<div id="comments" class="comments-area">

		<?php if ( have_comments() ) : ?>

			<header class="comments-header">

				<h2 class="comments-title">
					<?php comments_number( '', esc_html__( 'One comment', 'napoli' ), esc_html__( '% comments', 'napoli' ) );?>
				</h2>

			</header><!-- .comment-header -->

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
						'avatar_size' => 56,
					) );
				?>
			</ol><!-- .comment-list -->

			<?php the_comments_navigation(); ?>

		<?php endif; // Check for have_comments(). ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'napoli' ); ?></p>
		<?php endif; ?>

	</div><!-- #comments -->

<?php endif;

if ( comments_open() ) :

	comment_form();

endif;
