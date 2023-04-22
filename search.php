<?php
/**
 * Main Template file.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$args = [];
if ( ! is_null( get_search_query() ) && ! empty( get_search_query() ) ) {
	$args['header_text'] = strtoupper( get_search_query() );
}
get_header( null, $args );
?>  
<section class="wrapper">
	<section class="content blog">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-8 col-lg-8">
					<div class="blog_large">

					<?php
					if ( is_search() ) {
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								get_template_part( '/template-parts/posts/article' );

								endwhile;
							else :
								echo wp_kses( '<h2>Nothing is found, Try other keywords</h2>', [ 'h2' => [] ] );
								echo wp_kses( '<h4>OR</h4>', [ 'h4' => [] ] );
								echo wp_kses( '<h2>Try something from our sidebar &#10163;</h2>', [ 'h2' => [] ] );
					endif;
							wp_reset_postdata();
					}
					?>

					</div>
					<?php get_template_part( 'template-parts/posts/paginator', null, [ 'retro_reflective_panels' => 'off' ] ); ?>
				</div>
				<?php
				get_sidebar();
				?>
			</div>
		</div>
	</section>
</section>

<?php
	get_footer();
?>
