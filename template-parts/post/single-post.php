<?php
/**
 * Template part: Dynamic single post template.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

global $post;

$author_id       = $post->post_author;
$current_post_id = $post->id;

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

<!--start wrapper-->
<section class="wrapper">
	<section class="content blog">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<div class="blog_single">
						<article class="post">
							<div class="post_date">
								<span class="day"><?php the_time( 'd' ); ?></span>
								<span class="month"><?php the_time( 'M' ); ?></span>
							</div>
							<div class="post_content">
								<div class="post_meta">
									<h2>
										<a><?php the_title(); ?></a>
									</h2>
									<div class="metaInfo">
										<span><i class="fa fa-calendar"></i> <a><?php the_time( 'M d, Y' ); ?></a> </span>
										<span><i class="fa fa-user"></i> <?php esc_attr_e( 'By', 'the-one' ); ?> <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php the_author(); ?></a> </span>
										<span><i class="fa fa-tag"></i> <?php the_tags( '', ', ' ); ?> </span>
										<span><i class="fa fa-comments"></i> <a href="#anchor-comments"><?php echo esc_html( get_comments_number() . __( 'Comments', 'the-one' ) ); ?></a></span>
									</div>
								</div>
								<?php
									the_content();
									the_one_post_paginator();
								?>
							</div>


							<ul class="shares">
								<li class="shareslabel"><h3><?php esc_attr_e( 'Share This Story', 'the-one' ); ?></h3></li>
								<?php
								$share_buttons = THE_ONE\Inc\Classes\Settings::give_selected_share_options();
								$button_count  = 0;
								$post_data     = get_post_data_for_share( $current_post_id, $author_id );
								foreach ( $share_buttons as $button => $is_on ) {
									if ( $is_on && 10 > $button_count ) {
										//phpcs:ignore
										echo get_share_button_html( $button, $post_data ); 
										$button_count ++;
									}
								}
								if ( 0 === $button_count ) {
									admin_note( 'Configure Share buttons', 'theme-setting', 'set-id' );
								}

								?>
							</ul>

						</article>
						<div class="about_author">
							<div class="author_desc">
							<svg class="author-svg">
								<use href="#author-svg" />
							</svg>
							<p class="author-text"><?php esc_html_e( 'Author', 'the-one' ); ?></p>
								<ul class="author_social">
									<li><a class="fb" href="#." data-placement="top" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a class="twtr" href="#." data-placement="top" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a class="skype" href="#." data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
							<div class="author_bio">
								<h3 class="author_name"><a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php echo esc_html( ucfirst( get_the_author_meta( 'display_name', $author_id ) ) ); ?></a></h3>
								<h5>CEO at <a href="#">Yahoo Baba</a></h5>
								<p class="author_det">
									Lorem ipsum dolor sit amet, consectetur adip, sed do eiusmod tempor incididunt  ut aut reiciendise voluptat maiores alias consequaturs aut perferendis doloribus omnis saperet docendi nec, eos ea alii molestiae aliquand.
								</p>
							</div>
						</div>
						<div id="anchor-comments"></div>
					</div>

					<?php
						endwhile;
						endif;
						wp_reset_postdata();
						comments_template( '/comments.php' );
?>
				</div>
				<!--Sidebar Widget-->
				<?php get_sidebar(); ?>
			</div><!--/.row-->
		</div> <!--/.container-->

	</section> 
</section>
	<!--end wrapper-->
	<!--start footer-->
