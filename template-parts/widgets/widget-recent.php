<?php
/**
 * Template part: Widget Recent posts.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$posts_;
if ( isset( $GLOBALS['the-one-tabs'] ) && ! empty( $GLOBALS['the-one-tabs'] ) ) {
	if ( isset( $args['checkbox'] ) && 'on' === $args['checkbox'] ) {
		if ( isset( $GLOBALS['the-one-tabs']['pinned_notices'] ) && ! empty( $GLOBALS['the-one-tabs']['pinned_notices'] ) ) {
			$posts_ = $GLOBALS['the-one-tabs']['pinned_notices'];
		}
	} else {
		if ( isset( $GLOBALS['the-one-tabs']['recent'] ) && ! empty( $GLOBALS['the-one-tabs']['recent'] ) ) {
			$posts_ = $GLOBALS['the-one-tabs']['recent'];
		}
	}
} else {
	$pinned_query_args = [
		'showposts'  => 3,
		'meta_query' => [
			[
				'key'     => 't-o-pinned',
				'value'   => 'on',
				'compare' => '=',
			],
		],
	];
	$recent_query_args = [
		'showposts' => 3,
	];
	if ( isset( $args['checkbox'] ) && 'on' === $args['checkbox'] ) {
		$posts_ = new WP_Query( $pinned_query_args );
	} else {
		$posts_ = new WP_Query( $recent_query_args );
	}
}
?>
<div class="widget_content">
	<ul class="links">

<?php
if ( $posts_->have_posts() ) {
	while ( $posts_->have_posts() ) {
		$posts_->the_post();
		?>

		<li> <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( the_title() ); ?><span><?php the_time( 'M d, Y' ); ?></span></a></li>
		<?php
	}
}
?>
	</ul>
</div>
