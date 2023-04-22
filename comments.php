<?php
/**
 * Post comment configuration page
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

?>
<div class="news_comments">
	<div class="dividerHeading">
		<h4><span><?php echo esc_html( _n( 'Comment', 'Comments', get_comments_number(), 'the-one' ) . ' (' . get_comments_number() . ')' ); ?></span></h4>
	</div>
	<div id="comment">
		<ul id="comment-list">

<?php
$args = [
	'style'       => 'li',
	'callback'    => 'comment_styler',
	'avatar_size' => 74,

];
wp_list_comments( $args );

/**
 * Callback function for comment form htML style.
 *
 * @param object $comment : comment object.
 * @param array  $args : contains key: value pair for example to set text of reply button use, 'reply_text' => 'text_to_be_appears'. for more args checkout the reference.
 *        @see   https://developer.wordpress.org/reference/functions/get_comment_reply_link/
 * @param int    $depth : maximum allowable nested comments.
 * @return void
 */
function comment_styler( $comment, $args, $depth ) {
	$arg1 = array_merge(
		$args,
		[
			'depth'      => $depth,
			'max_depth'  => $args['max_depth'],
			'reply_text' => 'Reply »',
		]
	);
	?>
	<li class="comment">
		<div class="avatar-wrapper">
			<svg class="avatar">
				<use class="filter-svg" href="#user-tie-svg" />
			</svg>
		</div>
		<div class="comment-container">
			<h4 class="comment-author"> <?php echo esc_html( $comment->comment_author ); ?> </span></h4>
			<div class="comment-meta"><a class="comment-date"> <?php echo esc_html( gmdate( 'M d, Y', strtotime( $comment->comment_date ) ) ); ?> <div class="comment-controls"></a><?php edit_comment_link( 'Edit', '', '<span> | </span>' ); ?><?php comment_reply_link( $arg1, $comment ); ?></div></div>
			<div class="comment-body">
				<p> <?php echo esc_html( $comment->comment_content ); ?> </p>
			</div>
		</div>
	</li>
	<?php
};

?>
</div>

<div class="dividerHeading">
<h4><span><?php esc_html_e( 'Leave a comment', 'the-one' ); ?></span></h4>
</div>
<?php

$commenter = wp_get_current_commenter();
$args      = [
	'fields'        => [
		'author' => sprintf( '<div class="col-sm-4"><input class="col-lg-4 col-md-4 form-control" placeholder="Name *" id="author" name="author" type="text" value="%s" size="30" maxlength="245" autocomplete="name"%s /></div>', esc_attr( $commenter['comment_author'] ), ( $req ? '*' : '' ) ),
		'email'  => sprintf( '<div class="col-sm-4"><input class="col-lg-4 col-md-4 form-control" placeholder="E-mail *" id="email" name="email" type="email" value="%s" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email"%s /></div>', esc_attr( $commenter['comment_author_email'] ), ( $req ? '*' : '' ) ),
		'url'    => sprintf( '<div class="col-sm-4"><input class="col-lg-4 col-md-4 form-control" placeholder="Link to you" id="url" name="url" type="url" value="%s" size="30" maxlength="200" autocomplete="url" /></div>', esc_attr( $commenter['comment_author_url'] ) ),
		'</div>',
	],
	'comment_field' => '</div><div class="comment-box row"><div class="col-sm-12"><p><textarea name="comment" class="form-control" rows="6" cols="40" id="comment" onfocus="if(this.value == \'Message\') { this.value = \'\'; }" onblur="if(this.value == \'\') { this.value = \'Message\'; }" placeholder="Message">Message</textarea></p></div></div>',
	'title_reply'   => '',
	'class_form'    => 'comment_form',
	'class_submit'  => 'btn btn-lg btn-default',

];
comment_form( $args );
?>
