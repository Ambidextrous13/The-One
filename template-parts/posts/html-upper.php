<?php
/**
 * Template part: Posts opening handler.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$arg1 = get_the_value( $args, 'div_1_id', '' );
?>

<section class="wrapper">
	<section class="content blog">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-8 col-lg-8">
					<?php  echo wp_kses(
						sprintf( '<div %s class="blog_large">', $arg1 ),
						[
							'div' => [
								'id'    => [],
								'class' => [],
							],
						]
					);
?>
