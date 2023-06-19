<?php
/**
 * Template part: Posts pagination handler.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$retro_reflective_panels_activation = 'on' === the_one_get_the_value( $args, 'retro_reflective_panels' ) ? 'hidden' : '';
echo wp_kses(
	sprintf( '<div class="col-lg-12 col-md-12 col-sm-12 %s">', $retro_reflective_panels_activation ),
	[
		'div' => [
			'class' => [],
		],
	]
);
?>

	<ul class="pagination pull-left mrgt-0">

	<?php
	$arg = [
		'type' => 'array',
	];

	$posts_pagination = paginate_links( $arg );

	$aoao = false; // AOAO is active only appears once.
	if ( ! empty( $posts_pagination ) ) {
		foreach ( $posts_pagination as $index => $link_ ) {
			$class = '';
			if ( substr_count( $link_, '<span', 0, 5 ) === 1 && ! $aoao ) {
				$class = ' class="active"';
				$aoao  = true;
			}
			echo wp_kses(
				sprintf( '<li%1$s>%2$s</li>', $class, $link_ ),
				[
					'li'   => [
						'class' => [],
					],
					'span' => [
						'aria-current' => [],
						'class'        => [],
					],
					'a'    => [
						'class' => [],
						'href'  => [],
					],
				]
			);
		}
	}
	?>

	</ul>
</div>
