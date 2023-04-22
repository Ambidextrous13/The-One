<?php
/**
 * Template part: Widget mini Tabs.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$tab_1 = 'Pinned Notices';
$tab_2 = 'Recent';
if ( isset( $args['tab-1'] ) ) {
	$tab_1 = $args['tab-1'];
}

if ( isset( $args['tab-2'] ) ) {
	$tab_2 = $args['tab-2'];
}

$tabs_ = [
	'pinned_notices' => [
		'name'         => $tab_1,
		'query_params' => [
			'showposts'  => 3,
			'meta_query' => [
				[
					'key'     => 't-o-pinned',
					'value'   => 'on',
					'compare' => '=',
				],
			],
		],
	],
	'recent'         => [
		'name'         => $tab_2,
		'query_params' => [
			'showposts' => 3,
		],
	],
];
?>

<div class="ProBusiness-tab sidebar-tab">
	<ul class="nav nav-tabs">
		<?php
			$is_first_iteration = true;
		foreach ( $tabs_ as $tab_ => $params ) {
			$class = '';
			if ( $is_first_iteration ) {
				$class = 'active';

				$is_first_iteration = false;
			}
			printf( '<li class="%1$s"><a href="#%2$s" data-toggle="tab">%3$s</a></li>', esc_attr( $class ), esc_attr( $tab_ ), esc_html( $params['name'] ) );
		}
		?>
	</ul>
	<div class="tab-content clearfix">

<?php
	$is_first_iteration = true;
foreach ( $tabs_ as $tab_ => $params ) {
	$pinned_posts = new WP_Query( $params['query_params'] );

	$GLOBALS['the-one-tabs'][ $tab_ ] = $pinned_posts;

	$class = '';
	if ( $is_first_iteration ) {
		$class = 'active in';

		$is_first_iteration = false;
	}
	?>
		<div class="tab-pane fade <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $tab_ ); ?>">
			<ul class="recent_tab_list">

	<?php
	if ( $pinned_posts->have_posts() ) :
		while ( $pinned_posts->have_posts() ) :
			$pinned_posts->the_post();

			?>

				<li>
					<span><a href="<?php echo esc_url( get_the_permalink() ); ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="" height="50" width="50"></a></span>
					<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( the_title() ); ?></a>
					<i><?php the_time( 'M d, Y' ); ?></i>
				</li>

				<?php
			endwhile;
		else :
			echo '<p>No posts found.</p>';
		endif;
		wp_reset_postdata();
		?>

			</ul>
		</div>

	<?php
};
?>

	</div>
</div>
