<?php
/**
 * Template part: Widget Categories.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

?>
<ul class="arrows_list list_style">
<?php
$number = 5;
if ( isset( $args['max_items'] ) ) {
	$number = $args['max_items'];
}
	$category_list = wp_list_categories(
		[
			'orderby'    => 'count',
			'order'      => 'DSC',
			'show_count' => '1',
			'title_li'   => '',
			'number'     => $number,
		]
	);

	?>
</ul>
