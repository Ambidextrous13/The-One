<?php
/**
 * Main Theme( The One ).
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

use THE_ONE\Inc\Classes\{ Infinite_Scroll , Settings };

$infi_scroll = get_option( 'the_one_infinite_scroll' );

get_header( null, [ 'header_text' => 'POSTS' ] );
if ( is_home() ) {
	get_template_part( 'template-parts/posts/html', 'upper', $infi_scroll ? [ 'div_1_id' => 'id ="append_here"' ] : [] );

	if ( 'on' === $infi_scroll ) {
		$instance = THE_ONE\Inc\Classes\Infinite_Scroll::get_instance();
		$instance->give_feeds();
	} else {
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( '/template-parts/posts/article' );
			}
			wp_reset_postdata();
		}
	}

	echo '</div>';

	get_template_part( 'template-parts/posts/paginator', null, $infi_scroll ? [ 'retro_reflective_panels' => 'on' ] : [] );
	echo '</div>';
	get_sidebar();
	get_template_part( 'template-parts/posts/html', 'lower' );
} else {
	?>
	<section class="wrapper">
	<section class="content not_found">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-md-12">
					<div style="line-height: 50px; padding: 30px 0px;">
						<h1><?php esc_html_e( 'Maybe it is not fully developed.', 'the-one' ); ?></h1>
						<p><?php esc_html_e( 'Click the below button to go back to home.', 'the-one' ); ?></p>
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
}

get_footer();
