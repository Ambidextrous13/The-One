<?php
/**
 * Template part: Block Pattern: Recent Posts.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

?>
<div class="col-sm-6 col-md-3 col-lg-3">
	<div class="widget_title">
		<h4><span>Recent Posts</span></h4>
	</div>
	<div class="widget_content">
		<ul class="links">

<?php
$local_query = new WP_Query( [ 'showposts' => 4 ] );
echo 'ok stage-1';
if ( $local_query->have_posts() ) {
	while ( $local_query->have_posts() ) {
			$local_query->the_post();
		?>
	<li><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( the_title() ); ?> <span><?php the_time( 'M d, Y' ); ?></span></a></li>

		<?php
	}
}
?>
		</ul>
	</div>
</div>
