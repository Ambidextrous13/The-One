<?php
/**
 * Generic Header File
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$cc    = get_option( 'country_code' );
$phone = get_option( 'contact_number' );
$email = get_option( 'contact_email' );

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title(); ?></title>
	<meta name="description" content="">
	<?php
		wp_head();
	?>
</head>
<body>
<header id="header">
	<div id="header-top">
		<div class="container">
			<div class="row">
				<div class="hidden-xs col-lg-7 col-sm-5 top-info">
					<?php
					if ( $phone ) {
						printf( '<span><i class="fa fa-phone"></i>Phone: <a href="tel:+%3$s%4$s" style="color: white">+%1$s %2$s</a></span>', esc_attr( $cc ), esc_attr( substr_replace( $phone, '-', 5, 0 ) ), esc_attr( $cc ), esc_attr( $phone ) );
					} else {
						admin_note( 'Your Phone Number', 'theme-settings', '.contact_number' );
					}
					if ( $email ) {
						// phpcs:ignore
						printf( '<span class="hidden-sm"><i class="fa fa-envelope"></i>Email: <a href="mailto:%1$s" style="color: white">%2$s</span>', sanitize_email( $email ), sanitize_email( $email ) );
					} else {
						admin_note( 'Your Email id', 'theme-settings', '.e_mail' );
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div id="menu-bar">
		<div class="container">
			<div class="row">
				<div  class="col-lg-3 col-sm-3 ">
					<div id="logo">
						<?php
						if ( get_theme_mod( 'custom_logo' ) ) {
							if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							}
						} else {
							admin_note( 'Your logo goes here', 'customize.php?return=%2Fwp-admin%2Fupload.php', '#accordion-section-title_tagline', true );
						}
						?>
					</div>
				</div>
				<!-- Navigation================================================== -->
				<?php
					get_template_part( 'template-parts/header/menu' );
					$page_title = get_the_value( $args, 'header_text', 'HELLO', '', '[...]', 35, true );
				?>

			</div>
		</div>
	</div>
	<section class="page_head">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="page_title">
						<h2>
							<?php
							echo wp_kses(
								$page_title,
								[
									'p'    => [],
									'span' => [],
									'div'  => [],
								]
							);
							?>
						</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
</header>
