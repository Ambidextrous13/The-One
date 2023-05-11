<?php
/**
 * Template part: Widget About Us.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

$about   = isset( $args['about_us_text'] ) ? $args['about_us_text'] : 'Please set it';
$address = isset( $args['address'] ) ? $args['address'] : 'Please set it';
$cc      = isset( $args['country_code'] ) ? $args['country_code'] : 'Please set it';
$phone   = isset( $args['phone_number'] ) ? $args['phone_number'] : 'Please set it';
$email   = isset( $args['email'] ) ? $args['email'] : 'Please set it';

$phone_string = sprintf( '+(%1$s) %2$s', $cc, substr_replace( $phone, '-', 5, 0 ) );
?>
<div class="widget_content">
	<p><?php echo esc_html( $about ); ?></p>
	<ul class="contact-details-alt">
		<li><i class="fa fa-map-marker"></i> <p><strong><?php esc_html_e( 'Address', 'the-one' ); ?></strong> : <?php echo esc_html( $address ); ?></p></li>
		<li><i class="fa fa-user"></i> <p><strong><?php esc_html_e( 'Phone', 'the-one' ); ?></strong><a href="tel:<?php echo esc_attr( $phone_string ); ?>"> : <?php echo esc_html( $phone_string ); ?></a></p></li>
		<li><i class="fa fa-envelope"></i> <p><strong><?php esc_html_e( 'Email', 'the-one' ); ?></strong> :<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p></li>
	</ul>
</div>
