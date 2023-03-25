<?php
    $about      = isset( $args[ 'about_us_text' ] ) ? $args[ 'about_us_text' ] : 'Please set it';
    $address    = isset( $args[ 'address' ] ) ? $args[ 'address' ] : 'Please set it';
    $cc      = isset( $args[ 'country_code' ] ) ? $args[ 'country_code' ] : 'Please set it';
    $phone      = isset( $args[ 'phone_number' ] ) ? $args[ 'phone_number' ] : 'Please set it';
    $email      = isset( $args[ 'email' ] ) ? $args[ 'email' ] : 'Please set it';
?>
<div class="widget_content">
    <p><?php esc_attr_e( $about, 'the-one' ); ?></p>
    <ul class="contact-details-alt">
        <li><i class="fa fa-map-marker"></i> <p><strong>Address</strong> : <?php esc_attr_e( $address, 'the-one' ); ?></p></li>
        <li><i class="fa fa-user"></i> <p><strong>Phone</strong><a href="tel:"> : <?php esc_attr_e( sprintf( '+(%1$s) %2$s',$cc , substr_replace( $phone, '-', 5, 0 ) ), 'the-one' ); ?></a></p></li>
        <li><i class="fa fa-envelope"></i> <p><strong>Email</strong> :<a href="mailto:"><?php esc_attr_e( $email, 'the-one' ); ?></a></p></li>
    </ul>
</div>