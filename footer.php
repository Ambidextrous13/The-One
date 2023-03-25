<?php
/**
 * Generic footer File
 * 
 * @package The-One 
 * @author Janak Patel <pateljanak830@gmail.com>
 */
get_sidebar( 'footer' );

$link_1  = get_option( 'social_media_facebook', '' );
$link_2  = get_option( 'social_media_twitter', '' );
$link_3  = get_option( 'social_media_instagram', '' );
$link_4  = get_option( 'social_media_skype', '' );
$link_5  = get_option( 'social_media_linkedin', '' ); // instagram linkedin github wordpress custom
?>

	<!--end footer-->
	
	<section class="footer_bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
                    <p class="copyright">&copy; Copyright 2020 ProBusiness</p>
				</div>
				
				<div class="col-sm-6">
					<div class="footer_social">
						<ul class="footbot_social">
							<?php 
								use THE_ONE\Inc\Classes\HTML;
								use THE_ONE\Inc\Classes\Settings;
								$metas = Settings::social_media_handles();
								foreach ($metas as $_ => $meta) {
									echo 
									HTML::custom_tag(
										'li',
										HTML::custom_tag(
											'a',
											html::custom_tag(
												'i',
												'',
												false,
												[
													'class' => $meta['icon']
												]
											),
											false,
											[
												'class' 		 => $meta['class'],
												'href'  	 	 => $meta['link'],
												'data-placement' => 'top',
												'data-toggle' 	 => 'tooltip',
												'title' 		 => $meta['title'],
											],
											true
										),
										false,
										[],
										true
									);
								}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
    <?php
        wp_footer(  )
    ?>
    <div class="switcher"></div> 
</body>
</html>
