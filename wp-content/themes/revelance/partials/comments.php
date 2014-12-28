<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ABdev_comment().
 *
 */
 
 
 function ABdev_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'ABdev_revelance' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'ABdev_revelance' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
			break;
		default :
			?>
			<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID(); ?>">
				<?php
				$avatar_size = 70;
				if ( '0' != $comment->comment_parent ){
					$avatar_size = 70;
				}

				echo get_avatar( $comment, $avatar_size );
				
				
				?>

				<div class="comment-text">

				<?php
				/* translators: 1: comment author, 2: date and time */
				printf( __( '%1$s  %2$s', 'ABdev_revelance' ),
					sprintf( '<p class="comment-author">%s</p>', get_comment_author_link() ),
					sprintf( 'on <time pubdate datetime="%2$s">%3$s</time>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'ABdev_revelance' ), get_comment_date(), get_comment_time() )
					)
				);
				?>

				<p class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'ABdev_revelance' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</p><!-- .reply -->

				<?php edit_comment_link( __( 'Edit', 'ABdev_revelance' ), '<span class="edit-link">', '</span>' ); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ABdev_revelance' ); ?></em>
					<br />
				<?php else: ?>
				<?php comment_text(); ?>
				<?php endif; ?>
				</div>

			<?php
			break;
		endswitch;
}


?>
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'ABdev_revelance' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title"><?php printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'ABdev_revelance' ), number_format_i18n( get_comments_number() ) );?></h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'ABdev_revelance' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ABdev_revelance' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ABdev_revelance' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use ABdev_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define ABdev_comment() and that will be used instead.
				 * See ABdev_comment() in twentyeleven/functions.php for more.
				 */
				 
				wp_list_comments( array( 'callback' => 'ABdev_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'ABdev_revelance' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ABdev_revelance' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ABdev_revelance' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'ABdev_revelance' ); ?></p>
	<?php endif; ?>

	<?php 

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
	  'author' =>
	    '<div class="comment_fields"><p class="comment-form-author"><input id="author" name="author" type="text" placeholder="' . __( 'Name*', 'ABdev_revelance' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
	    '" size="30"' . $aria_req . ' /></p>',
	  'email' =>
	    '<p class="comment-form-email"><input id="email" name="email" type="text" placeholder="' . __( 'E-mail*', 'ABdev_revelance' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
	    '" size="30"' . $aria_req . ' /></p>',
	  'url' =>
	    '<p class="comment-form-url"><input id="url" name="url" type="text" placeholder="' . __( 'Website', 'ABdev_revelance' ) . '" value="' . esc_attr(  $commenter['comment_author_url'] ) .
	    '" size="30"' . $aria_req . ' /></p></div>',
	);

	$comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . __( 'Your Comment', 'ABdev_revelance' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';

	comment_form(array(
		'fields' => $fields,
		'comment_field' => $comment_field,
		'comment_notes_after' => '',
		'id_submit' => 'comment-submit',
		'title_reply' => __( 'Leave a comment', 'ABdev_revelance' ),
	)); ?>

	<div class="clear"></div>

</div><!-- #comments -->
