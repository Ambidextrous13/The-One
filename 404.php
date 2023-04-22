<?php
/**
 * Page: 404 not found.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$args = [
	'header_text' => 'Lost in space !!!!',
];
get_header( null, $args );
?>
<section class="wrapper">
	<section class="content not_found">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-md-12">
					<div class="page_404">
						<h1><?php esc_html_e( '404', 'the-one' ); ?></h1>
						<p><?php esc_html_e( 'Sorry, The page you\'re looking for is not found', 'the-one' ); ?></p>
						<a href="<?php echo esc_url( get_home_url() ); ?>" class="btn btn-default btn-lg back_home">
							<i class="fa fa-arrow-circle-o-left"></i>
							<?php esc_html_e( 'Home', 'the-one' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="promo_box">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-9 col-lg-9">
					<div class="promo_content">
						<h3><?php esc_html_e( 'This WordPress theme is developed by Janak Patel.', 'the-one' ); ?></h3>
						<p><?php esc_html_e( 'It is meant to serve learning purpose only', 'the-one' ); ?></p>
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="pb_action">
						<a class="btn btn-lg btn-default" href="<?php echo esc_url( wp_get_attachment_url( 195 ) ); ?>">
							<i class="fa  fa-file-text"></i>
							<?php esc_html_e( '..Resume..', 'the-one' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

</section>
<?php
	get_footer();
?>
