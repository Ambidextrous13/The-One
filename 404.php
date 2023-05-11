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
</section>
<?php
	get_footer();
?>
