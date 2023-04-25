<?php
/**
 * Generic footer File
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

get_sidebar( 'footer' );

$copyright_text = get_option( 'the_one_copyright_text', '' );
?>
<section class="footer_bottom">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<p class="copyright">
					<?php
					if ( $copyright_text ) {
						echo esc_html( $copyright_text );
					} else {
						admin_note( 'Add copyright Text here', 'theme-settings', '.copyright_text' );
					}
					?>
				</p>
			</div>
			<div class="col-sm-6">
				<div class="footer_social">
					<ul class="footbot_social">
						<?php
						get_template_part( 'template-parts/footer/footer', 'social-media' );
						global $social_media_counts;
						if ( 0 === $social_media_counts ) {
							admin_note( 'Your Social Media goes here', 'theme-settings', '.social_media_facebook' );
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
	get_template_part( 'template-parts/footer/footer', 'svgs' );
	wp_footer();
?>
</body>
</html>
